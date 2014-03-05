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

class Mdl_Scheduler extends CI_Model {

	public $settings = array();

	public function GetSchedules()
	{
		$query = $this->db->select('*')
							->from('scheduler')
							->get();
		$result=$query->result();
	
		return $result;
		
		
	}
	
	
	public function save($tablename,$data)
	{
		$this->db->insert($tablename, $data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function update($tablename,$data,$where)
	{
					$this->db->where($where);
			$return=$this->db->update($tablename,$data);
			
		//$this->db->update($tablename, $data, "$field =".$rec_id);
		
		return $return;
	}
	
	public function getPatientName($patient_id){

		$query = $this->db->query("SELECT sur_name, given_name FROM patient WHERE patient_id=".$patient_id."");
		$result = $query->result_array();		

		$sur_name = $result[0]['sur_name'];
		$give_name = $result[0]['given_name'];
		return $sur_name.' '.$give_name;										
	}

	public function delete($key)
	{
		$this->db->where('id', $key);
		$this->db->delete('medication_dosage');
	}
	
	public function deleteSchedule($key)
	{
		$this->db->where('id', $key);
		$this->db->delete('scheduler');				
	}
		
	public function getHolidayId(){
		$query = $this->db->query("SELECT id, start_date FROM scheduler WHERE day='holiday' AND patient_id='' AND start_date!=''");
		$result = $query->result_array();		
		
		return $result;
	}
	
	public function getNoId(){
		$query = $this->db->query("SELECT id, start_date FROM scheduler WHERE day='no' AND patient_id='' AND start_date!=''");
		$result = $query->result_array();		
		
		return $result;
	}

	public function getInjections()
	{
		$query = $this->db->select('*')
							->from('injection')
							->get();
		$result=$query->result();
	
		return $result;
	}
	
	public function getMachines()
	{
		$query = $this->db->select('*')
							->from('machine')
							->get();
		$result=$query->result();
	
		return $result;
	}
	
	public function cal_scheduler($start_date){
		$query = $this->db->query("SELECT patient_id, day FROM scheduler WHERE start_date='$start_date'");
		$result = $query->result_array();

		return $result[0];
	}
	
	
	
	public function getPatients()
	{
		$query = $this->db->select('*')
							->from('patient')
							->get();
		$result=$query->result();
	
		return $result;
	}
	
	public function getStaff_doctor(){
		$query = $this->db->get_where('users',array('user_type'=> 'Doctor'));
		$result=$query->result();		
		return $result;								
	}
	
	public function getEventById($id)
	{
		$query=$this->db->get_where('schaduler_details', array('event_id' => $id));
		$result=$query->result();
		return $result[0];
	}
	
	public function getHolidayNW($month, $year){				
		$query = $this->db->query("SELECT DISTINCT(DATE_FORMAT(start_date,'%d')) as start_date FROM scheduler WHERE day IN ('holiday','no') AND DATE_FORMAT(start_date, '%m-%Y')='$month-$year'");
		$result=$query->result_array();
		return $result;
	}
	
	public function getHolidaysNW($month, $year){				
		$query = $this->db->query("SELECT DISTINCT(DATE_FORMAT(start_date,'%d')) as start_date FROM scheduler WHERE day IN ('holiday','no') AND DATE_FORMAT(start_date, '%m-%Y')='$month-$year' ORDER BY `start_date` ASC ");
		$result=$query->result_array();
		$date="";
		foreach($result as $day)
		{
			$date=$date.",".$day['start_date'];
		}
		$date = ltrim($date,',');
		return $date;
	}
	
	public function getEventDetails($id)
	{
		$query=$this->db->get_where('scheduler', array('id' => $id));
		$result=$query->result();
		return $result[0];
	}
	public function getShifts()
	{
		$query = $this->db->select('*')
							->from('shift_master')
							->get();
		$result=$query->result();
	
		return $result;
	}
	public function getShiftName($id)
	{	
		
		$query=$this->db->get_where('shift_master', array('id' => $id));
		$result=$query->result();
		return $result[0];
	}
	
	public function checkShiftForDay($shift,$day)
	{
		$where=array('event_name'=>$shift,
					 'DAY(start_date)'=>date("d",strtotime($day)),
					 'MONTH(start_date)'=>date("m",strtotime($day)),
					 'YEAR(start_date)'=>date("Y",strtotime($day))
					 );
		$query=$this->db->where($where)
				 ->from('scheduler')
				 ->get();
		//echo $this->db->last_query();exit;
				 
		$result=$query->result();
		return $result;
		
	}
	
	public function countShifts($date)
	{
		$where =array("DAY(start_date)"=>date("d",strtotime($date)),
					  "MONTH(start_date)"=>date("m",strtotime($date)),
					   'YEAR(start_date)'=>date("Y",strtotime($date))
					  );
					 
		$query=$this->db->where($where)
				 ->from('scheduler')
				 ->get();
		//echo $this->db->last_query();exit;
				 
		$result=$query->num_rows();
		return $result;
	}

}

?>