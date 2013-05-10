<?php

class Social_model extends CI_Model {

	//This function gets all the moments for the specific user.
	function get_moments_for_user($user_id)
	{
		//This will provide us with the moment's msgs against the particular USER ID.
		$this->db->select('moments.user_id as user_id, username, moment_id, msg, time');
		$this->db->from('moments');
		$this->db->where('moments.user_id',$user_id);
		$this->db->join("users", "moments.user_id = users.user_id");
		
		$query = $this->db->get(); //This executes the query.
		
		if ($query->num_rows() > 0){
			return $query->result(); //This returns the array.
		} else {
			return null; //If no moments exists.
		}
	}
	
	//This function gets the comments for a specific moment.
	function get_comments_for_moment($moment_id)
	{
		//This will provide us with the comments.
		$this->db->select('comment_id, comments.user_id as user_id, username, comments.moment_id as moment_id, msg, time');
		$this->db->from('comments');
		$this->db->where('comments.moment_id',$moment_id);
		$this->db->join("users", "comments.user_id = users.user_id");
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return null;
		}
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
	
	//********************* task2 started from here********************.
	function add_friends_request($user_id, $friend_id)
	{
		$requests = array(
               'user_id' => $user_id,
               'friend_id' => $friend_id
            );
			
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
	
}
?>
