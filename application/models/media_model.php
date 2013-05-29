<?php

class Media_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
    
	private function get_movie_category_id()
	{
		$this->db->select('category_id');
		$this->db->from('media_category');
		$this->db->where('name','movie');
		
		$query = $this->db->get()->row();
		return $query->category_id;
	}
	
	private function get_music_category_id()
	{
		$this->db->select('category_id');
		$this->db->from('media_category');
		$this->db->where('name','musicTrack');
		
		$query = $this->db->get()->row();
		return $query->category_id;
	}
	
	private function get_book_category_id()
	{
		$this->db->select('category_id');
		$this->db->from('media_category');
		$this->db->where('name','ebook');
		
		$query = $this->db->get()->row();
		return $query->category_id;
	}
	
	function get_category_id($name){
		switch($name){
			case "song":
			case "music-video":
				return $this->get_music_category_id();
			case "feature-movie": return $this->get_movie_category_id();
			case "ebook": return $this->get_book_category_id();
			case "default": die("Unknown category passed to media model line 45.");
		}
	}
	
	function save($media_id, $cat_name, $artist_name, $track_name, $artwork_url, $preview_url){
		$cat_id = $this->get_category_id($cat_name);
		
		$this->db->insert("media", array(
			"media_id" => $media_id,
			"category_id" => $cat_id,
			"artistName" => $artist_name,
			"trackName" => $track_name,
			"artworkUrl" => $artwork_url,
			"previewUrl" => $preview_url,
			"date_added" => time() )
		);
	}
	
	function findById($media_id){
		$this->db->select("*");
		$this->db->from("media");
		$this->db->where(array("media_id" => $media_id));
		$this->db->join("media_category", "media.category_id = media_category.category_id");
		return $this->db->get()->row();
	}
	
	function save_picture($picture_base64, $is_public, $moment_id, $album_id = null){
		$this->db->insert("pictures", array(
			"user_id" => $this->session->userdata("uid"),
			"album_id" => $album_id,
			"moment_id" => $moment_id,
			"picture_base64" => $picture_base64,
			"is_public" => $is_public,
			"time" => time())
		);
	}
	
	/*
	//Not useful anymore
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
	
	function media_like($media_name, $media_category)
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
    */
}

?>
