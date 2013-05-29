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
		$this->load->model("media_model");
		
		$this->load->helper("smiley");
	}
	
	private function humanTiming($time)
	{

		$time = time() - $time; // to get the time since that moment

		$tokens = array (
		    31536000 => 'year',
		    2592000 => 'month',
		    604800 => 'week',
		    86400 => 'day',
		    3600 => 'hour',
		    60 => 'minute',
		    1 => 'second',
		);

		foreach ($tokens as $unit => $text) {
		    if ($time < $unit) continue;
		    $numberOfUnits = floor($time / $unit);
		    return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}

	}
	
	//member home page
	function index(){
		$moments = $this->social_model->get_moments_for_user($this->session->userdata("uid"));
		
		foreach($moments as $m){
			$m->time = $this->humanTiming($m->time);
			
			if($m->media_id)
				$m->media = $this->media_model->findById($m->media_id);
				
			if($m->location_id)
				$m->location = $this->social_model->findLocationById($m->location_id);
		}
		
		$data = array("title" => $this->title, "moments" => $moments, "smileys_path" => $this->path_to_smileys);
		
		$this->load->view("home_view", $data);
	}
	
	//show a single moment with commetns
	function view($id = null){
		if(!$id) show_404();
		
		$moment = $this->social_model->get_moment_by_id($id);
		
		if(!$moment) show_404();
		
		$moment->media = $this->media_model->findById($moment->media_id);
		$moment->comments = $this->social_model->get_comments_for_moment($moment->moment_id);
		$moment->time = $this->humanTiming($moment->time);
		
		$this->load->view("show_moment", array("title" => $this->title, "moment" => $moment, "smileys_path" => $this->path_to_smileys));
	}
	
	function add_moment(){
		//$this->session->keep_flashdata("media_id");
		$data["title"] = $this->title;
		$data["friends"] = $this->social_model->get_friends_list_for($this->session->userdata("uid"));
		
		$this->load->view("add_moment", $data);
	}
	
	function settings(){
		if($this->input->post("save-btn")){
			$dob = $this->input->post("birthdate");
			$phone = $this->input->post("phone");
			$gender = $this->input->post("gender");
			
			//Upload dp code
			$config["upload_path"] = "./images/profile_pictures/";
			$config["allowed_types"] = "jpg|png";
			$config["max_size"] = 10;
			$config["max_width"] = 100;
			$config["max_height"] = 100;
			$config["file_name"] = $this->session->userdata("username");
			$config["overwrite"] = true;
			
			$this->load->library("upload", $config);
			$dp_upload = $this->upload->do_upload("profile_picture");
			$uldata = $this->upload->data();
			//end upload
			
			//settings code
			$theme_id = $this->input->post("theme_id");
			$theme = $this->social_model->get_theme_by_id($this->input->post("theme_id"));

			$this->session->set_userdata("theme", $theme->name);
			//end settings
			
			$profile = array( "birthdate" => $dob, "phone" => $phone, "gender" => $gender, "theme_id" => $theme_id );
			
			if($dp_upload) $profile["dp"] = $uldata["file_name"];
			
			$this->social_model->update_profile($this->session->userdata("uid"), $profile);
			
			
			if(!$dp_upload and $uldata["client_name"] != "") //if ul failed, and client tried to ul
				$this->session->set_flashdata("status", $this->upload->display_errors());
			else
				$this->session->set_flashdata("status", "Profile updated successfully.");
			
			redirect("member/settings");
		} else {
			$data = $this->social_model->get_editable_profile( $this->session->userdata("uid") );
			$data["title"] = $this->title;
			$data["all_theme"] = $this->social_model->get_all_themes();
			
			$this->load->view("settings_view", $data);
		}
	}
	
	function submit_moment(){ //if moment_id is present then update
		$moment_id = $this->input->post("moment_id");
		
		$tag = $this->input->post("tagged_friends");
		$tagged_friends = $tag == "" ? array() : explode(",", $tag); //fix for blank entry in array
		
		if($moment_id != 0){
			$m = array( "msg" => $this->input->post("moment_text") );
			$this->social_model->update_moment($m);
			
			$this->social_model->tag_friends($moment_id, $tagged_friends);
			return;
		}
		//end of picture-moment code
		
		$lid = intval( $this->input->post('lid') );
		$mid = intval( $this->input->post('mid') );
		
		if(!$lid) $lid = null;
		if(!$mid) $mid = null;
		
		//die($lid . "/" . $mid); //for testing
		
		$uid = $this->session->userdata("uid");
		$moment_text = $this->input->post('moment_text');
		
		$moment = array(
			'user_id' => $uid,
			'media_id' => $mid,
			'location_id' => $lid,
			'msg' => $moment_text,
			'time' => time()-1 //add one sec
		);
		
		$this->social_model->save_moment($moment);
		
		$moment_id = $this->db->insert_id(); //dependency?
		$this->social_model->tag_friends($moment_id, $tagged_friends);
		
		$this->session->set_flashdata("status", "Moment posted successfully.");
		
		print_r($_POST);
		//redirect("member/index");
	}
	
	function submit_comment(){
		
		$uid = $this->session->userdata("uid");
		$mid = $this->input->post('mid'); //moment_id - replace with moment_id
		$comment_text = $this->input->post('comment_text');
		
		$comment = array(
		
		'user_id' => $uid,
		'moment_id' => $mid,
		'msg' => $comment_text,
		'time' => time()
		
		);
		
		$this->social_model->save_comment($comment);
		$this->session->set_flashdata("status", "Comment posted successfully.");
		redirect("member/view/{$mid}");
	}
	
	function search_friend(){
		$data["title"] = $this->title;
		$data["people"] = array();
		$data["friends_request"] = $this->social_model->get_friends_request($this->session->userdata("uid"));
		$data["friends"] = $this->social_model->get_friends_list_for($this->session->userdata("uid"));
		
		if($this->input->post("find_friend_btn"))
			$data["people"] = $this->social_model->find_friends( $this->input->post("friend_username") );
		
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
	
	function accept_friends_req($friend_id = null){
		if($friend_id == null) show_404();
	
		$this->social_model->accept_friends_request($this->session->userdata("uid"), $friend_id);
		
		//echo $this->db->last_query();
		redirect("member/search_friend");
	}
	
	function search_media(){
		$this->load->view("media_view", array("title" => $this->title));
	}
	
	function add_media($media_id = null){
		if(!$media_id) show_404();
		
		$media = $this->media_model->findById($media_id);
		
		if(!$media){ //if media was not found then add it
			$media = file_get_contents("https://itunes.apple.com/lookup?id={$media_id}");
			$media = json_decode($media, true);
			$media = $media["results"][0];
			
			$this->media_model->save(
				$media_id,
				$media["kind"], 
				$media["artistName"], 
				$media["trackName"], 
				$media["artworkUrl100"],
				$media["previewUrl"]
			);
			
		}
		
		/*
		//Save media moment
		$moment = array(
			'user_id' => $this->session->userdata("uid"),
			'media_id' => $media_id,
			'location_id' => null,
			'msg' => "",
			'time' => time()
		);
		
		$this->social_model->save_moment($moment);
		//end save moment
		*/
		
		$this->session->set_flashdata("mid", $media_id);
		$this->session->set_flashdata("status", "Media file saved successfully.");
		
		redirect("member/add_moment");
	}
	
	function check_in(){
		if($this->input->post("is_posting")){
			$lid = $this->social_model->check_in(
				$this->input->post("latitude"),
				$this->input->post("longitude"),
				$this->input->post("formatted_address")
			);
			
			/*
			$this->social_model->save_moment( array(
				'user_id' => $this->session->userdata("uid"),
				'media_id' => null,
				'location_id' => $lid,
				'msg' => "Checked in at ",
				'time' => time()-1)
			);
			*/
			
			$this->session->set_flashdata("lid", $lid);
			$this->session->set_flashdata("status", "Located saved successfully.");
			
			echo '{"lid": ' . $lid . '}';
		} else {
			$this->load->view("checkin_view", array("title" => $this->title));
		}
	}
	
	function receive_picture(){
		$picture_base64 = $this->input->post("picBase64");
		$lid = $this->input->post("lid");
		
		if(strlen($picture_base64) == 0)
			die("Failed to post image.");
		
		//create container moment
		$moment = array(
			'user_id' => $this->session->userdata("uid"),
			'media_id' => null,
			'location_id' => $lid,
			'msg' => "",
			'time' => time()-1 //add one sec
		);
		
		$this->social_model->save_moment($moment);
		$moment_id = $this->db->insert_id(); //get id for moment just inserted
		
		//now save picture
		$this->media_model->save_picture( $picture_base64, false, $moment_id /* ?? */);
		$pic_id = $this->db->insert_id(); //get id for picture just inserted
		
		echo '{"moment_id":' . $moment_id . '}';
		
		$this->session->set_flashdata("status", "Picture posted successfully.");
	}
	
	function notifications(){
		$data["title"] = $this->title;
		$data["notifications"] = $this->social_model->get_notifications();
		
		foreach($data["notifications"] as $n)
			$n->time = $this->humanTiming($n->time) . " ago.";
		
		
		$this->load->view("notifications", $data);
	}
}
