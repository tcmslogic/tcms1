<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



function generate_invoice_pdf($invoice_id, $stream = TRUE, $invoice_template = NULL)
{
    $CI = & get_instance();

    $CI->load->model('invoices/mdl_invoices');
    $CI->load->model('invoices/mdl_items');
    $CI->load->model('invoices/mdl_invoice_tax_rates');

    $invoice = $CI->mdl_invoices->get_by_id($invoice_id);

    if (!$invoice_template)
    {
        $CI->load->helper('template');
        $invoice_template = select_pdf_invoice_template($invoice);
    }

    $data = array(
        'invoice'           => $invoice,
        'invoice_tax_rates' => $CI->mdl_invoice_tax_rates->where('invoice_id', $invoice_id)->get()->result(),
        'items'             => $CI->mdl_items->where('invoice_id', $invoice_id)->get()->result(),
        'output_type'       => 'pdf'
    );

    $html = $CI->load->view('invoice_templates/pdf/' . $invoice_template, $data, TRUE);

    $CI->load->helper('mpdf');

    return pdf_create($html, lang('invoice') . '_' . str_replace(array('\\', '/'), '_', $invoice->invoice_number), $stream);
}

function generate_quote_pdf($quote_id, $stream = TRUE, $quote_template = NULL)
{
    $CI = & get_instance();

    $CI->load->model('quotes/mdl_quotes');
    $CI->load->model('quotes/mdl_quote_items');
    $CI->load->model('quotes/mdl_quote_tax_rates');

    $quote = $CI->mdl_quotes->get_by_id($quote_id);

    if (!$quote_template)
    {
        $quote_template = $CI->mdl_settings->setting('pdf_quote_template');
    }

    $data = array(
        'quote'           => $quote,
        'quote_tax_rates' => $CI->mdl_quote_tax_rates->where('quote_id', $quote_id)->get()->result(),
        'items'           => $CI->mdl_quote_items->where('quote_id', $quote_id)->get()->result(),
        'output_type'     => 'pdf'
    );

    $html = $CI->load->view('quote_templates/pdf/' . $quote_template, $data, TRUE);

    $CI->load->helper('mpdf');

    return pdf_create($html, lang('quote') . '_' . str_replace(array('\\', '/'), '_', $quote->quote_number), $stream);
}
/*********************************** order report  billing pdf************************************/

function generate_medication_pdf($mid, $stream = TRUE, $medication_template = 'default',$print='0')
{
    $CI = & get_instance();

    $CI->load->model('medication/mdl_medication');
	$CI->load->model('medication/mdl_patient');
	$CI->load->model('admin/mdl_admin');

    //$medication_details = $CI->mdl_medication->getMedicationDetails($patient_id);
	//$medication_patient = $CI->mdl_medication->getAllMedications($patient_id);
   		$medication_details=$CI->mdl_medication->getMedication_details_by_id($mid);
		$medication_patient=$CI->mdl_medication->getMedication_Rec($mid);
	$company_detail=$CI->mdl_admin->get_all_detail('company');
	if (!$medication_template)
    {
        $medication_template = $CI->mdl_settings->setting('pdf_quote_template');
    }
	
    $data = array(
		'patient_details'			   => $CI->mdl_patient->getPatientProfile($medication_patient->patient_id),
        'medication_details'           => $medication_details,
        'medication_patient'           => $medication_patient,
		'print'			 			   => $print,
		'company'					  => $company_detail,
		'updater'					   => $CI->mdl_medication->getUpdater($medication_patient->updated_by),
        'output_type'     			   => 'pdf'
    );
	
    $html = $CI->load->view('medication_templates/pdf/' . $medication_template, $data, TRUE);
	//echo $html;exit;
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("medication/medication");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html, 'medication_' . rand(0000,9999), $stream);
	}
	
}

function generate_outstanding_pdf($array,$stream = TRUE, $outstanding_template = 'default',$print='0')
{
	$CI = & get_instance();

    $CI->load->model('billing/mdl_billing');
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('admin/mdl_admin');

	$company_detail=$CI->mdl_admin->get_all_detail('company');
	if (!$outstanding_template)
    {
        $outstanding_template = $CI->mdl_settings->setting('pdf_quote_template');
    }
	
    $data = array(	
		'miscInvoice'	  			=>$array,
		'print'			 			=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
        'output_type'     			  => 'pdf',
		'company'				=>$company_detail
    );
	
    $html = $CI->load->view('outstanding_template/pdf/' . $outstanding_template, $data, TRUE);
	//echo $html;exit;
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("billing/amount");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html, 'outstanding_invoice_' . rand(0000,9999), $stream);
	}
	
}

function generate_recipt_pdf($stream = TRUE, $recipt_template = 'default',$print='0')
{
	$CI = & get_instance();

    $CI->load->model('billing/mdl_billing');
	$CI->load->model('clinicalchart/mdl_patient');
	$CI->load->model('admin/mdl_admin');
	$company_detail=$CI->mdl_admin->get_all_detail('company');
	if (!$recipt_template)
    {
        $recipt_template = $CI->mdl_settings->setting('pdf_quote_template');
    }
	$recipts=$CI->mdl_billing->getAllRecipts();
    $data = array(	
		'recipts'	  			=>$recipts,
		'print'			 			=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
        'output_type'     			  => 'pdf',
		'company'				=>$company_detail
    );
	
    $html = $CI->load->view('recipt_templates/pdf/' . $recipt_template, $data, TRUE);
	
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("billing/reciept");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'reciept_' . rand(0000,9999), $stream);
	}
	
}

function generate_billing_recipt($stream = TRUE, $recipt_template = 'default',$print='0', $id)
{
	//echo $recipt_template; exit;	
$CI = & get_instance();

    	$CI->load->model('billing/mdl_billing');
	$CI->load->model('clinicalchart/mdl_patient');
	$CI->load->model('admin/mdl_admin');
	$CI->load->model('medication/mdl_patient');
	$company_detail=$CI->mdl_admin->get_all_detail('company');



	/*if (!$recipt_template)
    {
        $recipt_template = $CI->mdl_settings->setting('pdf_quote_template');
    }*/
	$recipts=$CI->mdl_billing->getReciptById($id);
	//echo count($recipts); exit;
	//print_r($recipts); exit;
    $data = array(	
		'data'	=>$recipts,
		'print'		=> $print,
		'company'	=>$company_detail,
	        'output_type'  	=> 'pdf'
    );
	
    $html = $CI->load->view('recipt_templates/pdf/' . $recipt_template, $data, TRUE);
	//echo $html;exit;
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("billing/reciept");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'reciept_' . rand(0000,9999), $stream);
	}
	
}


/*function generate_recipt($stream = TRUE, $recipt_template = 'default',$print='0')
{
	$CI = & get_instance();

    $CI->load->model('billing/mdl_billing');
	$CI->load->model('clinicalchart/mdl_patient');
	
	if (!$recipt_template)
    {
        $recipt_template = $CI->mdl_settings->setting('pdf_quote_template');
    }
	$recipts=$CI->mdl_billing->getAllRecipts();
    $data = array(	
		'recipts'	=>$recipts,
		'print'		=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
	        'output_type'  	=> 'pdf'
    );
	
    $html = $CI->load->view('recipt_templates/pdf/' . $recipt_template, $data, TRUE);
	
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("billing/reciept");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'reciept_' . rand(0000,9999), $stream);
	}
	
}*/

function generate_misc_pdf($array,$stream = TRUE, $misc_template = 'default',$print='0')
{
	$CI = & get_instance();

    $CI->load->model('billing/mdl_billing');
	$CI->load->model('clinicalchart/mdl_patient');
	$CI->load->model('admin/mdl_admin');
	$company_detail=$CI->mdl_admin->get_all_detail('company');
	
	if (!$misc_template)
    {
        $misc_template = $CI->mdl_settings->setting('pdf_quote_template');
    }

    $data = array(	
		'allmisc'	  			=>$array,
		'print'			 			=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
        'output_type'     			  => 'pdf',
		'company'				=>$company_detail
    );
	
    $html = $CI->load->view('miscinvoice_templates/pdf/' . $misc_template, $data, TRUE);
	////echo $html;exit;
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("billing/miscellinvoice");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html, lang('order') . '_' . str_replace(array('\\', '/'), '_', $order[0]->order_id), $stream);
	
	}
	
}



function generate_month_pdf($sdate,$edate,$array,$stream = TRUE, $month_template = 'default',$print='0')
{
	$CI = & get_instance();

    $CI->load->model('billing/mdl_billing');
	$CI->load->model('clinicalchart/mdl_patient');
	$CI->load->model('admin/mdl_admin');
	
	$company_detail=$CI->mdl_admin->get_all_detail('company');
	
	if (!$month_template)
    {
		
        $month_template = $CI->mdl_settings->setting('pdf_quote_template');
    }
	
    $data = array(	
		'scadule_result'	  		=>$array,
		'print'			 			=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
        'output_type'     			=> 'pdf',
		'dates'						=> array("start_date" => $sdate,"end_date" => $edate),
		'company'				=>$company_detail
    );
	
    $html = $CI->load->view('monthinvoice_templates/pdf/' . $month_template, $data, TRUE);
	//echo $html;exit;
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("billing/monthlyinvoice");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html, lang('order') . '_' . str_replace(array('\\', '/'), '_', $order[0]->order_id), $stream);
	
	}
	
}


function generate_clinicalchart_pdf($patient_id, $stream = TRUE, $medication_template = 'default',$print='0')
{
    ini_set('memory_limit', '500M');
	//echo $patient_id;exit;
	
	$CI = & get_instance();

    $CI->load->model('clinicalchart/mdl_clinicalchart');
	$CI->load->model('clinicalchart/mdl_patient');
	$CI->load->model('admin/mdl_admin');
	
	if($patient_id=='all'){
		$show='false';
		$patient_details='';
	}else{
   		$show='true';
		$patient_details = $CI->mdl_patient->getPatientProfile($patient_id);
	}
	$company = $CI->mdl_admin->get_all_detail('company');
	$patient_report = $CI->mdl_clinicalchart->get_patient_report($patient_id);
	//$medication_patient = $CI->mdl_clinicalchart->getAllMedications($patient_id);
    if (!$medication_template)
    {
        $medication_template = $CI->mdl_settings->setting('pdf_quote_template');
    }
	
    $data = array(	
		'show'						=>$show,
		'patient_details'			 => $patient_details,
        'patient_report'           	  => $patient_report,
        'company'           => $company,
		'print'			 			=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('clinicalchart_templates/pdf/' . $medication_template, $data, TRUE);
	//echo $html;exit;
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("clinicalchart/clinicalchart");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');
	
	//$mpdf = new mPDF();
	
	$param = '"en-GB-x","A3",14,"",10,10,10,10,6,3,"L"';

    return pdf_create($html, 'clinicalChart', $stream,$param);
	}
	
}

/*************************************************************************************************/
/***********************************************blood test report******************************************/
function generate_bloodtest_pdf($patient_id, $stream = TRUE, $bloodtest_template = 'default',$print='0')
{
   
	//echo $patient_id;exit;
	ini_set('memory_limit', '500M');
	$CI = & get_instance();

    $CI->load->model('bloodtest/mdl_bloodtest');
	$CI->load->model('clinicalchart/mdl_patient');
	$CI->load->model('admin/mdl_admin');
	if($patient_id=='all'){
		$show='false';
		$patient_details='';
	}else{
   		$show='true';
		$patient_details = $CI->mdl_patient->getPatientProfile($patient_id);
	}
	$patient_report = $CI->mdl_bloodtest->getAllBloodtests($patient_id);
	$company = $CI->mdl_admin->get_all_detail('company');
    if (!$bloodtest_template)
    {
        $bloodtest_template = $CI->mdl_settings->setting('pdf_quote_template');
    }
	
    $data = array(	
		'show'						=>$show,
		'patient_details'			 => $patient_details,
        'bloodtests'           	  => $patient_report,
       'company'           => $company,
		'print'			 			=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('bloodtest_templates/pdf/' . $bloodtest_template, $data, TRUE);
	//echo $html;exit;
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("bloodtest/bloodtest");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');
	$param = '"en-GB-x","A3","14","",10,10,10,10,6,3,"L"';
    return pdf_create($html, 'Bloodtest', $stream,$param);
	}
	
}

function generate_patient_attandance_pdf($patient_id, $stream = TRUE, $medication_template = 'default',$print='0')
{
    
	//echo $patient_id;exit;
	
	$CI = & get_instance();

  
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('admin/mdl_admin');
	$CI->load->model('settings/mdl_settings');
	if($patient_id=='all'){
		$show='false';
		$patient_details='';
	}else{
   		$show='true';
		$patient_details = $CI->mdl_patient->getPatientProfile($patient_id);
	}
	$patient_attandance_templete="";
	$company = $CI->mdl_admin->get_all_detail('company');
	
	$patient_attandance_report = $CI->mdl_patient->getattandance($patient_id);

	//$medication_patient = $CI->mdl_clinicalchart->getAllMedications($patient_id);

    if ($patient_attandance_report)
    {
		
        $patient_attandance_templete = $CI->mdl_settings->setting('pdf_quote_template');
    }

    $data = array(	
		'show'						=>$show,
		'patient_attendance'			 => $patient_attandance_report,
       	'patient_details'			 => $patient_details,
        'company'           =>$company,
		'print'			 			=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('patient_attandance_templates/pdf/'.$patient_attandance_templete, $data, TRUE);
	//print_r($html);exit;
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("patient/patient");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'Patient_attandance' , $stream);
	}
	
}

function generate_patient_finance_pdf($patient_id, $stream = TRUE, $medication_template = 'default',$print='0')
{
    
	//echo $patient_id;exit;
	
	$CI = & get_instance();

  $CI->load->model('admin/mdl_admin');
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('settings/mdl_settings');
	if($patient_id=='all'){
		$show='false';
		$patient_details='';
	}else{
   		$show='true';
		$patient_details = $CI->mdl_patient->getPatientProfile($patient_id);
	}
	$patient_finance_templete="";
	$company = $CI->mdl_admin->get_all_detail('company');
	$patient_finance_report = $CI->mdl_patient->getPatientFinancialProfile($patient_id);
	$injection_data = $CI->mdl_patient->get_all_injection();

	
	$i=0;
	foreach($injection_data as $injection)
	{
		
		$inj_data[] = $CI->mdl_patient->get_injection_data($patient_finance_report->patient_fid,$patient_id,$injection->id);
		
		
		if($inj_data[$i][0]->inj_id == $injection->id)
		{
			$injection_data[$i]->inj_data=$inj_data[$i][0]->inj_data;
		}
		
	$i++;}


	//$medication_patient = $CI->mdl_clinicalchart->getAllMedications($patient_id);

    if ($patient_finance_report)
    {
		
        $patient_finance_templete = $CI->mdl_settings->setting('pdf_quote_template');
    }

    $data = array(	
		'show'						=>$show,
		'patient_finance'			 => $patient_finance_report,
       	'patient_details'			 => $patient_details,
        'inection_data'           => $injection_data ,
		'print'			 			=> $print,
		'company'           =>$company,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('patient_finance_templates/pdf/'.$patient_finance_templete, $data, TRUE);
	//echo $html;exit;
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("patient/patient_financial_profile/".$patient_id);?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'patient_finance' , $stream);
	}
	
}

function generate_patient_admission_pdf($patient_id, $stream = TRUE, $medication_template = 'default',$print='0')
{
    
	//echo $patient_id;exit;
	
	$CI = & get_instance();

  $CI->load->model('admin/mdl_admin');
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('settings/mdl_settings');
	if($patient_id=='all'){
		$show='false';
		$patient_details='';
	}else{
   		$show='true';
		$patient_details = $CI->mdl_patient->getPatientProfile($patient_id);
	}
	$patient_admission_templete="";
	$company = $CI->mdl_admin->get_all_detail('company');
	$patient_admission_report = $CI->mdl_patient->getAdmissionData($patient_id);
	


	//$medication_patient = $CI->mdl_clinicalchart->getAllMedications($patient_id);

    if ($patient_admission_report)
    {
		
        $patient_admission_templete = $CI->mdl_settings->setting('pdf_quote_template');
    }

    $data = array(	
		'show'						=>$show,
		'admission_data'			 => $patient_admission_report,
       	'patient_details'			 => $patient_details,
       'company'           =>$company,
		'print'			 			=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('patient_admission_templates/pdf/'.$patient_admission_templete, $data, TRUE);
	//echo $html;exit;
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("patient/admission_data/".$patient_id);?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'admission_data' , $stream);
	}
	
}

function generate_patient_note_pdf($patient_id, $stream = TRUE, $medication_template = 'default',$print='0')
{
    
	//echo $patient_id;exit;
	
	$CI = & get_instance();

  $CI->load->model('admin/mdl_admin');
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('settings/mdl_settings');
	if($patient_id=='all'){
		$show='false';
		$patient_details='';
	}else{
   		$show='true';
		$patient_details = $CI->mdl_patient->getPatientProfile($patient_id);
	}
	$patient_notes_templete="";
	$company = $CI->mdl_admin->get_all_detail('company');
	$patient_notes=$CI->mdl_patient->getPatientNotes($patient_id);
	$patient_notes_report=array();
	$i=0;
	foreach($patient_notes as $notes)
	{
		$patient_notes[$i]->modified_by=$CI->mdl_patient->get_last_modify_by($notes->modified_by);
		$patient_notes[$i]->reviewd_by_name=$CI->mdl_patient->get_last_modify_by($notes->reviewed_by);
	$i++;}
	
	//print_r($patient_notes);exit;
	//$medication_patient = $CI->mdl_clinicalchart->getAllMedications($patient_id);

    if ($patient_notes)
    {
		
        $patient_notes_templete = $CI->mdl_settings->setting('pdf_quote_template');
    }

    $data = array(	
		'show'						=>$show,
		'patient_notes'			 => $patient_notes,
       	'patient_details'			 => $patient_details,
        'company'           =>$company,
		'print'			 			=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('patient_notes_templates/pdf/'.$patient_notes_templete, $data, TRUE);
	
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("patient/patient");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'Patient_notes' , $stream);
	}
	
}
function generate_medication_injection_pdf($patient_id, $stream = TRUE, $medication_template = 'default',$print)
{
    
	//echo $patient_id;exit;
	
	$CI = & get_instance();

 	$CI->load->model('medication/mdl_medication');
	$CI->load->model('medication/mdl_patient');
	$CI->load->model('admin/mdl_admin');
	if($patient_id=='all'){
		$show='false';
		$patient_details='';
	}else{
   		$show='true';
		$patient_details = $CI->mdl_patient->getPatientProfile($patient_id);
	}
	$company = $CI->mdl_admin->get_all_detail('company');
	
	$result = $CI->mdl_medication->getSearch($patient_id);
	$html='<div class=content style="height: auto;max-height: 842px;min-height: 500px;">';
        $html.='<div id="header" >';
             $html.='<table style="padding: 0; width: 100%;">';
              $html.=' <tr>';
            $html.=' <td style=" padding: 5px; vertical-align: text-top;" colspan="2">';
            $html.=' <table style="padding: 0; width: 100%;"><tr><td style=" padding: 5px; vertical-align: text-top;">';
            $html.='<img src="'.base_url("uploads/companylogo/".$company[0]->company_logo).'" style="width:100px;height:100px;float:left;" />';
           $html.=' <td align="center" valign="middle" style=" padding: 5px; vertical-align:calc();"><h2 style="width:100%;font-size:18px;color:#375B91;font-family:Calibri;">'.$company[0]->company_name.'</h2><br>';
            $html.='</td>';
           $html.=' </table></td></td>';
            $html.='</td>';
            $html.='</tr>';
                $html.=' <tr>';
                    $html.='<td id="company-name">';
                      
                       $html.=' <h2 style="color: #375B91;font-size: 24px;font-weight: bold; margin: auto; padding: 0;color: #375B91;font-family:Calibri;">'.$patient_details->first_name." ".$patient_details->last_name.'</h2>';
                       $html.=' <p style="color: #656566;font-size: 14px;line-height: 25px;margin: 0;padding: 0;font-family:Calibri;">';
                           if ($patient_details->address1) 
						   { 
						   $html.=$patient_details->address1 . '<br>'; } 
                            if ($patient_details->address2)
							 { $html.=$patient_details->address2 . '<br>'; } 
                             if ($patient_details->city)
							  { $html.=$patient_details->city . ' '; } 
                             if ($patient_details->state) { 
							 $html.=$patient_details->state . ' '; } 
                           if ($patient_details->pin_code) 
						   { $html.= $patient_details->pin_code . '<br>'; } 
                            if ($patient_details->phone) 
							{ $html.='<abbr>P:</abbr>'. $patient_details->phone.'<br>';
							 } 
                       $html.=' </p>';
                     
                    $html.=' </td>';
                     $html.='<td style="text-align: right;vertical-align:top"><h3 style="clear: both;color: #375B91;font-size: 20px;margin: auto;padding: 8px 0 0;font-family:Calibri;text-transform: uppercase;">Injection Monitoring</h3></td>';
                 $html.='</tr>';
             $html.='</table>';
        $html.=' </div>';
       
        
		
		$html.=' <div id="invoice-items" style="min-height:100px">';
          $html.=' <table id="page_table" class="table" style="width: 100%;border-collapse: collapse;text-align: left; padding: 5px;">';
			$html.='<thead>';
			$html.='<tr style="background-color: #C5CACE;">';
			$html.='	<th style="background-color: #C5CACE;color: #375B91;font-size: 15px;font-weight: normal;padding: 8px;font-family:Calibri;text-align:left;">Date</th>';
			$html.='	<th style="background-color: #C5CACE;color: #375B91;font-size: 15px;font-weight: normal;padding: 8px;font-family:Calibri;text-align:left;">Injection</th>';
			$html.='	<th style="background-color: #C5CACE;color: #375B91;font-size: 15px;font-weight: normal;padding: 8px;font-family:Calibri;text-align:left;">Dosage</th>';
			$html.='	<th style="background-color: #C5CACE;color: #375B91;font-size: 15px;font-weight: normal;padding: 8px;font-family:Calibri;text-align:left;">Blood Pressure</th>';
             $html.='   <th style="background-color: #C5CACE;color: #375B91;font-size: 15px;font-weight: normal;padding: 8px;font-family:Calibri;text-align:left;">HB Level</th>';
             $html.='   <th style="background-color: #C5CACE;color: #375B91;font-size: 15px;font-weight: normal;padding: 8px;font-family:Calibri;text-align:left;">SR Ferritin</th>';
              $html.='  <th style="background-color: #C5CACE;color: #375B91;font-size: 15px;font-weight: normal;padding: 8px;font-family:Calibri;text-align:left;">Iron Replacement</th>';
              $html.='  <th style="background-color: #C5CACE;color: #375B91;font-size: 15px;font-weight: normal;padding: 8px;font-family:Calibri;text-align:left;"><span style="display:block;width:98px;">Updated By</span></th>';
               
           $html.=' </tr>';
			$html.='</thead>';
			$html.='<tbody id="holder">';
            
if(!empty($result)){
			foreach($result as $injection){
				$injection_name = $CI->mdl_medication->get_injaction($patient_id,$injection->patients,$injection->injections);
				$injection_monitoring =  $CI->mdl_medication->get_injection_details($patient_id,$injection->id);
				$shift = $CI->mdl_medication->get_shift_details($injection->shift);
				$shift_name = $shift[0]->shift_name;
				
				if(!empty($injection_monitoring)){
					//$html.='<div id="form_'.$injection->id.'">';
					//$html.='<table>';
					$cuid = $CI->session->userdata("user_id");
					$user_detail = $CI->mdl_patient->get_last_modify_by($cuid);
					$html.='<tr id="form_'.$injection->id.'">';
					$html.='<input type="hidden" name="id" id="id" value="'.$injection_monitoring[0]->id.'">';
					$html.='<input type="hidden" name="pid" id="pid" value="'.$pid.'">';
					$html.='<input type="hidden" name="sdetail_id" id="sdetail_id" value="'.$injection->id.'">';
					$html.='<input type="hidden" name="date" id="date" value="'.$injection->created_date.'">';
					$html.='<input type="hidden" name="injection" id="injection" value="'.$injection_name[0]->id.'">';
					$html.='<input type="hidden" name="modified_by" id="modified_by" value="'.$cuid.'">';
					
				//	$html.='<td>'.date("Y-m-d ", strtotime($injection->created_date)).'<br/>'.$shift_name.'</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">'.date("Y-m-d ", strtotime($injection->created_date)).'</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">'.$injection_name[0]->name.'</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">'.$injection_monitoring[0]->dosage.'</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">'.$injection_monitoring[0]->blood_pressure.'</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">'.$injection_monitoring[0]->hb_level.'</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">'.$injection_monitoring[0]->sr_ferritin.'</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">'.$injection_monitoring[0]->iron_replacement.'</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">'.$user_detail.'</td>';
					
					$html.='</tr>';
					//$html.='</table>';
					//$html.='</div>';
				}
				else{
					//$html.='<div id="form_'.$injection->id.'">';
					//$html.='<table>';
					$html.='<tr id="form_'.$injection->id.'">';
					$html.='<input type="hidden" name="id" id="id" value="">';
					$html.='<input type="hidden" name="pid" id="pid" value="'.$pid.'">';
					$html.='<input type="hidden" name="sdetail_id" id="sdetail_id" value="'.$injection->id.'">';
					$html.='<input type="hidden" name="date" id="date" value="'.$injection->created_date.'">';
					$html.='<input type="hidden" name="injection" id="injection" value="'.$injection_name[0]->id.'">';
					$html.='<input type="hidden" name="created_date" id="created_date" value="'.date("Y-m-d h:i:s").'">';
					$html.='<input type="hidden" name="modified_by" id="modified_by" value="'.$CI->session->userdata("user_id").'">';
					
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">'.date("Y-m-d ", strtotime($injection->created_date)).'<br/>'.$shift_name.'</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">'.$injection_name[0]->name.'</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">-</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">-</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">-</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">-</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">-</td>';
					$html.='<td style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;">-</td>';
					
					$html.='</tr>';
					//$html.='</table>';
					//$html.='</div>';
				}
			}
		}else{
			$html.='<tr><td colspan="5" style="background-color:#F3F3F3;border-top: 1px solid #DFDFDF;color: #666699;padding: 8px;font-family:Calibri;"><h3>No Records Found!</h3></td></tr>';
		}
		$html.='</tbody>';
            
    $html.=' </table>';
	$html .='</div>';
	 $html.='</div>';
    if (!empty($result))
    {
		
        $medication_inj_templete = $CI->mdl_settings->setting('pdf_quote_template');
    }

   // $data = array(	
	//	'show'						=>$show,
	//	'patient_notes'			 => $patient_notes,
     //  	'patient_details'			 => $patient_details,
     //   'company'           =>$company,
	//	'print'			 			=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
     //   'output_type'     			  => 'pdf'
   // );
	
    //$html = $CI->load->view('patient_notes_templates/pdf/'.$patient_notes_templete, $data, TRUE);
	//echo $html;exit;
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("patient/patient");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'Patient_notes' , $stream);
	}
	
}

function generate_patient_note_single($stream = TRUE, $recipt_template = 'default',$print='0', $id)
{
	//echo $recipt_template; exit;	
	$CI = & get_instance();

  
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('admin/mdl_admin');

	$company_detail=$CI->mdl_admin->get_all_detail('company');

	$notes=$CI->mdl_patient->getPatientNotes($id);
	
    $data = array(	
		'data'	=>$notes,
		'print'		=> $print,
		
		'company'	=>$company_detail,
	        'output_type'  	=> 'pdf'
    );
	
    $html = $CI->load->view('patient_notes_templates/pdf/' . $recipt_template, $data, TRUE);
	
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("patient/patient");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'Patient_notes' , $stream);
	}
	
}
function generate_misc_single($array,$stream = TRUE, $recipt_template = 'default',$print='0', $id)
{
	$CI = & get_instance();

    $CI->load->model('billing/mdl_billing');
	$CI->load->model('clinicalchart/mdl_patient');
	$CI->load->model('admin/mdl_admin');
	$company_detail=$CI->mdl_admin->get_all_detail('company');
	


    $data = array(	
		'allmisc'	  			=>$array,
		'print'			 			=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
        'output_type'     			  => 'pdf',
		'company'				=>$company_detail
    );
	
    $html = $CI->load->view('miscinvoice_templates/pdf/' . $recipt_template, $data, TRUE);
	////echo $html;exit;
	$new=preg_replace('/^\s+|\n|\r|\s+$/m', '', $html);
	//echo $new;exit;
	if($print=='1')
	{?>
		<script language="javascript">
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes' // only works in IE, but here for completeness
		].join(',');
			  var mywindow=window.open('', 'new window', params);
			  mywindow.document.write('<?php echo addslashes($new);?>');
		 	  mywindow.print();
			  mywindow.close();
			  document.location.href="<?php echo site_url("billing/miscellinvoice");?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

     return pdf_create($html,'Misc_invoice' , $stream);
	
	}
}