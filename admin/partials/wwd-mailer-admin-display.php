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


<div id="wwd-admin" class="wrap wwd-settings">

	<p class="breadcrumbs">
		<span class="prefix"><?php echo __( 'You are here: ', 'wwd-mailer' ); ?></span>
		<span class="current-crumb"><strong>WWD Mailer</strong></span>
	</p>


	<div class="row">

		<!-- Main Content -->
		<div class="main-content col col-4">

			<h1 class="page-title">
				<?php _e( 'General Settings', 'wwd-mailer' ); ?>
			</h1>

			<h2 style="display: none;"></h2>
			<?php
			settings_errors();
			//$this->messages->show();
			?>

			<form action="<?php echo admin_url( 'options.php' ); ?>" method="post">
				<?php settings_fields( 'wwd_settings' ); ?>

				<h3>
					<?php _e( 'WWD Mailer', 'wwd-mailer' ); ?>
				</h3>

				<table class="form-table">

					<tr valign="top">
						<th scope="row">
							<?php _e( 'Status', 'wwd-mailer' ); ?>
						</th>
						<td>
							<span class="status positive"><?php _e( 'CONNECTED' ,'wwd-mailer' ); ?></span>
							
						</td>
					</tr>


					<tr valign="top">
						<th scope="row"><label for="mailchimp_api_key"><?php _e( 'API Key', 'wwd-mailer' ); ?></label></th>
						<td>
							<input type="text" class="widefat" placeholder="<?php _e( 'Your MailChimp API key', 'wwd-mailer' ); ?>" id="mailchimp_api_key" name="wwd[api_key]" value="" />
							<p class="help">
								<?php _e( 'The API key for connecting with your MailChimp account.', 'wwd-mailer' ); ?>
								<a target="_blank" href="https://admin.mailchimp.com/account/api"><?php _e( 'Get your API key here.', 'wwd-mailer' ); ?></a>
							</p>
						</td>

					</tr>

				</table>

				<?php submit_button(); ?>

			</form>

			<?php

			/**
			 * Runs right after general settings are outputted in admin.
			 *
			 * @since 3.0
			 * @ignore
			 */
			/*do_action( 'wwd_admin_after_general_settings' );

			if( $connected ) {
				echo '<hr />';
				//include dirname( __FILE__ ) . '/parts/lists-overview.php';
			}

			include dirname( __FILE__ ) . '/parts/admin-footer.php';
			*/

			?>
		</div>

		<!-- Sidebar -->
		<div class="sidebar col col-2">
			<?php include( plugin_dir_path( __FILE__ ) . 'wwd-mailer-admin-side-bar.php' ); ?>
		</div>


	</div>

</div>

