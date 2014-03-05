<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



function generate_injection_usage_report($start_date,$end_date, $stream = TRUE, $injection_template = NULL)
{
    $CI = & get_instance();

    $CI->load->model('admin/mdl_admin');
    $CI->load->model('scheduler/mdl_scheduler');
	$CI->load->model('billing/mdl_billing');

  	$start_date=date("Y-m-d",strtotime($start_date));
	$end_date=date("Y-m-d",strtotime($end_date));
    if (!$injection_template)
    {
        $CI->load->helper('template');
        $injection_template = $CI->mdl_settings->setting('pdf_quote_template');
    }
	$injections=$CI->mdl_admin->get_all_detail('injection');
	$company_detail=$CI->mdl_admin->get_all_detail('company');
	
	$schedules=$CI->mdl_billing->getinjection_usages($start_date,$end_date);
	
	$i=0;
	
	foreach($schedules as $sd)
	{
		
		
			$data_arr[$i]["date"]=$sd['date'];
			$data_arr[$i]["patient_name"]=$sd['name'];
			$data_arr[$i]["hd"]=$sd['hd'];
			foreach($injections as $ij)
			{
				if($ij->name==$sd['injection'])
				{
					$data_arr[$i][$ij->name]=$sd['injection_qty'];
				}
			}
			$i++;
		
	}
	
	
    $data = array(
        'injections'           => $injections,
        'data_arr' 			   => $data_arr,
        'output_type'       => 'pdf',
		'dates'				=>array("start_date"=>$start_date,"end_date"=>$end_date),
		'company'=>$company_detail
    );

    $html = $CI->load->view('injection_templates/pdf/' . $injection_template, $data, TRUE);

    $CI->load->helper('mpdf');

    //return pdf_create($html, 'Injection Usage' . '_' . str_replace(array('\\', '/'), '_', $invoice->invoice_number), $stream);
	return pdf_create($html, 'Injection Usage', $stream);
}



function generate_machine_utilization_report($start_date,$end_date, $stream = TRUE, $machine_template = NULL)
{
    $CI = & get_instance();

    $CI->load->model('admin/mdl_admin');
    $CI->load->model('scheduler/mdl_scheduler');
	$CI->load->model('billing/mdl_billing');
$company_detail=$CI->mdl_admin->get_all_detail('company');
  	$start_date=date("Y-m-d",strtotime($start_date));
	$end_date=date("Y-m-d",strtotime($end_date));
    if (!$machine_template)
    {
        $CI->load->helper('template');
        $machine_template = $CI->mdl_settings->setting('pdf_quote_template');
    }
	$machines=$CI->mdl_admin->get_all_detail('machine');
	
	$schedules=$CI->mdl_billing->getScadules($start_date,$end_date);
		$data_arr=array();
		$old_date="";
		foreach($schedules as $sd)
		{
			$date=date("Y-m-d",strtotime($sd->start_date));
			$arr_machines=explode(",",$sd->machines);
			$arr_patients=explode(",",$sd->patients);
			if(empty($data_arr[$date]))
			{
				foreach($machines as $m)
				{
					$data_arr[$date][$m->id]="0";
				}
			}
			foreach($machines as $m)
			{	
				$key=array_search($m->id,$arr_machines);
			
				
				if($arr_patients[$key]!="0")
				{
					$data_arr[$date][$m->id]=($data_arr[$date][$m->id]+1);
				}
				else
				{
					$data_arr[$date][$m->id]=$data_arr[$date][$m->id];
				}
			}
			$old_date=$date;
		}
		
		$data = array(
			'machines'           => $machines,
			'data_arr' 			   => $data_arr,
			'output_type'       => 'pdf',
			'dates'				=>array("start_date"=>$start_date,"end_date"=>$end_date),
			'company'=>$company_detail
		);

    $html = $CI->load->view('machine_templates/pdf/' . $machine_template, $data, TRUE);

    $CI->load->helper('mpdf');

   // return pdf_create($html,'Machine utilization' . '_' . str_replace(array('\\', '/'), '_', $invoice->invoice_number), $stream);
    return pdf_create($html,'Machine utilization', $stream);
		
		
}

function generate_patients_summary_report($data_arr, $stream = TRUE, $patient_template = NULL)
{
    $CI = & get_instance();

    $CI->load->model('admin/mdl_admin');

$company_detail=$CI->mdl_admin->get_all_detail('company');
    if (!$patient_template)
    {
        $CI->load->helper('template');
        $machine_template = $CI->mdl_settings->setting('pdf_quote_template');
    }
	
	$data = array(
					'data_arr' 			=> $data_arr,
					'output_type'       => 'pdf',
					'company'=>$company_detail
				);

    $html = $CI->load->view('patient_templates/pdf/' . $machine_template, $data, TRUE);

    $CI->load->helper('mpdf');

    return pdf_create($html, 'patient_financial_summery', $stream);
	
}

function generate_treatment_summary_report($start_date,$end_date, $stream = TRUE, $treatment_template = NULL)
{
    $CI = & get_instance();

    $CI->load->model('admin/mdl_admin');
    $CI->load->model('scheduler/mdl_scheduler');
	$CI->load->model('billing/mdl_billing');
$company_detail=$CI->mdl_admin->get_all_detail('company');
  	$start_date=date("Y-m-d",strtotime($start_date));
	$end_date=date("Y-m-d",strtotime($end_date));
    if (!$patient_template)
    {
        $CI->load->helper('template');
        $treatment_template = $CI->mdl_settings->setting('pdf_quote_template');
    }
	$injections=$CI->mdl_admin->get_all_detail('injection');
	$patient_fp=$CI->mdl_admin->get_all_detail('patient_financial_profile');
	$schedules=$CI->mdl_billing->getScadules($start_date,$end_date);
		$data_arr=array();
		$old_date="";
		
		$hd=0;
		$j=0;
		foreach($schedules as $sd)
		{
			
			$date=date("Y-m-d",strtotime($sd->start_date));
			
			$arr_patients=explode(",",$sd->patients);
			$arr_injections=explode(",",$sd->injections);
			$arr_injection_qty=explode(",",$sd->injection_qty);
			$arr_machine=explode(",",$sd->machines);
			if(empty($data_arr[$date]))
			{
				foreach($injections as $m)
				{
					$data_arr[$date][$m->id]="0";
				}
			}
			
			$keys=array_keys($arr_injections);
			
			foreach($keys as $m)
			{	
				
				if($arr_patients[$m]!="0")
				{
					echo $date."<br>";
					$data_arr[$date][$arr_injections[$m]]=($data_arr[$date][$arr_injections[$m]]+$arr_injection_qty[$m]);
					//$hd+=count(($data_arr[$date][$arr_machine[$m]]+$arr_machine[$m]));
					$data_arr[$date]["machine"]+=1;
					
				}
				else
				{
					$data_arr[$date][$arr_injections[$m]]=$arr_injection_qty[$m];
					
					//$data_arr[$date][$arr_machine[$m]]=$arr_machine[$m];
					//$data_arr[$date][$arr_machine[$m]]=$arr_machine[$m];
				}
				/*
				if($date!=$old_date)
				{
					echo $date;
					echo $j.'<br>';
					
					$old_date=$date;
					
				}*/
				//
			}
		
			//$data_arr[$date]['hd']=$hd;
			
		$j=1;	
			
			
		}
		
		//exit;
		
		$data = array(
			'injections'           => $injections,
			'data_arr' 			   => $data_arr,
			'output_type'       => 'pdf',
			'dates'				=>array("start_date"=>$start_date,"end_date"=>$end_date),
			'company'=>$company_detail
		);

    $html = $CI->load->view('treatment_templates/pdf/' . $treatment_template, $data, TRUE);

    $CI->load->helper('mpdf');

    return pdf_create($html, "treatment_summary", $stream);
}
?>