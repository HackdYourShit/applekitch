<?php
class Page_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function get_pages($slug = FALSE) {
		if ($slug === FALSE) {
			$query = $this->db->get('pages');
			return $query->result_array();
		}

		$query = $this->db->get_where('pages', array('page_slug' => $slug));
		return $query->row_array();
	}
}