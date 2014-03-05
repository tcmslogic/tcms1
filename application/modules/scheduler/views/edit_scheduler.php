
	<h2>Update Schedule</h2>

	<form method="post" action="<?php echo site_url("scheduler/edit_scheduler");?>" id="addSchedule" name="addSchedule">
<div class="aspNetHidden">
<?php /*?><?php if(strtotime($details->start_date) <= strtotime(date("Y-m-d h:i:s")))
{
	echo "<h4>This Scadule is Expired You can't edit it.</h4>";
	
}?><?php */?> 
</div>
    <div style="margin-left: 5%;">
        <div id="topRow">
           
            <input type="hidden" name="event_date" id="event_date" value="<?php echo $details->start_date;?>"/>
			<input type="hidden" name="end_date" id="end_date" value="<?php echo $details->end_date;?>"/>
			<input type="hidden" name="allDay" id="allDay" value="false"/>
			<input type="hidden" name="event_id" id="event_id" value="<?php echo $details->id;?>" />
			<input type="hidden" name="id" id="id" value="<?php echo $event[0]->id; ?>" />
            
            <!--<select name="shift" id="shift" style="margin-left: 10px;">
				<option value="1 ST SHIFT">1 ST SHIFT</option>
				<option value="2 ND SHIFT">2 ND SHIFT</option>
				<option value="3 RD SHIFT">3 RD SHIFT</option>
				<option value="4 TH SHIFT">4 TH SHIFT</option>

			</select>-->									
			<!--<span id="dtSchdule" style="font-weight:bold;color:#696969;font-size:15px;"><?php echo date("Y-m-d",strtotime($details->start_date));?></span>
           -->
        </div>
        <div id="schdulerContint">
            <div>
	<table cellspacing="0" rules="" border="0" id="gvUserInfo" style="border-collapse:collapse;">
		<tr style="color:#fafafa;background-color:#fafafa;font-weight:bold;">
			<th scope="col">Machine No</th>
			<th scope="col">Machine Description</th>
			<th scope="col">Patient Name</th>
			<th scope="col">Injection</th>
			<th scope="col">Injection Qty</th>
			<th scope="col">Status</th>
		</tr>			
	</table>
</div>
  	<table cellspacing="0" rules="" border="0" id="" style="border-collapse:collapse;">    	
            <tr>
            <td>Holidays :</td>
                   <td>            
                    <select name="holidays" id="holidays" onChange="holiday_edit(this.value);">                           
                            <option <?php echo ($details->day=="workingday")?"selected='selected'":""; ?> value="workingday">Working Day</option>
                            <option <?php echo ($details->day=="holiday")?"selected='selected'":""; ?> value="holiday">Holiday</option>
                            <option <?php echo ($details->day=="no")?"selected='selected'":""; ?> value="no">NO</option>			                            
                    </select>				           
                   </td>
            </tr>       
	</table>
    <?php if($details->day=="holiday" || $details->day=="no"){ $holi_style="display:block;"; $user_style="display:none;";}
		  else{$holi_style="display:none;"; $user_style="display:block;";}
	?>
	<table cellspacing="0" rules="" border="0" id="holi_div" style="border-collapse:collapse; <?php echo $holi_style; ?>">    	
        	<td>Name :</td>
            <td><input type="text" name="holiday_name" value="<?php echo $details->day_name; ?>"/></td>
	</table>       
	<table cellspacing="0" rules="" border="0" id="gvUserInfo_edit" style="border-collapse:collapse; <?php echo $user_style; ?>">    	
            <tr>
                <td>Patient Name :</td>
                <td>
                    <select name="patient_name" id="patient_name">                	
                    <?php foreach($patients as $patient){?>
			 <option <?php echo ($patient->patient_id==$details->patient_id)?"selected='selected'":""; ?> value="<?php echo $patient->patient_id;?>">
			 	<?php echo $patient->given_name.' '.$patient->sur_name;?>
             </option>
                    <?php }?>
                    </select>                
                </td>
        	</tr>
            <tr>
        	<td>Time In : </td>
            <td>
	           	<input type="text" name="schedule_time_in" id="schedule_time_in1" value="<?php echo date("h:i",strtotime($details->time_in));?>"/>
                <script type="text/javascript">
				/*$(function(){
					alert("<?php echo date("Y-m-d h:i:s",strtotime($details->start_date))?>");
					$('*[name=schedule_time_in]').appendDtpicker({
					"inline": true,
					"current": "2012-3-4 12:30"
					});
				});*/
				
				</script>
            </td>
        </tr>
        <tr>
        	<td>Time Out :</td>
            <td>
	           	<input type="text" name="schedule_time_out" id="schedule_time_out1" value="<?php echo date("h:i",strtotime($details->time_out));?>"/>
               
            </td>
        </tr>
        <tr>
        	<td>Reminder :</td>
            <td>
	           	<select name="reminder" id="reminder">
                    <option <?php echo ($details->reminder=="seven_days")?"selected='selected'":""; ?> value="seven_days">7 Days</option>
                    <option <?php echo ($details->reminder=="two_days")?"selected='selected'":""; ?>  value="two_days">2 Days</option>
                    <option <?php echo ($details->reminder=="cancel_reminder")?"selected='selected'":""; ?>  value="cancel_reminder">Cancel Reminder</option>
                </select>                
            </td>
        </tr>
        <tr>
        	<td>Staff :</td>
            <td>
	           	<select name="staff_name" id="staff_name">           
				<?php foreach($staff as $staff){?>
				<option <?php echo ($staff->user_id==$details->staff_id)?"selected='selected'":""; ?> value="<?php echo $staff->user_id;?>"><?php echo $staff->user_fullname.' '.$staff->user_name;?></option>
				<?php }?>
                </select>                
            </td>
        </tr>
        <tr>
        	<td>Status :</td>
            <td>            
	           	<select name="status" id="status">           				
                    <option <?php echo ($details->status=="")?"selected='selected'":""; ?> value="">Select</option>                
                    <option <?php echo ($details->status=="present")?"selected='selected'":""; ?> value="present">Present</option>
                    <option <?php echo ($details->status=="dropout")?"selected='selected'":""; ?>  value="dropout">Dop Out</option>
                    <option <?php echo ($details->status=="noschedule")?"selected='selected'":""; ?>  value="noschedule">No Schedule</option>
                </select>                
            </td>
        </tr>
		<tr>
			<td colspan="2"> 
			</td>
		</tr>
            </table>
        <input type="submit" name="save" value="Save" id="save" Class="form-save" style="margin-left: 0px; margin-top: 0px;" />    
        </div>
       
    </div>
    </form>
<script type="text/javascript">
	$(function(){
		$('#schedule_time_in1').timepicker();
		$('#schedule_time_out1').timepicker();
	});		
</script>
<script type="text/javascript">
function holiday_edit(day){

	if(day=="no" || day=="holiday"){
		document.getElementById('holi_div').style.display = 'block';
		document.getElementById('gvUserInfo_edit').style.display = 'none';
	}
	else{
		document.getElementById('holi_div').style.display = 'none';
		document.getElementById('gvUserInfo_edit').style.display = 'block';
	}
}
</script>
