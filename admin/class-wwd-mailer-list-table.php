<?php

/**
 *
 * Covers the logic for creating lists
 *
 * @package    Wwd_Mailer
 * @subpackage Wwd_Mailer/admin
 * @author     Da Wilbur 
 */
class Wwd_Mailer_List_Table extends WP_List_Table {

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
		
	}

	/**
	 * Get an array of all users
	 *
	 * @since    1.0.0
	 */
	public function get_lists() {

		//$offset = (int) $this->form->fields['count'];
		$offset = 0 ;

		$args = array(
			'offset' => $offset,
			'number' => 10,
			'post_type'     => 'wwd_mailer_list',
		);

		if($_GET){
			if(array_key_exists('orderby', $_GET)){
				$args['orderby'] = 'title';
			}
			if(array_key_exists('order', $_GET)){
				$args['order'] = sanitize_text_field($_GET['order']);
			}
		}

		$this->lists = get_posts( $args );

		foreach ($this->lists as $key => $value) {
			$this->items[] = array('title'=>$value->post_title,'ID'=>$value->ID);
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
	      'title' => 'List',
	      'users'    => 'Users',
	      'mailouts'      => 'Mailouts'
	    );
	    return $columns;

	}

	/**
	 * Get colums headinds
	 *
	 * @since    1.0.0
	 */
	public function prepare_items() {

		$per_page = 3;
  		$current_page = $this->get_pagenum();
  		$total_items = count($this->items);

  		$this->set_pagination_args( array(
		    'total_items' => $total_items,                  //WE have to calculate the total number of items
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
	      case 'title':
	      case 'users':
	      case 'mailouts':
	        return $item[ $column_name ];
	      default:
	        return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
	  }

	}


	/**
	 * Get colums headinds
	 *
	 * @since    1.0.0
	 */
	public function get_sortable_columns() {

	    $sortable_columns = array(
	      'title'  => array('title',false),
	      'users' => array('users',false),
	      'mailouts'   => array('mailouts',false)
	    );
	    return $sortable_columns;

	}

	/**
	 * Get colums headinds
	 *
	 * @since    1.0.0
	 */
	public function column_title($item) {

	    $actions = array(
	            'edit'      => sprintf('<a href="?page=%s&action=%s&list=%s">Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
	            'delete'    => sprintf('<a href="?page=%s&action=%s&list=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
	        );

	    return sprintf('%1$s %2$s', $item['title'], $this->row_actions($actions) );

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
	      'delete'    => 'Delete'
	    );
	    return $actions;

	}





}
