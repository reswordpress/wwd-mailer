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
	 * Get an array of all users
	 *
	 * @since    1.0.0
	 */
	private function get_lists() {

		$offset = (int) $this->form->fields['count'];

		$args = array(
			'offset' => $offset,
			'number' => 10,
			'meta_key'     => 'wwd-opt-out',
			'meta_value'   => '',
			'meta_compare' => 'NOT EXISTS'
		);

		$this->users = get_users( $args );

		if ( empty($this->users) ){
			$this->form->status = 2;
			echo json_encode($this->form); 
			die();
		}
		
	}

	/**
	 * Get column headings
	 *
	 * @since    1.0.0
	 */
	public function get_columns(){

	    $columns = array(
	      'booktitle' => 'List',
	      'author'    => 'Users',
	      'isbn'      => 'Mailouts'
	    );
	    return $columns;

	}

	/**
	 * Get colums headinds
	 *
	 * @since    1.0.0
	 */
	public function prepare_items() {
	    
	    $columns = $this->get_columns();
	    $hidden = array();
	    $sortable = array();
	    $this->_column_headers = array($columns, $hidden, $sortable);
	    $this->items = $this->lists;

	}

	/**
	 * Get colums headinds
	 *
	 * @since    1.0.0
	 */
	public function column_default( $item, $column_name ) {

	    switch( $column_name ) { 
	      case 'lists':
	      case 'users':
	      case 'mailouts':
	        return $item[ $column_name ];
	      default:
	        return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
	  }
	  
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
					'post_title'=> $this->form->->fields['list_name'],
					'post_type'=>'wwd-mailer-list'
					)

		if(wp_insert_post($args) > 0){
			$this->form->message = __('List successfully added','wwd-mailer');
			$this->form->status = 1;
		}else{
			$this->form->message = __('There was a problem adding the list','wwd-mailer');
			$this->form->status = 0;
		};

		echo json_encode($this->form); 
		die();
	}


	/**
	 * Messaging to inform admin of each email status
	 *
	 * @since    1.0.0
	 * @param string $result 
	 */
	private function messaging($result,$email) {

		if($result === 'success'){
			return sprintf(__('Email successfully sent to %s','wwd-mailer'),$email);
		}else{
			return sprintf(__('Email failed to send to %s','wwd-mailer'),$email);
		}

	}



}
