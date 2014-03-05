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

class Admin_Controller extends User_Controller {

	public function __construct()
	{
		
		$this->load->library("session");
		
		parent::__construct('user_type', $this->session->userdata("user_type"));
		       $user=$this->session->userdata("user_type");
  if(empty($user))
  {
    redirect('sessions/login');
  }
		
	}

}

?>