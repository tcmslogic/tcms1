<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Mdl_report extends CI_Model {
	public $settings = array();

	public function getAllPatients()
	{
		$query = $this->db->select('*')
							->from('patient')
							->order_by('sur_name','asc')
							->get();

		return $query->result();
	}	
	
	public function getAllDoctors()
	{
		$sql="select * from `users` where `user_type`='Doctor'";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;
	}
	
	public function getPatient($month, $year){
		$sql="select  DISTINCT patient_id AS patient_id from scheduler WHERE DATE_FORMAT(start_date, '%m-%Y') AND patient_id <> ''";				
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;
	}
	
	public function getList(){
		$month = date('m');
		$year = date('Y');
		$sql = "select DISTINCT patient_id AS patient_id FROM scheduler WHERE patient_id<> '' AND DATE_FORMAT(start_date, '%m-%Y')='$month-$year'";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;
	}
	
	public function getNextDate($patient_id){
		$sql = "select MIN(start_date) AS next_date FROM scheduler WHERE patient_id='$patient_id' AND start_date >= CURDATE()";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result[0]->next_date;		
	}
	
	public function getPatientName($patient)
	{
		$query = $this->db->select('given_name,sur_name')
							->from('patient')
							->where('patient_id',$patient)
							->get();
			
		$result=$query->row(); 

		return $result;
	}
	
	public function getCount($month, $year, $status, $patient_id){
$sql="select count(*) as present FROM scheduler WHERE DATE_FORMAT(start_date, '%m-%Y')='$month-$year' AND patient_id='$patient_id' AND status='$status'";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result[0]->present;
	}
	
	
	public function getDCount($gender, $start_date, $end_date, $search, $year, $month, $status, $patient_id){
//$sql="select count(*) as present FROM scheduler WHERE start_date>='$start_date' AND end_date<='$end_date' AND patient_id='$patient_id' AND status='$status'";
		if($month!="" && $year!=""){ $where = "DATE_FORMAT(start_date, '%m-%Y')='$month-$year'"; }
		if($month=="" && $year==""){ $where = "1";}
$sql="select count(*) as present FROM scheduler WHERE $where AND patient_id='$patient_id' AND status='$status'";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result[0]->present;
	}
	
	public function getAptmntCount($patient_id){
		$sql="select MIN(start_date) AS next_date FROM scheduler WHERE patient_id='$patient_id' AND start_date >= CURDATE()";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result[0]->next_date;
	}
	
	public function getSearch($gender,$start_date,$end_date, $search, $year, $month)
	{		
		if($gender!=""){ 
			if($search!=""){ $gender = "gender='$gender' AND"; }
			else{ $gender="gender='$gender'"; }
		}
		
		if($search!=""){ 
			if($gender!=""){ 
				$names_exploded = explode(" ", $search); 
				$counter_words = 0; $search="";
				foreach($names_exploded as $each_name){ $counter_words++;
					if($counter_words == 1){ $search .= " sur_name LIKE '%".$each_name."%' OR given_name LIKE '%".$each_name."%' AND 1";}
					else{$search .= " OR sur_name LIKE '%$".$each_name."%' OR given_name LIKE '%".$each_name."%' AND 1";}
				}	 }
			else{ 
				$names_exploded = explode(" ", $search); 
				$counter_words = 0; $search="";
				foreach($names_exploded as $each_name){ $counter_words++;
					if($counter_words == 1){ $search .= " sur_name LIKE '%".$each_name."%' OR given_name LIKE '%".$each_name."%' AND 1";}
					else{$search .= " OR sur_name LIKE '%$".$each_name."%' OR given_name LIKE '%".$each_name."%' AND 1";}
				}								
			}
		}else{ if($gender==""){ $search = "1";} }
		
		
		if($month==""){
		if($year!=""){
			$year="DATE_FORMAT(start_date, '%Y')='$year'";
		}}else{
			$year="DATE_FORMAT(start_date, '%m-%Y')='$month-$year'";
		}
	//	$sql = "SELECT DISTINCT patient_id AS patient_id FROM scheduler WHERE patient_id IN (SELECT patient_id FROM patient WHERE $gender $search) AND start_date>='$start_date' AND end_date<='$end_date'";
		$sql = "SELECT DISTINCT patient_id AS patient_id FROM scheduler WHERE patient_id IN (SELECT patient_id FROM patient WHERE $gender $search ) AND $year";
		$res=$this->db->query($sql);
		return $result=$res->result();
	}
	
	public function getSearchAptmnt($gender,$start_date,$end_date, $search, $year, $month)
	{		
		if($gender!=""){ 
			if($search!=""){ $gender = "gender='$gender' AND"; }
			else{ $gender="gender='$gender'"; }
		}
		
		if($search!=""){ 
			if($gender!=""){ 
				$names_exploded = explode(" ", $search); 
				$counter_words = 0; $search="";
				foreach($names_exploded as $each_name){ $counter_words++;
					if($counter_words == 1){ $search .= " sur_name LIKE '%".$each_name."%' OR given_name LIKE '%".$each_name."%' AND 1";}
					else{$search .= " OR sur_name LIKE '%$".$each_name."%' OR given_name LIKE '%".$each_name."%' AND 1";}
				}	 }
			else{ 
				$names_exploded = explode(" ", $search); 
				$counter_words = 0; $search="";
				foreach($names_exploded as $each_name){ $counter_words++;
					if($counter_words == 1){ $search .= " sur_name LIKE '%".$each_name."%' OR given_name LIKE '%".$each_name."%' AND 1";}
					else{$search .= " OR sur_name LIKE '%$".$each_name."%' OR given_name LIKE '%".$each_name."%' AND 1";}
				}								
			}
		}else{ if($gender==""){ $search = "1";} }
		
		
		if($month==""){
		if($year!=""){
			$year="DATE_FORMAT(start_date, '%Y')='$year'";
		}}else{
			$year="DATE_FORMAT(start_date, '%m-%Y')='$month-$year'";
		}
		
		if($search=="" && $gender==""){ $in = "1";}
		else{ $in="patient_id IN (SELECT patient_id FROM patient WHERE $gender $search )"; }
	//	$sql = "SELECT DISTINCT patient_id AS patient_id FROM scheduler WHERE patient_id IN (SELECT patient_id FROM patient WHERE $gender $search) AND start_date>='$start_date' AND end_date<='$end_date'";
		$sql = "SELECT DISTINCT patient_id AS patient_id FROM scheduler WHERE $in AND $year";
		$res=$this->db->query($sql);
		return $result=$res->result();
	}
}
?>