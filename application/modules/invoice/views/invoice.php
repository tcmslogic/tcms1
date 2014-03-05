<?php include_once('sidebar.php');?>
<script language="javascript">
$(document).ready(function () {
	
	
	

	
	
	var total_record = $("#total_record").val();
	var per_page = $("#per_page").val();
	//alert(total_record);
	pagination(total_record,per_page);
	//Delete
	$(document).on('click','.delall,.delrow',function(e){
	var id;
	if($(this).hasClass('delall')) {
		e.preventDefault();
		id = $('.selrow:checked').map(function(){
				return $(this).val();
			}).get();
	} else {
		id = $(this).parents('tr').find('input:hidden').val();
		
	}
	if($('.selrow:checked').length == 0 && $(this).hasClass('delall')) {
		alert('Please select atleast one row');
	} else if(confirm('Do you really want to delete')) {
		
					table='invoice';
				$.ajax({
					type: 'POST',
					url: 'invoice/delete',
					data: {
        'id': id,
        'table': table
    },
					success: function(data) {
						
						if(data == "true") {
							location.reload();
						}
					}
				});
			
		
	}
	e.stopImmediatePropagation();});
	
});
</script>
<div class="right-panel">
     

<div id="breadcrumbs">
      <div class="patient_text"><h2>Invoice Listing</h2></div>
          <div id="right_button">
          
          <a href="<?php echo site_url('invoice/add_invoice'); ?>"><span class="iconfa-add"></span>Add Invoice</a></div>
</div> 





<div class="one_wrap"><div class="widget">
           
          <div class="widget_body"  id="holder"> 
            
            <!--Activity Table-->
            <input type="hidden" name="total_record" id="total_record" value="<?php echo count($allmisc);?>" />
    <input type="hidden" name="per_page" id="per_page" value="2" />	
            <table class="activity_datatable" width="100%"   border="0" cellspacing="0" cellpadding="8">
              <thead>
              <tr>
   
                <th >Date</th>
                <th>Invoice No.</th>
                <th>Patient</th>
                <th>Amount</th> 
                <th >Operation</th>                                                  
              </tr>              
            </thead>
	<tbody>
	<?php 
	if(count($allmisc) >0 )
	{
	foreach($allmisc as $inv){
	
		$patient= $this->mdl_patient->getPatientName($inv->patient_id);
		$sub_price=explode(",",$inv->total_price);
		$total_amt=array_sum($sub_price);?>
    <tr>
  
    
    	<td><input type="hidden" value="<?php echo $inv->id; ?>" name="id" /><?php echo date("Y-m-d",strtotime($inv->issue_date));?></td>
        <td><?php echo $inv->invoice_no;?></td>
        <td><?php echo ucfirst($patient->given_name).' '.ucfirst($patient->sur_name);?></td>
        <td><?php echo $total_amt;?></td>
		<td>
		
		<a  class="delrow" style="cursor:pointer;">Delete</a> |<a href="<?php echo site_url("invoice/edit_invoice/".base64_encode($inv->id));?>">Edit</a> |
	
		 <a href="<?php echo site_url("invoice/generate_invoice_single/print/".base64_encode($inv->id));?>">Print</a></td>
    </tr>
	<?php }
	}
	else
	{
	?>
    <tr><td colspan="5">No Record Found</td></tr>
    <?php } ?>
    </tbody>

            </table>
          
          </div>
        </div>
</div>
<div id="button_save" style="margin-right:10px;">
        	<div id="save">
        		<a href="<?php echo site_url('invoice/generateinvoicePdf/print') ?>">Print</a>
       		</div>
       </div>
       <div id="button_save">
        	<div id="save">
        		<a href="<?php echo site_url('invoice/generateinvoicePdf/pdf') ?>">PDF</a>
       		</div>
       </div>


</div>
