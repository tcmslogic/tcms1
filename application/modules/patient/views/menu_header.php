<div class="row-fluid">

    <table cellspacing="10" cellpadding="10">
		<?php $patient_id=(isset($patient_id))?$patient_id:"";?>
		<tr><td><a href="<?php echo site_url('patient/patient_profile/'.$patient_id); ?>">Patient Profile</a> </td>
		<td><a href="<?php echo site_url('patient/patient_attendance/'.$patient_id); ?>">Patient Attendance</a> </td>
		<td><a href="<?php echo site_url('patient/patient_financial_profile/'.$patient_id); ?>">Patient Financial Profile</a> </td>
		<td><a href="<?php echo site_url('patient/notes/'.$patient_id); ?>">Notes</a> </td>
		<td><a href="<?php echo site_url('patient/admission_data/'.$patient_id); ?>">Admission Data</a> </td>
	</tr>

</table>
</div>