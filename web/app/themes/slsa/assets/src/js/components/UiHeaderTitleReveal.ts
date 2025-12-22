import { register, Component, bind } from "ovee.js";
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

@register("ui-header-title-reveal")
export default class extends Component {
    private title: HTMLElement | null = null;
    private btn: HTMLElement | null = null;
    private tl: gsap.core.Timeline | null = null;

    init() {
        this.title = this.$element.querySelector<HTMLElement>(".l-header__title");
        this.btn = this.$element.querySelector<HTMLElement>(".l-header__scroll-btn");
        if (!this.title) return;

        // Enable hardware acceleration upfront
        gsap.set(this.title, {
            autoAlpha: 0,
            y: 80,
            force3D: true,
            willChange: "transform, opacity",
        });

        if (this.btn) {
            gsap.set(this.btn, {
                force3D: true,
                willChange: "opacity",
            });
        }

        // Pre-calculate scroll distances
        const vh = window.innerHeight;
        const startOffset = vh * 0.25;
        const endOffset = vh * 0.45;

        this.tl = gsap.timeline({
            defaults: {
                ease: "none", // Linear for scrub animations
            },
            scrollTrigger: {
                trigger: document.documentElement,
                start: `top+=${startOffset} top`,
                end: `top+=${endOffset} top`,
                scrub: 0.5, // Reduced for snappier feel
                invalidateOnRefresh: true,
                fastScrollEnd: true,
                preventOverlaps: true,
            },
        });

        this.tl.to(this.title, {
            autoAlpha: 1,
            y: 0,
            force3D: true,
            duration: 1,
        });

        if (this.btn) {
            this.tl.to(
                this.btn,
                {
                    autoAlpha: 0,
                    duration: 0.25,
                },
                0.05
            );
        }
    }

    destroy() {
        this.tl?.kill();
        this.tl = null;

        // Clear GPU-accelerated properties
        const elements = [this.title, this.btn].filter(Boolean);
        elements.forEach(el => {
            if (el) gsap.set(el, { clearProps: "all" });
        });

        this.title = null;
        this.btn = null;
    }

    // ---- Barba parity ----
    @bind("barba:before", { target: window as any })
    onRouteBefore() {
        this.tl?.kill();
        this.tl = null;
    }

    @bind("barba:after", { target: window as any })
    onRouteAfter() {
        this.init();
    }
}