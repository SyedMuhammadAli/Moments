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
		$this->load->library("form_validation");
		
		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean|min_length[4]|alpha_dash|max_length[32]');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean|min_length[6]');
		$this->form_validation->set_rules('password2', 'Password', 'required|xss_clean|min_length[6]|matches[password]');
		$this->form_validation->set_rules('fname', 'Fname', 'required|xss_clean|alpha|max_length[30]');
		$this->form_validation->set_rules('lname', 'Lname', 'required|xss_clean|alpha|max_length[30]');
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email|min_length[6]|max_length[48]');
	    
		if($this->form_validation->run() == FALSE){
			echo validation_errors();
		} else {
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
    }
   
    function login(){
		$field_username=$this->input->post('username');
		$field_pass=$this->input->post('password');
		$user = $this->auth_model->get_user_by_username($field_username);
 		$password=$user["pswd"];
		$user_salt=$user["salt"];
		$newpass= hash("sha256",$field_pass.$user_salt);
		
		if($newpass==$password){
			$this->session->set_userdata(array(
                "is_logged_in" => true,
                "uid" => $user["user_id"],
                "username" => $user["username"],
                "theme" => $user["theme_name"], 
                "dp" => $user["dp"],
                "cover" => $user["cover"]
            ));
        }
		
	    redirect("member/index", "location");
    }
	
    function logout(){
        //$this->session->sess_destroy();
        
        $this->session->unset_userdata("is_logged_in");
        $this->session->unset_userdata("username");
        $this->session->unset_userdata("uid");
        $this->session->unset_userdata("dp");
        $this->session->unset_userdata("cover");
        
        redirect("home/index");
    }
    
    //Author: Muhammad Ayub
	function forgot_password(){
		$email = $this->input->post("email");
	
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => '465',
			'smtp_user' => 'moments.mailagent@gmail.com',
			'smpt_from_name' => 'Moments Team',
			'smtp_pass' => 'moom3nts',
			'newline' => '\r\n'
		);
		
		$this->load->library('email', $config);
		
		$this->email->from($config['smpt_user'], $config['smpt_from_name']);
		$this->email->to($email);
		$this->email->subject('Recover Your Password');
		$this->email->message('We are looking into your case. We will send you your new password when we are done. Thank you.');
	
		if($this->email->send())
		{
			echo "Okay.";
			$this->session->set_flashdata("status", "Password reset email sent.");
		}
		else
		{
			echo $this->email->print_debugger();
			$this->session->set_flashdata($this->email->print_debugger());
		}
		
		//redirect("home/index"); //comment this for debugging
	}
}
?>
