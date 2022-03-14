<?php
defined('BASEPATH') OR exit('No direct script access allowed');


date_default_timezone_set('Asia/Kolkata');
class Authentication extends CI_Controller 
{
	
	function __construct() 
	{
		parent::__construct(); 
	}
   
    
   public function index()
	{
		if($this->common->is_logged_in())
		{   //$list_detail['fabric_detail'] = $this->Crud_model->fetchalldata('fabric_temporary_data');
		    $list_detail['fabric_detail'] = $this->Crud_model->datanwnew('fabric_temporary_data');
		   
		   
		   
		   
		   $list_detail['all_colora'] = $this->Crud_model->fetchalldata('color');
           $list_detail['all_fabric'] = $this->Crud_model->fetchalldata('fabric_pattern_list');
           $list_detail['all_fabric_nw'] = $this->Crud_model->fetchalldata('fabric_type_list');
           $list_detail['rowCount'] = $this->Crud_model->countone('fabric_temporary_data','status0',1);
           $this->load->view('list_fabric.php', $list_detail);
		
		}
	    else
		{
			$this->load->view('login.php');
		}
	}

	
	

	public function not_found()
	{
		$data['page'] = '404';
		$this->load->view('404.php',$data);
	}

   
	public function logout()
	{   
		if($this->common->is_logged_in())
		{
		    $user_data = $this->session->all_userdata(); 
	        
	        $return_id = $this->session->userdata['userdetails']['return_id'];
	        $update['logout_at'] = date('Y-m-d H:i:s');
	        
	        $this->Crud_model->updatetable('user_logs', $update, 'id', $return_id);
	        foreach ($user_data as $key => $value) 
		     {
		            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
		                $this->session->unset_userdata($key);
		     }
		    }
		    
		    
		    $this->session->sess_destroy();
		    $this->load->view('login.php');
	     }
	     else{
	     	$this->load->view('login.php');
	     }
     }

	

    public function auth_login()
	{
		if($this->input->is_ajax_request() && $this->input->post('type') == 'login')
		{
			
			$email = trim($this->input->post('email'));

			if(empty($email)){

				$return['status']= 'fail';
				$return['message'] = 'Please enter valid email address';
				$ret = json_encode($return);
				echo $ret;die();
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			{
                $return['status']= 'fail';
				$return['message'] = 'Please enter valid email address';
				$ret = json_encode($return);
				echo $ret;die();
            }

			$password = trim($this->input->post('password'));

			if(empty($password)){

				$return['status']= 'fail';
				$return['message'] = 'Please enter valid password';
				$ret = json_encode($return);
				echo $ret;die();
			}
			$validate = $this->Crud_model->validatelogin($email,$password);

			if($validate != 0)
			{
				$sessionarray['email']= $email;
				$sessionarray['userid']= $validate;  
                $ip = $this->input->ip_address();
                $fetch_user_details = $this->Crud_model->fetchtabledataone('users', 'id', $validate);
                $insert['user_id'] = $fetch_user_details[0]->id;
                $insert['ip_address'] = $ip;
                $insert['login_at'] = date('Y-m-d H:i:s');

                $return_id = $this->Crud_model->insertData('user_logs', $insert);
                $sessionarray['return_id'] = $return_id; 
                $sessionarray['session_id'] = session_id();


				$this->session->set_userdata('userdetails',$sessionarray);
				$return['status']= 'success';
				$return['message']= 'Successfully LoggedIn.';
				if($this->session->userdata('redirect'))
				{
					$return['redirect'] = $this->session->userdata('redirect');
				}
				else
				{
					$return['redirect'] = base_url();
				}
				$ret = json_encode($return);
				echo $ret;die();
            }
			else
			{
				$return['status']= 'fail';
				$return['message'] = 'Invalid Credentials';
				$ret = json_encode($return);
				echo $ret;die();
			}
		}
	    else
		{
			redirect('not_found');
		
		}
	 }
	
   


	public function create_account()
	{
        $email = $this->input->post('email');
        
        $userdata = explode('@',$email);
        $insert['name'] =  $userdata[0];
        $insert['email'] = $email;
        $password = $this->input->post('password');
        $options = array('cost' => 10);
        $hash = password_hash($password, PASSWORD_DEFAULT, $options);
        $insert['password'] = $hash;
        $insert['user_img'] = 'default.jpg';
        $insert['status'] = 1;
        $insert['updated_at'] = date('Y-m-d H:i:s');
        $done = $this->Crud_model->insertData('users',$insert);
        if($done != 0)
        {
          $data['status'] = true;
          $data['message'] = 'Account created successfully';
          print_r(json_encode($data));
        }
        
        else
        {
          $data['status'] = false;
          $data['message'] = 'something went wrong.Not able to create your account';
          print_r(json_encode($data));
        }
    }
       
    public function getdata_allnew(){
     
     if(isset($_POST['page'])){ 


    		$baseURL = 'http://inventory.ssrtechvision.com/getdata_allnew'; 
            $offset = !empty($_POST['page'])?$_POST['page']:0; 
            $limit = 10; 

           // Set conditions for search 
           $whereSQL = ''; 
           if(!empty($_POST['keywords'])){ 
              $whereSQL = " WHERE (fabric_code LIKE '%".$_POST['keywords']."%') "; 
            } 



            $sql= "SELECT * FROM `fabric_temporary_data`".$whereSQL;
	        $result = $this->db->query($sql);
	        $rowCount = $result->num_rows();

	        $data_nw['baseURL'] = $baseURL;
	        $data_nw['offset'] = $offset;
	        $data_nw['limit'] = $limit;
	        $data_nw['rowCount']  = $rowCount;
	        
	        // Fetch records based on the offset and limit 
	        $res = $this->Crud_model->datanwnewall('fabric_temporary_data', $_POST['keywords'], $offset, $limit);
	         $data_nw['fabric_detail'] = $res;
            $this->load->view('list_fabric_nwall.php', $data_nw);
             
    	}

    }         

    public function getdata_all()
    {
       
    	//echo "hii";
    	if(isset($_POST['page'])){ 


    		$baseURL = 'http://inventory.ssrtechvision.com/getdata_all'; 
            $offset = !empty($_POST['page'])?$_POST['page']:0; 
            $limit = 10; 

           // Set conditions for search 
           $whereSQL = ''; 
           if(!empty($_POST['keywords'])){ 
              $whereSQL = " WHERE (fabric_code LIKE '%".$_POST['keywords']."%') "; 
            } 
            
	        
	        
	        
	        
	        $data_nw['baseURL'] = $baseURL;
	        $data_nw['offset'] = $offset;
	        $data_nw['limit'] = $limit;
	        
	        $res = $this->Crud_model->datanwnewallnedatalall('fabric_temporary_data', $offset, $limit);
            $newdata = $this->Crud_model->datanwnewalldata('fabric_temporary_data', $_POST['keywords']);
           
	        
           
           
           
           
           
           
           
           
           
           
           
            
            
            // Fetch records based on the offset and limit 
            $filter = $_POST['filterBy'];
	        if($filter == '0')
	        {   
	        	$resnew = $this->Crud_model->datanwnewalldesc('fabric_temporary_data', $offset, $limit);
                $data_nw['fabric_detail'] = $resnew;
                
                $sql= "SELECT * FROM `fabric_temporary_data` WHERE `status0`=1 ORDER BY id DESC ";
                $result = $this->db->query($sql);
	            $rowCount = $result->num_rows();
	            $data_nw['rowCount']  = $rowCount;
	            $data_nw['status'] = '0'; 
	            /////////////////////////////////////////////////////
	            $data_nw['nw'] = $_POST['page'];
	             
	        }
	        elseif($filter == '1')
	        {
	        	$resnewdata = $this->Crud_model->datanwnewalldescnew('fabric_temporary_data', $offset, $limit);
                $data_nw['fabric_detail'] = $resnewdata;
                
                
                $sql= "SELECT * FROM `fabric_temporary_data` WHERE `status0`=1 ORDER BY id ASC";
                $result = $this->db->query($sql);
	            $rowCount = $result->num_rows();
	            $data_nw['rowCount']  = $rowCount;
	            $data_nw['status'] = '1';
	            /////////////////////////////////////////////////////
	            $data_nw['nw'] = $_POST['page'];
	        }
	        elseif($filter == '2')
	        {  
	        	$resnewdata = $this->Crud_model->datanwnewalldescnewnw('fabric_temporary_data', $offset, $limit);
                $data_nw['fabric_detail'] = $resnewdata;
                $sql= "SELECT * FROM `fabric_temporary_data` WHERE `status0`=1 AND `total_qty` <= 50 ORDER BY total_qty";
                $result = $this->db->query($sql);
	            $rowCount = $result->num_rows();
	            $data_nw['rowCount']  = $rowCount;
	            $data_nw['status'] = '2';
	            /////////////////////////////////////////////////////
	            $data_nw['nw'] = $_POST['page'];
	        }
	        elseif(!empty($newdata))
	        {
	           $data_nw['fabric_detail'] = $newdata;
	           $sql= "SELECT * FROM `fabric_temporary_data`".$whereSQL; 
	           $result = $this->db->query($sql);
	           $rowCount = $result->num_rows();
	           $data_nw['rowCount']  = $rowCount;
	           $data_nw['status'] = '3';
	           /////////////////////////////////////////////////////
	           $data_nw['nw'] = $_POST['page'];
	           
	        }
	        else
	        {
	          $data_nw['fabric_detail'] = $res;
	          $sql= "SELECT * FROM `fabric_temporary_data` WHERE `status0`= 1  ORDER BY `fabric_code`";
	          $result = $this->db->query($sql);
	          $rowCount = $result->num_rows();
	          $data_nw['rowCount']  = $rowCount;
	          $data_nw['status'] = '4';
	          /////////////////////////////////////////////////////
	          $data_nw['nw'] = $_POST['page'];
	        }
	        
	        
	        
	        
	        
	        if($data_nw['status'] == '3'){
	            
	           $this->load->view('list_fabric_nwall.php', $data_nw);
	        }
	        elseif((($data_nw['status'] == '4') && (count($newdata) == 0))){
	            
	            
	            $this->load->view('new_fabric_data_new.php', $data_nw);     
	        
	            
	        }
	        else{
	            
	            $this->load->view('new_fabric_data.php', $data_nw);
	        }
	        
            
             
    	}



    }
    public function list_fabric()
    {
       if($this->common->is_logged_in())
		{   
		   //$list_detail['fabric_detail'] = $this->Crud_model->fetchalldata('fabric_temporary_data');
			$list_detail['fabric_detail'] = $this->Crud_model->datanwnew('fabric_temporary_data');
            $list_detail['all_colora'] = $this->Crud_model->fetchalldata('color');
            $list_detail['all_fabric'] = $this->Crud_model->fetchalldata('fabric_pattern_list');
            $list_detail['all_fabric_nw'] = $this->Crud_model->fetchalldata('fabric_type_list');
            $list_detail['rowCount'] = $this->Crud_model->countone('fabric_temporary_data','status0',1);
            $this->load->view('list_fabric.php', $list_detail);    

		}
		else
		{
			$this->load->view('login.php');
		}
    }
    //----------------------------------------------------------------------------------------//
    //-----commented-----//
    /*function create_fabric()
    {
        $data['fabric_pattern_list'] = $this->Crud_model->fetchalldatawithcondition('fabric_pattern_list', 'is_active', 1);  
        $data['fabric_type'] =  $this->Crud_model->fetchalldatawithcondition('fabric_type_list','is_active', 1);
        $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
        $data['colora'] = $this->Crud_model->fetchalldatawithcondition('color','status', 1); 
		$this->load->view('initial_info.php', $data);
    }*/
    











  
    
    public function fabric_invoiceid()
    {  
       $fabric_invoiceid = $this->input->post('invoiceId');  
       $data = $this->Crud_model->checkforadata('fabric_purchase_detail','invoiceId', $fabric_invoiceid);
     
       if($data == true)
       { 
          $datanew['status'] = 'success';
          $datanew['message'] = 'This invoice id has already been used';
          print_r(json_encode($datanew));  die(); 
       }
       
       else
       {
          $datanew['status'] = 'error';
          $datanew['message'] = 'Requested invoice id can use';
          print_r(json_encode($datanew));  die(); 
       }
    }







    public function archieve_fabric_data()
    {
      if($this->input->is_ajax_request() && $this->input->post('type') == 'archieve_fabric_data')
	  {
          
          $archieve_fabric_data = $_POST['archieve_allid'];
          $archieve_id_arr =  explode(",",$archieve_fabric_data);
          
          $update['archieve_status'] = 0;
          foreach($archieve_id_arr as $id)
          {
            $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $id);
          }
       }

       if(true)
	   {
	       $data['status'] = 'success';
	       $data['message'] = 'Fabric data archieve successfully';	       
	       $data['redirect'] = base_url()."list-fabric";
	       print_r(json_encode($data));
	   }
	   else
	   {
	       $data['status'] = false;
	       $data['message'] = 'something went wrong. Not able to archieve the requested fabric';
	    
	       print_r(json_encode($data));
	     }

     }






    public function unarchieve_fabric()
    {
      if($this->input->is_ajax_request() && $this->input->post('type') == 'unarchieve_fabric')
	  {
          $archieve_fabric_data = $_POST['unarchieve_allid'];
          $archieve_id_arr =  explode(",",$archieve_fabric_data);
          
          $update['archieve_status'] = 1;
          foreach($archieve_id_arr as $id)
          {
            $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $id);
          }
       

       if(true)
	   {
	       $data['status'] = 'success';
	       $data['message'] = 'Fabric data unarchieved successfully';	       
	       $data['redirect'] = base_url()."render_unarchive_lists";
	       print_r(json_encode($data));
	   }
	   else
	   {
	       $data['status'] = false;
	       $data['message'] = 'something went wrong. Not able to unarchieve the requested fabric';
	    
	       print_r(json_encode($data));
	     }

     }
   }

    function add_fabric_basic_info()
    {   
    	$hash_id = $this->uri->segment(2);
    	$data['fabric_temporary_data'] = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $hash_id); 

    	$id = $data['fabric_temporary_data'][0]->id;
        
        $data['fabric_purchase_detail'] = $this->Crud_model->fetchalldatawithcondition('fabric_purchase_detail', 'fabric_temporary_data_id', $id); 
    	
    	
        $data['fabric_pattern_list'] = $this->Crud_model->fetchalldatawithcondition('fabric_pattern_list', 'is_active', 1);  
        $data['fabric_type'] =  $this->Crud_model->fetchalldatawithcondition('fabric_type_list','is_active', 1);
        $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
        $data['colora'] = $this->Crud_model->fetchalldatawithcondition('color','status', 1);
      
        $sqlnw= "SELECT * FROM `fabric_purchase_detail` WHERE `fabric_temporary_data_id` = $id ORDER BY `id` DESC";
        $resultnw = $this->db->query($sqlnw);
        $rowCount = $resultnw->num_rows(); 
        
        $data['vendor_detail'] = $this->Crud_model->fetchalldatawithcondition('cvendor_detail','status', 1);
        $data['rowCount'] = $rowCount;

        $data['hash_id'] = $hash_id;
		$this->load->view('initial_info.php', $data);
    }




    function add_fabric_basic_info_read()
    {   
    	$hash_id = $this->uri->segment(2);
    	$data['fabric_temporary_data'] = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $hash_id); 

    	$id = $data['fabric_temporary_data'][0]->id;
        
        $data['fabric_purchase_detail'] = $this->Crud_model->fetchalldatawithcondition('fabric_purchase_detail', 'fabric_temporary_data_id', $id); 
    	
    	
        $data['fabric_pattern_list'] = $this->Crud_model->fetchalldatawithcondition('fabric_pattern_list', 'is_active', 1);  
        $data['fabric_type'] =  $this->Crud_model->fetchalldatawithcondition('fabric_type_list','is_active', 1);
        $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
        $data['colora'] = $this->Crud_model->fetchalldatawithcondition('color','status', 1);
      
        $sqlnw= "SELECT * FROM `fabric_purchase_detail` WHERE `fabric_temporary_data_id` = $id ORDER BY `id` DESC";
        $resultnw = $this->db->query($sqlnw);
        $rowCount = $resultnw->num_rows(); 
        
        $data['vendor_detail'] = $this->Crud_model->fetchalldatawithcondition('cvendor_detail','status', 1);
        $data['rowCount'] = $rowCount;

        $data['hash_id'] = $hash_id;
		$this->load->view('initial_info_read.php', $data);
    }





    //add new fucntion for adding a new fabric id
    function create_initial_fabric()
    {   
    	$data['fabric_pattern_list'] = $this->Crud_model->fetchalldatawithcondition('fabric_pattern_list', 'is_active', 1);  
        $data['fabric_type'] =  $this->Crud_model->fetchalldatawithcondition('fabric_type_list','is_active', 1);
        $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
        $data['colora'] = $this->Crud_model->fetchalldatawithcondition('color','status', 1); 
        $data['vendor_detail'] = $this->Crud_model->fetchalldatawithcondition('cvendor_detail','status', 1);
        $this->load->view('create_initial_fabric.php',$data);
    }
   
    /*function create_new_fabric()
    {
        $this->load->view('create_new_fabric.php'); 
    }*/



    //---------------------------------------------------------------------------------------------//
    
     //////////////////a
    public function getdata_alldata(){
        
        $baseURL = 'http://inventory.ssrtechvision.com/getdata_alldata'; 
        $offset = !empty($_POST['page'])?$_POST['page']:0; 
        $limit = 10; 


    	$fabrictypedata = $_POST['fabrictypedata'];
    	$fabric_datanw = $_POST['fabric_datanw'];
    	$fabric_colordata = $_POST['fabric_colordata'];
    	
    	$new_fabrictypedata = json_decode($fabrictypedata);
    	$new_fabric_datanw = json_decode($fabric_datanw);
    	$new_fabric_colordata = json_decode($fabric_colordata); 
    	
    	if(((!empty($new_fabric_colordata)) && (!empty($new_fabric_datanw))  && (!empty($new_fabrictypedata))) )
    	{
    	   $str1 = '';
             for ($x = 0; $x < count($new_fabric_colordata); $x++) {
                $str1 .= ' color_id = '.$new_fabric_colordata[$x].' OR ';
              }
           
           $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);
           
           $strnew1nw = '('.$strnew1.')';
            
            
            
            $str0 = '';
             for ($x = 0; $x < count($new_fabric_datanw); $x++) {
                $str0 .= ' fabric_pattern_id = '.$new_fabric_datanw[$x].' OR ';
              }
           
           
           $strnew0= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $strnew0nw = '('.$strnew0.')';
           
           $stringnw = '';
             for ($x = 0; $x < count($new_fabrictypedata); $x++) {
                 
                
                $stringnw .= ' fabric_type_id = '.$new_fabrictypedata[$x].' OR ';
              }
           
          
           $stringnwa= preg_replace('/\W\w+\s*(\W*)$/', '$1', $stringnw);
           $stringnw0 = '('.$stringnwa.')';
           
           $strnw = $strnew1nw.' AND '.$strnew0nw.' AND '.$stringnw0;
           
           $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw;
           $resultnw = $this->db->query($sqlnw);
	       $rowCount = $resultnw->num_rows(); 
           $data_nw['baseURL'] = $baseURL;
	       $data_nw['offset'] = $offset;
	       $data_nw['limit'] = $limit;
	       $data_nw['rowCount']  = $rowCount;
	        
           $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw." ORDER BY `fabric_code` DESC LIMIT $offset, $limit "; 
       
           $result = $this->db->query($sql);
	       $data = $result->result();
	       $data_nw['fabric_detail'] = $data;
	       //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
           $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	       
	       
	       
	       
	       
	      
    	    
    	}
    	
    	
    	elseif((!empty($new_fabric_colordata)) && (!empty($new_fabrictypedata)))
    	{
    	   $str1 = '';
             for ($x = 0; $x < count($new_fabric_colordata); $x++) {
                $str1 .= ' color_id = '.$new_fabric_colordata[$x].' OR ';
              }
           
           $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);
           
           $strnew1nw = '('.$strnew1.')';
            
            
            
            $str0 = '';
             for ($x = 0; $x < count($new_fabrictypedata); $x++) {
                $str0 .= ' fabric_type_id = '.$new_fabrictypedata[$x].' OR ';
              }
           
           $strnew0= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $strnew0nw = '('.$strnew0.')';
           
           $strnw = $strnew1nw.' AND '.$strnew0nw;
           
           $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw;
           $resultnw = $this->db->query($sqlnw);
	       $rowCount = $resultnw->num_rows(); 
           $data_nw['baseURL'] = $baseURL;
	       $data_nw['offset'] = $offset;
	       $data_nw['limit'] = $limit;
	       $data_nw['rowCount']  = $rowCount;
	        
           $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw." ORDER BY `fabric_code` DESC LIMIT $offset, $limit "; 
           $result = $this->db->query($sql);
	       $data = $result->result();
	       $data_nw['fabric_detail'] = $data;
	       
	       //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
           $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	       
	       
	       
	       
	       
	       
	       
	       
	      
	   }
	   
	   
	   elseif((!empty($new_fabric_datanw)) && (!empty($new_fabrictypedata)))
    	{
    	   $str1 = '';
             for ($x = 0; $x < count($new_fabric_datanw); $x++) {
                $str1 .= ' fabric_pattern_id = '.$new_fabric_datanw[$x].' OR ';
              }
           
           $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);
           
           $strnew1nw = '('.$strnew1.')';
            
            
            
            $str0 = '';
             for ($x = 0; $x < count($new_fabrictypedata); $x++) {
                $str0 .= ' fabric_type_id = '.$new_fabrictypedata[$x].' OR ';
              }
           
           $strnew0= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $strnew0nw = '('.$strnew0.')';
           
           $strnw = $strnew1nw.' AND '.$strnew0nw;
           
           $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw;
           $resultnw = $this->db->query($sqlnw);
	       $rowCount = $resultnw->num_rows(); 
           $data_nw['baseURL'] = $baseURL;
	       $data_nw['offset'] = $offset;
	       $data_nw['limit'] = $limit;
	       $data_nw['rowCount']  = $rowCount;
	        
           $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw." ORDER BY `fabric_code` DESC LIMIT $offset, $limit "; 
           $result = $this->db->query($sql);
	       $data = $result->result();
	       $data_nw['fabric_detail'] = $data; 
	       
	       
	       
	       
	       
	       
	       //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
           $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	       
	       
	       
	       
	       
	       
	       
	       
	      
	   }
	   
	   ////////////////////////////////////////////////////////////////
	   	elseif((!empty($new_fabric_colordata)) && (!empty($new_fabric_datanw)) && (empty($new_fabrictypedata))  )
    	{
    	   $str1 = '';
             for ($x = 0; $x < count($new_fabric_colordata); $x++) {
                $str1 .= ' color_id = '.$new_fabric_colordata[$x].' OR ';
              }
           
           $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);
           
           $strnew1nw = '('.$strnew1.')';
            
            
            
            $str0 = '';
             for ($x = 0; $x < count($new_fabric_datanw); $x++) {
                $str0 .= ' fabric_pattern_id = '.$new_fabric_datanw[$x].' OR ';
              }
           
           $strnew0= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $strnew0nw = '('.$strnew0.')';
           
           $strnw = $strnew1nw.' AND '.$strnew0nw;
           
           $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw;
           $resultnw = $this->db->query($sqlnw);
	       $rowCount = $resultnw->num_rows(); 
           $data_nw['baseURL'] = $baseURL;
	       $data_nw['offset'] = $offset;
	       $data_nw['limit'] = $limit;
	       $data_nw['rowCount']  = $rowCount;
	        
           $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw." ORDER BY `fabric_code` DESC LIMIT $offset, $limit "; 
           $result = $this->db->query($sql);
	       $data = $result->result();
	       $data_nw['fabric_detail'] = $data; 
	       
	       //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
           $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	       
	       
	       
	       
	       
	       
	       
	       
	      
	   }
	   ///////////////////////////////////////////////////////////////////////
	   
    	 elseif((!empty($new_fabric_colordata)) && (empty($new_fabrictypedata)))
	   {
	        $str1 = '';
             for ($x = 0; $x < count($new_fabric_colordata); $x++) {
                $str1 .= ' color_id = '.$new_fabric_colordata[$x].' OR ';
              }
           
            $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);

            $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnew1;
           
	        $resultnw = $this->db->query($sqlnw);
	        $rowCount = $resultnw->num_rows(); 

	        $data_nw['baseURL'] = $baseURL;
	        $data_nw['offset'] = $offset;
	        $data_nw['limit'] = $limit;
	        $data_nw['rowCount']  = $rowCount;
             
          $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnew1." ORDER BY `fabric_code` DESC LIMIT $offset, $limit ";
	      $result = $this->db->query($sql);
	      $data = $result->result();
          
          $data_nw['fabric_detail'] = $data; 
          
          //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
          $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	   }
	   
	   
	   
    	elseif((count($new_fabrictypedata) > 0) ){
             
             $str = '';
             for ($x = 0; $x < count($new_fabrictypedata); $x++) {
                $str .= ' fabric_type_id = '.$new_fabrictypedata[$x].' OR ';
              }
             
          $strnew= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str);

            $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnew;
	        $resultnw = $this->db->query($sqlnw);
	        $rowCount = $resultnw->num_rows();

	        $data_nw['baseURL'] = $baseURL;
	        $data_nw['offset'] = $offset;
	        $data_nw['limit'] = $limit;
	        $data_nw['rowCount']  = $rowCount;
             
          $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnew." ORDER BY `fabric_code` DESC LIMIT $offset, $limit ";
	      $result = $this->db->query($sql);
	      $data = $result->result();
          $data_nw['fabric_detail'] = $data;  
          
          //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
          $this->load->view('list_fabric_nwallnew.php', $data_nw); 
              
    	}
    	
    	elseif(empty($new_fabrictypedata)){
    	    $data_nw['fabric_detail'] = $this->Crud_model->datanwnew('fabric_temporary_data');
             $rowCount = $this->Crud_model->countone('fabric_temporary_data','status0',1);
            

	        $data_nw['baseURL'] = $baseURL;
	        $data_nw['offset'] = $offset;
	        $data_nw['limit'] = $limit;
	        $data_nw['rowCount']  = $rowCount;  
	        
	        //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
            $this->load->view('list_fabric_nwallnew.php', $data_nw);
    	}
    	
    	
    	
    } 
    
    
    
    
    
    
    
    
    public function getdata_alldata_getdata_alldata(){
        
        $baseURL = 'http://inventory.ssrtechvision.com/getdata_alldata_getdata_alldata'; 
        $offset = !empty($_POST['page'])?$_POST['page']:0; 
        $limit = 10; 
        
        
    	$fabrictypedata = $_POST['fabrictypedata'];  
    	$fabric_datanw = $_POST['fabric_datanw'];
    	$fabric_colordata = $_POST['fabric_colordata'];
    	
    	$new_fabrictypedata = json_decode($fabrictypedata);
    	$new_fabric_datanw = json_decode($fabric_datanw);
    	$new_fabric_colordata = json_decode($fabric_colordata); 
    	
    	if(((!empty($new_fabric_colordata)) && (!empty($new_fabric_datanw))  && (!empty($new_fabrictypedata))) )
    	{
    	   $str1 = '';
             for ($x = 0; $x < count($new_fabric_colordata); $x++) {
                $str1 .= ' color_id = '.$new_fabric_colordata[$x].' OR ';
              }
           
           $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);
           
           $strnew1nw = '('.$strnew1.')';
            
            
            
            $str0 = '';
             for ($x = 0; $x < count($new_fabric_datanw); $x++) {
                $str0 .= ' fabric_pattern_id = '.$new_fabric_datanw[$x].' OR ';
              }
           
           
           $strnew0= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $strnew0nw = '('.$strnew0.')';
           
           $stringnw = '';
             for ($x = 0; $x < count($new_fabrictypedata); $x++) {
                $str0 .= ' fabric_type_id = '.$new_fabrictypedata[$x].' OR ';
              }
           
           
           $stringnw= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $stringnw0 = '('.$stringnw.')';
           
           $strnw = $strnew1nw.' AND '.$strnew0nw.' AND '.$stringnw0;
           
           $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw;
           $resultnw = $this->db->query($sqlnw);
	       $rowCount = $resultnw->num_rows(); 
           $data_nw['baseURL'] = $baseURL;
	       $data_nw['offset'] = $offset;
	       $data_nw['limit'] = $limit;
	       $data_nw['rowCount']  = $rowCount;
	        
           $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw." ORDER BY `fabric_code` DESC LIMIT $offset, $limit "; 
          
           $result = $this->db->query($sql);
	       $data = $result->result();
	       $data_nw['fabric_detail'] = $data; 
	       
	       
	       
	       
	       
	       //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
           $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	       
	       
	       
	       
	       
	      
    	    
    	}
	   
        
        elseif((!empty($new_fabric_colordata)) && (!empty($new_fabric_datanw)))
    	{
    	   $str1 = '';
             for ($x = 0; $x < count($new_fabric_colordata); $x++) {
                $str1 .= ' color_id = '.$new_fabric_colordata[$x].' OR ';
              }
           
           $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);
           
           $strnew1nw = '('.$strnew1.')';
            
            
            
            $str0 = '';
             for ($x = 0; $x < count($new_fabric_datanw); $x++) {
                $str0 .= ' fabric_pattern_id = '.$new_fabric_datanw[$x].' OR ';
              }
           
           $strnew0= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $strnew0nw = '('.$strnew0.')';
           
           $strnw = $strnew1nw.' AND '.$strnew0nw;
           
           $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw;
           $resultnw = $this->db->query($sqlnw);
	       $rowCount = $resultnw->num_rows(); 
           $data_nw['baseURL'] = $baseURL;
	       $data_nw['offset'] = $offset;
	       $data_nw['limit'] = $limit;
	       $data_nw['rowCount']  = $rowCount;
	        
           $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw." ORDER BY `fabric_code` DESC LIMIT $offset, $limit "; 
           $result = $this->db->query($sql);
	       $data = $result->result();
	       $data_nw['fabric_detail'] = $data;  
	       
	       //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
           $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	       
	       
	       
	       
	       
	       
	       
	       
	      
	   }
	   
	   
	     
	   elseif((!empty($new_fabric_colordata)) && (!empty($new_fabrictypedata)))
    	{
    	   $str1 = '';
             for ($x = 0; $x < count($new_fabric_colordata); $x++) {
                $str1 .= ' color_id = '.$new_fabric_colordata[$x].' OR ';
              }
           
           $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);
           
           $strnew1nw = '('.$strnew1.')';
            
            
            
            $str0 = '';
             for ($x = 0; $x < count($new_fabrictypedata); $x++) {
                $str0 .= ' fabric_type_id = '.$new_fabrictypedata[$x].' OR ';
              }
           
           $strnew0= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $strnew0nw = '('.$strnew0.')';
           
           $strnw = $strnew1nw.' AND '.$strnew0nw;
           
           $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw;
           $resultnw = $this->db->query($sqlnw);
	       $rowCount = $resultnw->num_rows(); 
           $data_nw['baseURL'] = $baseURL;
	       $data_nw['offset'] = $offset;
	       $data_nw['limit'] = $limit;
	       $data_nw['rowCount']  = $rowCount;
	        
           $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw." ORDER BY `fabric_code` DESC LIMIT $offset, $limit "; 
           $result = $this->db->query($sql);
	       $data = $result->result();
	       $data_nw['fabric_detail'] = $data; 
	       
	       //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
           $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	       
	       
	       
	       
	       
	       
	       
	       
	      
	   }
	   
	   
	   elseif((!empty($new_fabric_datanw)) && (!empty($new_fabrictypedata)))
    	{
    	   $str1 = '';
             for ($x = 0; $x < count($new_fabric_datanw); $x++) {
                $str1 .= ' fabric_pattern_id = '.$new_fabric_datanw[$x].' OR ';
              }
           
           $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);
           
           $strnew1nw = '('.$strnew1.')';
            
            
            
            $str0 = '';
             for ($x = 0; $x < count($new_fabrictypedata); $x++) {
                $str0 .= ' fabric_type_id = '.$new_fabrictypedata[$x].' OR ';
              }
           
           $strnew0= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $strnew0nw = '('.$strnew0.')';
           
           $strnw = $strnew1nw.' AND '.$strnew0nw;
           
           $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw;
           $resultnw = $this->db->query($sqlnw);
	       $rowCount = $resultnw->num_rows(); 
           $data_nw['baseURL'] = $baseURL;
	       $data_nw['offset'] = $offset;
	       $data_nw['limit'] = $limit;
	       $data_nw['rowCount']  = $rowCount;
	        
           $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw." ORDER BY `fabric_code` DESC LIMIT $offset, $limit "; 
           $result = $this->db->query($sql);
	       $data = $result->result();
	       $data_nw['fabric_detail'] = $data; 
	       
	       //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
           $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	       
	       
	       
	       
	       
	       
	       
	       
	      
	   }
	   
    	
    	elseif((!empty($new_fabric_colordata)))
    	{  
    	    
    	    
    	    
    	    
    	    
    	    
    	    $str1 = '';
             for ($x = 0; $x < count($new_fabric_colordata); $x++) {
                $str1 .= ' color_id = '.$new_fabric_colordata[$x].' OR ';
              }
           
            $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);

            $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnew1;
           
	        $resultnw = $this->db->query($sqlnw);
	        $rowCount = $resultnw->num_rows(); 

	        $data_nw['baseURL'] = $baseURL;
	        $data_nw['offset'] = $offset;
	        $data_nw['limit'] = $limit;
	        $data_nw['rowCount']  = $rowCount;
             
          $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnew1." ORDER BY `fabric_code` DESC LIMIT $offset, $limit ";
	      $result = $this->db->query($sql);
	      $data = $result->result();
          
          $data_nw['fabric_detail'] = $data; 
          
          //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
          $this->load->view('list_fabric_nwallnew.php', $data_nw); 
    	
    	    
    	}
    	else{
    	    
    	    $data_nw['fabric_detail'] = $this->Crud_model->datanwnew('fabric_temporary_data');
             $rowCount = $this->Crud_model->countone('fabric_temporary_data','status0',1);
            

	        $data_nw['baseURL'] = $baseURL;
	        $data_nw['offset'] = $offset;
	        $data_nw['limit'] = $limit;
	        $data_nw['rowCount']  = $rowCount; 
	        
	        //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
            $this->load->view('list_fabric_nwall.php', $data_nw);
    	}
    	
    }
    
    
    
    
    public function getdata_alldata_getdata_url(){
        
        $baseURL = 'http://inventory.ssrtechvision.com/getdata_allnew'; 
        $offset = !empty($_POST['page'])?$_POST['page']:0; 
        $limit = 10; 
 
        
    	$fabrictypedata = $_POST['fabrictypedata']; 
    	$fabric_datanw = $_POST['fabric_datanw'];
    	$fabric_colordata = $_POST['fabric_colordata'];
    	
    	$new_fabrictypedata = json_decode($fabrictypedata);
    	$new_fabric_datanw = json_decode($fabric_datanw); 
    	$new_fabric_colordata = json_decode($fabric_colordata); 
  
    	if(((!empty($new_fabric_colordata)) && (!empty($new_fabric_datanw))  && (!empty($new_fabrictypedata))) )
    	{
    	   $str1 = '';
             for ($x = 0; $x < count($new_fabric_colordata); $x++) {
                $str1 .= ' color_id = '.$new_fabric_colordata[$x].' OR ';
              }
           
           $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);
           
           $strnew1nw = '('.$strnew1.')';
            
            
            
            $str0 = '';
             for ($x = 0; $x < count($new_fabric_datanw); $x++) {
                $str0 .= ' fabric_pattern_id = '.$new_fabric_datanw[$x].' OR ';
              }
           
           
           $strnew0= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $strnew0nw = '('.$strnew0.')';
           
           $stringnw = '';
             for ($x = 0; $x < count($new_fabrictypedata); $x++) {
                $str0 .= ' fabric_type_id = '.$new_fabrictypedata[$x].' OR ';
              }
           
           
           $stringnw= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $stringnw0 = '('.$stringnw.')';
           
           $strnw = $strnew1nw.' AND '.$strnew0nw.' AND '.$stringnw0;
           
           $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw;
           $resultnw = $this->db->query($sqlnw);
	       $rowCount = $resultnw->num_rows(); 
           $data_nw['baseURL'] = $baseURL;
	       $data_nw['offset'] = $offset;
	       $data_nw['limit'] = $limit;
	       $data_nw['rowCount']  = $rowCount;
	        
           $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw." ORDER BY `fabric_code` DESC LIMIT $offset, $limit "; 
          
           $result = $this->db->query($sql);
	       $data = $result->result();
	       $data_nw['fabric_detail'] = $data;  
	       
	       //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
           $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	       
	       
	       
	       
	       
	      
    	    
    	}
    	
    	
    	elseif((!empty($new_fabric_colordata)) && (!empty($new_fabric_datanw)))
    	{
    	   $str1 = '';
             for ($x = 0; $x < count($new_fabric_colordata); $x++) {
                $str1 .= ' color_id = '.$new_fabric_colordata[$x].' OR ';
              }
           
           $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);
           
           $strnew1nw = '('.$strnew1.')';
            
            
            
            $str0 = '';
             for ($x = 0; $x < count($new_fabric_datanw); $x++) {
                $str0 .= ' fabric_pattern_id = '.$new_fabric_datanw[$x].' OR ';
              }
           
           $strnew0= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $strnew0nw = '('.$strnew0.')';
           
           $strnw = $strnew1nw.' AND '.$strnew0nw;
           
           $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw;
           $resultnw = $this->db->query($sqlnw);
	       $rowCount = $resultnw->num_rows(); 
           $data_nw['baseURL'] = $baseURL;
	       $data_nw['offset'] = $offset;
	       $data_nw['limit'] = $limit;
	       $data_nw['rowCount']  = $rowCount;
	        
           $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw." ORDER BY `fabric_code` DESC LIMIT $offset, $limit "; 
           $result = $this->db->query($sql);
	       $data = $result->result();
	       $data_nw['fabric_detail'] = $data; 
	       
	       //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
           $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	       
	       
	       
	       
	       
	       
	       
	       
	      
	   }
	   //////////////////////////////////////////////////////////
	   
	   
	   elseif((!empty($new_fabric_colordata)) && (empty($new_fabric_datanw)))
	   {
	        $str1 = '';
             for ($x = 0; $x < count($new_fabric_colordata); $x++) {
                $str1 .= ' color_id = '.$new_fabric_colordata[$x].' OR ';
              }
           
            $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);

            $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnew1;
           
	        $resultnw = $this->db->query($sqlnw);
	        $rowCount = $resultnw->num_rows(); 

	        $data_nw['baseURL'] = $baseURL;
	        $data_nw['offset'] = $offset;
	        $data_nw['limit'] = $limit;
	        $data_nw['rowCount']  = $rowCount;
             
          $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnew1." ORDER BY `fabric_code` DESC LIMIT $offset, $limit ";
	      $result = $this->db->query($sql);
	      $data = $result->result();
          
          $data_nw['fabric_detail'] = $data; 
          
          //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
          $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	   }
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   /////////////////////////////////////////////////////////
	   
	   
	   elseif((!empty($new_fabric_colordata)) && (!empty($new_fabrictypedata)))
    	{
    	   $str1 = '';
             for ($x = 0; $x < count($new_fabric_colordata); $x++) {
                $str1 .= ' color_id = '.$new_fabric_colordata[$x].' OR ';
              }
           
           $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);
           
           $strnew1nw = '('.$strnew1.')';
            
            
            
            $str0 = '';
             for ($x = 0; $x < count($new_fabrictypedata); $x++) {
                $str0 .= ' fabric_type_id = '.$new_fabrictypedata[$x].' OR ';
              }
           
           $strnew0= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $strnew0nw = '('.$strnew0.')';
           
           $strnw = $strnew1nw.' AND '.$strnew0nw;
           
           $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw;
           $resultnw = $this->db->query($sqlnw);
	       $rowCount = $resultnw->num_rows(); 
           $data_nw['baseURL'] = $baseURL;
	       $data_nw['offset'] = $offset;
	       $data_nw['limit'] = $limit;
	       $data_nw['rowCount']  = $rowCount;
	        
           $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw." ORDER BY `fabric_code` DESC LIMIT $offset, $limit "; 
           $result = $this->db->query($sql);
	       $data = $result->result();
	       $data_nw['fabric_detail'] = $data;  
	       
	       //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
           $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	       
	       
	       
	       
	       
	       
	       
	       
	      
	   }
	   
	   
	   elseif((!empty($new_fabric_datanw)) && (!empty($new_fabrictypedata)))
    	{
    	   $str1 = '';
             for ($x = 0; $x < count($new_fabric_datanw); $x++) {
                $str1 .= ' fabric_pattern_id = '.$new_fabric_datanw[$x].' OR ';
              }
           
           $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);
           
           $strnew1nw = '('.$strnew1.')';
            
            
            
            $str0 = '';
             for ($x = 0; $x < count($new_fabrictypedata); $x++) {
                $str0 .= ' fabric_type_id = '.$new_fabrictypedata[$x].' OR ';
              }
           
           $strnew0= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str0);
           $strnew0nw = '('.$strnew0.')';
           
           $strnw = $strnew1nw.' AND '.$strnew0nw;
           
           $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw;
           $resultnw = $this->db->query($sqlnw);
	       $rowCount = $resultnw->num_rows(); 
           $data_nw['baseURL'] = $baseURL;
	       $data_nw['offset'] = $offset;
	       $data_nw['limit'] = $limit;
	       $data_nw['rowCount']  = $rowCount;
	        
           $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnw." ORDER BY `fabric_code` DESC LIMIT $offset, $limit "; 
           $result = $this->db->query($sql);
	       $data = $result->result();
	       $data_nw['fabric_detail'] = $data; 
	       
	       //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
           $this->load->view('list_fabric_nwallnew.php', $data_nw); 
	       
	       
	       
	       
	       
	       
	       
	       
	      
	   }
	   
	   
	   
	   
    	elseif((!empty($new_fabric_datanw) > 0)){
    	    
    	    $str1 = '';
             for ($x = 0; $x < count($new_fabric_datanw); $x++) {
                $str1 .= ' fabric_pattern_id = '.$new_fabric_datanw[$x].' OR ';
              }
            
          $strnew1= preg_replace('/\W\w+\s*(\W*)$/', '$1', $str1);

            $sqlnw= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnew1;
	        $resultnw = $this->db->query($sqlnw);
	        $rowCount = $resultnw->num_rows();

	        $data_nw['baseURL'] = $baseURL;
	        $data_nw['offset'] = $offset;
	        $data_nw['limit'] = $limit;
	        $data_nw['rowCount']  = $rowCount;
             
          $sql= "SELECT * FROM `fabric_temporary_data` WHERE ".$strnew1." ORDER BY `fabric_code` DESC LIMIT $offset, $limit ";
	      $result = $this->db->query($sql);
	      $data = $result->result();
          $data_nw['fabric_detail'] = $data;  
          
          //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
          $this->load->view('list_fabric_nwallnew.php', $data_nw); 
    	}
    	elseif(empty($new_fabric_datanw)){
    	    
    	    $data_nw['fabric_detail'] = $this->Crud_model->datanwnew('fabric_temporary_data');
             $rowCount = $this->Crud_model->countone('fabric_temporary_data','status0',1);
            

	        $data_nw['baseURL'] = $baseURL;
	        $data_nw['offset'] = $offset;
	        $data_nw['limit'] = $limit;
	        $data_nw['rowCount']  = $rowCount;  
	        
	        //////////////////////////////////////////////////////
	       $data_nw['nw'] = $_POST['page'];
            $this->load->view('list_fabric_nwall.php', $data_nw); ///////////
    	}
    	/*else{
    	    $data_nw['fabric_detail'] = $this->Crud_model->datanwnew('fabric_temporary_data');
             $rowCount = $this->Crud_model->countone('fabric_temporary_data','status0',1);
            

	        $data_nw['baseURL'] = $baseURL;
	        $data_nw['offset'] = $offset;
	        $data_nw['limit'] = $limit;
	        $data_nw['rowCount']  = $rowCount;
            $this->load->view('list_fabric_nwall.php', $list_detail);
    	}*/
    	
    }

    //-------------------commented starts -------------------------------------------------------//
    /*public function add_info_detail()
    {
        if($this->input->is_ajax_request() && $this->input->post('type') == 'info_detail')
		{
             $fabric_code = $this->input->post('fabric_code');
             $fabric_color = $this->input->post('fabric_color');
             $info_data = $this->input->post('info_data');
			 


		     //$total_qty = $this->input->post('total_qty');
			 $fabric_width = $this->input->post('fabric_width');
			 $fabric_type = $this->input->post('fabric_type');
			 $fabric_pattern =  $this->input->post('fabric_pattern');
			 
             
              

             $swatch_card =  $this->input->post('swatch_card');
			 $defect_type =  $this->input->post('defect_type');
			 $defect_qty  =  $this->input->post('defect_qty');
			 $defect_remarks = $this->input->post('defect_remarks');
             


             //new_chnages
			 $string_fabric_code = preg_replace('/\s+/', '',$fabric_code);
             //new_chnages
             
			 $shrinkage_before_test_h = $this->input->post('shrinkage_before_test_h');
             $shrinkage_before_test_w = $this->input->post('shrinkage_before_test_w');
             $shrinkage_fabric_code_h = $this->input->post('shrinkage_fabric_code_h');
             $shrinkage_fabric_code_w = $this->input->post('shrinkage_fabric_code_w');
             $shrinkage_comments =  $this->input->post('shrinkage_comments');
             
             $with_water_response = $this->input->post('with_water_response');
             $with_soap_response =  $this->input->post('with_soap_response');
             $colorbleed_comments = $this->input->post('colorbleed_comments');
             $file = $this->input->post('file');
             $file_data = $this->input->post('file_data');
             $fullname =  $this->input->post('fullname');
             $total_qty_unit = $this->input->post('total_qty_unit');
             $fabric_defect_qty = $this->input->post('fabric_defect_qty');
             

             
             $file_info_newdata = $this->input->post('file_info_newdata');
             $file = array();
             $file[0]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/624/10_-1623668705-0.webp';
             $file[1]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/623/118840685_3345705882156607_6176971491071505058_n__1__-1622789547-0.webp';
             
             $file_data = array();
             $file_data[0]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/624/10_-1623668705-0.webp';
             $file_data[1]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/623/118840685_3345705882156607_6176971491071505058_n__1__-1622789547-0.webp';
             
             



             $dataArr = array(
             	             'fabric_code' => $fabric_code,
                             'fabric_color' => $fabric_color,
                             'info_data' => $info_data,
                             
                              
                             'fabric_type' => $fabric_type,
                             'fabric_pattern' => $fabric_pattern,
                             'swatch_card' => $swatch_card,
                             'defect_type' => $defect_type,
                             'defect_qty' => $defect_qty,
                             'defect_remarks' => $defect_remarks,
                             'shrinkage_before_test_h' => $shrinkage_before_test_h,
                             'shrinkage_before_test_w' => $shrinkage_before_test_w,
                             'shrinkage_fabric_code_h' => $shrinkage_fabric_code_h,
                             'shrinkage_fabric_code_w' => $shrinkage_fabric_code_w,
                             'shrinkage_comments' => $shrinkage_comments,
                             'with_water_response' => $with_water_response,
                             'with_soap_response' => $with_soap_response,
                             'colorbleed_comments' => $colorbleed_comments,
                             'file' => json_encode($file),
                             'file_data' => json_encode($file_data),
                             'fullname' => $fullname,

                             'fabric_defect_qty' => $fabric_defect_qty,
                             'file_info_newdata' => $file_info_newdata

             	            );
             
             $insert['basic_data'] = json_encode($dataArr);
             $insert['status0'] = 1;




             //new_chnages
             $insert['fabric_code'] = $string_fabric_code;
			 
             $insert['fabric_type_id'] = $fabric_type;
             $insert['fabric_pattern_id'] = $fabric_pattern;
             //new_chnages

             $insert['updated_on'] = date('Y-m-d H:i:s');
        
	         $done = $this->Crud_model->insertData('fabric_temporary_data',$insert);
             

             $hash_data = hash('sha256', $done);
	         $update['record_slug0'] = $hash_data;

	         //searching data
             $arrFabric = array(
             	                  'fabric_code' => $fabric_code,
             	                  'info_data' => $info_data,
             	                  'status' => 1,
             	                  'fabric_temporary_data_id' => $done,
             	                  'created_on' => date('Y-m-d H:i:s'),
             	                  'fabric_color' => $fabric_color,
             	                  'hash_data' => $hash_data,
             	                  'file_info_newdata' => $file_info_newdata
                                );

             $this->Crud_model->insertData('fabric_detail',$arrFabric);


	         $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $done);

	         if($done != 0)
	         {
	           $data['status'] = 'success';
	           $data['message'] = 'Info saved successfully';

	           $data['redirect'] = base_url().'add-inventory/'.$update['record_slug0'];
	           
	           print_r(json_encode($data));
	         
	         }
	         else
	         {
	           $data['status'] = false;
	           $data['message'] = 'something went wrong.Not able to save the info details';
	        
	           print_r(json_encode($data));
	         }
		}
     
     }
    */

   


   
     public function add_info_detail()
      {
        if($this->input->is_ajax_request() && $this->input->post('type') == 'info_detail')
		{    
             $fabric_code = $this->input->post('fabric_code');
             $fabric_color = $this->input->post('fabric_color');
			 $fabric_type = $this->input->post('fabric_type');
			 $fabric_pattern =  $this->input->post('fabric_pattern');
			 $swatch_card =  $this->input->post('swatch_card');
             //new_chnages
			 $string_fabric_code = preg_replace('/\s+/', '',$fabric_code);
             //new_chnages
             $file = $this->input->post('file');
             $file_data = $this->input->post('file_data');
             $file_info_newdata = $this->input->post('file_info_newdata');
             
             $file = array();
             $file[0]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/624/10_-1623668705-0.webp';
             $file[1]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/623/118840685_3345705882156607_6176971491071505058_n__1__-1622789547-0.webp';
             
             $file_data = array();
             $file_data[0]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/624/10_-1623668705-0.webp';
             $file_data[1]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/623/118840685_3345705882156607_6176971491071505058_n__1__-1622789547-0.webp';
             
             $dataArr = array(
             	             'fabric_code' => $fabric_code,
                             'fabric_color' => $fabric_color,
                             'fabric_type' => $fabric_type,
                             'fabric_pattern' => $fabric_pattern,
                             'swatch_card' => $swatch_card,
                             'file' => json_encode($file),
                             'file_data' => json_encode($file_data),
                             'file_info_newdata' => $file_info_newdata
                             );
             
             $insert['basic_data'] = json_encode($dataArr);
             $insert['status0'] = 1;

             //new_chnages
             $insert['fabric_code'] = $string_fabric_code;
			 $insert['fabric_type_id'] = $fabric_type;
             $insert['fabric_pattern_id'] = $fabric_pattern;
             $insert['updated_on'] = date('Y-m-d H:i:s');
             //new_chnages
             $done = $this->Crud_model->insertData('fabric_temporary_data',$insert);
             
             $hash_data = hash('sha256', $done);
	         $update['record_slug0'] = $hash_data;

	         //searching data
             $arrFabric = array(
             	                  'fabric_code' => $fabric_code,
             	                  /*'info_data' => $info_data,*/
             	                  'status' => 1,
             	                  'fabric_temporary_data_id' => $done,
             	                  'created_on' => date('Y-m-d H:i:s'),
             	                  'fabric_color' => $fabric_color,
             	                  'hash_data' => $hash_data,
             	                  'file_info_newdata' => $file_info_newdata
                                );

             $this->Crud_model->insertData('fabric_detail',$arrFabric);


	         $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $done);

	         if($done != 0)
	         {
	           $data['status'] = 'success';
	           $data['message'] = 'Info saved successfully';
               $data['fabric_codeid'] = $done;
	           $data['redirect'] = base_url().'edit-initial-fabric/'.$update['record_slug0'];
	           
	           print_r(json_encode($data));
	         
	         }
	         else
	         {
	           $data['status'] = false;
	           $data['message'] = 'something went wrong.Not able to save the info details';
	        
	           print_r(json_encode($data));
	         }
		}
     
     }



     public function edit_info_detail()
     {
        if($this->input->is_ajax_request() && $this->input->post('type') == 'edit_info_detail')
		{    
			 //print_r($_POST); die;
			 //$id = $this->input->post('id');
			 $id = $this->input->post('fabric_codeid'); 

			 $fabric_code = $this->input->post('fabric_code');     
             $fabric_color = $this->input->post('fabric_color');
			 $fabric_type = $this->input->post('fabric_type');
			 $fabric_pattern =  $this->input->post('fabric_pattern');
			 $swatch_card =  $this->input->post('swatch_card');
             $file = $this->input->post('file');
             $file_data = $this->input->post('file_data');
             $file_info_newdata = $this->input->post('file_info_newdata');
             
             $file = array();
             $file[0]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/624/10_-1623668705-0.webp';
             $file[1]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/623/118840685_3345705882156607_6176971491071505058_n__1__-1622789547-0.webp';
             
             $file_data = array();
             $file_data[0]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/624/10_-1623668705-0.webp';
             $file_data[1]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/623/118840685_3345705882156607_6176971491071505058_n__1__-1622789547-0.webp';
             
             $dataArr = array(
                             'fabric_code' => $fabric_code,
                             'fabric_color' => $fabric_color,
                             'fabric_type' => $fabric_type,
                             'fabric_pattern' => $fabric_pattern,
                             'swatch_card' => $swatch_card,
                             'file' => json_encode($file),
                             'file_data' => json_encode($file_data),
                             'file_info_newdata' => $file_info_newdata
                             );
             
             $insert['basic_data'] = json_encode($dataArr);
             $insert['status0'] = 1;

             //new_chnages
			 $insert['fabric_type_id'] = $fabric_type;
             $insert['fabric_pattern_id'] = $fabric_pattern;
             $insert['updated_on'] = date('Y-m-d H:i:s');
             //new_chnages
             

             $this->Crud_model->updatetable('fabric_temporary_data', $insert, 'id', $id);
             
             $hash_data = hash('sha256', $id);
	         $update['record_slug0'] = $hash_data;

	         //searching data
             $arrFabric = array(
             	                  'status' => 1,
             	                  'fabric_temporary_data_id' => $id,
             	                  'created_on' => date('Y-m-d H:i:s'),
             	                  'fabric_color' => $fabric_color,
             	                  'hash_data' => $hash_data,
             	                  'file_info_newdata' => $file_info_newdata
                                );
             $this->Crud_model->updatetable('fabric_detail', $arrFabric, 'id', $id);


	      
              
             $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $id);
	         if($id != 0)
	         {
	           $data['status'] = 'success';
	           $data['message'] = 'Info saved successfully';
               $data['fabric_codeid'] = $id;
	           print_r(json_encode($data));
	         
	         }
	         else
	         {
	           $data['status'] = false;
	           $data['message'] = 'something went wrong.Not able to save the info details';
	        
	           print_r(json_encode($data));
	         }
		}
     }






     public function add_infomodal_data()
     {
       
        if($this->input->is_ajax_request() && $this->input->post('type') == 'add_infomodal_data')
		{   
			
			$invoiceId = $this->input->post('invoiceId');
			$cpurchase_qty = $this->input->post('cpurchase_qty');
			$cpurchase_qty_units = $this->input->post('cpurchase_qty_units');
			$fabric_width = $this->input->post('fabric_width');
			$fabric_width_units = $this->input->post('fabric_width_units');
			$cpriceInfo = $this->input->post('cpriceInfo');
			$total_price = $this->input->post('total_price');
			$vendor_details = $this->input->post('vendor_details');
			$dateofentry = $this->input->post('dateofentry');
			$user_added = $this->input->post('user_added');
            $fabric_code_id = $this->input->post('fabric_codeid');

			$arrDetails = array(
             	                  'invoiceId' => $invoiceId,
             	                  'cpurchase_qty' => $cpurchase_qty,
             	                  'cpurchase_qty_units' => $cpurchase_qty_units,
             	                  'fabric_width' => $fabric_width,
             	                  'fabric_width_units' => $fabric_width_units,
             	                  'cpriceInfo' => $cpriceInfo,
                                  'total_price' => $total_price,
                                  'vendor_details' => $vendor_details,
                                  'dateofentry' => $dateofentry,
                                  'user_added' => $user_added,
                                  'status' => 1,
             	                  'fabric_temporary_data_id' => $fabric_code_id,
             	                  'created_on' => date('Y-m-d H:i:s'),       
                                );
             
             $done = $this->Crud_model->insertData('fabric_purchase_detail',$arrDetails);
             
            

             

             $newdata = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data','id', $fabric_code_id);  
             $record_slug_data = $newdata[0]->record_slug0;

             if($done != 0)
	         {
	           $data['status'] = 'success';
	           $data['message'] = 'Fabric purchase details saved successfully';
               $data['fabric_codeid'] = $done;
	           $data['redirect'] = base_url().'add-fabric-basic-info/'.$record_slug_data;
	           
	           print_r(json_encode($data));
	         
	         }
	         else
	         {
	           $data['status'] = false;
	           $data['message'] = 'something went wrong.Not able to save the purchase details';

	           print_r(json_encode($data));
	         }
		}
     }


      public function edit_infomodal_data()
     {
       
        if($this->input->is_ajax_request() && $this->input->post('type') == 'edit_infomodal_data')
		{   
			
            

			$cpurchase_qty = $this->input->post('cpurchase_qty');
			$cpurchase_qty_units = $this->input->post('cpurchase_qty_units');
			$fabric_width = $this->input->post('fabric_width');
			$fabric_width_units = $this->input->post('fabric_width_units');
			$cpriceInfo = $this->input->post('cpriceInfo');
			$total_price = $this->input->post('total_price');
			$vendor_details = $this->input->post('vendor_details');
            $fabric_code_id = $this->input->post('fabric_codeid');
            $id = $this->input->post('data_id');

			$arrDetails = array(
             	                  'cpurchase_qty' => $cpurchase_qty,
             	                  'cpurchase_qty_units' => $cpurchase_qty_units,
             	                  'fabric_width' => $fabric_width,
             	                  'fabric_width_units' => $fabric_width_units,
             	                  'cpriceInfo' => $cpriceInfo,
                                  'total_price' => $total_price,
                                  'vendor_details' => $vendor_details,
             	                  'fabric_temporary_data_id' => $fabric_code_id,     
                                );
             
             $this->Crud_model->updatetable('fabric_purchase_detail', $arrDetails, 'id', $id);
             
            
             $newdata = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data','id', $fabric_code_id);  
             $record_slug_data = $newdata[0]->record_slug0;

             if(true)
	         {
	           $data['status'] = 'success';
	           $data['message'] = 'Fabric purchase details updated successfully';
               $data['fabric_codeid'] = $done;
	           $data['redirect'] = base_url().'add-fabric-basic-info/'.$record_slug_data;
	           
	           print_r(json_encode($data));
	         
	         }
	         else
	         {
	           $data['status'] = false;
	           $data['message'] = 'something went wrong.Not able to update the purchase details';

	           print_r(json_encode($data));
	         }
		}
     }







     public function edit_initial_fabric()
     {
        $hash_id = $this->uri->segment(2);
        $data['fabric_temporary_data'] = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $hash_id);  
    	$data['fabric_pattern_list'] = $this->Crud_model->fetchalldatawithcondition('fabric_pattern_list', 'is_active', 1);  
        $data['fabric_type'] =  $this->Crud_model->fetchalldatawithcondition('fabric_type_list','is_active', 1);
        $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
        $data['colora'] = $this->Crud_model->fetchalldatawithcondition('color','status', 1); 
        $data['vendor_detail'] = $this->Crud_model->fetchalldatawithcondition('cvendor_detail','status', 1);
        $data["hash_id"] = $hash_id;
        $this->load->view('edit_initial_fabric.php',$data);
     }
















     public function edit_initial_fabric_read()
     {
        $hash_id = $this->uri->segment(2);
        $data['fabric_temporary_data'] = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $hash_id);  
    	$data['fabric_pattern_list'] = $this->Crud_model->fetchalldatawithcondition('fabric_pattern_list', 'is_active', 1);  
        $data['fabric_type'] =  $this->Crud_model->fetchalldatawithcondition('fabric_type_list','is_active', 1);
        $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
        $data['colora'] = $this->Crud_model->fetchalldatawithcondition('color','status', 1); 
        $data['vendor_detail'] = $this->Crud_model->fetchalldatawithcondition('cvendor_detail','status', 1);
        $this->load->view('edit_initial_fabric_read.php',$data);
     }



     public function remove_purchase_record()
     {
        
        if($this->input->is_ajax_request() && $this->input->post('type') == 'remove_purchase_record')
		{
			$id = $this->input->post('id');
		    
		    if($id != 0)
		    {

				 	$data = $this->Crud_model->delete('fabric_purchase_detail',$id);
				 	if($data == true)
				 	{
		                $datanew['status'] = true;
		                $datanew['message'] = 'Requested fabric purchase details deleted successfully';
				 	}
				 	else
				 	{
		              $datanew['status'] = false;
		              $datanew['message'] = 'something went wrong';
				 	}

		    }
		    else
		    {

				 	$datanew['status'] = false;
		            $datanew['message'] = 'something went wrong';
	        }
		 
	        echo  json_encode($datanew); die();
	    }

     }








    public function url_data()
    {
      if($this->input->is_ajax_request() && $this->input->post('type') == 'url_data')
	  {
			$hash_id = $this->input->post('hash_id');
			$fabric_temporary_data = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $hash_id);  
            $fabric_id = $fabric_temporary_data[0]->id;
            
            $sqlnw= "SELECT * FROM `fabric_purchase_detail` WHERE `fabric_temporary_data_id` = $fabric_id ORDER BY `id` DESC";
            $resultnw = $this->db->query($sqlnw);
            $rowCount = $resultnw->num_rows(); 
            
            if($rowCount > 0)
		 	{
                $datanew['status'] = "success";
                $datanew['redirect'] = base_url()."add-fabric-basic-info/".$hash_id;
                
		 	}
		 	else if($rowCount == 0)
		 	{
              $datanew['status'] = "error";
              $datanew['redirect'] = base_url()."edit-initial-fabric/".$hash_id;
		 	}
            
            echo  json_encode($datanew); die();
	  }
    }







   









   public function url_querydata()
   {
     if($this->input->is_ajax_request() && $this->input->post('type') == 'url_querydata')
	  {
			$hash_id = $this->input->post('hash_id');
			$fabric_temporary_data = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $hash_id);  
            $fabric_id = $fabric_temporary_data[0]->id;
            
            $sqlnw= "SELECT * FROM `fabric_purchase_detail` WHERE `fabric_temporary_data_id` = $fabric_id ORDER BY `id` DESC";
            $resultnw = $this->db->query($sqlnw);
            $rowCount = $resultnw->num_rows(); 
            
            if($rowCount > 0)
		 	{
                $datanew['status'] = "success";
                $datanew['redirect'] = base_url()."add-fabric-basic-info-read/".$hash_id;
                
		 	}
		 	else if($rowCount == 0)
		 	{
              $datanew['status'] = "error";
              $datanew['redirect'] = base_url()."edit-initial-fabric-read/".$hash_id;
		 	}
            
            echo  json_encode($datanew); die();
	  }
   }


   public function render_unarchive_lists()
   {
        if($this->common->is_logged_in())
		{   
			$list_detail['fabric_detail'] = $this->Crud_model->datanwNewunarchieve('fabric_temporary_data');
            $list_detail['all_colora'] = $this->Crud_model->fetchalldata('color');
            $list_detail['all_fabric'] = $this->Crud_model->fetchalldata('fabric_pattern_list');
            $list_detail['all_fabric_nw'] = $this->Crud_model->fetchalldata('fabric_type_list');
            //$list_detail['rowCount'] = $this->Crud_model->countone('fabric_temporary_data','status0',1);
            $this->load->view('unarchieve.php', $list_detail);    

		}
		else
		{
			$this->load->view('login.php');
		}
   
   }

   public function addnew_inventory_detail()
   {
      $type = $_POST['type'];
      $defect_type = $_POST['defect_type'];
      $defect_qty = $_POST['defect_qty'];
      $defect_qty_unit = $_POST['defect_qty_unit'];
      $defect_remarks = $_POST['defect_remarks'];
      $with_water_response = $_POST['with_water_response'];
      $with_soap_response = $_POST['with_soap_response'];
      $colorbleed_comments = $_POST['colorbleed_comments'];
      $shrinkage_before_test_h = $_POST['shrinkage_before_test_h'];
      $shrinkage_before_test_w = $_POST['shrinkage_before_test_w'];
      $shrinkage_fabric_code_h = $_POST['shrinkage_fabric_code_h'];
      $shrinkage_fabric_code_w = $_POST['shrinkage_fabric_code_w'];
      $shrinkage_comments = $_POST['shrinkage_comments'];
      $return_qty = $_POST['return_qty'];
      $return_qty_unit = $_POST['return_qty_unit'];
      $return_date = $_POST['return_date'];
      $return_reason = $_POST['return_reason'];
      $total_qty = $_POST['total_qty'];
      $total_qty_unit = $_POST['total_qty_unit'];
      $fabric_width = $_POST['fabric_width'];
      $fabric_width_unit = $_POST['fabric_width_unit'];
      $data_fabric_date_data_1 = $_POST['data_fabric_date_data_1'];
      $store1 = $_POST['store1'];
      $storeunit1 = $_POST['storeunit1'];
      $store2 = $_POST['store2'];
      $storeunit2 = $_POST['storeunit2'];
      $storetotal_qty = $_POST['storetotal_qty'];
      $add_sku_no_1 = $_POST['add_sku_no_1'];
      $add_sku_no_2 = $_POST['add_sku_no_2'];
      $add_sku_no_3 = $_POST['add_sku_no_3'];
      $add_sku_no_4 = $_POST['add_sku_no_4'];
      $add_sku_no_5 = $_POST['add_sku_no_5'];
      $fabric_codeid = $_POST['fabric_codeid'];
      $fabricpurchaseid = $_POST['fabricpurchaseid'];
      $hash_id = $_POST['hash_id']; 
      $lotno1 = $_POST['lotno1'];
      $lotno2 = $_POST['lotno2'];

      $after_shrinkage_qty = $_POST['after_shrinkage_qty']; 
      $after_shrinkage_qtyunits = $_POST['after_shrinkage_qtyunits'];

      $arrFabric = array(
     	                  'defect_type' => $defect_type,
     	                  'defect_qty' => $defect_qty,
     	                  'defect_qty_unit' => $defect_qty_unit,
     	                  'defect_remarks' => $defect_remarks,
     	                  'with_water_response' => $with_water_response,
     	                  'with_soap_response' => $with_soap_response,
     	                  'colorbleed_comments' => $colorbleed_comments,
     	                  'shrinkage_before_test_h' => $shrinkage_before_test_h,
     	                  'shrinkage_before_test_w' => $shrinkage_before_test_w,
     	                  'shrinkage_fabric_code_h' => $shrinkage_fabric_code_h,
     	                  'shrinkage_fabric_code_w' => $shrinkage_fabric_code_w,
     	                  'shrinkage_comments' => $shrinkage_comments,
     	                  'return_qty' => $return_qty,
     	                  'return_qty_unit' => $return_qty_unit,
     	                  'return_date' => $return_date,
     	                  'return_reason' => $return_reason,
     	                  'total_qty' => $total_qty,
     	                  'total_qty_unit' => $total_qty_unit,
     	                  'fabric_width' => $fabric_width,
     	                  'fabric_width_unit' => $fabric_width_unit,
     	                  'data_fabric_date_data_1' => $data_fabric_date_data_1,
     	                  'store1' => $store1,
                          'storeunit1' => $storeunit1,
                          'store2' => $store2,
                          'storeunit2' => $storeunit2,
                          'storetotal_qty' => $storetotal_qty,
                          'add_sku_no_1' => $add_sku_no_1,
                          'add_sku_no_2' => $add_sku_no_2,
                          'add_sku_no_3' => $add_sku_no_3,
                          'add_sku_no_4' => $add_sku_no_4,
                          'add_sku_no_5' => $add_sku_no_5,
                          'fabric_codeid' => $fabric_codeid,
                          'fabricpurchaseid' => $fabricpurchaseid,
                          'lotno1' => $lotno1,
                          'lotno2' => $lotno2,
                          'after_shrinkage_qty' => $after_shrinkage_qty,
                          'after_shrinkage_qtyunits' => $after_shrinkage_qtyunits
                        );


      
      

     $done = $this->Crud_model->insertData('inventory',$arrFabric);

     

     if($done != 0)
     {   
     	 //$hash_inventory_data = hash('sha256', $done);
	     //$update['record_slug0'] = $hash_inventory_data;
         

         $data['status'] = 'success';
	     $data['message'] = 'Info saved successfully';
     
         $data['redirect'] = base_url().'edit_newinventory_detail/'.$hash_id.'/'.$fabricpurchaseid;  

	     print_r(json_encode($data));  die();
     }
     else
     {
         $data['status'] = 'error';
	     $data['message'] = 'something went wrong';
	     print_r(json_encode($data));  die();
     
     }
   
   }  

   
   public function chnage_inventory_detail()
   {
      $type = $_POST['type'];
      $defect_type = $_POST['defect_type'];
      $defect_qty = $_POST['defect_qty'];
      $defect_qty_unit = $_POST['defect_qty_unit'];
      $defect_remarks = $_POST['defect_remarks'];
      $with_water_response = $_POST['with_water_response'];
      $with_soap_response = $_POST['with_soap_response'];
      $colorbleed_comments = $_POST['colorbleed_comments'];
      $shrinkage_before_test_h = $_POST['shrinkage_before_test_h'];
      $shrinkage_before_test_w = $_POST['shrinkage_before_test_w'];
      $shrinkage_fabric_code_h = $_POST['shrinkage_fabric_code_h'];
      $shrinkage_fabric_code_w = $_POST['shrinkage_fabric_code_w'];
      $shrinkage_comments = $_POST['shrinkage_comments'];
      $return_qty = $_POST['return_qty'];
      $return_qty_unit = $_POST['return_qty_unit'];
      $return_date = $_POST['return_date'];
      $return_reason = $_POST['return_reason'];
      $total_qty = $_POST['total_qty'];
      $total_qty_unit = $_POST['total_qty_unit'];
      $fabric_width = $_POST['fabric_width'];
      $fabric_width_unit = $_POST['fabric_width_unit'];
      $data_fabric_date_data_1 = $_POST['data_fabric_date_data_1'];
      $store1 = $_POST['store1'];
      $storeunit1 = $_POST['storeunit1'];
      $store2 = $_POST['store2'];
      $storeunit2 = $_POST['storeunit2'];
      $storetotal_qty = $_POST['storetotal_qty'];
      $add_sku_no_1 = $_POST['add_sku_no_1'];
      $add_sku_no_2 = $_POST['add_sku_no_2'];
      $add_sku_no_3 = $_POST['add_sku_no_3'];
      $add_sku_no_4 = $_POST['add_sku_no_4'];
      $add_sku_no_5 = $_POST['add_sku_no_5'];
      $fabric_codeid = $_POST['fabric_codeid'];
      $fabricpurchaseid = $_POST['fabricpurchaseid'];
      $hash_id = $_POST['hash_id']; 
      $lotno1 = $_POST['lotno1'];
      $lotno2 = $_POST['lotno2'];
   
      $after_shrinkage_qty = $_POST['after_shrinkage_qty']; 
      $after_shrinkage_qtyunits = $_POST['after_shrinkage_qtyunits'];
      
      $inventory_id = $_POST['inventory_id'];
       

      $arrFabric = array(
     	                  'defect_type' => $defect_type,
     	                  'defect_qty' => $defect_qty,
     	                  'defect_qty_unit' => $defect_qty_unit,
     	                  'defect_remarks' => $defect_remarks,
     	                  'with_water_response' => $with_water_response,
     	                  'with_soap_response' => $with_soap_response,
     	                  'colorbleed_comments' => $colorbleed_comments,
     	                  'shrinkage_before_test_h' => $shrinkage_before_test_h,
     	                  'shrinkage_before_test_w' => $shrinkage_before_test_w,
     	                  'shrinkage_fabric_code_h' => $shrinkage_fabric_code_h,
     	                  'shrinkage_fabric_code_w' => $shrinkage_fabric_code_w,
     	                  'shrinkage_comments' => $shrinkage_comments,
     	                  'return_qty' => $return_qty,
     	                  'return_qty_unit' => $return_qty_unit,
     	                  'return_date' => $return_date,
     	                  'return_reason' => $return_reason,
     	                  'total_qty' => $total_qty,
     	                  'total_qty_unit' => $total_qty_unit,
     	                  'fabric_width' => $fabric_width,
     	                  'fabric_width_unit' => $fabric_width_unit,
     	                  'data_fabric_date_data_1' => $data_fabric_date_data_1,
     	                  'store1' => $store1,
                          'storeunit1' => $storeunit1,
                          'store2' => $store2,
                          'storeunit2' => $storeunit2,
                          'storetotal_qty' => $storetotal_qty,
                          'add_sku_no_1' => $add_sku_no_1,
                          'add_sku_no_2' => $add_sku_no_2,
                          'add_sku_no_3' => $add_sku_no_3,
                          'add_sku_no_4' => $add_sku_no_4,
                          'add_sku_no_5' => $add_sku_no_5,
                          'fabric_codeid' => $fabric_codeid,
                          'fabricpurchaseid' => $fabricpurchaseid,
                          'lotno1' => $lotno1,
                          'lotno2' => $lotno2,
                          'after_shrinkage_qty' => $after_shrinkage_qty,
                          'after_shrinkage_qtyunits' => $after_shrinkage_qtyunits
                        );

      
     $this->Crud_model->updatetable('inventory', $arrFabric, 'id', $inventory_id);
      
     $data['status'] = 'success';
	 $data['message'] = 'Info saved successfully';
     
     $data['redirect'] = base_url().'edit_newinventory_detail/'.$hash_id.'/'.$fabricpurchaseid;  
     print_r(json_encode($data));  die();
   }  



  
  








  public function edit_newinventory_detail(){
    
      $hash_id = $this->uri->segment(2); 
  	  
  	  $return = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $hash_id); 
       
      if(!empty($return[0]))
      {
        $id = $return[0];  
        $fabric_code_id = $id->id; 
        $data['id'] = $fabric_code_id;
      }  
    

  	  $fabricpurchaseid = $this->uri->segment(3);  
     
      
      $data['alldata']  =  $this->Crud_model->fetchtabledatatwo('inventory','fabric_codeid',$fabric_code_id,'fabricpurchaseid',$fabricpurchaseid);

     
      $detail = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
      $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
      $data['allnewunit'] = json_encode($detail);
      $data['all_records_data']  =  $this->Crud_model->fetchtabledatatwo('fabric_data','fabric_id',$fabric_code_id,'fabricpurchaseid',$fabricpurchaseid);
      //$data['recordCount'] = count($data['all_records_data']);

      

      
      
      
      
       
     
      if($data['all_records_data'] != 0)
  	  {
  	        $data['recordCount'] = count($data['all_records_data']);
  	  }
      else{
            $data['recordCount'] = 0; 
      }
      
      
      $data['url'] = $hash_id; 
      $data['dataid']  = $fabricpurchaseid;   
      $this->load->view('edit_inventory_info',$data);  
    }





    public function add_inventory_detail_read(){
    
      $hash_id = $this->uri->segment(2);   
  	  
  	  $return = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $hash_id); 
       
      if(!empty($return[0]))
      {
        $id = $return[0];  
        $fabric_code_id = $id->id; 
        $data['id'] = $fabric_code_id;
      }  
    

  	  $fabricpurchaseid = $this->uri->segment(3);  
     
      
      $data['alldata']  =  $this->Crud_model->fetchtabledatatwo('inventory','fabric_codeid',$fabric_code_id,'fabricpurchaseid',$fabricpurchaseid);

     
      $detail = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
      $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
      $data['allnewunit'] = json_encode($detail);
      $data['all_records_data']  =  $this->Crud_model->fetchtabledatatwo('fabric_data','fabric_id',$fabric_code_id,'fabricpurchaseid',$fabricpurchaseid);
      
      if($data['recordCount'] != 0)
  	  {
  	      $data['recordCount'] = count($data['all_records_data']);
  	  }
      else{
        $data['recordCount'] = 0; 
      }
                 
      //$data['recordCount'] = count($data['all_records_data']);

      

      $data['url'] = $hash_id;
      $data['dataid']  = $fabricpurchaseid;   
      $this->load->view('add_inventory_detail_read',$data);  
    }
  









  public function edit_rerender_inventory_detail()
  {
      $hash_id = $this->uri->segment(2); 
  	  
  	  $return = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $hash_id); 
       
      if(!empty($return[0]))
      {
        $id = $return[0];  
        $fabric_code_id = $id->id; 
        $data['id'] = $fabric_code_id;
      }  
    

  	  $fabricpurchaseid = $this->uri->segment(3);  
     
      $data['alldata']  =  $this->Crud_model->fetchtabledatatwo('inventory','fabric_codeid',$fabric_code_id,'fabricpurchaseid',$fabricpurchaseid);
      
      if(!empty($data['alldata'][0]->add_sku_no_1)){
        	$nw1 = 1;
       }
      else{
        	$nw1 = 0;
       }
      if(!empty($data['alldata'][0]->add_sku_no_2)){
       	$nw2 = 1;
      }
      else{
      	$nw2 = 0;
      }

      if(!empty($data['alldata'][0]->add_sku_no_3)){
      	$nw3 = 1;
      }
      else{
      	$nw3 = 0;
      }
      





      if(!empty($data['alldata'][0]->add_sku_no_4)){
      	$nw4 = 1;
      }
      else{
      	$nw4 = 0;
      }
      if(!empty($data['alldata'][0]->add_sku_no_4)){
       $nw5 = 1;
      }
      else{
      	$nw5 = 0;
      }

      $data['addskudata'] = $nw1 + $nw2 + $nw3 + $nw4 +  $nw5;
      $detail = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
      $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
      $data['allnewunit'] = json_encode($detail);
      

      $data['all_records_data']  =  $this->Crud_model->fetchtabledatatwo('fabric_data','fabric_id',$fabric_code_id,'fabricpurchaseid',$fabricpurchaseid); 
      //$data['recordCount'] = count($data['all_records_data']);
     /* if($data['recordCount'] != 0)
  	  {
  	      $data['recordCount'] = count($data['all_records_data']);
  	  }
      else{
        $data['recordCount'] = 0; 
      }*/
      
      if($data['all_records_data'] != 0)
      {
            $data['recordCount'] = count($data['all_records_data']);
      }
      else{
            $data['recordCount'] = 0; 
      }
      
      
      
      
      
      $data['url'] = $hash_id;
      $data['dataid']  = $fabricpurchaseid;   
      $this->load->view('edit_rerender_inventory_detail',$data);  
  }




















public function render_cvendor_lists() 
  {   
  	  $hash_id  = $this->uri->segment(2);

  	  //$hash_id  = '6c658ee83fb7e812482494f3e416a876f63f418a0b8a1f5e76d47ee4177035cb';

  	  $return = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $hash_id); 

      if(!empty($return[0]))
      {
          $id = $return[0];  
          $fabric_code_id = $id->id;
          $fabric_code_detail = $id->basic_data;
          $nwdata = json_decode($fabric_code_detail);

          $fabric_code = $nwdata->fabric_code;
      }



      $data['fabric_code_id'] = $fabric_code_id;

      $data['cvendor_details'] = $this->Crud_model->fetchalldatawithcondition('fabric_purchase_detail','fabric_temporary_data_id', $fabric_code_id); 
      $data['cvendor_all'] = $this->Crud_model->countone('fabric_purchase_detail','fabric_temporary_data_id', $fabric_code_id);

      $data['fabric_code'] = $fabric_code;

      $data['hash_id'] =  $hash_id ;
      

      $this->load->view('new_cvendorlists_show',$data);

  }





   

   public function render_cpurchase_cvendor_detail()
   {

     
       $this->load->view('render_cpurchase_cvendor_detail_show',$data);

   } 

 //---------------------------commented ends-----------------------------------------------//





 
     public function show_inventory()
     {   

     	 $data['url'] = $this->uri->segment(2);

     	 //add_commneted changes 
     	 $data['dataid'] = $this->uri->segment(3);
         //add_commneted changes 
        
     	 $return = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $data['url']); 
         $edit_newinventory_detail = 'edit_newinventory_detail'.'/'.$data['url'].'/'.$data['dataid'];
 
         if(!empty($return[0]))
         {
            $id = $return[0];  
            $data['id'] = $id->id; 
         }
         
         
        $record_data =  $this->Crud_model->fetchtabledatatwo('inventory','fabric_codeid',$data['id'],'fabricpurchaseid',$data['dataid']);
        

        if($record_data != 0)
        {   
        	redirect($edit_newinventory_detail);
       
        }
        else
        {
        	if(!empty($data['url']))
     	    {    
	     	     $detail = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
	     	 	 $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
	     	 	 $data['allnewunit'] = json_encode($detail);
	     	 	 
	     	 	 $data['all_records_data']  =  $this->Crud_model->fetchtabledatatwo('fabric_data','fabric_id',$data['id'],'fabricpurchaseid',$data['dataid']);
	     	 	 
	     	 	 if($data['recordCount'] != 0)
	     	 	 {
	     	 	     $data['recordCount'] = count($data['all_records_data']);
	     	 	 }
                 else{
                    $data['recordCount'] = 0; 
                 }
                

	             $this->load->view('inventory_info',$data);
     	    }
        } 

     }           


    

     public function show_basic_info_on_re_render()
     {   
         $user_data = $this->session->all_userdata();   
         $userid = $this->session->userdata['userdetails']['userid']; 
         $hash_id = $this->uri->segment(2); 
		 //fetch the record for the corresponding id
		 $return['data'][0] = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $hash_id); 

         $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 


         if(!empty($return['data'][0]))
         {
            $id = $return['data'][0];  
            $data['id'] = $id[0]->id;
         }
         
         $data['slug_id'] = $hash_id;
         

         $data['data'] = $return['data'][0];
         $data['fabric_pattern_list'] = $this->Crud_model->fetchalldatawithcondition('fabric_pattern_list', 'is_active', 1);  
         $data['fabric_type'] =  $this->Crud_model->fetchalldatawithcondition('fabric_type_list','is_active', 1);
         $data['colora'] = $this->Crud_model->fetchalldatawithcondition('color','status', 1); 
         $this->load->view('edit_initial_info',$data); 
    }
     






    








    public function change_basic_info_on_re_render()
    {
        if($this->input->is_ajax_request() && $this->input->post('type') == 'info_detail')
		{   
             $fabric_code = $this->input->post('fabric_code');
             if(empty($fabric_code))
             {
				$return['status']= 'fail';
				$return['message'] = 'Fabric code required';
				$ret = json_encode($return);
				echo $ret;die();
			 }


			 $fabric_color = $this->input->post('fabric_color');
             if(empty($fabric_color))
             {
				$return['status']= 'fail';
				$return['message'] = 'Fabric color required';
				$ret = json_encode($return);
				echo $ret;die();
			 } 


			 $info_data = $this->input->post('info_data');
			 $fabric_type = $this->input->post('fabric_type');

             if(empty($fabric_type))
             {
				$return['status']= 'fail';
				$return['message'] = 'Fabric type required';
				$ret = json_encode($return);
				echo $ret;die();
			 } 
            
			 $fabric_pattern =  $this->input->post('fabric_pattern');
			 
             if(empty($fabric_pattern))
             {
				$return['status']= 'fail';
				$return['message'] = 'Fabric pattern required';
				$ret = json_encode($return);
				echo $ret;die();
			 } 
             
             $fabric_defect_qty = $this->input->post('fabric_defect_qty');
			 $swatch_card =  $this->input->post('swatch_card');
			 $defect_type =  $this->input->post('defect_type');
			 /*if(empty($defect_type))
             {
				$return['status']= 'fail';
				$return['message'] = 'Defect type required';
				$ret = json_encode($return);
				echo $ret;die();
			 } */

			/* $defect_qty  =  $this->input->post('defect_qty');
			 if(empty($defect_qty))
             {
				$return['status']= 'fail';
				$return['message'] = 'Defect quantity required';
				$ret = json_encode($return);
				echo $ret;die();
			 } */

			 $defect_remarks = $this->input->post('defect_remarks');
			 $shrinkage_before_test_h = $this->input->post('shrinkage_before_test_h');
             $shrinkage_before_test_w = $this->input->post('shrinkage_before_test_w');
             $shrinkage_fabric_code_h = $this->input->post('shrinkage_fabric_code_h');
             $shrinkage_fabric_code_w = $this->input->post('shrinkage_fabric_code_w');
             $shrinkage_comments =  $this->input->post('shrinkage_comments');
             
             $with_water_response = $this->input->post('with_water_response');
             $with_soap_response =  $this->input->post('with_soap_response');
             $colorbleed_comments = $this->input->post('colorbleed_comments');
             $file = $this->input->post('file');
             $file_data = $this->input->post('file_data');
             $fullname =  $this->input->post('fullname');
             if(empty($fullname))
             {
				$return['status']= 'fail';
				$return['message'] = 'Full name required';
				$ret = json_encode($return);
				echo $ret;die();
			 } 
             
             

             
             
             $file_info_newdata = $this->input->post('file_info_newdata');
             $file = array();
             $file[0]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/624/10_-1623668705-0.webp';
             $file[1]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/623/118840685_3345705882156607_6176971491071505058_n__1__-1622789547-0.webp';




             
             $file_data = array();
             $file_data[0]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/624/10_-1623668705-0.webp';
             $file_data[1]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/623/118840685_3345705882156607_6176971491071505058_n__1__-1622789547-0.webp';
             
             $dataArr = array(
             	             'fabric_code' => $fabric_code,
                             'fabric_color' => $fabric_color,
                             'info_data' => $info_data,

                             'fabric_type' => $fabric_type,
                             'fabric_pattern' => $fabric_pattern,
                             'swatch_card' => $swatch_card,
                             'defect_type' => $defect_type,
                             'defect_qty' => $defect_qty,
                             'defect_remarks' => $defect_remarks,
                             'shrinkage_before_test_h' => $shrinkage_before_test_h,
                             'shrinkage_before_test_w' => $shrinkage_before_test_w,
                             'shrinkage_fabric_code_h' => $shrinkage_fabric_code_h,
                             'shrinkage_fabric_code_w' => $shrinkage_fabric_code_w,
                             'shrinkage_comments' => $shrinkage_comments,
                             'with_water_response' => $with_water_response,
                             'with_soap_response' => $with_soap_response,
                             'colorbleed_comments' => $colorbleed_comments,
                             'file' => json_encode($file),
                             'file_data' => json_encode($file_data),
                             'fullname' => $fullname,
                             'fabric_defect_qty' => $fabric_defect_qty,
                             'file_info_newdata' => $file_info_newdata
             	            );
             

             $update['basic_data'] = json_encode($dataArr);
             
             $update['status0'] = 1;
             $update['updated_on'] = date('Y-m-d H:i:s');
             $update['id'] = $this->input->post('id');
             $record_slug_id = $this->input->post('record_slug');
	         
             $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $update['id']);


             $arrFabric = array(
             	                  'fabric_code' => $fabric_code,
             	                  'info_data' => $info_data,
             	                  'status' => 1,
             	                  'fabric_color' => $fabric_color,
             	                  'hash_data' => $record_slug_id,
             	                  'file_info_newdata' => $file_info_newdata
                                );

             $this->Crud_model->updatetable('fabric_detail', $arrFabric, 'hash_data', $record_slug_id);

            
             $this->Crud_model->insertData('fabric_detail',$arrFabric);

	         $data['status'] = 'success';
	         $data['message'] = 'Info saved successfully';
             //$data['redirect'] = base_url().'add-inventory/'.$record_slug_id;
	         $data['redirect'] = base_url().'edit_inventory_detail/'.$record_slug_id;
	         
	         print_r(json_encode($data));
	         die;
		}
    }

    

    public function show_cvendor_data()
     {   
      
     	 $data['url'] = $this->uri->segment(2);
         $session_id = $this->session->userdata['userdetails']['session_id'];
	     $add_authorization_status = $this->session->userdata['add_auth_detail']['add_authorization_status'];
     	 
     	 $return = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $data['url']); 
         
         if(!empty($return[0]))
         {
            $id = $return[0];  
            $data['id'] = $id->id;   
         }

  
        $update['add_session_id'] = $session_id;
        $update['add_authorization_status'] = $add_authorization_status;

        $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $data['id']); 

     	 if(!empty($data['url']))
     	 {
             $this->load->view('add_cvendor_data.php',$data);
     	 
     	 }
     	 else
     	 {
              redirect('not_found');
     	 }
     }








     


     public function add_new_cvendor_rerender()
     {   
        
     	 $data['url'] = $this->uri->segment(2);
         $session_id = $this->session->userdata['userdetails']['session_id'];
	     $add_authorization_status = $this->session->userdata['add_auth_detail']['add_authorization_status'];
     	 
     	 $return = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $data['url']); 
         
         if(!empty($return[0]))
         {
           

            $id = $return[0];  
            $data['id'] = $id->id;   
         }

  
        $update['add_session_id'] = $session_id;
        $update['add_authorization_status'] = $add_authorization_status;

       
        $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $data['id']); 
        $data['cvendor_all'] = $this->Crud_model->countone('cvendor_detail','fabric_data_id', $data['id']);
     	$data['cvendor_detail'] = $this->Crud_model->fetchtabledataone('cvendor_detail', 'fabric_data_id', $data['id']); 
        
        $this->load->view('cvendor_list.php',$data);
     }


    
     public function add_new_cvendor()
     {
          $id = $this->input->post('id');
          $hash = $this->input->post('hash');
          $return['redirect'] = base_url().'add-cvendor-detail/'.$hash;
          $return['success'] = true;
          $ret = json_encode($return);
		  echo $ret;die();
     }




     public function show_cvendor_info()
     {   
      
     	 $data['url'] = $this->uri->segment(2);
         $session_id = $this->session->userdata['userdetails']['session_id'];
	     $add_authorization_status = $this->session->userdata['add_auth_detail']['add_authorization_status'];
     	 $return = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $data['url']); 
         
         if(!empty($return[0]))
         {
            $id = $return[0];  
            $data['id'] = $id->id; 
         }


        $update['add_session_id'] = $session_id;
        $update['add_authorization_status'] = $add_authorization_status;

        $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $data['id']);

     	 if(!empty($data['url']))
     	 {
            $this->load->view('cvendor_info.php',$data);
     	 }
     	 else
     	 {
              redirect('not_found');
     	 }
     }





      

     public function add_cvendor_detail()
     {
       //print_r($_SESSION); die;
       $swatch_card = $this->input->post('swatch_card');
       $email = $this->input->post('email');
       $primary_contact_no = $this->input->post('primary_contact_no');
       $alt1 = $this->input->post('alt1');
       $alt2 = $this->input->post('alt2');
       $address = $this->input->post('address');
       $fabric_cost = $this->input->post('fabric_cost');
       //$file_type0 = $this->input->post('file_type0');
       //$file_type1 = $this->input->post('file_type1');
       


       $gstin_no = $this->input->post('gstin_no');
       
       $bill_count = $this->input->post('bill_no_total');
       $bill_Arr['bill_no_list'] = array();
       
       

       for ($i = 0; $i < ($bill_count) ; $i++) 
       { 
          $y = $i+1;
       	  $bill_Arr['bill_no_list'][$y] = $this->input->post('bill_no_'.$y);    
       }


       $debit_count = $this->input->post('debit_note_total');
       $debit_Arr['debit_note_list'] = array();
       
       for ($i = 0; $i < ($debit_count) ; $i++) 
       { 

          $y = $i+1;
       	  $debit_Arr['debit_note_list'][$y] = $this->input->post('debit_no_'.$y); 
          
       }
       
       $file = array();
       $file[0]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/624/10_-1623668705-0.webp';
       $file[1]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/623/118840685_3345705882156607_6176971491071505058_n__1__-1622789547-0.webp';


       $file_data = array();
       $file_data[0]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/624/10_-1623668705-0.webp';
       $file_data[1]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/623/118840685_3345705882156607_6176971491071505058_n__1__-1622789547-0.webp';





      
      $file_info_newdata = $this->input->post("file_info_newdata");
      
      $dataArr = array(
     	             'swatch_card' => $swatch_card,
     	             'email' => $email,
     	             'primary_contact_no' => $primary_contact_no,
                     'alt1' => $alt1,
                     'alt2' => $alt2,
                     'address' => $address,
                     'fabric_cost' => $fabric_cost,
                     'bill_count' => $bill_count,
                     'bill_no_list' => json_encode($bill_Arr),
                     'debit_count' => $debit_count,
                     'debit_note_list' => json_encode($debit_Arr),
                     'file' => json_encode($file),
                     'file_data' => json_encode($file_data),
                     'gstin_no' => $gstin_no,
                     'file_info_newdata' => $file_info_newdata
     	            );
            
     
     $update['vendor_data'] = json_encode($dataArr);
     
     $update['status2'] = 1;
     $update['updated_on'] = date('Y-m-d H:i:s');
     $id = $this->input->post('id');
     
     $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $id);



     $dataArrnew = array(
                          'username' => $swatch_card,
                          'email' => $email,
                          'contact_detail' => $primary_contact_no,
                          'fabric_data_id' => $id,
                          'hash_id' => $this->input->post('hash'),
                          'gstin_no' => $gstin_no,
                          'created_on' => date('Y-m-d H:i:s'),
                          'cvendor_data' => json_encode($dataArr)
                        );
     
     $this->Crud_model->insertData('cvendor_detail', $dataArrnew);

     $status0 = $detail[0]->status0;
     $status1 = $detail[0]->status1;
     $status2 = $detail[0]->status2;
     $hash_code = $this->input->post('hash_code');
     if(($status0 == 1) && ($status1 == 1) && ($status2 == 1))
     {
       $update_final_status['final_status'] = 1;
       $this->Crud_model->updatetable('fabric_temporary_data', $update_final_status, 'id', $id);
     }
         
         // redirect('list-fabric');
         //redirect('add-new-cvendor/'.$hash_code);
         $naewdata['status']= 'success';
		 $naewdata['redirect'] = 'add-new-cvendor/'.$hash_code; 
		 $naewdatanew = json_encode($naewdata);  echo $naewdatanew;die();
    } 






     

     

     function add_inventory_detail()
     {  
     	$nwid = $this->input->post('id'); 
     	$nwidnw = $this->input->post('idnew'); 
     	$fabric_data_detail = $this->Crud_model->fetchalldatawithconditionfabricdata('fabric_data', 'fabric_id', $nwidnw); 
     	
        

        $total_dataCount = $this->input->post('total_data'); 
        $total_disablefabricqty_count = $this->input->post('total_disablefabricqty_count');
        $totalqtyleftnaew = $this->input->post('totalqtyleftnaew');
        $retnqtyunit1 = $this->input->post('retnqtyunit1');
        $totalData = array();
        $newDataArr = array();
        
        for ($i = 0; $i < ($total_dataCount) ; $i++) 
        {
	        $y = $i+1;
	        $totalData['data_total_fabric_qty_data'] = $this->input->post('data_total_fabric_qty_data_'.$y);
	        $totalData['data_totalQtyunit_data'] = $this->input->post('data_totalQtyunit_data_'.$y);
	        $totalData['data_fabric_width_data'] = $this->input->post('data_fabric_width_data_'.$y);
	        $totalData['data_fabricWidthunit'] = $this->input->post('data_fabricWidthunit_data_'.$y);
	        $totalData['data_fabric_date_data'] = $this->input->post('data_fabric_date_data_'.$y);
	        $newDataArr['datafabricqty'][$y] = $totalData;
        } 

        
        $store1 = $this->input->post('store1');
        if(empty($store1))
        {
           
           $store1 = 0;
        }
     	
     	$storeunit1 = $this->input->post('storeunit1');
     	$lotno1 = $this->input->post('lotno1');
     	
     	$store2 = $this->input->post('store2');
        if(empty($store2))
        {
           $store2 = 0; 
        }
        $storeunit2 = $this->input->post('storeunit2');
     	$lotno2 = $this->input->post('lotno2');
     	$total_qty = $this->input->post('total_qty');
     	$total_qtyunit = $this->input->post('total_qtyunit');
     	$return_qty = $this->input->post('return_qty');
     	$return_date = $this->input->post('return_date');
     	$return_reason = $this->input->post('return_reason');
     	$add_sku_no_1 = $this->input->post('add_sku_no_1');
     	$add_sku_no_2 = $this->input->post('add_sku_no_2');
     	$add_sku_no_3 = $this->input->post('add_sku_no_3');
     	$add_sku_no_4 = $this->input->post('add_sku_no_4');
     	$add_sku_no_5 = $this->input->post('add_sku_no_5');
        $addskuCount = $this->input->post('addskuCount');
        //$recordCount = $this->input->post('recordCount');
         
        
        
        /*if((count($fabric_data_detail) > 0))
        {
          $recordCount = count($fabric_data_detail);
          //$recordCount = $this->input->post('recordCount');
        }


        else
        {
          $recordCount  = 0;
        }*/
        
        
        if($fabric_data_detail == 0)
        {   
            $recordCount  = 0;
           //$recordCount = $this->input->post('recordCount');
           
        }
        else
        {
          $recordCount = count($fabric_data_detail);
          
        }
        
        $total = array();
        $newArr = array();
        
      
        /*for ($i = 0; $i < ($recordCount) ; $i++) 
        {
	        $y = $i+1;
	        $total['date'] = $this->input->post('date_'.$y);
	        $total['in'] = $this->input->post('in_'.$y);
	        $total['out'] = $this->input->post('out_'.$y);
	        $total['storeqty'] = $this->input->post('storeqty_'.$y);
	        $total['skurecord'] = $this->input->post('skurecord_'.$y);
	        $total['total_qty_left'] = $this->input->post('total_qty_left_'.$y);
	        $total['enter'] = $this->input->post('enter_'.$y);
            $newArr['data'][$y] = $total;
        } */





        for ($i = 0; $i < ($recordCount) ; $i++) 
        {
	        $y = $i+1;
	        $total['date'] = $fabric_data_detail[$i]->date;
	        $total['in'] = $fabric_data_detail[$i]->record_in;
	        $total['out'] = $fabric_data_detail[$i]->record_out;
	        $total['storeqty'] = $fabric_data_detail[$i]->storeqty;
	        $total['skurecord'] = $fabric_data_detail[$i]->skurecord;
	        $total['total_qty_left'] = $fabric_data_detail[$i]->total_qty_left;
	        $total['enter'] = $fabric_data_detail[$i]->enter;
            $newArr['data'][$y] = $total;
        } 
       
    
        
        $dataArr = array(
     	             'store1' => $store1,
     	             'storeunit1' => $storeunit1,
     	             'storeunit2' => $storeunit2,
     	             'lotno1' => $lotno1,
     	             'store2' => $store2,
     	             'lotno2' => $lotno2,
     	             'total_qty' => $total_qty,
     	             'total_qtyunit'=>$total_qtyunit,
     	             'return_qty' => $total_qty,
     	             'return_qty' => $return_qty,
     	             'return_date' => $return_date,
     	             'return_reason' => $return_reason,
     	             'addskuCount' => $addskuCount,
                     'recordCount' => $recordCount,
                     'total_record' => json_encode($newArr),
                     'total_fabricqty' => json_encode($newDataArr),
                     
                     'retnqtyunit1' => $retnqtyunit1,
                     'totalqtyleftnaew' => $totalqtyleftnaew,
                     'total_data_fabricqtycount' => $total_dataCount,
                     'total_disablefabricqty_count' => $total_disablefabricqty_count,
                     'add_sku_no_1' => $add_sku_no_1,
                     'add_sku_no_2' => $add_sku_no_2,
                     'add_sku_no_3' => $add_sku_no_3,
                     'add_sku_no_4' => $add_sku_no_4,
                     'add_sku_no_5' => $add_sku_no_5  
     	            );
       
       $update['inventory_data'] = json_encode($dataArr);
       $update['updated_on'] = date('Y-m-d H:i:s');
       
       $id = $this->input->post('id');
       $hash = $this->input->post('hash_id');

       
       //searching data
       $arrFabric = array(
       	                  'store1' => $store1,
     	                  'store2' => $store2,
     	                  'total_qty' => $total_qty
                        );
       $this->Crud_model->updatetable('fabric_detail', $arrFabric, 'hash_data', $hash);
       $update['status1'] = 1;
       $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $id);
       
       
       
       //-----------------newchnage_added-----------------
       $updateNewQuantity['total_qty'] = $total_qty;
       $this->Crud_model->updatetable('fabric_temporary_data', $updateNewQuantity, 'id', $id);
       //-----------------newchnage_added-----------------
       
       
       $fabric_detail = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'id', $id);
       
       if(!empty($fabric_detail[0]))
       { 
       	  $add_authorization_status = $fabric_detail[0]->add_authorization_status;
          $add_session_id = $fabric_detail[0]->add_session_id;
          $session_id = $this->session->userdata['userdetails']['session_id'];
          
          $edit_authorization_status = $fabric_detail[0]->edit_authorization_status;
       	  $edit_session_id = $fabric_detail[0]->edit_session_id;

          if(($add_session_id === $session_id) && ($add_authorization_status))
          {  
          	  $naewdata['status']= 'success';
		      $naewdata['redirect'] = 'add-cvendor-detail/'.$hash;
		      $naewdatanew = json_encode($naewdata);  echo $naewdatanew;die();
            
              //redirect('add-cvendor-detail/'.$hash);
          }
          elseif(($edit_session_id === $session_id) && ($edit_authorization_status))
          { 
          	$naewdata['status']= 'success';
		    $naewdata['redirect'] = 'add-cvendor-detail/'.$hash;
		    $naewdatanew = json_encode($naewdata);  echo $naewdatanew;die();
            //redirect('add-cvendor-detail/'.$hash);
          
          


          }
          else
          {  
          	 $naewdata['status']= 'success';
		     $naewdata['redirect'] = 'authorization/'.$hash; 
		     $naewdatanew = json_encode($naewdata);  echo $naewdatanew;die();
          	 //redirect('authorization/'.$hash);
          }
        }
     }





    
     





    // new function  added
    function add_inventory_detail_record()
    { 

      
      $date = $this->input->post('new_date_data');  //print_r($_POST); die;
      $in = $this->input->post('new_in_data');
      $out = $this->input->post('new_out_data');
      $storeqty = $this->input->post('new_storeqty_data'); 
      $skurecord = $this->input->post('new_skurecord_data');
      $total_qtydata = $this->input->post('new_total_qty_left');  
      if(!empty($total_qtydata))
      {
          $total_qty_left = $this->input->post('new_total_qty_left');  
      }
     
      
      
      
      $enter = $this->input->post('new_enter');
      $record_no = $this->input->post('no');
      $fabric_id = $this->input->post('fabric_id');
      
      
      
      
      $total_quantity = $this->input->post('total_quantity');  
      

      
          if((!empty($in)) && (($storeqty == 1)) )
          {   
              $stor1data = $this->input->post('store1');
              $store1newdata = $in + $stor1data;
              $update['store1'] = $store1newdata;
              $update['storetotal_qty'] = $total_quantity;
              //$update['total_qty'] = $total_quantity;
              $nwid = $this->input->post('fabricpurchaseid'); 
              $this->Crud_model->updatetablenwdata('inventory', $update, 'fabric_codeid', $fabric_id, 'fabricpurchaseid', $nwid);
          }
          
         
         
         
         
         
         
         
         
         
         
          
          if((!empty($in)) && (($storeqty == 2)) )
          {   
              $stor2data = $this->input->post('store2');
              $store2newdata = $in + $stor2data;
              $update['store2'] = $store2newdata;
              
              
              $update['storetotal_qty'] = $total_quantity;
              //$update['total_qty'] = $total_quantity;
              $nwid = $this->input->post('fabricpurchaseid'); 
              $this->Crud_model->updatetablenwdata('inventory', $update, 'fabric_codeid', $fabric_id, 'fabricpurchaseid', $nwid);
          }
          
         
         
         
          if((!empty($out)) && (($storeqty == 1)) )
          {   
              $stor1data = $this->input->post('store1'); 
              $store1newdata = abs($stor1data - $out);  
              $update['store1'] = $store1newdata;
              $update['storetotal_qty'] = $total_quantity;
              //$update['total_qty'] = $total_quantity;
              $nwid = $this->input->post('fabricpurchaseid'); 
              $this->Crud_model->updatetablenwdata('inventory', $update, 'fabric_codeid', $fabric_id, 'fabricpurchaseid', $nwid);
              
          }
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          if((!empty($out)) && (($storeqty == 2)) )
          {   
              $stor2data = $this->input->post('store2');
              $store2newdata = abs($stor2data - $out);
              $update['store2'] = $store2newdata;
              $update['storetotal_qty'] = $total_quantity;
              //$update['total_qty'] = $total_quantity;
              $nwid = $this->input->post('fabricpurchaseid'); 
              $this->Crud_model->updatetablenwdata('inventory', $update, 'fabric_codeid', $fabric_id, 'fabricpurchaseid', $nwid);
          }
       
       //print_r($update['store1']); die;
       /*$storedata = $this->input->post('storedata'); 
       
       
       if($storedata == 1 ){
           
           $update['store1'] = $this->input->post('store1');  
           $update['storetotal_qty'] = $store1;
       }
       if($storedata == 2 ){
           $update['store2'] = $this->input->post('store2'); 
       }
       
       
       print_r($_POST); die;
       $nwid = $this->input->post('fabricpurchaseid'); 
       $this->Crud_model->updatetablenwdata('inventory', $update, 'fabric_codeid', $fabric_id, 'fabricpurchaseid', $nwid);*/
       
       
      $insert['date'] = $date;
	  $insert['record_in'] = $in;
	  $insert['record_out'] = $out;
	  $insert['storeqty'] = $storeqty;
	  $insert['skurecord'] = $skurecord;
	  $insert['total_qty_left'] = $total_qty_left;
	  $insert['enter'] = $enter;
	  $insert['record_no'] = $record_no;
	  $insert['fabric_id'] = $fabric_id;
	 
     


     $insert['fabricpurchaseid'] = $this->input->post('fabricpurchaseid'); 
     $id = $this->Crud_model->insertData('fabric_data', $insert); 	
     if($id != 0)
     {
        $naewdata['status']= 'success';  
     }
     else
     {  
     	$naewdata['status']= 'error'; 
     }
     $naewdatanew = json_encode($naewdata);  
     echo $naewdatanew;die();
     







     }

     

















     function show_inventory_detail_on_re_render()
     {   
         $hash_id = $this->uri->segment(2);  
		 //fetch the record for the corresponding id
		 
		 $return = $this->Crud_model->fetchalldatawithnwcondition('fabric_temporary_data', 'record_slug0', $hash_id);  
         
         if(!empty($return))
         {
            $id = $return[0];  
            $data['id'] = $id['id'];
         }
         
         $data['url'] = $hash_id;   
         $data['total_qty_added'] = (json_decode($return[0]['basic_data']))->total_qty_unit;
         $data['inventory_data'] = $return[0]['inventory_data']; 
         $data['all_unit'] = $this->Crud_model->fetchalldata('units');
         //print_r($data['inventory_data']); die();
         
         
         $this->load->view('edit_inventory_info',$data); 
     
     } 











      function change_inventory_detail_on_re_render()
      {  
     	$total_dataCount = $this->input->post('total_data'); 
     	
        $total_disablefabricqty_count = $this->input->post('total_disablefabricqty_count'); 
        $totalqtyleftnaew = $this->input->post('totalqtyleftnaew'); 
        $retnqtyunit1 = $this->input->post('retnqtyunit1'); 
        $totalData = array();
        $newDataArr = array();
        
        
            
        
        
        
        for ($i = 0; $i < ($total_dataCount) ; $i++) 
        {  
            
        
	        $y = $i+1;
	        
	        $nwrecordid = $this->input->post('id'); 
            $fabric_data_detail = $this->Crud_model->fetchalldatawithconditionfabricdata('fabric_temporary_data', 'id', $nwrecordid);
            $nwdecodedata = json_decode($fabric_data_detail[0]->inventory_data); 
            $datanwdata = json_decode($nwdecodedata->total_fabricqty);
            $datanwnwdata = $datanwdata->datafabricqty;
            foreach ($datanwnwdata as $data) 
            {
            
              $data_totalQtyunit_data = $data->data_totalQtyunit_data; 
              $data_fabricWidthunit_data = $data->data_totalQtyunit_data;
            }
            
	        $totalData['data_total_fabric_qty_data'] = $this->input->post('data_total_fabric_qty_data_'.$y);
	        //$totalData['data_totalQtyunit_data'] = $this->input->post('data_totalQtyunit_data_'.$y);
	        $totalData['data_totalQtyunit_data'] = $data_totalQtyunit_data;
	        $totalData['data_fabric_width_data'] = $this->input->post('data_fabric_width_data_'.$y);
	        /*$totalData['data_fabricWidthunit'] = $this->input->post('data_fabricWidthunit_data_'.$y);*/
	        $totalData['data_fabricWidthunit'] = $data_fabricWidthunit_data;
	        $totalData['data_fabric_date_data'] = $this->input->post('data_fabric_date_data_'.$y);
	        $newDataArr['datafabricqty'][$y] = $totalData;  
        } 
       
      


        $store1 = $this->input->post('store1');  
        if(empty($store1))
        {
           $store1 = "0";
        }
     	
     	$storeunit1 = $this->input->post('storeunit1');  
     	$lotno1 = $this->input->post('lotno1');  
     	$store2 = $this->input->post('store2');  
        if(empty($store2))
        {
           

           $store2 = "0"; 
        } 
        
        $storeunit2 = $this->input->post('storeunit2');
        $lotno2 = $this->input->post('lotno2');    
     	$total_qty = $this->input->post('total_qty'); 
     	
     	$return_qty = $this->input->post('return_qty'); 
     	$total_qtyunit = $this->input->post('total_qtyunit'); 
     	$return_date = $this->input->post('return_date'); 
     	$return_reason = $this->input->post('return_reason');
        

        $add_sku_no_1 = $this->input->post('add_sku_no_1');
     	$add_sku_no_2 = $this->input->post('add_sku_no_2');
     	$add_sku_no_3 = $this->input->post('add_sku_no_3');
     	$add_sku_no_4 = $this->input->post('add_sku_no_4');
     	$add_sku_no_5 = $this->input->post('add_sku_no_5');
        
     	$addskuCount = $this->input->post('addskuCount');





     	$nwid = $this->input->post('id');
     	$fabric_data_detail = $this->Crud_model->fetchalldatawithconditionfabricdata('fabric_data', 'fabric_id', $nwid); 
     	
       
        
        //$fabric_data_detail = $this->Crud_model->fetchalldatawithconditionfabricdata('fabric_temporary_data', 'id', $nwid);
        
        
      
        
        
      
        
        if($fabric_data_detail == 0)
        {   
            $recordCount  = 0;
           //$recordCount = $this->input->post('recordCount');
           
        }
        else
        {
          $recordCount = count($fabric_data_detail);
          
        }
        
        $total = array();
        $newArr = array();
        
         for ($i = 0; $i < ($recordCount) ; $i++) 
        {
	        $y = $i+1;
	        $total['date'] = $fabric_data_detail[$i]->date;
	        $total['in'] = $fabric_data_detail[$i]->record_in;
	        $total['out'] = $fabric_data_detail[$i]->record_out;
	        $total['storeqty'] = $fabric_data_detail[$i]->storeqty;
	        $total['skurecord'] = $fabric_data_detail[$i]->skurecord;
	        $total['total_qty_left'] = $fabric_data_detail[$i]->total_qty_left;
	        $total['enter'] = $fabric_data_detail[$i]->enter;
            $newArr['data'][$y] = $total;
        } 

        /*for ($i = 0; $i < ($recordCount) ; $i++) 
        {
	        
	        $y = $i+1;
	        $total['date'] = $this->input->post('date_'.$y);
	        $total['in'] = $this->input->post('in_'.$y);
	        $total['out'] = $this->input->post('out_'.$y);
	        $total['storeqty'] = $this->input->post('storeqty_'.$y);
	        $total['skurecord'] = $this->input->post('skurecord_'.$y);
	        $total['total_qty_left'] = $this->input->post('total_qty_left_'.$y);
	        $total['enter'] = $this->input->post('enter_'.$y);
            $newArr['data'][$y] = $total;
        } */
        


        
        $dataArr = array(
     	             'store1' => $store1,
     	             'storeunit1' => $storeunit1,
     	             'storeunit2' => $storeunit2,
     	             'lotno1' => $lotno1,
     	             'store2' => $store2,
     	             'lotno2' => $lotno2,
     	             'total_qty' => $total_qty,
     	             'total_qtyunit'=>$total_qtyunit,
     	             'return_qty' => $total_qty,
     	             'return_qty' => $return_qty,
     	             'return_date' => $return_date,
     	             'return_reason' => $return_reason,
     	             'addskuCount' => $addskuCount,
                     'recordCount' => $recordCount,
                     'total_record' => json_encode($newArr),
                     
                     'total_fabricqty' => json_encode($newDataArr),
                     'retnqtyunit1' => $retnqtyunit1,
                     'totalqtyleftnaew' => $totalqtyleftnaew,
                     'total_data_fabricqtycount' => $total_dataCount,
                     'total_disablefabricqty_count' => $total_disablefabricqty_count,
                     'add_sku_no_1' => $add_sku_no_1,
                     'add_sku_no_2' => $add_sku_no_2,
                     'add_sku_no_3' => $add_sku_no_3,
                     'add_sku_no_4' => $add_sku_no_4,
                     'add_sku_no_5' => $add_sku_no_5  
     	            );
       

       $update['inventory_data'] = json_encode($dataArr);
       $update['updated_on'] = date('Y-m-d H:i:s');
       $id = $this->input->post('id');              
       $hash = $this->input->post('hash_code');  
       

       $update['status1'] = 1;
       $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $id);
       
       //-----------------newchnage_added-----------------
       $updateNewQuantity['total_qty'] = $total_qty;
       $this->Crud_model->updatetable('fabric_temporary_data', $updateNewQuantity, 'id', $id);
       //-----------------newchnage_added-----------------
       
       //searching data
       $arrFabric = array(
       	                  'store1' => $store1,
     	                  'store2' => $store2,
     	                  'total_qty' => $total_qty
                        );
       $this->Crud_model->updatetable('fabric_detail', $arrFabric, 'hash_data', $hash);

       $fabric_detail = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'id', $id);
       
       if(!empty($fabric_detail[0]))
       { 
       	  $add_authorization_status = $fabric_detail[0]->add_authorization_status;
          $add_session_id = $fabric_detail[0]->add_session_id;
          $session_id = $this->session->userdata['userdetails']['session_id'];
          
          
          $edit_authorization_status = $fabric_detail[0]->edit_authorization_status;
       	  $edit_session_id = $fabric_detail[0]->edit_session_id;

          
          if(($add_session_id === $session_id) && ($add_authorization_status))
          {
           // redirect('edit-cvendor-detail/'.$hash);
          	 
          	//redirect('add-new-cvendor/'.$hash);
          	$naewdata['status']= 'success';
		    $naewdata['redirect'] = 'add-new-cvendor/'.$hash; 
		    $naewdatanew = json_encode($naewdata);  echo $naewdatanew;die();
          }
          elseif(($edit_session_id === $session_id) && ($edit_authorization_status))
          
          {
            //redirect('edit-cvendor-detail/'.$hash);
            //redirect('add-new-cvendor/'.$hash);

            $naewdata['status']= 'success';
		    $naewdata['redirect'] = 'add-new-cvendor/'.$hash; 
		    $naewdatanew = json_encode($naewdata);  echo $naewdatanew;die();
          }
          else
          {
          	//redirect('user-authorization/'.$hash);
          	$naewdata['status']= 'success';
		    $naewdata['redirect'] = 'user-authorization/'.$hash; 
		    $naewdatanew = json_encode($naewdata);  echo $naewdatanew;die();
          }
        }




     }








 









  public function show_cvendor_detail_on_re_render()
  {   
       $hash_id = $this->uri->segment(2);   
       $session_id = $this->session->userdata['userdetails']['session_id'];

	   
	   $add_authorization_status = $this->session->userdata['add_auth_detail']['add_authorization_status'];

	   //fetch the record for the corresponding id
	   $return = $this->Crud_model->fetchalldatawithnwcondition('fabric_temporary_data', 'record_slug0', $hash_id);
       if(!empty($return))
	   {
	       $id = $return[0];  
	       $data['id'] = $id['id'];
	   }
         
       

       $update['edit_session_id'] = $session_id;
       $update['edit_authorization_status'] = $add_authorization_status;

       $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $data['id']);

       $data['url'] = $hash_id;   
       $data['cvendor_data'] = $return[0]['vendor_data'];  
       $this->load->view('edit_cvendor_info',$data); 
  }






  public function change_cvendor_detail_on_re_render()
  {   
  	  
      $swatch_card = $this->input->post('swatch_card');
      $email = $this->input->post('email');
      $primary_contact_no = $this->input->post('primary_contact_no');
      $alt1 = $this->input->post('alt1');
      $alt2 = $this->input->post('alt2');
      $address = $this->input->post('address');
      $fabric_cost = $this->input->post('fabric_cost');
       
      //$file_type0 = $this->input->post('file_type0');
      //$file_type1 = $this->input->post('file_type1');
       
      $gstin_no = $this->input->post('gstin_no');

      
      $bill_count = $this->input->post('bill_no_total');
      $bill_Arr['bill_no_list'] = array();  
       
      for ($i = 0; $i < ($bill_count) ; $i++) 
      { 
          $y = $i+1;
       	  $bill_Arr['bill_no_list'][$y] = $this->input->post('bill_no_'.$y); 
          
      }
      //print_r($bill_Arr); die();
      $debit_count = $this->input->post('debit_note_total');
      $debit_Arr['debit_note_list'] = array();
       
      
      for ($i = 0; $i < ($debit_count) ; $i++) 
      { 
          $y = $i+1;
       	  $debit_Arr['debit_note_list'][$y] = $this->input->post('debit_no_'.$y); 
      }

      $file = array();
      $file[0]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/624/10_-1623668705-0.webp';
      $file[1]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/623/118840685_3345705882156607_6176971491071505058_n__1__-1622789547-0.webp';

     
     $file_data = array();
     $file_data[0]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/624/10_-1623668705-0.webp';
     $file_data[1]['url'] = 'https://deebaco.s3.ap-south-1.amazonaws.com/image/uploads/products/623/118840685_3345705882156607_6176971491071505058_n__1__-1622789547-0.webp';
     
      $file_info_newdata = $this->input->post('file_info_newdata');
      $dataArr = array(
     	             'swatch_card' => $swatch_card,
     	             'email' => $email,
     	             'primary_contact_no' => $primary_contact_no,
                     'alt1' => $alt1,
                     'alt2' => $alt2,
                     'address' => $address,
                     'fabric_cost' => $fabric_cost,
                     'bill_count' => $bill_count,
                     'bill_no_list' => json_encode($bill_Arr),
                     'debit_count' => $debit_count,
                     'debit_note_list' => json_encode($debit_Arr),
                     'file' => json_encode($file),
                     'file_data' => json_encode($file_data),
                     'gstin_no' => $gstin_no,
                     'file_info_newdata'=> $file_info_newdata
     	            );
      
     $update['vendor_data'] = json_encode($dataArr);
     
     $update['status2'] = 1;
     $update['updated_on'] = date('Y-m-d H:i:s');
     $id = $this->input->post('id');
     $hash_code = $this->input->post('hash_code');
     
     $this->Crud_model->updatetable('fabric_temporary_data', $update, 'id', $id); 
     



     
     

     $cvendor_id = $this->input->post('cvendor_id');
     $update_detail['cvendor_data'] = json_encode($dataArr);
     $update_detail['created_on'] = date('Y-m-d H:i:s');
     $update_detail['username'] = $swatch_card;
     $update_detail['email'] = $email;
     $update_detail['contact_detail'] = $primary_contact_no;
     $update_detail['gstin_no'] = $gstin_no;

     
     $this->Crud_model->updatetable('cvendor_detail', $update_detail, 'id', $cvendor_id);
     
     
     $detail = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'id', $id);  

     $status0 = $detail[0]->status0;
     $status1 = $detail[0]->status1;
     $status2 = $detail[0]->status2;

     if(($status0 == 1) && ($status1 == 1) && ($status2 == 1))
     {
       $update_final_status['final_status'] = 1;
       $this->Crud_model->updatetable('fabric_temporary_data', $update_final_status, 'id', $id);
     }

     
     //redirect('list-fabric');
     // redirect('add-new-cvendor/'.$hash_code);
     $naewdata['status']= 'success';
	 $naewdata['redirect'] = 'add-new-cvendor/'.$hash_code; 
	 $naewdatanew = json_encode($naewdata);  echo $naewdatanew;die();
  }




   public function edit_rerender_cvendor_detail()
   {


       $data['id'] = $this->uri->segment(2);
       $detail = explode('-', $data['id']);
       $cvendor_id = $detail[0];
       $fabric_id = $detail[1];

       $return = $this->Crud_model->fetchalldatawithnwcondition('fabric_temporary_data', 'id', $fabric_id);
       $returndetail = $this->Crud_model->fetchalldatawithnwcondition('cvendor_detail', 'id', $cvendor_id);
       
       if(!empty($return))
	   {
	       
	       $id = $return[0];  
	       $data['id'] = $id['id'];
	       $data['hash_id'] = $id['record_slug0'];
	   }
       
       $data['url'] = $data['hash_id']; 
       $data['cvendor_id'] = $cvendor_id;
       $data['cvendor_data'] = $returndetail[0]['cvendor_data'];  
       $this->load->view('edit_cvendor_info',$data); 

   }

   public function show_authorization()
   {   
   	   $data['url'] = $this->uri->segment(2);
       $return = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $data['url']);  
         
         if(!empty($return[0]))
         {
            $id = $return[0];  
            $data['id'] = $id->id; 
         }

     	 if(!empty($data['url']))
     	 {
             $this->load->view('auth',$data);
     	 }
     	 else
     	 {
              redirect('not_found');
     	 }
   }
   
   public function user_authorization()
   {  
   	  if($this->input->is_ajax_request() && $this->input->post('type') == 'auth')
	  {
		$password = trim($this->input->post('password'));
		$id = $this->input->post('id');

		$hash = $this->input->post('hash');

		if(empty($password)){

			$return['status']= 'fail';
			$return['message'] = 'Please enter valid password';
			$ret = json_encode($return);
			echo $ret;die();
		}
	    
	    $email  = 'authorization@gmail.com';
		$validate = $this->Crud_model->validateAuthorization($email,$password);

	

        if($validate != 0)
		{ 
		  $sessionarray['add_authorization_status']= true;
		  $sessionarray['add_authorization']= $hash;              
          $this->session->set_userdata('add_auth_detail',$sessionarray);
		  $return['status']= 'success';
		  $return['message']= 'Authorization succeed';
		  
		  //commentednew
		  //$return['redirect'] = base_url().'add-cvendor-detail/'.$hash;
		  $return['redirect'] = base_url().'add-cvendor/'.$hash;
		  //commentednew

		  
		  $ret = json_encode($return);
		  echo $ret;die();
        
        }
		else
		{
			
		  $return['status']= 'fail';
		  $return['message'] = 'Incorrect Password';
		  $ret = json_encode($return);
		  echo $ret;die();
		}
	 
	 }
	else
	{
		redirect('not_found');
	}
	 
        //code added
   }




   public function show_edit_auth()
   {   
   	   $data['url'] = $this->uri->segment(2);
       $return = $this->Crud_model->fetchalldatawithcondition('fabric_temporary_data', 'record_slug0', $data['url']);  
         
         if(!empty($return[0]))
         {
            $id = $return[0];  
            $data['id'] = $id->id; 
         }

     	 if(!empty($data['url']))
     	 {
             $this->load->view('edit_auth',$data);
     	 }
     	 else
     	 {
              redirect('not_found');
     	 }
   }



    public function edit_user_authorization()
   
    {  
   	  if($this->input->is_ajax_request() && $this->input->post('type') == 'edit_auth')
	  {
		$password = trim($this->input->post('password'));
		$id = $this->input->post('id');

		$hash = $this->input->post('hash');

		if(empty($password)){

			$return['status']= 'fail';
			$return['message'] = 'Please enter valid password';
			$ret = json_encode($return);
			echo $ret;die();
		}
	    
	    $email  = 'authorization@gmail.com';
		$validate = $this->Crud_model->validateAuthorization($email,$password);

	

        if($validate != 0)
		{ 
		  $sessionarray['edit_authorization_status']= true;
		  $sessionarray['edit_authorization']= $hash;              
          $this->session->set_userdata('edit_auth_detail',$sessionarray);
		  $return['status']= 'success';
		  $return['message']= 'Authorization succeed';
		  $return['redirect'] = base_url().'edit-cvendor-detail/'.$hash;
		  $ret = json_encode($return);
		  echo $ret;die();
        
        }
		else
		{
			
		  $return['status']= 'fail';
		  $return['message'] = 'Incorrect Password';
		  $ret = json_encode($return);
		  echo $ret;die();
		}
	 
	 }
	else
	{
		redirect('not_found');
	}
	 
        //code added
   }

  


   function search_fabric_detail()
   {
      if($this->input->is_ajax_request() && $this->input->post('type') == 'search_fabric')
	  {
		
		 $search = trim($this->input->post('search'));
		 $table = 'fabric_detail';
		 $search_fabric_code_data =  $this->Crud_model->search_fabric_code($table,$search);
		 
		 $search_info_data =  $this->Crud_model->search_info_data($table,$search);
         
         





         if(!empty($search_data))
         {
		 	$return['message']  = 'Records found for the corresponding serach keyword';
		    $return['data'] = $search_fabric_code_data; 
		 	$return['status'] = true;
		 }
		 elseif(!empty($search_info_data))
		 {
            $return['message']  = 'Records found for the corresponding serach keyword';
		 	$return['data'] = $search_info_data; 
		    $return['status'] = true;
         }
         

         else
		 {
            $return['message'] = 'No data available for the corresponding serach keyword. please try with another search keyword';
            $return['data'] = null;
            $return['status'] = false;

		 }
		 
	     $ret = json_encode($return);
		 echo $ret;die();

	  }
	  else
	  {
		 redirect('not_found');
	  }
	 
   
   }


  
  public function admin()
  {
    $this->load->view('configuration.php');
  }
  
  
  
  
  
  
  
  public function configuration()
  { 
  	$data['fabric_type_list'] = $this->Crud_model->fetchalldata('fabric_type_list');
  	$data['fabric_pattern_list'] = $this->Crud_model->fetchalldata('fabric_pattern_list');
  	$data['unit'] = $this->Crud_model->fetchalldata('units');
  	$data['color'] = $this->Crud_model->fetchalldata('color');
    $this->load->view('configuration.php', $data);
  }

   
  public function add_fabric_type()
  {
     if($this->input->is_ajax_request() && $this->input->post('type') == 'add_fabric_type')
	 {
		
		 $add = $this->input->post('addFabric');
		 $fabric_data = $this->Crud_model->search_data('fabric_type_list','name', $add);
		 if($fabric_data == true)
		 {
             $data['status'] = false;
             $data['message'] = 'Requested fabric type already exists';
             $data['id'] = null;
             $data['data'] = null;
		 }
		 


	     else
		 {   
		 	 $insert['name'] = $add;
		 	 $insert['is_active'] = 1;
             $id = $this->Crud_model->insertData('fabric_type_list', $insert);
             

             $data['all_data'] = $this->Crud_model->fetchalldata('fabric_type_list');
             $data['status'] = true;
             $data['message'] = 'Fabric type created';
             $data['id'] = $id;
             $data['data'] = $insert['name'];
		 }
		
          echo  json_encode($data); die();
	 }
  }


  function remove_fabric_type()
  {
      if($this->input->is_ajax_request() && $this->input->post('type') == 'remove_fabric_type')
	   {
		
		 $id = $this->input->post('id');
		 if($id != 0){

		 	$data = $this->Crud_model->delete('fabric_type_list',$id);
		 	if($data == true)
		 	{
                $datanew['status'] = true;
                $datanew['message'] = 'Requested fabric type deleted successfully';
		 	}
		 	else
		 	{
              

              $datanew['status'] = false;
              $datanew['message'] = 'something went wrong';
		 	}

		 }else{

		 	$datanew['status'] = false;
            $datanew['message'] = 'something went wrong';
		 }
		 
	    echo  json_encode($datanew); die();
	 }
  
  }


   

   

   function add_fabric_pattern()
   {
       if($this->input->is_ajax_request() && $this->input->post('type') == 'add_fabric_pattern')
	 {
		
		 $add = $this->input->post('addFabricData');
		 $fabric_data = $this->Crud_model->search_data('fabric_pattern_list','name', $add);
		 if($fabric_data == true)
		 {
             $data['status'] = false;
             $data['message'] = 'Requested fabric pattern already exists';
             $data['id'] = null;
             $data['data'] = null;
		 }
		 else
		 {   
		 	 $insert['name'] = $add;
		 	 $insert['is_active'] = 1;
             $id = $this->Crud_model->insertData('fabric_pattern_list', $insert);
             $data['all_data'] = $this->Crud_model->fetchalldata('fabric_pattern_list');
             $data['status'] = true;
             $data['message'] = 'Fabric pattern created';
             $data['id'] = $id;
             $data['data'] = $insert['name'];
		 }
		
          echo  json_encode($data); die();
	 }     
   }




   public function remove_fabric_pattern()
   {
       if($this->input->is_ajax_request() && $this->input->post('type') == 'remove_fabric_pattern')
	   {
		
		 $id = $this->input->post('id');
		 if($id != 0){

		 	$data = $this->Crud_model->delete('fabric_pattern_list',$id);
		 	if($data == true)
		 	{
                $datanew['status'] = true;
                $datanew['message'] = 'Requested fabric pattern deleted successfully';
		 	}
		 	else
		 	{
              

              $datanew['status'] = false;
              $datanew['message'] = 'something went wrong';
		 	}

		 }else{

		 	$datanew['status'] = false;
            $datanew['message'] = 'something went wrong';
		 }
		 
	    echo  json_encode($datanew); die();
	  }
  
   }


    function add_fabric_nwdata()
   {
       if($this->input->is_ajax_request() && $this->input->post('type') == 'add_fabric_nwdata')
	 {
		
		 $add = $this->input->post('addData_nw');
		 $fabric_data = $this->Crud_model->search_data('units','name', $add);
		 if($fabric_data == true)
		 {
             $data['status'] = false;
             $data['message'] = 'Requested unit already exists';
             $data['id'] = null;
             $data['data'] = null;
		 }
		 else
		 {   
		 	 $insert['name'] = $add;
		 	 $insert['is_active'] = 1;
             $id = $this->Crud_model->insertData('units', $insert);
             $data['all_data'] = $this->Crud_model->fetchalldata('units');
             $data['status'] = true;
             $data['message'] = 'Fabric unit created';
             $data['id'] = $id;
             $data['data'] = $insert['name'];
		 }
		
          echo  json_encode($data); die();
	 }     
   }


  
 
  
  
  
  
  function add_colorc()
   {
       if($this->input->is_ajax_request() && $this->input->post('type') == 'add_colorc')
	 {
		
		 $add = $this->input->post('addData_nw');
		 $fabric_data = $this->Crud_model->search_nw('color','color_name', $add);
		 if($fabric_data == true)
		 {
             $data['status'] = false;
             $data['message'] = 'Requested color name already exists';
		 
		     
		 }
		 else
		 {   
		 	 $data['status'] = true;
             $data['message'] = 'Add data';
		 }
		
          echo  json_encode($data); die();
	 }     
   }
   
   
   
   
   
   
   
   
   
   
 
   
   
   
   
   function add_coloracode()
   {
       if($this->input->is_ajax_request() && $this->input->post('type') == 'add_coloracode')
	 {
		
		 $add = $this->input->post('addData_nw');
		 $fabric_data = $this->Crud_model->search_nw('color','color_code', $add);
		 if($fabric_data == true)
		 {
             $data['status'] = false;
             $data['message'] = 'Requested color code already exists';
		 
		     
		 }
		 else
		 {   
		 	 $data['status'] = true;
             $data['message'] = 'Add data';
		 }
		
          echo  json_encode($data); die();
	 } }
   
   
   
   
   
   
   
   
   function add_colora()
   {
       if($this->input->is_ajax_request() && $this->input->post('type') == 'add_colorc')
	 {
		
		 $add = $this->input->post('addData_nw'); 
		 $addDatanw = $this->input->post('addDatanw');
		 $fabric_data = $this->Crud_model->search_nw('color','color_name', $add);
		 if($fabric_data == true)
		 {
             $data['status'] = false;
             $data['message'] = 'Requested color data already exists';
             $data['id'] = null;
             $data['data'] = null;
		 }
		 else
		 {   
		 	 $insert['color_name'] = $add;
		 	 $insert['color_code'] = $addDatanw;
		 	 $insert['status'] = 1;
             $id = $this->Crud_model->insertData('color', $insert);
             $data['all_data'] = $this->Crud_model->fetchalldata('color');
             $data['status'] = true;
             $data['message'] = 'Color added';
             $data['id'] = $id;
             $data['data'] = $insert['color_name'];
             $data['nwdata'] = $insert['color_code'];
		 }
		
          echo  json_encode($data); die();
	 }     
   }


  


  public function remove_fabric_data_nw()
   {
       if($this->input->is_ajax_request() && $this->input->post('type') == 'remove_fabric_data_nw')
	   {
		
		 $id = $this->input->post('id');
		 if($id != 0){

		 	$data = $this->Crud_model->delete('units',$id);
		 	if($data == true)
		 	{
                $datanew['status'] = true;
                $datanew['message'] = 'Requested unit deleted successfully';
		 	}
		 	else
		 	{
              $datanew['status'] = false;
              $datanew['message'] = 'something went wrong';
		 	}

		 }else{

		 	$datanew['status'] = false;
            $datanew['message'] = 'something went wrong';
		 }
		 
	    echo  json_encode($datanew); die();
	  }
  
   }

  
    public function fabric_code()
    {  
       $fabric_code = $this->input->post('fabric_code');
       $data = $this->Crud_model->checkforadata('fabric_detail','fabric_code', $fabric_code);
       
   

       if($data == true)
       { 
          $datanew['status'] = 'success';
          $datanew['message'] = 'This fabric code has already been used';
          print_r(json_encode($datanew));  die(); 
       }
       
       else
       {
          $datanew['status'] = 'error';
          $datanew['message'] = 'Requested fabric code can use';
          print_r(json_encode($datanew));  die(); 
       }
    }







  
}