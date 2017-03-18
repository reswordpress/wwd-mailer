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

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wwd_Mailer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wwd_Mailer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->wwd_mailer, plugin_dir_url( __FILE__ ) . 'css/wwd-mailer-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wwd_Mailer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wwd_Mailer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->wwd_mailer, plugin_dir_url( __FILE__ ) . 'js/wwd-mailer-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Register the setting pages and their menu items
	 */
	public function build_menu() {
		
		$menu_items = array(
			'general' => array(
				'title' => __( 'MailChimp API Settings', 'mailchimp-for-wp' ),
				'text' => __( 'MailChimp', 'mailchimp-for-wp' ),
				'slug' => '',
				'callback' => array( $this, 'show_generals_setting_page' ),
				'position' => 0
			),
			'other' => array(
				'title' => __( 'Other Settings', 'mailchimp-for-wp' ),
				'text' => __( 'Other', 'mailchimp-for-wp' ),
				'slug' => 'other',
				'callback' => array( $this, 'show_other_setting_page' ),
				'position' => 90
			)
		);

		/**
		 * Filters the menu items to appear under the main menu item.
		 *
		 * To add your own item, add an associative array in the following format.
		 *
		 * $menu_items[] = array(
		 *     'title' => 'Page title',
		 *     'text'  => 'Menu text',
		 *     'slug' => 'Page slug',
		 *     'callback' => 'my_page_function',
		 *     'position' => 50
		 * );
		 *
		 * @param array $menu_items
		 * @since 1.0
		 */
		//$menu_items = (array) apply_filters( 'mc4wp_admin_menu_items', $menu_items );

		// add top menu item
		add_menu_page( 'WWD Mailer', 'WWD Mailer', $this->required_cap, 'wwd_mailer', array( $this, 'load_main_page' ), 'dashicons-email', '99.68491' );

		// sort submenu items by 'position'
		//uasort( $menu_items, array( $this, 'sort_menu_items_by_position' ) );

		// add sub-menu items
		//array_walk( $menu_items, array( $this, 'add_menu_item' ) );
	}

	/**
	 * Load main page admin area.
	 *
	 * @since    1.0.0
	 */
	public function load_main_page() {

		include( plugin_dir_path( __FILE__ ) . 'partials/wwd-mailer-admin-display.php' );

	}



}
