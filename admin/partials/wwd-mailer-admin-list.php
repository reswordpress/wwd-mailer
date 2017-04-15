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

$success = false;
$failed = false;
$message = "";

if($_POST){
	if(array_key_exists('save_list', $_POST)) {

		$list = new Wwd_Mailer_List();
		$list->save_list();
		if($list->form->status === 1)
			$success = true;
			$message = __( 'List added.', 'wwd-mailer' );
		if($list->form->status === 0)
			$failed = true;
	}
}

if($_GET){
	if(array_key_exists('action', $_GET)) {

		if($_GET['action'] === 'delete'){

			$list = new Wwd_Mailer_List();
			$list->delete_list((int)$_GET['list']);
			if($list->form->status === 1)
				$success = true;
				$message = __( 'List deleted.', 'wwd-mailer' );
			if($list->form->status === 0)
				$failed = true;

		}
		
	}
}

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
			<?php _e( 'Please add a list', 'wwd-mailer' ); ?>
			</div>
<?php if ($success) { ?>
			<div id="message" class="updated notice notice-successful is-dismissible">
				<p>
					<?php echo $message; ?> 
				</p>
				<button type="button" class="notice-dismiss">
					<span class="screen-reader-text"><?php _e( 'Dismiss this notice.', 'wwd-mailer' ); ?></span>
				</button>
			</div>
<?php } ?>			

			<form method="post" action="#" id="wwd-mailer-form-list">

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
				       <input type="hidden" name="save_list" value="save_list">
				       <?php wp_nonce_field('action_mass_email_nonce','mass_email_nonce'); ?>  
				       <input type="submit"  value="<?php _e( 'Add List', 'wwd-mailer' ); ?>" name="send_send" class="button-primary" id="list_save" >  
				      </td>
				   </tr>
				  </tbody> 
			</table>

			</form>

			<div class="wrap">
				<?php 
				$list->get_lists();
				$list->prepare_items();
				echo $list->display(); 
				?>
  			</div>

		</div>

		<!-- Sidebar -->
		<div class="sidebar col col-2">
			<?php include( plugin_dir_path( __FILE__ ) . 'wwd-mailer-admin-side-bar.php' ); ?>
		</div>


	</div>

</div>

