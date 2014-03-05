<style type="text/css">
#Contact-Details .file
{
	width:170px;
	font-size:12px !important;
}
</style>
<script language="javascript">
 $(document).ready(function(){
			// binds form submission and fields to the validation engine
			$("#add_note").validationEngine();
	});

</script>
<?php include_once('patient_list.php');?>
<div class="right-panel">
 <div id="Profile_right">
     

<div id="breadcrumbs">
     <div class="patient_text"><h2>Add Note</h2></div>                     
</div>  
  <?php //$sql="select * from `patient_notes` where `id`='".$note_id."'";
		//$res=$this->db->query($sql);
		//$result=$res->result();

		 //echo "<pre>";print_r($note_details); 
		  
		//echo "<pre>";print_r($result);exit;
		 ?> 
<div class="one_wrap"><div class="widget_note">
           
          <div class="widget_body">	
		<form name="add_note" id="add_note" action="<?php echo site_url("patient/add_note");?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient_id;?>">
  <div id="Treatment">
            <div id="Contact-title"><h5>Treatment/Dosage Description </h5></div>
            
            <div id="Profile_Details">
             <ul>
             <li>
            <div class="stdform">
            <textarea class="text-input" name="Description" id="assessment" cols="107" rows="10"></textarea></div>
            </li>
            </ul>
            
             </div>
             </div>
             
  <div id="remarks">
            <div id="Contact-title"><h5>Remarks </h5></div>
            
            <div id="Profile_Details">
             <ul>
             <li>
            <div class="stdform">
            <textarea class="text-input" name="Remarks" id="treatment" cols="107" rows="10"/></textarea></div>
            </li>
            </ul>
            
             </div>
             </div>
             
             
             <div id="browes">
            
             <div id="Contact-title"><h5> Images </h5></div>
      
             <div class="gallery">
			 <ul class="row">
			 <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img1"></div></li>                                       
			 <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img2"></div></li>             
			 <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img3"></div></li>            
			 <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img4"></div></li>             
			 <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img5"></div></li>             
			 <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img6"></div></li>             
             <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img7"></div></li>            
             <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img8"></div></li>             
             <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img9"></div></li>
             <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img10"></div></li>            
			  </ul>
             </div>                                                     
             </div>           
             </div>
             </div>
             </div>		    
        <div id="button_save">
	        <div id="submit"><input type="submit" id="submit_btn" value="Submit" name="submit"></div>
            <div id="button_Cancel"><a href="<?php echo site_url('patient/notes/'.$patient_id); ?>">Cancel</a></div>            
        </div>
	
        </form>
        
        
</div>
</div>

 

