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

class Mdl_Admin extends CI_Model {

	public $settings = array();

	public function get_all_detail($tablename)
	{
		$query = $this->db->select('*')
							->from($tablename)
							->get();

		return $query->result();
	}
	public function get_where($tablename,$value)
	{
		$sql ="select * from `users` where `user_type` != 'Admin'";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;
	}
	
	

	public function save($tablename,$data)
	{
		
		$this->db->insert($tablename, $data);
		$id = $this->db->insert_id();
		
		return $id;
	}
	public function update($table,$field,$where)
	{
		$this->db->set($field);
        $this->db->where($where);
       $query = $this->db->update($table);
	   
	   return $query;
		//print_r($this->db->last_query());
		//die;
	}
	
	public function edit_user($uid){
		//echo $uid;
		$query = "select * from users where user_id='$uid'";
		$result = $this->db->query($query);
		return $result->result();				
	}
	 
	public function check_user_available($uname){
		$sql ="select `user_name` from `users` where `user_name`='".$uname."'";
		$res=$this->db->query($sql);
		$result=$res->result();
		if(count($result)>0){
			//echo json_encode(array('result'=>'notallow','data'=>$uname.' already exist!','color'=>'red'));
			return array('result'=>'notallow','string'=>$uname.' already exist!','color'=>'red');
		}else{
			//echo json_encode(array('result'=>'allow','data'=>$uname.' not exist! You can use it.','color'=>'green'));
			return array('result'=>'allow','string'=>$uname.' not exist! You can use it.','color'=>'green');
		}
	}
}

?>
