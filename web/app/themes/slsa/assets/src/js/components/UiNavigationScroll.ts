import { register, Component, bind } from "ovee.js";
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

@register("ui-navigation-scroll")
export default class extends Component {
    private logo!: HTMLElement | null;
    private title!: HTMLElement | null;
    private links!: HTMLElement | null;

    private tl: gsap.core.Timeline | null = null;
    private mm: gsap.MatchMedia | null = null;

    private isScrollComplete = false;
    private rafId: number | null = null;

    init() {
        this.refreshRefs();
        if (!this.logo || !this.links) return;

        // Force GPU acceleration on animated elements
        this.enableHardwareAcceleration();
        this.createResponsiveTimelines();
    }

    destroy() {
        this.tl?.kill();
        this.tl = null;

        this.mm?.revert();
        this.mm = null;

        if (this.rafId) {
            cancelAnimationFrame(this.rafId);
            this.rafId = null;
        }

        // Clean up will-change
        this.disableHardwareAcceleration();
    }

    private enableHardwareAcceleration() {
        if (this.logo) {
            gsap.set(this.logo, {
                force3D: true,
                willChange: "transform"
            });
        }
        if (this.links) {
            gsap.set(this.links, {
                force3D: true,
                willChange: "transform"
            });
        }
        if (this.title) {
            gsap.set(this.title, {
                force3D: true,
                willChange: "opacity"
            });
        }
    }

    private disableHardwareAcceleration() {
        const elements = [this.logo, this.links, this.title].filter(Boolean);
        elements.forEach(el => {
            if (el) gsap.set(el, { clearProps: "willChange" });
        });
    }

    private refreshRefs() {
        this.logo  = document.querySelector(".l-navigation__logo");
        this.title = document.querySelector(".l-navigation__logo__title");
        this.links = document.querySelector(".l-navigation__links");
    }

    private createResponsiveTimelines() {
        // Ensure we don't accumulate multiple media contexts
        this.mm?.revert();
        this.mm = gsap.matchMedia();

        // Mobile: logo ends up at 20px left / 32px top
        this.mm.add("(max-width: 767px)", () => {
            this.createTimeline({
                targetTop: 32,
                targetLeft: 20,
                targetRight: 20,
                targetLogoW: 200,
            });

            return () => {
                this.tl?.kill();
                this.tl = null;
            };
        });

        // Desktop: previous spacing
        this.mm.add("(min-width: 768px)", () => {
            this.createTimeline({
                targetTop: 40,
                targetLeft: 40,
                targetRight: 40,
                targetLogoW: 200,
            });

            return () => {
                this.tl?.kill();
                this.tl = null;
            };
        });
    }

    private createTimeline(opts: {
        targetTop: number;
        targetLeft: number;
        targetRight: number;
        targetLogoW: number;
    }) {
        if (!this.logo || !this.links) return;

        const { targetTop, targetLeft, targetRight, targetLogoW } = opts;

        // Kill previous timeline
        this.tl?.kill();
        this.tl = null;

        // Reset transforms for measurement
        gsap.set([this.logo, this.links, this.title], { clearProps: "transform" });

        const logoRect = this.logo.getBoundingClientRect();
        const linksRect = this.links.getBoundingClientRect();

        const targetScale = targetLogoW / logoRect.width;
        const vw = window.innerWidth;
        const finalLinksRight = vw - targetRight;

        // Calculate initial offsets
        const logoInitialX = logoRect.left - targetLeft;
        const logoInitialY = logoRect.top - targetTop;
        const linksInitialX = linksRect.right - finalLinksRight;
        const linksInitialY = linksRect.top - targetTop;

        // Pin with initial transforms - using translate3d for better performance
        gsap.set(this.logo, {
            position: "fixed",
            top: targetTop,
            left: targetLeft,
            zIndex: 1000,
            margin: 0,
            transformOrigin: "0 0",
            x: logoInitialX,
            y: logoInitialY,
            scale: 1,
            force3D: true,
        });

        gsap.set(this.links, {
            position: "fixed",
            top: targetTop,
            right: targetRight,
            zIndex: 999,
            margin: 0,
            transformOrigin: "0 0",
            x: linksInitialX,
            y: linksInitialY,
            force3D: true,
        });

        // Optimized scroll end calculation
        const scrollDistance = window.innerHeight * 0.50;

        this.tl = gsap.timeline({
            defaults: {
                ease: "none", // Use linear for scrub animations
            },
            scrollTrigger: {
                trigger: document.documentElement,
                start: "top top",
                end: `+=${scrollDistance}`,
                scrub: 0.8, // Reduced scrub for snappier feel
                invalidateOnRefresh: true,
                fastScrollEnd: true, // Better performance on fast scrolls
                preventOverlaps: true,

                onUpdate: (self) => {
                    // Use RAF to batch DOM operations
                    if (this.rafId) return;

                    this.rafId = requestAnimationFrame(() => {
                        this.rafId = null;
                        const atEnd = self.progress >= 0.995;

                        if (atEnd && !this.isScrollComplete) {
                            this.isScrollComplete = true;
                            this.dispatchLottieEvent("lottie:stop-on-loop");
                        } else if (!atEnd && this.isScrollComplete) {
                            this.isScrollComplete = false;
                            this.dispatchLottieEvent("lottie:play");
                        }
                    });
                },
            },
        });

        // LOGO - animate to final position
        this.tl.to(
            this.logo,
            {
                x: 0,
                y: 0,
                scale: targetScale,
                force3D: true,
            },
            0
        );

        // LINKS - animate to final position
        this.tl.to(
            this.links,
            {
                x: 0,
                y: 0,
                force3D: true,
            },
            0
        );

        // TITLE fade - optimized with autoAlpha (visibility + opacity)
        if (this.title) {
            this.tl.to(
                this.title,
                {
                    autoAlpha: 0,
                    duration: 0.25,
                },
                0.05
            );
        }

        // Kick lottie once scrolling starts
        this.tl.call(
            () => this.dispatchLottieEvent("lottie:play"),
            [],
            0.02
        );
    }

    // Helper method to reduce redundancy and improve performance
    private dispatchLottieEvent(eventName: string) {
        const lottieEl = this.logo?.querySelector(".ui-lottie");
        if (lottieEl) {
            lottieEl.dispatchEvent(new CustomEvent(eventName, { bubbles: true }));
        }
    }

    @bind("mouseenter", { target: ".l-navigation__logo" })
    onLogoEnter() {
        if (!this.isScrollComplete) return;
        this.dispatchLottieEvent("lottie:play");
    }

    @bind("mouseleave", { target: ".l-navigation__logo" })
    onLogoLeave() {
        if (!this.isScrollComplete) return;
        this.dispatchLottieEvent("lottie:stop-on-loop");
    }

    // ---- Barba parity ----
    @bind("barba:before", { target: window as any })
    onRouteBefore() {
        if (this.rafId) {
            cancelAnimationFrame(this.rafId);
            this.rafId = null;
        }

        this.tl?.kill();
        this.tl = null;

        this.mm?.revert();
        this.mm = null;

        this.disableHardwareAcceleration();
    }

    @bind("barba:after", { target: window as any })
    onRouteAfter() {
        this.refreshRefs();
        if (!this.logo || !this.links) return;
        this.enableHardwareAcceleration();
        this.createResponsiveTimelines();
    }
}