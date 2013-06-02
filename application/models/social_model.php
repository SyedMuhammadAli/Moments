<?php

class Social_model extends CI_Model {

	//This function gets all the moments for the specific user.
	function get_moments_for_user($user_id)
	{
		$q = <<<HERE
		SELECT u.username, u.dp, m.user_id, m.moment_id, m.location_id, m.media_id, m.msg, m.time
		FROM moments m, users u
		WHERE m.user_id
		IN (SELECT friend_id FROM user_friend_assoc WHERE user_id = ${user_id} AND has_accepted = 1 UNION
			SELECT user_id FROM user_friend_assoc WHERE friend_id = ${user_id} AND has_accepted = 1 UNION
			SELECT ${user_id})
		AND m.user_id = u.user_id
		ORDER BY m.time DESC
		LIMIT 10;
HERE;
		
		return $this->db->query($q)->result();
	}
	
	function get_moment_by_id($moment_id){
		$this->db->select('moments.user_id as user_id, moment_id, username, dp, msg, media_id, time');
		$this->db->from("moments");
		$this->db->where("moments.moment_id", $moment_id);
		$this->db->join("users", "moments.user_id = users.user_id");
		
		return $this->db->get()->row();
	}
	
	//This function gets the comments for a specific moment.
	function get_comments_for_moment($moment_id)
	{
		//This will provide us with the comments.
		$this->db->select('comment_id, comments.user_id as user_id, username, dp, comments.moment_id as moment_id, msg, time');
		$this->db->from('comments');
		$this->db->where('comments.moment_id',$moment_id);
		$this->db->join("users", "comments.user_id = users.user_id");
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	//This function inserts a new moment added by any user.
	function save_moment($moment_detail)
	{
		$this->db->insert('moments', $moment_detail);
	}
	
	//This function inserts a new comment on any moment added by any user.
	function save_comment($comment_detail)
	{
		$this->db->insert('comments', $comment_detail);
	}
	
	function add_friends_request($friend_id)
	{
		$requests = array(
		'user_id' => $this->session->userdata("uid"),
        'friend_id' => $friend_id
        );
		
		//check here if friend does not exists.
		
		$this->db->insert('user_friend_assoc', $requests);
	}
	
	function accept_friends_request($user_id, $friend_id)
	{
		/*
		$user_id = logged in ser (ie: the friend who's going to see the request)
		$friend_id = user who send the request.
		
		So user_id sent a request to friend_id ie: (user_id, friend_id, 0)
		The friend (logged in user) will accept it by setting 3rd arg to 1
		*/
		
		$this->db->where('user_id', $friend_id);
		$this->db->where('friend_id', $user_id);
		$this->db->update('user_friend_assoc', array('has_accepted' => 1)); 
	}
	
	function get_friends_request($user_id){
		/*
		user story:
		user_id sends request to friend_id
		friend_id logs in and fetches the request by user_id and accepts it
		*/
		$q = <<<HERE
		SELECT user_id, username, fname, lname, dp FROM users WHERE user_id IN (
			SELECT user_id FROM user_friend_assoc WHERE friend_id = ${user_id} AND has_accepted = 0
		);
HERE;
		
		return $this->db->query($q)->result();
	}
	
	//find people that are not already friends ! NEEDS QUERY CORRECTION
	function find_friends($friends_username){
		if(!strlen($friends_username)) return array();	
		
		$user_id = $this->session->userdata("uid");
		
		$q = <<<HERE
		SELECT user_id, username, fname, lname, dp

		FROM users
		WHERE username LIKE "%{$friends_username}%" AND user_id
		NOT IN (SELECT friend_id FROM user_friend_assoc WHERE user_id = {$user_id} UNION
		SELECT user_id FROM user_friend_assoc WHERE friend_id = {$user_id} UNION

		SELECT {$user_id})
		ORDER BY user_id
		LIMIT 10;
HERE;
		
		return $this->db->query($q)->result();
	}
	
	private function add_moments_with($moment_id, $user_id, $friend_id)
	{
		$moments = array(
			   'moment_id' => $moment_id,
               'user_id' => $user_id,
               'friend_id' => $friend_id
            );
			
		$this->db->insert('moments_with', $moments);
	}
	
	function tag_friends($moment_id, $friends_id){
		foreach($friends_id as $fid){
			$this->add_moments_with($moment_id, $this->session->userdata("uid"), $fid);
		}
	}
	
	function update_profile($user_id, $profile){
		$this->db->update("users", $profile, array("user_id" => $user_id));
	}
	
	function get_editable_profile($user_id){
		$this->db->select("theme_id, birthdate, phone, gender");
		$this->db->where("user_id", $user_id);
		return $this->db->get("users")->row_array();
	}
	
	/* //marked for removal
	function bed_function($status){
		$moment = array(
		'user_id' => $this->session->userdata("uid"),
		'media_id' => null,
		'location_id' => null,
		'msg' => "default_msg_bed_function",
		'time' => time()
		);
		
		if($status == "awake")
			$moment["msg"] = "I'm awake.";
		else if($status == "sleep")
			$moment["msg"] = "I'm sleeping.";
		
		$this->db->insert('moments', $moment);
	}
	*/
	
	function check_in($lat, $lng, $addr){
		$this->db->insert("location", array(
			"latitude" => $lat,
			"longitude" => $lng,
			"address" => $addr,
			"time" => time() )
		);
		
		return $this->db->insert_id();
	}
	
	function findLocationById($loc_id){
		return $this->db->get_where("location", array("location_id" => $loc_id))->row();
	}
	
	function get_all_themes(){	 //TO GET ALL THEMES
		return $this->db->get("themes")->result();
	}
	
	function get_theme_by_id($id){   //TO GET THE THEME OF THIS ID
		return $this->db->get_where("themes", array("theme_id" => $id))->row();
	}

	function get_theme($user_id){	 //TO GET THE THEME OF CURRENT USER
		$q = "SELECT * FROM themes WHERE theme_id = (SELECT theme_id FROM users WHERE user_id = {$user_id})";

		return $this->db->query($q)->row();
	}
	
	function get_friends_list_for($user_id){
		$q = <<<HERE
		SELECT user_id, username, fname, lname, dp FROM users WHERE user_id IN (
			SELECT friend_id FROM user_friend_assoc WHERE user_id = ${user_id} UNION
			SELECT user_id FROM user_friend_assoc WHERE friend_id = ${user_id}
		);
HERE;

		return $this->db->query($q)->result();
	}
	
	function get_notifications(){
		$uid = $this->session->userdata("uid");
		
		$this->db->select("username, fname, lname, from_user_id, is_read, time");
		$this->db->from("notifications");
		$this->db->where("to_user_id", $uid);
		$this->db->join("users", "notifications.from_user_id = users.user_id");
		$this->db->order_by("time", "desc");
		$this->db->limit(10);
		
		$notifications = $this->db->get()->result();
		
		$this->db->update(
			"notifications",
			array("is_read" => true), 
			array("to_user_id" => $uid, "is_read" => false)
		);//mark all as read
		
		return $notifications;
	}

	function notification_count(){
		$uid = $this->session->userdata("uid");
		
		$this->db->select("notification_id");
		$this->db->from("notifications");
		$this->db->where("to_user_id", $uid);
		$this->db->where("is_read", 0);

		return $this->db->count_all_results();
	}

	function get_uid_by_username($username){
		$this->db->select("user_id");
		$this->db->where("username", $username);

		return $this->db->get("users")->row();
	}

	function save_message($receiver, $message_text){
		$sender_id = $this->session->userdata("uid");

		$receiver_id = $this->get_uid_by_username( str_replace(" ", "", $receiver) );

		if(isset($receiver_id->user_id)){
			$msg = array(
				"message_text" => $message_text,
				"time" => time(),
				"sender_id" => $sender_id,
				"receiver_id" => $receiver_id->user_id
			);

			$this->db->insert("messages", $msg);

			return true;
		} else {
			return false;
		}
	}

	function get_message_threads_list($user_id){
		$q = <<<HERE
		SELECT user_id as friend_id, username, dp FROM users WHERE user_id IN (
			SELECT sender_id AS friend_id FROM messages WHERE receiver_id = {$user_id}
			UNION 
			SELECT receiver_id AS friend_id FROM messages WHERE sender_id = {$user_id}
		);
HERE;

		$msg_buddies = $this->db->query($q)->result();

		$msgs_list = array();

		foreach($msg_buddies as $mb){
			$msgs_list[$mb->username]["conversations"] = $this->get_message_thread($user_id, $mb->friend_id);
			$msgs_list[$mb->username]["dp"] = $mb->dp;
			$msgs_list[$mb->username]["user_id"] = $mb->friend_id;
			$msgs_list[$mb->username]["username"] = $mb->username;
		}

		return $msgs_list;
	}

	function get_message_thread($receiver_id, $sender_id){
		$q = <<<HERE
		SELECT message_id, message_text, time
		FROM messages 
		WHERE receiver_id = {$receiver_id} AND sender_id = {$sender_id} OR
		receiver_id = {$sender_id} AND sender_id = {$receiver_id};
HERE;
		return $this->db->query($q)->result();
	}
}