<script>
  $(function() {
    $( "#date_of_birth" ).datepicker();
	//$( "#date_of_birth" ).datepicker("option", "dateFormat", "dd/mm/yyyy");
  });
  $(function() {
    $( "#date_of_admission" ).datepicker();
	//$( "#date_of_admission" ).datepicker( "option", "dateFormat", "yy/mm/dd" );
  });

function check_nric_no_paitient(nric_no){
	var patient_id = $('#patient_id').val();	
	$.ajax({
		type:'POST',
		url:'<?php echo base_url()?>index.php/patient/check_nric_no_paitient?nric='+nric_no+'&paid='+patient_id,
		success:function(data){
			if(data=='no'){
				$('#nric_passport').val('');
				$('#error_nric').html('This No. '+nric_no+' Already Exist!');
				$('#error_nric').css( "color","red" );
			}else{
				//$('#error_nric').html('This No. '+nric_no+' Not Exist!');
				//$('#error_nric').css( "color","green" );
			}
		}
	});	
}

function dob(){
	var day = $('#days').val();
	var month = $('#month').val();
	var year = $('#years').val();
	
	$('#date_of_birth').val(month+'/'+day+'/'+year);
}


$(document).ready(function(){
	// binds form submission and fields to the validation engine
	$("#add_patinent").validationEngine();
	
	/*$("#submit").mouseover(function(event) {
		goToByScroll('submit_btn'); 
		html2canvas([document.getElementById('container')], {
			onrendered: function (canvas) {
			var data = canvas.toDataURL('image/png');
			$("#imgbase64").val(data);
			}
		 });
	});*/
	
	$( "#submit_btn" ).click(function( event ) {
		event.preventDefault();
		html2canvas([document.getElementById('container')], {
			onrendered: function (canvas) {
			var data = canvas.toDataURL('image/png');
			$("#imgbase64").val(data);
			}
		 });
		
		setTimeout(function() {
		  // Do something after 5 seconds
			var numItems = $('.formErrorContent').length;
			var uid = $("#patient_id").val();
			var imgdata = $("#imgbase64").val();
			var formdata = $("#add_patinent").serialize();
			var suburl = '<?php echo site_url("patient/edit_patient");?>';
			if(imgdata!='' && numItems==0){
			$.ajax({
					type:'POST',
					dataType:"json",
					url:suburl,
					data:formdata,
					success:function(data){
						//alert(data.uid);
						window.location='<?php echo site_url("patient/patient_profile");?>/'+data.uid;	
					}
				});
			}
		}, 100);
	
	});
	
});

  </script>




      <div id="breadcrumbs">
        <div class="patient_text">
          <h2>Edit Patient</h2>
        </div>
      </div>

    
    
  	<form name="add_patinent" id="add_patinent" action="<?php echo site_url("patient/edit_patient");?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient_id;?>" />
    
    <div id="a-are">
      <div id="remarks">        
        <div id="reference">
          <div id="Contact-title">
            <h5>Reference No. <?php echo $patient_profile->ref_no;?></h5>
          </div>
          <div id="Profile_Details">
            <div id="Personal_title_data">
              <div id="first_one"><span>Surname</span>
                <input type="text" name="sur_name" id="sur_name" class="validate[required] text-input" value="<?php echo $patient_profile->sur_name;?>" />
              </div>
              <div id="first_two"><span>Given Name</span>
                <input type="text" name="given_name" id="given_name" class="validate[required] text-input" value="<?php echo $patient_profile->given_name;?>" />
              </div>
            </div>
            <div id="Personal_title_data">
              <div id="first_one"><span>NRIC No/Passport*</span>
                <input type="text" name="nric_passport" id="nric_passport" onblur="return check_nric_no_paitient(this.value);" class="validate[required] text-input" value="<?php echo $patient_profile->nric_passport;?>" />
                 <input type="hidden" name="ref_no" id="ref_no" value="<?php echo $patient_profile->ref_no;?>"/>
                <div id="error_nric" style="text-align:right;"></div>
              </div>
              <div id="first_two"> <span>Date of  Birth </span>
              <?php 
			  		$date = explode("-",$patient_profile->date_of_birth); ?>
               <select id="days" onchange="dob()">
               		<?php for($i=1;$i<=31;$i++){?>
   							 <option <?php if($date[2]==$i){ echo "selected=selected";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>                
                    <?php }?>
               </select>
               
        	     <select id="month" onchange="dob()">
                    <option <?php if($date[1]=="01"){ echo "selected='selected'"; } ?> value="01" >Jan</option>
                    <option <?php if($date[1]=="02"){ echo "selected='selected'"; } ?> value="02" >Feb</option>
                    <option <?php if($date[1]=="03"){ echo "selected='selected'"; } ?> value="03" >March</option>
                    <option <?php if($date[1]=="04"){ echo "selected='selected'"; } ?> value="04" >April</option>
                    <option <?php if($date[1]=="05"){ echo "selected='selected'"; } ?> value="05" >May</option>
                    <option <?php if($date[1]=="06"){ echo "selected='selected'"; } ?> value="06" >June</option>
                    <option <?php if($date[1]=="07"){ echo "selected='selected'"; } ?> value="07" >July</option>
                    <option <?php if($date[1]=="08"){ echo "selected='selected'"; } ?> value="08" >Aug</option>
                    <option <?php if($date[1]=="09"){ echo "selected='selected'"; } ?> value="09" >Sept</option>
                    <option <?php if($date[1]=="10"){ echo "selected='selected'"; } ?> value="10" >Oct</option>
                    <option <?php if($date[1]=="11"){ echo "selected='selected'"; } ?> value="11" >Nov</option>
                    <option <?php if($date[1]=="12"){ echo "selected='selected'"; } ?> value="12" >Dec</option>
		    	</select>
               
               <select id="years" onchange="dob()">
			<?php 
            for($i = date('Y') ; $i >= 1950; $i--){
				$selected=""; if($date[0]==$i){ $selected="selected='selected'";}
              echo "<option ".$selected." value=".$i.">$i</option>";
            }
            ?>
	    </select>
        <input type="hidden" name="date_of_birth" id="date_of_birth"/>
                
			</div>
            </div>
            <div id="Personal_title_data">
              <div id="first_one"> <span>Gender</span>
                <div id="First_Name" style="margin-right:15px;">
                  <div id="sw_filt">
                   <input type="radio" name="gender" id="male" value="male" <?php if($patient_profile->gender=="male"){?> checked="checked" <?php }?> />
                <label for="nofilt">Male</label>
               <input type="radio" name="gender" id="female" value="female" <?php if($patient_profile->gender=="female"){?> checked="checked" <?php }?> />
                <label for="regionfilt">Female</label>
                  </div>
                </div>
              </div>
              <div id="first_two"> <span>Age</span>
                <input class="text-input" type="text" name="age" id="age" value="<?php echo $patient_profile->age;?>"/>
              </div>
            </div>
            <div id="Personal_title_data">
              <div id="first_one"> <span>Profession</span>
                <input class="text-input" type="text" name="profession" id="profession" value="<?php echo $patient_profile->profession;?>"/>
              </div>
              <div id="first_two"> <span>Email</span>
                <input class="validate[required,email] text-input" type="text" name="email" id="email" value="<?php echo $patient_profile->email;?>"/>
              </div>
            </div>
            <div id="Personal_title_data">
              <div id="first_one"> <span>Office</span>
                <input class="text-input" type="text" name="office_no" id="office_no"  value="<?php echo $patient_profile->office_no;?>"/>
              </div>
              <div id="first_two"> <span>Home</span>
                <input class="text-input" type="text" name="home_no" id="home_no"  value="<?php echo $patient_profile->home_no;?>"/>
              </div>
            </div>
            <div id="Personal_title_data">
              <div id="first_one"> <span>Mobile</span>
                <input class="validate[required] text-input" type="text" name="mobile_no" id="mobile_no"  value="<?php echo $patient_profile->mobile_no;?>"/>
              </div>
              <div id="first_two"> <span>Dataed On</span>
                <input class="text-input" type="text" name="date_of_admission" id="date_of_admission"  value="<?php echo $patient_profile->date_of_admission;?>"/>
              </div>
            </div>
            <div id="Personal_title_data">
              <div id="first_add"> <span>Address:</span>
                <textarea class="validate[required] text-input" name="address" id="address" cols="62" rows="5"><?php echo $patient_profile->address;?></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     <div id="patients_description">
      <div id="Contact-title">
        <h5>Patient Discretion is Advised</h5>
      </div>
      <div id="Profile_Details">
        <div id="patients_one">
        <?php $disable=""; if($this->session->userdata("user_type")!='Admin'){ $disable="disabled='disabled'";} ?>
 	<textarea class="text-input" <?php echo $disable; ?> name="description" id="description" cols="83" rows="5" ><?php echo $this->mdl_patient->getDescription(); ?></textarea>          	

        </div>
      </div>
    </div>
    <div id="a_are_you">
      <div id="Contact-title">
        <h5>A Are you allergic to any medicine / food?</h5>
      </div>
      <div id="Profile_Details">
        <div id="a_are_radio">
          <div id="sw_filt">
            <input type="radio" name="allergic" value="1" <?php if($patient_profile->allergic=="1"){?> checked="checked" <?php }?> />
                <label for="nofilt">Yes</label>
                <input type="radio" name="allergic" value="0" <?php if($patient_profile->allergic=="0"){?> checked="checked" <?php }?> />
                <label for="regionfilt">No</label>
          </div>
          <span>Give Details</span> </div>
        <div id="patients_one">
          <textarea class="text-input" name="allergic_details" id="allergic_details" cols="83" rows="5"><?php echo $patient_profile->allergic_details;?></textarea>
        </div>
      </div>
    </div>
    
    <div id="b_have_you">
      <div id="Contact-title">
        <h5>B Have You had previous surgery?</h5>
      </div>
      <div id="Profile_Details">
        <div id="a_are_radio">
          <div id="sw_filt">
            <input type="radio" name="previous_surgery" value="1" <?php if($patient_profile->previous_surgery=="1"){?> checked="checked" <?php }?> />
                <label for="nofilt">Yes</label>
                <input type="radio" name="previous_surgery" value="0" <?php if($patient_profile->previous_surgery=="0"){?> checked="checked" <?php }?> />
                <label for="regionfilt">No</label>
          </div>
          <span>Give Details</span> </div>
        <div id="patients_one">
          <textarea class="text-input" name="previous_surgery_details" id="previous_surgery_details" cols="83" rows="5"><?php echo $patient_profile->previous_surgery_details;?></textarea>
        </div>
      </div>
    </div>
        
    <div id="c_mark">
      <div id="Contact-title">
        <h5>C Mark "O and X" on the diagram for the affected lesion on the body:</h5>
      </div>
      <div id="Profile_Details">
        <div id="a_are_radio">
          <div id="sw_filt" class="marking">
            <input type="radio" name="marking" value="marko">
            <label for="nofilt">Mark O</label>
            <input type="radio" name="marking" value="markx">
            <label for="regionfilt">Mark X</label>
            <input type="radio" name="marking" value="removemark">
            <label for="removemark">Remove Mark</label>
          </div>
        </div>
        <div id="First_c_marke">
          <div id="img_demo">
          	 <div id="container">
              <img alt="" width="600" height="300" title="" src="<?php echo base_url(); ?>assets/default/img/patient_body.jpg"> 
              <?php 
			  $mark = $patient_profile->mark;
			  if($mark!=''){
				  $all_mark = explode(",",$mark);
				  if(!empty($all_mark) && count($all_mark)>0){
					  for($ik=0;$ik<count($all_mark);$ik++){
					  $imgdata = explode("|",$all_mark[$ik]);
					  $xdata = $imgdata[0];
					  $ydata = $imgdata[1];
					  $xyimg = $imgdata[2];
				  ?>
              <img class="markingdotcross" style="top: <?php echo $ydata;?>px; left: <?php echo $xdata;?>px;" src="<?php echo base_url(); ?>assets/default/img/<?php echo $xyimg;?>.png">
              <input type="hidden" id="<?php echo "img_".$xdata."px".$ydata."px";?>" data-ydata="<?php echo $ydata;?>" data-xdata="<?php echo $xdata;?>" value="<?php echo $xdata."|".$ydata."|".$xyimg;?>" name="mark[]">
              <?php }}}?>
            </div>
            </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="marking_img" value="" id="imgbase64" />
    
    <div id="d_chief">
      <div id="Contact-title">
        <h5>D Chief Complaint</h5>
      </div>
      <div id="Profile_Details">
        <div id="patients_one">
          <textarea class="text-input" name="chief_complaint" id="chief_complaint" cols="83" rows="5"><?php echo $patient_profile->chief_complaint;?></textarea>
        </div>
      </div>
    </div>
    
    <div id="e_history">
      <div id="Contact-title">
        <h5>E History of Present Illness</h5>
      </div>
      <div id="Profile_Details">
        <div id="patients_one">
          <textarea class="text-input" name="present_illness" id="present_illness" cols="83" rows="5"><?php echo $patient_profile->present_illness;?></textarea>
        </div>
      </div>
    </div>
    <div id="f_past">
      <div id="Contact-title">
        <h5>F Past Medication History</h5>
      </div>
      <div id="Profile_Details">
        <div id="patients_one">
          <textarea class="text-input" name="past_medication" id="past_medication" cols="83" rows="5"><?php echo $patient_profile->past_medication;?></textarea>
        </div>
      </div>
    </div>
    <div id="g_physical">
      <div id="Contact-title">
        <h5>G Physical Examination</h5>
      </div>
      <div id="Profile_Details">
        <div id="patients_one">
          <textarea class="text-input" name="physical_exam" id="physical_exam" cols="83" rows="5"><?php echo $patient_profile->physical_exam;?></textarea>
        </div>
      </div>
    </div>
    <div id="h_impression">
      <div id="Contact-title">
        <h5>H Impression Disease With</h5>
      </div>
      <div id="Profile_Details">
        <div id="patients_one">
          <textarea class="text-input" name="disease" id="disease" cols="83" rows="5"><?php echo $patient_profile->disease;?></textarea>
        </div>
      </div>
    </div>
    <div id="i_habits">
      <div id="Contact-title">
        <h5>I Habits/Familial Hx</h5>
      </div>
      <div id="Profile_Details">
        <div id="Personal_title_data">
          <div id="sw_filt">
           <input type="checkbox" name="smoking" value="1" <?php if($patient_profile->smoking=="1"){?> checked="checked" <?php }?> />
                <label for="nofilt">Smoking</label>
                <input type="checkbox" name="alcohol" value="1" <?php if($patient_profile->alcohol=="1"){?> checked="checked" <?php }?> />
                <label for="regionfilt">Alcohol</label>
                <input type="checkbox" name="drug_abuse" value="1" <?php if($patient_profile->drug_abuse=="1"){?> checked="checked" <?php }?> />
                <label for="regionfilt">Drug Abuse</label>
                <input type="checkbox" name="familial_hx" value="1" <?php if($patient_profile->familial_hx=="1"){?> checked="checked" <?php }?> />
                <label for="regionfilt">Familial Hx</label>
                <input type="checkbox" name="hair_perm" value="1" <?php if($patient_profile->hair_perm=="1"){?> checked="checked" <?php }?> />
                <label for="regionfilt">Hair Perm</label>
                 <input type="checkbox" name="hair_color" value="1" <?php if($patient_profile->hair_color=="1"){?> checked="checked" <?php }?> />
                <label for="regionfilt">Hair Color</label>
                <input type="checkbox" name="contraceptive" value="1" <?php if($patient_profile->contraceptive=="1"){?> checked="checked" <?php }?> />
                <label for="regionfilt">Contraceptive</label>
          </div>
        </div>
      </div>
    </div>
    
    <div id="button_save">
        <div id="submit">          
        	<input type="button" id="submit_btn" value="Submit" name="submit">
         </div>
         <div id="button_Cancel"><a href="<?php echo site_url('patient/patient_profile/'.base64_encode($patient_id)); ?>" >Cancel</a></div>         
    </div>           
    </form>
	
</div>

	
