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
		{   
		   $list_detail['fabric_detail'] = $this->Crud_model->fetchalldata('fabric_temporary_data');
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
                   

    public function list_fabric()
    {
       if($this->common->is_logged_in())
		{   
		   $list_detail['fabric_detail'] = $this->Crud_model->fetchalldata('fabric_temporary_data'); 
           $this->load->view('list_fabric.php', $list_detail);
		}
		
		else
		{
			$this->load->view('login.php');
		}
    }

    
    function create_fabric()
    {
        $data['fabric_pattern_list'] = $this->Crud_model->fetchalldatawithcondition('fabric_pattern_list', 'is_active', 1);  
        $data['fabric_type'] =  $this->Crud_model->fetchalldatawithcondition('fabric_type_list','is_active', 1);
        $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
		$this->load->view('initial_info.php', $data);
    }

    



    public function add_info_detail()
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

 
     public function show_inventory()
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
     	     $detail = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
     	 	 $data['all_unit'] = $this->Crud_model->fetchalldatawithcondition('units','is_active', 1); 
     	 	 $data['allnewunit'] = json_encode($detail);
             $this->load->view('inventory_info',$data);
     	 }
     	 else
     	 {
              redirect('not_found');
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
     	$fabric_data_detail = $this->Crud_model->fetchalldatawithconditionfabricdata('fabric_data', 'fabric_id', $nwid);













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

        
        if((count($fabric_data_detail) > 0))
        {
          $recordCount = count($fabric_data_detail);
        }


        else
        {
          $recordCount  = 0;
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
      $date = $this->input->post('new_date_data');
      $in = $this->input->post('new_in_data');
      $out = $this->input->post('new_out_data');
      $storeqty = $this->input->post('new_storeqty_data');
      $skurecord = $this->input->post('new_skurecord_data');
      $total_qty_left = $this->input->post('new_total_qty_left');
      $enter = $this->input->post('new_enter');
      $record_no = $this->input->post('no');
      $fabric_id = $this->input->post('fabric_id');



     $insert['date'] = $date;
	 $insert['record_in'] = $in;
	 $insert['record_out'] = $out;
	 $insert['storeqty'] = $storeqty;
	 $insert['skurecord'] = $skurecord;
	 $insert['total_qty_left'] = $total_qty_left;
	 $insert['enter'] = $enter;
	 $insert['record_no'] = $record_no;
	 $insert['fabric_id'] = $fabric_id;
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

     
     //echo $id;

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


        //$recordCount = $this->input->post('recordCount');
        if((count($fabric_data_detail) > 0))
        {
          $recordCount = count($fabric_data_detail);
        }
        else
        {
          
          $recordCount  = 0;
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