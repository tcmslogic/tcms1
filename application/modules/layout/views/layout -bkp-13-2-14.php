<!doctype html>


<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]--><head>

		<meta charset="utf-8">

		<!-- Use the .htaccess and remove these lines to avoid edge case issues -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Traditional Chinese Medicine System</title>
		<meta name="description" content="">
		<meta name="author" content="William G. Rivera">

		<meta name="viewport" content="width=device-width,initial-scale=1">
		<script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-1.7.1.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url(); ?>assets/default/js/smartpaginator.js"></script>
        <script src="<?php echo base_url(); ?>assets/default/js/jquery.idTabs.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>highslide/highslide-with-html.js"></script>
       
       <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style123.css">-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>highslide/highslide.css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/template.css" type="text/css"/>
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>highslide/highslide.css" />
        
         
		 <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		 <script src="<?php echo base_url(); ?>assets/default/js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/jquery.fancybox.css?v=2.1.5" />



<script type="text/javascript">
	hs.graphicsDir = '<?php echo base_url(); ?>highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.wrapperClassName = 'draggable-header';
</script>

<script type="text/javascript">

/*function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}​*/

function pagination(total,per_page){
	//alert(total);
	//var pages=2;
	//if(per_page!="" && per_page<=10)
	//{
		//pages=per_page;
	//}
	
	/*$('#paginationtable').smartpaginator({ totalrecords: total, recordsperpage: 5, datacontainer: 'rounded_corner',dataelement: 'tr',length: 10,initval: 1,next: 'Next', prev: 'Prev',first: 'First',last: 'Last',theme: 'green'});*/
	
	$('#paginationtable').smartpaginator({ totalrecords: total, recordsperpage: 50, datacontainer: 'page_table',dataelement: 'tr',length: 3,initval: 1,next: 'Next', prev: 'Prev',first: 'First',last: 'Last',theme: 'green'});
}
</script>

<script type="text/javascript">
$(document).ready(function() {
	$(".markingdotcross").mouseover(function(e) {
		//alert('test');
		//alert($(this).parent().html());	
		var topx = $(this).css("left");
		var lefty = $(this).css("top");
		var hideinputid = "img_"+topx+lefty;
		//alert(hideinputid);
		//var imgid = $(this).css("id");
		//alert($(this).css("top"));
		var action = confirm("Are you Want to Remove Mark?");
		//alert(action);
		if(action==true){
			//alert('dddd');
			$(this).css('display','none');
			$("#"+hideinputid).attr('name','mark')	
		}else{
			//alert('ggggg');	
		}	
	});
	
	/*$(".markingdotcross").mouseout(function(e) {
		alert('test123');
		$this.html('');	
	});*/
	
	$("#container").click(function(e) {
	//$("#container").live( "click", function() {	
		e.preventDefault();
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var marking = $('.marking input[type="radio"]:checked').val();
		if(marking=='marko' || marking=='markx'){
		var img = $('<img>');
			img.css('top', y);
			img.css('left', x);
			img.addClass('markingdotcross');
			img.attr('src', '<?php echo base_url(); ?>assets/default/img/'+marking+'.png');
			img.appendTo('#container');
			$('#container').append('<input id="img_'+x+'px'+y+'px" type="hidden" name="mark[]" value="'+x+'|'+y+'|'+marking+'" data-xdata="'+x+'" data-ydata="'+y+'" />');
			 //$(".markingdotcross").trigger('mouseover');	
		}else{
			alert('select Mark O or X');
		}
	});
});
</script>
	
</head>

<body>
<div id="bg_color">
  <div id="top_site">
    <div id="logo"><a href="<?php echo site_url('dashboard'); ?>"><img src="<?php echo base_url("uploads/logo.png");?>"></a></div>
    <div id="login">
      <div id="left_we"><strong>&nbsp;&nbsp;<span style="color:#1950bf" id="username1">
	  					<?php echo lang('welcome') . ' ' . ucfirst($this->session->userdata('user_name')); ?>,</span></strong> Account</div>
      <div id="right_lo">
        <!--<input type="submit" class="btnLogOut" id="LogOut" value="Logout" name="ctl00$LogOut">-->
     	<a href="<?php echo site_url('sessions/logout'); ?>" class="btnLogOut" data-original-title="<?php echo lang('logout'); ?>" data-placement="bottom">Logout</a>
      </div>
    </div>
    <?php $currentpage = $this->uri->segment(1);?>
	<?php
			$level1=array('Doctor','Nurses','Admin');
			
			$level3=array('Nurses','Admin','Reception');
			$level2=array('Manager1','Admin','Reception'); 
			
			//echo $this->session->userdata("user_type");
			//var_dump(in_array($this->session->userdata("user_type"),$level2));exit;
	?>
    <div id="menu">
      <ul>
	 
        <li <?php if($currentpage=='dashboard'){?> class="active"<?php }?>><?php echo anchor('dashboard', lang('dashboard')); ?></li>
        <li <?php if($currentpage=='patient'){?> class="active"<?php }?>><a href="<?php echo site_url('patient'); ?>"> Patient </a></li>
		<?php if(in_array($this->session->userdata("user_type"),$level3)){?>
        <li <?php if($currentpage=='scheduler'){?> class="active"<?php }?>><a href="<?php echo site_url('scheduler'); ?>"> Scheduler </a></li>
		<?php }?>
		<?php if(!in_array($this->session->userdata("user_type"),array('Reception','Doctor','Nurses'))){?>
        <li <?php if($currentpage=='reports'){?> class="active"<?php }?>><a href="<?php echo site_url("reports");?>">Reports</a></li>
		<?php }?>
        <?php if(!in_array($this->session->userdata("user_type"),array('Reception','Doctor','Nurses'))){?>
        <li <?php if($currentpage=='reports'){?> class="active"<?php }?>><a href="<?php echo site_url("reports");?>">Invoice</a></li>
		<?php }?>
		<?php if($this->session->userdata("user_type")=='Admin'){?>
        <li <?php if($currentpage=='admin'){?> class="active"<?php }?>><a href="<?php echo site_url('admin'); ?>"> Admin </a></li>
			<?php }?>
		
      </ul>
    </div>
  </div>
</div>
<div id="bg-main">
    <div id="wer">
        <!--<div id="left_panel">-->
		<?php echo $content; ?>
        <!--</div>-->
    </div>
</div>
<div id="bg_main_bottom"></div>

		
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/default/js/jquery.mousewheel-3.0.6.pack.js"></script>
 <script src="<?php echo base_url(); ?>assets/default/js/jquery.fancybox.js?v=2.1.5"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	
	<link href='<?php echo base_url(); ?>assets/default/css/calander/fullcalendar.css' rel='stylesheet' />
	<link href='<?php echo base_url(); ?>assets/default/css/calander/fullcalendar.print.css' rel='stylesheet' media='print' />

<script src='<?php echo base_url(); ?>assets/default/js/calander/jquery-ui.custom.min.js'></script>
<script src='<?php echo base_url(); ?>assets/default/js/calander/fullcalendar.js'></script>

</body>
</html>