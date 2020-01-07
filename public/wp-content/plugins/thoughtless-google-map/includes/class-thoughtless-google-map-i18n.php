<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://thoughtlessstore.com
 * @since      1.0.0
 *
 * @package    Thoughtless_Google_Map
 * @subpackage Thoughtless_Google_Map/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Thoughtless_Google_Map
 * @subpackage Thoughtless_Google_Map/includes
 * @author     Thoughtless Developers <admin@example.com>
 */
class Thoughtless_Google_Map_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'thoughtless-google-map',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
