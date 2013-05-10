<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{  
	function __construct(){
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('social_model');
	}
	
	function index(){
	    $this->load->view("auth_view");
	}
	
	function register(){
	    $firstname	= $this->input->post('fname');
	    $lastname	= $this->input->post('lname');
	    $email		= $this->input->post('email');
	    $username	= $this->input->post('username');
	    $password	= $this->input->post('password');
	    $rand		= openssl_random_pseudo_bytes( 16 );
	    $password	= hash("sha256",$password.$rand);
		
	    $data = array(
	    'lname' => $lastname,
	    'fname' => $firstname,
	    'username' => $username,
	    'email' => $email,
	    'pswd' => $password,
	    'salt' => $rand
	    );
	    
	    $this->auth_model->create_user($data);
	    
	    $this->session->set_flashdata("is_registered", "yes");
	    
	    redirect("home/index", "location");
    }
   
    function login(){
		$field_username=$this->input->post('username');
		$field_pass=$this->input->post('password');
		$user = $this->auth_model->get_user_by_username($field_username);
 		$password=$user["pswd"];
		$user_salt=$user["salt"];
		$newpass= hash("sha256",$field_pass.$user_salt);
		
		if($newpass==$password)
			$this->session->set_userdata(array(
                "is_logged_in" => true,
                "uid" => $user["user_id"],
                "username" => $user["username"]
            ));
		
	    redirect("member/index", "location");
    }
	
    function logout(){
        $this->session->sess_destroy();
        redirect("home/index");
    }
}
?>
