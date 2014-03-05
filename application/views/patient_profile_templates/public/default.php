<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/style.css">
        
        <style>
            * {
                margin:0px;
                padding:5px;
            }
            body {
                color: #000 !important;
            }
            table {
                width:100%;
            }
            #header table {
                width:100%;
                padding: 0px;
            }
            #header table td, .amount-summary td {
                vertical-align: text-top;
                padding: 5px;
            }
            #company-name{
                color:#000;
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
                border:none !important;
                background-color: white !important;
            }
			.content{
				min-height:500px;
				max-height:842px;
				height:auto;
			}
        </style>
        
	</head>
	<body>
		<div class="content">
        <div id="header" style="height: 172px;">
            <table>
                <tr>
                    <td id="company-name">
                        <?php if($show=='true'){?>
                        <h2><?php echo $patient_details->first_name." ".$patient_details->last_name; ?></h2>
                        <p>
                            <?php if ($patient_details->address1) { echo $patient_details->address1 . '<br>'; } ?>
                            <?php if ($patient_details->address2) { echo $patient_details->address2 . '<br>'; } ?>
                            <?php if ($patient_details->city) { echo $patient_details->city . ' '; } ?>
                            <?php if ($patient_details->state) { echo $patient_details->state . ' '; } ?>
                            <?php if ($patient_details->pin_code) { echo $patient_details->pin_code . '<br>'; } ?>
                            <?php if ($patient_details->phone) { ?><abbr>P:</abbr><?php echo $patient_details->phone; ?><br><?php } ?>
                        </p>
                        <?php }?>
                    </td>
                    <td style="text-align: right;"><h2>Patient Dialysis Report Module (PDSM)</h2></td>
                </tr>
            </table>
        </div>
       
        <div id="invoice-items" style="min-height:100px">
            <table class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Machine Type</th>
                        <th>Injection</th>
                        <th>Present / Absent</th>
                        
                    </tr>
                </thead>
                <tbody>
                  <?php  foreach($patient_attendance as $attend)
							{ 
	
	
					?>
   			 <tr>
        	 
            <td><?php echo ucfirst($attend['patient'][0]->first_name).' '.ucfirst($attend['patient'][0]->last_name); ?></td>
            <td><?Php echo $attend['date1']; ?></td>
            <td><?Php echo $attend['machine'][0]->Machine_name; ?></td>
            <td><?Php echo $attend['injection'][0]->name; ?></td>
            <td><?Php echo $attend['status']; ?></td>
           <!-- <td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>-->
        </tr>
		
	<?php }?>
                </tbody>
            </table>
     
			
            
        </div>
		</div>
	</body>
	
</html>