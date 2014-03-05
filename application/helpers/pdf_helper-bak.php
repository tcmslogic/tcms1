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

function generate_medication_pdf($patient_id, $stream = TRUE, $medication_template = 'default',$print='0')
{
    $CI = & get_instance();

    $CI->load->model('medication/mdl_medication');
	$CI->load->model('medication/mdl_patient');

    $medication_details = $CI->mdl_medication->getMedicationDetails($patient_id);
	$medication_patient = $CI->mdl_medication->getAllMedications($patient_id);
    if (!$medication_template)
    {
        $medication_template = $CI->mdl_settings->setting('pdf_quote_template');
    }
	
    $data = array(
		'patient_details'			   => $CI->mdl_patient->getPatientProfile($patient_id),
        'medication_details'           => $medication_details,
        'medication_patient'           => $medication_patient,
		'print'			 			   => $print,
		'updater'					   => $CI->mdl_medication->getUpdater($medication_patient->updated_by),
        'output_type'     			   => 'pdf'
    );
	
    $html = $CI->load->view('medication_templates/pdf/' . $medication_template, $data, TRUE);
	
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

    return pdf_create($html, lang('order') . '_' . str_replace(array('\\', '/'), '_', $order[0]->order_id), $stream);
	}
	
}


function generate_clinicalchart_pdf($patient_id, $stream = TRUE, $medication_template = 'default',$print='0')
{
    
	//echo $patient_id;exit;
	
	$CI = & get_instance();

    $CI->load->model('clinicalchart/mdl_clinicalchart');
	$CI->load->model('clinicalchart/mdl_patient');
	
	if($patient_id=='all'){
		$show='false';
		$patient_details='';
	}else{
   		$show='true';
		$patient_details = $CI->mdl_patient->getPatientProfile($patient_id);
	}
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
        //'medication_patient'           => $medication_patient,
		'print'			 			=> $print,
		//'updater'					  => $CI->mdl_patient->get_last_modify_by($patient_details->modified_by),
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('clinicalchart_templates/pdf/' . $medication_template, $data, TRUE);
	
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

    return pdf_create($html, lang('order') . '_' . str_replace(array('\\', '/'), '_', $order[0]->order_id), $stream);
	}
	
}

/*************************************************************************************************/