<?php
class Crud_model extends CI_Model{

	function validatelogin($username,$password){
		$this->db->where('email',$username);
		$this->db->where('status','1');
		$query = $this->db->get('users');
		if($query->num_rows() == 1)
		{
			$result = $query->result();
			if(password_verify($password, $result[0]->password))
			{
				return $result[0]->id;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}

	}

	

    function validateAuthorization($email,$password){
		$this->db->where('email',$email);
		$this->db->where('authorization_status','1');
		$query = $this->db->get('users');
		if($query->num_rows() == 1)
		{
			$result = $query->result();
			if(password_verify($password, $result[0]->password))
			{
				return $result[0]->id;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
    }

	


	function fetchtabledataone($tablename,$col,$colval){
		$this->db->where($col,$colval);
		$result = $this->db->get($tablename);
		$this->db->order_by("id", "desc");
		if($result->num_rows() >= 1)
		{
			foreach ($result->result() as $row) {
				$ret[] = $row;
			}

			if(isset($ret))
				return $ret;
		}
		else
			return 0;
	}

	


	function fetchtabledatatwocount($tablename,$col1,$colval1,$colval2){
		$this->db->select('id');
		$this->db->from($tablename);
		$this->db->where($col1,$colval1);
		$this->db->where('DATE(created)',$colval2);
		$result = $this->db->get();
		$this->db->order_by("id", "desc");
		if($result->num_rows() >= 1)
		{
			return $result->num_rows();
		}
		else
			return 0;
	}
  









  



  function fetchtabledatatwocountadata($tablename,$col1,$colval1,$colval2)
  {
		$this->db->select('id');
		$this->db->from($tablename);
		$this->db->where($col1,$colval1);
		$this->db->where($col2,$colval2);
		$result = $this->db->get();
		$this->db->order_by("id", "desc");
		if($result->num_rows() >= 1)
		{
			return $result->num_rows();
		}
		else
			return 0;
	}


	function fetchtabledatatwo($tablename,$col1,$colval1,$col2,$colval2){
		$this->db->where($col1,$colval1);
		$this->db->where($col2,$colval2);
		$result = $this->db->get($tablename);
		$this->db->order_by("id", "desc");
		if($result->num_rows() >= 1)
		{
			foreach ($result->result() as $row) {
				$ret[] = $row;
			}

			if(isset($ret))
				return $ret;
		}
		else
			return 0;
	}

	function fetchtabledatathree($tablename,$col1,$colval1,$col2,$colval2,$col3,$colval3){
		$this->db->where($col1,$colval1);
		$this->db->where($col2,$colval2);
		$this->db->where($col3,$colval3);
		$result = $this->db->get($tablename);
		$this->db->order_by("id", "desc");
		if($result->num_rows() >= 1)
		{
			foreach ($result->result() as $row) {
				$ret[] = $row;
			}

			if(isset($ret))
				return $ret;
		}
		else
			return 0;
	}

	function fetchtabledatafour($tablename,$col1,$colval1,$col2,$colval2,$col3,$colval3,$col4,$colval4){
		$this->db->where($col1,$colval1);
		$this->db->where($col2,$colval2);
		$this->db->where($col3,$colval3);
		$this->db->where($col4,$colval4);
		$result = $this->db->get($tablename);
		$this->db->order_by("id", "desc");
		if($result->num_rows() >= 1)
		{
			foreach ($result->result() as $row) {
				$ret[] = $row;
			}

			if(isset($ret))
				return $ret;
		}
		else
			return 0;
	}

	function fetchtabledatafourlimit($tablename,$col1,$colval1,$col2,$colval2,$col3,$colval3,$col4,$colval4,$limit){
		$this->db->where($col1,$colval1);
		$this->db->where($col2,$colval2);
		$this->db->where($col3,$colval3);
		$this->db->where($col4,$colval4);
		$this->db->limit($limit);
		$result = $this->db->get($tablename);
		$this->db->order_by("id", "desc");
		if($result->num_rows() >= 1)
		{
			foreach ($result->result() as $row) {
				$ret[] = $row;
			}

			if(isset($ret))
				return $ret;
		}
		else
			return 0;
	}


	function fetchalldata($tablename){
		$this->db->order_by("id", "desc");
		$result = $this->db->get($tablename);
		if($result->num_rows() >= 1)
		{
			foreach ($result->result() as $row) {
				$completerow[]= $row;
			}

			return $completerow;
		}

		else
			return 0;
    } 




    /////////////////////////////////////////////////

    





    





      //--------------commneted starts----------------------------//
     function datanwNewunarchieve($tablename) 
     {
        $sql= "SELECT * FROM $tablename WHERE `status0`= 1 AND `archieve_status`=0  ORDER BY `fabric_code` DESC";
	      $result = $this->db->query($sql);
	      return $result->result();    
     } 
      //--------------commneted ends----------------------------//

     function datanwnew($tablename)
    {
      $sql= "SELECT * FROM $tablename WHERE `status0`= 1 AND `archieve_status`=1  ORDER BY `fabric_code` DESC LIMIT 10";
	    $result = $this->db->query($sql);
	    //return $result->num_rows();
	    return $result->result();
    }


     function datanwnewallnedatalall($tablename, $offset, $limit)
    {
      $sql= "SELECT * FROM $tablename WHERE `status0`= 1 AND `archieve_status`=1 ORDER BY `fabric_code` DESC LIMIT $offset,$limit";
	    $result = $this->db->query($sql);
	    return $result->result();
    }
    
    
     function datanwnewall($tablename, $data , $offset, $limit)
    {
      $sql= "SELECT * FROM $tablename WHERE `status0`= 1  AND `archieve_status`=1 ORDER BY `fabric_code` DESC LIMIT $offset,$limit";
	    $result = $this->db->query($sql);
	    return $result->result();
    }







     function datanwnewalldata($tablename, $data)
    {
      $sql= "SELECT * FROM $tablename  WHERE `fabric_code` LIKE '$data' ORDER BY `fabric_code` DESC";
	    $result = $this->db->query($sql);
	    return $result->result();
    }

     


     function datanwnewalldesc($tablename, $offset, $limit)
     {
      $sql= "SELECT * FROM `fabric_temporary_data` WHERE `status0`=1 AND `archieve_status`=1 ORDER BY id DESC LIMIT $offset,$limit";
      $result = $this->db->query($sql);
	    return $result->result();
     }


     function datanwnewalldescnew($tablename, $offset, $limit)
     {
      $sql= "SELECT * FROM `fabric_temporary_data` WHERE `status0`=1 AND `archieve_status`=1 ORDER BY id ASC LIMIT $offset,$limit";
      $result = $this->db->query($sql);
	    return $result->result();
     }






     function datanwnewalldescnewnw($tablename, $offset, $limit)
     {
      $sql= "SELECT * FROM `fabric_temporary_data` WHERE `status0`=1 AND `archieve_status`=1 AND `total_qty` <= 50 ORDER BY total_qty ASC LIMIT $offset,$limit";
      $result = $this->db->query($sql);
      return $result->result();
     }
       

       function fetchalldatawithconditionfabric($tablename, $col, $colval){
    	   $this->db->where($col, $colval);
		     $this->db->order_by("fabric_code", "desc");
		     $result = $this->db->get($tablename);
		     if($result->num_rows() >= 1)
		     {
			    foreach ($result->result() as $row) {
				    $completerow[]= $row;
			    }

			     return $completerow;
		      }

		     else
			   return 0;
        }



     /////////////////////////////////////////////////////////////////////

    function fetchalldatawithcondition($tablename, $col, $colval){
    	$this->db->where($col, $colval);
		$this->db->order_by("id", "desc");
		$result = $this->db->get($tablename);
		if($result->num_rows() >= 1)
		{
			foreach ($result->result() as $row) {
				$completerow[]= $row;
			}

			return $completerow;
		}

		else
			return 0;
    }



    function fetchalldatawithconditionfabricdata($tablename, $col, $colval){
    	$this->db->where($col, $colval);
		$this->db->order_by("id", "asc");
		$result = $this->db->get($tablename);
		if($result->num_rows() >= 1)
		{
			foreach ($result->result() as $row) {
				$completerow[]= $row;
			}

			return $completerow;
		}

		else
			return 0;
    }





    function fetchalldatawithnwcondition($tablename, $col, $colval){
    	$this->db->where($col, $colval);
		$this->db->order_by("id", "desc");
		$result = $this->db->get($tablename);
		if($result->num_rows() >= 1)
		{
			foreach ($result->result_array() as $row) {
				$completerow[]= $row;
			}

			return $completerow;
		}

		else
			return 0;
    }





	 function insertData($table='',$insertData=array())
	 {

		$result=$this->db->insert($table,$insertData);
		if($result)
			return $this->db->insert_id();
		else
			return 0;
	 }

	 function updatetable($table='', $updateData = array(), $col, $colval)
	 {
	 	$this->db->where($col, $colval);
        $check = $this->db->update($table, $updateData);
        if($check)
        {
        	$this->db->select('id');
        	$this->db->where($col, $colval);
        	$ret = $this->db->get($table);
        	if($ret->num_rows() >= 1)
        	{
        		foreach ($ret->result()as $res) {
        			return $res->id;
        		}
        	}
        }
        else{
        	return 0;
        }
	 }
  
  
  
  
   
    
    
    
    
     function updatetablenwdata($table='', $updateData = array(), $col1, $colval1, $col2, $colval2)
	 {
	 	$this->db->where($col1, $colval1);
	 	$this->db->where($col2, $colval2);
        $check = $this->db->update($table, $updateData);
        if($check)
        {
        	$this->db->select('id');
        	$this->db->where($col1, $colval1);
        	$this->db->where($col2, $colval2);
        	$ret = $this->db->get($table);
        	if($ret->num_rows() >= 1)
        	{
        		foreach ($ret->result()as $res) {
        			return $res->id;
        		}
        	}
        }
        else{
        	return 0;
        }
	 }
	 
	function deleterows($tablename, $array){
		$done = $this->db->delete($tablename, $array);
		if($done)
		{
			return 1;
		}

		else{
			return 0;
		}
	}

	function deleterowsarray($tablename, $type, $array){
		$this->db->where_in($type, $array);
		$done = $this->db->delete($tablename);
		if($done)
		{
			return 1;
		}

		else{
			return 0;
		}
	}


	function search($table,$search)
	{
		$this->db->where('MATCH (name) AGAINST ("'.$search.'")', NULL, FALSE);
		$result = $this->db->get($table);
		if($result)
		{

			return $result->result();
		}
		else
		{
			return 0;
		}
	}


	function search_fabric_code($table,$search)
	{
		$this->db->where('MATCH (fabric_code) AGAINST ("'.$search.'")', NULL, FALSE);
		$result = $this->db->get($table);
		if($result)
		{

			return $result->result();
		}
		else
		{
			return 0;
		}
	}







	function search_info_data($table,$search)
	{
		$this->db->where('MATCH (info_data) AGAINST ("'.$search.'")', NULL, FALSE);
		$result = $this->db->get($table);
		if($result)
		{

			return $result->result();
		}
		else
		{
			return 0;
		}
	}

	function checkforadata($table, $matchfile, $dataval)
	{
	 	$this->db->where($matchfile,$dataval);
		$result = $this->db->get($table);
		if(count($result->result()) >=1)
		{
			return 1;
		}
		else
			return 0;
	}

	function jointable($maintable,$jointable, $jointablecol, $maintablecol,$col,$val)
	{
		$this->db->select('*');
		$this->db->from($maintable);
		$this->db->join($jointable, $jointablecol.'='.$maintablecol);
		$this->db->where($col, $val);
		$result = $this->db->get();
		if($result->num_rows() >= 1)
		{
			foreach ($result->result() as $row) {
				$ret[] = $row;
			}

			if(isset($ret))
				return $ret;
		}
		else
			return 0;
	}
    

	function countone($tablename,$col1,$colval1){
		$this->db->where($col1,$colval1);
		$result = $this->db->get($tablename);
		$this->db->order_by("id", "desc");
		return $result->num_rows();
	}

	function counttwo($tablename,$col1,$colval1,$col2,$colval2){
		$this->db->where($col1,$colval1);
		$this->db->where($col2,$colval2);
		$result = $this->db->get($tablename);
		$this->db->order_by("id", "desc");
		return $result->num_rows();
	}

	function counttwo_date($tablename,$col1,$colval1,$col2,$colval2){
		$sql= "SELECT * FROM $tablename WHERE $col1 = $colval1 AND $col2 BETWEEN '$colval2 00:00:00' AND '$colval2 23:59:59' ORDER BY `id` DESC";
		$result = $this->db->query($sql);
		return $result->num_rows();
	} 
	
	
	
	
	function search_data($table, $col, $search_data)
	 {    
	 	
	 	$this->db->where($col, $search_data);
	 	$this->db->where('is_active',1);
		$result = $this->db->get($table);
        if($result->num_rows() >= 1)
		{
		
		   return 1;
		}
	    else
		{
			return 0;
		}
	 }



	 


    


	 function delete($table,$id)
	 {
	 	$this->db->where('id', $id);
        $done = $this->db->delete($table);
        if($done)
		{
			return 1;
		}

		else{
			return 0;
		}
	 }
   
   
   
   
   
   
   
   
   
   
   
   
   function search_nw($table, $col, $search_data)
   {    
	 	
	 	$this->db->where($col, $search_data);
	 	$this->db->where('status',1);
		$result = $this->db->get($table);
        if($result->num_rows() >= 1)
		{
		
		   return 1;
		}
	    else
		{
			return 0;
		}
  }
} 
?>
