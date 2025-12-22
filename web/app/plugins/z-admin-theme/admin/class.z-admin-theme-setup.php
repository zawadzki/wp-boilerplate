<?php
declare(strict_types=1);

if (! class_exists('Z_Admin_Theme_Setup')) {
    class Z_Admin_Theme_Setup
    {
        public function __construct()
        {
            add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets'], 100);
            add_action('login_enqueue_scripts', [$this, 'enqueue_login_assets']);

            add_action('wp_enqueue_scripts', [$this, 'enqueue_adminbar_assets']);
            add_action('admin_enqueue_scripts', [$this, 'enqueue_adminbar_assets'], 5);

            add_action('after_setup_theme', [$this, 'setup_editor_styles']);

            add_filter('admin_footer_text', [$this, 'left_admin_footer_text_output']);
            add_filter('update_footer', [$this, 'right_admin_footer_text_output'], 11);

            add_action('admin_enqueue_scripts', [$this, 'enqueue_media_modal_assets'], 20);
            add_action('wp_enqueue_scripts', [$this, 'enqueue_media_modal_assets'], 20);

            add_action('admin_enqueue_scripts', [$this, 'enqueue_classic_editor_ui_assets'], 30);

            add_filter('tiny_mce_before_init', [$this, 'tiny_mce_init']);
            add_action('acf/input/admin_footer', [$this, 'acf_wysiwyg_counter_script']);

            add_filter('get_site_icon_url', [$this, 'favicon_fallback'], 10, 3);
        }

        private function asset(string $relative): string
        {
            $url = Z_ADMIN_THEME_URL.ltrim($relative, '/');
            $path = Z_ADMIN_THEME_PATH.ltrim($relative, '/');

            $ver = is_file($path) ? (string) filemtime($path) : (string) Z_ADMIN_THEME_VERSION;

            return add_query_arg('ver', $ver, $url);
        }

        private function enqueue_base(string $context): void
        {
            wp_enqueue_style(
                "z-admin-base-{$context}",
                $this->asset('assets/styles/base.css'),
                [],
                null
            );
        }

        public function enqueue_admin_assets(): void
        {
            $this->enqueue_base('admin');

            wp_enqueue_style(
                'z-admin-theme',
                $this->asset('assets/styles/wp-admin.css'),
                ['z-admin-base-admin'],
                null
            );

            if (class_exists('ACF') || function_exists('acf')) {
                wp_enqueue_style(
                    'z-admin-acf-theme',
                    $this->asset('assets/styles/acf-theme.css'),
                    ['z-admin-theme'],
                    null
                );
            }
        }

        public function enqueue_login_assets(): void
        {
            $this->enqueue_base('login');

            wp_enqueue_style(
                'z-admin-login',
                $this->asset('assets/styles/wp-login.css'),
                ['z-admin-base-login'],
                null
            );
        }

        public function enqueue_adminbar_assets(): void
        {
            if (! is_admin_bar_showing()) {
                return;
            }

            $ctx = is_admin() ? 'adminbar-admin' : 'adminbar-frontend';

            $this->enqueue_base($ctx);

            wp_enqueue_style(
                'z-admin-bar',
                $this->asset('assets/styles/wp-admin-bar.css'),
                ["z-admin-base-{$ctx}"],
                null
            );
        }

        public function setup_editor_styles(): void
        {
            add_theme_support('editor-styles');

            // Styles editor iframe (classic + block editor)
            add_editor_style($this->asset('assets/styles/wp-tinymce.css'));
        }

        public function tiny_mce_init(array $init): array
        {
            $init['block_formats'] = 'Paragraph=p;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;';

            $css = $this->asset('assets/styles/wp-tinymce.css');

            if (! empty($init['content_css'])) {
                $init['content_css'] .= ','.$css;
            } else {
                $init['content_css'] = $css;
            }

            return $init;
        }

        public function enqueue_media_modal_assets(): void
        {
            // Frontend: only load when admin bar is visible (usually meaning logged-in and can access admin).
            // If you need it for frontend ACF forms even without admin bar, change this condition.
            if (! is_admin() && ! is_admin_bar_showing()) {
                return;
            }

            // Makes sure WP registers media scripts/styles incl. 'media-views'
            wp_enqueue_media();

            wp_enqueue_style(
                'z-wp-modal',
                $this->asset('assets/styles/wp-modal.css'),
                ['media-views', 'z-admin-theme'],
                null
            );
        }

        public function enqueue_classic_editor_ui_assets(): void
        {
            if (! function_exists('get_current_screen')) {
                return;
            }

            $screen = get_current_screen();
            if (! $screen) {
                return;
            }

            // Only post editor screens
            if (! in_array($screen->base, ['post', 'post-new'], true)) {
                return;
            }

            // If this screen is Block Editor, bail (we only want Classic Editor UI)
            if (method_exists($screen, 'is_block_editor') && $screen->is_block_editor()) {
                return;
            }

            $ctx = 'classic-editor';
            $this->enqueue_base($ctx);

            // Build deps safely (some handles may not exist on every WP build/plugins)
            $deps = ["z-admin-base-{$ctx}", 'wp-admin'];
            if (wp_style_is('editor-buttons', 'registered')) {
                $deps[] = 'editor-buttons';
            }

            wp_enqueue_style(
                'z-classic-editor-ui',
                $this->asset('assets/styles/wp-editor.css'),
                $deps,
                null
            );
        }

        public function favicon_fallback(string $url, int $size, int $blog_id): string
        {
            return $url ?: (get_template_directory_uri().'/favicons/favicon.ico');
        }

        public function left_admin_footer_text_output(): string
        {
            return 'FCG APPS &copy; '.date('Y');
        }

        public function right_admin_footer_text_output(): string
        {
            return 'Motyw wersja '.Z_ADMIN_THEME_VERSION;
        }

        public function acf_wysiwyg_counter_script(): void
        {
            ?>
            <script>
                (function () {
                    if (typeof window.acf === "undefined") return;

                    window.acf.add_action("wysiwyg_tinymce_init", function (ed, id) {
                        if (!ed || !id) return;

                        const container = document.querySelector(`#wp-${id}-editor-container`);
                        if (!container) return;

                        const status = container.querySelector(".mce-statusbar");
                        if (!status) return;

                        if (status.querySelector(".acfcounter")) return;

                        const counter = document.createElement("div");
                        counter.className = "acfcounter";

                        const wordsEl = document.createElement("span");
                        wordsEl.className = "words";

                        const charsEl = document.createElement("span");
                        charsEl.className = "chars";

                        counter.append(wordsEl, charsEl);
                        status.appendChild(counter);

                        const strip = (html = "") =>
                            html
                                .replace(/<[^>]+>/g, "")
                                .replace(/&nbsp;/g, " ")
                                .trim();

                        const countWords = (text = "") => {
                            const t = text.trim().replace(/\s+/g, " ");
                            return t ? t.split(" ").length : 0;
                        };

                        const update = () => {
                            const text = strip(ed.getContent({ format: "raw" }) || "");
                            wordsEl.textContent = `Word count: ${countWords(text)}`;
                            charsEl.textContent = `Characters: ${text.replace(/\s+/g, "").length}`;
                        };

                        ed.on("keyup change SetContent undo redo", update);
                        update();
                    });
                })();
            </script>
            <?php
        }
    }
}
