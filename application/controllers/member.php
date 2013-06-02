<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {
	function __construct(){
		parent::__construct();

        if(!$this->session->userdata("is_logged_in")){
            $this->session->set_flashdata("status", "You must be logged in to view this page.");
            redirect("home/index");
        }
        
		$this->load->model("social_model");
		$this->load->model("media_model");
		
		$this->load->helper("smiley");
	}
	
	private function init_page_data(){
		return array(
			"title" => "Moments",
			"smileys_path" => base_url("images/smileys")
		);
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
		
		$data = $this->init_page_data();
		$data["moments"] = $moments;

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
		
		$data = $this->init_page_data();
		$data["moment"] = $moment;
		$this->load->view("show_moment", $data);
	}
	
	function add_moment(){
		//$this->session->keep_flashdata("media_id");
		$data = $this->init_page_data();
		$data["friends"] = $this->social_model->get_friends_list_for($this->session->userdata("uid"));
		
		$this->load->view("add_moment", $data);
	}
	
	function settings(){
		if($this->input->post("save-btn")){
			$dob = $this->input->post("birthdate");
			$phone = $this->input->post("phone");
			$gender = $this->input->post("gender");
			$theme_id = $this->input->post("theme_id");

			//Upload dp code
			$config["upload_path"] = "./images/profile_pictures/";
			$config["allowed_types"] = "jpg|png";
			$config["max_size"] = 10;
			$config["max_width"] = 100;
			$config["max_height"] = 100;
			$config["file_name"] = $this->session->userdata("username");
			$config["overwrite"] = true;
			
			$this->load->library("upload", $config);
			$this->load->initialize($config);
			$dp_upload = $this->upload->do_upload("profile_picture");
			$dp_uldata = $this->upload->data();

			$dp_errors = $this->upload->display_errors();
			//end upload
			
			//Upload cover code
			unset($config);
			$config["upload_path"] = "./images/cover_pictures/";
			$config["allowed_types"] = "jpg|png";
			$config["max_size"] = 500;
			$config["max_width"] = 700;
			$config["max_height"] = 300;
			$config["file_name"] = $this->session->userdata("username");
			$config["overwrite"] = true;
			
			$this->load->library("upload", $config);
			$this->load->initialize($config);
			$cvr_upload = $this->upload->do_upload("cover_picture");
			$cover_uldata = $this->upload->data();

			$cover_errors = $this->upload->display_errors();
			//end upload
			
			$profile = array( "birthdate" => $dob, "phone" => $phone, "gender" => $gender, "theme_id" => $theme_id );
			
			if($dp_upload) $profile["dp"] = $dp_uldata["file_name"];

			if($cvr_upload) $profile["cover"] = $cover_uldata["file_name"];

			$this->social_model->update_profile($this->session->userdata("uid"), $profile);

			$this->session->set_userdata("theme", $this->social_model->get_theme($this->session->userdata("uid"))->theme_name );

			if(!$dp_upload and $dp_uldata["client_name"] != "") //if ul failed, and client tried to ul
				$this->session->set_flashdata("status", $dp_errors);
			elseif(!$cvr_upload and $cover_uldata["client_name"] != "") //if ul failed, and client tried to ul
				$this->session->set_flashdata("status", $cover_errors);
			else
				$this->session->set_flashdata("status", "Profile updated successfully.");
			
			redirect("member/settings");
		} else {
			$data = $this->init_page_data();
			$data = $data + $this->social_model->get_editable_profile( $this->session->userdata("uid") );
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
		$data = $this->init_page_data();
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
		$data = $this->init_page_data();

		$this->load->view("media_view", $data);
	}
	
	//file_get_contents workaround
	function url_get_contents($Url) {
		if (!function_exists('curl_init')){ 
			die('CURL is not installed!');
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		
		return $output;
	}

	function add_media($media_id = null){
		if(!$media_id) show_404();
		
		$media = $this->media_model->findById($media_id);
		
		if(!$media){ //if media was not found then add it
			$media = $this->url_get_contents("https://itunes.apple.com/lookup?id={$media_id}");
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
	
	function messages($action = null){
		switch($action){
			case "create":
			$this->load->view("message_create", $this->init_page_data());
			break;

			case "submit":
			/*
			validate input:
			receivers cant have anything but alpha num
			message should be xss_clean
			*/
			$this->social_model->save_message(
				$this->input->post("receiver"),
				$this->input->post("message_text")
			);

			$this->session->set_flashdata("status", "Message sent successfully.");
			
			$thread_code = $this->input->post("thread_code");
			if($thread_code)
				redirect("member/messages/view/{$thread_code}");
			else
				redirect("member/messages");

			break;

			case "view":
			$data = $this->init_page_data();

			$friend_id = $this->uri->segment(4);
			$my_id = $this->session->userdata("uid");

			$messages = $this->social_model->get_message_thread($my_id, $friend_id);

			foreach ($messages as $m) {
				$s = $this->social_model->get_userinfo_by_uid($m->sender_id);
				$r = $this->social_model->get_userinfo_by_uid($m->receiver_id);

				$m->sender_name = $s->username;
				$m->sender_dp = $s->dp;

				$m->receiver_name = $r->username;
				$m->receiver_dp = $r->dp;

				$m->time = $this->humanTiming($m->time);
			}

			$data["messages"] = $messages;
			$data["friend_id"] = $friend_id;
			$data["friend_name"] = $this->social_model->get_userinfo_by_uid($friend_id)->username;

			$this->load->view("message_view", $data);
			break;

			default: //view listing
			$uid = $this->session->userdata("uid");
			$data = $this->init_page_data();
			$data["message_list"] = $this->social_model->get_message_threads_list($uid);
			$this->load->view("messages", $data);
		}
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
			$data = $this->init_page_data();

			$this->load->view("checkin_view", $data);
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
		$data = $this->init_page_data();
		$data["notifications"] = $this->social_model->get_notifications();
		
		foreach($data["notifications"] as $n){
			$n->time = $this->humanTiming($n->time) . " ago.";
			
			switch($n->type_id){
			case 1:
				$n->action = "tagged you in a moments.";
				break;
			case 2:
				$n->action = "sent you a private message.";
				break;
			default:
				$n->action = "did something we don't understand.";
			}
		}
		
		$this->load->view("notifications", $data);
	}

	function notification_count(){
		$count = $this->social_model->notification_count();
		echo '{"count":' . $count . '}';
	}

	function search_moments($action=null){
		$data = $this->init_page_data();

		switch($action){
		case "query":
		$query = $this->input->post("search_query");
		$location_id = $this->input->post("location_id");

		$this->load->model("search_model");
		$data= $this->init_page_data();

		$moments = $this->search_model->process_query($query, $location_id);

		foreach($moments as $m){
			$m->time = $this->humanTiming($m->time);
			
			if($m->media_id)
				$m->media = $this->media_model->findById($m->media_id);
				
			if($m->location_id)
				$m->location = $this->social_model->findLocationById($m->location_id);
		}

		$data["moments"] = $moments;
		$this->load->view("home_view", $data);
		break;

		default:
		$data = $this->init_page_data();
		$this->load->view("search", $data);

		}
	}
}
