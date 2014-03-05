<?php
	$access_level=array("Reception","Manager1","Admin");
	$access_level1= array("Nurses","Admin","Doctor");
	$denied_level=array("Nurses","Manager1","Doctor");
?>
<script>
  $(function() {
    $( "#sponsor_approval_letter_date" ).datepicker();
	//$( "#sponsor_approval_letter_date" ).datepicker( "option", "dateFormat", "yy/mm/dd" );
  });
   $(document).ready(function(){
			// binds form submission and fields to the validation engine
			$("#financial_profile").validationEngine();
	});

  </script>
  <div id="Patient_Profile"><ul><li><a href="<?php echo site_url("patient/patient_profile/".$patient_id);?>">Patient Profile</a></li>
  <!-- <li><a href="<?php echo site_url("patient/patient_attendance/".$patient_id);?>">Patient Attendance </a></li>-->
   <?php 
   //$access_level=array("Reception","Manager1"); 
   if(in_array($this->session->userdata("user_type"),$access_level))
   {?>
   <li><a href="<?php echo site_url("patient/patient_attendance/".$patient_id);?>">Patient Attendance </a></li>
  
   <?php }
 
   if($this->session->userdata("user_type")!="Reception")
   {
	if(empty($patient_details)){ ?>
   <li  class="active"><a href="<?php echo site_url("patient/edit_patient_financial_profile/".$patient_id);?>">Patient Financial Profile</a></li>
   <?php }else{ ?>
   <li  class="active"><a href="<?php echo site_url("patient/patient_financial_profile/".$patient_id);?>">Patient Financial Profile</a></li>
   <?php } 
   }?>
    <?php
   	$level=array("Reception","Manager1");
    if(!in_array($this->session->userdata("user_type"),$level))
   {?>
<li><a href="<?php echo site_url("patient/admission_data/".$patient_id);?>">Admission Data</a></li>

   <li><a href="<?php echo site_url("patient/notes/".$patient_id);?>">Notes</a></li>
   
 <?php }?>
   </ul></div>
   
   
   <!--------------->
   <div id="Profile_right"><div id="top_border" style="width:75%;">
      <div id="left_title">
        <h2>Financial Profile </h2>
      </div> </div>
       <div id="Profile_name"><h3>NAME:  <?php echo $patient_name;?></h3></div>
       <div id="Contact-Details">
        <div id="profile_edit">
       <div id="left_print">
	   <?php
	   
	   	$access_level=array("Admin","Manager1");
		if(in_array($this->session->userdata("user_type"),$access_level)){ 
	   ?>
	   <div id="edit"><a href="<?php echo site_url("patient/edit_patient_financial_profile/".$patient_id);?>"><img src="<?php echo base_url("assets/default/images/edit.png");?>" /></a></div>
       <div id="print_button"><a href="<?php echo site_url("patient/generate_pdf_finance/".$patient_id);?>"><img src="<?php echo base_url("assets/default/images/pdf.png");?>" style="width:28px;" /></a></div>
       <div id="print_button"><a href="<?php echo site_url("patient/generate_print_finance/".$patient_id);?>"><img src="<?php echo base_url("assets/default/images/print_button.png");?>" /></a></div>
       
      <?php }?>
       
       
       </div></div>
       <div id="Contact-title"><h5>Sponsorship Details:</h5></div>
       <div id="Profile_Details"><ul>
       <li><div class="Sponsorship_id">Name of Sponsor:</div>
       <div class="right_Sponsorship"><span><?php echo $patient_details->sponsor_name;?></span></div></li>
       <li><div class="Sponsorship_id">Date of Approved letter:</div> 
       <div class="right_Sponsorship"><span><?php echo (date("Y-m-d",strtotime($patient_details->sponsor_approval_letter_date))=='1970-01-01')?'':date("Y-m-d",strtotime($patient_details->sponsor_approval_letter_date));?></span></div></li>
       <li><div class="Sponsorship_id">Sponsor Limit:</div>
       <div class="right_Sponsorship"><span><?php echo $patient_details->sopnsor_limit;?></span> </div></li>
       <li><div class="Sponsorship_id">Sponsor Limit per dialysis treatment:</div>
       <div class="right_Sponsorship"><span><?php echo $patient_details->sponsor_limit_per_dialysis;?></span> </div></li>
       <li><div class="Sponsorship_id">Payment Method:</div>
       <div class="right_Sponsorship">
       <span><?php echo ($patient_details->sponsor_payment_method=='0')?'':$patient_details->sponsor_payment_method;?></span>
      </div></li>
       <li><div class="Sponsorship_id">upload letter:</div>
       <div class="right_Sponsorship">
        <?php if(!empty($patient_details->letter_upload)){ ?>
				<a href="<?php echo base_url("uploads/approval_letters/".$patient_details->letter_upload);?>" target="_blank">view</a>
      	<?php } ?>
                
       <!--<input type="file" style="width: 227px; float: right;" 
       id="MainContent_ImgPPAtient" name="ctl00$MainContent$ImgPPAtient">--> </div></li>
       
        </ul></div>
       </div>
       
       <div id="General_information"> <div id="Contact-title"><h5>Self-Payment Details:</h5></div>
       <div id="Profile_Details"><ul>
       <li><div class="Sponsorship_id">Name of payee:</div>
       <div class="right_Sponsorship"><span><?php echo $patient_details->self_name_of_payee;?></span></div></li>
       <li><div class="Sponsorship_id">Payment method:</div> 
       <div class="right_Sponsorship"> <span><?php echo $patient_details->self_payment_method;?></span></div></li>
        
        </ul></div></div>
        
         <?php $injection_data = $this->mdl_patient->get_all_injection();?>
        
        <div id="Funding-Source"><div id="Contact-title"><h5>Master Charges: </h5></div>
        <div id="Profile_Details"><ul>
        <li><div class="Sponsorship_id">Hemodialysis:</div><div class="right_Sponsorship"><span><?php echo $patient_details->hemodialysis; ?></span> </div></li>
        <?php foreach($injection_data as $injection){?> 
        <?php $inj_data = $this->mdl_patient->get_injection_data($patient_details->patient_fid,$patient_id,$injection->id);?>
        <li><div class="Sponsorship_id"><?php echo $injection->name;?> :</div>
        <div class="right_Sponsorship"><span><?php if(!empty($inj_data)){echo $inj_data[0]->inj_data;}?></span> </div></li>
        <?php }?>
       <!--<li><div class="Sponsorship_id">Injection (Micera) :	</div>
       <div class="right_Sponsorship"><span><?php //echo $patient_details->injection_micera;?></span> </div></li>
       <li><div class="Sponsorship_id">Injection (Recormon):</div>
      
       <div class="right_Sponsorship"><span><?php //echo $patient_details->injection_recormon;?></span> </div></li>
       <li><div class="Sponsorship_id">Injection (Eprex):</div>
       <div class="right_Sponsorship"><span><?php //echo $patient_details->injection_eprex;?></span> </div></li>-->
        
        
        </ul></div>
        
        
        </div>
</div>
