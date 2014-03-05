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
     <div class="patient_text"><h2>Edit Referral</h2></div>                     
</div> 
<form name="add_referral" id="add_referral" action="<?php //echo site_url("patient/add_referral");?>" method="post">
	<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient_id;?>">
     <input type="hidden" name="ref_id" id="ref_id" value="<?php echo $ref_id;?>">
<div class="one_wrap">
	<div class="widget_note">           
          <div class="widget_body">
           <div id="Contact-Details">
       
       <div id="Contact-title"><h5>Referral Details </h5></div>
       <div id="Profile_Details"><ul><li><div class="gender_id">Referral Source :</div><div class="right_gender">
       <select id="ref_source" name="ref_source">
	   <?php foreach($patients as $pateient_details){?>
                <option value="<?php echo ucfirst($pateient_details->sur_name).' '.ucfirst($pateient_details->given_name);?>"
				<?php if( $referral_details[0]->ref_patients == ucfirst($pateient_details->sur_name).' '.ucfirst($pateient_details->given_name) ){?>selected="selected"<?php } ?> >
				<?php echo ucfirst($pateient_details->sur_name).' '.ucfirst($pateient_details->given_name);?></option>
                <?php }
				 ?>
                </select>
               <span>Last Selected : <?php echo $referral_details[0]->ref_source; ?></span>
       </div></li>
       <li><div class="gender_id">Referral Patients :</div><div class="right_gender">
        <select id="ref_patients" name="ref_patients">
                            <?php 
				 
				foreach($patients as $pateient_details){?>
                <option value="<?php echo ucfirst($pateient_details->sur_name).' '.ucfirst($pateient_details->given_name);?>"
				<?php if( $referral_details[0]->ref_patients == ucfirst($pateient_details->sur_name).' '.ucfirst($pateient_details->given_name) ){?>selected="selected"<?php } ?> >
				<?php echo ucfirst($pateient_details->sur_name).' '.ucfirst($pateient_details->given_name);?></option>
                <?php }
				 ?>
                              </select>
                <span>Last Selected : <?php echo $referral_details[0]->ref_patients; ?></span>
       </div></li>     
             <li><div class="gender_id">Commission :</div><div class="right_gender">
        <input type="text" name="commission" id="commission" value="<?php echo $referral_details[0]->commission; ?>" /><span>%</span>
       </div></li>                      
        </ul></div>
       </div>
       
                                          
          </div>
    </div>
</div>       
<div id="Contact-Details">	        
        <div id="button_save">
            <div id="submit"><input type="submit" id="submit_btn" value="Submit" name="submit"></div>
            <div id="button_Cancel"><a href="<?php echo site_url('patient/referral/'.$patient_id); ?>">Cancel</a></div>
        </div>
	
        </form>
        
        
</div>
</div>
</div>   


