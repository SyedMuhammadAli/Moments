<?php

class Search_model extends CI_Model {
	function process_query($query, $location_id){
		return $this->get_moments_with($this->session->userdata("uid"), $query);
	}

	function get_moments_with($user_id, $query)
	{

		$usernames = explode(" ", $query);

		$friend = $this->id_by_username($usernames[2]);

		$friend_id = $friend->user_id;

		$q = <<<HERE
		SELECT u.username, u.dp, m.user_id, m.moment_id, m.location_id, m.media_id, m.msg, m.time
		FROM moments m, users u
		WHERE m.moment_id
		IN (SELECT moment_id FROM moments_with WHERE user_id = ${user_id} and friend_id =  ${friend_id} 
			UNION 
			SELECT moment_id FROM moments_with WHERE user_id = ${friend_id} and friend_id = ${user_id})
		AND m.user_id = u.user_id
		ORDER BY m.time DESC
		LIMIT 10;
HERE;

		return $this->db->query($q)->result();
	}


	function get_moments_nearby($user_id)//,$location)
	{

		$current_lat = 24.831942;
		$current_lon = 67.049599;

		$q= <<<HERE
		SELECT * FROM moments WHERE user_id = ${user_id} and location_id in (select location_id 
		FROM location 
		WHERE (6371 * 2 * ASIN(SQRT(
		POWER(SIN(($current_lat) - abs(latitude)) * pi()/180 / 2), 2) + COS($current_lat * pi()/180 ) * COS(abs(latitude) * 
		pi()/180) * POWER(SIN(($current_lon - longitude) * 
		pi()/180 / 2), 2) ))) < 1)
		ORDER BY time DESC";
HERE;

		return $this->db->query($q)->result();

	}

	function id_by_username($username)
	{

		$this->db->select('user_id');
		$this->db->from('users');
		$this->db->where('username', $username);

		return $this->db->get()->row();
	}


}

?>