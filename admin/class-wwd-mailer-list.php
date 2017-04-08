<?php

/**
 *
 * Covers the logic for creating lists
 *
 * @package    Wwd_Mailer
 * @subpackage Wwd_Mailer/admin
 * @author     Da Wilbur 
 */
class Wwd_Mailer_List extends WP_List_Table {

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

		parent::__construct( array(
			'singular' => 'list',     // Singular name of the listed records.
			'plural'   => 'lists',    // Plural name of the listed records.
			'ajax'     => false,       // Does this table support ajax?
		) );

		$this->lists = array(
  array('ID' => 1,'booktitle' => 'Quarter Share', 'author' => 'Nathan Lowell',
        'isbn' => '978-0982514542'),
  array('ID' => 2, 'booktitle' => '7th Son: Descent','author' => 'J. C. Hutchins',
        'isbn' => '0312384378'),
  array('ID' => 3, 'booktitle' => 'Shadowmagic', 'author' => 'John Lenahan',
        'isbn' => '978-1905548927'),
  array('ID' => 4, 'booktitle' => 'The Crown Conspiracy', 'author' => 'Michael J. Sullivan',
        'isbn' => '978-0979621130'),
  array('ID' => 5, 'booktitle'     => 'Max Quick: The Pocket and the Pendant', 'author'    => 'Mark Jeffrey',
        'isbn' => '978-0061988929'),
  array('ID' => 6, 'booktitle' => 'Jack Wakes Up: A Novel', 'author' => 'Seth Harwood',
        'isbn' => '978-0307454355')
);
		
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
	
		
		
	    foreach($fields as $field){
	   	
			if(array_key_exists($field, $_POST))
				$this->form->fields[$field] =  htmlentities($_POST[$field]);

			if($_POST[$field] == ''){
				$this->form->errors[$field] = true;
			}
				
			if($field == 'email_from_email'){
				if(!is_email($_POST[$field])){
					$this->form->errors[$field] = true;
				}
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
	public function process_email() {
		
		//validate form
		$this->form_validate();

		//get the users
		$this->get_users();

		$this->set_headers();
		
		//send mail
		foreach ($this->users as $user) {
			$this->send_email($user->data->user_email);
		}

		json_encode($this->form->messages);

		$this->form->status = 1;
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
