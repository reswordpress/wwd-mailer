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
$usersname = "";
$users_edit = __( 'Add List', 'wwd-mailer' );
$lid = 0;

if($_POST){

	if(array_key_exists('save_list', $_POST)) {

		$users = new Wwd_Mailer_List();

		$users->save_list();
		if($users->form->status === 1)
			$success = true;
			
		if($users->form->status === 0)
			$failed = true;

		$message = $users->form->message;

	}
}

if($_GET){

	if(array_key_exists('action', $_GET)) {

		if($_GET['action'] === 'add'){

			$users = new Wwd_Mailer_User();
			$users->save_user_list();
			if($users->form->status === 1)
				$success = true;
				$message = __( 'User Added!.', 'wwd-mailer' );
			if($users->form->status === 0)
				$failed = true;

		}elseif($_GET['action'] === '//edit'){
			$usersname = get_the_title((int)$_GET['list']);
			$lid = (int)$_GET['list'];
			$users_edit = __( 'Edit List', 'wwd-mailer' );
			$users_action = 'edit_list';
		}
		
	}
}

$users = new Wwd_Mailer_Users_Table();
$users->set_list();
$users->set_listname();

?>


<div id="wwd-admin" class="wrap wwd-settings">

	<p class="breadcrumbs">
		<span class="prefix"><?php echo __( 'You are here: ', 'wwd-mailer' ); ?></span>
		<span class="current-crumb"><strong>WWD Mailer</strong></span>
		<span class="current-crumb"><strong> > <?php _e( 'Add users to list', 'wwd-mailer' ); ?></strong></span>
	</p>


	<div class="row">

		<!-- Main Content -->
		<div class="main-content col col-4">

			<h1 class="page-title">
				<?php echo __( 'Add users to list', 'wwd-mailer' ).': '.$users->listname; ?>
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


			<div class="wrap">
				<?php 
				$users->get_users();
				$users->prepare_items();
				echo $users->display(); 
				?>
  			</div>

		</div>

		<!-- Sidebar -->
		<div class="sidebar col col-2">
			<?php include( plugin_dir_path( __FILE__ ) . 'wwd-mailer-admin-side-bar.php' ); ?>
		</div>


	</div>

</div>

