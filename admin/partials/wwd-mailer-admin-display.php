<?php

/**
 * Provide a admin area view for the plugin
 *
 * Renders the HTML form for sending the email.
 *
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
				<?php _e( 'Send an email to all your users', 'wwd-mailer' ); ?>
			</h1>

			<div class="mailer-errors red">
			<?php _e( 'Please make sure all fields are required and the Email from field is a vaild email', 'wwd-mailer' ); ?>
			</div>

			<div class="mailer-messaging">
				<h2 class="page-loader">
					<?php _e( 'Sending mail...', 'wwd-mailer' ); ?>		
				</h2>
				<p><?php _e( 'Successful mail count', 'wwd-mailer' ); ?>: <span data-count="0" class="success-count">0</span></p>
				<p><?php _e( 'Failed mail count', 'wwd-mailer' ); ?>: <span data-count="0" class="fail-count">0</span></p>
				<ul class="emailed-list"></ul>
			</div>

			<form method="post" id="wwd-mailer-form">

			<table class="form-table" style="width:100%" >
				<tbody>
				  <tr valign="top" >
				     <td>    
				     	<label><?php _e( 'Subject...', 'wwd-mailer' ); ?> *</label>
				        <input type="text" id="email_subject" name="email_subject"  class="valid" size="70" required="required">
				        
				      </td>
				   </tr>
				   <?php if(!is_plugin_active('wp-mail-smtp/wp_mail_smtp.php')) { ?>
				   <tr valign="top" >
				     <td>    
				     	<label><?php _e( 'From Name', 'wwd-mailer' ); ?> *</label>
				        <input type="text" id="email_From_name" name="email_from_name"  class="valid" size="70" required="required">
				         <br/><?php _e( '(ex. Site admin)', 'wwd-mailer' ); ?>    
				      </td>
				   </tr>
				   <tr valign="top" >
				     <td>   
				     	<label><?php _e( 'Email From', 'wwd-mailer' ); ?> *</label> 
				        <input type="email" id="email_from" name="email_from_email"  class="valid" size="70" required="required">
				        <br/><?php _e( '(ex. info@mysite.com)', 'wwd-mailer' ); ?> 
				      </td>
				   </tr>
				   <?php } ?>
				   <tr valign="top" >
				     <td>    
				       <label><?php _e( 'Email Body', 'wwd-mailer' ); ?>  *</label> 
				       <div class="wrap">
				       	<textarea id="body"  name="email_body"   rows="10" required="required"></textarea>
				       	</div>
				          
				      </td>
				   </tr>
				   <tr valign="top" id="subject">
				     <td> 
				       <input type="hidden" name="count-box" id="count-box" value="0">
				       <input type="hidden" name="action" value="process_email">
				       <?php wp_nonce_field('action_mass_email_nonce','mass_email_nonce'); ?>  
				       <input type="submit"  value="<?php _e( 'Send Email', 'wwd-mailer' ); ?>" name="send_send" class="button-primary" id="email_send" >  
				      </td>
				   </tr>
				  </tbody> 
			</table>

			</form>

		</div>

		<!-- Sidebar -->
		<div class="sidebar col col-2">
			<?php include( plugin_dir_path( __FILE__ ) . 'wwd-mailer-admin-side-bar.php' ); ?>
		</div>


	</div>

</div>

