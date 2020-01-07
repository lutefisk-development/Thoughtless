<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://thoughtlessstore.com
 * @since      1.0.0
 *
 * @package    Thoughtless_Google_Map
 * @subpackage Thoughtless_Google_Map/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Thoughtless_Google_Map
 * @subpackage Thoughtless_Google_Map/public
 * @author     Thoughtless Developers <admin@example.com>
 */
class Thoughtless_Google_Map_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// Function for registering the shortcodes used by the plugin
		$this->define_shortcodes();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Thoughtless_Google_Map_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Thoughtless_Google_Map_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/thoughtless-google-map-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/thoughtless-google-map-public.js', ['jquery'] , $this->version, true );

		// Enqueueing the script for google maps, with apikey and callback function
		wp_enqueue_script('our-thoughtless-google-map', 'https://maps.googleapis.com/maps/api/js?key='. THOUGHTLESS_GOOGLE_MAP_API_KEY .'&callback=initMap', [], false, true);

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/thoughtless-google-map-public.js', ['jquery'] , $this->version, true );

		// Localizing a script so we get access to variables from php into js
		wp_localize_script( $this->plugin_name, 'thoughtless_google_map_credentials', [
			'username' => THOUGHTLESS_GOOGLE_MAP_USERNAME,
			'password' => THOUGHTLESS_GOOGLE_MAP_PASSWORD,
		]);

	}

	/**
	 * Register shortcodes for Thoughtless Google Map plugin
	 */
	public function define_shortcodes() {
		add_shortcode('tgm', [$this, 'do_shortcode_tgm']);
	}

	/**
	 * Method for handling the logic used by the shortcode 'tgm'
	 */
	public function do_shortcode_tgm($user_atts) {
		// Default attributes
		$default_atts = [
			'title' => 'Thoughtless Map',
		];

		//Combine user attributes with known attributes and fill in defaults when needed
		$atts = shortcode_atts($default_atts, $user_atts, 'tgm');

		// HTML markup for displaying the map
		$output = '<div id="map-wrapper">';
		$output .= '<h1>'. sprintf(__('%s', 'thoughtless-google-map'), $atts['title']) .'</h1>';
		$output .= '<div id="thoughtless-map"></div>';
		$output .= '</div>';

		return $output;

	}

}
