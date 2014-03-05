<html>
   <body>
<style>
.main_containt{
float:left;
width:100%;
padding:20px;
}
.content{
float:left;
width:100%;

}
.content p{
width:48%;
float:left;
}
p.doted_details{
border-bottom: 1px dashed #000;
} 
p span{
text-decoration:underline
}
p label{
font-weight:bold;
font-size:14px;
}
/*Patient iamge marking*/
#container {
    /*background: green;*/ 
   /* width: 1000px; 
    height: 500px;*/ 
    /*position: relative;*/
}
#container img {
    /*position: absolute;*/   
}

#img_demo { /*float:left; clear:both;*/ /*position:inherit; height:300px; width:600px;*/}
</style>
		<?php
        //echo $patient_details->sur_name." ".$patient_details->given_name;?>
        <div class="main_containt">
        	<div class="content">
            	<p><label>Reference No. </label><span><?php echo $patient_details->ref_no;?></span></p>
            </div>  
            <div class="content">  
            	<p><label>Surname:</label><span><?php echo $patient_details->sur_name;?></span></p>
                <p><label>Given Name:</label><span><?php echo $patient_details->given_name;?></span></p>
            </div>
            <div class="content">  
            	<p><label>NRIC/Passport:</label><span><?php echo $patient_details->nric_passport;?></span></p>
            </div>
        	<div class="content">
            	<p><label>Date of Birth</label><span><?php echo $patient_details->date_of_birth;?></span></p>
            </div> 
            <div class="content">
            	<p>
                	<input type="checkbox" <?php if($patient_details->gender=="male"){?> checked="checked" <?php }?>/><label>Male</label>
                    <input type="checkbox" <?php if($patient_details->gender=="female"){?> checked="checked" <?php }?>/><label>Female</label>
               </p>
               	<p><label>Age:</label><span><?php echo $patient_details->age;?></span></p>
            </div> 
             <div class="content">
            	<p><label>Profession:</label><span><?php echo $patient_details->profession;?></span></p>
            </div> 
            <div class="content">
            	<p><label>Mailing Address:</label><span><?php echo $patient_details->email;?></span></p>
            </div> 
            <div class="content">
            	<p><label>Office:</label><span><?php echo $patient_details->office_no;?></span></p>
                <p><label>Home:</label><span><?php echo $patient_details->home_no;?></span></p>
            </div>
            <div class="content">
            	<p><label>Mobile:</label><span><?php echo $patient_details->mobile_no;?></span></p>
            </div> 
            <div class="contentfull">
            	<p><label>PATIENTS DESCRIPTION IS ADVISED:</label></p>
                <div class="details"><?php echo $patient_details->description;?></div>
            </div> 
            <div class="contentfull">
            	<p>I: <span><?php echo $patient_details->sur_name." ".$patient_details->given_name;?></span> with IC/Passport No.:<span><?php echo $patient_details->nric_passport;?></span></p>
                <p>Confirm that this consent has been expalined to me  in terms which I understand.</p>
            </div> 
            <div class="contentfull">
            	<p>Signature: <span>TCMS</span></p>
                <p>Dated on: <span><?php echo $patient_details->date_of_admission;?></span></p>
            </div> 
            
            <div class="contentfull">
            	<p>
                <label>A Are you allergic to any medicine / food?</label>
                <input type="checkbox" <?php if($patient_details->allergic=="1"){?> checked="checked" <?php }?>/><label>No/</label>
                <input type="checkbox" <?php if($patient_details->allergic=="0"){?> checked="checked" <?php }?>/><label>Yes</label>
                <label>Give Details</label>
                </p>
                <p class="doted_details"><?php echo $patient_details->allergic_details;?></div>
            
             <div class="contentfull">
            	<p>
                <label>B Have You had previous surgery?</label>
                <input type="checkbox" <?php if($patient_details->previous_surgery=="1"){?> checked="checked" <?php }?>/><label>No/</label>
                <input type="checkbox" <?php if($patient_details->previous_surgery=="0"){?> checked="checked" <?php }?>/><label>Yes</label>
                <label>Give Details</label>
                </p>
                <p class="doted_details"><?php echo $patient_details->previous_surgery_details;?></div>
            
             <div class="contentfull">
            	<p>
                <label>C Mark "O and X" on the diagram for the affected lesion on the body:</label>
               	</p>
                <p class="doted_details">
                <div id="img_demo" style="position:inherit; height:300px; width:600px;">
          		 <div id="container" style="position: relative;">
                <img style="position: absolute;" src="<?php echo base_url(); ?>assets/default/img/patient_body.jpg" width="600" height="300" />
                <?php 
				  $mark = $patient_details->mark;
				  if($mark!=''){
					  $all_mark = explode(",",$mark);
					  if(!empty($all_mark) && count($all_mark)>0){
						  for($ik=0;$ik<count($all_mark);$ik++){
						  $imgdata = explode("|",$all_mark[$ik]);
						  $xdata = $imgdata[0];
						  $ydata = $imgdata[1];
						  $xyimg = $imgdata[2];
					  ?>
				  <img class="markingdotcross" style="top: <?php echo $ydata;?>px; left: <?php echo $xdata;?>px; position:absolute;" src="<?php echo base_url(); ?>assets/default/img/<?php echo $xyimg;?>.png">
				  <input type="hidden" id="<?php echo "img_".$xdata."px".$ydata."px";?>" data-ydata="<?php echo $ydata;?>" data-xdata="<?php echo $xdata;?>" value="<?php echo $xdata."|".$ydata."|".$xyimg;?>" name="mark[]">
				  <?php }}}?>
                  </div>
           		 </div>
                </p>
            </div>
            
            <div class="contentfull">
            	<p>
                <label>D Chief Complaint</label>
                </p>
                <p class="doted_details"><?php echo $patient_details->chief_complaint;?></div>
            
            <div class="contentfull">
            	<p>
                <label>E History of Present Illness</label>
                </p>
                <p class="doted_details"><?php echo $patient_details->present_illness;?></div>
            
            <div class="contentfull">
            	<p>
                <label>F Past Madication History</label>
                </p>
                <p class="doted_details"><?php echo $patient_details->past_medication;?></div>
            
            <div class="contentfull">
            	<p>
                <label>G Physical Examination</label>
                </p>
                <p class="doted_details"><?php echo $patient_details->physical_exam;?></div>
            
            <div class="contentfull">
            	<p>
                <label>H Impression Disease With</label>
                </p>
                <p class="doted_details"><?php echo $patient_details->disease;?></div>
            
            <div class="contentfull">
            	<p>
                <label>I Habits/Familial Hx</label><br/>
                 <input type="checkbox" <?php if($patient_details->smoking=="1"){?> checked="checked" <?php }?>/><label>Smoking</label><br/>
                 <input type="checkbox" <?php if($patient_details->alcohol=="1"){?> checked="checked" <?php }?>/><label>Alcohol</label><br/>
                 <input type="checkbox" <?php if($patient_details->drug_abuse=="1"){?> checked="checked" <?php }?>/><label>Drug Abuse</label><br/>
                 <input type="checkbox" <?php if($patient_details->familial_hx=="1"){?> checked="checked" <?php }?>/><label>Familial Hx</label><br/>
                 <input type="checkbox" <?php if($patient_details->hair_perm=="1"){?> checked="checked" <?php }?>/><label>Hair Perm</label><br/>
                 <input type="checkbox" <?php if($patient_details->hair_color=="1"){?> checked="checked" <?php }?>/><label>Hair Color</label><br/>
                 <input type="checkbox" <?php if($patient_details->contraceptive=="1"){?> checked="checked" <?php }?>/><label>Contraceptive</label>
                </p>
            </div>
            
            
        </div>
	</body>
</html>