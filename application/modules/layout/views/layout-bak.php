<!doctype html>


<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">

		<!-- Use the .htaccess and remove these lines to avoid edge case issues -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Clinical Data</title>
		<meta name="description" content="">
		<meta name="author" content="William G. Rivera">

		<meta name="viewport" content="width=device-width,initial-scale=1">
		<script src="<?php echo base_url(); ?>assets/default/js/libs/jquery-1.7.1.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>highslide/highslide.css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="<?php echo base_url(); ?>assets/default/js/jquery.fancybox.js?v=2.0.6"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/jquery.fancybox.css" />
 <script type="text/javascript">

//validate form elements by passing 'form id' and add element class as 'check_validate' and add 'data-check'
function check_form(form_id){
	var error = false;
	var error_html = '<p class="error"></p>';
	//alert(form_id);
	$('#'+form_id+' .check_validate').each(function(){
		//alert('ddd');
		if($(this).val().length == ''){
			//alert($(this).data("check"));	
			var field_text = $(this).data("check");
			var field_id = $(this).attr("id");
			alert(field_text+' field is Required');
			//$("#error_display").append('<p>'+field_text+' field is Required</p>');
			error_html =error_html.concat('<p>'+field_text+' field is Required</p>');
			$(this).addClass('check_focus');
			$("#"+field_id).focus();
			error=true;
		}
	});
	
	if(error==true){
		$("#error_display p.error").html(error_html);
		return false;
	}else{
		$('#'+form_id).submit();		
	}	
}
//end of validate
</script>

<style>
.check_focus { border: 2px solid red; }
</style> 			
		
	</head>

	<body>

		<nav class="navbar navbar-inverse">

			<div class="navbar-inner">
            
            	<div class="container">
						<ul class="nav">
						<li><?php echo anchor('dashboard', lang('dashboard')); ?></li>
						<li><a href="<?php echo site_url('admin'); ?>"> Admin </a></li>
                        <li><a href="<?php echo site_url('patient'); ?>"> Patient </a></li>
						<li><a href="<?php echo site_url('bloodtest'); ?>"> Blood Test </a></li>
						<li><a href="<?php echo site_url('medication'); ?>"> Medication </a></li>
                        <li><a href="<?php echo site_url('clinicalchart'); ?>"> Clinical Chart </a></li>
                        </ul>
					<?php if (isset($filter_display) and $filter_display == TRUE) { ?>
					<?php $this->layout->load_view('filter/jquery_filter'); ?>
					<form class="navbar-search pull-left">
						<input type="text" class="search-query" id="filter" placeholder="<?php echo $filter_placeholder; ?>">
					</form>
					<?php } ?>

					<ul class="nav pull-right settings">
                        <li><a href="#"><?php echo lang('welcome') . ' ' . $this->session->userdata('user_name'); ?></a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="http://docs.fusioninvoice.com/1.3/" target="_blank" class="tip icon" data-original-title="Documentation" data-placement="bottom"><i class="icon-question-sign"></i></a></li>
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="#" class="tip icon dropdown-toggle" data-toggle="dropdown" data-original-title="<?php echo lang('settings'); ?>" data-placement="bottom"><i class="icon-cog"></i></a>
							<ul class="dropdown-menu">
                                <li><?php echo anchor('custom_fields/index', lang('custom_fields')); ?></li>
								<li><?php echo anchor('email_templates/index', lang('email_templates')); ?></li>
                                <li><?php echo anchor('import', lang('import_data')); ?></li>
								<li><?php echo anchor('invoice_groups/index', lang('invoice_groups')); ?></li>
                                <li><?php echo anchor('item_lookups/index', lang('item_lookups')); ?></li>
								<li><?php echo anchor('payment_methods/index', lang('payment_methods')); ?></li>
								<li><?php echo anchor('tax_rates/index', lang('tax_rates')); ?></li>
								<li><?php echo anchor('users/index', lang('user_accounts')); ?></li>
                                <li class="divider"></li>
                                <li><?php echo anchor('settings', lang('system_settings')); ?></li>
							</ul>
						</li>
						<li class="divider-vertical"></li>
						<li><a href="<?php echo site_url('sessions/logout'); ?>" class="tip icon logout" data-original-title="<?php echo lang('logout'); ?>" data-placement="bottom"><i class="icon-off"></i></a></li>
					</ul>
				
				</div>

			</div>

		</nav>

		<div class="sidebar">

		<?php $currentpage = $this->uri->segment(1);?>
			<ul>
				<li <?php if($currentpage=='dashboard'){?> class="tabactive"<?php }?>><a class="tip" data-placement="right"  data-original-title="Dashboard" href="<?php echo site_url('dashboard'); ?>"><img alt="" src="<?php echo base_url(); ?>assets/default/img/icons/dashboard24x24.png" /></a></li>
				
               
			</ul>

		</div>

		<div class="main-area">

			<div id="modal-placeholder"></div>
			
			<?php echo $content; ?>

		</div><!--end.content-->

		<!-- <script defer src="<?php echo base_url(); ?>assets/default/js/plugins.js"></script>
		<script defer src="<?php echo base_url(); ?>assets/default/js/script.js"></script>
		<script src="<?php echo base_url(); ?>assets/default/js/bootstrap-datepicker.js"></script>-->

	</body>
</html>