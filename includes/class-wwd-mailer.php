<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wwd_Mailer
 * @subpackage Wwd_Mailer/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wwd_Mailer
 * @subpackage Wwd_Mailer/includes
 * @author     Your Name <email@example.com>
 */
class Wwd_Mailer {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wwd_Mailer_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $wwd_mailer    The string used to uniquely identify this plugin.
	 */
	protected $wwd_mailer;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->wwd_mailer = 'wwd-mailer';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wwd_Mailer_Loader. Orchestrates the hooks of the plugin.
	 * - Wwd_Mailer_i18n. Defines internationalization functionality.
	 * - Wwd_Mailer_Admin. Defines all hooks for the admin area.
	 * - Wwd_Mailer_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wwd-mailer-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wwd-mailer-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wwd-mailer-admin.php';

		/**
		 * The class responsible for doing all the mailing logic.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wwd-mailer-mail.php';		

		/**
		 * A  WP list class.
		 */
		if(!class_exists('WP_List_Table')){
		    require_once( ABSPATH . 'wp-admin/includes/class-wp-screen.php' );//added
		    require_once( ABSPATH . 'wp-admin/includes/screen.php' );//added
		    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
		    require_once( ABSPATH . 'wp-admin/includes/template.php' );
		}

		/**
		 * The class responsible for doing all the list logic.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wwd-mailer-list.php';	

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wwd-mailer-public.php';

		$this->loader = new Wwd_Mailer_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wwd_Mailer_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wwd_Mailer_i18n();
		$plugin_i18n->set_domain( $this->get_wwd_mailer() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Wwd_Mailer_Admin( $this->get_wwd_mailer(), $this->get_version() );

		$this->loader->add_action( 'init', $plugin_admin, 'create_post_type' );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin,  'build_menu'  );

		$this->loader->add_action( 'wp_ajax_process_email', $plugin_admin, 'process_email' );

		$this->loader->add_action( 'show_user_profile', $plugin_admin, 'show_opt_out' );
		$this->loader->add_action( 'edit_user_profile', $plugin_admin, 'show_opt_out' );

		$this->loader->add_action( 'personal_options_update', $plugin_admin, 'save_opt_out' );
		$this->loader->add_action( 'edit_user_profile_update', $plugin_admin, 'save_opt_out' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Wwd_Mailer_Public( $this->get_wwd_mailer(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_wwd_mailer() {
		return $this->wwd_mailer;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wwd_Mailer_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}



}
