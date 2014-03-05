<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * FusionInvoice
 * 
 * A free and open source web based invoicing system
 *
 * @package		FusionInvoice
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012 - 2013 FusionInvoice, LLC
 * @license		http://www.fusioninvoice.com/license.txt
 * @link		http://www.fusioninvoice.com
 * 
 */

class Mdl_Dashboard extends CI_Model {

	public function save($tablename,$data)
	{
		$this->db->insert($tablename, $data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function update($tablename,$data,$field,$rec_id)
	{
		$return=$this->db->update($tablename, $data, "$field =".$rec_id);
		
		return $return;
	}

	public function delete($key)
	{
		$this->db->where('id', $key);
		$this->db->delete('message');
	}
	
	public function user_type($user_id)
	{
		
		$sql = "SELECT user_type FROM `users` WHERE user_id='$user_id'";
		$res = $this->db->query($sql);
		
		$result = $res->result();
		return $result[0]->user_type;
	}
	
	public function getAllmessage(){
		
		$sql="select * from  `message` order by `id` DESC";
		$res=$this->db->query($sql);
		
		$result=$res->result();
		return $result;
		
	}		
	
	public function edit_notice($id){
		
		$sql="select * from  `message` where `id` = '".$id."'";
		$res=$this->db->query($sql);
		
		$result=$res->result();
		return $result;
		
	}
	

}