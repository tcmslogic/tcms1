<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
       
        
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
			table tr th {
				 background-color: #4682B4;
    			padding:5px;
				color:#fff;
				font-weight:normal;
				
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
			ul
			{
				list-style:none;
			}
        </style>
        
		<style>
            * {
                margin:0px;
                padding:5px;
            }
            body {
                color: #000 !important;
				font-family:Calibri;
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
				min-height:1200px;
				max-height:1024px;
				height:auto;
			}
			
			#page_table
			{
				border:none !important;
			}
			#page_table tr th
			{
				background-color:#fff;
	border:1px solid #e2e2e2;
				text-align:left;
				color:#000;
				font-family:Calibri;
			}
			#page_table tr td
			{
				background-color:#fff;
	border:1px solid #e2e2e2;
				text-align:left;
				color:#000;
				font-family:Calibri;
				
			}
        </style>
        
	</head>
	<body>
		<?php foreach($allmisc as $invoice){?>
		<div class="content" style="height:100%; margin:50px 0 50px 0;">
		<?php print_r($Header); ?>
    		<div id="header" style="float:right;width:40%;">
            <table>
            <tr>
             <td align="right"><h2 style="font-family:Calibri;color: #375B91;">Invoice</h2></td>
            </tr>
                <tr>
                    <td id="company-name" style="text-align: right;">
                    	<table>
						<tr><td >Invoice No#</td><td>:</td><td style="text-align:right;"><?php echo $invoice->invoice_no; ?></td></tr>
						<tr><td s>Date</td><td>:</td><td style="text-align:right;"><?php echo date("d-m-Y",strtotime($invoice->issue_date)); ?></td></tr>
						</table>
                       
                    </td>
                </tr>
            </table>
        </div>
		<?php 
			$CI = & get_instance();
			$patient_details=$CI->mdl_patient->getPatientProfile($invoice->patient_id);
			?>
        <div id="invoice-to">
            <table style="width: 50%;">
                <tr>
                    <td style="padding-left: 5px;">
                        <p><?php echo lang('bill_to'); ?>:</p>
                        <p><?php echo $patient_details->given_name.' '.$patient_details->sur_name; ?><br>
                            <?php if ($patient_details->address) { echo $patient_details->address . '<br>'; } ?>
                            
                        </p>
                    </td>
                    <td style="width:40%;"></td>
                    
                </tr>
            </table>
        </div>
     
        <?php
			//print_r($invoice);exit;
			$items=explode(",",$invoice->items);
			$unit_price=explode(",",$invoice->unit_price);
			$quantity=explode(",",$invoice->quantity);
			$total_price=explode(",",$invoice->total_price);
			$i=0;
			$grand_total=0;
			$j=1;
			
		?>
        <div id="invoice-items" style="min-height:100px">
            
			<table id="page_table" class="table" style="width:100%" cellspacing="0">
				<thead>
					<tr>
                    	<th>No</th>
						<th>Date</th>
						<th>Item</th>
						<th>Unit Price</th>
						<th>Qty</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($items as $item)
			{ ?>
				<tr>
                	<td><?php echo $j; ?></td>
					<td><?php echo date("d-m-Y",strtotime($invoice->issue_date));?></td>
					
					<td><?php echo $item;?></td>
					<td><?php echo number_format($unit_price[$i], 2, '.', '');?></td>
					<td><?php echo $quantity[$i];?></td>
					<td><?php echo number_format($total_price[$i], 2, '.', '');?></td>
					
				</tr>
				<?php
				
					$grand_total=((float)$grand_total + (float)$total_price[$i]);
						$i++;
				 $j++;}?>
				</tbody>
			</table>
         
			
                        <table class="amount-summary" style="float: right;width: 100%;">
                            <tr>
                                <td style="text-align: right;">Sub Total:</td>
                                <td style="text-align: left;width:16%;"><?php echo number_format($grand_total, 2, '.', ''); ?></td>
                            </tr>
                           
                            <tr>
                                <td style="text-align: right;">TAX(0.00%) :</td>
								<?php $final_total=$grand_total + ($grand_total*0.00);?>
                                <td style="text-align: left;"><?php echo ($grand_total*0.00); ?></td>
                            </tr>
							<tr>
                                <td style="text-align: right;">Final Total:</td>
                                <td style="text-align: left;"><?php echo number_format($final_total, 2, '.', ''); ?></td>
                            </tr>
                           
                           
                        </table>
                   
            
           
        </div>
		</div>
		<?php }?>
		
	</body>
	
</html>