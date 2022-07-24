<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/kajalsharma2101
 * @since      1.0.0
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/public
 * @author     Kajal Sharma <sharmakajal2101@gmail.com>
 */
class Rt_Slideshow_Plugin_Public{

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

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function wp_enqueue_styles() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Rt_Slideshow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rt_Slideshow_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name . '-dependency-slider', plugins_url( '../node_modules/lightslider/dist/css/lightslider.min.css', __FILE__ ), array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rt-slideshow-plugin-public.css', array(), $this->version, 'all' );
	}

		/**
		 * Register the JavaScript for the public-facing side of the site.
		 *
		 * @since    1.0.0
		 */
	public function wp_enqueue_scripts() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Rt_Slideshow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rt_Slideshow_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( $this->plugin_name . '-dependency-slider', plugins_url( '../node_modules/lightslider/dist/js/lightslider.min.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rt-slideshow-plugin-public.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ) );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function add_shortcode() {

		/**
		 * Displays slider when shortcode is called.
		 *
		 * @param      array  $atts       The attributes provied to shortcode.
		 * @param      string $content    The content to display.
		 *
		 * @since    1.0.0
		 */
		function shortcode( $atts = [], $content = null ) {

			$content .= Rt_Slideshow_Plugin_Public::display_slider_preview();
			return $content;

		}

		add_shortcode( 'rtcamp-slideshow', 'shortcode' );

	}

		/**
		 * Displays slider whenever called.
		 *
		 * @since    1.0.0
		 */
	public static function display_slider_preview() {

		// Start output buffering.
		ob_start();

		include_once 'partials/rt-slideshow-plugin-slider.php';

		// End output buffer and return it.
		return ob_get_clean();
	}

}
