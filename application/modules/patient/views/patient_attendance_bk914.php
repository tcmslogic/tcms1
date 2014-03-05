<div id="Patient_Profile"><ul><li><a href="<?php echo site_url("patient/patient_profile/".$patient_id);?>">Patient Profile</a></li>
   <li class="active"><a href="<?php echo site_url("patient/patient_attendance/".$patient_id);?>">Patient Attendance </a></li>
 <?php
   if($this->session->userdata("user_type")!="Reception")
   {
	if(empty($patient_details)){ ?>
   <li><a href="<?php echo site_url("patient/edit_patient_financial_profile/".$patient_id);?>">Patient Financial Profile</a></li>
   <?php }else{ ?>
   <li><a href="<?php echo site_url("patient/patient_financial_profile/".$patient_id);?>">Patient Financial Profile</a></li>
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
<!------------------------for user group vise chart----------------------------->
	
	





<div id="Profile_right">
  <div id="top_border">
      <div id="left_title">
        <h2>Patient Attendance  </h2>
      </div> </div>
 <div id="Patient_table"><div id="table">
 
 <table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	 
            <th scope="col" class="rounded">Name</th>
            <th scope="col" class="rounded">Date</th>
            <th scope="col" class="rounded">Machine Type</th>
            <th scope="col" class="rounded">Injection </th>
            <th scope="col" class="rounded">Present / Absent</th>
            <!--<th scope="col" class="rounded-q4">Delete</th>-->
        </tr>
    </thead>
        <tfoot>
    	<!--<tr>
        	 
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>-->
    </tfoot>
    <tbody>
    	<tr>
        	 
            <td>Abdullah Sidek</td>
            <td>13 AUg 1937</td>
            <td>Product name</td>
            <td>12/05/2010</td>

            <td>Present</td>
           <!-- <td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>-->
        </tr>
        
    	<tr>
        	 
            <td>Abdullah Sidek </td>
            <td>13 AUg 1937</td>
            <td>Product name</td>
            <td>12/05/2010</td>

            <td>Present</td>
            <!--<td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>-->
        </tr> 
        
    	<tr>
        	 
            <td>Abdullah Sidek </td>
            <td>13 AUg 1937</td>
            <td>Product name</td>
            <td>12/05/2010</td>

            <td>Present</td>
            <!--<td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>-->
        </tr>
        
    	<tr>
         
            <td>Abdullah Sidek </td>
            <td>13 AUg 1937</td>
            <td>Product name</td>
            <td>12/05/2010</td>

            <td>Present</td>
            <!--<td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>-->
        </tr>  
    	<tr>
        	 
            <td>Abdullah Sidek </td>
            <td>13 AUg 1937</td>
            <td>Product name</td>
            <td>12/05/2010</td>

            <td>Present</td>
            <!--<td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>-->
        </tr>
        
    	<tr>
        	 
            <td>Abdullah Sidek </td>
            <td>13 AUg 1937</td>
            <td>Product name</td>
            <td>12/05/2010</td>

            <td>Present</td>
            <!--<td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>-->
        </tr>    
        
    </tbody>
</table>
 
 
  
         
         
</div>
<div id="button_save"><div id="save"><a href="#">Edit</a></div>
<div id="button_Cancel"><a href="#">Delete</a></div>
</div>
</div>       
       
       
       
        
        
</div>