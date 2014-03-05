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
  <div id="Patient_Profile"><ul><li ><a href="<?php echo site_url("patient/patient_profile/".$patient_id);?>">Patient Profile</a></li>
   <li><a href="<?php echo site_url("patient/patient_attendance/".$patient_id);?>">Patient Attendance </a></li>
 <?php
   if($this->session->userdata("user_type")!="Reception")
   {
	if(empty($patient_details)){ ?>
   <li class="active"><a href="<?php echo site_url("patient/edit_patient_financial_profile/".$patient_id);?>">Patient Financial Profile</a></li>
   <?php }else{ ?>
   <li class="active"><a href="<?php echo site_url("patient/patient_financial_profile/".$patient_id);?>">Patient Financial Profile</a></li>
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

<?php $injection_data = $this->mdl_patient->get_all_injection();?>   
   
   <!--------------->
   <div id="Profile_right">
   <div id="top_border" style="width:75%;">
      <div id="left_title">
        <h2> <?php if(!empty($patient_details)){?>Edit<?php }else{?>Add<?php } ?> Financial Profile </h2>
      </div> 
      </div>
      <?php if(!empty($patient_details)){ ?>
      <div>
      	<form name="financial_profile" id="financial_profile" action="<?php echo site_url("patient/edit_patient_financial_profile");?>" method="post" enctype="multipart/form-data">
       <input type="hidden" name="rec_id" id="rec_id" value="<?php echo $patient_details->patient_fid;?>" />
	<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient_id;?>" />
    
       <div id="Profile_name"><h3>NAME:  <?php echo $patient_name;?></h3></div>
       
       <div id="Contact-Details">
       
       <div id="Contact-title"><h5>Sponsorship Details:</h5></div>
       <div id="Profile_Details"><ul>
       <li><div class="Sponsorship_id">Name of Sponsor:</div>
       <div class="right_Sponsorship"><input type="text" value="<?php echo $patient_details->sponsor_name;?>" name="sponsor_name" id="sponsor_name" class="validate[required] text-input center-table-txt" /></div></li>
       <li><div class="Sponsorship_id">Date of Approved letter:</div> 
       <div class="right_Sponsorship"><input type="text" value="<?php echo date("Y-m-d",strtotime($patient_details->sponsor_approval_letter_date));?>" name="sponsor_approval_letter_date" id="sponsor_approval_letter_date" class="validate[required] text-input center-table-txt"/></div></li>
       <li><div class="Sponsorship_id">Sponsor Limit:</div>
       <div class="right_Sponsorship"><input type="text" value="<?php echo $patient_details->sopnsor_limit;?>" name="sopnsor_limit" id="sopnsor_limit" class="validate[required] text-input center-table-txt"/> </div></li>
       <li><div class="Sponsorship_id">Sponsor Limit per dialysis treatment:</div>
       <div class="right_Sponsorship"><input type="text" value="<?php echo $patient_details->sponsor_limit_per_dialysis;?>" name="sponsor_limit_per_dialysis" id="sponsor_limit_per_dialysis" class="validate[required] text-input center-table-txt"/> </div></li>
       <li><div class="Sponsorship_id">Payment Method:</div>
       <div class="right_Sponsorship" style="width:235px;">
      
        <select style="width:234px;height:40px;" id="MainContent_ddlPayMethod_old" name="sponsor_payment_method">
        <option value="0">Select</option>
        <option value="By Cash" <?php if($patient_details->sponsor_payment_method=='By Cash'){echo 'selected="selected"';} ?>>By Cash</option>
        <option value="By Credit Card" <?php if($patient_details->sponsor_payment_method=='By Credit Card'){echo 'selected="selected"'; }?>>By Credit Card</option> 
        <option value="Direct Banking" <?php if($patient_details->sponsor_payment_method=='Direct Banking'){echo 'selected="selected"'; }?>>Direct Banking</option>
        <option value="By Cheque" <?php if($patient_details->sponsor_payment_method=='By Cheque'){echo 'selected="selected"'; }?>>By Cheque</option> 
        </select>
       
      </div></li>
       <li><div class="Sponsorship_id">upload letter:</div>
       <div class="right_Sponsorship">
       <input type="file" style="float: right;width: 219px;" value="<?php echo $patient_details->letter_upload;?>" name="letter_upload" id="letter_upload" class="text-input"/>
       <div style="clear:both"></div>
      <?php if($patient_details->letter_upload != ''){ ?>
<a href="<?php echo base_url("uploads/approval_letters/".$patient_details->letter_upload);?>" target="_blank" style="float:right">view</a>
<?php } ?>
                
                
       <!--<input type="file" style="width: 227px; float: right;" 
       id="MainContent_ImgPPAtient" name="ctl00$MainContent$ImgPPAtient">--> </div></li>
       
        </ul></div>
       </div>
       
       <div id="General_information"> <div id="Contact-title"><h5>Self-Payment Details:</h5></div>
       <div id="Profile_Details"><ul>
       <li><div class="Sponsorship_id">Name of payee:</div>
       <div class="right_Sponsorship"><input type="text" value="<?php echo $patient_details->self_name_of_payee;?>" name="self_name_of_payee" id="self_name_of_payee" class="validate[required] text-input center-table-txt"/></span></div></li>
       <li><div class="Sponsorship_id" >Payment method:</div> 
       <div class="right_Sponsorship" style="width:235px;"> 
       <select style="width:234px;height:40px;" id="MainContent_ddlPayMethod_old" name="self_payment_method">
        <option value="0">Select</option>
        <option value="By Cash" <?php if($patient_details->self_payment_method=='By Cash'){echo 'selected="selected"';} ?>>By Cash</option>
        <option value="By Credit Card" <?php if($patient_details->self_payment_method=='By Credit Card'){echo 'selected="selected"'; }?>>By Credit Card</option> 
        <option value="Direct Banking" <?php if($patient_details->self_payment_method=='Direct Banking'){echo 'selected="selected"';} ?>>Direct Banking</option>
        <option value="By Cheque" <?php if($patient_details->self_payment_method=='By Cheque'){echo 'selected="selected"';} ?>>By Cheque</option> 
        </select>
       </div></li>
        
        </ul></div></div>
        
        <!--<div id="Funding-Source"><div id="Contact-title"><h5>Master Charges: </h5></div>
        <div id="Profile_Details" style="margin-bottom:15px;"><ul>
        <li><div class="Sponsorship_id">Hemodialysis (HD):</div>
       <div class="right_Sponsorship"><input type="text" value="<?php echo $patient_details->hemodialysis;?>" name="hemodialysis" id="hemodialysis" class="validate[required] text-input center-table-txt"/></span> </div></li>
       <li><div class="Sponsorship_id">Injection (Micera) :	</div>
       <div class="right_Sponsorship"><input type="text" value="<?php echo $patient_details->injection_micera;?>" name="injection_micera" id="injection_micera" class="validate[required] text-input center-table-txt"/> </div></li>
       <li><div class="Sponsorship_id">Injection (Recormon):</div>
       <div class="right_Sponsorship" style="width:235px;">
       	<input type="text" value="<?php //echo $patient_details->injection_recormon;?>" name="injection_recormon" id="injection_recormon" class="validate[required] text-input center-table-txt"/>
        
        
       </div></li>
       <li><div class="Sponsorship_id">Injection (Eprex):</div>
       <div class="right_Sponsorship"><input type="text" value="<?php echo $patient_details->injection_eprex;?>" name="injection_eprex" id="injection_eprex" class="validate[required] text-input center-table-txt"/> </div></li>
        
        
        </ul></div>
         <div style="clear:left;" id="button_save">
        	<div id="submit">
         <input type="submit" id="submit_btn" name="edit"   value="Save" style="float:left;margin-right:5px;" /> &nbsp;&nbsp;
         	</div>
            <div id="button_Cancel"><a href="<?php echo site_url("patient/patient_financial_profile/".$patient_id);?>">Cancel</a></div>
					
       </div>
        <div style="display: block; float: left;height: 19px;width: 100%;"></div>
        </div>-->
       
       
       
       <div id="Funding-Source"><div id="Contact-title"><h5>Master Charges: </h5></div>
        <div id="Profile_Details" style="margin-bottom:15px;"><ul>
        <li>
        <div class="Sponsorship_id">Hemodialysis(HD) :</div>
       	<div class="right_Sponsorship">
        <input type="text" value="<?php echo $patient_details->hemodialysis; ?>" name="hemodialysis" id="hemodialysis" class="text-input center-table-txt"/> </div></li>
       <?php foreach($injection_data as $injection){?> 
        <li>
        	<div class="Sponsorship_id"><?php echo $injection->name;?> :</div>
       		<div class="right_Sponsorship">
            <?php $inj_data = $this->mdl_patient->get_injection_data($patient_details->patient_fid,$patient_id,$injection->id);?>
            <?php //print_r($inj_data);?>
            	<input type="text" value="<?php if(!empty($inj_data)){echo $inj_data[0]->inj_data;}?>" name="patient_injection_<?php echo $injection->id;?>" id="<?php echo $injection->id;?>" class="text-input center-table-txt"/> 
            </div>
        </li>
       <?php }?>
       <input type="hidden" name="injection_row" id="injection_row" value="<?php echo count($injection_data);?>" />
      </ul></div>
         <div style="clear:left;" id="button_save">
        	<div id="submit">
         <input type="submit" id="submit_btn" name="edit"   value="Save" style="float:left;margin-right:5px;" /> &nbsp;&nbsp;
         	</div>
            <div id="button_Cancel"><a href="<?php echo site_url("patient/patient_financial_profile/".$patient_id);?>">Cancel</a></div>
					
       </div>
        <div style="display: block; float: left;height: 19px;width: 100%;"></div>
        </div>
       
       
       
       
       
       
       
       
       </form>
        </div>
        <?Php }else{ ?>
        <div >
        <form name="add_financial_profile" id="add_financial_profile" action="<?php echo site_url("patient/edit_patient_financial_profile");?>" method="post">
	<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient_id;?>" />
   <!-- <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient_id;?>" />-->
    
      <div>
       <div id="Profile_name"><h3>NAME:  <?php echo $patient_name;?></h3></div>
       
       <div id="Contact-Details">
       
       <div id="Contact-title"><h5>Sponsorship Details:</h5></div>
       <div id="Profile_Details"><ul>
       <li><div class="Sponsorship_id">Name of Sponsor:</div>
       <div class="right_Sponsorship"><input type="text" name="sponsor_name" id="sponsor_name" class="validate[required] text-input center-table-txt" onc/></div></li>
       <li><div class="Sponsorship_id">Date of Approved letter:</div> 
       <div class="right_Sponsorship"><input type="text"  name="sponsor_approval_letter_date" id="sponsor_approval_letter_date" class="validate[required] text-input center-table-txt"/></div></li>
       <li><div class="Sponsorship_id">Sponsor Limit:</div>
       <div class="right_Sponsorship"><input type="text"  name="sopnsor_limit" id="sopnsor_limit" class="validate[required] text-input center-table-txt"/> </div></li>
       <li><div class="Sponsorship_id">Sponsor Limit per dialysis treatment:</div>
       <div class="right_Sponsorship"><input type="text" name="sponsor_limit_per_dialysis" id="sponsor_limit_per_dialysis" class="validate[required] text-input center-table-txt"/> </div></li>
       <li><div class="Sponsorship_id">Payment Method:</div>
       <div class="right_Sponsorship" style="width:235px;">
        <select style="width:233px;" id="MainContent_ddlPayMethod_old" name="sponsor_payment_method">
        <option value="0">Select</option>
        <option value="By Cash" >By Cash</option>
        <option value="By Credit Card">By Credit Card</option>
        <option value="Direct Banking" >Direct Banking</option>
        <option value="By Cheque">By Cheque</option> 
        </select>
       
      </div></li>
       <li><div class="Sponsorship_id">upload letter:</div>
       <div class="right_Sponsorship">
       <input type="file" style="width: 227px; float: right;" name="letter_upload" id="letter_upload" class="validate[required] text-input"/>

                
                
       <!--<input type="file" style="width: 227px; float: right;" 
       id="MainContent_ImgPPAtient" name="ctl00$MainContent$ImgPPAtient">--> </div></li>
       
        </ul></div>
       </div>
       
       <div id="General_information"> <div id="Contact-title"><h5>Self-Payment Details:</h5></div>
       <div id="Profile_Details"><ul>
       <li><div class="Sponsorship_id">Name of payee:</div>
       <div class="right_Sponsorship"><input type="text"  name="self_name_of_payee" id="self_name_of_payee" class="validate[required] text-input center-table-txt"/></span></div></li>
       <li><div class="Sponsorship_id">Payment method:</div> 
       <div class="right_Sponsorship" style="width:235px;"> 
       <select style="width:233px;" id="MainContent_ddlPayMethod_old" name="self_payment_method">
        <option value="0">Select</option>
        <option value="By Cash">By Cash</option>
        <option value="By Credit Card">By Credit Card</option> 
        <option value="Direct Banking" >Direct Banking</option>
        <option value="By Cheque">By Cheque</option>         
        </select>
       </div></li>
        
        </ul></div></div>
        
        <div id="Funding-Source"><div id="Contact-title"><h5>Master Charges: </h5></div>

        
        <div id="Profile_Details" style="margin-bottom:15px;"><ul>
        <li>
        <div class="Sponsorship_id">Hemodialysis(HD) :</div>
       	<div class="right_Sponsorship">
        <input type="text" value="" name="hemodialysis" id="hemodialysis" class="text-input center-table-txt"/> </div></li>
       <?php foreach($injection_data as $injection){?> 
        <li>
        	<div class="Sponsorship_id"><?php echo $injection->name;?> :</div>
       		<div class="right_Sponsorship">
           <input type="text" value="" name="patient_injection_<?php echo $injection->id;?>" id="<?php echo $injection->id;?>" class="text-input center-table-txt"/> </div>
        </li>
       <?php }?>
       <input type="hidden" name="injection_row" id="injection_row" value="<?php echo count($injection_data);?>" />
      </ul></div>
        
        
        
        </div>
        
        <!--<input type="submit" name="edit" id="edit" value="save" /> &nbsp;&nbsp;
					<input type="reset" name="cancel" id="cancel" value="cancel" />-->
                    <div style="clear:left;" id="button_save">
        				<div id="submit">
                    	<input type="submit" name="save"  id="submit_btn"  value="Save" style="float:left;margin-right:5px;" /> &nbsp;&nbsp;
						<div id="button_Cancel"><a href="<?php echo site_url('patient');?>">Cancel</a></div>
                    	</div>
                    </div>
       
        <div style="display: block; float: left;height: 19px;width: 100%;"></div>
        </div>
       </div>
       
       </form>
       </div>
        <?php } ?>
</div>
