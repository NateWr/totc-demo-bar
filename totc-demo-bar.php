<?php
/**
 * Plugin Name: Demo Bar for Theme of the Crop
 * Plugin URI: http://themeofthecrop.com
 * Description: Display a demo bar for a product on a separate site. Connects to EDD.
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

class totcdbInit {

	/**
	* Name of your EDD store
	*
	* @see config.php
	* @since 0.1
	*/
	public $store_name = '';

	/**
	* URL to your EDD store
	*
	* @see config.php
	* @since 0.1
	*/
	public $store_url = '';

	/**
	* EDD API Public Key
	*
	* @see config.php
	* @since 0.1
	*/
	public $public_key = '';

	/**
	* EDD API Token
	*
	* @see config.php
	* @since 0.1
	*/
	public $token = '';

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

		// Display an admin notice if there's no config file
		if ( !file_exists( self::$plugin_dir . '/config.php' ) ) {
			if ( current_user_can( 'manage_options' ) ) {
				add_action( 'admin_notices', function() {
					?>
					<div class="notice notice-error">
						<p>
							<?php esc_html_e( 'You must create a config file before you can use the Demo Bar plugin.', 'totc-demo-bar' ); ?>
						</p>
					</div>
					<?php
				} );
			}

			return;
		}

		require_once( self::$plugin_dir . '/config.php' );
		$settings = totcdb_config();
		$this->store_name = $settings['store_name'];
		$this->store_url = $settings['store_url'];
		$this->public_key = $settings['public_key'];
		$this->token = $settings['token'];

		// Initialize the plugin
		add_action( 'init', array( $this, 'load_textdomain' ) );

		// Load settings panel
		add_action( 'admin_menu', array( $this, 'load_settings' ), -1 );

		// Add the admin demo bar
		add_action( 'wp_footer', array( $this, 'display_demo_bar' ), 999 );
	}

	/**
	 * Load the plugin textdomain for localistion
	 * @since 0.1.0
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'totc-demo-bar', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
	}


	/**
	 * Load the settings panel
	 *
	 * @since 0.1
	 */
	public function load_settings() {

		require_once( self::$plugin_dir . '/lib/simple-admin-pages/simple-admin-pages.php' );

		$sap = sap_initialize_library(
			array(
				'version' => '2.0',
				'lib_url' => self::$plugin_dir . '/lib/simple-admin-pages/',
				'lib_extension_path' => self::$plugin_dir .'/includes/simple-admin-pages/',
				'debug_mode' => true,
			)
		);

		$sap->add_page(
			'options',
			array(
				'id' => 'totcdb',
				'title' => __( 'Demo Bar Setup', 'totc-demo-bar' ),
				'menu_title' => __( 'Demo Bar', 'totc-demo-bar' ),
				'capability' => 'manage_options',
			)
		);

		$sap->add_section(
			'totcdb',
			array(
				'id' => 'totcdb-setup',
				'title' => __( 'Setup', 'totc-demo-bar' ),
			)
		);

		$sap->add_setting(
			'totcdb',
			'totcdb-setup',
			array(
				'id'		=> 'download_id',
				'filename'	=> 'AdminPageSetting.EDDProduct.class.php',
				'class'		=> 'totcdbAdminPageSettingEDDProduct',
			),
			array(
				'id' => 'download_id',
				'title' => __( 'EDD Download', 'totc-demo-bar' ),
				'description' => sprintf( __( 'Select the EDD Download which this site is demoing. Downloads are being fetched from: %s', 'totc-demo-bar' ), $this->store_url ),
				'store_url' => $this->store_url,
				'public_key' => $this->public_key,
				'token' => $this->token,
			)
		);

		$sap = apply_filters( 'totcdb_settings_page', $sap );

		$sap->add_admin_menus();
	}

	/**
	 * Display the demo bar on the frontend
	 *
	 * @since 0.1
	 */
	public function display_demo_bar() {

		$settings = get_option( 'totcdb', false );

		if ( $settings === false || empty( $settings['download_id'] ) ) {
			return;
		}

		$this->download_id = $settings['download_id'];

		include_once( self::$plugin_dir . '/templates/demo-bar.php' );
	}

}

/**
 * This function returns one totcdbInit instance everywhere
 * and can be used like a global, without needing to declare the global.
 *
 * Example: $totcdb = totcdbInit();
 */
function totcdbInit() {
	return totcdbInit::instance();
}
add_action( 'plugins_loaded', 'totcdbInit' );
