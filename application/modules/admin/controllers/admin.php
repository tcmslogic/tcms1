<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Admin extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
		if($this->session->userdata("user_type")!="Admin")
		{
			redirect("dashboard","refresh");
		}
        $this->load->model('mdl_Admin');
		$this->load->helper('image');
		 $this->load->library('crypt');
		//$this->load->library('upload');
    }

    public function index()
    {
		 $this->layout->buffer('content', 'admin/Admin');
        $this->layout->render();
    }

	public function company()
	{
		
		
		if ($this->input->post())
		{
			$user_id=$this->session->userdata('user_id');
			$dt = new DateTime();
			//$upload=$this->do_upload();
			//$filename=$_FILES['userfile']['name'];
		 	$image_file=image_upload($_FILES['userfile'],"companylogo");
			//$data['photo']=$image_file;
		
			$data = array(
    			"company_name" => $this->input->post('cname'),
				"company_logo" => $image_file,
				"pddress" => $this->input->post('address'),
				"phone" => $this->input->post('phone'),
				"fax" => $this->input->post('fax'),
				"website" => $this->input->post('website'),
				"email" => $this->input->post('email'),
				"dialysis_center" => $this->input->post('dialysis'),
				"location" => $this->input->post('location'),
				"creationdate" => $dt->format('Y-m-d'),
    			"modify_by" => $user_id,
				);
				
			
			if($this->input->post('cid')!='')
			{
				//Update
				if($_FILES['userfile']['name']=='')
				{
					$data['company_logo']=$this->input->post("old_logo");
				}
				//$data['company_logo']=$this->input->post('logo');
				$where=array("id"=>$this->input->post('cid'));
				$result=$this->mdl_Admin->update('company',$data,$where);
				//echo $this->db->last_query();exit;
			}
			else
			{
				//Save
			$result=$this->mdl_Admin->save('company',$data);
			}
		}
		//Get Data
		$this->layout->set(
            array(
                'data' => $this->mdl_Admin->get_all_detail('company')
            )
        );
	
		$this->layout->buffer('content','admin/company');
		$this->layout->render();
	}
    public function remove_logo($type)
    {
        unlink('./uploads/' . $this->mdl_settings->setting($type . '_logo'));

        $this->mdl_settings->save($type . '_logo', '');

        $this->session->set_flashdata('alert_success', lang($type . '_logo_removed'));

        redirect('settings');
    }
	
	function do_upload()
	{
			
		$config['upload_path'] 		=  'uploads/';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '1000';
		$config['max_width']  		= '10240';
		$config['max_height']  		= '7680';
		$post = $this->input->post();
		
		
		$this->load->library('upload', $config);
		
		if($this->upload->do_upload())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function machine()
	{
		if($this->input->post())
		{
			
			$user_id=$this->session->userdata('user_id');
			$dt = new DateTime();
				
			$data = array(
    			"Machine_no" => $this->input->post('no'),
				"Machine_name" => $this->input->post('name'),
				"Machine_type" => $this->input->post('type'),
				"Machine_cost" => $this->input->post('cost'),
				"Creation_date" => $dt->format('Y-m-d'),
    			"modify_by" => $user_id,
				);
			
			if($this->input->post('id')!='')
			{
				//Update
				$data = array(
    			"Machine_no" => $this->input->post('no'),
				"Machine_name" => $this->input->post('name'),
				"Machine_type" => $this->input->post('type'),
				"Machine_cost" => $this->input->post('cost'),
				"Creation_date" => $dt->format('Y-m-d'),
    			"modify_by" => $user_id,
				);
				$data['Modify_date']=$dt->format('Y-m-d');
				
				$where=array("id"=>$this->input->post('id'));
				$result=$this->mdl_Admin->update('machine',$data,$where);
				echo "success";exit;
			}
			else
			{
				//Save
				$result=$this->mdl_Admin->save('machine',$data);
				echo "success";exit;
			}
		}
		//Get Data
		$this->layout->set(
            array(
                'data' => $this->mdl_Admin->get_all_detail('machine')
            )
        );
	
		$this->layout->buffer('content','admin/machine');
		$this->layout->render();
	}
	
	public function delete()
	{
		$id=$this->input->post('id');
		$tablename=$this->input->post('table');
		$ids = is_array($id) ? implode(',', $id) : $id;
		$query = mysql_query("DELETE FROM $tablename WHERE id IN ($ids)");
		echo "true";
	}
	
	public function delete_user()
	{
	
		$id=$this->input->post('id');
		$tablename=$this->input->post('table');
		
		$ids = is_array($id) ? implode(',', $id) : $id;
		$query = mysql_query("DELETE FROM $tablename WHERE user_id IN ($ids)");
		echo "true";exit;
	}
	
	public function user()
	{
		
		if($this->input->post())
		{
			
			$user_id=$this->session->userdata('user_id');
			$dt = new DateTime();
				
			
			
			if($this->input->post('id')!='')
			{
				
				//Update
				
				
				$data = array(
    			"user_name" => $this->input->post('user_name'),
				"user_fullname" => $this->input->post('user_fullname'),
				"user_type" => $this->input->post('user_type'),
				"status" => $this->input->post('status'),
    			//"modify_by" => $user_id,
				);
				//$data['user_date_modified']=$dt->format('Y-m-d');
				
				$where=array("user_id"=>$this->input->post('id'));
				$result=$this->mdl_Admin->update('users',$data,$where);
				echo "success";exit;
			}
			else
			{
				$password=$this->input->post('user_password');
				 $salt = $this->crypt->salt();
                 $hash = $this->crypt->generate_password($password, $salt);
					
				$data = array(
    			"user_name" => $this->input->post('user_name'),
				"user_fullname" => $this->input->post('user_fullname'),
				"user_type" => $this->input->post('user_type'),
				"user_email" => $this->input->post("email"),
				"user_password" => $hash,
				"user_psalt" => $salt,
				//"user_date_created" => $dt->format('Y-m-d'),
    			//"modify_by" => $user_id,
				"status" => $this->input->post("status"),
				);
				$image_file=image_upload_user($_FILES['image']);
				$data['image']=$image_file;
				//Save
				$result=$this->mdl_Admin->save('users',$data);
				//echo "success";exit;
				if($result!='')
				{
					redirect("admin/user","refresh");
				}
			}
		}
		//Get Data
		$this->layout->set(
            array(
                'data' => $this->mdl_Admin->get_all_detail('users')
            )
        );
	
		$this->layout->buffer('content','admin/user');
		$this->layout->render();
	
	}

	public function editUser()
	{
		
      		$password=$_POST['new_password'];
			
		$salt = $this->crypt->salt();
                $hash = $this->crypt->generate_password($password, $salt);

		$dt = new DateTime();
				
		if($_FILES['image_edit']['name']!="")
			{
				$image_file=image_upload_user($_FILES['image_edit']);
				$image=$image_file;
			}
			else
			{
				$image=$_POST['profile_photo_edit'];
			}						
		if($password != ""){	
		$data = array(
	    	"user_name" => $_REQUEST['user_name_edit'],
			"user_fullname" => $_REQUEST['user_fullname_edit'],
			"user_email" => $_REQUEST['email_edit'],
			"user_type" => $_REQUEST['user_type'],
			"user_password" => $hash,
			"user_psalt" => $salt,
			"image"=>$image,
			"user_id" => $_REQUEST['user_id'],
			"modify_by" => $this->session->userdata("user_id"),
			"status" => $_REQUEST['status']
		);
		$data['user_date_modified']=$dt->format('Y-m-d');
		//print_r($data); 
		}else{

		$data = array(
	    	"user_name" => $_REQUEST['user_name_edit'],
			"user_fullname" => $_REQUEST['user_fullname_edit'],
			"user_email" => $_REQUEST['email_edit'],
			"user_type" => $_REQUEST['user_type'],
			"user_id" => $_REQUEST['user_id'],
			"image"=>$image,
			"modify_by" => $this->session->userdata("user_id"),
			"status" => $_REQUEST['status']
		);
		$data['user_date_modified']=$dt->format('Y-m-d');
		//print_r($data); 
		}

		//print_r($data); exit;

				
		$where=array("user_id"=>$_REQUEST['user_id']);
		$result=$this->mdl_Admin->update('users',$data,$where);		
	
		$this->layout->set(array('data' => $this->mdl_Admin->get_all_detail('users')));
		$this->layout->buffer('content','admin/user');
		$this->layout->render();	
	}
	
	public function shift()
	{
	
		
		if($this->input->post())
		{
			
			$user_id=$this->session->userdata('user_id');
			$dt = new DateTime();
				
			
			
			if($this->input->post('id')!='')
			{
			
				//Update
				$data = array(
    			"shift_name" => $this->input->post('shift_name'),
				"HHFrom" => $this->input->post('shift_hrs_from'),
				"HHTo" => $this->input->post('shift_hrs_to'),
    			"modified_by" => $user_id,
				);
				$data['modified_date']=$dt->format('Y-m-d');
				
				$where=array("id"=>$this->input->post('id'));
				$result=$this->mdl_Admin->update('shift_master',$data,$where);
				echo "success";exit;
			}
			else
			{
				$data = array(
    			"shift_name" => $this->input->post('shift_name'),
				"HHFrom" => $this->input->post('shift_hrs_from'),
				"HHTo" => $this->input->post('shift_hrs_to'),
				"created_date" => $dt->format('Y-m-d'),
    			"modified_by" => $user_id,
				);
				//Save
				$result=$this->mdl_Admin->save('shift_master',$data);
				echo "success";exit;
			}
		}
		//Get Data
		$this->layout->set(
            array(
                'data' => $this->mdl_Admin->get_all_detail('shift_master')
            )
        );
	
		$this->layout->buffer('content','admin/shift');
		$this->layout->render();
	
	
	}
	
	public function injection()
	{
		
		
		if($this->input->post())
		{
			
			$user_id=$this->session->userdata('user_id');
			$dt = new DateTime();

			if($this->input->post('id')!='')
			{
			
				//Update
				$data = array(
    			"name" => $this->input->post('name'),
				"qty" => $this->input->post('qty'),
				"charges" => $this->input->post('charges'),
    			"modified_by" => $user_id,
				);
				$data['modified_date']=$dt->format('Y-m-d');
				
				$where=array("id"=>$this->input->post('id'));
				$result=$this->mdl_Admin->update('injection',$data,$where);
				echo "success";exit;
			}
			else
			{
				$data = array(
    			"name" => $this->input->post('name'),
				"qty" => $this->input->post('qty'),
				"charges" => $this->input->post('charges'),
				"created_date" => $dt->format('Y-m-d'),
    			"modified_by" => $user_id,
				);
				//Save
				$result=$this->mdl_Admin->save('injection',$data);
				echo "success";exit;
			}
		}
		//Get Data
		$this->layout->set(
            array(
                'data' => $this->mdl_Admin->get_all_detail('injection')
            )
        );
	
		$this->layout->buffer('content','admin/injection');
		$this->layout->render();
	
	
	}
	
	public function check_user_available(){
		$uname = $this->input->post('uname');
		$result = $this->mdl_Admin->check_user_available($uname);
		echo json_encode($result);
		exit;
	}


	public function check_email_available(){
		$sql ="select `user_email`,`user_id` from `users` where `user_email`='".$_REQUEST['uemail']."' ";
		$res=$this->db->query($sql);
		$result=$res->result();
		
		if(count($result)>0){
			$query_id = $result[0]->user_id;
			if($query_id == $this->session->userdata['user_id']){ echo "";}
			else{	echo "This email id is already exist"; }
		}else{
			echo "This email is not exist! Yo can use it.";
		}
		
	}

	
	public function edit_user(){
		
		$data = $this->mdl_Admin->edit_user($_REQUEST['uid']);
		
		//echo $data[0]->user_fullname;
		
		$img_src = $data[0]->image;
		if($img_src!=''){
			 $img_url = base_url("uploads/user_thumbs/". $data[0]->image);
		}else{
			 $img_url = base_url("assets/default/images/id_name.png");
		}

		$action = site_url("admin/editUser");
		
   $edit_form = '<div id="inline_edit" style="">
            <h2>Edit User</h2>
        
            <form id="edit_form" name="edit_form" method="post" action="'.site_url("admin/editUser").'" enctype="multipart/form-data">
           
 		<input type="hidden" id="form_action" name="form_action" value='.$action.' />
		<input type="hidden" id="user_id" name="user_id" value='.$_REQUEST['uid'].' />
                <label for="machine_no">Full Name</label>
                <input type="text" id="user_fullname_edit" name="user_fullname_edit" class="txt" value='.$data[0]->user_fullname.'>
                <br>
                <label for="machine_name">Username</label>
                <input type="text" id="user_name_edit" name="user_name_edit" class="txt" onblur="return checkuser(this.value);" value='.$data[0]->user_name.'>
                <div id="success_msg"></div>	
                <br>
				 <label for="machine_name">User Email</label>
                <input type="text" id="email_edit" name="email_edit" onBlur="checkEmail(this.value)" class="txt" value='.$data[0]->user_email.'>
		<div id="success_email"></div>
		<input type="hidden" value="" id="error_email" name="error_email" >
                <div id="success_msg"></div>	
                <br>
                		<label for="machine_type">New Password</label>
                <input type="password" id="new_password" name="new_password" class="txt" value="">
                <br>
				<label for="machine_type">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="txt" value="">
                <br>
                <label for="machine_cost">User type</label>
                <select name="user_type" id="user_type_edit">';
		$admin="";$manager1="";$manager2="";$reception="";$doctor="";$nurse="";
		if($data[0]->user_type=="Admin"){ 
			$admin = 'selected=selected';$manager1 = '';$manager2="";$reception = '';$doctor = '';$nurse = '';
		}else if($data[0]->user_type=="Doctor"){ $admin = '';$manager1 = '';$manager2="";$reception = '';$doctor = 'selected=selected';$nurse = '';
		}else if($data[0]->user_type=="Nurse"){ $admin = '';$manager1 = '';$manager2="";$reception = '';$doctor = '';$nurse = 'selected=selected';
		}else if($data[0]->user_type=="Manager1"){ $admin = '';$manager2="";$manager1 = 'selected=selected';$reception = '';$doctor = '';$nurse = '';
		}else if($data[0]->user_type=="Reception"){ $admin = '';$manager1 = '';$manager2="";$reception = 'selected=selected';$doctor = '';$nurse = '';
		
		}
		else if($data[0]->user_type=="Manager2"){ $admin = '';$manager1 = '';$manager2='selected=selected';$reception = '';$doctor = '';$nurse = '';
		
		}
		
		$Active="";$inActive="";
		if($data[0]->status=="1"){ 
			$Active = 'selected=selected';$inActive= '';
		}else if($data[0]->status==0){ $Active = '';$inActive= 'selected=selected';
		}
  $edit_form .='<option value="Admin" '.$admin.'>Admin</option>
                <option value="Manager1" '.$manager1.'>Manager1</option>
				<option value="Manager2">"'.$manager2.'"</option>
                <option value="Reception" '.$reception.'>Reception</option>
                <option value="Doctor" '.$doctor.'>Doctor</option>
                <option value="Nurses" '.$nurse.'>Nurses</option>
                </select>
				 <br>
                <label for="machine_cost">Status</label>
              
                <select name="status">
                <option value="1" '.$Active.'>Active</option>
                <option value="0" '.$inActive.'>inActive</option>
                </select>
                <br>
                <label>Photo</label>
                <input type="file" name="image_edit" id="image_edit" />
				<img src='.$img_url.' height="30"  width="30"/>
				<input type="hidden" name="profile_photo_edit" id="profile_photo_edit" value='.$data[0]->image.' />
                <br/>
                <br/>
                <!--<button id="Save">Save</button>-->
                <input type="submit" name="save" id="save" value="Save" />
                <!--<a href="#" id="close">cancel</a>-->
            </form>
        </div>';

	echo $edit_form;

	}

}

?>
