<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function generate_patient_profile_pdf($patient_id, $stream = TRUE, $patient_profile_templete = 'default',$print='0')
{
    $CI = & get_instance();
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('settings/mdl_settings');
		$show='true';
		$patient_details = $CI->mdl_patient->getPatientProfile($patient_id);
	
    $data = array(	
		'show'						=>$show,
	   	'patient_details'			 => $patient_details,
    	'print'			 			=> $print,
	    'output_type'     			  => 'pdf'
    );
	
	//echo $patient_profile_templete;exit;
	$html = $CI->load->view('patient_profile_templates/pdf/'.$patient_profile_templete, $data, TRUE);
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
			  document.location.href="<?php echo site_url("patient/patient_profile/".base64_encode($patient_id));?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'patient_profile' , $stream);
	}
	
	
	
}


function generate_patient_note_pdf($patient_id, $stream = TRUE, $patient_notes_templete = 'default',$print='0')
{
    
	$CI = & get_instance();

 	$CI->load->model('patient/mdl_patient');
	$CI->load->model('settings/mdl_settings');
	$show='true';
	
	$patient_notes=$CI->mdl_patient->getPatientNotes($patient_id);
	$patient_notes_report=array();
	$i=0;

    $data = array(	
		'show'						=>$show,
		'patient_notes'			 => $patient_notes,
      	'print'			 			=> $print,
		'notes_id'			 		=> '',
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('patient_notes_templates/pdf/'.$patient_notes_templete, $data, TRUE);
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
			  document.location.href="<?php echo site_url("patient/notes/".base64_encode($patient_id));?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'Patient_notes' , $stream);
	}
	
}

function generate_patient_note_pdf1($patient_id, $note_id, $stream = TRUE, $patient_notes_templete = 'default',$print='0')
{
	$CI = & get_instance();
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('settings/mdl_settings');
	$show='true';
	 
	$patient_notes=$CI->mdl_patient->getPatientSingleNotes($patient_id,$note_id);
	//echo "<pre>";print_r($patient_notes);exit;
	$patient_notes_report=array();
	$i=0;

    $data = array(	
		'show'						=>$show,
		'patient_notes'				=> $patient_notes,
      	'print'			 			=> $print,
		'notes_id'			 		=> $note_id,
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('patient_notes_templates/pdf/'.$patient_notes_templete, $data, TRUE);
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
			  document.location.href="<?php echo site_url("patient/notes/".base64_encode($patient_id));?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'Patient_notes' , $stream);
	}
	
}

function generate_patient_referral_pdf($patient_id, $stream = TRUE, $patient_referral_templete = 'default',$print='0')
{
    
	$CI = & get_instance();

 
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('settings/mdl_settings');
	$show='true';
	
	$patient_referral=$CI->mdl_patient->getPatientReferral($patient_id);
	$patient_referral_report=array();
	$i=0;

    $data = array(	
		'show'						=>$show,
		'patient_referral'			 => $patient_referral,
      	'print'			 			=> $print,
		'ref_id'			 			=> '',
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('patient_referral_templates/pdf/'.$patient_referral_templete, $data, TRUE);
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
			  document.location.href="<?php echo site_url("patient/referral/".base64_encode($patient_id));?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'patient_referral' , $stream);
	}
	
}

function generate_patient_referral_pdf1($patient_id, $ref_id, $stream = TRUE, $patient_referral_templete = 'default',$print='0')
{
    
	$CI = & get_instance();

 
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('settings/mdl_settings');
	$show='true';
	
	$patient_referral=$CI->mdl_patient->getPatientReferral($patient_id);
	$patient_referral_report=array();
	$i=0;

    $data = array(	
		'show'						=>$show,
		'patient_referral'			 => $patient_referral,
      	'print'			 			=> $print,
		'ref_id'			 			=> $ref_id,
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('patient_referral_templates/pdf/'.$patient_referral_templete, $data, TRUE);
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
			  document.location.href="<?php echo site_url("patient/referral/".base64_encode($patient_id));?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'patient_referral' , $stream);
	}
	
}

function generate_patient_certificate_pdf($patient_id, $stream = TRUE, $patient_certificate_templete = 'default',$print='0')
{
    $CI = & get_instance();
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('settings/mdl_settings');
	$CI->load->model('admin/mdl_admin');
	$company=$CI->mdl_admin->get_all_detail('company');
	$show='true';
	$patient_certificate=$CI->mdl_patient->getPatientCertificate($patient_id);
	$patient_certificatel_report=array();
	$i=0;

	$company=array(
		'company'=>$company
	);

    $data = array(	
		'show'						=>$show,
		'Header'                      =>$CI->load->view('common/header/header', $company, TRUE),
		'patient_certificate'			 => $patient_certificate,
      	'print'			 			=> $print,
		'cer_id'			 			=> '',
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('patient_certificate_templates/pdf/'.$patient_certificate_templete, $data, TRUE);
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
			  document.location.href="<?php echo site_url("patient/certificate/".base64_encode($patient_id));?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'patient_certificate' , $stream);
	}
	
}

function generate_patient_certificate_pdf1($patient_id,  $cer_id,$stream = TRUE, $patient_certificate_templete = 'default',$print='0')
{
    $CI = & get_instance();
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('settings/mdl_settings');
	$CI->load->model('admin/mdl_admin');
	$company=$CI->mdl_admin->get_all_detail('company');
	$show='true';
	$patient_certificate=$CI->mdl_patient->getPatientCertificate($patient_id);
	$patient_certificatel_report=array();
	$i=0;

	$company=array(
		'company'=>$company
	);

    $data = array(	
		'show'						=>$show,
		'Header'                      =>$CI->load->view('common/header/header', $company, TRUE),
		'patient_certificate'			 => $patient_certificate,
      	'print'			 			=> $print,
		'cer_id'			 			=>  $cer_id,
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('patient_certificate_templates/pdf/'.$patient_certificate_templete, $data, TRUE);
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
			  document.location.href="<?php echo site_url("patient/certificate/".base64_encode($patient_id));?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'patient_certificate' , $stream);
	}
	
}

function generate_patient_prescription_pdf($patient_id, $stream = TRUE, $patient_prescription_templete = 'default',$print='0')
{
    $CI = & get_instance();
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('settings/mdl_settings');
	$CI->load->model('admin/mdl_admin');
	$company=$CI->mdl_admin->get_all_detail('company');
	$show='true';
	$patient_prescription=$CI->mdl_patient->getPatientPrescription($patient_id);
	$patient_prescription_report=array();
	$i=0;

	$company=array(
		'company'=>$company
	);

    $data = array(	
		'show'						=>$show,
		'Header'                      =>$CI->load->view('common/header/header', $company, TRUE),
		'patient_prescription'			 => $patient_prescription,
      	'print'			 			=> $print,
		'pre_id'			 			=> '',
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('patient_prescription_templates/pdf/'.$patient_prescription_templete, $data, TRUE);
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
			  document.location.href="<?php echo site_url("patient/prescription/".base64_encode($patient_id));?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'patient_prescription' , $stream);
	}
	
}

function generate_patient_prescription_pdf1($patient_id,$pre_id, $stream = TRUE, $patient_prescription_templete = 'default',$print='0')
{
    $CI = & get_instance();
	$CI->load->model('patient/mdl_patient');
	$CI->load->model('settings/mdl_settings');
	$CI->load->model('admin/mdl_admin');
	$company=$CI->mdl_admin->get_all_detail('company');
	$show='true';
	$patient_prescription=$CI->mdl_patient->getPatientPrescription($patient_id);
	$patient_prescription_report=array();
	$i=0;

	$company=array(
		'company'=>$company
	);

    $data = array(	
		'show'						=>$show,
		'Header'                      =>$CI->load->view('common/header/header', $company, TRUE),
		'patient_prescription'			 => $patient_prescription,
      	'print'			 			=> $print,
		'pre_id'			 			=> $pre_id,
        'output_type'     			  => 'pdf'
    );
	
    $html = $CI->load->view('patient_prescription_templates/pdf/'.$patient_prescription_templete, $data, TRUE);
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
			  document.location.href="<?php echo site_url("patient/prescription/".base64_encode($patient_id));?>";
		</script>
		
	<?php }
	else
	{
    $CI->load->helper('mpdf');

    return pdf_create($html,'patient_prescription' , $stream);
	}
	
}