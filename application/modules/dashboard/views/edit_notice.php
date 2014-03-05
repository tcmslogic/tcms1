<div class="headerbar">
    <h1>Edit Notice</h1>
</div>

<div class="container-fluid">
<div class="row-fluid">
	<form name="add_notice" id="add_notice" action="<?php echo site_url("dashboard/edit_notice");?>" method="post" >
     <table>
		<tbody>
        	<tr>
            	<td><label>Title:</label><input type="text" id="title" name="title" value="<?php echo $result[0]->title?>"></td>
            </tr>
            
            <tr>
            	<td><label>Descriptoin</label><textarea name="content" id="content"><?php echo $result[0]->content?></textarea></td>
            </tr>
           
             <tr>
            	<td><input type="submit" name="save" value="save" id="save" /></td>
                <td><a href="<?php echo site_url('/dashboard');?>">cancel</a></td>
            </tr>
            
           </tbody>
         </table> 
          <input type="hidden" name="id" value="<?php echo $result[0]->id;?>" />
          <!--<input type="hidden" name="created_date" id="created_date" value="<?php //echo date("Y-m-d h:i:s");?>" />
          <input type="hidden" name="created_by" id="created_by" value="<?php //echo $this->session->userdata("user_id");?>" /> --> 
    </form>
	</div>
</div>