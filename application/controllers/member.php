<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->title = "Moments";
        $this->path_to_smileys = "http://localhost/moments/images/smileys";
        
        if(!$this->session->userdata("is_logged_in")){
            $this->session->set_flashdata("status", "You must be logged in to view this page.");
            redirect("home/index");
        }
        
		$this->load->model("social_model");
		
		$this->load->helper("smiley");
	}
	
	//member home page
	function index(){
		$moments = $this->social_model->get_moments_for_user($this->session->userdata("uid"));
		
		$data = array("title" => $this->title, "moments" => $moments, "smileys_path" => $this->path_to_smileys);
		$this->load->view("home_view", $data);
	}
	
	//show a single moment with commetns
	function view($id = null){
		if(!$id) show_404();
		
		$moment = $this->social_model->get_moment_by_id($id);
		
		if(!$moment) show_404();
		
		$comments = $this->social_model->get_comments_for_moment($moment->moment_id);
		
		$moment->comments = $comments;
		
		$this->load->view("show_moment", array("title" => $this->title, "moment" => $moment, "smileys_path" => $this->path_to_smileys));
	}
	
	function add_moment(){
		$this->load->view("add_moment", array("title" => $this->title));
	}
	
	function go_to_sleep($status = null){
		if(strlen($status) == 5) {
			$status == "awake" ?
				$this->social_model->bed_function("awake"):
				$this->social_model->bed_function("sleep");
			
			$this->session->set_flashdata("status", "Moment added successfully.");
			redirect(site_url("member"));
			return;
		}
		
		$this->load->view("sleep_view", array("title" => $this->title));
	}
	
	function settings(){
		if($this->input->post("save-btn")){
			$dob = $this->input->post("birthdate");
			$phone = $this->input->post("phone");
			$gender = $this->input->post("male") == "on" ? "m" : "f";
			
			$this->social_model->update_profile($this->session->userdata("uid"), array(
				"birthdate" => $dob,
				"phone" => $phone,
				"gender" => $gender )
			);
			
			$this->session->set_flashdata("status", "Profile updated successfully.");
			redirect("member/settings");
		} else {
			$data = $this->social_model->get_editable_profile( $this->session->userdata("uid") );
			$data["title"] = $this->title;
			
			$this->load->view("settings_view", $data);
		}
	}
	
	function submit_moment(){
		
		$lid = null; //media id - may be null
		$mid = null; //location id - may be null
		$uid = $this->session->userdata("uid");
		$moment_text = $this->input->post('moment_text');
		
		if($this->input->post('mid'))
			$mid = $this->input->post('mid');
			
		if($this->input->post('lid'))
			$lid = $this->input->post('lid');
			
		$current_time = time();
		
		$moment = array(
		'user_id' => $uid,
		'media_id' => $mid,
		'location_id' => $lid,
		'msg' => $moment_text,
		'time' => $current_time
		);
		
		$this->social_model->save_moment($moment);
		
		$this->session->set_flashdata("status", "Moment posted successfully.");
		redirect("member/index");
	}
	
	function submit_comment(){
		
		$uid = $this->session->userdata("uid");
		$mid = $this->input->post('mid');
		$comment_text = $this->input->post('comment_text');
		
		$current_time = time();
		
		$comment = array(
		
		'user_id' => $uid,
		'moment_id' => $mid,
		'msg' => $comment_text,
		'time' => $current_time
		
		);
		
		$this->social_model->save_comment($comment);
		$this->session->set_flashdata("status", "Comment posted successfully.");
		redirect("member/view/{$mid}");
	}
	
	function search_friend(){
		$data["title"] = $this->title;
		$data["friends"] = array();
		
		if($this->input->post("find_friend_btn"))
			$data["friends"] = $this->social_model->find_friends( $this->input->post("friend_username") );
		
		$this->load->view("add_friend", $data);
	}
	
	function add_friend($friend_id = null){
		if(is_numeric($friend_id)){
			$this->social_model->add_friends_request($friend_id);
			
			$this->session->set_flashdata("status", "Friend request sent.");
			redirect("member/search_friend");
		} else {
			show_404();
		}
	}
}
