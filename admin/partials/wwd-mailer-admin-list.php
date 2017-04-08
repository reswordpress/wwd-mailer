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

$list = new Wwd_Mailer_List_Table();
?>


<div id="wwd-admin" class="wrap wwd-settings">

	<p class="breadcrumbs">
		<span class="prefix"><?php echo __( 'You are here: ', 'wwd-mailer' ); ?></span>
		<span class="current-crumb"><strong>WWD Mailer</strong></span>
		<span class="current-crumb"><strong> > <?php _e( 'Lists', 'wwd-mailer' ); ?></strong></span>
	</p>


	<div class="row">

		<!-- Main Content -->
		<div class="main-content col col-4">

			<h1 class="page-title">
				<?php _e( 'Lists', 'wwd-mailer' ); ?>
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

			<form method="post" id="wwd-mailer-form-list">

			<table class="form-table" style="width:100%" >
				<tbody>
				  <tr valign="top" >
				     <td>    
				     	<label><?php _e( 'List name', 'wwd-mailer' ); ?> *</label>
				        <input type="text" id="list-name" name="list_name"  class="valid" size="70" required="required">
				      </td>
				   </tr>
				   
				   <tr valign="top" >
				     <td> 
				       <input type="hidden" name="action" value="save_list">
				       <?php wp_nonce_field('action_mass_email_nonce','mass_email_nonce'); ?>  
				       <input type="submit"  value="<?php _e( 'Add List', 'wwd-mailer' ); ?>" name="send_send" class="button-primary" id="list_save" >  
				      </td>
				   </tr>
				  </tbody> 
			</table>

			</form>

			<div class="wrap">
				<?php $list->prepare_items(); ?>
  				<?php echo $list->display(); ?>
  			</div>

		</div>

		<!-- Sidebar -->
		<div class="sidebar col col-2">
			<?php include( plugin_dir_path( __FILE__ ) . 'wwd-mailer-admin-side-bar.php' ); ?>
		</div>


	</div>

</div>

