<?php

namespace Wwd\Mailer\Admin;

/**
 * The admin-specific functionality of the plugin.
 *
 * 
 */
class Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wwd_mailer    The ID of this plugin.
	 */
	private $wwdMailer;

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
	const REQUIRED_CAP = 'manage_options';
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wwd_mailer       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $wwdMailer, $version ) {

		$this->wwdMailer = $wwdMailer;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueueStyles() {

		wp_enqueue_style( $this->wwdMailer, plugins_url('/wwd-mailer/admin') .'/css/wwd-mailer-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueueScripts() {

		wp_enqueue_script( $this->wwdMailer, plugins_url('/wwd-mailer/admin') .'/js/wwd-mailer-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Register the setting pages and their menu items
	 */
	public function buildMenu() {
	
		add_menu_page( 'WWD Mailer', 'Send Mail', self::REQUIRED_CAP, 'wwd_mailer', array( $this, 'loadMainPage' ), plugins_url('/wwd-mailer/admin') . '/img/icon.png', '99.68491' );	

	}

	/**
	 * Load main page admin area.
	 *
	 * @since    1.0.0
	 */
	public function loadMainPage() {

		include( WP_PLUGIN_DIR . '/wwd-mailer/admin/partials/wwd-mailer-admin-display.php' );

	}


	/**
	 * Load settings page admin area.
	 *
	 * @since    1.0.0
	 */
	public function loadSettingsPage() {

		include( plugin_dir_path( __DIR__ ) . 'admin/partials/wwd-mailer-admin-display.php' );

	}

	/**
	 * Creates an instance of the Wwd_Mailer_Mail Class
	 * and starts the mail sending
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function processEmail() {
		$mailer = new Admin\Mail();
		$mailer->processEmail();
	}	

	/**
	 * Creates a user setting for
	 * opting out of mass mail
	 *
	 * @since     1.0.0
	 * @return    string    HTML part.
	 */
	public function showOptOut($user) {
		
		$opt_out = esc_attr( get_the_author_meta( 'wwd-opt-out', $user->ID ) )	;
    		
    	echo   '<h3>WWD Mailer</h3>

				<table class="form-table">
					<tr>
						<th><label for="twitter">Exclude from mass mailouts</label></th>
						<td>
							<input type="checkbox" name="wwd-opt-out" id="iwwd-opt-out" value="1" '. checked( true, $opt_out ) . ' " />
							<br />
							<span class="description">Leave unchecked if user is to recieve emails.</span>
						</td>
					</tr>
				</table>';
	}	

	/**
	 * Saves user setting for
	 * opting out of mass mail
	 *
	 * @since     1.0.0
	 */
	public function saveOptOut($user_id) {
		
		if(array_key_exists('wwd-opt-out', $_POST)) {

			if ( !current_user_can( 'edit_user', $user_id ) )
			return false;

			$wwd_opt_out = (int) $_POST['wwd-opt-out'];

			update_user_meta( $user_id, 'wwd-opt-out', $wwd_opt_out );

		}else{
			delete_user_meta( $user_id, 'wwd-opt-out' );
		}		
    	
	}	




}
