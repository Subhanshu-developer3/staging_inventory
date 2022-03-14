<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class File extends CI_Controller 
{
	
	function __construct() 
	{
		parent::__construct(); 
	}

	



	 function upload()
	 {
        if(!empty($_FILES)){ 
            
            
            // File upload configuration 
            $uploadPath = 'uploads/'; 
            $config['upload_path'] = $uploadPath; 
            $config['allowed_types'] = '*'; 
            $config['file_name'] = time().'_'.$_FILES['file_info']['name']; 
             
            // Load and initialize upload library 
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 
             
            // Upload file to the server 
            if($this->upload->do_upload('file_info'))
            { 
                $fileData = $this->upload->data();   
                $url = "http://inventory.ssrtechvision.com/uploads/".$fileData['file_name']; 
                
                $nwdata['url'] = $url;
                $nwdata['status'] = 'success';
                echo json_encode($nwdata); die();
            } 
        } 
     }
}