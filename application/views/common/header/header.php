<style type="text/css">
@media print {
#logo img {
	content: url(<?php echo base_url('uploads/companylogo/'.$company[0]->company_logo) ?>);
}

}
</style>


<div id="header">
  <table cellpadding="0" cellspacing="0">
    <tr>
      <td><table>
          <tr>
            <td style="width:10%;vertical-align:top;" >
            <div id="logo" style="width:100px;height:100px;display:block;">
            <img src="<?php echo base_url('uploads/companylogo/'.$company[0]->company_logo) ?>" style="width:131px;height:61px;float:left;" /> 
            </div>
            <td style="vertical-align:top;"><h3 style="color:#375B91;font-size:25px;float:left;margin-bottom:0px;margin-top:2%;line-height:25px;"><?php echo $company[0]->company_name; ?></h3><br>
              <span style="float: left;clear:left;line-height:25px;"><?php echo $company[0]->pddress ; ?></span><br>
              <span style="float: left;clear:left;line-height:25px;">Tel&nbsp;:&nbsp;<?php echo $company[0]->phone  ; ?></span></td>
        </table></td>
        </td>
        </td>
    </tr>
  </table>
</div>
