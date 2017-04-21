<?php

/**
 *
 * List tables
 *
 * @package    Wwd_Mailer
 * @subpackage Wwd_Mailer/admin
 * @author     Da Wilbur 
 */
class Wwd_Mailer_Users_Table extends WP_List_Table {

	
	private $users;
	
	private $total_items;

	public $list;

	public $listname;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wwd_mailer       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct(  ) {

		parent::__construct( array(
			'singular' => 'user',     // Singular name of the listed records.
			'plural'   => 'users',    // Plural name of the listed records.
			'ajax'     => false,       // Does this table support ajax?
		) );
		
	}

	public function set_list() {

		if($_GET){

			echo 'sdfs';

			if(array_key_exists('list', $_GET)) {
				$this->list = (int)$_GET['list'];
			}else{
				throw new Exception(__( 'Incorrect URL parameters.', 'wwd-mailer' ));
			}
		}
	}

	public function set_listname() {

		echo $this->list;

		$this->listname = get_the_title($this->list);

	}

	/**
	 * Get an array of all users
	 *
	 * @since    1.0.0
	 */
	public function get_users($list=false) {

		$args = array();

		$this->total_items = count(get_users($args));

		$args = array(
			'number' => 5
		);

		if($_GET){
			if(array_key_exists('orderby', $_GET)){
				$args['orderby'] = 'title';
			}
			if(array_key_exists('order', $_GET)){
				$args['order'] = sanitize_text_field($_GET['order']);
			}
			if(array_key_exists('paged', $_GET)){
				$p = (int)$_GET['paged'];
				$args['offset'] = (5 * $p) - 5;
			}
		}

		if($list) {
			$args['meta_key'] = 'wwd-lists';
			$args['meta_value'] = $list;
			$args['meta_compare'] = 'IN';

		}

		print_r($args);

		$this->users = get_users( $args );

		foreach ($this->users as $key => $value) {
			print_r(get_user_meta($value->ID, 'wwd-lists'));
			$this->items[] = array('username'=>$value->user_login,'user_nicename'=>$value->display_name,'user_email'=>$value->user_email,'ID'=>$value->ID);
		}
		
	}

	/**
	 * Get column headings
	 *
	 * @since    1.0.0
	 */
	public function get_columns(){

	    $columns = array(
	      'cb'  => '<input type="checkbox" />',	
	      'username' => 'Username',
	      'user_nicename'    => 'Name',
	      'user_email'      => 'Email'
	    );
	    return $columns;

	}

	/**
	 * Get colums headinds
	 *
	 * @since    1.0.0
	 */
	public function prepare_items() {

		$per_page = 5;
  		$current_page = $this->get_pagenum();

  		$this->set_pagination_args( array(
		    'total_items' => $this->total_items,                  //WE have to calculate the total number of items
		    'per_page'    => $per_page                     //WE have to determine how many items to show on a page
		) );
	    
	    $columns = $this->get_columns();
	    $hidden = array();
	    $sortable = $this->get_sortable_columns();
	    $this->_column_headers = array($columns, $hidden, $sortable);
	    
	}

	/**
	 * Get colums headinds
	 *
	 * @since    1.0.0
	 */
	public function column_default( $item, $column_name ) {

	    switch( $column_name ) { 
	      case 'username':
	      case 'user_nicename':
	      case 'user_email':
	        return $item[ $column_name ];
	      default:
	        return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
	  }

	}


	/**
	 * Get colums headings
	 *
	 * @since    1.0.0
	 */
	public function get_sortable_columns() {

	    $sortable_columns = array(
	      'username'  => array('username',false),
	      'user_nicename' => array('user_nicename',false),
	      'user_email'   => array('user_email',false)
	    );
	    return $sortable_columns;

	}

	/**
	 * Get colums headinds
	 *
	 * @since    1.0.0
	 */
	public function column_username($item) {

	    $actions = array(
	            'add'      => sprintf('<a href="?page=%s&action=%s&list=%s&user=%s">Add to list</a>',$_REQUEST['page'],'add',$this->list,$item['ID'])
	        );

	    return sprintf('%1$s %2$s', $item['username'], $this->row_actions($actions) );

	}

	/**
	 * Get colums headinds
	 *
	 * @since    1.0.0
	 */
	function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="list[]" value="%s" />', $item['ID']
        );    
    }

	/**
	 * Get colums headinds
	 *
	 * @since    1.0.0
	 */
	public function get_bulk_actions() {

	    $actions = array(
	      'add'    => 'Add to list'
	    );
	    return $actions;

	}





}
