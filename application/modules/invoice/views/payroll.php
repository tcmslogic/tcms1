
<script language="javascript">
$(document).ready(function () {
	
	var total_record = $("#total_record").val();
	var per_page = $("#per_page").val();
	//alert(total_record);
	pagination(total_record,per_page);
});
</script>


<?php include_once('sidebar.php');?>
<div id="Profile_right">
     

<div id="breadcrumbs">
       <div class="patient_text"><h2>Referral Listing</h2></div>
</div>       

<div id="patient_title"><h3>NAME: <?php echo $patient_name->given_name.' '.$patient_name->sur_name;?></h3></div>
		
<div class="one_wrap"><div class="widget">
           
          <div class="widget_body"  id="holder">
        <input type="hidden" name="total_record" id="total_record" value="<?php echo count($patient_referral);?>"/>
    	<input type="hidden" name="per_page" id="per_page" value="5" />
        	<table class="activity_datatable" width="100%"   border="0" cellspacing="0" cellpadding="8">
			<tbody>
            <tr>
				<th>Date</th>
				<th>Referral source</th>
				<th>Referral patients</th>
                <th>commission</th>
                <th>Operation</th>
			</tr>

			<?php 
			if(!empty($patient_referral))
			{
			foreach($patient_referral as $referral)
			{			
			
			//echo "<pre>";print_r($referral);exit;
			?>
            
            <tr>
			 <td><a href="<?php echo site_url('patient/view_referral/'.$patient_id.'/'.$referral->ref_id)?>" >
			 <?php echo date('d M Y',strtotime($referral->created_date));?></a></td> 
		
			
             <td><?php echo $referral->ref_source; ?></td> 
             <td><?php echo $referral->ref_patients; ?></td> 
             <td><?php echo $referral->commission; ?></td> 
             <td><a href="<?php echo site_url("patient/generate_print_referral1/".$patient_id."/".base64_encode($referral->ref_id));?>">Print</a> || 
             <a href="<?php  echo site_url("patient/edit_referral/".$patient_id."/".base64_encode($referral->ref_id));?>">Edit</a></td>
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
         <?php  if(count($patient_referral)>0){?>
         	<div id="paginationtable" style="margin: auto;"></div>
         <?php  }?>
</div>
</div>
       <!-- <div id="paginationtable" style="margin: auto;"></div>-->
        

        	<div id="save" style="margin-right:10px;">
                <a href="<?php echo site_url('patient/add_referral/'.$patient_id); ?>">Add Referral</a>
       		</div>


        	<div id="save" style="margin-right:10px;">
                <a href="<?php echo site_url('patient/generate_print_referral/'.$patient_id); ?>">Print</a>
       		</div>


        	<div id="save" style="margin-right:10px;">
                <a href="<?php echo site_url('patient/generate_pdf_referral/'.$patient_id); ?>">PDF</a>
       		</div>

        
</div>


