<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<style>
body {color: #000 !important;font-family: Calibri;font-weight: normal;}
.content {width: 960px;margin: 0 auto;}
table {width: 100%;}
#header table {width: 100%;padding: 0px;}
#header table td, .amount-summary td {vertical-align: text-top;padding: 5px;}
#company-name {color: #000;font-size: 18px;}
#invoice-to td {text-align: left}
#invoice-to {margin-bottom: 15px;}
#invoice-to-right-table td {padding-right: 5px;adding-left: 5px;text-align: right;}
.seperator {height: 25px}
.top-border {border-top: none;}
.no-bottom-border {border: none !important;background-color: white !important;}
.content {min-height: 500px;max-height: 842px;height: auto;}
.table tr td {text-align: left;padding: 10px;font-size: 14px;border: 1px solid #ccc;background-color: #fff;font-family: Calibri;}
.table tr th {vertical-align: top;font-size: 15px;padding: 10px;border: 1px solid #ccc;background-color: #fff;font-family: Calibri;font-weight: normal;text-align: left;}
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
    	<h3 style="text-align:left;width:50%;float:left;margin-bottom:1%;"><?php echo $patient_details->sur_name." ".$patient_details->given_name;?></h3>
        <h3 style="text-align:right;width:50%;float:right;">Patient Referral</h3>
      </div>
      
      <div id="le_detail" style="width:50%;float:left;line-height:25px;">
          <label style="text-align:left;width:100%;float:left;">Address: <?php echo $patient_details->address;?></label><br/>  
          <label style="text-align:left;width:100%;float:left;">Email: <?php echo $patient_details->email;?></label><br/>  
          <label style="text-align:left;width:100%;float:left;">Mobile No: <?php echo $patient_details->mobile_no;?></label>
      </div>  
      
  	  <div id="invoice-items" style="margin:18px 0;float:left;width:100%;" >
    	<table class="table table-striped" style="width: 100%;">
      		<tbody>
				<?php //$rid =  $type=$this->uri->segment(4);
                          $rid =  $ref_id;
                             if(isset($rid) && $rid != ''){
                               foreach($patient_referral as $referral)
                                    {if(isset($rid)&&($rid == $referral->ref_id )){
                ?>
                    <tr>
                      <th style="font-weight:bold;">Date</th>
                      <td><?php echo date('Y-m-d',strtotime($referral->created_date));?></td>
                    </tr>
                    <tr>
                      <th style="font-weight:bold;">Updated By</th>
                      <td><?Php echo $referral->modified_by; ?></td>
                    </tr>
                    <tr>
                      <th style="font-weight:bold;">Referral source</th>
                      <td><?php echo $referral->ref_source;?></td>
                    </tr>
                    <tr>
                      <th style="font-weight:bold;">Referral patients</th>
                      <td><?php echo $referral->ref_patients;?></td>
                    </tr>
                    <tr>
                      <th style="font-weight:bold;">commission</th>
                      <td><?php echo $referral->commission;?></td>
                    </tr>
                    <tr>
                      <th style="font-weight:bold;">Modified Date</th>
                      <td><?php echo date('Y-m-d',strtotime($referral->modified_date));?></td>
                    </tr>
                    </tr>
        
       		<?php }}}else{?>
            
                    <tr>
                      <th style="font-weight:bold;width: 95px;">Date</th>
                      <th style="font-weight:bold;width: 85px;">Updated By</th>
                      <th style="font-weight:bold;">Referral source</th>
                      <th style="font-weight:bold;">Referral patients</th>
                      <th style="font-weight:bold;">commission</th>
                      <th style="font-weight:bold;width: 100px;">Modified Date</th>
                    </tr>
                    
            <?php  foreach($patient_referral as $referral){?>
        
                    <tr>
                      <td><?php echo date('d M Y',strtotime($referral->created_date));?></td>
                      <td><?Php echo $referral->modified_by; ?></td>
                      <td><?php echo $referral->ref_source;?></td>
                      <td><?php echo $referral->ref_patients;?></td>
                      <td><?php echo $referral->commission;?></td>
                      <td><?php echo date('d M Y',strtotime($referral->modified_date));?></td>
                      <div>
                    </tr>
                    
        <?php } }?>
        
      </tbody>
    </table>
  </div>
</div>
</div>
</body>
</html>