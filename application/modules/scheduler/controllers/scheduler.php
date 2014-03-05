<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Scheduler extends Admin_Controller {
	public $patient_id;
	
    public function __construct()
    {
		
        parent::__construct();
		$access_level=array("Manager","Doctor");
		if(in_array($this->session->userdata("user_type"),$access_level))
		{
			redirect("dashboard","refresh");
		}
        $this->load->model('mdl_scheduler');
		$this->load->helper('image');
		//$this->load->model("admin/mdl_admin");
		//$this->load->model("billing/mdl_billing");
		//$this->load->library('upload');
    }

    public function index()
    {
		$events=$this->mdl_scheduler->GetSchedules();
		/*$injections=$this->mdl_scheduler->getInjections();
		$machines=$this->mdl_scheduler->getMachines();*/
		$patients=$this->mdl_scheduler->getPatients();/*
		$shifts=$this->mdl_scheduler->getShifts();*/
		$holidayId = $this->mdl_scheduler->getHolidayId();
		$noId = $this->mdl_scheduler->getNoId();

		$staff=$this->mdl_scheduler->getStaff_doctor();
		/*
	
		$message="";
		if($this->uri->segment(3)=="1")
		{
			$message="Entered Shift is already Exists";
		}

		if($this->uri->segment(3)=="2")
		{
			$message="There is already four shifts scheduled";
		}*/
		$this->layout->set(
            array(
				/*'message'=>$message,
				'shifts'=>$shifts,*/
				'events' => $events,
/*				'injections'=>$injections,
				'machines'=>$machines,*/
				'patients'=>$patients,
				'staff1'=>$staff,
				'holidayId'=>$holidayId,
				'noId'=>$noId
            	)
		);
		
		$this->layout->buffer('content', 'scheduler/scheduler');
        $this->layout->render();
    }

	public function cal_scheduler(){
		$start_date = $this->uri->segment(3);
		
		$day = $this->mdl_scheduler->cal_scheduler($start_date);
		echo $day['day'];
		return $day['day'];
	}
	
	public function getHolidayNW()
	{
		$year=$this->input->post("year");
//		$month=$this->input->post("month");
$month = "02";
		
		if(strlen($month)=="1"){ $month="0".$month; }
		
		$days = $this->mdl_scheduler->getHolidayNW($month, $year);

		$date="";
		foreach($days as $day)
		{
			$date=$date.",".$day['start_date'];
		}
		echo $date = ltrim($date,',');
		return $date;
	}
	
	public function deleteSchedule(){		
		$id = $this->uri->segment(3);//exit;
		$this->mdl_scheduler->deleteSchedule($id);		
		
		redirect("scheduler");		
	}
	
	public function add_scheduler()
	{			
			
		if($this->input->post())
		{					
			
			$start = explode(" ",$this->input->post("schedule_time_in"));
			$end = explode(" ",$this->input->post("schedule_time_out"));
			
			if($this->input->post("holiday_name")==null || $this->input->post("holiday_name")==""){
				$data['day']=$this->input->post("holidays");
				$data['patient_id']=$this->input->post("patient_name");
				
				$data['time_in']= $this->input->post("schedule_time_in");
				
				$data['time_out'] =  $this->input->post("schedule_time_out");
				$data['reminder'] = $this->input->post("reminder");
				$data['staff_id'] = $this->input->post("staff_name");
				$data['status'] = $this->input->post("status");				
			}
			else{
				$data['day_name'] = $this->input->post("holiday_name");
				$data['start_date']= date("Y-m-d",strtotime($this->input->post("event_date")));
				$data['day']=$this->input->post("holidays");
			}
			$data['start_date']= date("Y-m-d",strtotime($this->input->post("event_date")));
			$data['end_date'] =  date("Y-m-d",strtotime($this->input->post("event_date")));
			$data['allDay'] = 1;
			$data["created_date"]=date("Y-m-d h:i:s");
			$data["modified_date"]=date("Y-m-d h:i:s");
			
			$event_id=$this->mdl_scheduler->save("scheduler",$data);
									
			redirect("scheduler/scheduler");
		}
	}
	
	public function edit_scheduler()
	{
		
		$event_id=($this->input->post("event_id")!="")?$this->input->post("event_id"):$this->uri->segment(3);
		
		/*$injections=$this->mdl_scheduler->getInjections();
		$machines=$this->mdl_scheduler->getMachines();*/
		$patients=$this->mdl_scheduler->getPatients();
		$details=$this->mdl_scheduler->getEventDetails($event_id);
		$event=$this->mdl_scheduler->GetSchedules($event_id);
		
		$staff=$this->mdl_scheduler->getStaff_doctor();
		$data=array();
		
		if($this->input->post())
		{						
		
			$start = explode(" ",$this->input->post("schedule_time_in"));
			$end = explode(" ",$this->input->post("schedule_time_out"));
			
			if($this->input->post("holidays")=="workingday"){
				
				$data['day']=$this->input->post("holidays");
				$data['patient_id']=$this->input->post("patient_name");
				$data['reminder'] = $this->input->post("reminder");
				$data['staff_id'] = $this->input->post("staff_name");
				$data['time_in']= $this->input->post("schedule_time_in");
				$data['time_out'] =  $this->input->post("schedule_time_out");				
				$data['status']= $this->input->post("status");
			}
			else{
				$data['day_name'] = $this->input->post("holiday_name");
				$data['day']=$this->input->post("holidays");
				$data['patient_id']=""; 				
			}
				
				$data['allDay'] = 1;
				$data['start_date']= date("Y-m-d",strtotime($this->input->post("event_date")));
				$data['end_date'] =  date("Y-m-d",strtotime($this->input->post("event_date")));
				$data["modified_date"]=date("Y-m-d h:i:s");
			
			$where=array('id'=>$this->input->post("event_id"));
			$event_id=$this->mdl_scheduler->update("scheduler",$data,$where);
									
			redirect("scheduler/scheduler");
		}
		
		$data['details']=$details;
		$data['event']=$event;
		$data['patients']=$patients;
		$data['staff']=$staff;
		$this->load->view('edit_scheduler', $data);
		//$this->layout->render();
		
	}
	
	public function deleteRecords()
	{
		//print_r($this->input->post());
		foreach($this->input->post() as $id)
		{
			//echo $id;
			
			$this->mdl_medication->delete($id);
		}
		redirect('medication/medication');
	}

	
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
	
	public function generate_pdf($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        
        generate_medication_pdf($patient_id, $stream, $order_template);
    }
	 public function generate_print($patient_id, $stream = TRUE, $order_template ='default')
    {
       $this->load->helper('pdf');
        $print='1';
        generate_medication_pdf($patient_id, $stream, $order_template,$print);
    }
	
	public function create_csv()
	{
		  $this->load->helper('csv');
		  $query = $this->db->query('SELECT * FROM scheduler');
            $num = $query->num_fields();
            $var =array();
            $i=1;
            $fname="";
            while($i <= $num){
                $test = $i;
                $value = $this->input->post($test);

                if($value != ''){
                        $fname= $fname." ".$value;
                        array_push($var, $value);

                    }
                 $i++;
            }

            $fname = trim($fname);
			$where = "day like 'holiday' or day like 'nonworkingday'";
            $fname=str_replace(' ', ',', $fname);

            $this->db->select("day_name as Subject,start_date,time_in,end_date,time_out,allDay,day_name");
			$this->db->where($where);
            $quer = $this->db->get('scheduler');
			
			
            $file_name='dates_'.date("Y-m-d").'.csv';
            query_to_csv($quer,TRUE,'dates_'.date('Y-m-d').'.csv');
			echo $file_name;
	}
	
	public function create_ical()
	{
			$query = $this->db->query("SELECT (@row:=@row+1) AS id, start_date, end_date, day_name as text, (@row_c:=@row_c+1) AS rec_type, id as event_pid, (@row_e:=@row_e+1) AS event_length FROM scheduler,(SELECT @row:=0) AS row_count WHERE day='holiday' OR day='no'");	
			$result = $query->result_array();
			
			print_r($result);
			exit;
			
		
		  //require_once("");
		  //$this->load->helper('csv');
		  /*$query = $this->db->query('SELECT * FROM scheduler');
            $num = $query->num_fields();
            $var =array();
            $i=1;
            $fname="";
            while($i <= $num){
                $test = $i;
                $value = $this->input->post($test);

                if($value != ''){
                        $fname= $fname." ".$value;
                        array_push($var, $value);

                    }
                 $i++;
            }

            $fname = trim($fname);
			$where = "day like 'holiday' or day like 'nonworkingday'";
            $fname=str_replace(' ', ',', $fname);

            $this->db->select("day_name as Subject,start_date,time_in,end_date,time_out,allDay,day_name");
			$this->db->where($where);
            $quer = $this->db->get('scheduler');
			
			
            $file_name='dates_'.date("Y-m-d").'.csv';
            query_to_csv($quer,TRUE,'dates_'.date('Y-m-d').'.csv');
			echo $file_name;*/
	}
	/*
	public function getStaff()
	{
		$count=$this->input->post("count");
		$staff=$this->mdl_admin->get_all_detail("users");
		$html="<select name='staff_".$count."' id='staff_".$count."'>";
		$html.="<option value="">Select Staff</option>";
		foreach($staff as $stf)
		{
			$html.="<option value='$stf->user_id'>".$stf->user_fullname."</option>";
		}
		$html.="</select>";
		
	}
*/
}

?>