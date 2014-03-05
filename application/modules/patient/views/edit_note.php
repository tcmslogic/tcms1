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
     <div class="patient_text"><h2>Edit Note</h2></div>                     
</div>  
  <?php //$sql="select * from `patient_notes` where `id`='".$note_id."'";
		//$res=$this->db->query($sql);
		//$result=$res->result();

		 //echo "<pre>";print_r($note_details); 
		  
		//echo "<pre>";print_r($result);exit;
		 ?> 
<div class="one_wrap"><div class="widget_note">
           
          <div class="widget_body">	
		<form name="add_note" id="add_note" action=" " method="post" enctype="multipart/form-data">
	<input type="hidden" name="patient_id" id="patient_id" value="<?php echo $patient_id;?>">
    <input type="hidden" name="id" id="id" value="<?php echo $note_id;?>">
  <div id="Treatment">
            <div id="Contact-title"><h5>Treatment/Dosage Description </h5></div>
            
            <div id="Profile_Details">
             <ul>
             <li>
            <div class="stdform">
            <textarea rows="10" cols="107" name="Description" id="assessment" class="text-input"><?php echo $note_details[0]->Description; ?></textarea></div>
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
            <textarea rows="10" cols="107" name="Remarks" id="treatment" class="text-input"><?php echo $note_details[0]->Remarks; ?></textarea></div>
            </li>
            </ul>
            
             </div>
             </div>
             
             
             <div id="browes">
                          <input type="hidden" name="img11" class="file" id="file" value="<?php echo $note_details[0]->img1;?>"/> 
            <input type="hidden" name="img22" class="file" id="file" value="<?php echo $note_details[0]->img2;?>"/> 
            <input type="hidden" name="img33" class="file" id="file" value="<?php echo $note_details[0]->img3;?>"/> 
            <input type="hidden" name="img44" class="file" id="file" value="<?php echo $note_details[0]->img4;?>"/> 
            <input type="hidden" name="img55" class="file" id="file" value="<?php echo $note_details[0]->img5;?>"/> 
            <input type="hidden" name="img66" class="file" id="file" value="<?php echo $note_details[0]->img6;?>"/> 
            <input type="hidden" name="img77" class="file" id="file" value="<?php echo $note_details[0]->img7;?>"/> 
            <input type="hidden" name="img88" class="file" id="file" value="<?php echo $note_details[0]->img8;?>"/> 
            <input type="hidden" name="img99" class="file" id="file" value="<?php echo $note_details[0]->img9;?>"/> 
            <input type="hidden" name="img110" class="file" id="file" value="<?php echo $note_details[0]->img10;?>"/> 
             <div id="Contact-title"><h5> Images </h5></div>
      
             <div class="gallery">
			 <ul class="row">
			 <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img1"></div>
             <?php if($note_details[0]->img1!=""){ ?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/patient_thumbs_notes/<?php echo $note_details[0]->img1;?>" /></div>
	         <?php }else{?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/no-image.jpg" /></div>
             <?php } ?>
             </li>
			 <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img2"></div>
             <?php if($note_details[0]->img2!=""){ ?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/patient_thumbs_notes/<?php echo $note_details[0]->img2;?>" /></div>
             <?php }else{?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/no-image.jpg" /></div>
             <?php } ?>
             </li>
			 <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img3"></div>
             <?php if($note_details[0]->img3!=""){ ?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/patient_thumbs_notes/<?php echo $note_details[0]->img3;?>" /></div><?php }else{?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/no-image.jpg" /></div>
             <?php } ?></li>
			 <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img4"></div>
             <?php if($note_details[0]->img4!=""){ ?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/patient_thumbs_notes/<?php echo $note_details[0]->img4;?>" /></div><?php }else{?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/no-image.jpg" /></div>
             <?php } ?></li>
			 <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img5"></div>
             <?php if($note_details[0]->img5!=""){ ?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/patient_thumb_notes/<?php echo $note_details[0]->img5;?>" /></div><?php }else{?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/no-image.jpg" /></div>
             <?php } ?></li>
			 <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img6"></div>
             <?php if($note_details[0]->img6!=""){ ?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/patient_thumbs_notes/<?php echo $note_details[0]->img6;?>" /></div><?php }else{?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/no-image.jpg" /></div>
             <?php } ?></li>
             <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img7"></div>
             <?php if($note_details[0]->img7!=""){ ?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/patient_thumbs_notes/<?php echo $note_details[0]->img7;?>" /></div><?php }else{?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/no-image.jpg" /></div>
             <?php } ?></li> 
             <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img8"></div>
             <?php if($note_details[0]->img8!=""){ ?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/patient_thumbs_notes/<?php echo $note_details[0]->img8;?>" /></div><?php }else{?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/no-image.jpg" /></div>
             <?php } ?></li>
             <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img9"></div>
             <?php if($note_details[0]->img9!=""){ ?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/patient_thumbs_notes/<?php echo $note_details[0]->img9;?>" /></div><?php }else{?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/no-image.jpg" /></div>
             <?php } ?></li>
             <li class="col-md-4"><div id="borwes_text"><input type="file" class="file" name="img10"></div>
             <?php if($note_details[0]->img10!=""){ ?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/patient_thumbs_notes/<?php echo $note_details[0]->img10;?>" /></div><?php }else{?>
             <div id="ima_sow"><img style="width:100%; height: 132px; width: 167px;" src="<?php echo base_url(); ?>/uploads/no-image.jpg" /></div>
             <?php } ?></li> 
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

