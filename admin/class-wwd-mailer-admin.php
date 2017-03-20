<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wwd_Mailer
 * @subpackage Wwd_Mailer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wwd_Mailer
 * @subpackage Wwd_Mailer/admin
 * @author     Your Name <email@example.com>
 */
class Wwd_Mailer_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wwd_mailer    The ID of this plugin.
	 */
	private $wwd_mailer;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $required_cap;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wwd_mailer       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $wwd_mailer, $version ) {

		$this->wwd_mailer = $wwd_mailer;
		$this->version = $version;
		$this->required_cap = 'manage_options';

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->wwd_mailer, plugin_dir_url( __FILE__ ) . 'css/wwd-mailer-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->wwd_mailer, plugin_dir_url( __FILE__ ) . 'js/wwd-mailer-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Register the setting pages and their menu items
	 */
	public function build_menu() {
		
		
		add_menu_page( 'WWD Mailer', 'Send Mail', $this->required_cap, 'wwd_mailer', array( $this, 'load_main_page' ), plugin_dir_url( __FILE__ ) . 'img/icon.png', '99.68491' );

		add_submenu_page( 'wwd_mailer', 'Settings','SMTP Settings',  $this->required_cap, 'wwd_mailer_settings', array( $this, 'load_settings_page' ));

	}

	/**
	 * Load main page admin area.
	 *
	 * @since    1.0.0
	 */
	public function load_main_page() {

		include( plugin_dir_path( __FILE__ ) . 'partials/wwd-mailer-admin-display.php' );

	}


	/**
	 * Load settings page admin area.
	 *
	 * @since    1.0.0
	 */
	public function load_settings_page() {

		include( plugin_dir_path( __FILE__ ) . 'partials/wwd-mailer-admin-display.php' );

	}

	/**
	 * Creates an instance of the Wwd_Mailer_Mail Class
	 * and starts the mail sending
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function process_email() {
		$mailer = new Wwd_Mailer_Mail();
		$mailer->process_email();
	}	




}
