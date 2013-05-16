<?php

class Social_model extends CI_Model {

	//This function gets all the moments for the specific user.
	function get_moments_for_user($user_id)
	{
		/*
		$this->db->select('moments.user_id as user_id, username, dp, moment_id, msg, time');
		$this->db->from('moments');
		$this->db->where('moments.user_id',$user_id);
		$this->db->join("users", "moments.user_id = users.user_id");
		
		$query = $this->db->get(); //This executes the query.
		
		return $query->result();*/
		
		$q = <<<HERE
		SELECT u.username, u.dp, m.user_id, m.moment_id, m.msg, m.time
		FROM moments m, users u
		WHERE m.user_id
		IN (SELECT friend_id FROM user_friend_assoc WHERE user_id = ${user_id} UNION
			SELECT user_id FROM user_friend_assoc WHERE friend_id = ${user_id} UNION
			SELECT ${user_id})
		AND m.user_id = u.user_id
		ORDER BY m.time DESC
		LIMIT 10;
HERE;
		
		return $this->db->query($q)->result();
	}
	
	function get_moment_by_id($moment_id){
		$this->db->select('moments.user_id as user_id, moment_id, username, dp, msg, time');
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
	    
		$has_accepted= true;
		$data = array(
               'user_id' => $user_id,
               'friend_id' => $friend_id,
               'has_accepted' => $has_accepted
            );
			
		$this->db->where('user_id', $user_id);
		$this->db->where('friend_id', $friend_id);	
		$this->db->update('user_friend_assoc', $data); 
	}
	
	function add_moments_with($moment_id, $user_id, $friend_id)
	{
		$moments = array(
			   'moment_id' => $moment_id,
               'user_id' => $user_id,
               'friend_id' => $friend_id
            );
			
		$this->db->insert('moments_with', $moments);
	}
	
	function update_profile($user_id, $profile){
		$this->db->update("users", $profile, array("user_id" => $user_id));
	}
	
	function get_editable_profile($user_id){
		$this->db->select("birthdate, phone, gender");
		$this->db->where("user_id", $user_id);
		return $this->db->get("users")->row_array();
	}
	
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
	
	//find people that are not already friends ! NEEDS QUERY CORRECTION
	function find_friends($usr){
		if(!strlen($usr)) return array();	
		
		$this->db->select("user_id, username, fname, lname, gender, dp");
		$this->db->from("users");
		$this->db->like("username", $usr);
		
		return $this->db->get()->result();
	}
}
?>
