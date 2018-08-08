<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	function get_questions($conditions=array(),$row=true){
		$this->db->select('*');
		if(!empty($conditions)){
			$this->db->where($conditions);
		}

		$this->db->from('questions');
		$queries=$this->db->get();
		if($row==true){
			$query=$queries->row();
		} else{
			$query=$queries->result();
		}
		return $query;

	}
	function get_questions_by_one($conditions=array(),$row=true,$start='',$not_in=array()){
		$this->db->select('*');
		if(!empty($conditions)){
			$this->db->where($conditions);
		}
		if(!empty($not_in)){
			$this->db->where_not_in($not_in);
		}
		if($start!=''){
			$this->db->limit(1, $start);
		}
		else{
			$this->db->limit(1, 0);
		}
		$this->db->order_by('rand()');
		$this->db->from('questions');
		$queries=$this->db->get();
		if($row==true){
			$query=$queries->row();
		} else{
			$query=$queries->result();
		}
		return $query;

	}
}