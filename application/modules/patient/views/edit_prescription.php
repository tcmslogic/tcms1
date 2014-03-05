<script language="javascript">
$(document).ready(function(){
	// binds form submission and fields to the validation engine
	$("#add_prescription").validationEngine();
});
</script>
<?php include_once('patient_list.php');?>
<div class="right-panel">
<div id="Profile_right">
 <div id="breadcrumbs">
     <div class="patient_text"><h2>Add Prescription</h2></div>                     
</div>
<div class="title"> NAME: <?php echo strtoupper($patient_name->given_name).' '.strtoupper($patient_name->sur_name);?></div>

 
<form name="add_prescription" id="add_prescription" action="<?php echo site_url("patient/edit_prescription");?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient_id;?>">
    <input type="hidden" name="pre_id" id="pre_id" value="<?php echo $pre_id;?>">

<div class="one_wrap">
	<div class="widget_note">           
          <div class="widget_body">
           <div id="Contact-Details">
       
       <div id="Contact-title"><h5>Prescription Detail:</h5></div>
       <div id="Profile_Details"><ul><li><div class="gender_id">Medication:</div><div class="right_gender">
      <input type="text" name="medication" id="medication" class="validate[required] text-input" value="<?php echo $prescription_details[0]->medication;?>" />
       </div></li>
       
       <li><div class="gender_id">Dosage:</div><div class="right_gender">
         <input type="text" name="dosage" id="dosage" class="validate[required] text-input" value="<?php echo $prescription_details[0]->dosage;?>" />
       </div></li>     
       
             <li><div class="gender_id">Frequency:</div><div class="right_gender">
        <input type="text" name="frequency" id="frequency" class="validate[required] text-input" value="<?php echo $prescription_details[0]->frequency;?>" />
       </div></li>                                                       
          </div>
    </div>
</div>    
    
<div id="button_save">
	<div id="submit">
    	<input type="submit" id="submit_btn" value="Submit" name="submit">
    </div>
    <div id="button_Cancel">
        <a href="<?php echo site_url('patient/prescription/'.$patient_id);?>">Cancel</a>
    </div>
</div>
</form> 
</div>  
</div>
