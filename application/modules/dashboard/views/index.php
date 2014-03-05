<script language="javascript">
$(document).ready(function () {
	$("#usual2 ul").idTabs("tabs2"); 
	
	var total_record = $("#total_record").val();
	var per_page = $("#per_page").val();
	//alert(total_record);
	pagination(total_record,per_page);
});
</script>
 <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
  
<script type="text/javascript"> 
$(document).ready(function () {
	// $("#usual2 ul").idTabs("tabs2");
	 $("#Staff_Duty ul").idTabs("tabs1");  
}); 
	 
</script> 
  
<!------------------------for user group vise chart----------------------------->

<?php 
$cuser = $this->session->userdata("user_id");
$cuser_type = $this->session->userdata("user_type");
?>
<div id="left_panel">

<!--<div style="float:left; width:100%;">
<h4>Search:</h4>
<div id="search_filter">
<div class="VS-search">
  <div class="VS-search-box-wrapper VS-search-box">
 
    <div class="VS-icon VS-icon-search"></div>
   
    <div class="VS-search-inner">
      <div class="search_input ui-menu not_selected not_editing">
     
<input type="text" style="z-index: auto; width: 500px;border:0;box-shadow:none;" autocomplete="off" placeholder="Search Patient" name="search" class="ui-menu ui-autocomplete-input" id="search" onkeyup="getFilter()"/>

         
      </div>
    </div>
    
  </div>
</div>
</div>
</div>-->




<div id="breadcrumbs">
          <div class="patient_text"><h2>Notice board</h2></div>
         <?php if($cuser_type=='Admin'){?> <div id="right_button">
          
          <a href="<?php echo site_url('dashboard/add_notice'); ?>"><span class="iconfa-add"></span>Post a message</a></div>
          </div> <?php }?> 	
  

<div class="fluid">
 <?php foreach($message as $notice){?>         
          <div id="page_table">
          
         
          
          <div class="widget grid6">                                 
                <ul class="messagesOne">
                 <li class="divider"><h6><?php echo $notice->title;?></h6></li>
                    <li class="by_user">
                    <div id="Posted">Posted by  <?php echo $this->mdl_dashboard->user_type($notice->created_by); ?> on <?php echo date("j M Y, g:i a", strtotime($notice->created_date)); ?></div>
                        <?php if($cuser_type=='Admin'){?>
                        	<a href="javascript:void(0);" onclick="deletePost(<?php echo $notice->id; ?>)">Delete</a>
                            <script language="javascript">
							  function deletePost(id){
								  var temp = confirm("Are you sure want to delete this post ?");
								  if(temp){
									window.location.href = '<?php echo site_url("dashboard/deleteRecords/");?>'+'/'+id;  
									alert('Post has been deleted successfully');
								  }
								  else{
									  //alert('There is some problem with your delete link');
								  }
							  }
						  </script>
						<?php }?> 
                        <div class="messageArea">
                            <span class="aro"></span>
                            <div class="infoRow">
                                <span class="name"><strong><?php echo $this->mdl_dashboard->user_type($notice->created_by); ?></strong> says:</span>
                                <!--<span class="time">3 hours ago</span>-->
                            </div>
                            <p><?php echo nl2br($notice->content);?></p>
                        </div>
                    </li>                                                        
                </ul>
            </div></div>
<?php } ?>                        
            </div> 


<div id="paginationtable" style="margin: auto;"></div>



</div>  

 <div id="right_patient">
          <div id="Patient_Statistics"><div id="Patient_text"><h5>Patient Statistics</h5></div>
          <div id="Patient_conten">
        <ul>
          <?php $present = $this->mdl_patient->getPatientStatistics('present');?>
          <?php $dropout = $this->mdl_patient->getPatientStatistics('dropout');?>
          <?php $noschedule = $this->mdl_patient->getPatientStatistics('noschedule');?>
          <li>
            <div id="Patients_number"><?php echo $present[0]->countp;?></div>
            <div id="Patients_number">Patients Present</div>
          </li>
		  
		                 <li>
                <div id="Patients_number"><?php echo $dropout[0]->countp;?></div> 
                    <div id="Patients_number">Patients Drop Out</div>
              </li>
                      <li>
                <div id="Patients_number"><?php echo $noschedule[0]->countp;?></div> 
                    <div id="Patients_number">Patients No Follow Up(nosched)</div>
              </li>                                    
        </ul>
      </div>
          </div>
          
          <div id="Patient_Statistics"><div id="Patient_text"><h5>Appoitment Reminder</h5></div>
          <div id="Patient_conten">
        <ul>
		<?php $appointment_reminder = $this->mdl_patient->getAptNextDshbrd($cuser);?>
        <?php if(isset($appointment_reminder)){foreach($appointment_reminder as $reminder){ if($reminder->sur_name=="" && $reminder->given_name==""){ ?>
         <li>         
            <div id="Patients_number"></div>
            <div id="Patients_number">No Appoitment</div>
          </li>	
		<?php break; }else{?> 
          <li>         
            <div id="Patients_number"><?php echo date("d/m",strtotime($reminder->start_date)); ?></div>
            <div id="Patients_number"><?php echo ucfirst($reminder->sur_name)." ".ucfirst($reminder->given_name); ?></div>
          </li>
         <?php }}}else{?> 
          <li>         
          	<div id="Patients_number"></div>
            <div id="Patients_number">No Appoitment</div>
          </li>  
		 <?php } ?>                                        
        </ul>
      </div>
          </div>                                        
          </div>         
  </div>
