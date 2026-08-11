<?php
/**
 * ============================================================================
 * AMBIENT WATER AUDIO PLAYER — Final Edition v4
 * ============================================================================
 *
 * NEW IN v4:
 *   • Tab-visibility awareness — audio pauses automatically when the browser
 *     tab loses focus and resumes seamlessly when the user returns.
 *     Only resumes if audio was actively playing before the tab switch.
 *     Works with Alt-Tab, tab switching, window minimise, and mobile app
 *     backgrounding.
 *   • Smooth volume fade-out on tab hide / fade-in on tab show (300ms ramp)
 *     for a polished, non-jarring transition.
 *
 * RETAINED FROM v3:
 *   • localStorage preference memory — key: 'bes_audio_pref' ('on' | 'off')
 *     - If user has NEVER set a preference → auto-unmute on first interaction
 *     - If user explicitly MUTED → respect that on every future page load
 *       (auto-unmute is fully suppressed — ethical UX)
 *     - If user explicitly PLAYED → auto-unmute on next page load immediately
 *     - Volume level persisted across pages via 'bes_audio_vol'
 *   • Color palette #254F22 forest-green tone
 *   • All autoplay strategies (AudioContext, interaction trap, retry loop,
 *     8s fallback) — ALL suppressed when pref = 'off'
 *
 * AUTOPLAY STRATEGIES (only fire when pref ≠ 'off'):
 *   1. AudioContext silent unlock on player ready
 *   2. Multi-event interaction trap (8 event types + visibilitychange)
 *   3. rAF retry loop for 12s checking mute state
 *   4. Hard 8s timeout fallback synthetic attempt
 *
 * SAFETY:
 *   • All try/catch wrapped — never throws
 *   • Safe YT API chaining — no conflict with other plugins
 *   • Single-fire guards on every code path
 *   • localStorage wrapped in try/catch (private browsing safe)
 *
 * @version 4.0.0
 */

if ( ! function_exists( 'bes_is_courses_path' ) ) {
    /**
     * Match:
     * /courses
     * /courses/
     * /courses/anything
     */
    function bes_is_courses_path() {
        $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? (string) $_SERVER['REQUEST_URI'] : '';
        $path        = parse_url( $request_uri, PHP_URL_PATH );

        if ( ! is_string( $path ) ) {
            return false;
        }

        return (bool) preg_match( '#^/courses(?:/|$)#i', $path );
    }
}

add_action('wp_footer', 'inject_ambient_water_audio_v4', 9999);

function inject_ambient_water_audio_v4() {
    if ( is_admin() || bes_is_courses_path() ) return;
    ?>

    <script>
    /* Safe Tailwind injection — skip if theme already loaded it */
    if (!window.__tailwindLoaded) {
        window.__tailwindLoaded = true;
        (function(){
            var s = document.createElement('script');
            s.src = 'https://cdn.tailwindcss.com';
            document.head.appendChild(s);
        })();
    }
    </script>

    <style>
        /* ================================================================
           COLOUR TOKENS — #254F22 forest-green family
           ================================================================
           Primary:   #254F22  (deep forest green)
           Mid:       #3A7A35  (rich mid-green)
           Light:     #5DB356  (bright leaf green)
           Highlight: #8FD989  (soft lime highlight)
           Glow:      rgba(37,79,34, 0.6)
           Text-on:   #0F2210  (near-black green)
           ================================================================ */

        /* ── Pulse ring ── */
        @keyframes besRipple {
            0%   { box-shadow: 0 0 0 0   rgba(93,179,86, 0.7); }
            70%  { box-shadow: 0 0 0 24px rgba(93,179,86, 0);  }
            100% { box-shadow: 0 0 0 0   rgba(93,179,86, 0);   }
        }
        /* ── Gradient flow ── */
        @keyframes besGradFlow {
            0%   { background-position: 0%   50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0%   50%; }
        }
        /* ── Tooltip fade ── */
        @keyframes besTooltip {
            0%   { opacity:0; transform:translateY(4px) translateX(-50%); }
            12%  { opacity:1; transform:translateY(0)   translateX(-50%); }
            80%  { opacity:1; transform:translateY(0)   translateX(-50%); }
            100% { opacity:0; transform:translateY(-4px) translateX(-50%); }
        }
        /* ── Spinner ── */
        @keyframes besSpin { to { transform: rotate(360deg); } }

        /* ── Button base ── */
        #bes-audio-btn {
            background: linear-gradient(135deg, #8FD989, #5DB356, #3A7A35, #254F22, #3A7A35, #5DB356);
            background-size: 400% 400%;
            animation: besGradFlow 5s ease infinite, besRipple 2.6s ease-out infinite;
            transition: transform .28s cubic-bezier(.34,1.56,.64,1),
                        opacity .25s ease;
        }
        #bes-audio-btn:hover {
            transform: scale(1.1) !important;
            animation: besGradFlow 2.2s ease infinite !important;
        }
        /* Playing state — calm, slow gradient, no pulse */
        #bes-audio-btn.is-playing {
            animation: besGradFlow 9s ease infinite !important;
            box-shadow: 0 4px 20px rgba(37,79,34,.45) !important;
        }
        /* Tab-paused state — gentle breathing, signals "I'll be back" */
        #bes-audio-btn.is-tab-paused {
            animation: besGradFlow 12s ease infinite !important;
            opacity: .45;
            filter: grayscale(15%);
            box-shadow: 0 2px 12px rgba(37,79,34,.25) !important;
        }
        /* User-muted state — desaturated, still visible */
        #bes-audio-btn.user-muted {
            opacity: .55;
            filter: grayscale(30%);
        }
        /* Loading state */
        #bes-audio-btn.is-loading {
            opacity: .6;
            pointer-events: none;
        }

        /* ── Spinner ring ── */
        #bes-spinner {
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 2.5px solid transparent;
            border-top-color: rgba(255,255,255,.65);
            animation: besSpin .75s linear infinite;
            display: none;
            pointer-events: none;
        }
        #bes-audio-btn.is-loading #bes-spinner { display: block; }

        /* ── Tooltip ── */
        #bes-audio-tooltip {
            position: absolute;
            bottom: calc(100% + 10px);
            left: 50%;
            transform: translateX(-50%);
            background: rgba(10,20,9,.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: #c5eebc;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: .07em;
            text-transform: uppercase;
            white-space: nowrap;
            padding: 5px 11px;
            border-radius: 7px;
            border: 1px solid rgba(93,179,86,.22);
            pointer-events: none;
            opacity: 0;
            z-index: 1;
        }
        #bes-audio-tooltip.show {
            animation: besTooltip 3.2s ease forwards;
        }

        /* ── Volume panel ── */
        #bes-vol-panel {
            display: none;
            position: absolute;
            bottom: calc(100% + 12px);
            left: 50%;
            transform: translateX(-50%);
            background: rgba(10,20,9,.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(93,179,86,.18);
            border-radius: 14px;
            padding: 12px 16px;
            min-width: 148px;
            z-index: 2;
        }
        #bes-vol-label {
            color: rgba(197,238,188,.35);
            font-size: 9px;
            letter-spacing: .12em;
            text-transform: uppercase;
            margin: 0 0 8px;
            font-weight: 700;
        }

        /* ── Volume slider ── */
        #bes-vol-slider {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 3px;
            border-radius: 2px;
            outline: none;
            cursor: pointer;
            background: linear-gradient(
                90deg,
                #5DB356 var(--vol, 75%),
                rgba(255,255,255,.1) var(--vol, 75%)
            );
        }
        #bes-vol-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 13px; height: 13px;
            border-radius: 50%;
            background: #8FD989;
            cursor: pointer;
            box-shadow: 0 0 8px rgba(93,179,86,.6);
            transition: transform .15s ease;
        }
        #bes-vol-slider::-webkit-slider-thumb:hover { transform: scale(1.25); }
        #bes-vol-slider::-moz-range-thumb {
            width: 13px; height: 13px;
            border-radius: 50%;
            background: #8FD989;
            border: none;
            cursor: pointer;
        }

        /* ── Pref badge (tiny dot showing saved state) ── */
        #bes-pref-dot {
            position: absolute;
            top: 2px; right: 2px;
            width: 7px; height: 7px;
            border-radius: 50%;
            border: 1.5px solid rgba(255,255,255,.4);
            background: #8FD989;
            transition: background .3s ease;
            pointer-events: none;
        }
        #bes-pref-dot.pref-off { background: rgba(255,255,255,.25); }
    </style>

    <!-- ── Offscreen YT iframe container ── -->
    <div id="bes-yt-wrap"
         style="position:fixed;left:-9999px;top:-9999px;width:1px;height:1px;
                overflow:hidden;pointer-events:none;opacity:0;z-index:-1"
         aria-hidden="true">
        <div id="bes-yt-player"></div>
    </div>

    <!-- ══════════════════════════════════════════
         PLAYER UI — bottom-left, above everything
         ══════════════════════════════════════════ -->
    <div id="bes-audio-root"
         style="position:fixed;bottom:24px;left:64px;z-index:99999;font-family:sans-serif">

        <!-- Tooltip (appears above button) -->
        <div id="bes-audio-tooltip" role="status" aria-live="polite"></div>

        <!-- Volume panel -->
        <div id="bes-vol-panel" role="region" aria-label="Volume control">
            <p id="bes-vol-label">Volume</p>
            <input type="range" id="bes-vol-slider"
                   min="0" max="100" value="75"
                   aria-label="Ambient audio volume"
                   oninput="besSetVolume(this.value)"
                   style="--vol:75%">
        </div>

        <!-- Main toggle button -->
        <button id="bes-audio-btn"
                onclick="besToggle()"
                onmouseenter="besShowTooltip()"
                onmouseleave="besHideTooltip()"
                aria-label="Toggle ambient nature sounds"
                style="position:relative;display:flex;align-items:center;justify-content:center;
                       width:54px;height:54px;border-radius:50%;
                       border:2px solid rgba(255,255,255,.2);
                       cursor:pointer;color:#0F2210;outline:none;
                       box-shadow:0 6px 24px rgba(37,79,34,.4);">

            <!-- Spinner -->
            <div id="bes-spinner" aria-hidden="true"></div>

            <!-- Preference memory dot -->
            <div id="bes-pref-dot" aria-hidden="true"></div>

            <!-- Icon: muted / not playing -->
            <svg id="bes-icon-muted"
                 style="width:21px;height:21px"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                      d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586
                         l4.707-4.707C10.923 3.663 12 4.109 12 5v14
                         c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                      d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
            </svg>

            <!-- Icon: playing -->
            <svg id="bes-icon-playing"
                 style="width:21px;height:21px;display:none"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                      d="M15.536 8.464a5 5 0 010 7.072
                         m2.828-9.9a9 9 0 010 12.728
                         M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586
                         l4.707-4.707C10.923 3.663 12 4.109 12 5v14
                         c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
            </svg>
        </button>
    </div>

    <script>
    (function(){
        'use strict';

        /* ════════════════════════════════════════════════════════════════
         * STORAGE HELPERS — safe wrappers (private browsing won't throw)
         * ════════════════════════════════════════════════════════════════ */
        var PREF_KEY = 'bes_audio_pref';   // values: 'on' | 'off' | null (never set)
        var VOL_KEY  = 'bes_audio_vol';    // value: '0'–'100'

        function prefGet(key) {
            try { return localStorage.getItem(key); } catch(e) { return null; }
        }
        function prefSet(key, val) {
            try { localStorage.setItem(key, val); } catch(e) {}
        }

        /* ════════════════════════════════════════════════════════════════
         * STATE
         * ════════════════════════════════════════════════════════════════ */
        var player              = null;
        var playerReady         = false;
        var isPlaying           = false;
        var hasUnmuted          = false;   // fired once per page load
        var interactionFired    = false;
        var volPanelOpen        = false;

        /* ── Tab-visibility state (v4) ── */
        var wasPlayingBeforeHide = false;  // true if audio was active before tab lost focus
        var tabPauseActive       = false;  // true while tab-paused (prevents toggle conflicts)
        var fadeTimer            = null;   // smooth volume ramp handle

        /* Read saved preferences */
        var savedPref = prefGet(PREF_KEY);          // 'on' | 'off' | null
        var savedVol  = parseInt(prefGet(VOL_KEY) || '75', 10);
        if (isNaN(savedVol) || savedVol < 0 || savedVol > 100) savedVol = 75;

        /*
         * ETHICAL AUTO-PLAY RULE:
         *   savedPref === null  → first-time visitor, arm all strategies
         *   savedPref === 'on'  → user previously wanted sound, auto-unmute
         *   savedPref === 'off' → user explicitly muted, NEVER auto-unmute
         *                         interaction trap & strategies are skipped
         */
        var allowAutoPlay = (savedPref !== 'off');

        /* ════════════════════════════════════════════════════════════════
         * DOM REFS
         * ════════════════════════════════════════════════════════════════ */
        var btn         = document.getElementById('bes-audio-btn');
        var iconMuted   = document.getElementById('bes-icon-muted');
        var iconPlaying = document.getElementById('bes-icon-playing');
        var tooltip     = document.getElementById('bes-audio-tooltip');
        var volPanel    = document.getElementById('bes-vol-panel');
        var volSlider   = document.getElementById('bes-vol-slider');
        var prefDot     = document.getElementById('bes-pref-dot');

        /* Apply saved volume to slider immediately */
        if (volSlider) {
            volSlider.value = savedVol;
            volSlider.style.setProperty('--vol', savedVol + '%');
        }

        /* Reflect saved pref in the dot indicator */
        function updatePrefDot() {
            if (!prefDot) return;
            var p = prefGet(PREF_KEY);
            prefDot.classList.toggle('pref-off', p === 'off');
        }
        updatePrefDot();

        /* Apply user-muted visual hint if coming in with pref=off */
        if (savedPref === 'off' && btn) {
            btn.classList.add('user-muted');
        }

        /* ════════════════════════════════════════════════════════════════
         * 1. YOUTUBE API — safe chained injection
         * ════════════════════════════════════════════════════════════════ */
        function injectYTApi() {
            /* Already loaded by another plugin? Init directly. */
            if (typeof window.YT !== 'undefined' && typeof window.YT.Player !== 'undefined') {
                initPlayer();
                return;
            }
            if (!document.getElementById('bes-yt-api-tag')) {
                var tag  = document.createElement('script');
                tag.id   = 'bes-yt-api-tag';
                tag.src  = 'https://www.youtube.com/iframe_api';
                var ref  = document.getElementsByTagName('script')[0];
                ref.parentNode.insertBefore(tag, ref);
            }
            /* Chain safely — never overwrite another plugin's callback */
            var prev = window.onYouTubeIframeAPIReady;
            window.onYouTubeIframeAPIReady = function() {
                if (typeof prev === 'function') { try { prev(); } catch(e){} }
                initPlayer();
            };
        }

        /* ════════════════════════════════════════════════════════════════
         * 2. PLAYER INIT
         * ════════════════════════════════════════════════════════════════ */
        function initPlayer() {
            if (player) return; /* double-init guard */
            try {
                player = new YT.Player('bes-yt-player', {
                    height: '1', width: '1',
                    videoId: 'NWY4fBAeLYw',
                    playerVars: {
                        autoplay:       1,
                        controls:       0,
                        showinfo:       0,
                        modestbranding: 1,
                        loop:           1,
                        playlist:       'NWY4fBAeLYw',
                        mute:           1,       /* Always start muted — browser law */
                        playsinline:    1,
                        rel:            0,
                        iv_load_policy: 3,
                        disablekb:      1
                    },
                    events: {
                        onReady:       onPlayerReady,
                        onStateChange: onStateChange,
                        onError:       onPlayerError
                    }
                });
            } catch(e) {
                console.warn('[BES Audio] Player init error:', e);
            }
        }

        function onPlayerReady(event) {
            playerReady = true;
            if (btn) btn.classList.remove('is-loading');

            try { event.target.setVolume(savedVol); } catch(e){}
            try { event.target.playVideo(); } catch(e){}

            /* ── Arm tab-visibility watcher (v4) ── */
            armTabVisibility();

            if (!allowAutoPlay) {
                /* User previously muted — stay silent, just show muted UI */
                showTooltipMsg('Tap to play ambient sounds');
                return;
            }

            /* If user saved pref = 'on', unmute immediately (they want it) */
            if (savedPref === 'on') {
                setTimeout(doUnmute, 200);
                return;
            }

            /* First-time visitor (savedPref = null) — arm all strategies */
            setTimeout(trySyntheticUnlock, 350);
            armInteractionTrap();
            startRetryLoop();
            setTimeout(function(){
                if (!hasUnmuted) trySyntheticUnlock();
            }, 8000);
        }

        function onStateChange(event) {
            /* Bulletproof loop */
            if (event.data === YT.PlayerState.ENDED) {
                try { player.playVideo(); } catch(e){}
            }
            /* If browser auto-unmuted (engagement score), sync UI */
            if (event.data === YT.PlayerState.PLAYING) {
                checkReflectMuteState();
            }
        }

        function onPlayerError(event) {
            console.warn('[BES Audio] YouTube error code:', event.data);
        }

        /* ════════════════════════════════════════════════════════════════
         * 3. AUTO-PLAY STRATEGIES
         * ════════════════════════════════════════════════════════════════ */

        /* — Strategy A: AudioContext silent unlock — */
        function trySyntheticUnlock() {
            if (hasUnmuted || !allowAutoPlay) return;
            try {
                var ctx = new (window.AudioContext || window.webkitAudioContext)();
                var buf = ctx.createBuffer(1, 1, 22050);
                var src = ctx.createBufferSource();
                src.buffer = buf;
                src.connect(ctx.destination);
                src.start(0);
                ctx.resume().then(function(){
                    doUnmute();
                    try { ctx.close(); } catch(e){}
                }).catch(function(){
                    /* Blocked — interaction trap will handle */
                });
            } catch(e){
                /* Safari / older browsers — silent fail */
            }
        }

        /* — Strategy B: Multi-event interaction trap — */
        var trapEvents = ['click','touchstart','touchmove','scroll',
                          'keydown','pointerdown','mousemove','wheel'];

        function armInteractionTrap() {
            trapEvents.forEach(function(evt){
                window.addEventListener(evt, onFirstInteraction,
                    { once: true, passive: true, capture: true });
            });
            document.addEventListener('visibilitychange', function(){
                if (!document.hidden && !hasUnmuted && allowAutoPlay) onFirstInteraction();
            }, { once: true });
        }

        function onFirstInteraction() {
            if (interactionFired || !allowAutoPlay) return;
            interactionFired = true;
            trapEvents.forEach(function(evt){
                window.removeEventListener(evt, onFirstInteraction, { capture: true });
            });
            if (!hasUnmuted) doUnmute();
        }

        /* — Strategy C: rAF polling (12s max) — */
        function startRetryLoop() {
            var start = Date.now();
            function tick() {
                if (hasUnmuted || !allowAutoPlay) return;
                if (Date.now() - start > 12000) return;
                checkReflectMuteState();
                requestAnimationFrame(function(){ setTimeout(tick, 500); });
            }
            tick();
        }

        function checkReflectMuteState() {
            try {
                if (player && typeof player.isMuted === 'function') {
                    if (!player.isMuted() && !hasUnmuted) {
                        hasUnmuted = true;
                        isPlaying  = true;
                        prefSet(PREF_KEY, 'on');
                        prefSet(VOL_KEY, String(savedVol));
                        setPlayingUI(true);
                        updatePrefDot();
                    }
                }
            } catch(e){}
        }

        /* ════════════════════════════════════════════════════════════════
         * 4. CORE UNMUTE
         * ════════════════════════════════════════════════════════════════ */
        function doUnmute() {
            if (hasUnmuted || !playerReady || !player) return;
            try {
                player.unMute();
                player.setVolume(savedVol);
                player.playVideo();
                hasUnmuted = true;
                isPlaying  = true;
                /* ── Save preference: user wants sound ── */
                prefSet(PREF_KEY, 'on');
                prefSet(VOL_KEY, String(savedVol));
                setPlayingUI(true);
                updatePrefDot();
                showTooltipMsg('♪ Ambient sounds on');
                if (btn) btn.classList.remove('user-muted');
            } catch(e){
                console.warn('[BES Audio] Unmute failed:', e);
            }
        }

        /* ════════════════════════════════════════════════════════════════
         * 5. TAB-VISIBILITY PAUSE/RESUME (v4 — new)
         * ════════════════════════════════════════════════════════════════
         *
         * BEHAVIOUR:
         *   Tab hidden  → if audio is playing, smoothly fade out then pause.
         *                 Flag `wasPlayingBeforeHide = true` so we know to
         *                 resume when user returns.
         *   Tab visible → if `wasPlayingBeforeHide` is true, resume playback
         *                 with a smooth fade-in back to the user's saved volume.
         *   If the user had manually muted before switching tabs, we do nothing.
         *
         * SMOOTH RAMP:
         *   Uses a 300ms stepped volume ramp (6 steps × 50ms) so the audio
         *   doesn't cut in/out abruptly — feels premium and considered.
         *
         * ════════════════════════════════════════════════════════════════ */
        var FADE_DURATION = 300;   /* ms for fade-out and fade-in */
        var FADE_STEPS    = 6;     /* number of volume steps in the ramp */

        function armTabVisibility() {
            document.addEventListener('visibilitychange', handleTabVisibility);
        }

        function handleTabVisibility() {
            if (document.hidden) {
                onTabHidden();
            } else {
                onTabVisible();
            }
        }

        /* ── Tab goes hidden ── */
        function onTabHidden() {
            cancelFade();

            /* Only pause if currently playing and not already user-muted */
            if (!isPlaying || !playerReady || !player) {
                wasPlayingBeforeHide = false;
                return;
            }

            wasPlayingBeforeHide = true;
            tabPauseActive       = true;

            /* Smooth fade-out → then pause */
            fadeVolume(savedVol, 0, FADE_DURATION, function(){
                try {
                    player.pauseVideo();
                } catch(e){}
                /* Add tab-paused visual state */
                if (btn) btn.classList.add('is-tab-paused');
            });
        }

        /* ── Tab becomes visible again ── */
        function onTabVisible() {
            cancelFade();

            /* Only resume if we paused it ourselves */
            if (!wasPlayingBeforeHide || !playerReady || !player) {
                tabPauseActive = false;
                return;
            }

            wasPlayingBeforeHide = false;
            tabPauseActive       = false;

            /* Remove tab-paused visual state */
            if (btn) btn.classList.remove('is-tab-paused');

            /* Resume playback at volume 0, then fade-in */
            try {
                player.setVolume(0);
                player.unMute();
                player.playVideo();
            } catch(e){}

            /* Smooth fade-in back to user's saved volume */
            fadeVolume(0, savedVol, FADE_DURATION, function(){
                /* Ensure final volume is exact */
                try { player.setVolume(savedVol); } catch(e){}
                showTooltipMsg('♪ Welcome back');
            });
        }

        /* ── Generic smooth volume ramp ── */
        function fadeVolume(fromVol, toVol, duration, callback) {
            cancelFade();

            var stepTime  = Math.round(duration / FADE_STEPS);
            var stepDelta = (toVol - fromVol) / FADE_STEPS;
            var current   = fromVol;
            var step      = 0;

            fadeTimer = setInterval(function(){
                step++;
                current = Math.round(fromVol + stepDelta * step);

                /* Clamp */
                if (toVol > fromVol) current = Math.min(current, toVol);
                else                 current = Math.max(current, toVol);

                try { player.setVolume(current); } catch(e){}

                if (step >= FADE_STEPS) {
                    cancelFade();
                    if (typeof callback === 'function') callback();
                }
            }, stepTime);
        }

        function cancelFade() {
            if (fadeTimer) {
                clearInterval(fadeTimer);
                fadeTimer = null;
            }
        }

        /* ════════════════════════════════════════════════════════════════
         * 6. PUBLIC TOGGLE — button click
         * ════════════════════════════════════════════════════════════════ */
        window.besToggle = function() {
            if (!playerReady || !player) return;

            /* If tab-pause is active and user clicks, treat as explicit resume */
            if (tabPauseActive) {
                cancelFade();
                wasPlayingBeforeHide = false;
                tabPauseActive       = false;
                if (btn) btn.classList.remove('is-tab-paused');
            }

            try {
                var muted = player.isMuted();

                if (muted || !isPlaying) {
                    /* ── UNMUTE ── */
                    player.unMute();
                    player.setVolume(savedVol);
                    player.playVideo();
                    hasUnmuted   = true;
                    isPlaying    = true;
                    allowAutoPlay = true;
                    /* Save: user wants sound */
                    prefSet(PREF_KEY, 'on');
                    prefSet(VOL_KEY, String(savedVol));
                    setPlayingUI(true);
                    updatePrefDot();
                    showTooltipMsg('♪ Ambient sounds on');
                    openVolPanel();
                    if (btn) btn.classList.remove('user-muted');

                } else {
                    /* ── MUTE ── */
                    player.mute();
                    isPlaying     = false;
                    allowAutoPlay = false; /* suppress auto on next pages */
                    /* Save: user does NOT want sound */
                    prefSet(PREF_KEY, 'off');
                    setPlayingUI(false);
                    updatePrefDot();
                    showTooltipMsg('Sounds off — remembered');
                    closeVolPanel();
                    if (btn) btn.classList.add('user-muted');
                }
            } catch(e){
                console.warn('[BES Audio] Toggle error:', e);
            }
        };

        /* ════════════════════════════════════════════════════════════════
         * 7. VOLUME CONTROL
         * ════════════════════════════════════════════════════════════════ */
        window.besSetVolume = function(val) {
            savedVol = parseInt(val, 10);
            if (volSlider) volSlider.style.setProperty('--vol', savedVol + '%');
            prefSet(VOL_KEY, String(savedVol)); /* persist volume choice */
            try {
                if (!player || typeof player.setVolume !== 'function') return;
                player.setVolume(savedVol);
                if (savedVol === 0) {
                    player.mute();
                    isPlaying = false;
                    setPlayingUI(false);
                    prefSet(PREF_KEY, 'off');
                    allowAutoPlay = false;
                    if (btn) btn.classList.add('user-muted');
                } else if (player.isMuted()) {
                    player.unMute();
                    isPlaying = true;
                    setPlayingUI(true);
                    prefSet(PREF_KEY, 'on');
                    allowAutoPlay = true;
                    if (btn) btn.classList.remove('user-muted');
                }
                updatePrefDot();
            } catch(e){}
        };

        /* ════════════════════════════════════════════════════════════════
         * 8. UI HELPERS
         * ════════════════════════════════════════════════════════════════ */
        function setPlayingUI(playing) {
            if (!btn) return;
            if (playing) {
                iconMuted.style.display   = 'none';
                iconPlaying.style.display = '';
                btn.classList.add('is-playing');
                btn.classList.remove('is-tab-paused');
                btn.setAttribute('aria-label', 'Mute ambient nature sounds');
            } else {
                iconMuted.style.display   = '';
                iconPlaying.style.display = 'none';
                btn.classList.remove('is-playing');
                btn.classList.remove('is-tab-paused');
                btn.setAttribute('aria-label', 'Play ambient nature sounds');
            }
        }

        /* Tooltip */
        var ttTimeout = null;
        function showTooltipMsg(msg) {
            if (!tooltip) return;
            clearTimeout(ttTimeout);
            tooltip.textContent = msg;
            tooltip.classList.remove('show');
            void tooltip.offsetWidth; /* reflow — restart animation */
            tooltip.classList.add('show');
            ttTimeout = setTimeout(function(){ tooltip.classList.remove('show'); }, 3300);
        }

        window.besShowTooltip = function() {
            if (!tooltip || tooltip.classList.contains('show')) return;
            var p = prefGet(PREF_KEY);
            if (tabPauseActive)  tooltip.textContent = 'Paused — tap to resume';
            else if (p === 'off') tooltip.textContent = 'Tap to resume sounds';
            else if (isPlaying)   tooltip.textContent = 'Tap to mute';
            else                  tooltip.textContent = 'Tap for ambient sounds';
            tooltip.style.opacity   = '1';
            tooltip.style.animation = 'none';
        };
        window.besHideTooltip = function() {
            if (!tooltip) return;
            if (!tooltip.classList.contains('show')) tooltip.style.opacity = '0';
        };

        /* Volume panel */
        function openVolPanel() {
            if (volPanel) { volPanel.style.display = 'block'; volPanelOpen = true; }
        }
        function closeVolPanel() {
            if (volPanel) { volPanel.style.display = 'none'; volPanelOpen = false; }
        }

        /* ════════════════════════════════════════════════════════════════
         * 9. INIT SEQUENCE
         * ════════════════════════════════════════════════════════════════ */
        if (btn) btn.classList.add('is-loading');

        /* Inject YT API non-blocking */
        if (document.readyState === 'complete') {
            injectYTApi();
        } else {
            window.addEventListener('load', injectYTApi, { once: true });
            document.addEventListener('DOMContentLoaded', function(){
                setTimeout(injectYTApi, 150);
            }, { once: true });
        }

        /* Close volume panel on outside click */
        document.addEventListener('click', function(e){
            if (!volPanelOpen) return;
            if (btn && btn.contains(e.target)) return;
            if (volPanel && volPanel.contains(e.target)) return;
            closeVolPanel();
        });

    })();
    </script>
    <?php
}