<?php

namespace Wwd\Mailer\Public;

/**
 * The public-facing functionality of the plugin.
 *
 * 
 */
class Wwd_Mailer_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wwd_mailer       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $wwd_mailer, $version ) {

		$this->wwd_mailer = $wwd_mailer;
		$this->version = $version;

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
		 * defined in Wwd_Mailer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wwd_Mailer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->wwd_mailer, plugin_dir_url( __FILE__ ) . 'css/wwd-mailer-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_script( $this->wwd_mailer, plugin_dir_url( __FILE__ ) . 'js/wwd-mailer-public.js', array( 'jquery' ), $this->version, false );

	}

}
