<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function user_details(){
		$response = array();
		$this->db->select('title,content');
		$this->db->from('posts');
		$response_query = $this->db->get();
		if($response_query->num_rows() > 0 )
		{
			foreach ($response_query->result() as $query) {
				$response[] = array(
					"content" => $query->content,
					"title"   => $query->title
				);
			}
		}
		return $response;
	}

}