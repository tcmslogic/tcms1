<style type="text/css">
.textboxwidht
{
	width:500px !important;
}
</style>
<div id="Clinica_right">
<div id="top_border">
  <div id="left_title">
    <h2>Admin : Company</h2>
  </div>
</div>
<div id="Patient_table">
  <div id="Personal_Details">
     
     <div id="car_button">
     <ul>
     	<li><a href="<?php echo site_url('admin/company'); ?>">Company</a></li>
     	<li><a href="<?php echo site_url('admin/user'); ?>">User Management</a></li>
     	<li><a href="<?php echo site_url('admin/Shift'); ?>">Email Account</a></li>
     </ul></div>
     
     <div id="Profile_right_admin">
   		<div id="Patient_table">
            <form id="company" method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/company') ?>" >
            <?php if($data[0]->id): ?>
            <input type="hidden" value="<?php echo $data[0]->id; ?>" name="cid" />
            <input type="hidden" value="<?php echo $data[0]->company_logo; ?>" name="logo" />
            <?php endif ?>
            <table>
            <tr><td>Company Name</td><td>:</td><td><input class="validate[required] text-input textboxwidht"  type="text" name="cname" value="<?php echo @$data[0]->company_name; ?>"  /></td></tr>
            <tr><td>Company Logo</td><td>:</td><td><input type="file" name="userfile"  /></td></tr>
            <?php if(@$data[0]->company_logo): ?>
            <tr><td>Exist Logo</td><td>:</td><td><img src="<?php echo base_url('uploads/companylogo/'.$data[0]->company_logo) ?>" style="width:100px;height:100px;" />
            <input type="hidden" name="old_logo" id="old_logo" value="<?php echo $data[0]->company_logo;?>"/></td></tr>
            <?php endif ?>
            <tr><td>Address</td><td>:</td><td><textarea  class="validate[required] text-input textboxwidht" name="address"><?php echo @$data[0]->pddress; ?></textarea></td></tr>
            <tr><td>Phone No.</td><td>:</td><td><input class="validate[required,number,min[10]] text-input textboxwidht" type="text" name="phone" id="phone" value="<?php echo @$data[0]->phone; ?>" /></td></tr>
            <tr><td>Fax No.</td><td>:</td><td><input class="validate[required,number,min[10]] text-input textboxwidht" type="text" name="fax" id="fax" value="<?php echo @$data[0]->fax; ?>" /></td></tr>
            <tr><td>Website</td><td>:</td><td><input class="validate[required,custom[url]] text-input textboxwidht" type="text" name="website" id="website" value="<?php echo @$data[0]->website; ?>" /></td></tr>
            <tr><td>Email</td><td>:</td><td><input class="validate[required,email] text-input textboxwidht" type="text" name="email" id="email" value="<?php echo @$data[0]->email; ?>" /></td></tr>
            <tr><td>Dialysis Center</td><td>:</td><td><input class="validate[required] text-input textboxwidht" type="text" name="dialysis" value="<?php echo @$data[0]->dialysis_center; ?>" /></td></tr>
            <tr><td>Location</td><td>:</td><td><input class="validate[required] text-input textboxwidht" type="text" name="location" value="<?php echo @$data[0]->location; ?>" /></td></tr>
           <!-- <tr><td><input type="submit" name="submit" value="Submit" id="submit" /></td></tr>-->
            </table>
            
           
            
            <div id="button_save">
            <div id="submit">
                 <input type="submit" name="submit" value="Submit" id="submit_btn" />
            </div>
            <div id="button_Cancel">
                <a onclick="javascipt:window.history.back()" href="#">Cancel</a>
            </div>
        </div>
            
            </form>
	 </div>

</div>
     
  </div>
   
</div>
</div>



<script language="javascript">
	$(document).ready(function(){
	// binds form submission and fields to the validation engine
		$("#company").validationEngine();
	});
</script>
