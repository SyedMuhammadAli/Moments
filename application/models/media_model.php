<?php

class Media_model extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function get_movie_category_id()
	{
	
		$this->db->select('category_id');
		$this->db->from('media_category');
		$this->db->where('name','movie');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_music_category_id()
	{
	
		$this->db->select('category_id');
		$this->db->from('media_category');
		$this->db->where('name','music');
		
		$query = $this->db->get();
		return $query->result();
		
	}
	
	function get_book_category_id()
	{
	
		$this->db->select('category_id');
		$this->db->from('media_category');
		$this->db->where('name','book');
		
		$query = $this->db->get();
		return $query->result();
		
	}
	
	function get_all_books()
	{
		$this->db->select('*');
		$this->db->from('media');
		$this->db->where('category_id',get_book_category_id());
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_all_music()
	{
		$this->db->select('*');
		$this->db->from('media');
		$this->db->where('category_id',get_music_category_id());
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_all_movies()
	{
		$this->db->select('*');
		$this->db->from('media');
		$this->db->where('category_id',get_movie_category_id());
	
		$query = $this->db->get();
		return $query->result();
	}
	
	private function media_like($media_name, $media_category)
	{
		$this->db->select('*');
		$this->db->from('media');// I use aliasing make things joins easier
		$this->db->where('name', $media_name);
		$this->db->like('category_id', $media_category);
		
		$query->$this->db->get();
		return $query->result();
	}
	
	function music_like($music_name)
	{
		$music_category_id = get_music_category_id();
		$like_music_found = media_like($music_name,$music_category_id);
		
		return $like_music_found;
	}
	
	function movie_like($movie_name)
	{
		$movie_category_id = get_movie_category_id();
		$like_movie_found = media_like($movie_name,$movie_category_id);
		
		return $like_movie_found;
	}
	
	function book_like($book_name)
	{
		$book_category_id = get_book_category_id();
		$like_book_found = media_like($book_name,$book_category_id);
		
		return $like_book_found;
	}
    
}

?>