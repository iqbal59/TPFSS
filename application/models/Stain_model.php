<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class stain_model extends MY_Model
{
	public function getstain()
	{
		$this->load->database();
		$q=$this->db->query("select DISTINCT stain_type from tbl_stain ORDER BY stain_type ASC");
		return $q->result();
	}

	public function getsubstain($stain_type)
	{
		$this->load->database();
		$q=$this->db->query("select DISTINCT sub_stain_type from tbl_stain where stain_type = '$stain_type' ORDER BY sub_stain_type ASC");
		return $q->result();	
	}

	public function getlevel($stain,$sub_stain)
	{
		$this->load->database();
		$qry=$this->db->query("select * from tbl_stain where stain_type = '$stain' and sub_stain_type = '$sub_stain'");
		return $qry->result();
		// echo "<pre>";
		// print_r($qry);
	}
}