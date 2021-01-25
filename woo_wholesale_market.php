<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://cedcoss.com/
 * @since             1.0.0
 * @package           Woo_wholesale_market
 *
 * @wordpress-plugin
 * Plugin Name:       WooWholeSale_Market
 * Plugin URI:        cedcoss
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Cedcoss
 * Author URI:        https://cedcoss.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo_wholesale_market
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
define( 'WOO_WHOLESALE_MARKET_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo_wholesale_market-activator.php
 */
function activate_woo_wholesale_market() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo_wholesale_market-activator.php';
	Woo_wholesale_market_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo_wholesale_market-deactivator.php
 */
function deactivate_woo_wholesale_market() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo_wholesale_market-deactivator.php';
	Woo_wholesale_market_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_wholesale_market' );
register_deactivation_hook( __FILE__, 'deactivate_woo_wholesale_market' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo_wholesale_market.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_wholesale_market() {

	$plugin = new Woo_wholesale_market();
	$plugin->run();

}
run_woo_wholesale_market();
