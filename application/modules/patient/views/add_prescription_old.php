<script language="javascript">
$(document).ready(function(){
	$( ".get_date" ).datepicker();
	// binds form submission and fields to the validation engine
	$("#add_patient").validationEngine();
});
</script>
<?php include_once('patient_list.php');?>
<div id="Profile_right">
  <div id="top_border">
      <div id="left_title">
        <h2>Add Prescription</h2>
      </div>
 </div>
 <h3>Name : <?php echo $patient_name->given_name.' '.$patient_name->sur_name;?></h3>
 
<form name="add_prescription" id="add_prescription" action="<?php echo site_url("patient/add_prescription");?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient_id;?>">
 <div id="Prescription_table">
 	<div id="Medication_table">
    	<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $this->session->userdata("patient_id");?>" />
       <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient_id; ?>">
		<table id="data_table">
		<tr>
			<th><label>Medication</label></th>
			<th><label>Dosage</label></th>
			<th><label>Frequency</label></th>
			
		</tr>
		<tr id="hibrid_1">
			<td><input class="validate[required] text-input" type="text" name="medication" id="medication"  size="14" /></td>
			<td><input class="validate[required] text-input" type="text" name="dosage" id="dosage" size="14" /></td>
			<td><input class="validate[required] text-input" type="text" name="frequency" id="frequency" size="14" /></td>
		</tr>
		<tr>
			<td><a href="#" onclick="addRow()">Add Row</a></td>
		</tr>
				
		
		<input type="hidden" name="row_count" id="row_count" value="1" />
		</table>
		
 	</div>
 </div>
  
<div id="button_save">
	<div id="submit">
    	<input type="submit" name="save" id="submit_btn" value="save" />
    </div>
    <div id="button_Cancel">
        <a href="<?php echo site_url('patient/prescription/'.$patient_id);?>">Cancel</a>
    </div>
</div>
</form> 
</div>  

<script language="javascript">

   $(function() {
	
	 //$( "#add_patient" ).validate();
  });

function addRow()
{
	//alert("here comedfsdfsd");
	var tmp_count=parseInt($("#row_count").val());
	count=tmp_count+1;
	content='<tr id="hibrid_'+count+'" style="display:none;"><td><input  class="validate[required] text-input" type="text" name="med_'+count+'" id="med_'+count+'" size="14"  /></td><td><input  class="validate[required] text-input" type="text" name="dosage_'+count+'" id="dosage_'+count+'" size="14" /></td><td><input  class="validate[required] text-input" type="text" name="frequency_'+count+'" id="frequency_'+count+'" size="14"/></td><td><a href="#" onclick="deleteRow('+count+')" class="deleteRow">remove</a></td></tr>';
	
	$('#hibrid_'+tmp_count).after(content);
	$("#hibrid_"+count).fadeIn(1000).show(1000);
	
	$('#row_count').val(count);
	$( ".get_date" ).datepicker();
}
function deleteRow(i)
{
	
	if(confirm("Are you sure want to remove this dosage from this list ?")){
		//alert($("#dosage_id_"+i).val());
		var temp_count = parseInt($("#row_count").val());
		count = temp_count-1;
		
		$('#row_count').val(count);
	
		 	$("#hibrid_"+i).css("background-color","#ffffff");
			$("#hibrid_"+i).fadeOut(1000, function(){
				$("#hibrid_"+i).remove();
			});
	}
	
	 	//$("#hibrid_"+i).css("background-color","#ffffff");
		//$("#hibrid_"+i).fadeOut(1000, function(){
			//$("#hibrid_"+i).remove();
		//});
	
	
}
 function checkNumber(obj)
  {
  
	if(!$.isNumeric($(obj).val()))
	{
		id=$(obj).attr("id");
		alert("only number allowed");
		$("#"+id).val("");
		$("#"+id).focus();
		return false;
	}
  }
</script>