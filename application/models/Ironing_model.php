<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Ironing_model extends MY_Model
{
	public function getiron()
	{
		$this->load->database();
		$q=$this->db->query("select * from tbl_iron");
		return $q->result();
	}

	public function fbsearch($fsch)
	{
		$this->db->like('id',$fsch);
		$this->db->or_like('fabric',$fsch);
		$this->db->get('tbl_iron');
				 return $ss->row();	
	}

	public function get_tb($tid)
	{
		$q=$this->db->select()
				 ->where('id',$tid)
				 ->get('tbl_iron');
				 return $q->row();
	}
}