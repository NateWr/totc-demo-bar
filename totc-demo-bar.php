<?php
/**
 * Plugin Name: Demo Bar for Theme of the Crop
 * Plugin URI: http://themeofthecrop.com
 * Description: Display a demo bar for a product on a third-party site. Connects to EDD.
 * Version: 0.1.0
 * Author: Theme of the Crop
 * Author URI: http://themeofthecrop.com
 * License:     GNU General Public License v2.0 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain: totc-demo-bar
 * Domain Path: /languages/
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

if ( !class_exists( 'totcdbInit' ) ) {
class totcdbInit {

	/**
	 * The single instance of this class
	 */
	private static $instance;

	/**
	 * Path to the plugin directory
	 */
	static $plugin_dir;

	/**
	 * URL to the plugin
	 */
	static $plugin_url;

	/**
	 * Create or retrieve the single instance of the class
	 *
	 * @since 0.1
	 */
	public static function instance() {

		if ( !isset( self::$instance ) ) {

			self::$instance = new totcdbInit();

			self::$plugin_dir = untrailingslashit( plugin_dir_path( __FILE__ ) );
			self::$plugin_url = untrailingslashit( plugin_dir_url( __FILE__ ) );

			self::$instance->init();
		}

		return self::$instance;
	}

	/**
	 * Initialize the plugin and register hooks
	 */
	public function init() {

		// Initialize the plugin
		add_action( 'init', array( $this, 'load_config' ) );
		add_action( 'init', array( $this, 'load_textdomain' ) );

	}

	/**
	 * Load the plugin's configuration settings and default content
	 * @since 0.1.0
	 */
	public function load_config() {	}

	/**
	 * Load the plugin textdomain for localistion
	 * @since 0.1.0
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'totc-demo-bar', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
	}

}
} // endif;

/**
 * This function returns one totcdbInit instance everywhere
 * and can be used like a global, without needing to declare the global.
 *
 * Example: $totcdb = totcdbInit();
 */
if ( !function_exists( 'totcdbInit' ) ) {
function totcdbInit() {
	return totcdbInit::instance();
}
add_action( 'plugins_loaded', 'totcdbInit' );
} // endif;
