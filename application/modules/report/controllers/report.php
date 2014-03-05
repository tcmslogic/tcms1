<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Report extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
		if($this->session->userdata("user_type")!="Admin")
		{
			redirect("dashboard","refresh");
		}
        $this->load->model('mdl_report');
		$this->load->helper('image');
		 $this->load->library('crypt');
		
    }

    public function index()
    {		
		$patient_id=$this->mdl_report->getPatient(date('m'),date('Y'));				
		$this->layout->set(
            array(
                'patient_id' => $patient_id
            )
		);
		
		$this->layout->buffer('content', 'report/patient_report');
        $this->layout->render();
    }	
	
	public function appointment()
	{
		$patient_id = $this->mdl_report->getList();
		$this->layout->set(
			array(
				'patient_id' => $patient_id
			)
		);
		
        $this->layout->buffer('content', 'report/appointment_report');
        $this->layout->render();	
	}
	public function transaction()
	{
		 $this->layout->buffer('content', 'report/transaction_report');
        $this->layout->render();	
	}
	
	public function getSearch()
	{
			$gender=$this->input->post("gender");
			$search=$this->input->post("search"); 
			$year=$this->input->post("year");
			$month=$this->input->post("month");
			
			$result=$this->mdl_report->getSearch($gender, date('Y-m-01'), date('Y-m-t'), $search, $year, $month);
			//'.$this->mdl_report->getDCount($gender, date('Y-m-01'), date('Y-m-t'), $search, $year, $month, $present, $patient->patient_id).'
			$html="";
			$html.=' <table class="activity_datatable" width="100%"   border="0" cellspacing="0" cellpadding="8">';
			$html.='<thead>';
			$html.='<tr>';
				$html.='<th width="15%">Patient Name</th>';
                $html.='<th width="20%">Follow up</th>';
                $html.='<th width="20%">Drop-outs</th>';
                $html.='<th width="12%">No Follow-up</th>';
			$html.='</tr>';
			$html.='</thead>';
			$html.='<tbody>';
			if(!empty($result)){
			$id="";
			foreach($result as $patient)
			{	$id=$id.",".$patient->patient_id; $present="present"; $dropout="dropout"; $ns="noschedule";
			$name = $this->mdl_report->getPatientName($patient->patient_id);
				$html.='<tr>';
				$html.='<td>'.ucfirst($name->given_name)." ".ucfirst($name->sur_name).'</td>';
				$html.='<td>'.$this->mdl_report->getDCount($gender, date('Y-m-01'), date('Y-m-t'), $search, $year, $month, $present, $patient->patient_id).'</td>';
				$html.='<td>'.$this->mdl_report->getDCount($gender, date('Y-m-01'), date('Y-m-t'), $search, $year, $month, $dropout, $patient->patient_id).'</td>';
				$html.='<td>'.$this->mdl_report->getDCount($gender, date('Y-m-01'), date('Y-m-t'), $search, $year, $month, $ns, $patient->patient_id).'</td>';
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
			if(isset($id)){
			$html.='<div id="button_save" style="margin-right:10px;width:10%">';
        	$html.='<div id="save">';
	       	$html.='<a href='. site_url("report/generate_print_note/".base64_encode($id)).'">Print</a>';
           	$html.='</div>';           
           	$html.=' </div>';
           	$html.=' <div id="button_save" style="margin-right:0px;">';
           	$html.='<div id="save">';
          	$html.='	<a href='. site_url('report/generate_pdf_note/'.base64_encode($id)).'">PDF</a>';
           	$html.='</div>';           
          	$html.=' </div>';
			}
	
	
			$data = array('result'=>$html,'total_record'=>count($result),'per_page'=>2);
			echo json_encode($data);	
			
	}
	
	public function getSearchAptmnt()
	{
			$gender=$this->input->post("gender");
			$search=$this->input->post("search"); 
			$year=$this->input->post("year");
			$month=$this->input->post("month");
			
			$result=$this->mdl_report->getSearchAptmnt($gender, date('Y-m-01'), date('Y-m-t'), $search, $year, $month);
			//'.$this->mdl_report->getDCount($gender, date('Y-m-01'), date('Y-m-t'), $search, $year, $month, $present, $patient->patient_id).'
			$html="";
			$html.=' <table class="activity_datatable" width="100%"   border="0" cellspacing="0" cellpadding="8">';
			$html.='<thead>';
			$html.='<tr>';
				$html.='<th width="15%">Patient Name</th>';
                $html.='<th width="20%">Next Appointment</th>';               
			$html.='</tr>';
			$html.='</thead>';
			$html.='<tbody>';
			$i="0";
			if(!empty($result)){
			$id="";
			foreach($result as $patient)
			{	$id=$id.",".$patient->patient_id; $present="present"; $dropout="dropout"; $ns="noschedule";
			$name = $this->mdl_report->getPatientName($patient->patient_id);
			
					$date="---";
	if($this->mdl_report->getAptmntCount($patient->patient_id)!=""){ $date = date("d M Y",strtotime($this->mdl_report->getAptmntCount($patient->patient_id))); }	
		if(date('m',strtotime($date))==$month){ $i++;
				$html.='<tr>';
				$html.='<td>'.ucfirst($name->given_name)." ".ucfirst($name->sur_name).'</td>';
				$html.='<td>'.$date.'</td>';				
			$html.='</tr>';
			}
			}
			}
			else
			{
				$html.="<tr><td colspan='2'><h3>No Records Found</h3></td></tr>";
			}			
			
			$html.="</tbody></table>";
			if(!empty($result)){
				$html.='<div id="paginationtable" style="margin: auto;"></div>';
	
			}
			if(isset($id)){
			$html.='<div id="button_save" style="margin-right:10px;width:10%">';
        	$html.='<div id="save">';
	       	$html.='<a href='. site_url("report/generate_aptmnt_print_note/".base64_encode($id).'_'.$month.'_'.$year).'">Print</a>';
           	$html.='</div>';           
           	$html.=' </div>';
           	$html.=' <div id="button_save" style="margin-right:0px;">';
           	$html.='<div id="save">';
          	$html.='	<a href='. site_url('report/generate_aptmnt_pdf_note/'.base64_encode($id).'_'.$month.'_'.$year).'">PDF</a>';
           	$html.='</div>';           
          	$html.=' </div>';
			}
		
			$data = array('result'=>$html,'total_record'=>count($result),'per_page'=>2);
			echo json_encode($data);				
	}
	
	/*****************PATIENT REPORT********************/
	public function generate_pdf_note($patient_id, $stream = TRUE, $order_template ='default')
    {
		$patient_id = base64_decode($patient_id);		
		$patient_id = explode(",",substr($patient_id,1));
       	
		$this->load->helper('pdf');
        
        generate_patient_REPORT_note_pdf($patient_id, $stream, $order_template);
    }
	
	public function generate_print_note($patient_id, $stream = TRUE, $order_template ='default')
    {
		$patient_id = base64_decode($patient_id);		
		$patient_id = explode(",",substr($patient_id,1));
		
        $this->load->helper('pdf');
        $print='1';
		
        generate_patient_REPORT_note_pdf($patient_id, $stream, $order_template,$print);
    }
	/*****************END PATIENT REPORT****************/
	
	/*****************PATIENT REPORT********************/
	public function generate_aptmnt_pdf_note($patient_id, $stream = TRUE, $order_template ='default')
    {
		//echo $patient_id; 
		$patient_id = explode("_",$patient_id);

		$month = $patient_id[1];

 		$year = explode("%",$patient_id[2]);		
		$year = $year[0];
		
		$patient_id = $patient_id[0];

		$patient_id = base64_decode($patient_id);		
		$patient_id = explode(",",substr($patient_id,1));
       	
		$this->load->helper('pdf');
        $print='0';
        generate_patient_aptmnt_note_pdf($patient_id, $stream, $order_template, $print,$month, $year);
    }
	
	public function generate_aptmnt_print_note($patient_id, $stream = TRUE, $order_template ='default')
    {
		$patient_id = explode("_",$patient_id);

		$month = $patient_id[1];

 		$year = explode("%",$patient_id[2]);		
		$year = $year[0];
		
		$patient_id = $patient_id[0];
		
		$patient_id = base64_decode($patient_id);		
		$patient_id = explode(",",substr($patient_id,1));
		
        $this->load->helper('pdf');
        $print='1';
		
        generate_patient_aptmnt_note_pdf($patient_id, $stream, $order_template, $print, $month, $year);
    }
	/*****************END PATIENT REPORT****************/

}
?>