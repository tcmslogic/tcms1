<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Mdl_Patient extends CI_Model {

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
	
	public function getDescription(){
		$sql="select description from `users` where `user_type`='Admin'";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result[0]->description;
	}
	
	public function updateDesc($desc)
	{
		$sql="UPDATE users SET description='$desc' where `user_type`='Admin'";
		$res=$this->db->query($sql);		
		return $res;
	}
	
	public function getNextAppointment($sid){
		//$datedaytwo = strtotime("+2 day");
		//$twodate = date('Y-m-d', $datedaytwo);
		//$datedaysevn = strtotime("+7 day");
		//$sevndate = date('Y-m-d', $datedaysevn);
		
		//$sql="select sh.start_date,pi.sur_name,pi.given_Pname from `scheduler` as sh left join `patient` as pi on pi.patient_id=sh.patient_id where `start_date`='".$twodate."' OR `start_date`='".$sevndate."'";//exit;
		$sql = "SELECT CURDATE(), start_date,staff_id, DATEDIFF(start_date, CURDATE()), pt.patient_id, pt.sur_name, pt.given_name FROM `scheduler` LEFT JOIN patient as pt ON(pt.patient_id=scheduler.patient_id) WHERE (DATEDIFF(start_date, CURDATE())=2 AND reminder='two_days') OR (DATEDIFF(start_date, CURDATE())=7 AND reminder='seven_days') AND staff_id = '".$sid."'";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;
	}
	
	public function getAptNextDshbrd(){
		$datedaytwo = strtotime("+2 day");
		$twodate = date('Y-m-d', $datedaytwo);
		$datedaysevn = strtotime("+7 day");
		$sevndate = date('Y-m-d', $datedaysevn);
		
		$sql="select sh.start_date,pi.sur_name,pi.given_name from `scheduler` as sh left join `patient` as pi on pi.patient_id=sh.patient_id where `start_date`='".$twodate."' OR `start_date`='".$sevndate."'";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;
		
	}
	
	public function getPatientStatistics($status){
		//$sql="SELECT COUNT( DISTINCT patient_id ) AS Count,STATUS , patient_id FROM `scheduler` GROUP BY STATUS";//exit;
		$sql = "SELECT COUNT( DISTINCT patient_id ) AS countp FROM `scheduler` where `status`='".$status."'";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;
	}
	
	public function getNextAptDate($patient_id)
	{
$query = $this->db->query("SELECT start_date FROM scheduler WHERE patient_id='$patient_id' AND CURDATE() < start_date ORDER BY start_date ASC LIMIT 0,1");
		$result = $query->result_array();
		if(empty($result)){
			return "";
		}
		else{		
			return $result[0]['start_date'];
		}
	}
	
	public function getStaff($sid)
	{
		$sql="select * from `users` where `user_id`='".$sid."'";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;
	}

	public function save($tablename,$data)
	{
		//print_r($data);exit;	
		$this->db->insert($tablename, $data);
		//print_r($data3);
		//echo $this->db->last_query();exit;
		
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function update($tablename,$data,$field,$rec_id)
	{
		$return=$this->db->update($tablename, $data, "$field =".$rec_id);
		//echo $this->db->last_query();exit;
		return $return;
	}
	
	/*public function delete($key)
	{
		$this->db->where('setting_key', $key);
		$this->db->delete('fi_settings');
	}*/
	
	public function add_leading_zero($value, $threshold = 2) {
		return sprintf('%0' . $threshold . 's', $value);
	}
	
	public function get_ref_number(){
		$sql="select count(patient_id) as ref_no from `patient`";
		$res=$this->db->query($sql);
		$result=$res->result();
		//print_r($result);
		$patient_number = ($result[0]->ref_no)+1;
		$new_patient_no = $this->add_leading_zero($patient_number, 3);   // 005;
		$doc_user_id = $this->session->userdata('user_id');
		$doc_id = $this->add_leading_zero($doc_user_id, 2);   // 01;
		$ref_number = "S".$doc_id.$new_patient_no;
		return $ref_number;
		//return $result;	
	}
	
	public function getPatientProfile($patient)
	{
		//print_r($patient);
		$query=$this->db->get_where('patient', array('patient_id' => $patient));
		$result=$query->result();
		if(empty($result)){
			return $result;
		}
		else
		{
			return $result[0];
		}
	}
	
	public function getPatientAttendance($pid){
		$sql="select * from `patient` as pi left join `scheduler` as sh on pi.patient_id=sh.patient_id where sh.patient_id='".$pid."'  ORDER BY start_date, time_in";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;
	}
	
	public function getSearch($search)
	{
		
		$names_exploded = explode(" ", $search);   
		// will split " " (a space!)

		$counter_words = 0;
		$qPart="";
		foreach($names_exploded as $each_name){
			
    		$counter_words++;

			//check the word count
			if($counter_words == 1){
    		$qPart .= " `sur_name` LIKE '%".$each_name."%' OR `given_name` LIKE '%".$each_name."%' OR `nric_passport` LIKE '%".$search."%' OR `mobile_no` LIKE '%".$search."%'";
			}else{
    		$qPart .= " OR `sur_name` LIKE '%$".$each_name."%' OR `given_name` LIKE '%".$each_name."%' OR `nric_passport` LIKE '%".$search."%' OR `mobile_no` LIKE '%".$search."%'";
			}

			}
		//$qPart = " `given_name` LIKE '%".$search."%' OR `nric_passport` LIKE '%".$search."%' OR `mobile_no` LIKE '%".$search."%'";
		$sql="select * from patient where $qPart order by sur_name asc";
		$res=$this->db->query($sql);
		
		$result=$res->result();
		return $result;
	}
	
	public function getAttendanceSearch($search)
	{
		
		$names_exploded = explode(" ", $search);   
		// will split " " (a space!)
		$counter_words = 0;
		$qPart="";
		foreach($names_exploded as $each_name){
			$counter_words++;
			//check the word count
			if($counter_words == 1){
    		$qPart .= " `sur_name` LIKE '%".$each_name."%' OR `given_name` LIKE '%".$each_name."%' OR `nric_passport` LIKE '%".$search."%' OR `mobile_no` LIKE '%".$search."%'";
			}else{
    		$qPart .= " OR `sur_name` LIKE '%$".$each_name."%' OR `given_name` LIKE '%".$each_name."%' OR `nric_passport` LIKE '%".$search."%' OR `mobile_no` LIKE '%".$search."%'";
			}
		}
		$sql="select * from `patient` as pi left join `scheduler` as sh on pi.patient_id=sh.patient_id where $qPart ORDER BY start_date, time_in";
		$res=$this->db->query($sql);
		
		$result=$res->result();
		return $result;
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
public function getPatientNotes($patient)
	{
		$query=$this->db->select('*')
							->from('patient_notes')
							->where('patient_id',$patient)
							->get();
		return $query->result();	
	}

public function getPatientSingleNotes($patient,$notes)
	{
		$query=$this->db->select('*')
							->from('patient_notes')
							->where('patient_id',$patient)
							->where('id',$notes)
							->get();
		return $query->result();	
	}	
	
public function getPatientReferral($patient)
	{
		$query=$this->db->select('*')
							->from('patient_referral')
							->where('patient_id',$patient)
							->get();
		return $query->result();	
	}
	
public function getPatientCertificate($patient)
	{
		$query=$this->db->select('*')
							->from('patient_certificate')
							->where('patient_id',$patient)
							->get();
		
		return $query->result();	
	}		

public function getPatientPrescription($patient)
	{
		$query=$this->db->select('*')
							->from('patient_prescription')
							->where('patient_id',$patient)
							->get();
		return $query->result();	
	}
public function get_note_details($nid){
	$sql="select * from `patient_notes` where `id`='".$nid."'";
		$res=$this->db->query($sql);
		//echo $this->db->last_query();
		$result=$res->result();
		 return $result;	
		
		
}

public function get_referral_details($rid){
	$sql="select * from `patient_referral` where `ref_id`='".$rid."'";
		$res=$this->db->query($sql);
		//echo $this->db->last_query();
		$result=$res->result();
		 return $result;	
		
		
}
public function get_certificate_details($cid){
	$sql="select * from `patient_certificate` where `cer_id`='".$cid."'";
		$res=$this->db->query($sql);
		 //echo $this->db->last_query();
		$result=$res->result();
		 return $result;	
		
		
}


public function get_prescription_details($pid){
	$sql="select * from `patient_prescription` where `pre_id`='".$pid."'";
		$res=$this->db->query($sql);
		 //echo $this->db->last_query();
		$result=$res->result();
		 return $result;	
		
		
}
	
	/*==========================*/
	
	/*public function load_settings()
	{
		$fi_settings = $this->db->get('fi_settings')->result();

		foreach ($fi_settings as $data)
		{
			$this->settings[$data->setting_key] = $data->setting_value;
		}
	}

	public function setting($key)
	{
		return (isset($this->settings[$key])) ? $this->settings[$key] : '';
	}

	public function set_setting($key, $value)
	{
		$this->settings->$key = $value;
	}
	public function getPatientProfile($patient)
	{
//		print_r($patient);
		$query=$this->db->get_where('patient', array('patient_id' => $patient));
		$result=$query->result();
		if(empty($result)){
			return $result;
		}
		else
		{
			return $result[0];
		}
	}
	public function getPatientFinancialProfile($patient)
	{
		$query=$this->db->get_where('patient_financial_profile', array('patient_id' => $patient));
		$result=$query->row(); 
		
		return $result;
	}
	
	
	
	
	public function getCreator($creator)
	{
		$query=$this->db->select('user_name')
							->from('users')
							->where('user_id',$creator)
							->get();
		$result=$query->row();
		return $result->user_name;
	}
	
	public function getSearch($search)
	{
		
		$names_exploded = explode(" ", $search);   // will split " " (a space!)

		$counter_words = 0;
		$qPart="";
		foreach($names_exploded as $each_name){
			
    		$counter_words++;

			/* check the word count */
			/*if($counter_words == 1){
    		$qPart .= " `first_name` LIKE '%".$each_name."%' OR `last_name` LIKE '%".$each_name."%'";
			}else{
    		$qPart .= " OR `first_name` LIKE '%$".$each_name."%' OR `last_name` LIKE '%".$each_name."%'";
			}

			}

		$sql="select * from patient where $qPart";
		$res=$this->db->query($sql);
		
		$result=$res->result();
		return $result;
	}
	
	public function getAdmissionData($patient)
	{
		$query=$this->db->get_where('clinical_data', array('patient_id' => $patient));
		$result=$query->row(); 
		
		return $result;
	}
	public function get_last_modify_by($uid){
		$user_detail='';
		if($uid !='0'){
			$sql="select * from  `users` where `user_id` = '".$uid."'";
			$res=$this->db->query($sql);
			$result=$res->result();
			//print_r($result);
			if(!empty($result)){
				$user_detail = $result[0]->user_type."-".$result[0]->user_fullname;
			}
		}else{
			$user_detail='';
		}
		return $user_detail;
		//return $result;
	}
	
	public function get_all_injection(){
		$sql="select * from  `injection`";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;	
	}
	
	public function get_injection($ij_id){
		$sql="select * from  `injection` where id='".$ij_id."'";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;	
	}
	
	
	public function edit_user($uid){

		$sql="select * from  `users` where `user_id` = '".$uid."'";
		$res=$this->db->query($sql);
		$result=$res->result();
		//print_r($result);
			//exit;
		return $result;
		//return $result;
	}
	
	public function get_note_data($nid){
		$sql="select * from `patient_notes` where id='".$nid."'";
		$res=$this->db->query($sql);
		$result=$res->result();
		return $result;	
	}
	
	public function RandomString($length){
		$original_string = array_merge(range(0,9));
        $original_string = implode("", $original_string);
        return substr(str_shuffle($original_string), 0, $length);
	}
	
	public function get_icno(){
		$str1= $this->RandomString(6);
	 	$str2= $this->RandomString(2);
	  	$str3= $this->RandomString(4);
	  
	  return $str1."-".$str2."-".$str3;
	}
	
	public function getattandance($patient)
 {
   $this->load->model('medication/mdl_medication');
   $this->load->model('dashboard/mdl_dashboard');
   $attadance_Detail=array();
   $patient_attancance = $this->mdl_medication->getSearch($patient);

   $patients =array();
   $machines=array();
   $injections=array();
   $status=array();
   $i=0;
   foreach($patient_attancance as $attandance)
   {
    
    $machines[]=explode(",",$attandance->machines);
    $patients[]=explode(",",$attandance->patients);
    $injections[]=explode(",",$attandance->injections);
    $status[]=explode(",",$attandance->status);
    
    for($pk=0;$pk<count($patients[$i]);$pk++){
    //print_r($machines[$i][$pk]);exit;
    if($patients[$i][$pk]!='0' && $patients[$i][$pk]==$patient){
     $psid = $patients[$i][$pk];
     $attadance_Detail[$i]['machine'] = $this->mdl_dashboard->get_machine_name($machines[$i][$pk]);
     $attadance_Detail[$i]['patient']= $this->mdl_dashboard->get_patient_name($patients[$i][$pk]);
     $attadance_Detail[$i]['injection'] = $this->mdl_dashboard->get_injection_name($injections[$i][$pk]);
     $attadance_Detail[$i]['date1']=$attandance->modified_date;
     if($status[$i][$pk]==1)
     {
      $attadance_Detail[$i]['status']='Present';
     }
     else if($status[$i][$pk]==2)
     {
      $attadance_Detail[$i]['status']='Absent';
     }
     else if($status[$i][$pk]==3)
     {
      $attadance_Detail[$i]['status']='Machine not available';
     }
     else
     {
      $attadance_Detail[$i]['status']='-';
     }
    }
     
    }
   $i++;}
  
   
   return $attadance_Detail;
   
 }*/
	
	
	
	

}

?>