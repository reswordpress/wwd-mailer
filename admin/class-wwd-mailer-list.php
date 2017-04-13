<?php

/**
 *
 * Covers the logic for creating lists
 *
 * @package    Wwd_Mailer
 * @subpackage Wwd_Mailer/admin
 * @author     Da Wilbur 
 */
class Wwd_Mailer_List  {

	/**
	 * WP Users.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $users    WP Users.
	 */
	private $lists;


	/**
	 * Object for form post
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $body    
	 */
	private $form;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wwd_mailer       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( ) {

		
		
	}


	/**
	 * Validate form
	 * @param object form object
	 */
	public function form_validate(){
	
		$fields = array('list_name');
		
	    foreach($fields as $field){
	   	
			if(array_key_exists($field, $_POST))
				$this->form->fields[$field] =  sanitize_text_field($_POST[$field]);

			if($_POST[$field] == ''){
				$this->form->errors[$field] = true;
			}
			
		}
		
		if(property_exists($this->form,'errors')){
			$this->form->status = 0;
			echo json_encode($this->form); 
			die();
		}
	}

	

	/**
	 * WP AJAX action
	 *
	 * @since    1.0.0
	 */
	public function save_list() {
		
		$this->form_validate();

		$args = array(
					'post_title'=> $this->form->fields['list_name'],
					'post_type'=>'wwd_mailer_list',
					'post_status'   => 'publish',
					);

		$pid = wp_insert_post($args);

		if($pid > 0){
			$this->form->message = __('List successfully added','wwd-mailer');
			$this->form->status = 1;
		}else{
			$this->form->message = __('There was a problem adding the list','wwd-mailer');
			$this->form->status = 0;
		};

		echo json_encode($this->form); 
		die();
	}






}
