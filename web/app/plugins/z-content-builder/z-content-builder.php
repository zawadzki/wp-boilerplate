<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://zawdam.dev
 * @since             1.0.0
 * @package           Z_Content_Builder
 *
 * @wordpress-plugin
 * Plugin Name:       z — content-builder
 * Plugin URI:        https://zawdam.dev/
 * Description:       z — content-builder plugin
 * Version:           1.0.0
 * Author:            Damian Zawadzki
 * Author URI:        https://zawdam.dev/
 * Text Domain:       z-content-builder
 * Domain Path:       /languages
 */

if (! defined('ABSPATH')) {
    exit;
}

if (! class_exists('Z_Content_Builder')) {

    final class Z_Content_Builder
    {
        public function __construct()
        {
            $this->define_constants();
            add_action('plugins_loaded', [$this, 'maybe_boot'], 20);
        }

        private function define_constants(): void
        {
            if (! defined('CONTENT_BUILDER_PATH')) {
                define('CONTENT_BUILDER_PATH', plugin_dir_path(__FILE__));
            }
            if (! defined('CONTENT_BUILDER_URL')) {
                define('CONTENT_BUILDER_URL', plugin_dir_url(__FILE__));
            }
            if (! defined('CONTENT_BUILDER_VERSION')) {
                define('CONTENT_BUILDER_VERSION', '1.0.0');
            }
        }

        /**
         * True if Advanced Custom Fields OR Secure Custom Fields is available.
         */
        private function has_acf_or_scf(): bool
        {
            if (class_exists('ACF') || class_exists('acf')) {
                return true;
            }

            if (
                class_exists('SCF') ||
                class_exists('Secure_Custom_Fields') ||
                class_exists('SecureCustomFields') ||
                class_exists('SCF_Plugin')
            ) {
                return true;
            }

            // Fallback: functions exist in both ACF and SCF forks.
            if (function_exists('acf_add_local_field_group') || function_exists('get_field')) {
                return true;
            }

            return false;
        }

        public function maybe_boot(): void
        {
            if (! $this->has_acf_or_scf()) {
                return;
            }

            // Debug log
            error_log('Booting content builder plugin...');

            $this->boot();
        }

        private function boot(): void
        {
            require_once CONTENT_BUILDER_PATH.'admin/class.z-content-builder-views.php';

            require_once CONTENT_BUILDER_PATH.'admin/class.z-content-builder-cpt.php';
            new Z_Content_Builder_Post_Type;

            require_once CONTENT_BUILDER_PATH.'admin/class.z-content-builder-acf.php';
            new Z_Content_Builder_ACF;

            require_once CONTENT_BUILDER_PATH.'admin/class.z-content-builder-shortcode.php';
            new Z_Content_Builder_Shortcode;
        }
    }
}

new Z_Content_Builder;
