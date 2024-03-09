<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Database_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	
	public function insertContactUsData($data)
	{
		$result= $this->db->insert('contact_us',$data);
		return $result;
	}
	public function fetchStudentData($id)
	{
		$sql="SELECT * FROM contact_us";
		$query = $this->db->query($sql);
		return $query->result();
	}
}