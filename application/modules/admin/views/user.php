<script type="text/javascript">

function passwordValidation(){

	var newPassword = document.getElementById('new_password').value;
	var confirmPassword = document.getElementById('confirm_password').value

	if(newPassword==confirmPassword){ return true; }
	else if(newPassword == "" && confirmPassword !=""){ alert('Please enter new password'); return false; }
	else if(newPassword != ""){ if(confirmPassword == ""){ alert('Please enter Confirm password'); return false; }else{ return true; } }
	else if(confirmPassword == ""){ alert('Please enter confirm password'); return false; }
	else{ alert("Password doesnot match"); return false; }
}

function checkOldPassword(){
	var oldPassword = document.getElementById('old_password').value;	
	var email = document.getElementById('email_edit').value;	

	window.location.href = "http://192.168.2.109/renal/index.php/admin/checkPass?password="+oldPassword+"&email="+email;
}

function formSubmition(){
	
	var form_url = document.getElementById('form_action').value;
	//var image = document.getElementById('image_edit').files[0];
	//alert(image);

	//alert(document.getElementById('new_password').value);
	//alert(document.getElementById('confirm_password').value);

	if(document.getElementById('user_fullname_edit').value == ""){ alert("Please enter username"); }
	else if(document.getElementById('user_name_edit').value == ""){ alert("Please enter name"); }
	else if(document.getElementById('email_edit').value == ""){ alert("Please enter email"); }	
	else{
		/*alert(document.getElementById('new_password').value);
		alert(document.getElementById('confirm_password').value);*/
		if(document.getElementById('new_password').value == "" && document.getElementById('confirm_password').value == ""){
		window.location.href = form_url+"?fullname="+document.getElementById('user_fullname_edit').value+
				"&username="+document.getElementById('user_name_edit').value+
				"&email="+document.getElementById('email_edit').value+
				"&user_type="+document.getElementById('user_type_edit').value+				
				"&password="+document.getElementById('confirm_password').value+
				"&uid="+document.getElementById('user_id').value;					
		}
		else if(passwordValidation()){
		window.location.href = form_url+"?fullname="+document.getElementById('user_fullname_edit').value+
				"&username="+document.getElementById('user_name_edit').value+
				"&email="+document.getElementById('email_edit').value+
				"&user_type="+document.getElementById('user_type_edit').value+				
				"&password="+document.getElementById('confirm_password').value+
				"&uid="+document.getElementById('user_id').value;
		}
		else{}
	}
}

function checkEmail(email){
	//alert(email);
	$.ajax({
		type:'post',
		url:"admin/check_email_available?uemail="+email,
		//dataType:"json",
		success: function(data){
				//alert(data);
				$('#success_email').html('<span style="color:red;">'+data+'</span>');
			}
		});
	
}
	
function checkuser(uname){
	$.ajax({
		type:'post',
		url:"admin/check_user_available",
		data:'uname='+uname,
		dataType:"json",
		success: function(data){
				//alert(data);
				$('#success_msg').html('<span style=color:'+data.color+'>'+data.string+'</span>');
				if(data.color=='red'){
					$('#save').attr('disabled', true);
				}else{
					$('#save').removeAttr('disabled', false);
				}
			}
		});
}

	

	$(document).ready(function() {
		
		
		//paging
		var total_record = $("#total_record").val();
		var per_page = $("#per_page").val();
		//alert(total_record);
		pagination(total_record,per_page);
		//end
		
		$("#inline").css("display","none");
		$(".modalbox").fancybox();

		/*$( ".modalbox" ).click(function() {
			$( "#inline" ).show( "slow", function() {
			// Animation complete.
			});
		});	
		$( "#close" ).click(function() {
			$( "#inline" ).hide( "slow", function() {
			// Animation complete.
			});
		});*/
		
		/*$("#form").submit(function() { return false; });
		$("#Save").on("click", function(){
				alert('ddd');	
				$.ajax({
					type: 'POST',
					url: 'admin/user',
					data: $("#form").serialize(),
					success: function(data) {
						if(data == "success") {
							$("#form").fadeOut("fast", function(){
								$(this).before("<p><strong>Success! Machine Detail has been saved.</strong></p>");
								setTimeout("$.fancybox.close()", 1000);
								location.reload();
							});
						}
					}
				});
			
		});*/
//Delete
		$(document).on('click','.delall,.delrow',function(e){
	var id;
	if($(this).hasClass('delall')) {
		e.preventDefault();
		id = $('.selrow:checked').map(function(){
				return $(this).val();
			}).get();
	} else {
		id = $(this).parents('tr').find('input:hidden').val();
		
	}
	if($('.selrow:checked').length == 0 && $(this).hasClass('delall')) {
		alert('Please select atleast one row');
	} else if(confirm('Do you really want to delete')) {
		
					table='users';
				$.ajax({
					type: 'POST',
					url: 'admin/delete_user',
					data: {
        'id': id,
        'table': table
    },
					success: function(data) {
					
						if(data == "true") {
							location.reload();
						}
					}
				});
			
		
	}
	e.stopImmediatePropagation();});

// Update
		$(document).on('click','.updrow',function(e){
	$(this).hide();
	$tr = $(this).parents('tr');
	$tr.addClass('modified');
	$tr.css('background-color','#686C70');
	$tr.find('span').each(function(){
		$(this).hide(function(){
			if($(this).attr('class') == 'user_type')
			{
				//alert($(this).text());
				
				$(this).after('<select name="'+$(this).attr('class')+'" id="usertype"><option value="Admin">Admin</option><option value="Manager1">Manager1</option><option value="Reception">Reception</option><option value="Doctor">Doctor</option><option value="Nurse">Nurse</option></select>');
			$('#usertype option[value='+$(this).text()+']').attr('selected','selected');
			}
			else
			{
			$(this).after('<input name="'+$(this).attr('class')+'" value="'+$(this).text()+'" maxlength="35"/>');
			}
			
		});
		
	});
	return false;
	//e.stopImmediatePropagation();
	

	
});


//Save
	
	$(document).on('click','html',function(e){
	if(! $(e.target).is(':input')) {
		savedata();
	}
	e.stopImmediatePropagation();


	/*$(".modalbox_edit").click(function(){ 
//	  	var userId = document.getElementById().value();
		
		alert("adsfa");	 	
	});*/
});
	function savedata() {
	if($('.modified').length > 0) {
		$('.modified').each(function(e){
			$tr = $(this);
			$tr.find('input:text').hide();
			$tr.find('select').hide();
			//$.post('admin/machine?'+$tr.find(':input').serialize()+'&action=update',function() {});
			$.ajax({
					type: 'POST',
					url: 'user',
					data: $tr.find(':input','select').serialize(),
					success: function(data) {
					
						if(data == "success") {
							location.reload();
						}
					}
				});
			$tr.find('span').show(function(){
				$(this).text($(this).next('input').val()).next('input').remove();
				
				$(this).text($(this).next('select').val()).next('select').remove();
			
			});
			$tr.css('background-color','#F5E6DA').removeClass('modified').find('.updrow').show();
		});
	}
}

$('#checkall').click(function() {
		
		if($('#checkall').is(':checked')==true)
		{
			//$(".selrow").attr("checked","checked");
			$("input:checkbox").prop('checked', true)
			//$(".selrow").attr("checked","checked"); 
		}
		else
		{	
			$("input:checkbox").prop('checked', false)
		//	$(".selrow").removeAttr("checked");
		}
	});
	});
	
	function get_edit_user(uid){
		//alert(uid);
		//$( ".modalbox" ).trigger( "click" );
		
		//$.fancybox('<div>Hitesh ID==>'+uid+'</div>');
		
		$.ajax({
			/*type:"POST",
			url:"<?php echo site_url("admin/edit_user");?>/uid="+uid,*/
			type:'post',
			url:"admin/edit_user",
			data:'uid='+uid,
			//dataType:"json",
			success:function(data){
				//alert(data.user_fullname);
				$.fancybox(data);
			}
		});	
		
	}
	
</script>

<div id="Clinica_right">


<div id="breadcrumbs">
       <div class="patient_text"><h2>Admin : User Details</h2></div>
</div>


<div id="Patient_table">
  <div id="Personal_Details">
  	<div id="car_button">
     <ul>
     	<li><a href="<?php echo site_url('admin/company'); ?>">Company</a></li>
     	<li><a href="<?php echo site_url('admin/user'); ?>">User Management</a></li>
     	<li><a href="<?php echo site_url('admin/Shift'); ?>">Email Account</a></li>
     </ul></div>

<div class="one_wrap"><div class="widget">
           
          <div class="widget_body"  id="holder">
    <input type="hidden" name="total_record" id="total_record" value="<?php echo count($data);?>" />
    <input type="hidden" name="per_page" id="per_page" value="5" />
		<table class="activity_datatable" width="100%"   border="0" cellspacing="0" cellpadding="8" style="width:100%;">
            <tbody>
            <tr>
                <th align="left" style="padding-left:0px !important;"><input type="checkbox" name="checkall" id="checkall"/></th>
                <th align="left">Username</th>
                <th align="left">Full Name</th>
                <th align="left">User type</th>
                <th align="left">Status</th>
                <th align="left">Action</th>
            </tr>
            
            <?php 
            if(count($data)>0){
            for($i=0;$i<count($data);$i++){?>
            
            <tr>
                <td align="left" style="padding-left:0px !important;"><input name="checkbox[]" type="checkbox" class="selrow" id="checkbox[]" value="<? echo $data[$i]->user_id; ?>">
                <input type="hidden" value="<? echo $data[$i]->user_id; ?>" name="id" /></td>
                <td align="left"><span class="user_name"><?php echo $data[$i]->user_name; ?></span></td>
                <td align="left"><span class="user_fullname"><?php echo ucwords($data[$i]->user_fullname); ?></span></td>
                <td align="left"><span class="user_type"><?php echo $data[$i]->user_type; ?></span></td>
                <td align="left"><span class="status"><?php echo ($data[$i]->status==1)?'Active':'inActive'; ?></span></td>
                <td align="left"><a  class="delrow" >Delete</a> | <a class="modalbox_edit" href="javascript:void(0);" onclick="return get_edit_user(<?php echo $data[$i]->user_id; ?>);">Edit</a></td>
            </tr>
            <?php }
            }
            else{?>
            	<tr><td colspan="5" align="center">No Record Found</td></tr>
            <?php } ?>
            </tbody>
       </table>
       <div id="paginationtable" style="margin: auto;"></div>
	</div>
		
         <div id="button_save">
        	<div id="save"><a class="delall" href="#inline">Delete</a></div>
        	<div id="button_Cancel"><a class="modalbox" href="#inline">Add New User</a></div>
      	</div>
		
        
        <div id="inline" style="display:none">
            <h2>Add New User</h2>
        
            <form id="form" name="form" action="<?php echo site_url("admin/user");?>"  method="post" enctype="multipart/form-data">
           
            
                <label for="machine_no">Full Name.</label>
                <input type="text" id="user_fullname" name="user_fullname" class="txt" value="<?php //echo @$data[0]->Machine_no; ?>">
                <br>
                <label for="machine_name">Username</label>
                <input type="text" id="user_name" name="user_name" class="txt" onblur="return checkuser(this.value);" value="<?php //echo //@$data[0]->Machine_name; ?>">
                <div id="success_msg"></div>	
                <br>
		<label for="machine_name">User Email</label>
                <input type="text" id="user_email" name="user_email" class="txt" value="<?php //echo //@$data[0]->Machine_name; ?>">
                <div id="success_msg"></div>	
                <br>
                <label for="machine_type">Password</label>
                <input type="password" id="user_password" name="user_password" class="txt" value="<?php //echo //@$data[0]->Machine_type; ?>">
                <br>
                <label for="machine_cost">User type</label>
                <select name="user_type">
                <option value="Admin" >Admin</option>
                <option value="Clerk">Admin Clerk</option>
                <option value="Doctor">Doctor</option>
                </select>
                <br>
                 
                <label for="machine_cost">Status</label>
                <select name="status">
                <option value="1" >Active</option>
                <option value="0">inActive</option>
                </select>
                <br>
                <label>Photo</label>
                <input required type="file" name="image" id="image" />
                <br/>
                <br/>
                <!--<button id="Save">Save</button>-->
                <input type="submit" name="save" id="save" value="save" />
                <!--<a href="#" id="close">cancel</a>-->
            </form>
        </div>
        
        <div id="inline_edit" style="display:none">
            <h2>Edit User</h2>
        
            <form id="form" name="form" action="<?php echo site_url("admin/user");?>"  method="post" enctype="multipart/form-data">
           
            
                <label for="machine_no">Full Name</label>
                <input type="text" id="user_fullname" name="user_fullname" class="txt" value="<?php //echo @$data[0]->Machine_no; ?>">
                <br>
                <label for="machine_name">Username</label>
                <input type="text" id="user_name" name="user_name" class="txt" onblur="return checkuser(this.value);" value="<?php //echo //@$data[0]->Machine_name; ?>">
                <div id="success_msg"></div>	
                <br>
				 <label for="machine_name">User Email</label>
                <input type="text" id="email" name="email" class="txt" value="<?php //echo //@$data[0]->Machine_name; ?>">
                <div id="success_msg"></div>	
                <br>
                <label for="machine_type">Password</label>
                <input type="password" id="user_password" name="user_password" class="txt" value="<?php //echo //@$data[0]->Machine_type; ?>">
                <br>
                <label for="machine_cost">User type</label>
                <select name="user_type">
                <option value="Admin" >Admin</option>
                <option value="Manager1">Manager1</option>
                <option value="Manager2">Manager2</option>
                <option value="Reception">Reception</option>
                <option value="Doctor">Doctor</option>
                <option value="Nurses">Nurses</option>
                </select>
                <br>
                <select name="status">
                <option value="1" >Active</option>
                <option value="0">inActive</option>
                </select>
                <br>
                <label>Photo</label>
                <input required type="file" name="image" id="image" />
                <br/>
                <br/>
                <!--<button id="Save">Save</button>-->
                <input type="submit" name="save" id="save" value="save" />
                <!--<a href="#" id="close">cancel</a>-->
            </form>
        </div>
        
        
   </div> 
  </div>
</div>  

        


</div>




	






