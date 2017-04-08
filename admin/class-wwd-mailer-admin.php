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
	const REQUIRED_CAP = 'manage_options';
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
	
		add_menu_page( 'WWD Mailer', 'Send Mail', self::REQUIRED_CAP, 'wwd_mailer', array( $this, 'load_main_page' ), plugin_dir_url( __FILE__ ) . 'img/icon.png', '99.68491' );	
		add_submenu_page( 'wwd_mailer','Lists', 'Lists', self::REQUIRED_CAP, 'wwd_mailer_lists', array( $this, 'load_list_page' ) );

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
	 * Load main list admin area.
	 *
	 * @since    1.0.0
	 */
	public function load_list_page() {

		include( plugin_dir_path( __FILE__ ) . 'partials/wwd-mailer-admin-list.php' );

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

	/**
	 * Creates a user setting for
	 * opting out of mass mail
	 *
	 * @since     1.0.0
	 * @return    string    HTML part.
	 */
	public function show_opt_out($user) {
		
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
	public function save_opt_out($user_id) {
		
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
