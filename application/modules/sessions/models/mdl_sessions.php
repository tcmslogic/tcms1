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

class Mdl_Sessions extends CI_Model {

    public function auth($email, $password)
    {
		$where = array('user_email' => $email, 'status' => 1);
        $this->db->where($where);
        $query = $this->db->get('users');
//print_r($query->result()); exit;

        if ($query->num_rows())
        {
            $user = $query->row();
			//print_r($user->user_password);exit;
            $this->load->library('crypt');

            /**
             * Password hashing changed after 1.2.0
             * Check to see if user has logged in since the password change
             */
//echo md5($password)." ".$user->user_password; exit;
            if (!$user->user_psalt)
            {
                /**
                 * The user has not logged in, so we're going to attempt to
                 * update their record with the updated hash
                 */
		
                if (md5($password) == $user->user_password)
		if ($password == $user->user_password)
                {
                    /**
                     * The md5 login validated - let's update this user 
                     * to the new hash
                     */
                    $salt = $this->crypt->salt();
                    $hash = $this->crypt->generate_password($password, $salt);

                    $db_array = array(
                        'user_psalt'    => $salt,
                        'user_password' => $hash
                    );
                    
                    $this->db->where('user_id', $user->user_id);
                    $this->db->update('users', $db_array);
                    
                    $this->db->where('user_email', $email);
                    $user = $this->db->get('users')->row();
                    
                }
                else
                {
                    /**
                     * The password didn't verify against original md5
                     */

                    return FALSE;
                }
            }
			//var_dump($this->crypt->check_password($user->user_password, $password));exit;
            if ($this->crypt->check_password($user->user_password, $password))
            {
				//echo "here comesdf";exit;
                $session_data = array(
                    'user_type' => $user->user_type,
                    'user_id'   => $user->user_id,
                    'user_name' => $user->user_name
                );

                $this->session->set_userdata($session_data);

                return TRUE;
            }
		
        }

        return FALSE;
    }

}

?>
