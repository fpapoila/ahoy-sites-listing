<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://revolucaodosbytes.pt
 * @since      1.0.0
 *
 * @package    Ahoy_Sites_Listing
 * @subpackage Ahoy_Sites_Listing/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ahoy_Sites_Listing
 * @subpackage Ahoy_Sites_Listing/includes
 * @author     Revolução dos Bytes <contacto@revolucaodosbytes.pt>
 */
class Ahoy_Sites_Listing_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ahoy-sites-listing',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
