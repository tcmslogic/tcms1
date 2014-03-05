<?php 
$currentpage = $this->uri->segment(2);
$patient_id = base64_encode($patient_id);
?>

<div class="leftpanel">
	<div class="left-menu">
          <ul class="nav-tabs nav-stacked"> 
              <li  <?php if($currentpage=='patient_profile'){?> class="active"<?php }?>><a href="<?php echo site_url('patient/patient_profile/'.$patient_id); ?>"><span class="iconfa-Profile"></span>Patient Profile</a></li>
              <li <?php if($currentpage=='patient_attendance'){?> class="active"<?php }?>><a href="<?php echo site_url('patient/patient_attendance/'.$patient_id); ?>"><span class="iconfa-Profile"></span>Patient Attendance</a></li>
              
              <li <?php if($currentpage=='notes' || $currentpage=='add_note' || $currentpage=='edit_note'){?> class="active"<?php }?>><a href="<?php echo site_url('patient/notes/'.$patient_id); ?>"><span class="iconfa-treatment"></span>Treatment Notes</a></li>
              <li <?php if($currentpage=='referral' || $currentpage=='add_referral' || $currentpage=='edit_referral'){?> class="active"<?php }?>><a href="<?php echo site_url('patient/referral/'.$patient_id); ?>"><span class="iconfa-referral"></span>Referral</a></li>
              <li <?php if($currentpage=='certificate' || $currentpage=='add_certificate' || $currentpage=='edit_certificate'){?> class="active"<?php }?>><a href="<?php echo site_url('patient/certificate/'.$patient_id); ?>"><span class="iconfa-certificate"></span>Medical Certificate/Memo</a></li>
              <li <?php if($currentpage=='prescription' || $currentpage=='add_prescription' || $currentpage=='edit_prescription'){?> class="active"<?php }?>><a href="<?php echo site_url('patient/prescription/'.$patient_id); ?>"><span class="iconfa-certificate"></span>Prescription</a></li>
          </ul>
   </div>
</div>
          
<?php /*?><div id="Patient_Profile">
 <ul>

    <li <?php if($currentpage=='patient_profile'){?> class="active"<?php }?>><a href="<?php echo site_url('patient/patient_profile/'.$patient_id); ?>">Patient Profile</a></li>
    <li <?php if($currentpage=='patient_attendance'){?> class="active"<?php }?>><a href="<?php echo site_url('patient/patient_attendance/'.$patient_id); ?>">Patient Attendance</a></li>
    <li <?php if($currentpage=='notes' || $currentpage=='add_note' || $currentpage=='edit_note'){?> class="active"<?php }?>><a href="<?php echo site_url('patient/notes/'.$patient_id); ?>">Treatment Notes</a></li>
    <li <?php if($currentpage=='referral' || $currentpage=='add_referral' || $currentpage=='edit_referral'){?> class="active"<?php }?>><a href="<?php echo site_url('patient/referral/'.$patient_id); ?>">Referral</a></li>
    <li <?php if($currentpage=='certificate' || $currentpage=='add_certificate' || $currentpage=='edit_certificate'){?> class="active"<?php }?>><a href="<?php echo site_url('patient/certificate/'.$patient_id); ?>">Medical Certificate/Memo</a></li>
        <li <?php if($currentpage=='prescription' || $currentpage=='add_prescription' || $currentpage=='edit_prescription'){?> class="active"<?php }?>><a href="<?php echo site_url('patient/prescription/'.$patient_id); ?>">Prescription</a></li>
    
 </ul>
 </div><?php */?>
