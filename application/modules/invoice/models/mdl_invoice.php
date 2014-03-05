<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Mdl_invoice extends CI_Model {
	
	public function getAllinvoice()
	{
		$query = $this->db->select('*')
							->from('invoice')
							->get();

		return $query->result();
	}
	public function save($tablename,$data)
	{
		$this->db->insert($tablename, $data);
		$id = $this->db->insert_id();
		return $id;
	}
	public function getinvoiceById($id)
	{
		$query=$this->db->get_where('invoice', array('id' => $id));
		$result=$query->row(); 
		
		return $result;
	}
	public function update($tablename,$data,$field,$rec_id)
	{
		$return=$this->db->update($tablename, $data, "$field =".$rec_id);
		
		return $return;
	}
	public function getinvoice_by_id($id)
	{
		$query=$this->db->get_where('invoice', array('id' => $id));
		$result=$query->row(); 

		return $result;
	}
	
}
?>