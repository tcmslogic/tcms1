
<?php
	$access_level=array("Reception","Manager1","Admin");
	$access_level1= array("Nurses","Admin","Doctor");
	$denied_level=array("Nurses","Manager1","Doctor");
?>
<script>
  $(function() {
    $( ".datepicker" ).datepicker();
	//$( "#datepicker" ).datepicker( "option", "dateFormat", "yy/mm/dd" );
  });
   $(function() {
    $( "#select_date" ).datepicker();
	//$( "#select_date" ).datepicker( "option", "dateFormat", "yy/mm/dd" );
  });
 
  </script>
   <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
  <script language="javascript">
$(function() {
$("#admission_data").validate();
});

function checkValidation()
{
	if($(".required").val()=="")
	{
		//alert("test here comesf");
		//$(".required").focus();
		return false;
	}
	return true;
}

$(document).ready(function(){
	// binds form submission and fields to the validation engine
	$("#admission_data").validationEngine();
});

</script>
<div id="Patient_Profile"><ul><li ><a href="<?php echo site_url("patient/patient_profile/".$patient_id);?>">Patient Profile</a></li>
   <!--li><a href="<?php echo site_url("patient/patient_attendance/".$patient_id);?>">Patient Attendance </a></li-->
   <?php 
   if(in_array($this->session->userdata("user_type"),$access_level))
   {?>
   <li><a href="<?php echo site_url("patient/patient_attendance/".$patient_id);?>">Patient Attendance </a></li>
  
   <?php }?> 
 <?php
   if($this->session->userdata("user_type")!="Reception")
   {
	if(empty($patient_details)){ ?>
   <li ><a href="<?php echo site_url("patient/edit_patient_financial_profile/".$patient_id);?>">Patient Financial Profile</a></li>
   <?php }else{ ?>
   <li ><a href="<?php echo site_url("patient/patient_financial_profile/".$patient_id);?>">Patient Financial Profile</a></li>
   <?php } 
   }?>
    <?php
   	$level=array("Reception","Manager1");
    if(!in_array($this->session->userdata("user_type"),$level))
   {?>
<li class="active"><a href="<?php echo site_url("patient/admission_data/".$patient_id);?>">Admission Data</a></li>
<?php }?>
   <li><a href="<?php echo site_url("patient/notes/".$patient_id);?>">Notes</a></li>
   </ul></div>

<div id="Profile_right"><div id="top_border" style="width:100%; margin-bottom:1%;">
      <div id="left_title">
        <h2>Admission Data </h2>
      </div> </div>
	<div style="clear:both;"></div>  
<style type="text/css">
.center-table-txt{
 background: none repeat scroll 0 0 #FDFDFD;
    border: 1px solid #BDBDBD;
    border-radius: 5px;
    float: right;
    height: 15px !important;
}
label{ display:inline !important;}
input[type="text"] { margin-bottom:5px !important;}
</style>
<!------------------------for user group vise chart----------------------------->
	
	
<div class="container-fluid">

    <?php //include("menu_header.php");?>

	<div class="row-fluid">
	
	<form name="admission_data" id="admission_data" action="<?php echo site_url("patient/admission_data");?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $admission_data->patient_id;?>" />
	<div id="top_content">
    <!--<label> Dialysis Center</label>-->
 	<input type="hidden" name="dialysis_center" id="dialysis_center" value="<?php echo $admission_data->dialysis_center;?>"/>
	
	<label> Select Date</label>
 	<input type="text" name="selected_date" id="select_date" value="<?php echo date("Y-m-d",strtotime($admission_data->selected_date));?>"/>

	<label> Current Modality:</label>
 	<select name="current_modality" id="current_modality">
		<option value="">Select</option>
		<option value="HD" <?php if($admission_data->current_modality=="HD"){?> selected="selected"<?php }?>>HD</option>
	</select>
     <div style="float:right">
   
       <div id="print_button"><a href="<?php echo site_url("patient/generate_pdf_admission/".$patient_id);?>"><img src="<?php echo base_url("assets/default/images/pdf.png");?>" style="width:28px;" /></a></div>
       <div id="print_button"><a href="<?php echo site_url("patient/generate_print_admission/".$patient_id);?>"><img src="<?php echo base_url("assets/default/images/print_button.png");?>" /></a></div>
       
    </div>
 </div>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Clinical Details</a></li>
    <li><a href="#tabs-2">Vital Signs/Serology Data</a></li>
    <li><a href="#tabs-3">Admission Lab Results</a></li>
  </ul>
  <div id="tabs-1">
   		<table style="border: 1px solid #E5E5E5; font-size: 13px; font-weight: 48%; width: 100%;">
                        <tr>
                            <th align="left" style="padding-bottom: 10px; font-size:15px;">
                                Clinical Details
                            </th>
                        </tr>
                        <tr style="font-family: Calibri; font-size: 15px;">
                            <td style="float: left; width: 370px;">
                                <b>Primary renal disease: </b>
                                <input required name="primary_renal_disease" type="text" id="primary_renal_disease" class="center-table-txt validate[required] required" value="<?php echo $admission_data->primary_renal_disease;?>"/>
                            </td>
                            <td style="float: right; width: 475px;">
                                <b>Urological disorder, including surgery: </b>
                                <input   name="urological_disorder_including_surgery" type="text" id="urological_disorder_including_surgery" class="center-table-txt validate[required] required" value="<?php echo $admission_data->primary_renal_disease;?>"/>
                            </td>
                        </tr>
                    </table>
        <table style="width: 100%; height: 20px; font-size: 15px!important; font-family: Calibri;
                        border: 1px solid #E5E5E5; margin-top: 20px; padding: 10px 9px 10px 11px;">
                        <tr>
                            <th align="left">
                                Co-morbid condition present:
                            </th>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #E5E5E5; float: left; width: 47%; line-height: 35px;
                                margin-top: 10px; padding: 6px 6px 12px 5px;">
                               
							    <input id="diabetes_mellitus" type="checkbox" name="diabetes_mellitus" <?php if($admission_data->diabetes_mellitus=="on"){?> checked="checked"<?php }?> /><label>Diabetes mellitus</label><br />
                                
								<input id="hypertension_requiring_treatment" type="checkbox" name="hypertension_requiring_treatment" <?php if($admission_data->hypertension_requiring_treatment=="on"){?> checked="checked"<?php }?>/><label>Hypertension, requiring treatment</label><br />
                               
							    <input id="impaired_vision_sufficient_to_interfere_with_self_care" type="checkbox" name="impaired_vision_sufficient_to_interfere_with_self_care" <?php if($admission_data->impaired_vision_sufficient_to_interfere_with_self_care=="on"){?> checked="checked"<?php }?>/><label>Impaired vision, sufficient to interfere with self-care</label><br />
                               
							    <input id="ischaemic_heart_disease" type="checkbox" name="ischaemic_heart_disease" <?php if($admission_data->ischaemic_heart_disease=="on"){?> checked="checked"<?php }?>/><label>Ischaemic heart disease</label><br />
                               
							    <input id="congestive_cardiac_failure" type="checkbox" name="congestive_cardiac_failure" <?php if($admission_data->congestive_cardiac_failure=="on"){?> checked="checked"<?php }?>/><label for="MainContent_ChkCongestive">Congestive cardiac failure</label><br />
                               
							    <input id="acute_pulmonary_oedema" type="checkbox" name="acute_pulmonary_oedema" <?php if($admission_data->acute_pulmonary_oedema=="on"){?> checked="checked"<?php }?>/><label>Acute pulmonary oedema</label><br />
                               
							    <input id="other_cardiac_disorder_specify" type="checkbox" name="other_cardiac_disorder_specify" <?php if($admission_data->other_cardiac_disorder_specify=="on"){?> checked="checked"<?php }?> value="<?php echo $admission_data->other_cardiac_disorder_specify;?>"/><label>Other cardiac disorder, specify:</label>
                               
							    <input name="other_cardiac_disorder_specify_content" type="text" id="other_cardiac_disorder_specify_content" class="center-table-txt" style="width:120px;" value="<?php echo $admission_data->other_cardiac_disorder_specify_content;?>"/><br />
                               
							    <input id="cerebro_vascular_disorder" type="checkbox" name="cerebro_vascular_disorder" <?php if($admission_data->cerebro_vascular_disorder=="on"){?> checked="checked"<?php }?>/><label>Cerebro vascular disorder</label><br />
                               
							    <input id="peripheral_vascular_disorder" type="checkbox" name="peripheral_vascular_disorder" <?php if($admission_data->peripheral_vascular_disorder=="on"){?> checked="checked"<?php }?>/><label>Peripheral vascular disorder</label><br />
                                
								<input id="non_accidental_limb_amputation_due_to_vascular_disorder" type="checkbox" name="non_accidental_limb_amputation_due_to_vascular_disorder" <?php if($admission_data->non_accidental_limb_amputation_due_to_vascular_disorder=="on"){?> checked="checked"<?php }?>/><label>Non-accidental limb amputation due to vascular disorder</label><br />
                             
							    <input id="pulmonary_TB" type="checkbox" name="pulmonary_TB" <?php if($admission_data->pulmonary_TB=="on"){?> checked="checked"<?php }?>/><label>Pulmonary TB</label>
                            </td>
                            <td style="border: 1px solid #E5E5E5; float: left; width: 48%; margin-left: -1px;
                                line-height: 35px; margin-top: 10px; padding: 8px;">
                              
							    <input id="chronic_respiratory_disorder_specify" type="checkbox" name="chronic_respiratory_disorder_specify" <?php if($admission_data->chronic_respiratory_disorder_specify=="on"){?> checked="checked"<?php }?>/><label>Chronic respiratory disorder, specify:</label>
								
							<input name="chronic_respiratory_disorder_specify_content" type="text" id="chronic_respiratory_disorder_specify_content" class="center-table-txt" style="width:120px;margin-right: 10px;" value="<?php echo $admission_data->chronic_respiratory_disorder_specify_content;?>" value="<?php echo $admission_data->diabetes_mellitus;?>"/><br />
                              
							    <input id="chronic_liver_disorder_specify" type="checkbox" name="chronic_liver_disorder_specify" <?php if($admission_data->chronic_liver_disorder_specify=="on"){?> checked="checked"<?php }?>/><label>Chronic liver disorder, specify:</label>
								
								<input name="chronic_liver_disorder_specify_content" type="text" id="chronic_liver_disorder_specify_content" class="center-table-txt" style="width:120px;margin-right: 10px;" value="<?php echo $admission_data->chronic_liver_disorder_specify_content;?>" value="<?php echo $admission_data->diabetes_mellitus;?>"/><br />
                              
							    <input id="gastrointestinal_disorder_specify" type="checkbox" name="gastrointestinal_disorder_specify" <?php if($admission_data->gastrointestinal_disorder_specify=="on"){?> checked="checked"<?php }?>/><label>Gastrointestinal disorder, specify:</label>
							
								<input name="gastrointestinal_disorder_specify_content" type="text" id="gastrointestinal_disorder_specify_content" class="center-table-txt" style="width:120px;margin-right: 10px;" value="<?php echo $admission_data->gastrointestinal_disorder_specify_content;?>"/><br />
                                
								<input id="cancer_specify" type="checkbox" name="cancer_specify" <?php if($admission_data->cancer_specify=="on"){?> checked="checked"<?php }?>/><label>Cancer, specify:</label>
								
								<input name="cancer_specify_content" type="text" id="cancer_specify_content" class="center-table-txt" style="width:120px;margin-right: 10px;" value="<?php echo $admission_data->cancer_specify_content;?>"/><br />
                                <input id="renal_bone_disease" type="checkbox" name="renal_bone_disease" <?php if($admission_data->renal_bone_disease=="on"){?> checked="checked"<?php }?>/><label>Renal bone disease (biochem. or X-ray evidence)</label><br />
                               
							    <input id="ho_parathyroidectomy" type="checkbox" name="ho_parathyroidectomy" <?php if($admission_data->ho_parathyroidectomy=="on"){?> checked="checked"<?php }?>/><label>h/o parathyroidectomy</label><br />
                               
							    <input id="ho_psychotic_disorder" type="checkbox" name="ho_psychotic_disorder" <?php if($admission_data->ho_psychotic_disorder=="on"){?> checked="checked"<?php }?> /><label>h/o psychotic disorder</label><br />
                               
							    <input id="any_other_psychiatric_disorder" type="checkbox" name="any_other_psychiatric_disorder" <?php if($admission_data->any_other_psychiatric_disorder=="on"){?> checked="checked"<?php }?>/><label>any other psychiatric disorder</label><br />
                               
							    <input id="dementia" type="checkbox" name="dementia" <?php if($admission_data->dementia=="on"){?> checked="checked"<?php }?>/><label>Dementia</label><br />
                                
								<input id="current_active_substance_abuse" type="checkbox" name="current_active_substance_abuse" <?php if($admission_data->current_active_substance_abuse=="on"){?> checked="checked"<?php }?>/><label>Current active substance abuse (drug, alcohol)</label><br />
                               
							    <input id="other_co_morbidity_specify" type="checkbox" name="other_co_morbidity_specify" <?php if($admission_data->other_co_morbidity_specify=="on"){?> checked="checked"<?php }?>/><label>Other co-morbidity, specify:</label>
                                <input name="other_co_morbidity_specify_content" type="text" id="other_co_morbidity_specify_content" class="center-table-txt" style="width:120px;margin-right: 10px;" value="<?php echo $admission_data->other_co_morbidity_specify_content;?>"/><br />
                            </td>
                        </tr>
                    </table>
  </div>
  <div id="tabs-2">
    <table style="border: 1px solid #E5E5E5; padding: 10px; width: 100%;
                    font-family: Calibri; font-size: 15px;">
                    <tr>
                        <th align="left" style="font-size: 15px;color:#696969;">
                            SECTION III : VITAL SIGNS
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" style="border: solid 1px #E5E5E5; margin-top: 10px;">
                                <tr style="background-color: #C5CACE; color: #396380; font-weight: bold; height: 31px;
                                    text-align: center;">
                                    <td class="spac-id">&nbsp;
                                        
                                    </td>
                                    <td>
                                        (mmHg)
                                    </td>
                                    
                                    <td class="value_space">
                                        Value
                                    </td>
                                    <td class="bg-space">&nbsp;
                                        
                                    </td>
                                    <td class="spac-id">&nbsp;
                                        
                                    </td>
                                    <td>
                                        (mmHg)
                                    </td>
                                    
                                    <td class="value_space">
                                        Value
                                    </td>
                                </tr>
                                <tr>
                                    <td class="spac-id">
                                        A.
                                    </td>
                                    <td class="clinic-td">
                                        Pre Systolic BP
                                    </td>
                                    
                                    <td>
                                        <input   name="pre_systolic_BP" type="text" id="pre_systolic_BP" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->pre_systolic_BP;?>"/>
                                    </td>
                                    <td class="bg-space">&nbsp;
                                        
                                    </td>
                                    <td class="spac-id">
                                        D.
                                    </td>
                                    <td class="clinic-td">
                                        Post Systolic BP
                                    </td>
                                    <td>
                                        <input   name="post_systolic_BP" type="text" id="post_systolic_BP" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->post_systolic_BP;?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="spac-id">
                                        B.
                                    </td>
                                    <td class="clinic-td">
                                        Pre Diastolic BP
                                    </td>
                                    
                                    <td>
                                        <input   name="pre_Diastolic_BP" type="text" id="pre_Diastolic_BP" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->pre_Diastolic_BP;?>"/>
                                    </td>
                                    <td class="bg-space">&nbsp;
                                        
                                    </td>
                                    <td class="spac-id">
                                        E.
                                    </td>
                                    <td class="clinic-td">
                                        Post Diastolic BP
                                    </td>
                                    
                                    <td>
                                        <input   name="post_diastolic_BP" type="text" id="post_diastolic_BP" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->post_diastolic_BP;?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="spac-id">
                                        C.
                                    </td>
                                    <td class="clinic-td">
                                        Pre Weight
                                    </td>
                                    
                                    <td>
                                        <input   name="pre_weight" type="text" id="pre_weight" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->pre_weight;?>"/>
                                    </td>
                                    <td class="bg-space">&nbsp;
                                        
                                    </td>
                                    <td class="spac-id">
                                        F.
                                    </td>
                                    <td class="clinic-td">
                                        Post Weight
                                    </td>
                                    
                                    <td>
                                        <input   name="post_weight" type="text" id="post_weight" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->post_weight;?>"/>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
    <table style="width: 100%; border: 1px solid #E5E5E5; margin-top: 10px; padding: 10px;">
                    <tr>
                        <th align="left" style="font-size: 15px;color:#696969;">
                            SECTION IV : SEROLOGY DATA
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" style="border: solid 1px #E5E5E5; margin-top: 10px;">
                                <tr style="background-color: #C5CACE; color: #396380; font-weight: bold; height: 30px;
                                    font-family: Calibri; font-size: 15px; text-align: center;">
                                    <td class="spac-id">&nbsp;
                                        
                                    </td>
                                    <td>
                                        (mmHg)
                                    </td>
                                    
                                    <td>
                                        Value
                                    </td>
                                    <td class="bg-space1">&nbsp;
                                        
                                    </td>
                                    <td>&nbsp;
                                        
                                    </td>
                                    <td>
                                        (mmHg)
                                    </td>
                                    
                                    <td>
                                        Value
                                    </td>
                                </tr>
                                <tr>
                                    <td class="spac-id">
                                        A.
                                    </td>
                                    <td class="clinic-td">
                                        HBsAg
                                    </td>
                                    
                                    <td>
                                        <input   name="HBsAg" type="text" id="HBsAg" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->HBsAg;?>"/>
                                    </td>
                                    <td class="bg-space1">&nbsp;
                                        
                                    </td>
                                    <td class="spac-id">
                                        D.
                                    </td>
                                    <td class="clinic-td">
                                        Anti HIV
                                    </td>
                                    
                                    <td>
                                        <input   name="anti_HIV" type="text" id="anti_HIV" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->anti_HIV;?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="spac-id">
                                        B.
                                    </td>
                                    <td class="clinic-td">
                                        HBsAb
                                    </td>
                                    
                                    <td>
                                        <input   name="HBsAb" type="text" id="HBsAb" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->HBsAb;?>"/>
                                    </td>
                                    <td class="bg-space1">&nbsp;
                                        
                                    </td>
                                    <td class="spac-id">
                                        E.
                                    </td>
                                    <td class="clinic-td">
                                        Anti HCV
                                    </td>
                                    
                                    <td>
                                        <input   name="anti_HCV" type="text" id="anti_HCV" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->anti_HCV;?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="spac-id">
                                        C.
                                    </td>
                                    <td class="clinic-td">
                                        HBeAg
                                    </td>
                                    
                                    <td>
                                        <input   name="HBsAg" type="text" id="HBsAg" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->HBsAg;?>"/>
                                    </td>
                                    <td class="bg-space1">&nbsp;
                                        
                                    </td>
                                    <td class="spac-id">
                                        F.
                                    </td>
                                    <td class="clinic-td">
                                        CMV
                                    </td>
                                    
                                    <td>
                                        <input   name="CMV" type="text" id="CMV" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->CMV;?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td class="clinic-td">
                                    </td>
                                    <td>&nbsp;
                                        
                                    </td>
                                    <td class="bg-space1">&nbsp;
                                        
                                    </td>
                                    <td class="spac-id">
                                        G.
                                    </td>
                                    <td class="clinic-td">
                                        VDRL
                                    </td>
                                    
                                    <td>
                                        <input   name="VDRL" type="text" id="VDRL" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->VDRL;?>"/>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
  </div>
  <div id="tabs-3">
   <table style="width: 100%; border: 1px solid #E5E5E5; padding: 10px; font-family: Calibri;
                        font-size: 15px;">
                        <tr>
                            <td align="left" style="font-weight: bold; padding-bottom: 10px;">
                                SECTION V : ADMISSION LAB RESULTS
                            </td>
                        </tr>
                        <tr>
                            <td style="float: left; width: 100%">
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5; padding: 10px; font-size: 12px;">
                                    <tr>
                                        <th align="left" style="font-size:15px;">
                                            Chemistry:
                                        </th>
                                    </tr>
                                </table>
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5; padding-bottom: 20px;">
                                    <tr style="background-color: #C5CACE; color: #396380; height: 30px; font-weight: bold;
                                        text-align: center;">
                                        <td class="spac-id">&nbsp;
                                            
                                        </td>
                                        <td>
                                            (mmHg)
                                        </td>
                                        
                                        <td>
                                            Value
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            A.
                                        </td>
                                        <td class="clinic-td">
                                            Sr Creatinine
                                        </td>
                                        
                                        <td>
                                            <input   name="sr_creatinine" type="text" id="sr_creatinine" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->sr_creatinine;?>"/><b
                                                style="float: right">umol/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            B.
                                        </td>
                                        <td class="clinic-td">
                                            Plasma Urea
                                        </td>
                                        
                                        <td>
                                            <input   name="plasma_urea" type="text" id="plasma_urea" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->plasma_urea;?>"/><b
                                                style="float: right">umol/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            C.
                                        </td>
                                        <td class="clinic-td">
                                            Sr. Potassium
                                        </td>
                                        
                                        <td>
                                            <input   name="sr_potassium" type="text" id="sr_potassium" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->sr_potassium;?>"/><b
                                                style="float: right">umol/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            D.
                                        </td>
                                        <td class="clinic-td">
                                            RBS
                                        </td>
                                        
                                        <td>
                                            <input   name="RBS" type="text" id="RBS" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->RBS;?>"/><b
                                                style="float: right">umol/L</b>
                                        </td>
                                    </tr>
                                    <tr style="height: 61px;">
                                        <td style="border: none;">&nbsp;
                                            
                                        </td>
                                        <td class="clinic-td" style="border: none;">&nbsp;
                                            
                                        </td>
                                        <td style="border: none;">&nbsp;
                                            
                                        </td>
                                        <td style="border: none;">
                                            
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5; padding: 8px;">
                                    <tr>
                                        <th align="left">
                                            LFT/Calcium/Phosphate:
                                        </th>
                                    </tr>
                                </table>
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5;">
                                    <tr style="background-color: #C5CACE; color: #396380; height: 30px; font-weight: bold;
                                        text-align: center;">
                                        <td class="spac-id">&nbsp;
                                            
                                        </td>
                                        <td>
                                            (mmHg)
                                        </td>
                                        
                                        <td class="value_space">
                                            Value
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            A.
                                        </td>
                                        <td class="clinic-td">
                                            Sr. Albumin
                                        </td>
                                        
                                        <td>
                                            <input   name="sr_albumin" type="text" id="sr_albumin" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->sr_albumin;?>"/><b
                                                style="float: right">g/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            B.
                                        </td>
                                        <td class="clinic-td">
                                            Sr. Calcium
                                        </td>
                                        
                                        <td>
                                            <input   name="sr_calcium" type="text" id="sr_calcium" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->sr_calcium;?>"/><b
                                                style="float: right">mmol/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            C.
                                        </td>
                                        <td class="clinic-td">
                                            Sr. Phosphate
                                        </td>
                                        
                                        <td>
                                            <input   name="sr_phosphate" type="text" id="sr_phosphate" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->sr_phosphate;?>"/><b
                                                style="float: right">mmol/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            D.
                                        </td>
                                        <td class="clinic-td">
                                            ALP
                                        </td>
                                        
                                        <td>
                                            <input   name="ALP" type="text" id="ALP" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->ALP;?>"/><b
                                                style="float: right">U/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            E.
                                        </td>
                                        <td class="clinic-td">
                                            ALAT/SGPT
                                        </td>
                                        
                                        <td>
                                            <input  name="ALAT_SGPT" type="text" id="ALAT_SGPT" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->ALAT_SGPT;?>"/><b
                                                style="float: right">U/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            F.
                                        </td>
                                        <td class="clinic-td">
                                            AST/SGOT
                                        </td>
                                        
                                        <td>
                                            <input   name="AST_SGOT" type="text" id="AST_SGOT" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->AST_SGOT;?>"/><b
                                                style="float: right">U/L</b>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5; padding: 10px;">
                                    <tr>
                                        <th align="left">
                                            Hematology:
                                        </th>
                                    </tr>
                                </table>
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5;">
                                    <tr style="background-color: #C5CACE; color: #396380; font-weight: bold; text-align: center;
                                        height: 30px;">
                                        <td class="spac-id">&nbsp;
                                            
                                        </td>
                                        <td>
                                            (mmHg)
                                        </td>
                                        
                                        <td>
                                            Value
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            A.
                                        </td>
                                        <td class="clinic-td">
                                            Hb
                                        </td>
                                        
                                        <td>
                                            <input   name="Hb" type="text" id="Hb" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->Hb;?>"/><b
                                                style="float: right">g/dL</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            B.
                                        </td>
                                        <td class="clinic-td">
                                            PLT
                                        </td>
                                        
                                        <td>
                                            <input   name="PLT" type="text" id="PLT" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->PLT;?>"/><b
                                                style="float: right">10^9/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            C.
                                        </td>
                                        <td class="clinic-td">
                                            LY
                                        </td>
                                        
                                        <td>
                                            <input   name="LY" type="text" id="LY" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->LY;?>"/><b
                                                style="float: right">THSD/CU mm</b>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5; padding: 10px;">
                                    <tr>
                                        <th align="left">
                                            Iron:
                                        </th>
                                    </tr>
                                </table>
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5;">
                                    <tr style="background-color: #C5CACE; color: #396380; height: 30px; font-weight: bold;
                                        text-align: center;">
                                        <td class="spac-id">&nbsp;
                                            
                                        </td>
                                        <td>
                                            (mmHg)
                                        </td>
                                        
                                        <td>
                                            Value
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            A.
                                        </td>
                                        <td class="clinic-td">
                                            Sr. Iron
                                        </td>
                                        
                                        <td>
                                            <input   name="sr_iron" type="text" id="sr_iron" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->sr_iron;?>"/><b
                                                style="float: right">umol/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            B.
                                        </td>
                                        <td class="clinic-td">
                                            Sr. TIBC
                                        </td>
                                        
                                        <td>
                                            <input   name="sr_TIBC" type="text" id="sr_TIBC" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->sr_TIBC;?>"/><b
                                                style="float: right">umol/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            C.
                                        </td>
                                        <td class="clinic-td">
                                            Sr. Ferritin
                                        </td>
                                        
                                        <td>
                                            <input   name="sr_ferritin" type="text" id="sr_ferritin" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->sr_ferritin;?>"/><b
                                                style="float: right">ug/L</b>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5; padding: 10px;">
                                    <tr>
                                        <th align="left">
                                            Lipid (Fasting):
                                        </th>
                                    </tr>
                                </table>
                                <table width="99%" height="152px" border="0" style="border: solid 1px #E5E5E5;">
                                    <tr style="background-color: #C5CACE; color: #396380; height: 30px; font-weight: bold;
                                        text-align: center;">
                                        <td class="spac-id">&nbsp;
                                            
                                        </td>
                                        <td>
                                            (mmHg)
                                        </td>
                                        
                                        <td>
                                            Value
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            A.
                                        </td>
                                        <td class="clinic-td">
                                            LDL
                                        </td>
                                        
                                        <td>
                                            <input   name="LDL" type="text" id="LDL" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->LDL;?>"/><b
                                                style="float: right">mmol/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            B.
                                        </td>
                                        <td class="clinic-td">
                                            Sr Cholest
                                        </td>
                                        
                                        <td>
                                            <input   name="sr_cholest" type="text" id="sr_cholest" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->sr_cholest;?>"/><b
                                                style="float: right">mmol/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            C.
                                        </td>
                                        <td class="clinic-td">
                                            Triglyceride
                                        </td>
                                        
                                        <td>
                                            <input   name="triglyceride" type="text" id="triglyceride" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->triglyceride;?>"/><b
                                                style="float: right">mmol/L</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            D.
                                        </td>
                                        <td class="clinic-td">
                                            HDL
                                        </td>
                                        
                                        <td>
                                            <input   name="HDL" type="text" id="HDL" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->HDL;?>"/><b
                                                style="float: right">mmol/L</b>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="float: right; width: 100%;">
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5; padding: 10px;">
                                    <tr>
                                        <th align="left" style="padding: 10px;">
                                            Clinical Examination:
                                        </th>
                                    </tr>
                                </table>
                                <table width="99%" border="0" style="height: 152px; border: solid 1px #E5E5E5; padding-bottom: 0px;">
                                    <tr>
                                        <td style="border: none; line-height: 38px;">
                                            <b>Name of Doctor: </b>
                                        </td>
                                        <td>
                                            <input  name="name_of_doctor" type="text" id="name_of_doctor" style="width: 150px;" class="validate[required] required" value="<?php echo $admission_data->name_of_doctor;?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; line-height: 38px;">
                                            <b>Date (YY/mm/ddd): </b>
                                        </td>
                                        <td>
                                            <input name="date" type="text" id="date" class="datepicker validate[required] required" style="width: 150px;" value="<?php echo date("Y-m-d",strtotime($admission_data->date));?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; line-height: 38px;">
                                            <b>1st HD done: </b>
                                        </td>
                                        <td>
                                            <input name="first_HD_done" type="text" id="first_HD_done" value="<?php echo $admission_data->first_HD_done;?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; line-height: 38px;">
                                            <b>Fistula done by: </b>
                                        </td>
                                        <td>
                                            <input   name="fistula_done_by" type="text" id="fistula_done_by" class="validate[required] required" value="<?php echo $admission_data->fistula_done_by;?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; line-height: 38px;">
                                            <b>Access of HD: </b>
                                        </td>
                                        <td>
                                            <input   name="access_of_HD" type="text" id="access_of_HD" class="validate[required] required" value="<?php echo $admission_data->access_of_HD;?>"/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5; padding: 10px;">
                                    <tr>
                                        <th align="left">
                                            Bone:
                                        </th>
                                    </tr>
                                </table>
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5;">
                                    <tr style="background-color: #C5CACE; color: #396380; font-weight: bold; text-align: center;
                                        height: 30px;">
                                        <td class="spac-id">&nbsp;
                                            
                                        </td>
                                        <td>
                                            (mmHg)
                                        </td>
                                        
                                        <td>
                                            Value
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            A.
                                        </td>
                                        <td class="clinic-td">
                                            Intact PTH
                                        </td>
                                        
                                        <td>
                                            <input   name="intact_PTH" type="text" id="intact_PTH" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->intact_PTH;?>"/><b
                                                style="float: right">pg/ml</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="spac-id">
                                            B.
                                        </td>
                                        <td class="clinic-td">
                                            Sr. Aluminium
                                        </td>
                                        
                                        <td>
                                            <input   name="sr_aluminium" type="text" id="sr_aluminium" style="width: 150px; margin-left: 35px;" class="validate[required] required" value="<?php echo $admission_data->sr_aluminium;?>"/><b
                                                style="float: right">ug/L</b>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="float: right; width: 100%">
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5; padding: 10px;">
                                    <tr>
                                        <th align="left">
                                            Clinical Notes:
                                        </th>
                                    </tr>
                                </table>
                                <table width="99%" border="0" style="border: solid 1px #E5E5E5; padding: 10px;">
                                    <tr style="color: white; font-weight: 600; text-align: center;">
                                        <td>
                                            <textarea name="notes" rows="2" cols="20" id="notes" style="float: left; width: 460px; height: 85px;"><?php echo $admission_data->notes;?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
					<div style="clear: both;display: block;margin-top: 26px;">
<table style="display: block; margin-top: -20px; padding-left: 30px;margin-bottom: 10px;">
                <tr>
                   
                    <td>
                       <!-- <input type="submit" name="edit" value="Edit" id="edit" onclick="return checkValidation();"/>-->
                        <input type="submit" value="save" id="submit_btn" name="edit">
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        <a id="button_Cancel" href="<?php echo site_url('patient');?>">Cancel</a>
                    </td>
                </tr>
            </table>
			</div>
  </div>
</div>

</form>
	</div>
</div>