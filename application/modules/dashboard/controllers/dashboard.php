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

class Dashboard extends Admin_Controller {

     public function __construct()
    {
		
        parent::__construct();

       	$this->load->model('mdl_dashboard');
		$this->load->model('patient/mdl_patient');
	}
	
	public function index()
    {
//		print_r($this->session->userdata); exit;
		$allmessage = $this->mdl_dashboard->getAllmessage();
		//$reminder = $this->mdl_dashboard->getReminder();
		$this->layout->set(
            array(
				'message' => $allmessage
			)
		);
		
           
        $this->layout->buffer('content', 'dashboard/index');
        $this->layout->render();
    }
	public function add_notice()
	{
		
		if($this->input->post("save"))
		{
			$data=array();
			foreach($this->input->post() as $key => $val)
			{
				
				if($key!='save')
				{
					$data[$key]=$val;
				}
			}
			
			//print_r($data);exit;
			$result = $this->mdl_dashboard->save("message",$data);
			if($result)
			{
				redirect("dashboard","refresh");
			}
		}
		
		$this->layout->buffer('content','dashboard/add_notice');
		$this->layout->render();
	}
	
	public function edit_notice(){
		
		$id = $this->uri->segment(3);//exit;
		$result = $this->mdl_dashboard->edit_notice($id);
		
		$this->layout->set(
            array(
				'result' => $result
            )
		);
		
		if($this->input->post("save"))
		{
			$data=array();
			foreach($this->input->post() as $key => $val)
			{
				
				if($key!='save')
				{
					$data[$key]=$val;
				}
			}
			
			$id=$this->input->post("id");
			$return=$this->mdl_dashboard->update("message",$data,"id",$id);
			if($return)
			{
				redirect("dashboard","refresh");
			}
		}
		
		$this->layout->buffer('content','dashboard/edit_notice');
		$this->layout->render();
		
	}
	
	public function deleteRecords()
	{
		$id = $this->uri->segment(3);//exit;
		$this->mdl_dashboard->delete($id);
		
		redirect("dashboard");
	}

}

?>