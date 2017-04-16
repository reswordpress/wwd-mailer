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
	public $form;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wwd_mailer       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( ) {

		if (!isset($this->form)) $this->form = new stdClass();

	}


	/**
	 * Validate form
	 * @param object form object
	 */
	public function form_validate(){
	
		$fields = array('list_name','lid');
		
	    foreach($fields as $field){
	   	
			if(array_key_exists($field, $_POST))
				$this->form->fields[$field] =  sanitize_text_field($_POST[$field]);

			if($_POST[$field] == ''){
				$this->form->errors[$field] = true;
			}
			
		}
		
		if(property_exists($this->form,'errors')){
			$this->form->status = 0;
			return $this->form; 
		}
	}

	

	/**
	 * Save a list
	 *
	 * @since    1.0.0
	 */
	public function save_list() {
		
		$this->form_validate();
		$lid = (int)$this->form->fields['lid'];

		if($lid === 0){

			$args = array(
			'post_title'=> $this->form->fields['list_name'],
			'post_type'=>'wwd_mailer_list',
			'post_status'   => 'publish',
			);

			$lid = wp_insert_post($args);
			$this->form->message = __( 'List added.', 'wwd-mailer' );

		}elseif ($lid > 0) {
			$args = array(
			'post_title'=> $this->form->fields['list_name'],
			'ID'=>$lid
			);

			$lid = wp_update_post($args);

			$this->form->message = __( 'List updated.', 'wwd-mailer' );
		}


		if($lid > 0){
			$this->form->status = 1;
		}else{
			$this->form->status = 0;
			$this->form->message = __( 'A problem has occured.', 'wwd-mailer' );
		};

		return $this->form; 
	}




	/**
	 * Delete a list
	 *
	 * @since    1.0.0
	 */
	public function delete_list($id) {
		
		if(wp_delete_post($id,true)){
			$this->form->status = 1;
		}else{
			$this->form->status = 0;
		};

		return $this->form; 
	}






}
