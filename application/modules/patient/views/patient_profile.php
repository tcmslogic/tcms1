<?php
	$access_level=array("Reception","Manager1","Admin");
	$access_level1= array("Nurses","Admin","Doctor");
	$denied_level=array("Nurses","Manager1","Doctor");
?>

 <?php include_once('patient_list.php');?>
<div class="right-panel">

    <div id="breadcrumbs">
          <div class="patient_text">
          	<h2>Profile</h2>
          </div>         
    </div>
    
    <div id="sub_main">
          <div class="title"> NAME: <?php echo strtoupper($patient_profile->given_name).' '.strtoupper($patient_profile->sur_name);?></div>
           
          <div class="pic"><div id="pic_fram"> <img src="<?php echo base_url("assets/default/images/pic.png");?>"/> </div>
          <div id="sub_button">               
        <?php if(!in_array($this->session->userdata("user_type"),$denied_level)){?>
          <a class="edit" href="<?php echo site_url("patient/edit_patient/".$patient_id);?>">edit</a>
          <?php }?>
          <a class="pdf" href="<?php echo site_url("patient/generate_patient_pdf/".$patient_id);?>"> pdf</a> 
          <a class="print" href="<?php echo site_url("patient/generate_patient_print/".$patient_id);?>"> print</a> </div>
          
          </div>
          </div>
       
       <div class="one_wrap"><div class="widget">
           
          <div class="widget_body">   
                    
       <div id="Contact-Details">
       
       <div id="Contact-title"><h5>Contact Details </h5></div>
       <div id="Profile_Details"><ul><li><div class="gender_id">Gender :</div><div class="right_gender"><?php echo $patient_profile->gender;?> </div></li>
       
       <li><div class="gender_id">Date of birth :</div> <div class="right_gender"><?php echo date('d-M-Y', strtotime($patient_profile->date_of_birth));?> </div></li>
        <li><div class="gender_id">Office number:</div><div class="right_gender"><?php echo ($patient_profile->office_no == 0)?'':$patient_profile->office_no;?> </div></li>
         <li><div class="gender_id">Home number:</div><div class="right_gender"><?php echo ($patient_profile->home_no == 0)?'':$patient_profile->home_no;?> </div></li>
       <li><div class="gender_id">Mobile number:</div><div class="right_gender"><?php echo ($patient_profile->mobile_no == 0)?'':$patient_profile->mobile_no;?> </div></li>
        </ul></div>
       </div>
       
       <div id="General_information"> <div id="Contact-title"><h5>General information </h5></div>
       <div id="Profile_Details"><ul><li><div class="gender_id">NRIC/Passport :</div><div class="right_gender" style="text-transform:none !important;"><?php echo $patient_profile->nric_passport;?> </div></li>
       <li><div class="gender_id">Date of Admission:</div><div class="right_gender"><?php  echo date('d-M-Y', strtotime($patient_profile->date_of_admission));?></div></li>
       <li><div class="gender_id">Age:</div><div class="right_gender"><?php echo $patient_profile->age;?> </div></li>
        <li><div class="gender_id">Profession:</div><div class="right_gender"><?php echo $patient_profile->profession;?> </div></li>
       <li><div class="gender_id">Email </div><div class="right_gender"><?php echo $patient_profile->email;?></div></li>
        <li><div class="gender_id">Address </div><div class="right_gender"><?php echo $patient_profile->address;?></div></li>
        </ul></div></div>
        
        <div id="Funding-Source"><div id="Contact-title"><h5>Patient Details</h5></div>
        <div id="Profile_Details">
        <ul>
        <li><div class="gender_id">PATIENTS DISCRETION IS ADVISED:</div><div class="right_gender"><?php echo $this->mdl_patient->getDescription(); ?> </div></li>
       	
        <li><div class="gender_id">A. Are you allergic to any medicine / food?</div> <div class="right_gender">
		<?php if($patient_profile->allergic=="0"){ echo "No";}else{ echo "Yes";}?>
        </div></li>
        <li><div class="gender_id">Allergic Details:</div> <div class="right_gender"><?php echo $patient_profile->allergic_details;?></div></li>
        
        <li><div class="gender_id">B. Have You had previous surgery?</div> <div class="right_gender">
		<?php if($patient_profile->previous_surgery=="0"){ echo "No";}else{ echo "Yes";}?>
        </div></li>
        <li><div class="gender_id">Previous Surgery Details:</div> <div class="right_gender"><?php echo $patient_profile->previous_surgery_details;?></div></li>
        
         <li><div class="gender_id">C. The diagram for the affected lesion on the body:</div> 
         	<div class="right_gender">
        		<img src="<?php echo $patient_profile->marking_img;?>" width="500" height="250" />
           </div></li>  
           
         <li><div class="gender_id">D. Chief Complaint</div> <div class="right_gender">
		<?php echo $patient_profile->chief_complaint;?>
        </div></li>
        
         <li><div class="gender_id">E. History of Present Illness</div> <div class="right_gender">
		<?php echo $patient_profile->present_illness;?>
        </div></li> 
         
          <li><div class="gender_id">F. Past Medication History</div> <div class="right_gender">
		<?php echo $patient_profile->past_medication;?>
        </div></li> 
          
          <li><div class="gender_id">G. Physical Examination</div> <div class="right_gender">
		<?php echo $patient_profile->physical_exam;?>
        </div></li> 
         
          <li><div class="gender_id">H. Impression Disease With</div> <div class="right_gender">
		<?php echo $patient_profile->disease;?>
        </div></li>  
         
         <li><div class="gender_id">I. Habits/Familial Hx</div> <div class="right_gender">
			<b>Smoking:</b> <?php if($patient_profile->smoking=="0"){ echo "No";}else{ echo "Yes";}?><br/>
            <b>Alcohol:</b> <?php if($patient_profile->alcohol=="0"){ echo "No";}else{ echo "Yes";}?><br/>
            <b>Drug Abuse:</b> <?php if($patient_profile->drug_abuse=="0"){ echo "No";}else{ echo "Yes";}?><br/>
            <b>Familial Hx:</b> <?php if($patient_profile->familial_hx=="0"){ echo "No";}else{ echo "Yes";}?><br/>
            <b>Hair Perm:</b> <?php if($patient_profile->hair_perm=="0"){ echo "No";}else{ echo "Yes";}?><br/>
            <b>Hair Color:</b> <?php if($patient_profile->hair_color=="0"){ echo "No";}else{ echo "Yes";}?><br/>
            <b>Contraceptive:</b> <?php if($patient_profile->contraceptive=="0"){ echo "No";}else{ echo "Yes";}?><br/>
        </div></li> 
            
        
        </ul></div></div>
	  </div>
        </div></div>
<!------------------------------------------------------>	
