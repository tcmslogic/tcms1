<script language="javascript">
$(document).ready(function () {
	var total_record = $("#total_record").val();
	var per_page = $("#per_page").val();
	//alert(total_record);
	pagination(total_record,per_page);
});
</script>

<?php include_once('patient_list.php');?>
<div class="right-panel">
<div id="Profile_right">

 
<div id="breadcrumbs">
       <div class="patient_text"><h2>Prescription Listing</h2></div>
</div>

<h3 id="pname"><?php echo $patient_name->given_name.' '.$patient_name->sur_name;?></h3>


<div class="one_wrap"><div class="widget">
           
          <div class="widget_body"  id="holder">
    	<table class="activity_datatable" width="100%"   border="0" cellspacing="0" cellpadding="8">
			<tbody><tr>
				<th>Creation date</th>                
				<th>Medication</th>
				<th>Dosage</th>
				<th>Frequency</th>
                <th>Operations</th>
			</tr>
			 
			<?php 
				//echo "<pre>";print_r($patient_prescription);
			if(!empty($patient_prescription)){
			foreach($patient_prescription as $prescription){
			?>
             <tr>
             	<td><?php echo date('d M Y',strtotime($prescription->created_date));?></td>
                <td><?php echo $prescription->medication?></td>
                <td><?php echo $prescription->dosage?></td>
                <td><?php echo $prescription->frequency?></td>
                <td><a href="<?php echo site_url("patient/generate_print_prescription1/".$patient_id."/".base64_encode($prescription->pre_id));?>">Print</a> || 
             <a href="<?php  echo site_url("patient/edit_prescription/".$patient_id."/".base64_encode($prescription->pre_id));?>">Edit</a></td>
            </tr>
           <?php }}else{?>
		   <tr><td colspan="5">No Record Found</td></tr>
		   <?php }?>
             </tbody>
		</table>
    </div>
 <?php if(!empty($prescription_details)){?>   
    <div id="button_save">
    	<!--<div id="save">
        	<a href="<?php echo site_url('patient/edit_prescription/'.base64_encode($patient_id)); ?>">Edit</a>
        </div>-->
    	<div id="button_Cancel">
        	<a href="#" onclick="submitDelete()">Delete</a>
       	</div>
    </div>
  <?php }?>  
</div>  


 <div id="button_save" style="margin-right:10px;">
        	<div id="save">
        		<a href="<?php echo site_url('patient/add_prescription/'.$patient_id); ?>">Add Prescription</a>
       		</div>
       </div>
       <div id="button_save" style="margin-right:10px;">
        	<div id="save">
        		<a href="<?php echo site_url('patient/generate_print_prescription').'/'.$patient_id; ?>">Print</a>
       		</div>
       </div>
       <div id="button_save">
        	<div id="save">
        		<a href="<?php echo site_url('patient/generate_pdf_prescription').'/'.$patient_id; ?>">PDF</a>
       		</div>
       </div>

</div>
</div>
</div>


