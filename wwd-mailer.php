<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://wilburblog.co.uk/wwdmailer
 * @since             1.0.0
 * @package           Wwd_Mailer
 *
 * @wordpress-plugin
 * Plugin Name:       WWD Mailer
 * Plugin URI:        http://wilburblog.co.uk/wwdmailer
 * Description:       Send bulk email to your WordPress users. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            William Honeywill
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
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wwd-mailer-activator.php';
	Wwd_Mailer_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wwd-mailer-deactivator.php
 */
function deactivate_wwd_mailer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wwd-mailer-deactivator.php';
	Wwd_Mailer_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wwd_mailer' );
register_deactivation_hook( __FILE__, 'deactivate_wwd_mailer' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wwd-mailer.php';

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

	$plugin = new Wwd_Mailer();
	$plugin->run();

}
run_wwd_mailer();
