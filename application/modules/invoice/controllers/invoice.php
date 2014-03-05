<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Invoice extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
		if($this->session->userdata("user_type")!="Admin")
		{
			redirect("dashboard","refresh");
		}
        $this->load->model('mdl_invoice');
		 $this->load->model('patient/mdl_patient');
		$this->load->helper('image');
		 $this->load->library('crypt');
		
    }

    public function index()
    {
		$miscell_invoices=$this->mdl_invoice->getAllinvoice();
		
		$this->layout->set(
			array(
					"allmisc"=>$miscell_invoices
				)
		);
		
		
		 $this->layout->buffer('content', 'invoice/invoice');
        $this->layout->render();
    }
	public function payroll()
	{
		 $this->layout->buffer('content', 'invoice/payroll');
        $this->layout->render();	
	}
	public function add_invoice()
	{
		
		
		if($this->input->post())
		{
			$data=array();
			$items="";
			$price="";
			$qty="";
			$tax="";
			$total_price="";
		//	print_r($this->input->post());exit;
			
			for($i=0;$i<=$this->input->post("row_count");$i++)
			{
				$items.=$this->input->post("item_".$i).',';
				$price.=$this->input->post("unit_price_".$i).',';
				$qty.=$this->input->post("quantity_".$i).',';
				$tax.="N/A,";
				$total_price.=$this->input->post("total_price_".$i).',';
			}
			$data['issue_date']=date("Y-m-d",strtotime($this->input->post("issue_date")));
		
			$data["patient_id"]=$this->input->post("patient_id");
			$data['invoice_to']=$this->input->post("invoice_to");
			$data['extra_info']=$this->input->post("extra_info");
			$data['items']=trim($items,',');
			$data['unit_price']=trim($price,',');
			$data['quantity']=trim($qty,',');
			$data['tax']=trim($tax,",");
			$data['total_price']=trim($total_price,",");
			$data['notes']=$this->input->post("note");
			$data['modified_date']=date("Y-m-d h:i:s");
			$data['modified_by']=$this->session->userdata("user_id");
			
			if($this->input->post("mid")=="")
			{
				$data['created_date']=date("Y-m-d h:i:s");
				$miscell_invoices=$this->mdl_invoice->getAllinvoice();
				$count_misc_invoice=count($miscell_invoices) + 1;
				$data['invoice_no']='MI'.date("y").date("m").'-'.$count_misc_invoice;
				$this->mdl_invoice->save("invoice",$data);
				redirect("invoice/index","refresh");
			}
			else
			{
				
				$this->mdl_invoice->update("invoice",$data,"id",$this->input->post("mid"));
			
				redirect("invoice/edit_invoice/".$this->input->post("mid"));
			}
			
		}
		$patients=$this->mdl_patient->getAllPatients();
		$this->layout->set(
							array(
								  "patients"=>$patients
								 
								  )
						   );
		$this->layout->buffer('content', 'invoice/add_invoice');
        $this->layout->render();
	}
	public function getpatientdetail()
	{
		$pid=$this->input->get("pid");
		$patient=$this->mdl_patient->getPatientProfile($pid);
		
		$address=$patient->sur_name." ".$patient->given_name."\n";
		$address.=$patient->address."\n";
		
		echo $address;
	}
	public function edit_invoice()
	{
		
		$id=$this->uri->segment(3);
		$id=base64_decode($id);
		$misc_invoice=$this->mdl_invoice->getinvoiceById($id);
		$patients=$this->mdl_patient->getAllPatients();
		
		
		$this->layout->set(
							array(
								  "patients"=>$patients,
								  "misc_invoice"=>$misc_invoice
								 
								  )
						   );
		
		$this->layout->buffer('content','invoice/add_invoice');
		$this->layout->render();
		
		
	}
	public function delete()
	{
		
		$id=$this->input->post('id');
		$tablename=$this->input->post('table');
		$ids = is_array($id) ? implode(',', $id) : $id;
		
		$query = mysql_query("DELETE FROM $tablename WHERE id IN ($ids)");
		echo "true";
	}
	public function generate_invoice_single()
	{
		$userid=$this->uri->segment(4);
		$userid=base64_decode($userid);
		$stream='';
		$micsInvoices=$this->mdl_invoice->getinvoice_by_id($userid);
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
       			generate_invoice_single($micsInvoices,$stream, $order_template, $print, $userid);
		}
	
	}
	public function generateinvoicePdf($stream = TRUE, $order_template ='default')
    {
		   $this->load->helper('pdf');
		   	$type=$this->uri->segment(3);
     		// $start_date=date("Y-m-d",strtotime($this->input->post("start_date")));
			 //$end_date=date("Y-m-d",strtotime($this->input->post("end_date")));
			
			 $micsInvoices=$this->mdl_invoice->getAllinvoice();
			
	  	
        if($type=="pdf")
		{
        	generate_invoice_pdf($micsInvoices, $stream, $order_template);
		}
		else
		{
		  $print='1';
       		 generate_invoice_pdf($micsInvoices, $stream, $order_template,$print);
		}
	}

}
?>