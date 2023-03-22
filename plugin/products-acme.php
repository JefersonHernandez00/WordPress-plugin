<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/JefersonHernandez00
 * @since             1.0.0
 * @package           Products_Acme
 *
 * @wordpress-plugin
 * Plugin Name:       Products ACME
 * Plugin URI:        https://https://github.com/Computan-Tests/wp-jeferson-hernandez
 * Description:       Plugin to generate theme options, create cpt products with custom fields.
 * Version:           1.0.0
 * Author:            Jeferson Hernandez
 * Author URI:        https://https://github.com/JefersonHernandez00
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       products-acme
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PRODUCTS_ACME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-products-acme-activator.php
 */
function activate_products_acme() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-products-acme-activator.php';
	Products_Acme_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-products-acme-deactivator.php
 */
function deactivate_products_acme() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-products-acme-deactivator.php';
	Products_Acme_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_products_acme' );
register_deactivation_hook( __FILE__, 'deactivate_products_acme' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-products-acme.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_products_acme() {

	$plugin = new Products_Acme();
	$plugin->run();

}
run_products_acme();

/**
 * Create a custom post type, taxonomies and custom fields
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-products-properties.php';

/**
 * we upload 5 records to our CPT
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-products-upload.php';


/**
 * Register settings and options for a WordPress plugin
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-products-settings-options.php';


/**
 * Add template for individual display
 */
add_filter( 'single_template', 'products_template_single' );
function products_template_single( $template ) {
    global $post;
    if ( $post->post_type == 'products' ) {
        $template = plugin_dir_path( __FILE__ ) . 'templates/template-products.php';
    }
    return $template;
}


/**
 * Include the template in your plugin file using the WordPress "get_template_part" function:
 */
add_filter( 'archive_template', 'products_template_archive' );
function products_template_archive( $template ) {
    global $post;
    if ( $post->post_type == 'products' ) {
        $template = plugin_dir_path( __FILE__ ) . 'templates/archive-products.php';
    }
    return $template;
}
