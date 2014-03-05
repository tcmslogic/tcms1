
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
       <div class="patient_text"><h2>Certification Listing</h2></div>
</div>         

<div id="patient_title"><h3>NAME: <?php echo $patient_name->given_name.' '.$patient_name->sur_name;


?></h3></div>
		
<div class="one_wrap"><div class="widget">
           
          <div class="widget_body"  id="holder">
        <input type="hidden" name="total_record" id="total_record" value="<?php echo count($patient_certificate);?>"/>
    	<input type="hidden" name="per_page" id="per_page" value="5" />
        	<table class="activity_datatable" width="100%"   border="0" cellspacing="0" cellpadding="8">
			<tbody>
            <tr>
				<th width="13%">Date</th>
				<th width="20%">Doctor name</th>
				<th width="15%">Patient name</th>
                <th width="20%">Reason for medical leave</th>
                <th width="20%">No. of medical leave days</th>
                <th width="15%">Operation</th>
			</tr>

			<?php 
		
			if(!empty($patient_certificate))
			{
			foreach($patient_certificate as $certificate)
			{
				//echo "<pre>";print_r($certificate);
				 	
			
			//echo "<pre>";print_r($referral);exit;
			?>
            
            <tr>
			 <td><?php echo date('d M Y',strtotime($certificate->created_date));?></td> 
		     <td><?php echo ucfirst($certificate->doc_name); ?></td> 
             <td><?php echo $certificate->patient_name; ?></td> 
             <td><?php echo $certificate->res_leave; ?></td> 
             <td><?php echo $certificate->leave_days; ?></td> 
             <td><a href="<?php echo site_url("patient/generate_print_certificate1/".$patient_id."/".base64_encode($certificate->cer_id));?>">Print</a> || 
             <a href="<?php  echo site_url("patient/edit_certificate/".$patient_id."/".base64_encode($certificate->cer_id));?>">Edit</a></td>
			 </tr>
			<?php }?>
            <?php }else{ ?>
            <tr><td colspan="6">No Record Found</td></tr>
            <?php } ?>
			<!--<tr>
				<td><a href="<?php //echo site_url('patient/add_note/'.$patient_id); ?>">Add note</a></td>
			</tr>-->
            </tbody>
		</table>
         <?php  if(count($patient_certificate)>0){?>
         	<div id="paginationtable" style="margin: auto;"></div>
         <?php  }?>
</div>
</div>
       <!-- <div id="paginationtable" style="margin: auto;"></div>-->
        
        <div id="button_save" style="margin-right:10px;">
        	<div id="save">
        		<a href="<?php echo site_url('patient/add_certificate/'.$patient_id); ?>">Add Certificate</a>
       		</div>
       </div>
       <div id="button_save" style="margin-right:10px;">
        	<div id="save">
        		<a href="<?php echo site_url('patient/generate_print_certificate').'/'.$patient_id; ?>">Print</a>
       		</div>
       </div>
       <div id="button_save">
        	<div id="save">
        		<a href="<?php echo site_url('patient/generate_pdf_certificate').'/'.$patient_id; ?>">PDF</a>
       		</div>
       </div>
        
</div> </div>


</div>