import { register, Component, bind } from "ovee.js";

@register("ui-nav-autohide")
export default class extends Component {
    private header: HTMLElement | null = null;
    private lastY = 0;
    private enabled = false;
    private threshold = 6;

    private body: HTMLElement = document.body;
    private html: HTMLElement = document.documentElement;

    private scrollTimeout: number | null = null;
    private rafId: number | null = null;
    private isMoving = false;
    private ticking = false;

    // Cache header dimensions
    private headerBottom = 0;
    private resizeObserver: ResizeObserver | null = null;

    init() {
        if (document.readyState === "complete") {
            this.onPageLoaded();
        }

        this.header = document.querySelector<HTMLElement>(".l-header");
        this.lastY = window.scrollY;

        // Always visible on load
        this.body.classList.remove("is-nav-hidden", "is-scrolled");

        // Cache header dimensions and observe changes
        this.updateHeaderDimensions();
        this.observeHeaderResize();
    }

    private updateHeaderDimensions() {
        if (!this.header) return;
        this.headerBottom = this.header.offsetTop + this.header.offsetHeight;
    }

    private observeHeaderResize() {
        if (!this.header || !('ResizeObserver' in window)) return;

        this.resizeObserver = new ResizeObserver(() => {
            this.updateHeaderDimensions();
        });

        this.resizeObserver.observe(this.header);
    }

    @bind("scroll", { target: window, passive: true })
    onScroll() {
        if (!this.header) return;

        // Use RAF to throttle scroll handler
        if (this.ticking) return;

        this.ticking = true;
        this.rafId = requestAnimationFrame(() => {
            this.handleScroll();
            this.ticking = false;
        });
    }

    private handleScroll() {
        const y = window.scrollY;
        const dy = y - this.lastY;

        // Use cached header bottom value
        const pastHeader = y > this.headerBottom;

        // ---- Batch DOM updates ----
        // Toggle persistent state
        if (pastHeader !== this.body.classList.contains("is-scrolled")) {
            this.body.classList.toggle("is-scrolled", pastHeader);
        }

        if (!pastHeader) {
            // Above header → always show nav
            if (this.body.classList.contains("is-nav-hidden")) {
                this.body.classList.remove("is-nav-hidden");
            }
            this.enabled = false;
            this.lastY = y;
            return;
        }

        this.enabled = true;

        // Check threshold before updating
        if (Math.abs(dy) < this.threshold) {
            this.lastY = y;
            return;
        }

        // Batch class updates
        const shouldHide = dy > 0;
        const isHidden = this.body.classList.contains("is-nav-hidden");

        if (shouldHide !== isHidden) {
            this.body.classList.toggle("is-nav-hidden", shouldHide);
        }

        this.lastY = y;

        // Handle moving state
        if (!this.isMoving) {
            this.isMoving = true;
            this.body.classList.add("is-moving");
        }

        // Debounce moving state removal
        if (this.scrollTimeout) {
            window.clearTimeout(this.scrollTimeout);
        }

        this.scrollTimeout = window.setTimeout(() => {
            this.isMoving = false;
            this.body.classList.remove("is-moving");
            this.scrollTimeout = null;
        }, 120);
    }

    // ---- Page fully loaded ----
    @bind("load", { target: window })
    onPageLoad() {
        this.onPageLoaded();
    }

    // ---- Barba lifecycle parity ----
    @bind("barba:before", { target: window as any })
    onRouteBefore() {
        // Cancel any pending operations
        if (this.rafId) {
            cancelAnimationFrame(this.rafId);
            this.rafId = null;
        }

        if (this.scrollTimeout) {
            window.clearTimeout(this.scrollTimeout);
            this.scrollTimeout = null;
        }

        // Reset transient states
        this.body.classList.remove("is-moving");
        this.ticking = false;
    }

    @bind("barba:after", { target: window as any })
    onRouteAfter() {
        // Refresh header reference and dimensions
        this.header = document.querySelector<HTMLElement>(".l-header");
        this.updateHeaderDimensions();
        this.onPageLoaded();
    }

    private onPageLoaded() {
        this.body.classList.add("is-page-loaded");
    }

    destroy() {
        // Clean up RAF and timers
        if (this.rafId) {
            cancelAnimationFrame(this.rafId);
            this.rafId = null;
        }

        if (this.scrollTimeout) {
            window.clearTimeout(this.scrollTimeout);
            this.scrollTimeout = null;
        }

        // Clean up ResizeObserver
        if (this.resizeObserver) {
            this.resizeObserver.disconnect();
            this.resizeObserver = null;
        }

        // Reset classes
        this.body.classList.remove("is-nav-hidden", "is-scrolled", "is-moving");

        this.header = null;
    }
}