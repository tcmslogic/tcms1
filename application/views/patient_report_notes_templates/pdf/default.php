<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<style>
body {
	color: #000 !important;
	font-family: Calibri;
	font-weight: normal;
}
.content {
	width: 960px;
	margin: 0 auto;
}
table {
	width: 100%;
}
#header table {
	width: 100%;
	padding: 0px;
}
#header table td, .amount-summary td {
	vertical-align: text-top;
	padding: 5px;
}
#company-name {
	color: #000;
	font-size: 18px;
}
#invoice-to td {
	text-align: left
}
#invoice-to {
	margin-bottom: 15px;
}
#invoice-to-right-table td {
	padding-right: 5px;
	padding-left: 5px;
	text-align: right;
}
.seperator {
	height: 25px
}
.top-border {
	border-top: none;
}
.no-bottom-border {
	border: none !important;
	background-color: white !important;
}
.content {
	min-height: 500px;
	max-height: 842px;
	height: auto;
}
.table tr td {
	text-align: left;
	padding: 10px;
	font-size: 14px;
	border: 1px solid #ccc;
	background-color: #fff;
	font-family: Calibri;
}
.table tr th {
	vertical-align: top;
	font-size: 15px;
	padding: 10px;
	border: 1px solid #ccc;
	background-color: #fff;
	font-family: Calibri;
	font-weight: normal;
	text-align: left;
}
</style>
</head>

<body>
<!--<div id="bg_color" style="top:0px;padding:1%;width:80%;background:none;
margin: 0 auto;">
  <div id="top_site">
    <div id="logo"><a href="http://192.168.2.113/tcms/index.php/dashboard"><img src="http://192.168.2.113/tcms/uploads/logo.png"></a></div>   	    
  </div>
</div>--> 
<?php print_r($Header); ?>
<div class="content" style="top:0px;margin:0 auto;width:80%;">

  <div id="header" style="width:100%;float:left;margin-bottom:5px;">
    <h3 style="text-align:left;float:left;width:50%;margin-bottom:1%;"></h3>
    <h3 style="text-align:right;float:right;width:50%;">Patient Report</h3>
  </div>
  
  <!-- <div id="le_detail" style="width:50%;float:left;line-height:25px;">
    <label style="text-align:left;width:100%;float:left;">Address: <?php echo $patient_details->address;?></label><br/>  
    <label style="text-align:left;width:100%;float:left;">Email: <?php echo $patient_details->email;?></label> <br/> 
    <label style="text-align:left;width:100%;float:left;">Mobile No: <?php echo $patient_details->mobile_no;?></label>
  </div> -->
  
  <div id="invoice-items" style="margin:18px 0;float:left;width:100%;">
    <table class="table table-striped" style="width: 100%;float:left;">
      <tbody>    
        <tr>
          <th style="font-weight:bold;width: 85px;">Name</th>
          <th style="font-weight:bold;width: 85px;">Follow Up</th>
          <th style="font-weight:bold;width: 85px;">Drop Out</th>
          <th style="font-weight:bold;width: 100px;">No Follow Up</th>
        </tr>
        <?php foreach($patient_id as $patient){
			$present="present"; $dropout="dropout"; $ns="noschedule";
			 $name = $this->mdl_report->getPatientName($patient);
			?>
        <tr>
                <td><?php echo ucfirst($name->given_name)." ".ucfirst($name->sur_name); ?></td>
        		<td><?php echo $this->mdl_report->getCount(date('Y-m-01'),date('Y-m-t'), $present, $patient); ?></td>
                <td><?php echo $this->mdl_report->getCount(date('Y-m-01'),date('Y-m-t'), $dropout, $patient); ?></td>				
				<td><?php echo $this->mdl_report->getCount(date('Y-m-01'),date('Y-m-t'), $ns, $patient); ?></td>
          <div>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</body>
</html>