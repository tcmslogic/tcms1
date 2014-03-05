// JavaScript Document
function login_validate(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	var user_name = document.fmLogin.userName.value;
	var password = document.fmLogin.password.value;
	if(user_name=="")
	{
			document.getElementById('bug').innerHTML='&nbsp;<img src= "'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter User Name</b></span>';
			document.fmLogin.userName.focus();
		return false;
	} else {
		document.getElementById('bug').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(password=="")
	{
			document.getElementById('bug1').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Password</b></span>';
			document.fmLogin.password.focus();
		return false;
	} else {
		document.getElementById('bug1').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	return true;
}

function checkall_fun()
{
	var p=document.frmPage;
	len=p.elements.length;
	if((document.frmPage.check_all.checked==true) )
	{
		var i=0;
		for(i=0; i<len; i++) {
			if (p.elements[i].name=='Ids[]')
				p.elements[i].checked=1;
		}
	}
	if((document.frmPage.check_all.checked==false) )
	{
		var i=0;
		for(i=0; i<len; i++) {
			if (p.elements[i].name=='Ids[]')
		   		p.elements[i].checked=0;
		}
	}
}	



function blockUser(id,action)
{
		var string;
	if(action=="1"){string="Block";}else{string="Unblocked";}
	if(confirm("Are you sure Want to "+string+" this User?")) {
		FormName		= document.frmPage;
		FormName.hdnAction.value=action;
		FormName.hdnSingleId.value=id;
		FormName.submit();
	}
}

function setStatusGroup(action)
{
	ptr=document.frmPage;
	len=ptr.elements.length;
	var i=0,j=0;
	for(i=0; i<len; i++) {
		if (ptr.elements[i].name=='Ids[]')	{	
			if(ptr.elements[i].checked==true)	   
			{
				j=j+1;	
				val=ptr.elements[i].value; 
		   	}
		}
	}
	if(j==0){	
		alert("Select Atleast One Checkbox");	
		return false;	
	}
	
	if(confirm("Are you sure Want to "+action+" the selected Items?")) {
		FormName		= document.frmPage;
		FormName.hdnAction.value = action;
		FormName.submit();	
	}
}

function edit() {
	
	ptr=document.frmPage;
	len=ptr.elements.length;
	var i=0,j=0;
	for(i=0; i<len; i++) {
		if (ptr.elements[i].name=='Ids[]')	{	
			if(ptr.elements[i].checked==true)	   
			{
				j=j+1;	
				val=ptr.elements[i].value; 
		   	}
		}
	}
	if(j==0){	
		alert("Select Atleast One Checkbox");	
		return false;	
	}
	if(j>1)	{	
		alert("Pls Edit Only One Item!");	
		return false;	
	}

	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Edit';
	FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}


function validate_admin(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	var email = document.frmPage.email.value;
	var password = document.frmPage.password.value;
	var confirm_password = document.frmPage.confirmPassword.value;
	var confirm_new_password = document.frmPage.confirmNewPassword.value;

	if(email=="")
	{
			document.getElementById('bug').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Your Email Id</b></span>';
			document.frmPage.email.focus();
		return false;
	} else if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.frmPage.email.value))) {
		document.getElementById('bug').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Enter Valid Email Id</b></span>';
		document.frmPage.email.focus();
		return false;
	}else {
		document.getElementById('bug').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(password!="") {
		if(confirm_password=="")
		{
			document.getElementById('bug2').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter New Password</b></span>';
			document.frmPage.confirmPassword.focus();
			return false;
		} else if(confirm_password != confirm_new_password) {
			document.getElementById('bug3').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Confirm Password mismatches</b></span>';
			document.frmPage.confirmNewPassword.focus();
			document.getElementById('bug2').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
			return false;
		}else {
			document.getElementById('bug2').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
			document.getElementById('bug3').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}	
	 }
	
	
	FormName		= document.frmPage;
	FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

function validate_cell_phone(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var carrier = document.frmPage.carrier.value;
	var cellphone_name = document.frmPage.cellPhoneName.value;
	var cellphone_image = document.frmPage.cellPhoneImage.value;
	
	var broken = document.frmPage.broken.value;
	var good = document.frmPage.good.value;
	var flawless = document.frmPage.flawless.value;
	
	if(carrier=="")
	{
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Carrier</b></span>';
		document.frmPage.carrier.focus();
		return false; 
	}else {
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(cellphone_name=="")
	{
		document.getElementById('bug_cellPhoneName').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Cell Phone Name</b></span>';
		document.frmPage.cellPhoneName.focus();
		return false;
	}else {
		document.getElementById('bug_cellPhoneName').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	
	if(cellphone_image=="")
	{
		document.getElementById('bug_cellPhoneImage').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Cell Phone Image</b></span>';
		document.frmPage.cellPhoneImage.focus();
		return false;
	}else {
		var ext = cellphone_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.cellPhoneImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_cellPhoneImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
	}
	
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken!</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good!</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless!</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Add';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

function validate_cellphone_update(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var carrier = document.frmPage.carrier.value;
	var cellphone_name = document.frmPage.cellPhoneName.value;
	var cellphone_image = document.frmPage.cellPhoneImage.value;
	
	var broken_wd_yes = document.frmPage.brokenWdYes.value;
	var broken_wd_no = document.frmPage.brokenWdNo.value;
	
	var good_wd_yes = document.frmPage.goodWdYes.value;
	var good_wd_no = document.frmPage.goodWdNo.value;
	
	var flawless_wd_yes = document.frmPage.flawlessWdYes.value;
	var flawless_wd_no = document.frmPage.flawlessWdNo.value;

	if(carrier=="")
	{
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Carrier</b></span>';
		document.frmPage.carrier.focus();
		return false; 
	}else {
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(cellphone_name=="")
	{
		document.getElementById('bug_cellPhoneName').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Cell Phone Name</b></span>';
		document.frmPage.cellPhoneName.focus();
		return false;
	}else {
		document.getElementById('bug_cellPhoneName').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	
	if(cellphone_image!="")
	{
		var ext = cellphone_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.cellPhoneImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_cellPhoneImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
		
	}else {
		document.getElementById('bug_cellPhoneImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	
	if(broken_wd_yes=="")
	{
		document.getElementById('bug_brokenWdYes').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken with Water Damage working..</b></span>';
		document.frmPage.brokenWdYes.focus();
		return false;
	}else {
		document.getElementById('bug_brokenWdYes').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(broken_wd_no=="")
	{
		document.getElementById('bug_brokenWdNo').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken with Water Damage Not available..</b></span>';
		document.frmPage.brokenWdNo.focus();
		return false;
	}else {
		document.getElementById('bug_brokenWdNo').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	
	if(good_wd_yes=="")
	{
		document.getElementById('bug_goodWdYes').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good with Water Damage working..</b></span>';
		document.frmPage.goodWdYes.focus();
		return false;
	}else {
		document.getElementById('bug_goodWdYes').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(good_wd_no=="")
	{
		document.getElementById('bug_goodWdNo').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good with Water Damage Not available..</b></span>';
		document.frmPage.goodWdNo.focus();
		return false;
	}else {
		document.getElementById('bug_goodWdNo').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	
	if(flawless_wd_yes=="")
	{
		document.getElementById('bug_flawlessWdYes').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless with Water Damage working..</b></span>';
		document.frmPage.flawlessWdYes.focus();
		return false;
	}else {
		document.getElementById('bug_flawlessWdYes').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(flawless_wd_no=="")
	{
		document.getElementById('bug_flawlessWdNo').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless with Water Damage not available..</b></span>';
		document.frmPage.flawlessWdNo.focus();
		return false;
	}else {
		document.getElementById('bug_flawlessWdNo').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Update';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}


function validate_ipad(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var carrier = document.frmPage.carrier.value;
	var memory = document.frmPage.memory.value;
	var conn = document.frmPage.conn.value;
	var ipad_image = document.frmPage.iPadImage.value;
	
	var broken = document.frmPage.broken.value;
	var good = document.frmPage.good.value;
	var flawless = document.frmPage.flawless.value;

	if(carrier=="")
	{
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Carrier</b></span>';
		document.frmPage.carrier.focus();
		return false; 
	}else {
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(memory=="")
	{
		document.getElementById('bug_memory').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a memory storage</b></span>';
		document.frmPage.memory.focus();
		return false;
	}else {
		document.getElementById('bug_memory').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	if(conn=="")
	{
		document.getElementById('bug_conn').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Connectivity</b></span>';
		document.frmPage.conn.focus();
		return false;
	}else {
		document.getElementById('bug_conn').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(ipad_image=="")
	{
		document.getElementById('bug_iPadImage').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select an iPad Image</b></span>';
		document.frmPage.iPadImage.focus();
		return false;
	}else {
		var ext = ipad_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.iPadImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_iPadImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
	}
	
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good.</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
		
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless.</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Add';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

function validate_ipad_update(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var carrier = document.frmPage.carrier.value;
	var memory = document.frmPage.memory.value;
	var conn = document.frmPage.conn.value;
	var ipad_image = document.frmPage.iPadImage.value;
	
	var broken = document.frmPage.broken.value;
	var good = document.frmPage.good.value;
	var flawless = document.frmPage.flawless.value;

	if(carrier=="")
	{
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Carrier</b></span>';
		document.frmPage.carrier.focus();
		return false; 
	}else {
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(memory=="")
	{
		document.getElementById('bug_memory').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a memory storage</b></span>';
		document.frmPage.memory.focus();
		return false;
	}else {
		document.getElementById('bug_memory').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	if(conn=="")
	{
		document.getElementById('bug_conn').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Connectivity</b></span>';
		document.frmPage.conn.focus();
		return false;
	}else {
		document.getElementById('bug_conn').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	if(ipad_image!="")
	{
		
		var ext = ipad_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.iPadImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_iPadImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
	}
	
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good.</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
		
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless.</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Update';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

function validate_tablet(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var carrier = document.frmPage.carrier.value;
	var tablet_name = document.frmPage.tabletName.value;
	var tablet_image = document.frmPage.tabletImage.value;
	
	var broken = document.frmPage.broken.value;
	var good = document.frmPage.good.value;
	var flawless = document.frmPage.flawless.value;
	
	if(carrier=="")
	{
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Carrier</b></span>';
		document.frmPage.carrier.focus();
		return false; 
	}else {
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(tablet_name=="")
	{
		document.getElementById('bug_tabletName').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Tablet Name</b></span>';
		document.frmPage.tabletName.focus();
		return false;
	}else {
		document.getElementById('bug_tabletName').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	
	if(tablet_image=="")
	{
		document.getElementById('bug_tabletImage').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select an iPad Image</b></span>';
		document.frmPage.tabletImage.focus();
		return false;
	}else {
		var ext = tablet_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.tabletImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_tabletImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
	}
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good.</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless.</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Add';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

function validate_tablet_update(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var carrier = document.frmPage.carrier.value;
	var tablet_name = document.frmPage.tabletName.value;
	var tablet_image = document.frmPage.tabletImage.value;
	
	var broken = document.frmPage.broken.value;
	var good = document.frmPage.good.value;
	var flawless = document.frmPage.flawless.value;
	
	if(carrier=="")
	{
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Carrier</b></span>';
		document.frmPage.carrier.focus();
		return false; 
	}else {
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(tablet_name=="")
	{
		document.getElementById('bug_tabletName').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Tablet Name</b></span>';
		document.frmPage.tabletName.focus();
		return false;
	}else {
		document.getElementById('bug_tabletName').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	
	if(tablet_image!="")
	{
		var ext = tablet_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.tabletImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_tabletImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
	}
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good.</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless.</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Update';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

function validate_ipod(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var carrier = document.frmPage.carrier.value;
	var memory = document.frmPage.memory.value;
	var ipod_image = document.frmPage.iPodImage.value;
	
	var engraving = document.frmPage.engraving.value;
	
	var broken = document.frmPage.broken.value;
	var good = document.frmPage.good.value;	
	var flawless = document.frmPage.flawless.value;
	
	if(carrier=="")
	{
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Carrier</b></span>';
		document.frmPage.carrier.focus();
		return false; 
	}else {
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(memory=="")
	{
		document.getElementById('bug_memory').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select Memory Storage</b></span>';
		document.frmPage.memory.focus();
		return false;
	}else {
		document.getElementById('bug_memory').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	
	if(ipod_image=="")
	{
		document.getElementById('bug_iPodImage').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Cell Phone Image</b></span>';
		document.frmPage.iPodImage.focus();
		return false;
	}else {
		var ext = ipod_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.iPodImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_iPodImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
	}
	
	if(engraving=="")
	{
		document.getElementById('bug_engraving').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for engraving not available</b></span>';
		document.frmPage.engraving.focus();
		return false;
	}else {
		document.getElementById('bug_engraving').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken.</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good.</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless.</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Add';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

function validate_ipod_update(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var carrier = document.frmPage.carrier.value;
	var memory = document.frmPage.memory.value;
	var ipod_image = document.frmPage.iPodImage.value;
	
	var engraving = document.frmPage.engraving.value;
	
	var broken = document.frmPage.broken.value;
	var good = document.frmPage.good.value;	
	var flawless = document.frmPage.flawless.value;

	if(carrier=="")
	{
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Carrier</b></span>';
		document.frmPage.carrier.focus();
		return false; 
	}else {
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	
	if(memory=="")
	{
		document.getElementById('bug_memory').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select Memory Storage</b></span>';
		document.frmPage.memory.focus();
		return false;
	}else {
		document.getElementById('bug_memory').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	
	if(ipod_image!="")
	{
		var ext = ipod_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.iPodImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_iPodImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
	}
	
	if(engraving=="")
	{
		document.getElementById('bug_engraving').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for engraving not available</b></span>';
		document.frmPage.engraving.focus();
		return false;
	}else {
		document.getElementById('bug_engraving').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken.</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good.</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless.</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Update';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}


function validate_tv(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var tv_name = document.frmPage.atvName.value;
	var tv_image = document.frmPage.atvImage.value;
	
	var broken = document.frmPage.broken.value;
	var good = document.frmPage.good.value;
	var flawless = document.frmPage.flawless.value;
	var power_cord = document.frmPage.powerCord.value;
	var remote_control = document.frmPage.remoteControl.value;
	
	if(tv_name=="")
	{
		document.getElementById('bug_atvName').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter TV Name</b></span>';
		document.frmPage.atvName.focus();
		return false;
	}else {
		document.getElementById('bug_atvName').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	
	if(tv_image=="")
	{
		document.getElementById('bug_atvImage').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select an Apple TV Image</b></span>';
		document.frmPage.atvImage.focus();
		return false;
	}else {
		var ext = tv_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.atvImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_atvImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
	}
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good.</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless.</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	
	if(power_cord=="")
	{
		document.getElementById('bug_powerCord').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Power Cord.</b></span>';
		document.frmPage.powerCord.focus();
		return false;
	}else {
		document.getElementById('bug_powerCord').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(remote_control=="")
	{
		document.getElementById('bug_remoteControl').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Remote Control.</b></span>';
		document.frmPage.remoteControl.focus();
		return false;
	}else {
		document.getElementById('bug_remoteControl').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Add';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

function validate_tv_update(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var tv_name = document.frmPage.atvName.value;
	var tv_image = document.frmPage.atvImage.value;
	
	var broken = document.frmPage.broken.value;
	var good = document.frmPage.good.value;
	var flawless = document.frmPage.flawless.value;
	var power_cord = document.frmPage.powerCord.value;
	var remote_control = document.frmPage.remoteControl.value;
	
	if(tv_name=="")
	{
		document.getElementById('bug_atvName').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter TV Name</b></span>';
		document.frmPage.atvName.focus();
		return false;
	}else {
		document.getElementById('bug_atvName').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	
	if(tv_image!="")
	{
		var ext = tv_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.atvImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_atvImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
	}
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good.</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless.</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	
	if(power_cord=="")
	{
		document.getElementById('bug_powerCord').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Power Cord.</b></span>';
		document.frmPage.powerCord.focus();
		return false;
	}else {
		document.getElementById('bug_powerCord').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(remote_control=="")
	{
		document.getElementById('bug_remoteControl').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Remote Control.</b></span>';
		document.frmPage.remoteControl.focus();
		return false;
	}else {
		document.getElementById('bug_remoteControl').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Update';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}


function validate_display(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var display_name = document.frmPage.displayName.value;
	var display_image = document.frmPage.displayImage.value;
	
	var broken = document.frmPage.broken.value;
	var fair = document.frmPage.fair.value;
	var good = document.frmPage.good.value;
	var flawless = document.frmPage.flawless.value;
	var power_cord = document.frmPage.powerCord.value;
	
	if(display_name=="")
	{
		document.getElementById('bug_displayName').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Apple Display Name</b></span>';
		document.frmPage.displayName.focus();
		return false;
	}else {
		document.getElementById('bug_displayName').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	
	if(display_image=="")
	{
		document.getElementById('bug_displayImage').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select an Apple Display Image</b></span>';
		document.frmPage.displayImage.focus();
		return false;
	}else {
		var ext = display_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.displayImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_displayImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
	}
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	if(fair=="")
	{
		document.getElementById('bug_fair').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Fair</b></span>';
		document.frmPage.fair.focus();
		return false;
	}else {
		document.getElementById('bug_fair').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good.</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless.</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	
	if(power_cord=="")
	{
		document.getElementById('bug_powerCord').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Power Cord.</b></span>';
		document.frmPage.powerCord.focus();
		return false;
	}else {
		document.getElementById('bug_powerCord').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Add';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

function validate_display_update(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var display_name = document.frmPage.displayName.value;
	var display_image = document.frmPage.displayImage.value;
	
	var broken = document.frmPage.broken.value;
	var fair = document.frmPage.fair.value;
	var good = document.frmPage.good.value;
	var flawless = document.frmPage.flawless.value;
	var power_cord = document.frmPage.powerCord.value;
	
	if(display_name=="")
	{
		document.getElementById('bug_displayName').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Apple Display Name</b></span>';
		document.frmPage.displayName.focus();
		return false;
	}else {
		document.getElementById('bug_displayName').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	
	if(display_image!="")
	{
		var ext = display_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.displayImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_displayImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
	}
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	if(fair=="")
	{
		document.getElementById('bug_fair').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Fair</b></span>';
		document.frmPage.fair.focus();
		return false;
	}else {
		document.getElementById('bug_fair').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good.</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless.</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	
	if(power_cord=="")
	{
		document.getElementById('bug_powerCord').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Power Cord.</b></span>';
		document.frmPage.powerCord.focus();
		return false;
	}else {
		document.getElementById('bug_powerCord').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Update';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

function validate_cms(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Update';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

function validate_iphone(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var carrier = document.frmPage.carrier.value;
	var memory = document.frmPage.memory.value;
	var cellphone_image = document.frmPage.cellPhoneImage.value;
	
	var broken = document.frmPage.broken.value;
	var good = document.frmPage.good.value;
	var flawless = document.frmPage.flawless.value;
	

	if(carrier=="")
	{
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Carrier</b></span>';
		document.frmPage.carrier.focus();
		return false; 
	}else {
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(memory=="")
	{
		document.getElementById('bug_memory').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Memory Storage</b></span>';
		document.frmPage.cellPhoneName.focus();
		return false;
	}else {
		document.getElementById('bug_memory').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	
	if(cellphone_image=="")
	{
		document.getElementById('bug_cellPhoneImage').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Cell Phone Image</b></span>';
		document.frmPage.cellPhoneImage.focus();
		return false;
	}else {
		var ext = cellphone_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.cellPhoneImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_cellPhoneImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
	}
	
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken..</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good..</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless..</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Add';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

function validate_iphone_update(baseUrl) {
	var warningImg = baseUrl+"warning.gif";
	var okImg = baseUrl+"ok.png";
	
	var carrier = document.frmPage.carrier.value;
	var memory = document.frmPage.memory.value;
	var cellphone_image = document.frmPage.cellPhoneImage.value;
	
	var broken = document.frmPage.broken.value;
	var good = document.frmPage.good.value;
	var flawless = document.frmPage.flawless.value;
	
	if(carrier=="")
	{
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select a Carrier</b></span>';
		document.frmPage.carrier.focus();
		return false; 
	}else {
		document.getElementById('bug_carrier').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(memory=="")
	{
		document.getElementById('bug_memory').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Select Memory Storage</b></span>';
		document.frmPage.memory.focus();
		return false;
	}else {
		document.getElementById('bug_memory').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}	
	
	
	if(cellphone_image!="")
	{
		var ext = cellphone_image;
		var ext1=ext.split(".");
		var ext=ext1[ext1.length-1];
		var ext = ext.toLowerCase();
		if(ext!= 'gif' && ext!= 'jpg' && ext!= 'bmp' && ext!= 'png'&& ext!= 'jpeg') {
			alert('You must select an image file. Ending with .gif or .jpg or .bmp or .png or .jpeg');
			document.frmPage.cellPhoneImage.focus();
			return false;
	 	}else {
			document.getElementById('bug_cellPhoneImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
		}
		
	}else {
		document.getElementById('bug_cellPhoneImage').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	
	if(broken=="")
	{
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Broken..</b></span>';
		document.frmPage.broken.focus();
		return false;
	}else {
		document.getElementById('bug_broken').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(good=="")
	{
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Good..</b></span>';
		document.frmPage.good.focus();
		return false;
	}else {
		document.getElementById('bug_good').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}
	
	if(flawless=="")
	{
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+warningImg+'" width="14" height="14"><span style=text-decoration:blink class="gre13text" ><b>Please Enter Price for Flawless..</b></span>';
		document.frmPage.flawless.focus();
		return false;
	}else {
		document.getElementById('bug_flawless').innerHTML='&nbsp;<img src="'+okImg+'" width="14" height="14">';
	}

	
	FormName		= document.frmPage;
	FormName.hdnAction.value = 'Update';
	//FormName.action	= FormName.hdnEditAction.value;
	FormName.submit();	
}

