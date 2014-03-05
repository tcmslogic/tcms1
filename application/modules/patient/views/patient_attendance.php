<script language="javascript">
$(document).ready(function () {
	//var total_record = $("#total_record").val();
	//var per_page = $("#per_page").val();
	//pagination(total_record,per_page);
});
</script>
<script language="javascript">
function getFilter(){

	search_val=$("#search").val();
	if(search_val!=''){	
		$("#loading").show();	
		$.ajax({
			type:"POST",
			dataType: "json",
			url:"<?php echo site_url("patient/getAttendance");?>",
			cache:false,
			data:"search="+search_val,
			success:function(data){
				$("#loading").hide();
				$("#holder").html(data.result);
				//pagination(data.total_record,data.per_page);	
				$("#loading").hide();
			}
		});
	}
} 
</script>
 <?php include_once('patient_list.php');?>
<div class="right-panel">
    
<div id="Profile_right">
<div id="breadcrumbs">
          <div class="patient_text"><h2>Patient Listing</h2></div>
</div>

<div id="search_box">
	<div id="search_filter">
        <div class="VS-search">
          <div class="VS-search-box-wrapper VS-search-box">
            <div class="VS-icon VS-icon-search"></div>
    <input type="hidden" name="per_page" id="per_page" value="2" />
            <div class="VS-search-inner">
              <div class="search_input ui-menu not_selected not_editing">
                <input type="text" class="ui-menu ui-autocomplete-input" placeholder="Filter by Reference Number, Patient name or invoice to..." style="z-index: auto; width: 500px;" autocomplete="off" id="search" onkeyup="getFilter()">                                  
              </div>
            </div>            
          </div>
        </div>
      </div>
</div>

    
<div class="one_wrap"><div class="widget">
           
          <div class="widget_body"  id="holder"> 
            
            <!--Activity Table-->
            
            
            
            <table class="activity_datatable" width="100%"   border="0" cellspacing="0" cellpadding="8">
              <tbody>
              <tr>
                <th width="20%">Name      </th>
                <th width="15%">Date </th>
                <th width="12%">Status</th>                                                  
              </tr>   
                         
             <?php
			if(count($patient_details)>0){$i=0; 
			 foreach($patient_details as $patient){
				$color = '';
				if(($patient->status)=='present'){
					$color = '';
				}else if(($patient->status)=='dropout'){
					$color = '#FF5353';
				}else if(($patient->status)=='noschedule'){
					$color = '#FF9';
				}?>           
			<tr>
				<td style="background:<?php echo $color?> !important;"><?php echo ucfirst($patient->sur_name)." ".ucfirst($patient->given_name);?></td>
                <td style="background:<?php echo $color?> !important;"><?php echo date('d M Y',strtotime($patient->start_date));?></td>
                <td style="background:<?php echo $color?> !important;"><?php echo ucfirst($patient->status);?></td>
			</tr>
			<?php }}else{?>
	<td colspan="3"><h3> No Records Found</h3></td>
<?php }?>
            </tbody></table>
             <div id="paginationtable" style="margin: auto;"></div>
          </div>
        </div>
</div>

 <?php /*?><div id="Patient_table"><div id="table">

 <table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	 
            <th scope="col" class="rounded" >Name</th>
            <th scope="col" class="rounded" >Date</th>
            <th scope="col" class="rounded" >Status</th>
           <!-- <th scope="col" class="rounded" >Time In</th>
            <th scope="col" class="rounded">Time Out</th>
            <th scope="col" class="rounded" >Staff</th>-->
            <!--<th scope="col" class="rounded-q4">Delete</th>-->
        </tr>
    </thead>
        <tfoot>
    	</tfoot>
    <tbody id="holder">
        <?php if(!empty($patient_details)){
			foreach($patient_details as $patient){
				$color = '';
				if(($patient->status)=='present'){
					$color = '';
				}else if(($patient->status)=='dropout'){
					$color = '#FF5353';
				}else if(($patient->status)=='noschedule'){
					$color = '#FF9';
				}
				?>
				
                <tr>
                	<td style="background:<?php echo $color?> !important;"><?php echo ucfirst($patient->sur_name)." ".ucfirst($patient->given_name);?></td>
                    <td style="background:<?php echo $color?> !important;"><?php echo $patient->start_date;?></td>
                    <td style="background:<?php echo $color?> !important;"><?php echo ucfirst($patient->status);?></td>
                </tr>
				
			<?php }	
		}else{?>
		<tr><td colspan='5'><h3>No Records Found</h3></td></tr>
		<?php }?>
    </tbody>
</table>
         
</div></div><?php */?>       
       
       
       
        
        
</div></div>