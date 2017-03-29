<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wwd_Mailer
 * @subpackage Wwd_Mailer/admin/partials
 */
?>


<div class="mc4wp-box">
	<h4 class="mc4wp-title"><?php echo esc_html__( 'Need to exclude users?', 'wwd-mailer' ); ?></h4>
	<p><?php echo sprintf( __( 'Simple just go to <a href="%s">required users</a> and unselect them from mail out.' ), admin_url( 'users.php' ) ); ?></p>

	<h4 class="mc4wp-title"><?php echo esc_html__( 'Need custom WordPress development?', 'wwd-mailer' ); ?></h4>
	<p><?php echo sprintf( __( 'Then <a href="%s">WWD</a> can deliver you expert WordPress Development support.' ), 'http://wilburblog.co.uk/' ); ?></p>
	
	
	<!--<p><?php echo sprintf( __( 'If your answer can not be found in the resources listed above, please use the <a href="%s">support forums on WordPress.org</a>.' ), 'https://wordpress.org/support/plugin/mailchimp-for-wp' ); ?></p>-->
	<p><?php echo sprintf( __( 'Found a bug? Please <a href="%s">open an issue on GitHub</a>.' ), 'https://github.com/willhoneywill/wwd-mailer/issues' ); ?></p>
</div>

