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
 * Plugin Name:       z — admin-theme
 * Plugin URI:        https://zawdam.dev
 * Description:       z — admin-theme plugin
 * Version:           1.0.0
 * Author:            Damian Zawadzki
 * Author URI:        https://zawdam.dev/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       z-admin-theme
 * Domain Path:       /languages
 */
if (! defined('ABSPATH')) {
    exit('Whooops!');
}

if (! class_exists('Z_Admin_Theme')) {
    class Z_Admin_Theme
    {
        public function __construct()
        {
            $this->define_constants();

            require_once Z_ADMIN_THEME_PATH.'admin/class.z-admin-theme-setup.php';
            $Z_Admin_Theme_Setup = new Z_Admin_Theme_Setup;
        }

        public function define_constants(): void
        {
            define('Z_ADMIN_THEME_PATH', plugin_dir_path(__FILE__));
            define('Z_ADMIN_THEME_URL', plugin_dir_url(__FILE__));
            define('Z_ADMIN_THEME_VERSION', '1.0.14');
        }

        public static function activate() {}

        public static function deactivate() {}

        public static function uninstall() {}
    }
}

if (class_exists('Z_Admin_Theme')) {
    register_activation_hook(__FILE__, ['Z_Admin_Theme', 'activate']);
    register_deactivation_hook(__FILE__, ['Z_Admin_Theme', 'deactivate']);
    register_uninstall_hook(__FILE__, ['Z_Admin_Theme', 'uninstall']);
    $z_admin_theme = new Z_Admin_Theme;
}
