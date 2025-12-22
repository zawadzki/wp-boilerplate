<?php

if (! class_exists('Z_Content_Builder_ACF')) {
    class Z_Content_Builder_ACF
    {
        public function __construct()
        {
            add_action('template_include', [$this, 'cc_links_init_template_logic']);
            add_action('acf/settings/load_json', [$this, 'my_acf_json_load_point']);

            // Remove 'Post' post type
            add_action('admin_bar_menu', [$this, 'remove_default_post_type_menu_bar'], 999);
            add_action('wp_dashboard_setup', [$this, 'remove_draft_widget'], 999);
            add_action('admin_menu', [$this, 'remove_default_post_type']);
        }

        public function my_acf_json_load_point($paths)
        {
            $paths[] = CONTENT_BUILDER_PATH.'assets/acf-json';

            return $paths;
        }

        public function cc_links_init_template_logic($original_template)
        {
            $file_archive = trailingslashit(get_template_directory()).'archive-news.php';
            $file_singular = trailingslashit(get_template_directory()).'single-news.php';

            if (is_post_type_archive('aktualnosci')) {
                if (file_exists($file_archive)) {
                    return trailingslashit(get_template_directory()).'archive-news.php';
                } else {
                    return CONTENT_BUILDER_PATH.'/views/archive-news.php';
                }
            } elseif (is_singular('aktualnosci')) {
                if (file_exists($file_singular)) {
                    return trailingslashit(get_template_directory()).'single-news.php';
                } else {
                    return CONTENT_BUILDER_PATH.'/views/single-news.php';
                }
            }

            return $original_template;
        }

        public function remove_draft_widget()
        {
            remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
        }

        public function remove_default_post_type()
        {
            remove_menu_page('edit.php');
        }

        public function remove_default_post_type_menu_bar($wp_admin_bar)
        {
            $wp_admin_bar->remove_node('new-post');
        }
    }
}
