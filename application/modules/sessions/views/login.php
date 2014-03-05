<div id="content_login"><div id="login_magring"><div id="login"><div id="login_logo"><a href="#"><img src="images/logo_login.jpg" /></a>
 <span>Welcome To TCMS </span>
 </div>
 <div id="admin_login"><div id="logic_text"><span>Login</span></div><div class="R-boxed" id="submitForm">
  
   <form method="post" id="LoginForm" action="/"><input type="hidden" value="" style="display:none" name="fragment" id="fragment">
        <fieldset>
            <div class="field">
                <label for="email">Email</label>
                <input type="email" value="" title="Please enter your Email address" name="userName" id="email" autofocus="autofocus" autocomplete="off">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" title="Please enter your Xero password" name="password" id="password" autocomplete="off">
            </div>
        </fieldset>

        <div class="actions">
            <a class="R-btn blue main" id="submitButton" href="#">Login</a>
             
        </div>
    </form>
    
    
</div></div>
<div id="login_buttom"><img src="images/login_buttom.png" /> </div>
 
 </div></div></div>
 
 <div id="login_footer"> <div id="l_footer"><div class="footer_left">
                    <p class="onLeft"><input type="checkbox" value="loginkeeping" id="loginkeeping" name="loginkeeping">
                        
                         <a href="#">for your Remember my login on this computer </a>
                    </p>

                    <p class="onRight"><a href="#">Forgot your password?</a>  </p>
                </div></div></div>
 

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