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
	public function get_users() {

		$offset = (int) $this->form->fields['count'];

		$args = array(
			'offset' => $offset,
			'number' => 100
			);

		$this->users = get_users( $args );

		if ( empty($this->users) ){
			$this->form->status = 2;
			echo json_encode($this->form); 
			die();
		}
		
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
	 */
	public function set_headers() {

		$this->headers .= "X-Priority: 1\n";
        $this->headers .= "Content-Type: text/html; charset=\"UTF-8\"\n";
        $this->headers .= "From: ".$this->form->fields['email_from_name']." <".$this->form->fields['email_from_email'].">" . "\r\n";

        return $this->headers;

	}


	/**
	 * Send email using wp_mail function
	 * @param string $user user email
	 */
	public function send_email($user) {
		
		/*if(wp_mail($user, $this->form->fields['email_subject'], $this->form->fields['email_body'], $this->headers)){

			$this->messaging('success');

		}else{

			$this->messaging('fail');

		}*/

		$this->form->messages[] = $this->messaging('success',$user);

		$this->form->success_count++;
		$this->form->fail_count++;

		//test
		//echo $user.' '. $this->form->fields['email_subject'].' '.$this->form->fields['email_body'].' '.$this->headers;
	}

	/**
	 * Validate form
	 * @param object form object
	 */
	public function form_validate(){
	
		$fields = array('email_subject','email_from_name','email_from_email','email_body','count');
		
	    foreach($fields as $field){
	   	
			if(array_key_exists($field, $_POST))
			$this->form->fields[$field] = sanitize_text_field($_POST[$field]);
		
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
		
		//user index counter

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

		//messager user

		//tally successful / non successful mails

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
	public function messaging($result,$email) {

		if($result === 'success'){
			return sprintf(__('Email successfully sent to %s','wwd-mailer'),$email);
		}else{
			return sprintf(__('Email failed to send to %s','wwd-mailer'),$email);
		}

	}

	/**
	*
	* validate email
	* @param string $email
	*/

	private function valid_email($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid email address',
                    $email
                )
            );
        }
	}




}
