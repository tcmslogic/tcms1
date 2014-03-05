<?php 
$currentpage = $this->uri->segment(2);
?>

<div class="leftpanel">
	<div class="left-menu">
          <ul class="nav-tabs nav-stacked"> 
              <li <?php echo ($currentpage=='index')?'class="active"':''; ?> ><a href="<?Php echo SITE_URL('report/index'); ?>"><span class="iconfa-Profile"></span>Patient Report</a></li>
              <li <?php echo ($currentpage=='appointment')?'class="active"':''; ?>><a href="<?Php echo SITE_URL('report/appointment'); ?>"><span class="iconfa-Profile"></span>Appointment Report</a></li>
               <li <?php echo ($currentpage=='transaction')?'class="active"':''; ?>><a href="<?Php echo SITE_URL('report/transaction'); ?>"><span class="iconfa-Profile"></span>Transaction Report</a></li>
          
          </ul>
   </div>
</div>