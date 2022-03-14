<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common{ 

    private $CI;
    private $userid;

    function __construct() 
    {
        $this->CI =& get_instance();
        if(isset($this->CI->session->userdata['userdetails']['userid']))
        {
            

            $this->userid = $this->CI->session->userdata['userdetails']['userid'];
        }
    }


	


    public function is_logged_in()
    {
       $CI =& get_instance();
       
       if(isset($CI->session->userdata['userdetails']['email']))
        {
        	$userid = $CI->session->userdata['userdetails']['userid'];
            $row = $CI->Crud_model->fetchtabledataone('users','id',$userid);
        	if($row[0]->status == 1)
        		return true;
        	else
        		return false;
        }
        else
        {
        	return false;
        }
    }


}
