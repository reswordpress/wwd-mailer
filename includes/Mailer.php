<?php

namespace Wwd\Mailer;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 */
class Mailer {

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
	protected $wwdMailer;

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
	public function __construct() 
	{
		$this->wwdMailer = 'wwd-mailer';
		$this->version = '1.0.0';

		$this->registerHooks();
		$this->setLocale();
		$this->defineAdminHooks();
		//$this->definePublicHooks();
	}

	/**
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @access   private
	 */
	private function registerHooks() 
	{
		$this->loader = new Loader();
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
	private function setLocale() 
	{
		$pluginI18n = new I18n();
		$pluginI18n->setDomain( $this->getWwdMailer() );

		$this->loader->addAction( 'plugins_loaded', $pluginI18n, 'loadPluginTextdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function defineAdminHooks() 
	{
		$pluginAdmin = new  Admin\Admin( $this->getWwdMailer(), $this->getVersion() );

		$this->loader->addAction( 'admin_enqueue_scripts', $pluginAdmin, 'enqueueStyles' );
		$this->loader->addAction( 'admin_enqueue_scripts', $pluginAdmin, 'enqueueScripts' );
		$this->loader->addAction( 'admin_menu', $pluginAdmin,  'buildMenu'  );

		$this->loader->addAction( 'wp_ajax_process_email', $pluginAdmin, 'processEmail' );

		$this->loader->addAction( 'show_user_profile', $pluginAdmin, 'showOptOut' );
		$this->loader->addAction( 'edit_user_profile', $pluginAdmin, 'showOptOut' );

		$this->loader->addAction( 'personal_options_update', $pluginAdmin, 'saveOptOut' );
		$this->loader->addAction( 'edit_user_profile_update', $pluginAdmin, 'saveOptOut' );
	}

	/**
	 * This method is able to egister all of the hooks related to the 
	 * public-facing functionality
	 * of the plugin. Not in use
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function definePublicHooks() 
	{

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() 
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function getWwdMailer() 
	{
		return $this->wwdMailer;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wwd_Mailer_Loader    Orchestrates the hooks of the plugin.
	 */
	public function getLoader() 
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function getVersion() 
	{
		return $this->version;
	}



}
