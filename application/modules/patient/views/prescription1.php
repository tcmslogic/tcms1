
<script language="javascript">
$(document).ready(function () {
	
	var total_record = $("#total_record").val();
	var per_page = $("#per_page").val();
	//alert(total_record);
	pagination(total_record,per_page);
});
</script>


<?php include_once('patient_list.php');?>
<div id="Profile_right">
     

<div id="top_border">
      <div id="left_title">
        <h2>Prescription Listing </h2>
      </div> </div>

<div id="patient_title"><h3>NAME: <?php echo $patient_name->given_name.' '.$patient_name->sur_name;?></h3></div>
		
<div id="Patient_table"><div id="table">
        <input type="hidden" name="total_record" id="total_record" value="<?php echo count($patient_prescription);?>"/>
    	<input type="hidden" name="per_page" id="per_page" value="5" />
        	<table id="page_table">
			<thead>
            <tr>
				<th>Date</th>
                <th>Patient Name</th>
				<th>Medication</th>
				<th>Dosage</th>
                <th>frequency </th>
                <th>Operation</th>
			</tr>
            </thead>
			<?php 
			if(!empty($patient_prescription))
			{
			foreach($patient_prescription as $prescription)
			{			
			
			//echo "<pre>";print_r($referral);exit;
			?>
            
            <tr>
			 <td><a href="<?php echo site_url('patient/view_referral/'.$patient_id.'/'.$prescription->pre_id)?>" >
			 <?php echo date('Y-m-d',strtotime($prescription->created_date));?></a></td> 
		
			
             <td><?php echo $prescription->ref_source; ?></td> 
             <td><?php echo $prescription->ref_patients; ?></td> 
             <td><?php echo $prescription->commission; ?></td> 
             <td><a href="<?php echo site_url("patient/generate_print_prescription/".$patient_id."/".$prescription->pre_id);?>">Print</a> || 
             <a href="<?php  echo site_url("patient/edit_prescription/".$patient_id."/".$prescription->ref_id);?>">Edit</a></td>
			 </tr>
			<?php }?>
            <?php }else{ ?>
            <tr><td colspan="6">No Record Found</td></tr>
            <?php } ?>
			<!--<tr>
				<td><a href="<?php //echo site_url('patient/add_note/'.$patient_id); ?>">Add note</a></td>
			</tr>-->
		</table>
         <?php  if(count($patient_prescription)>0){?>
         	<div id="paginationtable" style="margin: auto;"></div>
         <?php  }?>
</div>
</div>
       <!-- <div id="paginationtable" style="margin: auto;"></div>-->
        
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


