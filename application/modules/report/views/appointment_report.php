
<script language="javascript">
$(document).ready(function () {
	
	var total_record = $("#total_record").val();
	var per_page = $("#per_page").val();
	//alert(total_record);
	pagination(total_record,per_page);
});

</script>


<?php include_once('sidebar.php');?>
<script language="javascript">
function getFilter(){

	year=$("#year").val();
	month = $("#month").val();
	
	
	
	search_val=$("#search").val();
	gender="";
	if($('input[name=gender]:checked').val()==null)
	{
		gender="";
	}
	else{
		gender=$('input[name=gender]:checked').val();
	}
	

	$("#loading").show();	
	$.ajax({
		type:"POST",
		dataType: "json",
		url:"<?php echo site_url("report/getSearchAptmnt");?>",
		cache:false,
		data:"gender="+gender+"&search="+search_val+"&month="+month+"&year="+year,
		success:function(data){
			
			$("#holder").html(data.result);
			$("#loading").hide();
			pagination(data.total_record,data.per_page);	
			
		}
	});
} 
</script>
    <div class="right-panel">
<div id="Profile_right">
<div id="breadcrumbs">
          <div class="patient_text"><h2>Appoitment Report</h2></div>
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
        <div>
        	Gender : <input type="radio" name="gender" value="male"  onchange="getFilter()" />Male
            		 <input type="radio" name="gender" value="female" onchange="getFilter()" />Female
        </div>
        <div>
        <select id="month" name="month" onchange="getFilter()">
            <option <?php echo (date('m')=="01" ? 'selected=selected;':''); ?> value="01" >January</option>
            <option <?php echo (date('m')=="02" ? 'selected=selected;':''); ?> value="02" >February</option>
            <option <?php echo (date('m')=="03" ? 'selected=selected;':''); ?> value="03" >March</option>
            <option <?php echo (date('m')=="04" ? 'selected=selected;':''); ?> value="04" >April</option>
            <option <?php echo (date('m')=="05" ? 'selected=selected;':''); ?> value="05" >May</option>
            <option <?php echo (date('m')=="06" ? 'selected=selected;':''); ?> value="06" >June</option>
            <option <?php echo (date('m')=="07" ? 'selected=selected;':''); ?> value="07" >July</option>
            <option <?php echo (date('m')=="08" ? 'selected=selected;':''); ?> value="08" >August</option>
            <option <?php echo (date('m')=="09" ? 'selected=selected;':''); ?> value="09" >September</option>
            <option <?php echo (date('m')=="10" ? 'selected=selected;':''); ?> value="10" >October</option>
            <option <?php echo (date('m')=="11" ? 'selected=selected;':''); ?> value="11" >November</option>
            <option <?php echo (date('m')=="12" ? 'selected=selected;':''); ?> value="12" >December</option>
    	</select>
	    </div>
        <div>
        <select id="year" name="year" onchange="getFilter()">
			<?php 
            for($i = date('Y') ; $i >= 1950; $i--){
              echo "<option value=".$i.">$i</option>";
            }
            ?>
	    </select>
        </div>
      </div>
</div>

<div style="display: block; float: left; margin-top: 10px;">
<img id="loading" style="display:none;" src="<?php echo base_url("assets/default/img/loading.gif"); ?>">
</div>   
   
	<div class="one_wrap">
<div class="widget">
           
          <div class="widget_body"  id="holder">		
        
        	<table class="activity_datatable" width="100%"   border="0" cellspacing="0" cellpadding="8">
			<tbody>
            <tr>
				<th width="15%">Patient Name</th>
				<th width="20%">Next Appointment</th>
			</tr>

			
            <tr>
                    <?php $id="";
			if(count($patient_id)>0){$i=0; 
			 foreach($patient_id as $patient){ $id=$id.",".$patient->patient_id; 
			 $name = $this->mdl_report->getPatientName($patient->patient_id);
			 ?>           
			<tr >
				<td><?php echo ucfirst($name->given_name)." ".ucfirst($name->sur_name); ?></td>
				<td>
				<?php 
					$date="---";
					if($this->mdl_report->getNextDate($patient->patient_id)!=""){ 
					$date = date("d M Y",strtotime($this->mdl_report->getNextDate($patient->patient_id))); }				
					echo $date; 
				?></td>                
			</tr>
			<?php }}else{?>
            <td colspan="2">No Record Found</td>
            <?php }?>
            </tr>
            
            </tbody>
		</table>
         <?php if(count(@$patient_notes)>0){?>
         	<div id="paginationtable" style="margin: auto;"></div>
         <?php }?>
	
    <div id="button_save" style="margin-right:10px;width:10%">
        	<div id="save">
        		<a href="<?php echo site_url('report/generate_print_note/'.base64_encode($id)); ?>">Print</a>
       		</div>
           
       </div>
         <div id="button_save" style="margin-right:0px;">
        	<div id="save">
        		<a href="<?php echo site_url('report/generate_pdf_note/'.base64_encode($id)); ?>">PDF</a>
       		</div>
           
       </div>
      
</div>
</div>
    
</div>

</div>

		



