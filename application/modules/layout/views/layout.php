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
		<meta name="author" content="Traditional Chinese Medicine System">

		<meta name="viewport" content="width=device-width,initial-scale=1">
        <script src="<?php echo base_url(); ?>assets/default/js/html2canvas.js">></script>
		<script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-1.7.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url(); ?>assets/default/js/smartpaginator.js"></script>
        <script src="<?php echo base_url(); ?>assets/default/js/jquery.idTabs.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/default/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/default/js/jquery.min.js"></script>
	<!--Load Script and Stylesheet -->
	<script src="<?php echo base_url(); ?>assets/default/js/jquery1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/default/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/default/js/lodash.underscore.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/jqueryui-multisearch.min.js"></script>
	<link type="text/css" href="<?php echo base_url(); ?>assets/default/css/jquery.simple-dtpicker.css" rel="stylesheet" />

        <script type="text/javascript" src="<?php echo base_url(); ?>highslide/highslide-with-html.js"></script>
       
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/calendar.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style-new.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>highslide/highslide.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/js/jquery-ui.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/template.css" type="text/css"/>
   	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/bootstrap-datetimepicker.min.css" type="text/css"/>
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>highslide/highslide.css" />
	 <link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>assets/default/css/jquery-ui-timepicker-addon.css" />
        
         
		
		  <script src="<?php echo base_url(); ?>assets/default/js/jquery-ui.js"></script>
		
		 
		 <script src="<?php echo base_url(); ?>assets/default/js/jquery-ui-timepicker-addon.js" type="text/javascript" charset="utf-8"></script>
		 <script src="<?php echo base_url(); ?>assets/default/js/jquery.downloader.js" type="text/javascript" charset="utf-8"></script>
		 <script src="<?php echo base_url(); ?>assets/default/js/blockui.js" type="text/javascript" charset="utf-8"></script>
		
		 
		 
		 <script src="<?php echo base_url(); ?>assets/default/js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/jquery.fancybox.css?v=2.1.5" />



<script type="text/javascript">
	hs.graphicsDir = '<?php echo base_url(); ?>highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.wrapperClassName = 'draggable-header';
</script>

<script type="text/javascript">

function pagination(total,per_page){
	//$('#paginationtable').smartpaginator({ totalrecords: total, recordsperpage: 50, datacontainer: 'page_table',dataelement: 'tr',length: 3,initval: 1,next: 'Next', prev: 'Prev',first: 'First',last: 'Last',theme: 'green'});
}
</script>

<script type="text/javascript">

function goToByScroll(id){
    // Scroll
    $('html,body').animate({
        scrollTop: $("#"+id).offset().top},
        'slow');
}

$(document).ready(function() {
	//$(".markingdotcross").mouseover(function(e) {
	$(".markingdotcross").click(function(e) {	
		var marking = $('.marking input[type="radio"]:checked').val();
		var topx = $(this).css("left");
		var lefty = $(this).css("top");
		var hideinputid = "img_"+topx+lefty;
		if(marking=='removemark'){
			var action = confirm("Are you Want to Remove Mark?");
			if(action==true){
				$(this).css('display','none');
				$("#"+hideinputid).attr('name','marking');
				return false;		
			}else{
				//alert('ggggg');
				return false;		
			}
		}
	});
	
	/*$(".markingdotcross").mouseout(function(e) {
		alert('test123');
		$this.html('');	
	});*/
	
	$("#container").click(function(e) {
	//$("#container").live( "click", function() {	
	//$("#container").on( "click", function(e) {
		e.preventDefault();
		var imgcount = 1;
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var marking = $('.marking input[type="radio"]:checked').val();
		if(marking=='marko' || marking=='markx'){
		var img = $('<img>');
			img.css('top', y);
			img.css('left', x);
			img.addClass('markingdotcross'+x+y);
			img.attr('src', '<?php echo base_url(); ?>assets/default/img/'+marking+'.png');
			img.appendTo('#container');
			$('#container').append('<input id="img_'+x+'px'+y+'px" type="hidden" name="mark[]" value="'+x+'|'+y+'|'+marking+'" data-xdata="'+x+'" data-ydata="'+y+'" />');
			 setTimeout(function(){imgcount=0},2000);
			 //$(".markingdotcross"+x+y).on( "mouseover", function(e) {
			 $(".markingdotcross"+x+y).on( "click", function(e) {	 
				e.preventDefault();
				if(imgcount==0){
					var remarking = $('.marking input[type="radio"]:checked').val();
					if(remarking=='removemark'){
						var topx = $(this).css("left");
						var lefty = $(this).css("top");
						var hideinputid = "img_"+topx+lefty;
						var action = confirm("Are you Want to Remove Mark?");
						if(action==true){
							$(this).css('display','none');
							$("#"+hideinputid).attr('name','marking');
							return false;	
						}else{
							//alert('ggggg');
							return false;	
						}
					}
				}
			});
			 	
		}else{
			alert('select Mark O or X');
		}
	});
});
</script>
	
</head>

<body>
<div id="wer">
<div class="top-header">
          <div id="header">
          <div class="logo"><a href="@"><img src="<?php echo base_url("uploads/logo.jpg");?>" /></a></div>
          <div class="admin-right">
          <div id="admin-img"><img src="<?php echo base_url("assets/default/images/admin_icon.png");?>" /></div>
          <div id="admin-text"><span><?php echo lang('welcome') . ' ' . ucfirst($this->session->userdata('user_name')); ?>,</span>
          <div id="logout"><a href="<?php echo site_url('sessions/logout'); ?>">Logout</a></div>
          </div>
          </div>
          </div></div>
          
          <div id="menu-panel">
          <div class="nav"><ul>
          <li><a href="#"><span class="iconfa-laptop"></span><?php echo anchor('dashboard', lang('dashboard')); ?></a></li>
          <li><a href="<?php echo site_url('patient'); ?>"><span class="iconfa-Patient"></span>Patient  </a></li>
          <li><a href="<?php echo site_url('scheduler'); ?>"><span class="iconfa-scheduler"></span>Scheduler  </a></li>
          <?php if(!in_array($this->session->userdata("user_type"),array('Reception','Doctor','Nurses'))){?>
          <li><a href="<?php echo site_url("report");?>"><span class="iconfa-Reports"></span>Reports </a></li>
          <?php } ?>
          <?php if(!in_array($this->session->userdata("user_type"),array('Reception','Doctor','Nurses'))){?>
          <li><a href="<?php echo site_url("invoice");?>"><span class="iconfa-invoice"></span>Invoice </a></li>
          <?php } ?>
          <?php if($this->session->userdata("user_type")=='Admin'){?>
          <li><a href="<?php echo site_url('admin'); ?>"><span class="iconfa-admin"></span>Admin</a></li>
          <?php } ?>
          </ul>
          
          </div>
          </div>
</div>
<?php /*?><div id="bg_color">
  <div id="top_site">
    <div id="logo"><a href="<?php echo site_url('dashboard'); ?>"><img src="<?php echo base_url("uploads/logo.jpg");?>"></a></div>
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
</div><?php */?>
<div id="body-conten">
    <!--<div id="patient-panel">-->
        <!--<div id="left_panel">-->
		<?php echo $content; ?>
        <!--</div>-->
    <!--</div>-->
</div>

		
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