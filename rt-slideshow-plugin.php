<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link               https://github.com/kajalsharma2101
 * @since             1.0.0
 * @package           Rt_Slideshow
 *
 * @wordpress-plugin
 * Plugin Name:       Rtcamp Slider Plugin
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:      Rtcamp Slider Plugin creates an admin-side Menu called "Slideshow". It uses "LightSlider" library for displaying sliders. You can add/remove slides, change the order of slides, control settings of individual sliders and much more.

 * Version:           1.0.0
 * Author:            Kajal Sharma
 * Author URI:        https://github.com/kajalsharma2101
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rt-slideshow_plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rt-slideshow-plugin-activator.php
 */
function activate_rt_slideshow_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rt-slideshow-plugin-activator.php';
	Rt_Slideshow_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rt-slideshow-plugin-deactivator.php
 */
function deactivate_rt_slideshow_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rt-slideshow-plugin-deactivator.php';
	Rt_Slideshow_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rt_slideshow_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_rt_slideshow_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rt-slideshow-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rt_slideshow_plugin() {

	$plugin = new Rt_Slideshow_Plugin();
	$plugin->run();

}
run_rt_slideshow_plugin();
