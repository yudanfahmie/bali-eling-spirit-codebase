<?php
/**
 * Shared Sanctuary detail modal renderer/controller.
 * Loaded only by shadow-gated Phase C modules.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'bes_site_core_sanctuary_render_modal' ) ) {
    function bes_site_core_sanctuary_render_modal( $id, $title, $body, array $meta = array(), array $cta = array() ) {
        $dialog_id = 'bes-sanctuary-modal-' . sanitize_html_class( $id );
        ob_start();
        ?>
        <div id="<?php echo esc_attr( $dialog_id ); ?>" class="fixed inset-0 z-[99990] hidden items-center justify-center p-4 md:p-8" data-bes-sanctuary-modal="<?php echo esc_attr( $id ); ?>" aria-hidden="true">
            <button type="button" class="absolute inset-0 bg-black/75 backdrop-blur-sm" data-bes-modal-close aria-label="Tutup detail"></button>
            <section class="relative z-10 w-full max-w-2xl max-h-[88vh] overflow-y-auto rounded-2xl border border-white/10 bg-bes-forest-deep shadow-2xl" role="dialog" aria-modal="true" aria-labelledby="<?php echo esc_attr( $dialog_id . '-title' ); ?>" tabindex="-1">
                <div class="sticky top-0 z-20 flex items-center justify-between gap-4 px-6 py-5 border-b border-white/[.06] bg-bes-forest-deep/95 backdrop-blur-md">
                    <h3 id="<?php echo esc_attr( $dialog_id . '-title' ); ?>" class="font-display text-2xl md:text-3xl font-medium text-bes-ivory"><?php echo esc_html( $title ); ?></h3>
                    <button type="button" class="w-10 h-10 rounded-full border border-white/10 text-white/60 hover:!text-bes-leaf hover:border-bes-leaf/30 transition-colors" data-bes-modal-close aria-label="Tutup detail <?php echo esc_attr( $title ); ?>"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>
                </div>
                <div class="p-6 md:p-8">
                    <div class="font-body text-sm md:text-base leading-relaxed text-bes-parchment/70 space-y-4"><?php echo wp_kses_post( $body ); ?></div>
                    <?php if ( $meta ) : ?>
                        <dl class="mt-7 grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <?php foreach ( $meta as $label => $value ) : ?>
                                <div class="rounded-xl border border-white/[.06] bg-white/[.03] p-4">
                                    <dt class="font-body text-[9px] uppercase tracking-[0.18em] font-bold text-bes-leaf/70 mb-1"><?php echo esc_html( $label ); ?></dt>
                                    <dd class="font-body text-sm text-bes-ivory/80 leading-relaxed"><?php echo wp_kses_post( $value ); ?></dd>
                                </div>
                            <?php endforeach; ?>
                        </dl>
                    <?php endif; ?>
                    <?php if ( ! empty( $cta['href'] ) && ! empty( $cta['label'] ) ) : ?>
                        <a href="<?php echo esc_url( $cta['href'] ); ?>"<?php echo ! empty( $cta['external'] ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?> class="mt-7 inline-flex items-center gap-2.5 bg-bes-leaf text-bes-forest font-body font-bold text-[11px] uppercase tracking-label px-7 py-3.5 rounded-xl hover:bg-bes-leaf-hover transition-colors">
                            <?php echo esc_html( $cta['label'] ); ?><i class="fa-solid fa-arrow-right text-[10px]" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </section>
        </div>
        <?php
        return ob_get_clean();
    }
}

if ( ! function_exists( 'bes_site_core_sanctuary_modal_engine' ) ) {
    function bes_site_core_sanctuary_modal_engine() {
        static $printed = false;
        if ( $printed ) {
            return '';
        }
        $printed = true;
        ob_start();
        ?>
        <script>
        (function(){
            if (window.BESSanctuaryModalEngine) return;
            var current=null, opener=null, previousOverflow='';
            var focusable='a[href],button:not([disabled]),input:not([disabled]),select:not([disabled]),textarea:not([disabled]),[tabindex]:not([tabindex="-1"])';
            function dialogBox(modal){ return modal ? modal.querySelector('[role="dialog"]') : null; }
            function closeModal(){
                if(!current) return;
                current.classList.add('hidden'); current.classList.remove('flex'); current.setAttribute('aria-hidden','true');
                document.body.style.overflow=previousOverflow; var back=opener; current=null; opener=null; if(back && back.focus) back.focus();
            }
            function openModal(id, trigger){
                var modal=document.querySelector('[data-bes-sanctuary-modal="'+id+'"]'); if(!modal) return;
                if(current) closeModal(); current=modal; opener=trigger; previousOverflow=document.body.style.overflow;
                modal.classList.remove('hidden'); modal.classList.add('flex'); modal.setAttribute('aria-hidden','false'); document.body.style.overflow='hidden';
                var box=dialogBox(modal), first=box && box.querySelector(focusable); (first||box).focus();
            }
            document.addEventListener('click',function(e){
                var open=e.target.closest('[data-bes-modal-open]'); if(open){ e.preventDefault(); openModal(open.getAttribute('data-bes-modal-open'),open); return; }
                if(current && e.target.closest('[data-bes-modal-close]')){ e.preventDefault(); closeModal(); }
            });
            document.addEventListener('keydown',function(e){
                if(!current) return;
                if(e.key==='Escape'){ e.preventDefault(); closeModal(); return; }
                if(e.key!=='Tab') return;
                var box=dialogBox(current), nodes=box?Array.prototype.slice.call(box.querySelectorAll(focusable)).filter(function(n){return n.offsetParent!==null;}):[];
                if(!nodes.length){ e.preventDefault(); box.focus(); return; }
                var first=nodes[0], last=nodes[nodes.length-1];
                if(e.shiftKey && document.activeElement===first){ e.preventDefault(); last.focus(); }
                else if(!e.shiftKey && document.activeElement===last){ e.preventDefault(); first.focus(); }
            });
            window.BESSanctuaryModalEngine={open:openModal,close:closeModal};
        })();
        </script>
        <?php
        return ob_get_clean();
    }
}
