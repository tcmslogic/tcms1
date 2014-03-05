<div id="Clinica_right">
    <div id="breadcrumbs">
     <div class="patient_text"><h2>Add Notice</h2></div>                     
</div> 
<div class="one_wrap">
	<div class="widget_note">           
          <div class="widget_body">
           <div id="Contact-Details">
           <div id="Contact-title">
           		<h5>Notice Information</h5>
           </div>
		   <form name="add_notice" id="add_notice" action="<?php echo site_url("dashboard/add_notice");?>" method="post" >
           <div id="Profile_Details"><ul><li><div class="gender_id">Title:</div><div class="right_gender">
			    <input required="required" type="text" id="title" name="title">               
       		</div></li>
            
       <li><div class="gender_id">Descriptoin:</div><div class="right_gender">
       <textarea required="required" name="content" id="content"></textarea>
       </div></li>                                   
        </ul></div>	
     <input type="hidden" name="created_date" id="created_date" value="<?php echo date("Y-m-d h:i:s");?>" />
     <input type="hidden" name="created_by" id="created_by" value="<?php echo $this->session->userdata("user_id");?>" />  
        <div id="button_save">
            <div id="submit"><input type="submit" name="save" value="Save" id="submit_btn" /></div>
            <div id="button_Cancel"><a href="<?php echo site_url('/dashboard');?>">Cancel</a></div>
        </div>
    </form>
    </div>  
</div>    
</div>
</div>
</div>