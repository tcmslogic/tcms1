<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * FusionInvoice
 * 
 * A free and open source web based invoicing system
 *
 * @package		FusionInvoice
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012 - 2013 FusionInvoice, LLC
 * @license		http://www.fusioninvoice.com/license.txt
 * @link		http://www.fusioninvoice.com
 * 
 */

function image_upload($file,$path="patient_profile")
{
  	$CI =& get_instance();
	
		//print_r($file);exit;
		$img=rand(0,9999).'_'.$file['name'];
		$flag=move_uploaded_file($file['tmp_name'],'./uploads/'.$path.'/'.$img);
		 if($flag)
		 {
			 img_thumb($img);
			return $img;;
		 }
		 else
		 {
		 	return '';
		 }

}

function img_thumb($img)
{	
	$CI =& get_instance();
	$CI->load->library('image_lib');
	
	$config['image_library'] = 'gd2';
	$config['source_image']	= './uploads/products/'.$img;
	$config['create_thumb'] = TRUE;
	$config['maintain_ratio'] = TRUE;
	$config['width']	 = 75;
	$config['height']	= 50;
	$config['new_image']   = './uploads/patient_thumbs/'.$img;
	$thumb_img='75x50_'.$img;
	
	$CI->image_lib->initialize($config);

	if($CI->image_lib->resize())
	{
		$new_name=str_replace('_thumb','',$thumb_img);
		return $thumb_img;
	}
	else
	{
		return 'error';
	}
}

function image_upload_user($file)
{
  	$CI =& get_instance();
	
		//print_r($file);exit;
		$img=rand(0,9999).'_'.$file['name'];
		$flag=move_uploaded_file($file['tmp_name'],'./uploads/user_thumbs/'.$img);
		 if($flag)
		 {
			 img_thumb_user($img);
			return $img;;
		 }
		 else
		 {
		 	return '';
		 }

}

function img_thumb_user($img)
{	
	$CI =& get_instance();
	$CI->load->library('image_lib');
	
	$config['image_library'] = 'gd2';
	$config['source_image']	= './uploads/products/'.$img;
	$config['create_thumb'] = TRUE;
	$config['maintain_ratio'] = TRUE;
	$config['width']	 = 75;
	$config['height']	= 50;
	$config['new_image']   = './uploads/user_thumbs/'.$img;
	$thumb_img='75x50_'.$img;
	
	$CI->image_lib->initialize($config);

	if($CI->image_lib->resize())
	{
		$new_name=str_replace('_thumb','',$thumb_img);
		return $thumb_img;
	}
	else
	{
		return 'error';
	}
}

function letter_upload($file)
{
  	$CI =& get_instance();
	
		//print_r($file);exit;
		$img=rand(0,9999).'_'.$file['name'];
		$flag=move_uploaded_file($file['tmp_name'],'./uploads/approval_letters/'.$img);
		 if($flag)
		 {
			return $img;
		 }
		 else
		 {
		 	return '';
		 }

}

function image_upload_notes($file,$file_name,$path="patient_notes")
{
  	$CI =& get_instance();
	
		//print_r($file);exit;
		//$img=rand(0,9999).'_'.$file['name'];
		$img = $file_name.".".end(explode('.', $file['name']));
		$flag=move_uploaded_file($file['tmp_name'],'./uploads/'.$path.'/'.$img);
		 if($flag)
		 {
			 img_thumb_notes($img);
			return $img;;
		 }
		 else
		 {
		 	return '';
		 }

}

function img_thumb_notes($img)
{	
	$CI =& get_instance();
	$CI->load->library('image_lib');
	
	$config['image_library'] = 'gd2';
	$config['source_image']	= './uploads/patient_notes/'.$img;
	$config['create_thumb'] = TRUE;
	$config['maintain_ratio'] = TRUE;
	$config['width']	 = 167;
	$config['height']	= 132;
	$config['new_image']   = './uploads/patient_thumbs_notes/'.$img;
	$thumb_img='75x50_'.$img;
	
	$CI->image_lib->initialize($config);

	if($CI->image_lib->resize())
	{
		$new_name=str_replace('_thumb','',$thumb_img);
		return $thumb_img;
	}
	else
	{
		return 'error';
	}
}
?>