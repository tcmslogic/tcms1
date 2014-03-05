<script language="javascript">
 $(document).ready(function(){
			// binds form submission and fields to the validation engine
			$("#add_note").validationEngine();
			
			/*for edit note*/
			
			/*$("#submit_btn").click(function(){
				$("#assessment").attr("disabled", false);
				$("#treatment").attr("disabled", false);
				$("#submit_btn").attr("value", "Submit");
				$("#submit_btn").attr("type", "submit");
				
			});*/
			
	});
function edit_note(){
	$("#assessment").attr("disabled", false);
	$("#treatment").attr("disabled", false);
	$("#submit_btn").attr("value", "Submit");
	$("#submit_btn").attr("type", "submit");
	$("#submit_btn").prop( "onclick", null );
	return false;
}
</script>
<div id="Patient_Profile"><ul><li><a href="<?php echo site_url("patient/patient_profile/".$patient_id);?>">Patient Profile</a></li>
   <li><a href="<?php echo site_url("patient/patient_attendance/".$patient_id);?>">Patient Attendance </a></li>
   <?php if(empty($patient_finance)){ ?>
   <li><a href="<?php echo site_url("patient/edit_patient_financial_profile/".$patient_id);?>">Patient Financial Profile</a></li>
   <?php }else{ ?>
   <li><a href="<?php echo site_url("patient/patient_financial_profile/".$patient_id);?>">Patient Financial Profile</a></li>
   <?php } ?>
   
<li><a href="<?php echo site_url("patient/admission_data/".$patient_id);?>">Admission Data</a></li>
   <li class="active"><a href="<?php echo site_url("patient/notes/".$patient_id);?>">Notes</a></li>
   </ul></div>
 
 <div id="Profile_right">
     

<div id="top_border">
  <div id="left_title">
    <h2>View/Edit Note </h2>
  </div> </div>  
   
<div id="Contact-Details">
	<?php //print_r($patient_note);?>
		<form name="add_note" id="add_note" action="<?php echo site_url("patient/view_note");?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient_note[0]->patient_id; ?>">
        <input type="hidden" name="note_id" id="note_id" value="<?php echo $patient_note[0]->id; ?>"  />
        
		<table>
			<tr>
				<td><label>Assessment</label><textarea disabled="disabled" class="text-input" name="assessment" id="assessment" cols="107" rows="10"><?php echo $patient_note[0]->assessment; ?></textarea></td>
			</tr>
			<tr>
				<td><label>Treatment</label><textarea disabled="disabled" class="text-input" name="treatment" id="treatment" cols="107" rows="10"/><?php echo $patient_note[0]->treatment; ?></textarea>
				</td>
			</tr>
			
			
			<!--<tr>
				<td><input type="submit" name="submit" id="submit" value="submit" /></td>
			</tr>-->
		</table>
        
        <div id="button_save">
            <div id="submit"><input type="button" id="submit_btn" value="Edit" name="edit" onclick="return edit_note();"></div>
            <div id="button_Cancel"><a href="<?php echo site_url('patient/notes/'.$patient_id); ?>">Cancel</a></div>
        </div>
		
        </form>
        
        
</div>

</div>   


