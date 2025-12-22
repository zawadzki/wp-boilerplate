<?php

if (! class_exists('Z_Content_Builder_Shortcode')) {
    class Z_Content_Builder_Shortcode
    {
        public function __construct()
        {
            add_shortcode('content_builder', [$this, 'add_shortcode']);
        }

        public function add_shortcode($atts = [], $content = null, $tag = ''): bool|string
        {
            $atts = array_change_key_case((array) $atts, CASE_LOWER);

            extract(shortcode_atts(['id' => ''], $atts, $tag));

            ob_start();
            $file = trailingslashit(get_template_directory()).'template-parts/z-content-builder-shortcode.php';
            if (file_exists($file)) {
                require trailingslashit(get_template_directory()).'template-parts/z-content-builder-shortcode.php';
            } else {
                require CONTENT_BUILDER_PATH.'views/z-content-builder-shortcode.php';
            }

            return ob_get_clean();
        }
    }
}
