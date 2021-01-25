<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://cedcoss.com/
 * @since      1.0.0
 *
 * @package    Woo_wholesale_market
 * @subpackage Woo_wholesale_market/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woo_wholesale_market
 * @subpackage Woo_wholesale_market/includes
 * @author     Cedcoss <cedcoss@gmail.com>
 */
class Woo_wholesale_market_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woo_wholesale_market',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
