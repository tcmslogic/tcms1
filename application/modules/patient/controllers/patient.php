<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Patient extends Admin_Controller {
	
	public $patient_id;
	public $patient_name;
    public function __construct()
    {
        parent::__construct();
		
        $this->load->model('mdl_patient');
		$this->load->helper('image');
		//$this->load->library('encrypt');
		//var_dump($this->load->library("pagination"));exit;
		//$this->load->library('upload');
    }

    public function index()
    {
		$patients=$this->mdl_patient->getAllPatients();
		
		
		$this->layout->set(
            array(
                'patients' => $patients
            )
		);
		 $this->layout->buffer('content', 'patient/patient');
        $this->layout->render();
    }

	/*********************************** get patient profile ************************************/
	
	public function patient_profile()
	{
		$patient_id=base64_decode($this->uri->segment(3));
		
		$patient_profile=$this->mdl_patient->getPatientProfile($patient_id);

		$this->layout->set(
			array(
			"patient_profile"=>$patient_profile,
				//"patient_finance"=>$patient_finance,
				  "patient_id"=>$patient_id)
		);
		
		$this->layout->buffer('content','patient/patient_profile');
		$this->layout->render();
	}
	
	public function add_patient()
	{
		
		if($this->input->post())
		{
			$data=array();
			
			$mark=$this->input->post("mark");
			$mark_string='';
			//echo "<pre>";
			//print_r($mark);
			
			
			if(!empty($mark) && count($mark)>0){
				for($ik=0;$ik<count($mark);$ik++){
					$mark_string.=$mark[$ik];
					if($ik<(count($mark)-1)){
						$mark_string.=",";
					}	
				}	
			}
			//echo $mark_string;
			//exit;
			
			foreach($this->input->post() as $key => $val)
			{
				
				if($key!='submit')
				{
					$data[$key]=$val;
				}
			}
			$data['mark'] =$mark_string; 
			
			$data['date_of_birth']=date("Y-m-d h:i:s",strtotime($this->input->post("date_of_birth")));
			$data['date_of_admission']=date("Y-m-d h:i:s",strtotime($this->input->post("date_of_admission")));
			
			$result = $this->mdl_patient->updateDesc($this->input->post("description"));
			$result=$this->mdl_patient->save('patient',$data);
			
			if($result!='')
			{
				echo json_encode(array('uid'=>base64_encode($result)));exit;
				//echo $result;
				//redirect("patient/patient_profile/".$result,"refresh");
			}
		}
		$this->layout->buffer('content','patient/add_patient');
		$this->layout->render();
	}
	

	
	/******************************* edit patient function ****************************************/
	
	public function edit_patient()
	{
		$access_level=array("Reception","Admin");
		if(!in_array($this->session->userdata("user_type"),$access_level))
		{
			redirect("dashboard","refresh");
		}
		$data=array();
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)):$this->input->post("patient_id");
		if($this->input->post())
		{
			
			$patient=$this->input->post("patient_id");
			$mark=$this->input->post("mark");
			$mark_string='';
			//echo "<pre>";
			//print_r($mark);exit;
			
			
			if(!empty($mark) && count($mark)>0){
				for($ik=0;$ik<count($mark);$ik++){
					$mark_string.=$mark[$ik];
					if($ik<(count($mark)-1)){
						$mark_string.=",";
					}	
				}	
			}
			//echo $mark_string;
			//exit;
			foreach($this->input->post() as $key => $val)
			{
				
				if($key!='submit')
				{
					$data[$key]=$val;
				}
			}
			$data['mark'] =$mark_string; 
				//	echo 	$this->input->post("date_of_birth"); exit;
			$data['date_of_birth']=date("Y-m-d h:i:s",strtotime($this->input->post("date_of_birth")));
			$data['date_of_admission']=date("Y-m-d h:i:s",strtotime($this->input->post("date_of_admission")));
		
			$result = $this->mdl_patient->updateDesc($this->input->post("description"));
			$result=$this->mdl_patient->update('patient',$data,"patient_id",$patient);
			//redirect('patient/patient_profile/'.$patient_id,'refresh');
			echo json_encode(array('uid'=>base64_encode($patient_id)));exit;
			
		}
		
		//$result = $this->mdl_patient->updateDesc($this->input->post("description"));
		$patient_profile=$this->mdl_patient->getPatientProfile($patient_id);
		//$this->patient_name=$patient_profile->first_name.' '.$patient_profile->last_name;
		
		$this->layout->set(
			array(
				"patient_profile"=>$patient_profile,
				"patient_id"=>$patient_id)
		);
		
		$this->layout->buffer('content','patient/edit_patient');
		$this->layout->render();
		
	}
	/*************Patient Attendance**************/
	
	public function patient_attendance()
	{
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		$patient_details = $this->mdl_patient->getPatientAttendance($patient_id);
		$this->layout->set(
			array("patient_id"=>$patient_id,
				  "patient_details"=>$patient_details,
				  //"patient_notes"=>$patient_notes
				  ));
		$this->layout->buffer('content','patient/patient_attendance');
		$this->layout->render();
	}
	
	
	
	/************************************** ajax response function for search results**************/
	public function check_nric_no(){
		$nric = $_REQUEST['nric'];
		$sql="select `nric_passport` from `patient` where `nric_passport`='".$nric."'";
		$res=$this->db->query($sql);
		$result=$res->result();
		if(count($result)>0){
			echo "no";
		}else{
			echo "yes";
		}
	}
	
	public function check_nric_no_paitient(){
		$nric = $_REQUEST['nric'];
		$paid = $_REQUEST['paid'];
		$sql="select `nric_passport` from `patient` where `nric_passport`='".$nric."' and `patient_id`='".$paid."'";
		$res=$this->db->query($sql);
		$result=$res->result();
		if(count($result)==1){
			echo "yes";
		}else{
			$sql1="select `nric_passport` from `patient` where `nric_passport`='".$nric."'";
			$res1=$this->db->query($sql1);
			$result1=$res1->result();
			if(count($result1)>0){
				echo "no";
			}else{
				echo "yes";
			}
		}	
	}
	
	////////////////****Patinent Form/Profile Print/PDF*****************///////
	public function generate_patient_pdf($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $patient_id = base64_decode($patient_id);
        generate_patient_profile_pdf($patient_id, $stream, $order_template);
    }
	 public function generate_patient_print($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
		 $patient_id = base64_decode($patient_id);
        generate_patient_profile_pdf($patient_id, $stream, $order_template,$print);
    }
	
	public function getAttendance()
	{
			$search=mysql_real_escape_string(htmlentities(trim($this->input->post("search"))));
			$result=$this->mdl_patient->getAttendanceSearch($search);
			$html="";
			$html.=' <table class="activity_datatable" width="100%"   border="0" cellspacing="0" cellpadding="8">
              <tbody>
              <tr>
                <th width="20%">Name      </th>
                <th width="15%">Date </th>
                <th width="12%">Status</th>                                                  
              </tr> ';
			if(!empty($result)){
			
			foreach($result as $patient)
			{
				$color = '';
				if(($patient->status)=='present'){
					$color = '';
				}else if(($patient->status)=='dropout'){
					$color = '#FF5353';
				}else if(($patient->status)=='noschedule'){
					$color = '#FF9';
				}
				$html.='<tr>';
				$html.='<td style="background:'.$color.' !important;"><a href="'.site_url("patient/patient_profile/".base64_encode($patient->patient_id)).'">'.ucfirst($patient->sur_name).' '.ucfirst($patient->given_name).'</a></td>';
				$html.='<td style="background:'.$color.' !important;">'.date('d M Y',strtotime($patient->start_date)).'</td>';
				//$html.='<td>'.$patient->time_in.'</td>';
				//$html.='<td>'.$patient->time_out.'</td>';
				//$staff_name = $this->mdl_patient->getStaff($patient->staff_id);
				//if(!empty($staff_name)){
					//$sname = $staff_name[0]->user_fullname;
				//}else{
					//$sname='';
				//}
				//$html.='<td>'.$sname.'</td>';
				$html.='<td style="background:'.$color.' !important;">'.ucfirst($patient->status).'</td>';
			$html.='</tr>';
			}
			}
			else
			{
				$html.="<tr><td colspan='5'><h3>No Records Found</h3></td></tr>";
			}
			
			$data = array('result'=>$html,'total_record'=>count($result),'per_page'=>2);
			echo json_encode($data);
			
	}
	
	
	public function getSearch()
	{
			$search=mysql_real_escape_string(htmlentities(trim($this->input->post("search"))));
			
			$result=$this->mdl_patient->getSearch($search);
			$html="";
			$html.=' <table class="activity_datatable" width="100%"   border="0" cellspacing="0" cellpadding="8">';
			$html.='<thead>';
			$html.='<tr>';
				$html.='<th width="20%">Name      </th>';
                $html.='<th width="15%">Phone </th>';
                $html.='<th width="12%">NRIC/Passport</th>';
                $html.='<th width="32%">NEXT APPOINTMENT</th>';
			$html.='</tr>';
			$html.='</thead>';
			$html.='<tbody>';
			if(!empty($result)){
			
			foreach($result as $patient)
			{
				 if($this->mdl_patient->getNextAptDate($patient->patient_id)!=""){
				  $date = date("d M Y",strtotime($this->mdl_patient->getNextAptDate($patient->patient_id)));
				 }
				 else{
					$date = "---";
				 }
				$html.='<tr>';
				$html.='<td><a href="'.site_url("patient/patient_profile/".base64_encode($patient->patient_id)).'">'.ucfirst($patient->sur_name).' '.ucfirst($patient->given_name).'</a></td>';
				$html.='<td><span class="blue_highlight pj_cat">'.$patient->mobile_no.' Mobile</span></td>';
				$html.='<td>'.$patient->nric_passport.'</td>';
				$html.='<td>'.$date.'</td>';
			$html.='</tr>';
			}
			}
			else
			{
				$html.="<tr><td colspan='4'><h3>No Records Found</h3></td></tr>";
			}
			$html.="</tbody></table>";
			if(!empty($result)){
				$html.='<div id="paginationtable" style="margin: auto;"></div>';
	
			}
	//echo $html;
	
			$data = array('result'=>$html,'total_record'=>count($result),'per_page'=>2);
			echo json_encode($data);	
			
	}
	
	/*********************************** fetch all notes of perticular patient***********************/
	
	public function notes()
	{
		$access_level=array("Manager1","Reception");
		if(in_array($this->session->userdata("user_type"),$access_level))
		{
			redirect("dashboard","refresh");
		}
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		$patient_name=$this->mdl_patient->getPatientName($patient_id);
		$patient_notes=$this->mdl_patient->getPatientNotes($patient_id);
		
		
		$this->layout->set(
			array("patient_id"=>$patient_id,
				  "patient_name"=>$patient_name,
				  "patient_notes"=>$patient_notes)
		);
		$this->layout->buffer('content','patient/notes');
		$this->layout->render();
	}
	
	/*****************************Add Referral*************************************/
	public function referral()
	{
		$access_level=array("Manager1","Reception");
		if(in_array($this->session->userdata("user_type"),$access_level))
		{
			redirect("dashboard","refresh");
		}
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		
		$patient_name=$this->mdl_patient->getPatientName($patient_id);
		$patient_referral=$this->mdl_patient->getPatientReferral($patient_id);
		//echo "<pre>";print_r($patient_referral);exit;
		
		$this->layout->set(
			array("patient_id"=>$patient_id,
				  "patient_name"=>$patient_name,
				  "patient_referral"=>$patient_referral)
		);
		$this->layout->buffer('content','patient/referral');
		$this->layout->render();
	}
		/****ADD Referral****/

		public function add_referral()
	{
		$this->load->helper('image');
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		//$patient_id=($this->uri->segment(3)!="")? $this->uri->segment(3):$this->input->post("patient_id");
		$patients=$this->mdl_patient->getAllPatients();
		if($this->input->post())
		{
			//print_r($this->input->post());exit;
			//$image_file=image_upload($_FILES['userfile'],"companylogo");
			foreach($this->input->post() as $key=>$val)
			{
				if($key!='submit')
				{
					$data[$key] = $val;
				}
			}
			$data['created_date']=date("Y-m-d h:i:s");
			$data['modified_date']=date("Y-m-d h:i:s");
			$data['modified_by']=$this->session->userdata("user_id");
			$data['patient_id']= base64_decode($patient_id);
			
			$result=$this->mdl_patient->save("patient_referral",$data);
			
			if($result)
			{
				redirect("patient/referral/".$patient_id,"refresh");
			}
		}
		
		$this->layout->set(
			array("patients"=>$patients,"patient_id"=>$patient_id)
		);
		$this->layout->buffer('content','patient/add_referral');
		$this->layout->render();
	}
	
	/****Edit Referral****/
	
	public function edit_referral()
	{
		
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		$ref_id=(base64_decode($this->uri->segment(4))!="")? base64_decode($this->uri->segment(4)): $this->input->post("ref_id");
		$patients=$this->mdl_patient->getAllPatients();
		if($this->input->post())
		{
			 //print_r($this->input->post());exit;
			//$image_file=image_upload($_FILES['userfile'],"companylogo");
			
			$data['created_date']=date("Y-m-d h:i:s");
			$data['modified_date']=date("Y-m-d h:i:s");
			 
			$data['modified_by']=$this->session->userdata("user_id");
			//$referral_deta = $this->mdl_patient->get_referral_details($ref_id);
			
			
			
			foreach($this->input->post() as $key=>$val)
			{
				if($key!='submit' )
				{
					$data[$key] = $val;
				}
			}
			$data['patient_id']= $patient_id;
			//echo "<pre>";
			//print_r($data);exit;
			$result=$this->mdl_patient->update("patient_referral",$data,"ref_id",$ref_id);
			
			if($result)
			{
				redirect("patient/referral/".base64_encode($patient_id),"refresh");
			}
		}
		$referral_details=$this->mdl_patient->get_referral_details($ref_id);
		$this->layout->set(
			array("patients"=>$patients,"patient_id"=>$patient_id,"ref_id"=>$ref_id,"referral_details"=>$referral_details)
		);
		$this->layout->buffer('content','patient/edit_referral');
		$this->layout->render();
	}

	
	
	/****View Referral****/
	
	public function view_referral(){
		$patient_id=base64_decode($this->uri->segment(3));
		$ref_id=base64_decode($this->uri->segment(4));
		if($this->input->post("edit")!=""){
			
			$pid = $this->input->post("patient_id");
			$rid = $this->input->post("ref_id");
					
			$data = array();
			$data['assessment'] = $this->input->post("assessment");
			$data['treatment'] = $this->input->post("treatment");
			$data['modified_date']=date("Y-m-d h:i:s");
			$data['modified_by']=$this->session->userdata("user_id");
			
		$usertype=$this->session->userdata('user_type');
		if($usertype=='Doctor'){
			
		$reviewed_by=$this->session->userdata("user_id");
			$data['reviewed_by']=$reviewed_by;
		$data['reviewed_by_date']=date('y-m-d');
		$this->mdl_patient->update("patient_referral",$data,"ref_id",$rid);
		}
			
			
			$result=$this->mdl_patient->update('patient_referral',$data,"ref_id",$id);
			
			redirect('patient/referral/'.$pid,'refresh');
			//$this->layout->buffer('content','patient/notes');
			//$this->layout->render();
			//exit;
		}else{
		$usertype=$this->session->userdata('user_type');
		$reviewed_by=$this->session->userdata("user_id");
		$data['reviewed_by']=$reviewed_by;
		$data['reviewed_by_date']=date('y-m-d');
		if($usertype=='Doctor'){
		$this->mdl_patient->update("patient_referral",$data,"ref_id",$ref_id);
		}
			$referral_data = $this->mdl_patient->get_note_data($ref_id);
			
			$this->layout->set(
				array("patient_id"=>$patient_id,"patient_referral"=>$referral_data)
			);
			
			$this->layout->buffer('content','patient/view_referral');
			$this->layout->render();
			//exit;
		}
		//$this->layout->render();
		
	}
	
	
	/**** Medical Certificate ****/
	public function certificate()
	{
		$access_level=array("Manager1","Reception");
		if(in_array($this->session->userdata("user_type"),$access_level))
		{
			redirect("dashboard","refresh");
		}
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		
		$patient_name=$this->mdl_patient->getPatientName($patient_id);
		$patient_certificate=$this->mdl_patient->getPatientCertificate($patient_id);
		//echo "<pre>";print_r($patient_referral);exit;
		
		$this->layout->set(
			array("patient_id"=>$patient_id,
				  "patient_name"=>$patient_name,
				  "patient_certificate"=>$patient_certificate)
		);
		$this->layout->buffer('content','patient/certificate');
		$this->layout->render();
	}
	/****ADD certificate****/

		public function add_certificate()
	{
		
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		$patients=$this->mdl_patient->getAllPatients();
		$doctors=$this->mdl_patient->getAllDoctors();
			
		if($this->input->post())
		{
			//print_r($this->input->post());exit;
			//$image_file=image_upload($_FILES['userfile'],"companylogo");
			foreach($this->input->post() as $key=>$val)
			{
				if($key!='submit')
				{
					$data[$key] = $val;
				}
			}
			$data['created_date']=date("Y-m-d h:i:s");
			$data['modified_date']=date("Y-m-d h:i:s");
			$data['modified_by']=$this->session->userdata("user_id");
			$data['patient_id']=base64_decode($patient_id);
			
			$result=$this->mdl_patient->save("patient_certificate",$data);
			
			if($result)
			{
				redirect("patient/certificate/".$patient_id,"refresh");
			}
		}
		
		$this->layout->set(
			array("patient_id"=>$patient_id,"doctors"=>$doctors,"patients"=>$patients)
		);
		$this->layout->buffer('content','patient/add_certificate');
		$this->layout->render();
	}
	/****Edit Referral****/
	
	public function edit_certificate()
	{
		
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		$cer_id=(base64_decode($this->uri->segment(4))!="")? base64_decode($this->uri->segment(4)): $this->input->post("cer_id");
		$patients=$this->mdl_patient->getAllPatients();
		$doctors=$this->mdl_patient->getAllDoctors();
		
		if($this->input->post())
		{
			 //print_r($this->input->post());exit;
			//$image_file=image_upload($_FILES['userfile'],"companylogo");
			
			$data['created_date']=date("Y-m-d h:i:s");
			$data['modified_date']=date("Y-m-d h:i:s");
			 
			$data['modified_by']=$this->session->userdata("user_id");
			$certificate_deta = $this->mdl_patient->get_certificate_details($cer_id);
			
			
			
			foreach($this->input->post() as $key=>$val)
			{
				if($key!='submit' )
				{
					$data[$key] = $val;
				}
			}
			$data['patient_id']= base64_decode($patient_id);
			
			//echo "<pre>";
			//print_r($data);exit;
			$result=$this->mdl_patient->update("patient_certificate",$data,"cer_id",$cer_id);
			
			if($result)
			{
				redirect("patient/certificate/".$patient_id,"refresh");
			}
		}
		$certificate_details=$this->mdl_patient->get_certificate_details($cer_id);
		$this->layout->set(
			array("patient_id"=>$patient_id,"cer_id"=>$cer_id,"certificate_details"=>$certificate_details,"doctors"=>$doctors,"patients"=>$patients)
		);
		$this->layout->buffer('content','patient/edit_certificate');
		$this->layout->render();
	}
	
	
	
	/****End Medical Certificate****/
	
	/*****************************Add Prescription*************************************/
	
	public function prescription()
	{
		$access_level=array("Manager1","Reception");
		 $patients=$this->mdl_patient->getAllPatients();
	 	if(in_array($this->session->userdata("user_type"),$access_level))
		{
			redirect("dashboard","refresh");
		}
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		
		$patient_name=$this->mdl_patient->getPatientName($patient_id);
		$patient_prescription=$this->mdl_patient->getPatientPrescription($patient_id);
		//echo "<pre>";print_r($patient_referral);exit;
		
		$this->layout->set(
			array("patient_id"=>$patient_id,
				  "patient_name"=>$patient_name,
				  "patient_prescription"=>$patient_prescription)
		);
		$this->layout->buffer('content','patient/prescription');
		$this->layout->render();
	}
	
	/****ADD Prescription****/

		public function add_prescription()
	{
		 $patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		 $patient_name=$this->mdl_patient->getPatientName($patient_id);
		
		if($this->input->post())
		{
			foreach($this->input->post() as $key=>$val)
			{
				if($key!='submit')
				{
					$data[$key] = $val;
				}
			}
			$data['created_date']=date("Y-m-d h:i:s");
			$data['modified_date']=date("Y-m-d h:i:s");
			$data['modified_by']=$this->session->userdata("user_id");
			$data['patient_id']= base64_decode($patient_id);
			
			$result=$this->mdl_patient->save("patient_prescription",$data);
			
			if($result)
			{
				redirect("patient/prescription/".$patient_id,"refresh");
			}
		}
		
		$this->layout->set(
			array("patient_id"=>$patient_id,"patient_name"=>$patient_name)
		);
		$this->layout->buffer('content','patient/add_prescription');
		$this->layout->render();
	}
	public function edit_prescription()
	{
		
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		$pre_id=(base64_decode($this->uri->segment(4))!="")? base64_decode($this->uri->segment(4)): $this->input->post("pre_id");
		$patient_name=$this->mdl_patient->getPatientName($patient_id);
		
		if($this->input->post())
		{
			 //print_r($this->input->post());exit;
			//$image_file=image_upload($_FILES['userfile'],"companylogo");
			
			$data['created_date']=date("Y-m-d h:i:s");
			$data['modified_date']=date("Y-m-d h:i:s");
			 
			$data['modified_by']=$this->session->userdata("user_id");
			
			foreach($this->input->post() as $key=>$val)
			{
				if($key!='submit' )
				{
					$data[$key] = $val;
				}
			}
			$data['patient_id']= base64_decode($patient_id);
			
			//echo "<pre>";
			//print_r($data);exit;
			$result=$this->mdl_patient->update("patient_prescription",$data,"pre_id",$pre_id);
			
			if($result)
			{
				redirect("patient/prescription/".$patient_id,"refresh");
			}
		}
		$prescription_details=$this->mdl_patient->get_prescription_details($pre_id);
		//echo "<pre>";print_r($prescription_details);exit;
		$this->layout->set(
			array("patient_id"=>$patient_id,"pre_id"=>$pre_id,"prescription_details"=>$prescription_details,"patient_name"=>$patient_name)
		);
		$this->layout->buffer('content','patient/edit_prescription');
		$this->layout->render();
	}
	
	/****Edit Prescription****/
	
	/*****************************End Prescription*************************************/
	
	/*************************************** add new note for patient *******************************/
	
	public function add_note()
	{
		$this->load->helper('image');
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		$patient_name=$this->mdl_patient->getPatientName(base64_decode($this->input->post("patient_id")));
		if(!empty($patient_name)){
			$img_name = ucfirst($patient_name->sur_name).ucfirst($patient_name->given_name);
		}else{
			$img_name='DemoTest';	
		}
		if($this->input->post())
		{
			
			foreach($this->input->post() as $key=>$val)
			{
				if($key!='submit')
				{
					$data[$key] = $val;
				}
			}
			$data['created_date']=date("Y-m-d h:i:s");
			$data['modified_date']=date("Y-m-d h:i:s");
			$data['modified_by']=$this->session->userdata("user_id");
			$data['patient_id'] = base64_decode($patient_id);
			
			$image_file = image_upload_notes($_FILES['img1'],$img_name."01-".date("Ymd"));
			$data['img1'] = $image_file;
		 	
			$image_file1 = image_upload_notes($_FILES['img2'],$img_name."02-".date("Ymd"));
			$data['img2'] = $image_file1;
		 
		 	$image_file2 = image_upload_notes($_FILES['img3'],$img_name."03-".date("Ymd"));
			$data['img3'] = $image_file2;
			
			$image_file3 = image_upload_notes($_FILES['img4'],$img_name."04-".date("Ymd"));
			$data['img4'] = $image_file3;
			
			$image_file4 = image_upload_notes($_FILES['img5'],$img_name."05-".date("Ymd"));
			$data['img5'] = $image_file4;
			
			$image_file5 = image_upload_notes($_FILES['img6'],$img_name."06-".date("Ymd"));
			$data['img6'] = $image_file5;
			
			$image_file6 = image_upload_notes($_FILES['img7'],$img_name."07-".date("Ymd"));
			$data['img7'] = $image_file6;
			
			$image_file7 = image_upload_notes($_FILES['img8'],$img_name."08-".date("Ymd"));
			$data['img8'] = $image_file7;
			
			$image_file8 = image_upload_notes($_FILES['img9'],$img_name."09-".date("Ymd"));
			$data['img9'] = $image_file8;
		
			$image_file9 = image_upload_notes($_FILES['img10'],$img_name."10-".date("Ymd"));
			$data['img10'] = $image_file9; 
			
				$result=$this->mdl_patient->save("patient_notes",$data);
			
			if($result)
			{
				redirect("patient/notes/".$patient_id,"refresh");
			}
		}
		
		$this->layout->set(
			array("patient_id"=>$patient_id)
		);
		$this->layout->buffer('content','patient/add_note');
		$this->layout->render();
	}
	
	public function edit_note()
	{
		$this->load->helper('image');
		$patient_id=(base64_decode($this->uri->segment(3))!="")? base64_decode($this->uri->segment(3)): $this->input->post("patient_id");
		$note_id=(base64_decode($this->uri->segment(4))!="")? base64_decode($this->uri->segment(4)): $this->input->post("note_id");
		
		$patient_name=$this->mdl_patient->getPatientName(base64_decode($this->input->post("patient_id")));
		if(!empty($patient_name)){
			$img_name = ucfirst($patient_name->sur_name).ucfirst($patient_name->given_name);
		}else{
			$img_name='DemoTest';	
		}
		
		if($this->input->post())
		{
			//echo "<pre>";print_r($this->input->post());exit;
			//$image_file=image_upload($_FILES['userfile'],"companylogo");
			
			$data['created_date']=date("Y-m-d h:i:s");
			$data['modified_date']=date("Y-m-d h:i:s");
			 
			$data['modified_by']=$this->session->userdata("user_id");
			$note_deta = $this->mdl_patient->get_note_details($note_id);
			
			if($_FILES['img1']['name'] !="" ){
				$image_file = image_upload_notes($_FILES['img1'],$img_name."01-".date("Ymd"));
			$data['img1'] = $image_file; 
				
			}else{
			$data['img1'] = $this->input->post('img11');	 
			
			}
			
			if($_FILES['img2']['name'] !="")
			{
				 $image_file1 = image_upload_notes($_FILES['img2'],$img_name."02-".date("Ymd"));
			$data['img2'] = $image_file1;
				
			}else{
				 
			$data['img2'] = $this->input->post('img22');
			}
			
			if($_FILES['img3']['name'] !="")
			{
				 $image_file2 = image_upload_notes($_FILES['img3'],$img_name."03-".date("Ymd"));
			$data['img3'] = $image_file2;
				
			}else{
				 
			$data['img3'] = $this->input->post('img33');
			}
			if($_FILES['img4']['name'] !="")
			{
				 $image_file3 = image_upload_notes($_FILES['img4'],$img_name."04-".date("Ymd"));
			$data['img4'] = $image_file3;
				
			}else{
				 
			$data['img4'] = $this->input->post('img44');
			}
			
			if($_FILES['img5']['name'] !="")
			{
				 $image_file4 = image_upload_notes($_FILES['img5'],$img_name."05-".date("Ymd"));
			$data['img5'] = $image_file4;
				
			}else{
				 
			$data['img5'] = $this->input->post('img55');
			}
			if($_FILES['img6']['name'] !="")
			{
				 $image_file5 = image_upload_notes($_FILES['img6'],$img_name."06-".date("Ymd"));
			$data['img6'] = $image_file5;
				
			}else{
				 
			$data['img6'] = $this->input->post('img66');
			}
			
			if($_FILES['img7']['name'] !="")
			{
				 $image_file6 = image_upload_notes($_FILES['img7'],$img_name."07-".date("Ymd"));
			$data['img7'] = $image_file6;
				
			}else{
				 
			$data['img7'] = $this->input->post('img77');
			}
			
			if($_FILES['img8']['name'] !="")
			{
				 $image_file7 = image_upload_notes($_FILES['img8'],$img_name."08-".date("Ymd"));
			$data['img8'] = $image_file7;
				
			}else{
				 
			$data['img8'] = $this->input->post('img88');
			}
			
			if($_FILES['img9']['name'] !="")
			{
				 $image_file8 = image_upload_notes($_FILES['img9'],$img_name."09-".date("Ymd"));
			$data['img9'] = $image_file8;
				
			}else{
				 
			$data['img9'] = $this->input->post('img99');
			}
			
			if($_FILES['img10']['name'] !="")
			{
				 $image_file9 = image_upload_notes($_FILES['img10'],$img_name."10-".date("Ymd"));
			$data['img10'] = $image_file9;
				
			}else{
				 
			$data['img10'] = $this->input->post('img110');
			}
			
			foreach($this->input->post() as $key=>$val)
			{
				if($key!='submit' && $key!='img11' && $key!='img22' && $key!='img33' && $key!='img44' && $key!='img55' && $key!='img66' && $key!='img77' && $key!='img88' && $key!='img99' && $key!='img110')
				{
					$data[$key] = $val;
				}
			}
			$data['patient_id'] = $patient_id;
			//echo "<pre>";
			//print_r($data);exit;
			//echo $note_id;exit;
			
			$result=$this->mdl_patient->update("patient_notes",$data,"id",$note_id);
			
			if($result)
			{
				redirect("patient/notes/".base64_encode($patient_id),"refresh");
			}
		}
		$note_details=$this->mdl_patient->get_note_details($note_id);
		$this->layout->set(
			array("patient_id"=>$patient_id,"note_id"=>$note_id,"note_details"=>$note_details)
		);
		$this->layout->buffer('content','patient/edit_note');
		$this->layout->render();
	}
	
	public function view_note(){
		$patient_id=base64_decode($this->uri->segment(3));
		$note_id=base64_decode($this->uri->segment(4));
		if($this->input->post("edit")!=""){
			
			$pid = $this->input->post("patient_id");
			$nid = $this->input->post("note_id");
			/*$patient_name=$this->mdl_patient->getPatientName($pid);
			$patient_notes=$this->mdl_patient->getPatientNotes($pid);
			$patient_fincance=$this->mdl_patient->getPatientFinancialProfile($pid);
			
			$this->layout->set(
			array("patient_id"=>$pid,
				  "patient_name"=>$patient_name,
				  "patient_fi"=>$patient_fincance,
				  "patient_finance"=>$patient_fincance,
				  "patient_notes"=>$patient_notes)
			);*/
			
			$data = array();
			$data['assessment'] = $this->input->post("assessment");
			$data['treatment'] = $this->input->post("treatment");
			$data['modified_date']=date("Y-m-d h:i:s");
			$data['modified_by']=$this->session->userdata("user_id");
			
		$usertype=$this->session->userdata('user_type');
		if($usertype=='Doctor'){
			
		$reviewed_by=$this->session->userdata("user_id");
			$data['reviewed_by']=$reviewed_by;
		$data['reviewed_by_date']=date('y-m-d');
		$this->mdl_patient->update("patient_notes",$data,"id",$nid);
		}
			
			
			$result=$this->mdl_patient->update('patient_notes',$data,"id",$nid);
			
			redirect('patient/notes/'.$pid,'refresh');
			//$this->layout->buffer('content','patient/notes');
			//$this->layout->render();
			//exit;
		}else{
		$usertype=$this->session->userdata('user_type');
		$reviewed_by=$this->session->userdata("user_id");
		$data['reviewed_by']=$reviewed_by;
		$data['reviewed_by_date']=date('y-m-d');
		if($usertype=='Doctor'){
		$this->mdl_patient->update("patient_notes",$data,"id",$note_id);
		}
			$note_data = $this->mdl_patient->get_note_data($note_id);
			
			$this->layout->set(
				array("patient_id"=>$patient_id,"patient_note"=>$note_data)
			);
			
			$this->layout->buffer('content','patient/view_notes');
			$this->layout->render();
			//exit;
		}
		//$this->layout->render();
		
	}
	
	public function generate_pdf_note($patient_id, $stream = TRUE, $order_template ='default')
    {
		
       $this->load->helper('pdf');
        $patient_id=base64_decode($patient_id);
        generate_patient_note_pdf($patient_id, $stream, $order_template);
    }
	 public function generate_print_note($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
		$patient_id=base64_decode($patient_id);
        generate_patient_note_pdf($patient_id, $stream, $order_template,$print);
    }
	
	
	
	public function generate_pdf_note1($patient_id,$note_id, $stream = TRUE, $order_template ='default')
    {
		
       $this->load->helper('pdf');
        $patient_id=base64_decode($patient_id);
		$note_id = base64_decode($note_id);
        generate_patient_note_pdf1($patient_id,$note_id, $stream, $order_template);
    }
	 public function generate_print_note1($patient_id, $note_id,$stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
		$patient_id=base64_decode($patient_id);
		$note_id = base64_decode($note_id);
        generate_patient_note_pdf1($patient_id,$note_id, $stream, $order_template,$print);
    }
	
	
	
public function generate_print_note_single($type, $stream = TRUE, $order_template ='default')
	{
		
		
		$this->load->helper('pdf');
     		$type=$this->uri->segment(3);
		
		
        	if($type=="pdf")
		{
			$order_template = "reciept.php";
        		generate_billing_recipt($stream, $order_template);
    		}
		else
		{
			
			$print='1';
			$order_template = "default1.php";
       			generate_patient_note_single($stream, $order_template, $print, $this->uri->segment(4));
		}
	}
	
	
	
	public function generate_pdf_referral($patient_id, $stream = TRUE, $order_template ='default')
    {
		
       $this->load->helper('pdf');
        $patient_id=base64_decode($patient_id);
        generate_patient_referral_pdf($patient_id, $stream, $order_template);
    }
	 public function generate_print_referral($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
		$patient_id=base64_decode($patient_id);
        generate_patient_referral_pdf($patient_id, $stream, $order_template,$print);
    }
	
public function generate_pdf_referral1($patient_id,$ref_id, $stream = TRUE, $order_template ='default')
    {
		
       $this->load->helper('pdf');
        $patient_id=base64_decode($patient_id);
        generate_patient_referral_pdf1($patient_id,$ref_id, $stream, $order_template);
    }
 	 public function generate_print_referral1($patient_id, $ref_id,$stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
		$patient_id=base64_decode($patient_id);
		$ref_id=base64_decode($ref_id);
        generate_patient_referral_pdf1($patient_id,$ref_id, $stream, $order_template,$print);
    }
	
	
	public function generate_pdf_certificate($patient_id, $stream = TRUE, $order_template ='default')
    {
		
       $this->load->helper('pdf');
        $patient_id=base64_decode($patient_id);
        generate_patient_certificate_pdf($patient_id, $stream, $order_template);
    }
	 public function generate_print_certificate($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
		$patient_id=base64_decode($patient_id);
        generate_patient_certificate_pdf($patient_id, $stream, $order_template,$print);
    }
	
public function generate_pdf_certificate1($patient_id,$cer_id, $stream = TRUE, $order_template ='default')
    {
		
       $this->load->helper('pdf');
        $patient_id=base64_decode($patient_id);
		$cer_id = base64_decode($cer_id);
        generate_patient_certificate_pdf1($patient_id,$cer_id, $stream, $order_template);
    }
 	 public function generate_print_certificate1($patient_id, $cer_id,$stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
		$patient_id=base64_decode($patient_id);
		$cer_id = base64_decode($cer_id);
        generate_patient_certificate_pdf1($patient_id,$cer_id, $stream, $order_template,$print);
    }	
	
	
	/*presciption*/
	
	public function generate_pdf_prescription($patient_id, $stream = TRUE, $order_template ='default')
    {
		
       $this->load->helper('pdf');
        $patient_id=base64_decode($patient_id);
        generate_patient_prescription_pdf($patient_id, $stream, $order_template);
    }
	 public function generate_print_prescription($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
		$patient_id=base64_decode($patient_id);
        generate_patient_prescription_pdf($patient_id, $stream, $order_template,$print);
    }
	
public function generate_pdf_prescription1($patient_id,$pre_id, $stream = TRUE, $order_template ='default')
    {
		
       $this->load->helper('pdf');
        $patient_id=base64_decode($patient_id);
		$pre_id = base64_decode($pre_id);
        generate_patient_prescription_pdf1($patient_id,$pre_id, $stream, $order_template);
    }
 	 public function generate_print_prescription1($patient_id, $pre_id,$stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
		$patient_id=base64_decode($patient_id);
		$pre_id = base64_decode($pre_id);
        generate_patient_prescription_pdf1($patient_id,$pre_id, $stream, $order_template,$print);
    }
	
	/***********************************End of Referral ********************************************/
	
	/************************************************************************************************/
	/*   function for edit add and fetch patient profile of perticular patient */
	/************************************************************************************************/
   
    
	
	/**************************** get all patient attendance of patient*******************************/
	
	/*public function patient_attendance()
	{
		$access_level=array("Admin","Reception","Manager1");
		if(!in_array($this->session->userdata("user_type"),$access_level))
		{
			redirect("dashboard","refresh");
		}
		
		$patient_id=($this->uri->segment(3)!="")?$this->uri->segment(3):$this->input->post("patient_id");
		$patient_finance=$this->mdl_patient->getPatientFinancialProfile($patient_id);
		$this->layout->set(
			array("patient_id"=>$patient_id,
			       "patient_finance"=>$patient_finance)
		);
		$this->layout->buffer('content','patient/patient_attendance');
		$this->layout->render();
	}*/
	/*public function patient_attendance()
	 {
	  $access_level=array("Admin","Reception","Manager1");
	  $patient_atendance;
	  if(!in_array($this->session->userdata("user_type"),$access_level))
	  {
	   redirect("dashboard","refresh");
	  }
	  
	  $patient_id=($this->uri->segment(3)!="")?$this->uri->segment(3):$this->input->post("patient_id");
	  $patient_finance=$this->mdl_patient->getPatientFinancialProfile($patient_id);
	  
	  $patient_attendance=$this->mdl_patient->getattandance($patient_id);
	  $this->layout->set(
	   array("patient_id"=>$patient_id,
			  "patient_finance"=>$patient_finance,
		   "patient_attendance"=>$patient_attendance)
	  );
	  $this->layout->buffer('content','patient/patient_attendance');
	  $this->layout->render();
	 }*/
	
	
	
	
	
	
	
	
	
	 
	
	
	/******************************** function for uploading image and pdf files**********************/
	function do_upload($path,$file)
	{
			
		$config['upload_path'] 		=  'uploads/';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '1000';
		$config['max_width']  		= '10240';
		$config['max_height']  		= '7680';
		$post = $this->input->post("");
		
		
		$this->load->library('upload', $config);
		
		if($this->upload->do_upload())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/************************************* function for admission data******************************/
	
	/*public function admission_data()
	{
		$access_level=array("Manager1","Reception");
		if(in_array($this->session->userdata("user_type"),$access_level))
		{
			redirect("dashboard","refresh");
		}
		$patient_id=($this->uri->segment(3)!="")?$this->uri->segment(3):$this->input->post("patient_id");
		$patient_profile=$this->mdl_patient->getPatientProfile($patient_id);
		//print_r($patient_profile);exit;
		$patient_name=$patient_profile->first_name.' '.$patient_profile->last_name;
		$patient_details=$this->mdl_patient->getPatientFinancialProfile($patient_id);
		$patient_finance=$this->mdl_patient->getPatientFinancialProfile($patient_id);
		
		if($this->input->post())
		{
			//print_r($this->input->post());exit;
			$data=array();
			foreach($this->input->post() as $key => $val)
			{
				if($key!="save" && $key!="edit")
				{
					$data[$key]=$val;
				}
			}
				
			$data['modified_date']=date("Y-m-d h:i:s");
			$data['modified_by']=$this->session->userdata("user_id");
			
			//print_r($data);exit;
			if($this->input->post("save")!="")
			{
				$data['created_date']=date("Y-m-d h:i:s");
				$result=$this->mdl_patient->save("clinical_data",$data);
				if($result)
				{
					redirect("patient/patient_profile/".$patient_id);
				}	
			}
			if($this->input->post("edit")!="")
			{
				$fields=$this->db->list_fields('clinical_data');
				foreach($fields as $field)
				{
					if( $field!="id")
					{	
						$data[$field]=($this->input->post($field)!="")?$this->input->post($field):"";
					}
				}
				//print_r($data);exit;
				$result=$this->mdl_patient->update("clinical_data",$data,"patient_id",$patient_id);
			}
		}
		
	   $admission_data=$this->mdl_patient->getAdmissionData($patient_id);
	   
	   //print_r($admission_data);exit;
	   $this->layout->set(
			array("patient_id"=>$patient_id,
				  "patient_name"=>$patient_name,
				  "patient_details"=>$patient_details,
				  "patient_finance"=>$patient_finance,
				  "admission_data"=>$admission_data)
		);
		if(empty($admission_data))
		{
		 	$this->layout->buffer('content','patient/admission_data');
		}
		else
		{
			$this->layout->buffer('content','patient/edit_admission_data');
		}
	  
	   $this->layout->render();
		
	}*/
	
	/*public function generate_pdf($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        
        generate_patient_attandance_pdf($patient_id, $stream, $order_template);
    }
	 public function generate_print($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
        generate_patient_attandance_pdf($patient_id, $stream, $order_template,$print);
    }*/
	////////////////****Patinent Finance Report Print/PDF*****************///////
	/*public function generate_pdf_finance($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        
        generate_patient_finance_pdf($patient_id, $stream, $order_template);
    }
	 public function generate_print_finance($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
        generate_patient_finance_pdf($patient_id, $stream, $order_template,$print);
    }*/
	////////////////****Patinent admission Report Print/PDF*****************///////
	/*public function generate_pdf_admission($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        
        generate_patient_admission_pdf($patient_id, $stream, $order_template);
    }
	 public function generate_print_admission($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
        generate_patient_admission_pdf($patient_id, $stream, $order_template,$print);
    }*/
	////////////////****Patinent admission Report Print/PDF*****************///////
	



}

?>