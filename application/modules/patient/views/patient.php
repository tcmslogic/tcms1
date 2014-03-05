<!------------------------for user group vise chart----------------------------->
<script language="javascript">
$(document).ready(function () {
	
	var total_record = $("#total_record").val();
	var per_page = $("#per_page").val();
	//alert(total_record);
	pagination(total_record,per_page);
});
</script>	

<script language="javascript">
function getFilter(){

	search_val=$("#search").val();

	$("#loading").show();	
	$.ajax({
		type:"POST",
		dataType: "json",
		url:"<?php echo site_url("patient/getSearch");?>",
		cache:false,
		data:"search="+search_val,
		success:function(data){
			
			$("#holder").html(data.result);
			$("#loading").hide();
			pagination(data.total_record,data.per_page);	
			
		}
	});
} 
</script>
<div id="breadcrumbs">
          <div class="patient_text"><h2>Patient Listing</h2></div>
          <div id="right_button">
          
          <a href="<?php echo site_url('patient/add_patient'); ?>"><span class="iconfa-add"></span>Add Patient</a></div>
</div>
<div id="search_box">
	<div id="search_filter">
        <div class="VS-search">
          <div class="VS-search-box-wrapper VS-search-box">
            <div class="VS-icon VS-icon-search"></div>
           <input type="hidden" name="total_record" id="total_record" value="<?php echo count($patients);?>" />
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
                <th width="20%">Name</th>
                <th width="15%">Phone</th>
                <th width="12%">NRIC/Passport</th>
                <th width="32%">NEXT APPOINTMENT</th>                                                   
              </tr>              
             <?php
			if(count($patients)>0){$i=0; 
			 foreach($patients as $patient){?>           
			<tr >
				<td><a href="<?php echo site_url("patient/patient_profile/".base64_encode($patient->patient_id));?>">
<?php echo ucfirst($patient->sur_name).' '.ucfirst($patient->given_name);?></a></td>
				<td><span class="blue_highlight pj_cat"><?php echo ($patient->mobile_no == 0)?'':$patient->mobile_no;?> Mobile</span></td>
                <td><?php echo $patient->nric_passport;?></td>				
				<td><?php
				 if($this->mdl_patient->getNextAptDate($patient->patient_id)!=""){
				 echo date("d M Y",strtotime($this->mdl_patient->getNextAptDate($patient->patient_id)));
				 }
				 else{
					 echo "---";
				 }
				 ?></td>
			</tr>
			<?php }}else{?>
	<td colspan="4"><h3> No Records Found</h3></td>
<?php }?>
            </tbody></table>
             <div id="paginationtable" style="margin: auto;"></div>
          </div>
        </div>
</div>



</div>



