import Swiper from 'swiper';
import { Keyboard, Pagination, Navigation, EffectCreative } from 'swiper/modules';
import { Component, register, bind } from 'ovee.js';

Swiper.use([Keyboard, Pagination, Navigation, EffectCreative]);

@register('ui-slider')
export default class extends Component {
    private swiper: Swiper | null = null;

    init() {
        const speed = Number(this.$element.getAttribute('data-speed') ?? 350);

        const allowTouch = window.matchMedia?.('(pointer: coarse)')?.matches ?? true;

        this.swiper = new Swiper(this.$element as HTMLElement, {
            direction: 'horizontal',
            speed,
            // Keep things smooth
            slidesPerView: 1,
            spaceBetween: 0,
            autoHeight: false,
            resistanceRatio: 0.85,
            roundLengths: true,
            // UX helpers
            mousewheel: { forceToAxis: false, sensitivity: 1 },
            allowTouchMove: allowTouch,
            simulateTouch: allowTouch,
            touchStartPreventDefault: false,
            passiveListeners: true,
            effect: "creative",
            creativeEffect: {
                prev: {
                    shadow: true,
                    translate: [0, 0, -400],
                },
                next: {
                    translate: ["100%", 0, 0],
                },
            },
            navigation: {
                nextEl: this.$element.querySelector<HTMLElement>('.swiper__button--next')!,
                prevEl: this.$element.querySelector<HTMLElement>('.swiper__button--prev')!,
            },
            pagination: {
                clickable: true,
                el: this.$element.querySelector<HTMLElement>('.swiper-pagination')!,
            },
            autoplay: false,
            on: {
                init: () => {
                    this.swiper?.update();
                },
            },
        });
    }

    @bind('resize', { target: window })
    onResize() {
        this.swiper?.update();
    }

    destroy() {
        this.swiper?.destroy(true, true);
        this.swiper = null;
    }
}