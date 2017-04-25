<?php
require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

/**
 * 
 * @link              https://wordpress.org/plugins/wwd-mailer/
 * @since             1.0.0
 * @package           Wwd_Mailer
 *
 * @wordpress-plugin
 * Plugin Name:       WWD Mailer
 * Plugin URI:        hhttps://wordpress.org/plugins/wwd-mailer/
 * Description:       Send simple text bulk emails to your WordPress users. 
 * Version:           1.0.0
 * Author:            Wilbur Web Development
 * Author URI:        http://wilburblog.co.uk/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpmailer
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wwd-mailer-activator.php
 */
function activate_wwd_mailer() {
	Wwd\Mailer\Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wwd-mailer-deactivator.php
 */
function deactivate_wwd_mailer() {
	Wwd\Mailer\Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wwd_mailer' );
register_deactivation_hook( __FILE__, 'deactivate_wwd_mailer' );



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wwd_mailer() {

	$plugin = new Wwd\Mailer\Mailer;
	$plugin->run();

}
run_wwd_mailer();
