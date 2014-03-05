<style type="text/css">
.textboxwidh
{
	width:180px;
}
input[type="text"]
{
	background: none repeat scroll 0 0 #FCFCFC;
    border: 1px solid #CCCCCC;
    border-radius: 2px;
    box-shadow: 1px 1px 2px #DDDDDD inset;
    color: #666666;
    float: left;
    height: 16px;
    padding: 5px 10px 8px;
}
</style>
<script type="text/javascript">
$(function() {
	//$( "#date_of_admission" ).datepicker( "option", "dateFormat", "yy/mm/dd" );
	$( "#issue_date" ).datepicker();
});
</script>
 <script language="javascript">
  	function addRow()
	{
		
		var tmp_count=parseInt($("#row_count").val());
		count=tmp_count+1;
		content='<tr id="hibrid_'+count+'" style="display:none;" class="test"><td><input required type="text" name="item_'+count+'" id="item_'+count+'"  class="check_validate textboxwidh"/></td><td><input required class="textboxwidh" type="text" name="unit_price_'+count+'" id="unit_price_'+count+'" onkeyup="checkNumber(this);" count="'+count+'" /></td><td><input required type="text" name="quantity_'+count+'" id="quantity_'+count+'" onkeyup="checkNumber(this);" class="check_validate textboxwidh" count="'+count+'" onblur="setTotalPrice(this);"/></td><td>N/A</td><td><input type="text" readonly="readonly" name="total_price_'+count+'" id="total_price_'+count+'" class="check_validate textboxwidh" /></td><td style="vertical-align:middle;"><a href="#" onclick="deleteRow('+count+')" class="deleteRow">remove</a></td></tr>';
		
		$('.test').last().after(content);
        $("#hibrid_"+count).fadeIn(1000).show(1000);
		
		$('#row_count').val(count);
		$( ".get_date" ).datepicker();
	}
	function deleteRow(i)
	{
		$("#hibrid_"+i).css("background-color","#000000");
        $("#hibrid_"+i).fadeOut(1000, function(){
            $("#hibrid_"+i).remove();
        });	
	}
	function setTotalPrice(obj)
	{
		var count=$(obj).attr("count");
		var price=$("#unit_price_"+count).val();
		var qty=$(obj).val();
		if(qty == '')
		{
			qty=1;
		}
		
		var total_price=(price*qty);
	
		
		if(total_price == NaN)
		{
			
			total_price=0;
		}
	
		$("#total_price_"+count).val(total_price);
	}
	function getpatientdetail(val)
	{
		
		$.ajax({
			url:"<?php echo site_url("invoice/getpatientdetail");?>",
			cache:false,
			data:"pid="+val,
			success:function(data)
				    {
						$("#invoice_to").val(data);
					}
		});
	}
	function setqtyvalue()
	{
		
		var setvalue=1;
		$("#quantity_1").val(setvalue);
	}
	</script>
    

<?php include_once('sidebar.php');?>
<div class="right-panel">
     


<?php if(count($misc_invoice) > 0 ){ 

?>
<div id="breadcrumbs">
      <div class="patient_text"><h2>Edit Invoice</h2></div>
</div> 
<div class="one_wrap">
<div class="widget">
         
          <div class="widget_body"  id="holder"> 
          <div id="Miscellaneous_addform">
	  	<form name="add_invoice" id="add_invoice" action="<?php echo site_url("invoice/add_invoice");?>" method="post" >
	<input type="hidden" name="mid" id="mid" value="<?php echo $misc_invoice->id;?>" />
     <table cellspacing="20" style="margin:2% 2% 5% 1%">
		<tbody>
        	<tr>
            	<td  colspan="2"><label>Issue Date:</label><input type="text" id="issue_date" name="issue_date" value="<?php echo date("Y-m-d",strtotime($misc_invoice->issue_date));?>"></td>
            </tr>
            <tr>
            	<td colspan="2"><label>Patient:</label>
               
                			<select id="patient_id" name="patient_id" onchange="getpatientdetail(this.value)" >
                            
							<?php 
							
							foreach($patients as $patient){?>
									<option value="<?php echo $patient->patient_id;?>" <?php if($misc_invoice->patient_id==$patient->patient_id){?> selected="selected"<?php }?>><?php echo $patient->sur_name.' '.$patient->given_name;?></option>
							<?php }?>
                            </select>
                </td>
           <!--
            	<td ><label>Staff:</label>
                			<select id="staff" name="staff" style="width:30%">
                            <option value="">select</option>
							<?php foreach($staff as $st){?>
								<option value="<?php echo $st->user_id;?>"><?php echo $st->user_fullname;?></option>
							<?php }?>
                            </select>

                </td>-->
            </tr>
            <tr>
            	<td style="width:30%"><label>Invoice To:</label><textarea id="invoice_to" name="invoice_to" ><?php echo $misc_invoice->invoice_to;?></textarea></td>
                <td><label>Extra nfo:</label><textarea id="extra_info" name="extra_info" ><?php echo $misc_invoice->extra_info;?></textarea></td>
            </tr>
			
			<tr>
			<td colspan="2">
            <?php
				$items=explode(",",$misc_invoice->items);
				$unit_price=explode(",",$misc_invoice->unit_price);
				$quantity=explode(",",$misc_invoice->quantity);
				$tax=explode(",",$misc_invoice->tax);
				$total_price=explode(",",$misc_invoice->total_price);
				 
			?>
			<table cellpadding="5" cellspacing="5">
			<tr>
				<th>Item</th>
				<th>Unit Price</th>
				<th>Quantity</th>
				<th>Tax</th>
				<th>Total Price</th>
				<th></th>
			</tr>
			<?php for($i=0;$i<count($items);$i++){?>
			<tr id="hibrid_<?php echo $i;?>" class="test">
			<td><input required type="text" name="item_<?php echo $i;?>" id="item_<?php echo $i;?>"  class="check_validate textboxwidh"  value="<?php echo $items[$i];?>"/></td>
			<td><input required type="text" name="unit_price_<?php echo $i;?>" id="unit_price_<?php echo $i;?>" onkeyup="checkNumber(this);" count="<?php echo $i;?>" value="<?php echo $unit_price[$i];?>" class="textboxwidh"/></td>
			<td><input required type="text" name="quantity_<?php echo $i;?>" id="quantity_<?php echo $i;?>" onkeyup="checkNumber(this);" count="<?php echo $i;?>" class="check_validate textboxwidh" onblur="setTotalPrice(this);" value="<?php echo $quantity[$i];?>"/></td>
			<td>N/A</td>
			<td><input type="text" readonly="readonly" name="total_price_<?php echo $i;?>" id="total_price_<?php echo $i;?>" class="check_validate textboxwidh" value="<?php echo $total_price[$i];?>"/></td>
			<td><a href="#" onclick="deleteRow('<?php echo $i;?>')" class="deleteRow">remove</a></td>
			</tr>
			<?php }?>
			</table>
			</td>
			</tr>
            
             <tr>
            	<td>
                <a href="javascript:void(0);" id="add_bill_item" onclick="addRow()">ADD BILLABLE ITEM</a>
                </td>
            </tr>
            <tr>
            	<td><label>Note</label><textarea name="note" id="note"><?php echo $misc_invoice->notes;?></textarea></td>
            </tr>
           
             <tr>
            	<td>
				<div id="button_save">
				<input type="submit" name="save" value="Edit Invoice" id="save" style="cursor:pointer;"/>
				<div id="button_Cancel"><a href="<?php echo site_url('/invoice/index');?>">Cancel</a></div>
			  	</div></td>
				<input type="hidden" name="row_count" id="row_count" value="1" />
               
            </tr>
            
           </tbody>
         </table>   
    </form>
	</div>
          
         </div>
        </div>
</div>
<?php  }else{?>
<div id="breadcrumbs">
      <div class="patient_text"><h2>Add Invoice</h2></div>
</div> 
<div class="one_wrap">
<div class="widget">
         
          <div class="widget_body"  id="holder"> 
          <div id="Miscellaneous_addform">
	  	<form name="add_invoice" id="add_invoice" action="<?php echo site_url("invoice/add_invoice");?>" method="post" >
	<input type="hidden" name="mid" id="mid" value="" />
     <table cellspacing="20" style="margin:2% 2% 5% 1%">
		<tbody>
        	<tr>
            	<td  colspan="2"><label>Issue Date:</label><input type="text" id="issue_date" name="issue_date"></td>
            </tr>
            <tr>
            	<td colspan="2"><label>Patient:</label>
               
                			<select id="patient_id" name="patient_id" onchange="getpatientdetail(this.value)" >
                            <option value="">select</option>
							<?php 
							
							foreach($patients as $patient){?>
									<option value="<?php echo $patient->patient_id;?>"><?php echo $patient->sur_name.' '.$patient->given_name;?></option>
							<?php }?>
                            </select>
                </td>
           <!--
            	<td ><label>Staff:</label>
                			<select id="staff" name="staff" style="width:30%">
                            <option value="">select</option>
							<?php foreach($staff as $st){?>
								<option value="<?php echo $st->user_id;?>"><?php echo $st->user_fullname;?></option>
							<?php }?>
                            </select>

                </td>-->
            </tr>
            <tr>
            	<td style="width:30%"><label>Invoice To:</label><textarea id="invoice_to" name="invoice_to" ></textarea></td>
                <td><label>Extra nfo:</label><textarea id="extra_info" name="extra_info" ></textarea></td>
            </tr>
			
			<tr>
			<td colspan="2">
			<table cellpadding="5" cellspacing="5">
			<tr>
				<th>Item</th>
				<th>Unit Price</th>
				<th>Quantity</th>
				<th>Tax</th>
				<th>Total Price</th>
				<th></th>
			</tr>
			<tr id="hibrid_1" class="test">
			<td><input required type="text" name="item_1" id="item_1"  class="check_validate textboxwidh" /></td>
			<td><input required class="textboxwidh" type="text" name="unit_price_1" id="unit_price_1" onkeyup="checkNumber(this);" onblur="setqtyvalue();" count="1"/></td>
			<td><input required type="text" name="quantity_1" id="quantity_1" onkeyup="checkNumber(this);" count="1" class="check_validate textboxwidh" onblur="setTotalPrice(this);" /></td>
			<td style="vertical-align:middle;">N/A</td>
			<td><input type="text" readonly="readonly" name="total_price_1" id="total_price_1" class="check_validate textboxwidh"/></td>
			</tr>
			</table>
			</td>
			</tr>
            
             <tr>
            	<td>
                <a href="javascript:void(0);" id="add_bill_item" onclick="addRow()">ADD BILLABLE ITEM</a>
                </td>
            </tr>
            <tr>
            	<td><label>Note</label><textarea name="note" id="note"></textarea></td>
            </tr>
           
             <tr>
            	<td>
				<div id="button_save">
				<input type="submit" name="save" value="Create Invoice" id="save" style="cursor:pointer;"/>
				<div id="button_Cancel"><a href="<?php echo site_url('/invoice/index');?>">Cancel</a></div>
			  	</div></td>
				<input type="hidden" name="row_count" id="row_count" value="1" />
               
            </tr>
            
           </tbody>
         </table>   
    </form>
	</div>
          
         </div>
        </div>
</div>
<?php } ?>


</div>


    
    
    
