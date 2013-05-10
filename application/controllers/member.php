<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->title = "Moments";
        
        if(!$this->session->userdata("is_logged_in")){
            $this->session->set_flashdata("status", "You must be logged in to view this page.");
            redirect("home/index");
        }
        
		$this->load->model("social_model");
		
		$this->load->helper("smiley");
	}
	
	function index(){
		$moments = $this->social_model->get_moments_for_user($this->session->userdata("uid"));
		
		$data = array("title" => $this->title, "moments" => $moments);
		$this->load->view("home_view", $data);
	}
	
	function view($id = null){
		if(!$id) show_404();
		
		$moment = $this->social_model->get_moment_by_id($id);
		
		if(!$moment) show_404();
		
		$comments = $this->social_model->get_comments_for_moment($moment->moment_id);
		
		$moment->comments = $comments;
		
		$this->load->view("show_moment", array("moment" => $moment));
	}
	
	function submit_moment(){
		
		$lid = null; //media id - may be null
		$mid = null; //location id - may be null
		$uid = $this->session->userdata("uid"); //get user id from session - hardcoded 1 for testing
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
		
		$this->session->set_flashdata("status", "success");
		redirect("member/index");
	}
	
	function submit_comment(){
		
		$uid = $this->input->post('uid');
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
	}
}
