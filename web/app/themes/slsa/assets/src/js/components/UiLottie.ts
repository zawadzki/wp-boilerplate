import gsap from "gsap";
import { register, Component, bind } from "ovee.js";
import lottie, { AnimationItem } from "lottie-web/build/player/lottie_light";

type LottieRenderer = "svg" | "canvas" | "html";
type StartMode = "auto" | "viewport" | "click" | "manual";

@register("ui-lottie")
export default class extends Component {
    private anim: AnimationItem | null = null;
    private io: IntersectionObserver | null = null;

    private src = "";
    private loop = true;
    private autoplay = true;
    private renderer: LottieRenderer = "svg";
    private startMode: StartMode = "auto";
    private stopOnNextLoop = false;

    private refreshOptions() {
        this.src = this.$element.dataset.lottie || "";
        this.loop = this.parseBool(this.$element.dataset.loop, true);
        this.autoplay = this.parseBool(this.$element.dataset.autoplay, true);
        this.renderer = (this.$element.dataset.renderer || "svg") as LottieRenderer;
        this.startMode = (this.$element.dataset.start || "auto") as StartMode;
    }

    private parseBool(v: string | undefined, fallback: boolean) {
        if (v == null) return fallback;
        return v === "true" || v === "1";
    }

    init() {
        this.refreshOptions();

        if (!this.src) {
            console.warn("[UiLottie] Missing data-lottie:", this.$element);
            return;
        }

        this.mountAnimation();
    }

    destroy() {
        this.teardownViewport();
        this.destroyAnimation();
    }

    // Click anywhere on the component root to start (only when startMode=click)
    @bind("click")
    onClickStart(e: MouseEvent) {
        if (this.startMode !== "click") return;
        e.preventDefault();
        this.play();
    }

    @bind("lottie:play")
    onLottiePlay() {
        this.play();
    }

    @bind("lottie:stop")
    onLottieStop() {
        this.stop();
    }

    @bind("lottie:reset")
    onLottieReset() {
        // first frame, paused
        this.anim?.goToAndStop(0, true);
    }

    @bind("lottie:rewind")
    onLottieRewind() {
        if (!this.anim) return;

        // stop at current frame
        this.anim.pause();

        const total = this.anim.getDuration(true); // frames
        if (!total || !isFinite(total)) {
            // fallback: hard reset
            this.anim.goToAndStop(0, true);
            return;
        }

        const current = this.anim.currentFrame ?? 0;

        // already near start
        if (current <= 1) {
            this.anim.goToAndStop(0, true);
            return;
        }

        const obj = { f: current };

        gsap.to(obj, {
            f: 0,
            duration: 0.35,       // tweak
            ease: "power2.out",   // tweak
            overwrite: true,
            onUpdate: () => {
                this.anim?.goToAndStop(obj.f, true);
            },
            onComplete: () => {
                this.anim?.goToAndStop(0, true);
            },
        });
    }

    @bind("lottie:stop-on-loop")
    onStopOnLoop() {
        if (!this.anim) return;

        // mark intent
        this.stopOnNextLoop = true;

        // ensure it is actually playing so it can reach the loop boundary
        this.anim.play();
    }

    @bind("barba:before", { target: window as any })
    onRouteBefore() {
        this.teardownViewport();
        this.destroyAnimation();
        this.$element.classList.remove("is-lottie-ready");
    }

    @bind("barba:after", { target: window as any })
    onRouteAfter() {
        // If this instance survives (depends on your Barba integration),
        // re-read dataset and re-mount.
        this.refreshOptions();
        if (!this.src) return;
        this.mountAnimation();
    }

    // Public API
    play() { this.anim?.play(); }
    pause() { this.anim?.pause(); }
    stop() { this.anim?.stop(); }
    setSpeed(speed: number) { this.anim?.setSpeed(speed); }

    private mountAnimation() {
        this.teardownViewport();
        this.destroyAnimation();
        this.$element.classList.remove("is-lottie-ready");

        this.anim = lottie.loadAnimation({
            container: this.$element as HTMLElement,
            renderer: this.renderer,
            loop: this.loop,
            autoplay: this.autoplay && this.startMode === "auto",
            path: this.src,
        });

        this.anim.addEventListener("loopComplete", () => {
            if (!this.stopOnNextLoop) return;

            this.stopOnNextLoop = false;
            this.anim?.stop();                 // stops at first frame of next loop
            this.anim?.goToAndStop(0, true);   // ensures exact frame 0
        });

        this.anim.addEventListener("DOMLoaded", () => {
            this.$element.classList.add("is-lottie-ready");
        });

        if (this.startMode === "viewport") {
            this.anim.stop();
            this.setupViewport();
        } else if (this.startMode === "click") {
            this.anim.stop();
        } else if (this.startMode === "manual") {
            this.anim.stop();
        } else {
            if (this.autoplay) this.anim.play();
        }
    }

    private destroyAnimation() {
        if (!this.anim) return;
        try {
            this.anim.destroy();
        } catch {
            // ignore
        }
        this.anim = null;
    }

    private setupViewport() {
        if (!("IntersectionObserver" in window)) {
            this.play();
            return;
        }

        this.io = new IntersectionObserver(
            ([entry]) => {
                if (entry?.isIntersecting) {
                    this.play();
                    this.teardownViewport();
                }
            },
            { threshold: 0.25 }
        );

        this.io.observe(this.$element as HTMLElement);
    }

    private teardownViewport() {
        if (!this.io) return;
        this.io.disconnect();
        this.io = null;
    }
}
