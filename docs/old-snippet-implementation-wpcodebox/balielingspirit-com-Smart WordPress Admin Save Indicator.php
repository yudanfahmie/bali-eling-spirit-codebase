<?php
/**
 * Smart WordPress Admin Save Indicator v2
 *
 * A standalone, navigation-safe save indicator for WordPress admin screens.
 * It replaces broad global click animations and observes only save-like
 * controls followed by a related POST, AJAX, fetch, or XMLHttpRequest action.
 *
 * Optional per-control overrides:
 * - data-mhs-save-indicator="true"  Force tracking for a custom save control.
 * - data-mhs-save-indicator="false" Exclude a control or form from tracking.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'mhs_render_smart_admin_save_indicator_v2' ) ) {
    add_action( 'admin_footer', 'mhs_render_smart_admin_save_indicator_v2', 99 );

    function mhs_render_smart_admin_save_indicator_v2() {
        if ( ! is_admin() ) {
            return;
        }

        if ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) {
            return;
        }
        ?>
        <style id="mhs-smart-save-indicator-v2-css">
            #mhs-smart-save-indicator-v2 {
                position: fixed;
                right: 24px;
                bottom: 24px;
                z-index: 999999;
                display: flex;
                align-items: center;
                gap: 12px;
                min-width: 238px;
                max-width: min(390px, calc(100vw - 32px));
                padding: 13px 16px;
                color: #1d2327;
                background: #fff;
                border: 1px solid #c3c4c7;
                border-left: 4px solid #2271b1;
                border-radius: 14px;
                box-shadow: 0 14px 35px rgba(0, 0, 0, 0.16);
                opacity: 0;
                visibility: hidden;
                transform: translateY(14px);
                pointer-events: none;
                transition: opacity 180ms ease, transform 180ms ease, visibility 180ms ease;
            }

            #mhs-smart-save-indicator-v2.mhs-visible {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            #mhs-smart-save-indicator-v2.mhs-success {
                border-left-color: #00a32a;
            }

            #mhs-smart-save-indicator-v2.mhs-warning {
                border-left-color: #dba617;
            }

            #mhs-smart-save-indicator-v2.mhs-error {
                border-left-color: #d63638;
            }

            #mhs-smart-save-indicator-v2 .mhs-visual {
                position: relative;
                display: grid;
                width: 28px;
                height: 28px;
                flex: 0 0 28px;
                place-items: center;
            }

            #mhs-smart-save-indicator-v2 .mhs-spinner {
                width: 26px;
                height: 26px;
                border: 3px solid rgba(34, 113, 177, 0.18);
                border-top-color: #2271b1;
                border-radius: 999px;
                animation: mhsSmartSaveSpinV2 780ms linear infinite;
            }

            #mhs-smart-save-indicator-v2 .mhs-result-icon {
                display: none;
                width: 24px;
                height: 24px;
                align-items: center;
                justify-content: center;
                border-radius: 999px;
                color: #fff;
                font-size: 15px;
                line-height: 1;
                font-weight: 700;
            }

            #mhs-smart-save-indicator-v2.mhs-success .mhs-spinner,
            #mhs-smart-save-indicator-v2.mhs-warning .mhs-spinner,
            #mhs-smart-save-indicator-v2.mhs-error .mhs-spinner {
                display: none;
            }

            #mhs-smart-save-indicator-v2.mhs-success .mhs-result-icon,
            #mhs-smart-save-indicator-v2.mhs-warning .mhs-result-icon,
            #mhs-smart-save-indicator-v2.mhs-error .mhs-result-icon {
                display: flex;
            }

            #mhs-smart-save-indicator-v2.mhs-success .mhs-result-icon {
                background: #00a32a;
            }

            #mhs-smart-save-indicator-v2.mhs-warning .mhs-result-icon {
                background: #dba617;
            }

            #mhs-smart-save-indicator-v2.mhs-error .mhs-result-icon {
                background: #d63638;
            }

            #mhs-smart-save-indicator-v2 .mhs-copy {
                display: flex;
                flex-direction: column;
                gap: 2px;
                min-width: 0;
            }

            #mhs-smart-save-indicator-v2 .mhs-title {
                font-size: 13px;
                line-height: 1.35;
                font-weight: 700;
            }

            #mhs-smart-save-indicator-v2 .mhs-message {
                color: #50575e;
                font-size: 12px;
                line-height: 1.35;
            }

            #mhs-smart-save-indicator-v2 .mhs-dots::after {
                content: "";
                animation: mhsSmartSaveDotsV2 1200ms steps(4, end) infinite;
            }

            @keyframes mhsSmartSaveSpinV2 {
                to { transform: rotate(360deg); }
            }

            @keyframes mhsSmartSaveDotsV2 {
                0% { content: ""; }
                25% { content: "."; }
                50% { content: ".."; }
                75%, 100% { content: "..."; }
            }

            @media (max-width: 782px) {
                #mhs-smart-save-indicator-v2 {
                    right: 12px;
                    bottom: 12px;
                    left: 12px;
                    max-width: none;
                }
            }

            @media (prefers-reduced-motion: reduce) {
                #mhs-smart-save-indicator-v2,
                #mhs-smart-save-indicator-v2 .mhs-spinner,
                #mhs-smart-save-indicator-v2 .mhs-dots::after {
                    animation: none;
                    transition: none;
                }
            }
        </style>

        <div id="mhs-smart-save-indicator-v2" role="status" aria-live="polite" aria-atomic="true">
            <div class="mhs-visual" aria-hidden="true">
                <span class="mhs-spinner"></span>
                <span class="mhs-result-icon">✓</span>
            </div>
            <div class="mhs-copy">
                <div class="mhs-title">Saving changes<span class="mhs-dots"></span></div>
                <div class="mhs-message">Waiting for the save request.</div>
            </div>
        </div>

        <script id="mhs-smart-save-indicator-v2-js">
            (function(window, document) {
                'use strict';

                if (window.MHSSmartSaveIndicatorV2Loaded) {
                    return;
                }
                window.MHSSmartSaveIndicatorV2Loaded = true;

                var indicator = document.getElementById('mhs-smart-save-indicator-v2');
                if (!indicator) {
                    return;
                }

                var titleEl = indicator.querySelector('.mhs-title');
                var messageEl = indicator.querySelector('.mhs-message');
                var resultIconEl = indicator.querySelector('.mhs-result-icon');
                var CONTROL_SELECTOR = [
                    'input[type="submit"]',
                    'input[type="button"]',
                    'button',
                    '[role="button"][data-mhs-save-indicator="true"]'
                ].join(',');

                var SAVE_WORDS = /(^|\b)(save|saving|update|publish|submit|apply changes?|create|add new|store|commit)(\b|$)/i;
                var IGNORE_WORDS = /(^|\b)(search|filter|screen options?|bulk actions?|preview|view|cancel|back|close|dismiss|reset|delete|trash|remove|uninstall|install|activate|deactivate|duplicate|export|download|upload|scan|test|check|refresh|logout)(\b|$)/i;
                var IGNORED_REQUESTS = /(heartbeat|query-attachments|oembed-cache|logged-in|autosave|wp-remove-post-lock|wp-refresh-post-lock|rest-nonce|wp-compression-test)/i;
                var GENERIC_TOKENS = {
                    admin: true,
                    ajax: true,
                    action: true,
                    button: true,
                    changes: true,
                    form: true,
                    page: true,
                    post: true,
                    primary: true,
                    save: true,
                    saving: true,
                    submit: true,
                    update: true,
                    wordpress: true,
                    wp: true
                };

                var state = {
                    intent: null,
                    lastSubmitter: null,
                    lastSubmitterAt: 0,
                    requests: Object.create(null),
                    requestSequence: 0,
                    activeRequests: 0,
                    hadError: false,
                    visibleAt: 0,
                    hideTimer: null,
                    staleTimer: null,
                    settleTimer: null,
                    navigationTimer: null,
                    navigationPending: false
                };

                function isElement(element) {
                    return !!element && element.nodeType === 1;
                }

                function closest(element, selector) {
                    if (!isElement(element) || !element.closest) {
                        return null;
                    }
                    return element.closest(selector);
                }

                function clearTimer(name) {
                    if (state[name]) {
                        window.clearTimeout(state[name]);
                        state[name] = null;
                    }
                }

                function clearUiTimers() {
                    clearTimer('hideTimer');
                    clearTimer('staleTimer');
                    clearTimer('settleTimer');
                }

                function getText(element) {
                    if (!isElement(element)) {
                        return '';
                    }

                    return [
                        element.value,
                        element.textContent,
                        element.getAttribute('aria-label'),
                        element.getAttribute('title'),
                        element.getAttribute('name'),
                        element.id,
                        typeof element.className === 'string' ? element.className : ''
                    ].filter(Boolean).join(' ').replace(/\s+/g, ' ').trim();
                }

                function hasOptOut(element) {
                    return !!closest(element, '[data-mhs-save-indicator="false"]');
                }

                function hasOptIn(element) {
                    return !!closest(element, '[data-mhs-save-indicator="true"]');
                }

                function isAdminNavigation(element) {
                    return !!closest(element, 'a:not([data-mhs-save-indicator="true"]), [role="tab"], .nav-tab, #adminmenu, #wpadminbar, .subsubsub, .page-title-action');
                }

                function isUsableControl(element) {
                    if (!isElement(element) || hasOptOut(element)) {
                        return false;
                    }

                    if (!element.matches(CONTROL_SELECTOR)) {
                        return false;
                    }

                    if (isAdminNavigation(element) && !hasOptIn(element)) {
                        return false;
                    }

                    if (element.disabled || element.getAttribute('aria-disabled') === 'true') {
                        return false;
                    }

                    if (closest(element, '#mhs-smart-save-indicator-v2')) {
                        return false;
                    }

                    return true;
                }

                function isLikelySaveControl(element) {
                    if (!isUsableControl(element)) {
                        return false;
                    }

                    if (hasOptIn(element)) {
                        return true;
                    }

                    var text = getText(element);
                    if (!text || IGNORE_WORDS.test(text)) {
                        return false;
                    }

                    if (element.matches('#publish, #save-post, #save, #submit, [name="save"], [name="submit"], [name="publish"], .editor-post-publish-button, .editor-post-save-draft')) {
                        return true;
                    }

                    return SAVE_WORDS.test(text);
                }

                function isLikelySaveForm(form) {
                    if (!isElement(form) || form.tagName !== 'FORM' || hasOptOut(form)) {
                        return false;
                    }

                    if (hasOptIn(form)) {
                        return true;
                    }

                    if (form.matches('[role="search"], .search-form, #posts-filter')) {
                        return false;
                    }

                    var method = (form.getAttribute('method') || 'get').toLowerCase();
                    if (method !== 'post') {
                        return false;
                    }

                    return !!form.querySelector('input[name="_wpnonce"], input[name="option_page"], input[name="action"], input[name="save"], input[name="submit"]');
                }

                function rememberSubmitter(control) {
                    if (!isLikelySaveControl(control)) {
                        return;
                    }
                    state.lastSubmitter = control;
                    state.lastSubmitterAt = Date.now();
                }

                function resolveSubmitter(event, form) {
                    if (event && isElement(event.submitter) && event.submitter.form === form) {
                        return event.submitter;
                    }

                    if (
                        isElement(state.lastSubmitter) &&
                        state.lastSubmitter.form === form &&
                        Date.now() - state.lastSubmitterAt <= 2500
                    ) {
                        return state.lastSubmitter;
                    }

                    var active = document.activeElement;
                    if (isElement(active) && active.form === form && isLikelySaveControl(active)) {
                        return active;
                    }

                    var controls = form.querySelectorAll(CONTROL_SELECTOR);
                    var matched = [];
                    for (var i = 0; i < controls.length; i += 1) {
                        if (isLikelySaveControl(controls[i])) {
                            matched.push(controls[i]);
                        }
                    }

                    return matched.length === 1 ? matched[0] : null;
                }

                function effectiveMethod(form, submitter) {
                    var method = submitter && submitter.getAttribute('formmethod');
                    return String(method || (form && form.getAttribute('method')) || 'get').toLowerCase();
                }

                function effectiveAction(form, submitter) {
                    var action = submitter && submitter.getAttribute('formaction');
                    return String(action || (form && form.getAttribute('action')) || window.location.href);
                }

                function formAllowsSaveIntent(form, submitter) {
                    if (!isElement(form) || form.tagName !== 'FORM' || hasOptOut(form)) {
                        return false;
                    }

                    var method = effectiveMethod(form, submitter);
                    var action = effectiveAction(form, submitter).toLowerCase();
                    var hints = [
                        form.id,
                        typeof form.className === 'string' ? form.className : '',
                        form.getAttribute('data-action'),
                        form.getAttribute('data-ajax'),
                        form.getAttribute('data-wp-lists'),
                        submitter && submitter.id,
                        submitter && typeof submitter.className === 'string' ? submitter.className : '',
                        submitter && submitter.getAttribute('data-action'),
                        submitter && submitter.getAttribute('data-ajax')
                    ].filter(Boolean).join(' ').toLowerCase();

                    if (method !== 'post' && !/admin-ajax\.php|wp-json|rest_route|\bajax\b/.test(action + ' ' + hints)) {
                        return false;
                    }

                    var actionField = form.querySelector('select[name="action"], select[name="action2"], input[name="action"], input[name="action2"]');
                    if (actionField && /^-?1$/.test(String(actionField.value || ''))) {
                        return false;
                    }

                    return true;
                }

                function addToken(target, value) {
                    if (value === null || typeof value === 'undefined') {
                        return;
                    }

                    var normalized = String(value).toLowerCase().trim();
                    if (!normalized) {
                        return;
                    }

                    var compact = normalized.replace(/[^a-z0-9_-]+/g, '-').replace(/^-+|-+$/g, '');
                    if (compact.length >= 4 && !GENERIC_TOKENS[compact]) {
                        target[compact] = true;
                    }

                    normalized.split(/[^a-z0-9_-]+/).forEach(function(part) {
                        if (part.length >= 4 && !GENERIC_TOKENS[part]) {
                            target[part] = true;
                        }
                    });
                }

                function collectIntentTokens(form, submitter) {
                    var tokens = Object.create(null);

                    if (form) {
                        addToken(tokens, effectiveAction(form, submitter));
                        addToken(tokens, form.id);
                        addToken(tokens, typeof form.className === 'string' ? form.className : '');
                        addToken(tokens, form.getAttribute('data-action'));

                        var fields = form.querySelectorAll('[name="action"], [name="action2"], [name="option_page"], [name="page"], [name="task"], [name="command"]');
                        for (var i = 0; i < fields.length; i += 1) {
                            if (!/^-?1$/.test(String(fields[i].value || ''))) {
                                addToken(tokens, fields[i].value);
                            }
                        }
                    }

                    if (submitter) {
                        addToken(tokens, submitter.id);
                        addToken(tokens, submitter.getAttribute('name'));
                        addToken(tokens, submitter.value);
                        addToken(tokens, submitter.getAttribute('data-action'));
                    }

                    return Object.keys(tokens);
                }

                function createIntent(form, submitter, source) {
                    var now = Date.now();
                    state.intent = {
                        createdAt: now,
                        expiresAt: now + 5000,
                        claimedAt: 0,
                        endpoint: '',
                        form: form || null,
                        submitter: submitter || null,
                        source: source || 'unknown',
                        tokens: collectIntentTokens(form, submitter)
                    };
                    return state.intent;
                }

                function currentIntent() {
                    if (!state.intent || Date.now() > state.intent.expiresAt) {
                        state.intent = null;
                        return null;
                    }
                    return state.intent;
                }

                function endpointKey(url) {
                    try {
                        var parsed = new window.URL(String(url || ''), window.location.href);
                        return parsed.origin + parsed.pathname;
                    } catch (error) {
                        return String(url || '').split('?')[0];
                    }
                }

                function bodyToString(body) {
                    if (body === null || typeof body === 'undefined') {
                        return '';
                    }

                    if (typeof body === 'string') {
                        return body;
                    }

                    if (window.URLSearchParams && body instanceof window.URLSearchParams) {
                        return body.toString();
                    }

                    if (window.FormData && body instanceof window.FormData) {
                        var pairs = [];
                        body.forEach(function(value, key) {
                            if (typeof value === 'string') {
                                pairs.push(key + '=' + value);
                            } else {
                                pairs.push(key + '=[file]');
                            }
                        });
                        return pairs.join('&');
                    }

                    if (typeof body === 'object') {
                        try {
                            return JSON.stringify(body);
                        } catch (error) {
                            return '';
                        }
                    }

                    return String(body);
                }

                function shouldIgnoreRequest(method, url, body) {
                    method = String(method || 'GET').toUpperCase();
                    var requestText = String(url || '') + ' ' + bodyToString(body);

                    if (method === 'GET' || method === 'HEAD' || method === 'OPTIONS') {
                        return true;
                    }

                    return IGNORED_REQUESTS.test(requestText);
                }

                function requestMatchesIntent(method, url, body) {
                    if (shouldIgnoreRequest(method, url, body)) {
                        return false;
                    }

                    var intent = currentIntent();
                    if (!intent) {
                        return false;
                    }

                    var now = Date.now();
                    var age = now - intent.createdAt;
                    var requestText = (String(url || '') + ' ' + bodyToString(body)).toLowerCase();
                    var matchedToken = false;

                    for (var i = 0; i < intent.tokens.length; i += 1) {
                        if (requestText.indexOf(intent.tokens[i]) !== -1) {
                            matchedToken = true;
                            break;
                        }
                    }

                    if (!intent.claimedAt) {
                        if (!matchedToken && age > 1800) {
                            return false;
                        }
                        intent.claimedAt = now;
                        intent.endpoint = endpointKey(url);
                        intent.expiresAt = now + 4000;
                        return true;
                    }

                    if (now - intent.claimedAt > 4000) {
                        return false;
                    }

                    return matchedToken || endpointKey(url) === intent.endpoint;
                }

                function setContent(title, message, working, icon) {
                    if (titleEl) {
                        titleEl.textContent = title;
                        if (working) {
                            var dots = document.createElement('span');
                            dots.className = 'mhs-dots';
                            titleEl.appendChild(dots);
                        }
                    }

                    if (messageEl) {
                        messageEl.textContent = message || '';
                    }

                    if (resultIconEl) {
                        resultIconEl.textContent = icon || '✓';
                    }
                }

                function applyVisualState(status) {
                    indicator.classList.remove('mhs-success', 'mhs-warning', 'mhs-error');
                    if (status) {
                        indicator.classList.add('mhs-' + status);
                    }
                }

                function showWorking(message) {
                    clearTimer('hideTimer');
                    clearTimer('settleTimer');
                    applyVisualState('');
                    setContent('Saving changes', message || 'Saving in the background.', true, '✓');
                    indicator.classList.add('mhs-visible');
                    if (!state.visibleAt) {
                        state.visibleAt = Date.now();
                    }

                    clearTimer('staleTimer');
                    state.staleTimer = window.setTimeout(function() {
                        if (state.activeRequests > 0 || state.navigationPending) {
                            applyVisualState('warning');
                            setContent('Still saving', 'This is taking longer than usual. You can keep using the page.', false, '!');
                        }
                    }, 20000);
                }

                function hide() {
                    clearUiTimers();
                    clearTimer('navigationTimer');
                    state.navigationPending = false;
                    state.visibleAt = 0;
                    indicator.classList.remove('mhs-visible', 'mhs-success', 'mhs-warning', 'mhs-error');
                }

                function finishUi(title, message, status) {
                    clearTimer('staleTimer');
                    applyVisualState(status);
                    setContent(title, message, false, status === 'success' ? '✓' : '!');
                    indicator.classList.add('mhs-visible');

                    var elapsed = state.visibleAt ? Date.now() - state.visibleAt : 0;
                    var minimumVisibleDelay = Math.max(0, 450 - elapsed);
                    clearTimer('hideTimer');
                    state.hideTimer = window.setTimeout(hide, minimumVisibleDelay + (status === 'success' ? 1500 : 3200));
                }

                function beginRequest(method, url, body, transport) {
                    if (!requestMatchesIntent(method, url, body)) {
                        return null;
                    }

                    clearTimer('navigationTimer');
                    state.navigationPending = false;

                    if (state.activeRequests === 0) {
                        state.hadError = false;
                    }

                    state.requestSequence += 1;
                    var id = 'mhs-' + state.requestSequence;
                    state.requests[id] = {
                        method: String(method || 'POST').toUpperCase(),
                        url: String(url || ''),
                        transport: transport || 'unknown'
                    };
                    state.activeRequests += 1;
                    showWorking('Saving in the background.');
                    return id;
                }

                function settleRequests() {
                    if (state.activeRequests !== 0) {
                        return;
                    }

                    state.intent = null;
                    if (state.hadError) {
                        finishUi('Save may have failed', 'Please review the messages shown on this page.', 'error');
                    } else {
                        finishUi('Saved', 'The save request has finished.', 'success');
                    }
                }

                function endRequest(id, failed) {
                    if (!id || !state.requests[id]) {
                        return;
                    }

                    delete state.requests[id];
                    state.activeRequests = Math.max(0, state.activeRequests - 1);
                    state.hadError = state.hadError || !!failed;

                    if (state.activeRequests === 0) {
                        clearTimer('settleTimer');
                        state.settleTimer = window.setTimeout(settleRequests, 260);
                    }
                }

                function responsePayloadFailed(payload) {
                    if (payload === null || typeof payload === 'undefined') {
                        return false;
                    }

                    if (typeof payload === 'object') {
                        return payload.success === false || payload.status === 'error' || payload.ok === false;
                    }

                    var text = String(payload).trim();
                    if (text === '0' || text === '-1') {
                        return true;
                    }

                    if (!text || (text.charAt(0) !== '{' && text.charAt(0) !== '[')) {
                        return false;
                    }

                    try {
                        return responsePayloadFailed(JSON.parse(text));
                    } catch (error) {
                        return false;
                    }
                }

                function xhrFailed(xhr) {
                    if (!xhr || xhr.status === 0 || xhr.status >= 400) {
                        return true;
                    }

                    try {
                        if (xhr.responseType === 'json') {
                            return responsePayloadFailed(xhr.response);
                        }

                        if (!xhr.responseType || xhr.responseType === 'text') {
                            return responsePayloadFailed(xhr.responseText);
                        }
                    } catch (error) {
                        return false;
                    }

                    return false;
                }

                function beginNavigationFallback(form) {
                    if (state.activeRequests > 0) {
                        return;
                    }

                    state.navigationPending = true;
                    showWorking('Waiting for the server response.');
                    clearTimer('navigationTimer');
                    state.navigationTimer = window.setTimeout(function() {
                        if (state.navigationPending && state.activeRequests === 0) {
                            state.navigationPending = false;
                            state.intent = null;
                            finishUi('Save not confirmed', 'The page did not navigate or start a save request.', 'warning');
                        }
                    }, 12000);
                }

                function handleControlIntent(event) {
                    var control = closest(event.target, CONTROL_SELECTOR);
                    if (!control || !isLikelySaveControl(control)) {
                        return;
                    }

                    rememberSubmitter(control);
                    createIntent(control.form || null, control, event.type);
                }

                document.addEventListener('pointerdown', handleControlIntent, true);
                document.addEventListener('click', handleControlIntent, true);
                document.addEventListener('keydown', function(event) {
                    if (event.key !== 'Enter' && event.key !== ' ') {
                        return;
                    }
                    handleControlIntent(event);
                }, true);

                function prepareSubmitIntent(event) {
                    var form = event.target;
                    if (!isElement(form) || form.tagName !== 'FORM') {
                        return false;
                    }

                    var submitter = resolveSubmitter(event, form);
                    if (submitter && !isLikelySaveControl(submitter)) {
                        return false;
                    }

                    if (!submitter && !isLikelySaveForm(form)) {
                        return false;
                    }

                    if (!formAllowsSaveIntent(form, submitter)) {
                        return false;
                    }

                    createIntent(form, submitter, 'submit');
                    event.__mhsSaveIntentPreparedV2 = true;
                    event.__mhsSaveSubmitterV2 = submitter || null;
                    return true;
                }

                document.addEventListener('submit', function(event) {
                    prepareSubmitIntent(event);
                }, true);

                document.addEventListener('submit', function(event) {
                    if (!event.__mhsSaveIntentPreparedV2 && !prepareSubmitIntent(event)) {
                        return;
                    }

                    var form = event.target;
                    var submitter = event.__mhsSaveSubmitterV2 || resolveSubmitter(event, form);

                    if (!event.defaultPrevented && effectiveMethod(form, submitter) === 'post') {
                        beginNavigationFallback(form);
                    }
                }, false);

                if (window.fetch && !window.fetch.__mhsSmartSavePatchedV2) {
                    var originalFetch = window.fetch;
                    var wrappedFetch = function(input, init) {
                        var method = init && init.method ? init.method : (input && input.method ? input.method : 'GET');
                        var url = typeof input === 'string' ? input : (input && input.url ? input.url : '');
                        var body = init && Object.prototype.hasOwnProperty.call(init, 'body') ? init.body : '';
                        var requestId = beginRequest(method, url, body, 'fetch');
                        var result;

                        try {
                            result = originalFetch.apply(this, arguments);
                        } catch (error) {
                            endRequest(requestId, true);
                            throw error;
                        }

                        if (!requestId) {
                            return result;
                        }

                        return result.then(function(response) {
                            var failed = !response || response.ok === false;
                            var contentType = response && response.headers ? String(response.headers.get('content-type') || '') : '';
                            var contentLength = response && response.headers ? parseInt(response.headers.get('content-length') || '0', 10) : 0;

                            if (!failed && response && /application\/json|text\/plain/i.test(contentType) && (!contentLength || contentLength <= 262144)) {
                                try {
                                    response.clone().text().then(function(text) {
                                        endRequest(requestId, responsePayloadFailed(text));
                                    }).catch(function() {
                                        endRequest(requestId, false);
                                    });
                                } catch (error) {
                                    endRequest(requestId, false);
                                }
                            } else {
                                endRequest(requestId, failed);
                            }

                            return response;
                        }, function(error) {
                            endRequest(requestId, true);
                            throw error;
                        });
                    };

                    wrappedFetch.__mhsSmartSavePatchedV2 = true;
                    wrappedFetch.__mhsSmartSaveOriginalV2 = originalFetch;
                    window.fetch = wrappedFetch;
                }

                if (window.XMLHttpRequest && !window.XMLHttpRequest.prototype.__mhsSmartSavePatchedV2) {
                    var xhrPrototype = window.XMLHttpRequest.prototype;
                    var originalOpen = xhrPrototype.open;
                    var originalSend = xhrPrototype.send;

                    xhrPrototype.open = function(method, url) {
                        this.__mhsSmartSaveMetaV2 = {
                            method: method || 'GET',
                            url: url || ''
                        };
                        return originalOpen.apply(this, arguments);
                    };

                    xhrPrototype.send = function(body) {
                        var xhr = this;
                        var meta = xhr.__mhsSmartSaveMetaV2 || { method: 'GET', url: '' };
                        var requestId = beginRequest(meta.method, meta.url, body, 'xhr');

                        if (requestId) {
                            var settled = false;
                            var settle = function(failed) {
                                if (settled) {
                                    return;
                                }
                                settled = true;
                                endRequest(requestId, failed);
                            };

                            xhr.addEventListener('load', function() {
                                settle(xhrFailed(xhr));
                            }, { once: true });
                            xhr.addEventListener('error', function() {
                                settle(true);
                            }, { once: true });
                            xhr.addEventListener('timeout', function() {
                                settle(true);
                            }, { once: true });
                            xhr.addEventListener('abort', function() {
                                settle(false);
                            }, { once: true });
                        }

                        try {
                            return originalSend.apply(this, arguments);
                        } catch (error) {
                            endRequest(requestId, true);
                            throw error;
                        }
                    };

                    xhrPrototype.__mhsSmartSavePatchedV2 = true;
                }

                function resetAfterNavigation() {
                    state.intent = null;
                    state.lastSubmitter = null;
                    state.lastSubmitterAt = 0;
                    state.requests = Object.create(null);
                    state.activeRequests = 0;
                    state.hadError = false;
                    hide();
                }

                window.addEventListener('pageshow', resetAfterNavigation);

                window.MHSSmartSaveIndicatorV2 = {
                    markIntent: function(controlOrForm) {
                        var element = isElement(controlOrForm) ? controlOrForm : null;
                        var form = element && element.tagName === 'FORM' ? element : (element ? element.form : null);
                        var control = element && element.tagName !== 'FORM' ? element : null;
                        createIntent(form, control, 'manual');
                    },
                    hide: hide
                };
            })(window, document);
        </script>
        <?php
    }
}