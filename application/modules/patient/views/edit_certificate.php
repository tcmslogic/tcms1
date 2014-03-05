<style type="text/css">
#Contact-Details .file
{
	width:170px;
	font-size:12px !important;
}
</style>
<script language="javascript">
 $(document).ready(function(){
			// binds form submission and fields to the validation engine
			$("#add_referral").validationEngine();
	});

</script>
<?php include_once('patient_list.php');?>
 <div class="right-panel">
 <div id="Profile_right">
     

<div id="breadcrumbs">
     <div class="patient_text"><h2>Edit Certificate</h2></div>                     
</div>   
   
<div id="Contact-Details">
	
		<form name="edit_certificate" id="edit_certificate" action="<?php echo site_url("patient/edit_certificate");?>" method="post">
	<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient_id;?>">
     <input type="hidden" name="cer_id" id="cer_id" value="<?php echo $cer_id;?>">
   
<div class="one_wrap">
	<div class="widget_note">           
          <div class="widget_body">
           <div id="Contact-Details">
       
       <div id="Contact-title"><h5>Referral Details </h5></div>
       <div id="Profile_Details"><ul><li><div class="gender_id">Doctor Mame :</div><div class="right_gender">
       <select id="doc_name" name="doc_name">
                 <?php foreach($doctors as $doctors_details){?>
               	 <option value="<?php echo $doctors_details->user_fullname;?>" 
				 <?php if(($doctors_details->user_fullname)==($certificate_details[0]->doc_name)){?> selected="selected" <?php }?>>
				 <?php echo $doctors_details->user_fullname;?></option>
                <?php }?>
                </select>
       </div></li>
       
       <li><div class="gender_id">Patient Name :</div><div class="right_gender">
         <select id="patient_name" name="patient_name">
                 <?php 
				 
				foreach($patients as $pateient_details){?>
                <option value="<?php echo ucfirst($pateient_details->sur_name).' '.ucfirst($pateient_details->given_name);?>"
                 <?php if((ucfirst($pateient_details->sur_name).' '.ucfirst($pateient_details->given_name))==($certificate_details[0]->patient_name)){?> selected="selected" <?php }?>>
				<?php echo ucfirst($pateient_details->sur_name).' '.ucfirst($pateient_details->given_name);?></option>
                <?php }
				 ?>
                </select>
       </div></li>     
       
             <li><div class="gender_id">Reason for medical leave :</div><div class="right_gender">
        <textarea name="res_leave" id="res_leave"><?php echo $certificate_details[0]->res_leave;?></textarea>
       </div></li> 
       
       <li><div class="gender_id">No. of medical leave days :</div><div class="right_gender">
        <input type="text" name="leave_days" id="leave_days" value="<?php echo $certificate_details[0]->leave_days;?>" />
       </div></li>    
                        
        </ul></div>
       </div>
       
                                          
          </div>
    </div>
</div>            
        
        <div id="button_save">
            <div id="submit" ><input type="submit" name="submit" id="submit_btn" value="Submit" /></div>
            <div id="button_Cancel"><a href="<?php echo site_url('patient/certificate/'.$patient_id); ?>">Cancel</a></div>
        </div>
	
        </form>
        
        
</div>
</div>
</div>   


