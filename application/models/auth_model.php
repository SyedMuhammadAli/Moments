<?php
//Ali Salman
class Auth_model extends CI_Model
{
	function get_user_by_username($username)
	{
		$this->db->where('username', $username);
		$user = $this->db->get('users');
		
		return $user->row_array();
	}
	
	function create_user($user_detail)
	{
		$this->db->insert('users', $user_detail);
	}
	
	function change_user_password($user_id, $new_password, $new_salt)
	{
		$this->db->where('usr', $user_id);
		$this->db->update('users', array("pswd" => $new_password));
	}
}
