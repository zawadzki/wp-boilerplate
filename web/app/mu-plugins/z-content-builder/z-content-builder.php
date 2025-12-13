<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://zawdam.dev
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       z — content-builder
 * Plugin URI:        https://zawdam.dev/
 * Description:       z — content-builder plugin
 * Version:           1.0.0
 * Author:            Damian Zawadzki
 * Author URI:        https://zawdam.dev/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       z-content-builder
 * Domain Path:       /languages
 */
if (! defined('ABSPATH')) {
    exit('Whooops!');
}

if (! class_exists('Z_Content_Builder')) {
    class Z_Content_Builder
    {
        public function __construct()
        {
            $this->define_constants();

            require_once CONTENT_BUILDER_PATH.'admin/class.z-content-builder-cpt.php';
            $Z_Content_Builder_Post_Type = new Z_Content_Builder_Post_Type;

            require_once CONTENT_BUILDER_PATH.'admin/class.z-content-builder-acf.php';
            $Z_Content_Builder_ACF = new Z_Content_Builder_ACF;

            require_once CONTENT_BUILDER_PATH.'admin/class.z-content-builder-shortcode.php';
            $Z_Content_Builder_Shortcode = new Z_Content_Builder_Shortcode;
        }

        public function define_constants(): void
        {
            define('CONTENT_BUILDER_PATH', plugin_dir_path(__FILE__));
            define('CONTENT_BUILDER_URL', plugin_dir_url(__FILE__));
            define('CONTENT_BUILDER_VERSION', '1.0.0');
        }

        public static function activate(): void
        {
            update_option('rewrite_rules', '');
        }

        public static function init() {}

        public static function deactivate(): void
        {
            flush_rewrite_rules();
            unregister_post_type('aktualnosci');
        }

        public static function uninstall() {}
    }
}

if (class_exists('Z_Content_Builder')) {
    register_activation_hook(__FILE__, ['Z_Content_Builder', 'activate']);
    register_deactivation_hook(__FILE__, ['Z_Content_Builder', 'deactivate']);
    register_uninstall_hook(__FILE__, ['Z_Content_Builder', 'uninstall']);
    $content_builder = new Z_Content_Builder;
}
