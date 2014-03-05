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

class Ajax extends Admin_Controller {

   // public $ajax_controller = TRUE;
	
   public function getGraph($type='')
   {
  		$this->load->model('mdl_dashboard');
		$result=$this->mdl_dashboard->getCompleteOrders();
		echo json_encode($result);
   }
   public function getUserChart()
   {
   		$this->load->model('mdl_dashboard');
		$result=$this->mdl_dashboard->getUserChart();
		echo json_encode($result);
		
   }

}

?>