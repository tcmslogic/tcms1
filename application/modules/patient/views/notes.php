
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
          <div class="patient_text"><h2>Patient Notes Listing</h2></div>
</div>      

<div id="patient_title"><h3>NAME: <?php echo $patient_name->given_name.' '.$patient_name->sur_name;?></h3></div>

<div class="one_wrap"><div class="widget">
           
          <div class="widget_body"  id="holder">		
        <input type="hidden" name="total_record" id="total_record" value="<?php echo count($patient_notes);?>" />
    	<input type="hidden" name="per_page" id="per_page" value="5" />
        	<table class="activity_datatable" width="100%"   border="0" cellspacing="0" cellpadding="8">
			<tbody>
            <tr>
				<th width="15%">Date</th>
				<th width="20%">Treatement Description </th>
				<th width="20%">Remarks Text Area</th>
                <th width="12%">Operation</th>
			</tr>

			<?php 
			if(!empty($patient_notes))
			{
			foreach($patient_notes as $notes)
			{			
			?>
            
            <tr>
			<td><?php echo date('d M Y',strtotime($notes->created_date));?></td>
		
			
            <td><?php echo date('d M Y',strtotime($notes->modified_date));?></td>
			<!--td><a href="<?php echo site_url('patient/view_note/'.$patient_id.'/'.$notes->id)?>" >
								<?php echo (date('d M Y',strtotime($notes->reviewed_by_date))!='1970-01-01')?date('d M Y',strtotime($notes->reviewed_by_date)) :'';?></a></td-->
                             <td><?php echo character_limiter($notes->Remarks,10);?> </td>
			<td><a href="<?php echo site_url("patient/generate_print_note1/".$patient_id."/".base64_encode($notes->id));?>">Print</a> || 
             <a href="<?php  echo site_url("patient/edit_note/".$patient_id."/".base64_encode($notes->id));?>">Edit</a></td>
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
         <?php if(count($patient_notes)>0){?>
         	<div id="paginationtable" style="margin: auto;"></div>
         <?php }?>

       <!-- <div id="paginationtable" style="margin: auto;"></div>-->
</div>
</div>
        
        <div id="button_save" style="margin-right:10px;">
        	<div id="save">
        		<a href="<?php echo site_url('patient/add_note/'.$patient_id); ?>">Add Note</a>
       		</div>
       </div>
       <div id="button_save" style="margin-right:10px;">
        	<div id="save">
        		<a href="<?php echo site_url('patient/generate_print_note').'/'.$patient_id; ?>">Print</a>
       		</div>
       </div>
       <div id="button_save">
        	<div id="save">
        		<a href="<?php echo site_url('patient/generate_pdf_note').'/'.$patient_id; ?>">PDF</a>
       		</div>
       </div>
        
</div> </div> </div>


