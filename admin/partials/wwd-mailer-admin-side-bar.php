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
	<h4 class="mc4wp-title"><?php echo esc_html__( 'Looking for help?', 'mailchimp-for-wp' ); ?></h4>
	<p><?php echo __( 'We have some resources available to help you in the right direction.', 'mailchimp-for-wp' ); ?></p>
	<ul class="ul-square">
		<li><a href="https://mc4wp.com/kb/#utm_source=wp-plugin&utm_medium=mailchimp-for-wp&utm_campaign=sidebar"><?php echo esc_html__( 'Knowledge Base', 'mailchimp-for-wp' ); ?></a></li>
		<li><a href="https://wordpress.org/plugins/mailchimp-for-wp/faq/"><?php echo esc_html__( 'Frequently Asked Questions', 'mailchimp-for-wp' ); ?></a></li>
		<li><a href="http://developer.mc4wp.com/#utm_source=wp-plugin&utm_medium=mailchimp-for-wp&utm_campaign=sidebar"><?php echo esc_html__( 'Code reference for developers', 'mailchimp-for-wp' ); ?></a></li>
	</ul>
	<p><?php echo sprintf( __( 'If your answer can not be found in the resources listed above, please use the <a href="%s">support forums on WordPress.org</a>.' ), 'https://wordpress.org/support/plugin/mailchimp-for-wp' ); ?></p>
	<p><?php echo sprintf( __( 'Found a bug? Please <a href="%s">open an issue on GitHub</a>.' ), 'https://github.com/ibericode/mailchimp-for-wordpress/issues' ); ?></p>
</div>

