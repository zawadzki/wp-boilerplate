<?php

if (! class_exists('Z_Admin_Theme_Setup')) {
    class Z_Admin_Theme_Setup
    {
        public function __construct()
        {
            add_action('admin_head', [$this, 'z_adminbar_theme_style']);
            add_action('wp_head', [$this, 'z_adminbar_theme_style']);

            add_action('admin_enqueue_scripts', [$this, 'z_admin_theme_style'], 100);

            add_action('login_head', [$this, 'z_login_css']);

            add_filter('admin_footer_text', [$this, 'left_admin_footer_text_output']);

            add_filter('update_footer', [$this, 'right_admin_footer_text_output'], 11);

            add_theme_support('editor-styles');
            add_action('admin_init', [$this, 'my_theme_add_editor_styles']);

            add_filter('tiny_mce_before_init', [$this, 'remove_h1_from_heading']);
            add_action('acf/input/admin_footer', [$this, 'my_acf_input_admin_footer']);
        }

        public function z_adminbar_theme_style(): void
        {
            if (is_admin_bar_showing()) {
                wp_enqueue_style('z-adminbar-theme', Z_ADMIN_THEME_URL.'assets/styles/wp-admin-bar.css?cache='.Z_ADMIN_THEME_VERSION);
            }
        }

        public function z_admin_theme_style(): void
        {
            echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_template_directory_uri().'/favicons/favicon.ico" />';
            wp_enqueue_style('z-admin-theme', Z_ADMIN_THEME_URL.'assets/styles/wp-admin.css?cache='.Z_ADMIN_THEME_VERSION);
            if (class_exists('Z_Content_Builder')) {
                wp_enqueue_style('z-admin-theme-content-builder', Z_ADMIN_THEME_URL.'assets/styles/content-builder.css?cache='.Z_ADMIN_THEME_VERSION);
                wp_enqueue_style('z-admin-theme-content-builder-tinymce', Z_ADMIN_THEME_URL.'assets/styles/content-builder-tinymce.css?cache='.Z_ADMIN_THEME_VERSION);
            }
        }

        public function z_login_css(): void
        {
            echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_template_directory_uri().'/favicons/favicon.ico" />';
            wp_enqueue_style('z-admin-login-theme', Z_ADMIN_THEME_URL.'assets/styles/wp-login.css?cache='.Z_ADMIN_THEME_VERSION);
        }

        public function left_admin_footer_text_output(): string
        {
            $year = date('Y');

            return 'FCG APPS &copy; '.$year;
        }

        public function right_admin_footer_text_output(): string
        {
            return 'Motyw wersja 1.0.0';
        }

        public function my_theme_add_editor_styles(): void
        {
            add_editor_style(Z_ADMIN_THEME_URL.'/assets/styles/content-builder-tinymce.css?cache='.Z_ADMIN_THEME_VERSION);
        }

        public function my_acf_input_admin_footer()
        { ?>
            <script type="text/javascript">
                (function($) {
                    acf.add_action('wysiwyg_tinymce_init', function( ed, id, mceInit, $field ){
                        $('#wp-'+id+'-editor-container .mce-statusbar').append('<div class="acfcounter"><span class="words" style="font-size: 11px; padding-right: 10px;"></span><span class="chars" style="font-size: 11px;"></span></div>');
                        const counter = function() {
                            let value = jQuery('#'+id).val();
                            let wordCount = (value.length == 0) ? 0 : value.trim().replace(/\s+/gi, ' ').split(' ').length;
                            let totalChars = value.replace(/(<([^>]+)>)/ig,"").length;

                            jQuery('#wp-'+id+'-editor-container .mce-statusbar .acfcounter .words').html('Liczba słów: '+wordCount);
                            jQuery('#wp-'+id+'-editor-container .mce-statusbar .acfcounter .chars').html('Znaki: '+totalChars);
                        };

                        $('#wp-'+id+'-editor-container .mce-statusbar .acfcounter .words').html('Liczba słów: 0');
                        $('#wp-'+id+'-editor-container .mce-statusbar .acfcounter .chars').html('Znaki: 0');

                        $('#'+id).change(counter);
                        $('#'+id).keydown(counter);
                        $('#'+id).keypress(counter);
                        $('#'+id).keyup(counter);
                        $('#'+id).blur(counter);
                        $('#'+id).focus(counter);
                    });
                })(jQuery);
            </script> <?php
        }

        public function remove_h1_from_heading($args)
        {
            $args['block_formats'] = 'Paragraph=p;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;';

            return $args;
        }
    }
}
