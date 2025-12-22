<?php

/**
 * View loader for z-content-builder
 * Allows theme overrides and keeps templates clean.
 */
if (! defined('ABSPATH')) {
    exit;
}

if (! class_exists('Z_Content_Builder_Views')) {

    final class Z_Content_Builder_Views
    {
        /**
         * Locate a view file with override support.
         *
         * Lookup order:
         * 1) Child theme:  /z-content-builder/{relative}
         * 2) Parent theme: /z-content-builder/{relative}
         * 3) Plugin:       /views/{relative}
         */
        public static function locate(string $relative): string
        {
            $relative = ltrim($relative, '/');

            $theme_rel = 'z-content-builder/'.$relative;

            // Child theme
            $child = trailingslashit(get_stylesheet_directory()).$theme_rel;
            if (file_exists($child)) {
                return $child;
            }

            // Parent theme
            $parent = trailingslashit(get_template_directory()).$theme_rel;
            if (file_exists($parent)) {
                return $parent;
            }

            // Plugin fallback
            $plugin = trailingslashit(CONTENT_BUILDER_PATH).'views/'.$relative;
            if (file_exists($plugin)) {
                return $plugin;
            }

            return '';
        }

        /**
         * Render a view file.
         */
        public static function render(string $relative, array $args = []): void
        {
            $file = self::locate($relative);

            if (! $file) {
                return;
            }

            // Make $args variables available in the view
            if (! empty($args)) {
                extract($args, EXTR_SKIP);
            }

            include $file;
        }
    }
}
