<html>
<body>
<style>
.main_containt{ float:left; width:95%; padding:20px; border: 1px solid #000; }
.content{ float:left; width:100%; margin-bottom:10px; }
.content p{ /*width:48%;*/ float:left;margin: 0; }
p.doted_details{ border-bottom: 1px dashed #000; } 
p span{ text-decoration:underline; width:100%; }
p label{ font-weight:bold; font-size:14px; }
/*<?php //echo base_url(); ?>assets/default/img/markx.png*/
p.icon_img span {float: left;position:absolute;}
.icon_mobile {    background:url(<?php echo base_url(); ?>assets/default/img/icons/mobile.png);
background-repeat-x: no-repeat;
background-repeat-y: no-repeat;
}
#icon_img_email {
    float: left;
    height: 16px;
    width: 16px;
 
	/*content: url(<?php echo base_url(); ?>assets/default/img/icons/message.png);*/
	background-repeat-x: no-repeat;
	background-repeat-y: no-repeat;}
	#icon_img {
    float: left;
    height: 16px;
    width: 16px;
	content: url(<?php echo base_url(); ?>assets/default/img/icons/mobile.png);
	background-repeat-x: no-repeat;
	background-repeat-y: no-repeat;}
	#icon_img_office {
    float: left;
    height: 16px;
    width: 16px;
	content: url(<?php echo base_url(); ?>assets/default/img/icons/telephone.png);
	background-repeat-x: no-repeat; 
	background-repeat-y: no-repeat;}	
/*
	


	
	
#text { float: left;}*/
	
.content label.border { border-bottom:solid 1px #000;}
.details {
width: 95%;
}
</style>
		<?php
        //echo $patient_details->sur_name." ".$patient_details->given_name;?>
        <?php print_r($Header); ?>
        <div id="header" style="width:100%;float:left;margin-bottom:5px;">
    	<h3 style="text-align:left;width:50%;float:left;margin-bottom:1%;"><?php echo $patient_details->sur_name." ".$patient_details->given_name;?></h3>
        <h3 style="text-align:right;width:50%;float:right;">Patient Profile</h3>
  </div>
  
  <div id="le_detail" style="width:50%;float:left;line-height:25px;">
    <label style="text-align:left;width:100%;float:left;">Address: <?php echo $patient_details->address;?></label><br/>  
    <label style="text-align:left;width:100%;float:left;">Email: <?php echo $patient_details->email;?></label><br/>  
    <label style="text-align:left;width:100%;float:left;">Mobile No: <?php echo $patient_details->mobile_no;?></label>
  </div> 
  
        <div class="main_containt">
        	<div class="content">
            	<label>Reference No.</label><span class="border" style="border-bottom:solid 1px #000;line-height:25px;"><?php echo $patient_details->ref_no;?></span>
            </div>  
            <div class="content" style="width:50%;">  
            	<label style="float:left;">Surname:</label>
                 <span class="border" style="margin-right:5px; border-bottom:solid 1px #000!important;"><?php echo $patient_details->sur_name;?></span>
                 </div>
                  <div class="content" style="width:50%;">  
                <label style="float:left;">Given Name:</label>
                 <span class="border" style="border-bottom:solid 1px #000!important;"><?php echo $patient_details->given_name;?></span>
              
            </div>
            <div class="content">  
            	 <label style="float: left;">NRIC/Passport:</label>
                 <span class="border" style="float:left;border-bottom:solid 1px #000!important;"><?php echo $patient_details->nric_passport;?></span>
            </div>
        	<div class="content">
            	<label style="float: left;">Date of Birth</label>
                 <span class="border"  style="float:left;border-bottom:solid 1px #000!important;"><?php echo $patient_details->date_of_birth;?></span>
                
            </div> 
              <div class="content" style="width:50%;">
            	
                	<input type="checkbox" <?php if($patient_details->gender=="male"){?> checked="checked" <?php }?>/><label>Male</label>
                    <input type="checkbox" <?php if($patient_details->gender=="female"){?> checked="checked" <?php }?>/><label>Female</label>
               </div>  <div class="content" style="width:50%;">
               	<label style="float: left;">Age:</label>
                <span class="border" style="float:left;border-bottom:solid 1px #000!important;"><?php echo $patient_details->age;?></span>
            </div> 
             <div class="content">
            	<label style="float: left;">Profession:</label>
                 <span class="border" style="float:left;border-bottom:solid 1px #000!important;"><?php echo $patient_details->profession;?></span>
            </div> 
            <div class="content" style="margin-left:0%;">
                 <!--span style="float: left;margin-right:  1%;margin-top: 2px;margin-left:-1%;"><img  src="<?php //echo base_url(); ?>assets/default/img/icons/message.png"/></span-->
           		     <label class="text_icon" style="float: left;">Mailing Address:</label>
                     <span  class="border" style="float:left;border-bottom:solid 1px #000!important;"><?php echo $patient_details->email;?></span>
                     </div> 
                     
            
            <div class="content" style="width:50%;">
            	  
					<!--span style="float: left;margin-right: 1%;"><img src="<?php //echo base_url(); ?>assets/default/img/icons/telephone.png"/></span-->
           		   <label class="text_icon" style="float: left;">Office:</label>
                     <span  class="border" style="float:left;border-bottom:solid 1px #000!important;"><?php echo $patient_details->office_no;?></span>
                    </div>
                  <div class="content" style="width:50%;">  
                  <label style="float: left;">Home:</label>
                 <span  class="border" style="float:left;border-bottom:solid 1px #000!important;"><?php echo $patient_details->home_no;?></span>
           
            </div>
            <div class="content">
            <!--span style="float: left; margin-right: 1%;"><img src="<?php //echo base_url(); ?>assets/default/img/icons/mobile.png"/></span-->
           	 <label class="text_icon" style="float: left;">Mobile:</label>
              <span class="border" style="float:left;border-bottom:solid 1px #000!important;"><?php echo $patient_details->mobile_no;?></span>
                     
            </div> 
            <div class="contentfull">
            	<p><label>PATIENTS DESCRIPTION IS ADVISED:</label></p>
                <span class="details"><?php echo $patient_details->description;?></span>
            </div> 
            <div class="contentfull">
            	<p>I: <span><?php echo $patient_details->sur_name." ".$patient_details->given_name;?></span> with IC/Passport No.:<span><?php echo $patient_details->nric_passport;?></span></p>
                <p>Confirm that this consent has been expalined to me  in terms which I understand.</p>
            </div> 
            <div class="content">
            	<p><label>Signature:</label>  <span class="border">TCMS</span></p>
                
            </div> 
            <div class="content">
            <label style="float:left">Dated on:</label>
                 <span class="border"  style="float:left;border-bottom:solid 1px #000!important;"><?php echo $patient_details->date_of_admission;?></span>
            </div>
            
            <div class="contentfull">
            	<p>
                <label>A Are you allergic to any medicine / food?</label>
                <input type="checkbox" <?php if($patient_details->allergic=="1"){?> checked="checked" <?php }?>/><label>No/</label>
                <input type="checkbox" <?php if($patient_details->allergic=="0"){?> checked="checked" <?php }?>/><label>Yes</label>
                <label>Give Details</label>
                </p>
                <p><?php echo $patient_details->allergic_details;?></p>
                <p  class="doted_details"></p></div>
            
             <div class="contentfull">
            	<p>
                <label>B Have You had previous surgery?</label>
                <input type="checkbox" <?php if($patient_details->previous_surgery=="1"){?> checked="checked" <?php }?>/><label>No/</label>
                <input type="checkbox" <?php if($patient_details->previous_surgery=="0"){?> checked="checked" <?php }?>/><label>Yes</label>
                <label>Give Details</label>
                </p>
                <p ><?php echo $patient_details->previous_surgery_details;?></p> <p  class="doted_details"></p></div>
            
             <div class="contentfull">
            	<p>
                <label>C Mark "O and X" on the diagram for the affected lesion on the body:</label>
               	</p>
                
                <!--<div id="img_demo" style="position:inherit; height:300px; width:600px;">-->
          		 <!--<div id="container" style="position: relative;">-->
               <!-- <img style="position: absolute;" src="<?php echo base_url(); ?>assets/default/img/patient_body.jpg" width="600" height="300" />-->
              <!-- <img src="<?php //echo $patient_details->marking_img;?>" width="500" height="250" />-->
               <img src="<?php echo $patient_details->marking_img;?>" />
                <?php 
				  /*$mark = $patient_details->mark;
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
				  <?php }}}*/?>
                 <!-- </div>-->
           		 <!--</div>-->
                
            </div>
            
            <div class="contentfull">
            	<p>
                <label>D Chief Complaint</label>
                </p>
                <p><?php echo $patient_details->chief_complaint;?></p> <p  class="doted_details"></p></div>
            
            <div class="contentfull">
            	<p>
                <label>E History of Present Illness</label>
                </p>
                <p><?php echo $patient_details->present_illness;?><p> <p  class="doted_details"></p></div>
            
            <div class="contentfull">
            	<p>
                <label>F Past Madication History</label>
                </p>
                <p><?php echo $patient_details->past_medication;?></p ><p  class="doted_details"></p></div>
            
            <div class="contentfull">
            	<p>
                <label>G Physical Examination</label>
                </p>
                <p class="doted_details"><?php echo $patient_details->physical_exam;?></div>
            
            <div class="contentfull">
            	<p>
                <label>H Impression Disease With</label>
                </p>
                <p><?php echo $patient_details->disease;?></p> <p  class="doted_details"></p></div>
            
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