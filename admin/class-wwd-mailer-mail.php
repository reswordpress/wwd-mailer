<?php

/**
 * The mail functionality of the plugin.
 *
 * Covers the logic for sending the emails
 *
 * @package    Wwd_Mailer
 * @subpackage Wwd_Mailer/admin
 * @author     Your Name <email@example.com>
 */
class Wwd_Mailer_Mail {

	/**
	 * WP Users.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $users    WP Users.
	 */
	private $users;

	/**
	 * Email headers
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    
	 */
	private $headers = '';

	/**
	 * Email subject
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $subject    
	 */
	private $subject = '';

	/**
	 * Email body
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $body    
	 */
	private $body = '';	


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
	public function get_users() {

		$args = array(
			'offset' => 10,
			'number' => 10
			);

		$this->users = get_users( $args );
		
	}

	/**
	 * Prepare email for sending
	 *
	 * @since    1.0.0
	 */
	public function prepare_email() {


	}

	/**
	 * Set email headers
	 *
	 * @since    1.0.0
	 * @param string $from_name
	 * @param string $from_email
	 */
	public function set_headers($from_name,$from_email) {

		$this->headers .= "X-Priority: 1\n";
        $this->headers .= "Content-Type: text/html; charset=\"UTF-8\"\n";
        $this->headers .= "From: ".$from_name." <".$from_email.">" . "\r\n";

	}


	/**
	 * Send email using wp_mail function
	 * @param string $user user email
	 */
	public function send_email($user) {
		
		if(wp_mail($user, $this->subject, $this->body, $this->headers)){

			$this->messaging('success');

		}else{

			$this->messaging('fail');

		}
		

		//test
		echo $user.' '. $this->subject.' '.$this->body.' '.$this->headers;
	}

	/**
	 * WP AJAX action
	 *
	 * @since    1.0.0
	 */
	public function process_email() {
		
		//user index counter


		//get the users
		$this->get_users();

		//set the headers
		$from_name = sanitize_text_field($_POST['email_from_name']);
		$from_email = sanitize_email($_POST['email_from_email']);
		$this->subject = sanitize_text_field($_POST['email_subject']);
		$this->body = sanitize_text_field($_POST['email_body']);

		$this->set_headers($from_name,$from_email);
		
		//send mail
		foreach ($this->users as $user) {
			$this->send_email($user->data->user_email);
		}

		//messager user

		//tally successful / non successful mails

		die();
	}


	/**
	 * Messaging to inform admin of each email status
	 *
	 * @since    1.0.0
	 * @param string $result 
	 */
	public function messaging($result) {

		if($result === 'success'){
			$message = _e('Email successfully sent to ','wwd-mailer').$email;
		}else{
			$message = _e('Email failed to send to ','wwd-mailer').$email;
		}

	}




}
