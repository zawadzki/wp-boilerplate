import { register, Component, bind } from "ovee.js";

type ScrollBlock = "start" | "center" | "end" | "nearest";
@register("ui-scroll-to-target")
export default class extends Component {
    private target: HTMLElement | null = null;
    private targetSelector = "#main";
    private block: ScrollBlock = "start";

    private readonly breakpoint = 1440;

    init() {
        const el = this.$element as HTMLElement;
        const isSmall = window.innerWidth <= this.breakpoint;

        // ---- TARGET ----
        const targetDesktop = el.dataset.target?.trim();
        const targetSmall = el.dataset.targetSm?.trim();

        this.targetSelector = (
            isSmall
                ? targetSmall || targetDesktop
                : targetDesktop
        ) || "#main";

        // ---- BLOCK ----
        const blockDesktop = el.dataset.block as ScrollBlock | undefined;
        const blockSmall = el.dataset.blockSm as ScrollBlock | undefined;

        const block = isSmall
            ? blockSmall || blockDesktop
            : blockDesktop;

        this.block =
            block && ["start", "center", "end"].includes(block)
                ? block
                : "start";

        this.target = document.querySelector<HTMLElement>(this.targetSelector);
    }

    @bind("click")
    onClick(e: Event) {
        if (!this.target) return;

        e.preventDefault();

        this.target.scrollIntoView({
            behavior: "smooth",
            block: this.block,
        });
    }

    // ---- Barba parity ----
    @bind("barba:before", { target: window as any })
    onRouteBefore() {
        this.target = null;
    }

    @bind("barba:after", { target: window as any })
    onRouteAfter() {
        this.init();
    }
}