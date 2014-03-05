<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<style>
body {color: #000 !important;font-family: Calibri;font-weight:normal;}
.content {width: 960px;margin: 0 auto;}
table {width: 100%;}
#header table { width: 100%; padding: 0px; }
#header table td, .amount-summary td { vertical-align: text-top; padding: 5px;}
#company-name { color: #000; font-size: 18px; }
#invoice-to td { text-align: left}
#invoice-to { margin-bottom: 15px;}
#invoice-to-right-table td { padding-right: 5px; padding-left: 5px; text-align: right; }
.seperator { height: 25px }
.top-border { border-top: none; }
.no-bottom-border { border: none !important; background-color: white !important; }
.content { min-height: 500px; max-height: 842px; height: auto; }
.table tr td { text-align: left; padding: 10px; font-size: 14px; border: 1px solid #ccc; background-color: #fff; font-family: Calibri; }
.table tr th { vertical-align: top; font-size: 15px; padding: 10px; border: 1px solid #ccc; background-color: #fff; font-family: Calibri; font-weight:bold; text-align:left; }
</style>
</head>

<body>
<div class="content"> <?php print_r($Header); ?>
<?php //echo "<pre>";print_r($patient_details);exit;?>
  <div id="header" style="width:100%;float:left;margin-bottom:5px;">
    	<h3 style="text-align:left;width:50%;float:left;margin-bottom:1%;"><?php echo $patient_details->sur_name." ".$patient_details->given_name;?></h3>
        <h3 style="text-align:right;width:50%;float:right;">Patient Certificate</h3>
  </div>
  
  <div id="le_detail" style="width:50%;float:left;line-height:25px;">
  <label style="text-align:left;width:100%;float:left;">Address: <?php echo $patient_details->address;?></label><br/> 
  <label style="text-align:left;width:100%;float:left;">Email: <?php echo $patient_details->email;?></label><br/> 
  <label style="text-align:left;width:100%;float:left;">Mobile No: <?php echo $patient_details->mobile_no;?></label>
  </div>  
  
  <div id="invoice-items" style="margin:18px 0;float:left;width:100%;">
    <table class="table table-striped" style="width:100%;float:left;" cellpadding="5" cellspacing="0">
      <tbody>
        <?php //$cid =  $type=$this->uri->segment(4);
				  $cid =  $cer_id;
				     if(isset($cid) && $cid != ''){
					   foreach($patient_certificate as $certificate)
							{if(isset($cid)&&($cid == $certificate->cer_id )){
		?>
            <tr>
              <th >Date</th>
              <td><?php echo date('Y-m-d',strtotime($certificate->created_date));?></td>
            </tr>
            <tr>
              <th >Updated By</th>
              <td><?Php echo $certificate->modified_by; ?></td>
            </tr>
            <tr>
              <th >Doctor name</th>
              <td><?php echo $certificate->doc_name;?></td>
            </tr>
            <tr>
              <th >Patient name</th>
              <td><?php echo $certificate->patient_name;?></td>
            </tr>
            <tr>
              <th >Reason for medical leave</th>
              <td><?php echo $certificate->res_leave;?></td>
            </tr>
            <tr>
              <th >No. of medical leave days</th>
              <td><?php echo $certificate->leave_days;?></td>
            </tr>
            <tr>
              <th >Modified Date</th>
              <td><?php echo date('Y-m-d',strtotime($certificate->modified_date));?></td>
            </tr>
            </tr>
        
        <?php }}}else{?>
        
            <tr>
              <th>Date</th>
              <!--<th>Updated By</th>-->
              <th>Doctor name</th>
              <th>Patient name</th>
              <th>Reason for medical leave</th>
              <th>No. of medical leave days</th>
              <!--<th>Modified Date</th>-->
            </tr>
            
        <?php if(count($patient_certificate)>0){
				foreach($patient_certificate as $certificate){?>

            <tr>
              <td><?php echo date('Y-m-d',strtotime($certificate->created_date));?></td>
             <!-- <td><?Php //echo $certificate->modified_by; ?></td>-->
              <td><?php echo $certificate->doc_name;?></td>
              <td><?php echo $certificate->patient_name;?></td>
              <td><?php echo $certificate->res_leave;?></td>
              <td><?php echo $certificate->leave_days;?></td>
             <!-- <td><?php// echo date('Y-m-d',strtotime($certificate->modified_date));?></td>-->
              <div>
            </tr>
  
        <?php }}else{?>
        
            <tr>
              <td colspan="7">No Record Found</td>
            </tr>
            
		<?php }}?>
        
      </tbody>
    </table>
  </div>
</div>
  

</div>
</body>
</html>