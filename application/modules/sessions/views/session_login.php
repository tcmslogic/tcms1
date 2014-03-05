<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Traditional Chinese Medicine System</title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style-new.css">
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/default/js/libs/jquery-1.7.1.min.js"></script>

<script type="text/javascript">
	$(function() { $('#email').focus(); });
</script>
</head>

<body> 

<div id="content_login">
 	<div id="login_magring">
    	<div id="login">
        	<div id="login_logo">
            	<a href="#"><img src="<?php echo base_url("assets/default/images/logo_login.jpg");?>" /></a>
 				<span>Welcome To TCMS </span>
 			</div>
 <div id="admin_login"><div id="logic_text"><span>Login</span></div><div class="R-boxed" id="submitForm">
  
   <form id="LoginForm" class="form-horizontal" method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">
        <fieldset>
            <div class="field">
                <label for="email">Email</label>
               <input type="text" name="email" id="email" placeholder="<?php echo lang('email'); ?>" title="Please enter your Email address" autofocus="autofocus" autocomplete="off">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" title="Please enter your Xero password" placeholder="<?php echo lang('password'); ?>" autocomplete="off">
            </div>
        </fieldset>

        <div class="actions">
            <input type="submit" class="R-btn blue main" name="btn_login" id="submitButton"  value="<?php echo lang('login'); ?>" class="btn btn-primary">
        </div>
    </form>
    
    
</div></div>
<div id="login_buttom"><img src="<?php echo base_url("assets/default/images/login_buttom.png");?>" /> </div>
 
 </div></div></div>
 
 <div id="login_footer"> <div id="l_footer"><div class="footer_left">
                    <p class="onLeft"><input type="checkbox" value="loginkeeping" id="loginkeeping" name="loginkeeping">
                        
                         <a href="#">for your Remember my login on this computer </a>
                    </p>

                    <p class="onRight"><a href="#">Forgot your password?</a>  </p>
                </div></div></div>
 
 



 <?php /*?><div class="R-header">
            <div class="inner">
                
                    <h1 style="margin:0;"><a class="logo" href="#"><span class="hidden"> <img src="<?php echo base_url("uploads/logo.png");?>" /></span></h1>
                
            </div>
        </div>
 <div class="content">
            <div class="inner">
                <div class="document clear" id="contentTop">
                    

    <h2 class="R-boxed noBorder">Welcome To Renal EMR </h2>

    

 
<div id="browserErrorPanel"></div>

<div class="R-boxed" id="submitForm">
   <form id="LoginForm" class="form-horizontal" method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">
   
        <fieldset>
            <div class="field">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="<?php echo lang('email'); ?>" title="Please enter your Email address" autofocus="autofocus" autocomplete="off">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" title="Please enter your Xero password" placeholder="<?php echo lang('password'); ?>" autocomplete="off">
            </div>
        </fieldset>

        <div class="actions">
            <!--<a class="R-btn blue main" id="submitButton" href="#">Login</a>-->
            <input type="submit" class="R-btn blue main" name="btn_login" id="submitButton"  value="<?php echo lang('login'); ?>" class="btn btn-primary">
        </div>
    </form>
    
    
</div>
<!--<div id="Admin_Login"><div id="admin_left"><span><img src="<?php echo base_url("assets/default/images/admin_icon.png");?>" /></span><div id="admin_text">Admin Login</div></div>
<div id="Our_right"><div id="admin_left"><span><img src="<?php echo base_url("assets/default/images/Sattf.png");?>" /></span><div id="admin_text"><div id="our_sattf">Our Staff Login</div> <span><img src="<?php echo base_url("assets/default/images/push17x15.png");?>" /></span></div></div></div>

</div>-->
 
           
<div class="R-footer">
    <div class="footer_left">
        <p class="onLeft"><input type="checkbox" value="loginkeeping" id="loginkeeping" name="loginkeeping">
           
            <a href="#" style="color:#73c0de;"> <b>Remember my login on this computer</b> </a>
        </p>

        <p class="onRight"><a href="#" style="color:#73c0de;"><b>Forgot your password?</b></a>  </p>
    </div>
</div>
    

     

    </div>


</div>
</div>

   
</div><?php */?>
</body>
</html>
