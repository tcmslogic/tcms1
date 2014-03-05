<?php include_once('sidebar.php');?>
<div class="right-panel">
<div class="headerbar">
    <h1>Scheduler</h1>
	<!--<span style="color:#FF0000;"><?php echo $message;?></span>-->
</div>
<!------------------------for user group vise chart----------------------------->

<div class="container-fluid">

    <?php //include("menu_header.php");?>

	<div class="row-fluid">
	
<?php 
	$i=0;
	$k=0;
	
	foreach($events as $event)
	{
		if($event->patient_id!="" || $event->patient_id!=null){
			$staff=$this->mdl_scheduler->getPatientName($event->patient_id);
			$var[$i]=array('event_id'=>$event->id,
						   'title'=>$staff,
						   'start'=>date("Y-m-d h:i:s",strtotime($event->start_date)),
						   'end'=>date("Y-m-d h:i:s",strtotime($event->end_date)),
						   'allDay'=>false);
			$i++;
		}
		else{
			if($event->day=="holiday"){$color="#FF5353";}else{$color="#00FFCC";}
			$var[$i]=array('event_id'=>$event->id,
						   'title'=>$event->day_name,
						   'start'=>date("Y-m-d h:i:s",strtotime($event->start_date)),
						   'end'=>date("Y-m-d h:i:s",strtotime($event->end_date)),
						   'allDay'=>false,
						   'backgroundColor'=>$color);
			$i++;			
		}

	}

	
	//echo "<pre>";
//	print_r($var);exit;
	$result=json_encode($var);
	
	?>
<head>

<script>

	$(document).ready(function() {
	
	$("#inline").css("display","none");
	$("#inline1").css("display","none");
	$(".modalbox").fancybox();
	$(".modalbox1").fancybox();
		
		var date = new Date();
		var d = date.getDate(); 
		var m = date.getMonth(); 
		var y = date.getFullYear();
		
		var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {

				$.ajax({
					url:"<?php echo site_url("scheduler/cal_scheduler");?>/"+convert_date(start),
					cache:false,
					data:"event_name="+convert_date(start),
					success:function(data){
						//alert(data);
						if(data=="holiday" || data=="no"){
							$( ".modalbox" ).on( "click", function() {
							
							});
												
							//$("#day_"+convert_date(start)).css("background-color","#f00");																
							$("#event_date").val(start);
						}
						else{
							$( ".modalbox" ).on( "click", function() {
					
							});
							$( ".modalbox" ).trigger( "click" );
																					
							$("#event_date").val(start);	
						}						
					}
				});
												
				//var title = prompt('Event Title:');
				
				$("#addSchedule").submit(function(){
					
				title=$("#shift").val();
				
				if (title!="") {
					
					date=convert($("#event_date").val());
					end_date=convert(end);
					
					$("#event_date").val(date);
					$("#end_date").val(end_date);
					
					$("#allDay").val(allDay);
					
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start:$("#event_date").val(),
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				$("#holder").hide();
				//return false;
				});
				
				calendar.fullCalendar('unselect');
			
			},
			editable: true,
			
			events: <?php echo $result;?>,			
			eventClick: function(event) {
				//alert(event.event_id);
				$.ajax({
					url:"<?php echo site_url("scheduler/edit_scheduler");?>/"+event.event_id,
					cache:false,
					data:"event_name="+event.title,
					success:function(data){
						$("#inline1").html(data);
						
						$( ".modalbox1" ).on( "click", function() {
						});
						$( ".modalbox1" ).trigger( "click" );
					}
				});				
			},
		});		
	});
	function convert(str) {
	
    var date = new Date(str),
        mnth = ("0" + (date.getMonth()+1)).slice(-2),
        day  = ("0" + date.getDate()).slice(-2);
		var d1=[ date.getFullYear(), mnth, day].join("/");
		
		var d2=[date.getHours(),date.getMinutes(),date.getSeconds()].join(":");
		
    return d1+' '+d2;
	}

	function convert_date(str) {
	
    var date = new Date(str),
        mnth = ("0" + (date.getMonth()+1)).slice(-2),
        day  = ("0" + date.getDate()).slice(-2);
		var d1=[ date.getFullYear(), mnth, day].join("-");				
    return d1;
}

	function eventHover(event_id){
		document.getElementById(event_id).style.display = "block";
	}
	
	function eventOut(event_id){
		document.getElementById(event_id).style.display = "none";		
	}
	
	function eventHoverW(event_id){
		document.getElementById('w_'+event_id).style.display = "block";
	}
	
	function eventOutW(event_id){
		document.getElementById('w_'+event_id).style.display = "none";		
	}
	
	function deleteSchedule(event_id)
	{		
		if(confirm('Do really Want to Delete this schedule ?')){
			window.location.href = '<?php echo site_url("scheduler/deleteSchedule/");?>'+'/'+event_id;			
		}
		else{
			
		}			
	}

function getStaff()
{
	$.ajax({
			url:"<?php echo site_url("scheduler/getStaff");?>",
			cache:false,
			data:"count="+event.title,
			success:function(data){
				$("#inline1").html(data);
			}			
		});
}

</script>
<style>

	/*body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}*/

	#calendar {
		width: 900px;
		/*margin: 0 auto;*/
		}
	#holder{ display:none;}
</style>
<script type="text/javascript">
function holiday(day){
	if(day=="no" || day=="holiday"){
		document.getElementById('holiday_div').style.display = 'block';
		document.getElementById('gvUserInfo').style.display = 'none';
	}
	else{
		document.getElementById('holiday_div').style.display = 'none';
		document.getElementById('gvUserInfo').style.display = 'block';
	}
}

</script>
</head>
<body>

<div id="new_holder"></div>
<div id="inline"  style="display:none;">
	<h2>Schedule</h2>

	<form method="post" action="<?php echo site_url("scheduler/add_scheduler");?>" id="addSchedule" name="addSchedule">
<div class="aspNetHidden">
</div>
    <div style="margin-left: 5%;">
        <div id="topRow">
            <input type="hidden" name="event_date" id="event_date" value=""/>
			<input type="hidden" name="end_date" id="end_date" value=""/>
			<input type="hidden" name="allDay" id="allDay" value=""/>
            
          <!--  <select name="shift" id="shift" style="margin-left: 10px;" required>
				<?php foreach($shifts as $shift){?>
				<option value="<?php echo $shift->id;?>"><?php echo $shift->shift_name;?></option>
				<?php }?>
				

			</select>-->
           
        </div>
        <div id="schdulerContint">
            <div>
            <table cellspacing="0" rules="" border="0" id="" style="border-collapse:collapse;">    	
       <td>Holidays : </td>
       <td><select name="holidays" id="holidays" onChange="holiday(this.value);">
                	<option value="workingday">Working Day</option>
                    <option value="holiday">Holiday</option>
                    <option value="no">No Working Day</option>
                </select>
       </td> 
</table>
<table cellspacing="0" rules="" border="0" id="holiday_div" style="border-collapse:collapse; display:none;">    	
        	<td>Name :</td>
            <td><input type="text" name="holiday_name" value=""/></td>
</table>       
	<table cellspacing="0" rules="" border="0" id="gvUserInfo" style="border-collapse:collapse;">    	
        
        
        <tr>
        	<td>Patient Name :</td>
            <td>
	           	<select name="patient_name" id="patient_name">                	
                 
				<?php foreach($patients as $patient){?>
				<option value="<?php echo $patient->patient_id;?>"><?php echo $patient->given_name.' '.$patient->sur_name;?></option>
				<?php }?>
                </select>                
            </td>
        </tr>
        <tr>
        	<td>Time In :</td>
            <td>
	           	<input type="text" value="" name="schedule_time_in" id="schedule_time_in" />
                <script type="text/javascript">
				$(function(){
					$('#schedule_time_in').timepicker();
				});
				</script>
            </td>
        </tr>
        <tr>
        	<td>Time Out :</td>
            <td>
	           	<input type="text" value="" name="schedule_time_out" id="schedule_time_out" />
                <script type="text/javascript">
				$(function(){
					$('#schedule_time_out').timepicker();
				});
				</script>
            </td>
        </tr>
        <tr>
        	<td>Reminder :</td>
            <td>
	           	<select name="reminder" id="reminder">
                	<option value="seven_days">7 Days</option>
                    <option value="two_days">2 Days</option>
                    <option value="cancel_reminder">Cancel Reminder</option>
                </select>                
            </td>
        </tr>
        <tr>
        	<td>Staff :</td>
            <td>
				
	           	<select name="staff_name" id="staff_name">
                	
				<?php foreach($staff1 as $s){
					?>
				<option value="<?php echo $s->user_id;?>"><?php echo $s->user_fullname.' '.$s->user_name;?></option>
				<?php }?>
                </select>                
            </td>
        </tr>
		<tr>
        	<td>Status :</td>
            <td>				
	           	<select name="status" id="status">
					 <option selected='' value="">Select</option>                
                    <option value="present">Present</option>
                    <option value="dropout">Dop Out</option>
                    <option value="noschedule">No Schedule</option>
                </select>                
            </td>
        </tr>        
		<tr style="color:#fafafa;background-color:#fafafa;font-weight:bold;">
			<th scope="col">Machine No</th>
			<th scope="col">Machine Description</th>
			<th scope="col">Patient Name</th>
			<th scope="col">Injection</th>
			<th scope="col">Injection Qty</th>
			<th scope="col">Status</th>
		</tr>			
	</table>
    <table>
	    <tr>
			<td colspan="2"><input type="submit" name="save" value="Save" id="save" Class="form-save" style="margin-left: 0px; margin-top: 0px;" /></td>
		</tr>
    </table>
</div>

        </div>
    </div>
    </form>
</div>
<div id="inline1" style="display:none;">
	<h2>Delete Schedule</h2>
</div>
<p><a class="modalbox" href="#inline" style="display:none;">click to open</a></p>
<p><a class="modalbox1" href="#inline1" style="display:none;">click to open</a></p>
<a href="#" id="csv_file" style="display:none"></a>
<a href="#" id="ical_file" style="display:none"></a>
<div id='calendar'></div><br />
<div id="button_save">
<div id="export_csv"><input type="button" name="export_csv" value="Export CSV" onClick="exportCsv()" style="cursor:pointer;">
<input type="button" name="export_csv" value="Export iCal" onClick="exportIcal()" style="cursor:pointer;"></div>
</div>
</body>
</html>

		
	</div>
</div>
<script language="javascript">
function exportCsv()
{
	 $.blockUI({ 
            message: '<span>Please Wait CSV File is in Process..!!</span>'
       }); 
	$.ajax({
		url:"<?php echo site_url("scheduler/create_csv");?>",
		cache:false,
		success:function(data){
			
			$("#csv_file").attr("href","<?php echo base_url();?>/csv_files/"+data);
   			/* $.fileDownload($("#csv_file").prop('href'), {
       			 preparingMessageHtml: "We are preparing your report, please wait...",
       			 failMessageHtml: "There was a problem generating your report, please try again."
   			 });*/
			 
			 $.fileDownload($("#csv_file").prop('href'));
			 $.unblockUI();
  
		}
	});
}

function exportIcal()
{
	 $.blockUI({ 
            message: '<span>Please Wait iCal File is in Process..!!</span>'
       }); 
	$.ajax({
		url:"<?php echo site_url("scheduler/create_ical");?>",
		cache:false,
		success:function(data){
			
			$("#ical_file").attr("href","<?php echo base_url();?>/ical_files/"+data);
   			/* $.fileDownload($("#csv_file").prop('href'), {
       			 preparingMessageHtml: "We are preparing your report, please wait...",
       			 failMessageHtml: "There was a problem generating your report, please try again."
   			 });*/
			 
			 $.fileDownload($("#ical_file").prop('href'));
			 $.unblockUI();
  
		}
	});
}
</script>
</div>
