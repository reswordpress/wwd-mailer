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
				<?php _e( 'Send an email to all your users', 'wwd-mailer' ); ?>
			</h1>

			<form method="post" id="wwd-mailer-form">

			<table class="form-table" style="width:100%" >
				<tbody>
				  <tr valign="top" >
				     <td>    
				     	<label>Subject *</label>
				        <input type="text" id="email_subject" name="email_subject"  class="valid" size="70">
				        
				      </td>
				   </tr>
				   <tr valign="top" >
				     <td>    
				     	<label>Email From Name *</label>
				        <input type="text" id="email_From_name" name="email_from_name"  class="valid" size="70">
				         <br/>(ex. Site admin)    
				      </td>
				   </tr>
				   <tr valign="top" >
				     <td>   
				     	<label>Email From *</label> 
				        <input type="text" id="email_From" name="email_from_email"  class="valid" size="70">
				        <br/>(ex. admin@yoursite.com) 
				      </td>
				   </tr>
				   <tr valign="top" >
				     <td>    
				       <label>Email Body  *</label> 
				       <div class="wrap">
				       	<textarea id="body"  name="email_body"  cols="100" rows="10"></textarea>
				       	</div>
				          
				      </td>
				   </tr>
				   <tr valign="top" id="subject">
				     <td> 
				       <input type="hidden" name="action" value="process_email">
				       <?php wp_nonce_field('action_mass_email_nonce','mass_email_nonce'); ?>  
				       <input type='submit'  value='Send Email' name='send_send' class='button-primary' id='email_send' >  
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

