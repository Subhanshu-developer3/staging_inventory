<?php

     // Set some useful configuration 
     $baseURL = 'https://inventory.deebaco.com/index.php/getdata_all'; 
     $limit = 10; 
     

    // Initialize pagination class 
    $pagConfig = array( 
        'baseURL' => $baseURL, 
        'totalRows' => $rowCount, 
        'perPage' => $limit, 
        'contentDiv' => 'dataContainer', 
        'link_func' => 'searchFilter' 
    ); 

    $pagination =  new Pagination($pagConfig); 
    
    ?> 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <table class="adminTable robotoReguler newdata" cellpadding="0" cellspacing="0">
                        <thead class="tblHead">
                            <tr class="tableRaw tblHeadRaw robotoMedium uppercase">
                                <th class="tblHeading upperCase"></th>
                                <th class="tblHeading upperCase">S.No.</th>
                                <th class="tblHeading upperCase">Image</th>
                                <th class="tblHeading upperCase">Fabric Code</th>
                                <th class="tblHeading upperCase">Color</th>
                                <th class="tblHeading upperCase">Fabric Pattern</th>
                                 <th class="tblHeading upperCase">Fabric Type</th>
                                <th class="tblHeading upperCase">Vendor</th>
                                <th class="tblHeading upperCase">Store1</th>
                                <th class="tblHeading upperCase">Store2</th>
                                <th class="tblHeading upperCase">Total QTY</th>
                                <th class="tblHeading upperCase">Created on</th>
                                <th class="tblHeading upperCase">Updated on</th>
                            </tr>
                        </thead>
                        <tbody style="overflow-y: auto;" class="catTableBody">
                        <?php 
                            if(empty($fabric_detail)) { ?>
                              
                            <tr class="tableBdyRaw">
                                <td class="tblData upperCase txtCenter" style="padding: 61px 0 61px !important;">
                                    <h3 style="color:#4766ae;">No Data Available</h3>
                                </td>
                            </tr>
                             
                            <?php } else {

                            foreach ($fabric_detail as $key => $data) { ?>
                            
                            <tr class="tableBdyRaw">
                                <td class="tblData txtCenter ">
                                    <input type="checkbox" class="infoInputTxt tablecheckBox txtCenter">
                                </td>
                                <td class="tblData txtCenter ">
                                <?php 
                                //////////////////////////////////////////////////////
                                //print_r($nw);
                                //////////////////////////////////////////////////////
                                //echo $data->id; 
                                
                                if($nw == 10){
                                    $str = '1';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '20')
                                {
                                    $str = '2';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '30')
                                {
                                    $str = '3';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '40')
                                {
                                    $str = '4';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '50')
                                {
                                    $str = '5';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '60')
                                {
                                    $str = '6';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '70')
                                {
                                    $str = '7';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '80')
                                {
                                    $str = '8';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '90')
                                {
                                    $str = '9';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '100')
                                {
                                    $str = '10';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '110')
                                {
                                    $str = '11';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '120')
                                {
                                    $str = '12';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '130')
                                {
                                    $str = '13';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '140')
                                {
                                    $str = '14';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '150')
                                {
                                    $str = '15';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '160')
                                {
                                    $str = '16';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '170')
                                {
                                    $str = '17';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '180')
                                {
                                    $str = '18';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '190')
                                {
                                    $str = '19';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '200')
                                {
                                    $str = '20';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '210')
                                {
                                    $str = '21';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '220')
                                {
                                    $str = '22';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '230')
                                {
                                    $str = '23';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '240')
                                {
                                    $str = '24';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '250')
                                {
                                    $str = '25';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '260')
                                {
                                    $str = '26';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '270')
                                {
                                    $str = '27';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '280')
                                {
                                    $str = '28';
                                    $nl = $nw + 10;
                                } 
                                elseif($nw == '290')
                                {
                                    $str = '29';
                                    $nl = $nw + 10;
                                }   
                                elseif($nw == '300')
                                {
                                    $str = '30';
                                    $nl = $nw + 10;
                                }   
                                elseif($nw == '310')
                                {
                                    $str = '31';
                                    $nl = $nw + 10;
                                }   
                                elseif($nw == '320')
                                {
                                    $str = '32';
                                    $nl = $nw + 10;
                                }  
                                elseif($nw == '330')
                                {
                                    $str = '33';
                                    $nl = $nw + 10;
                                }  
                                elseif($nw == '340')
                                {
                                    $str = '34';
                                    $nl = $nw + 10;
                                }  
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                if($key >= 0 && $key <= 8)
                                {
                                   echo $str.$key + 1;
                                }
                                
                                elseif($key == 9)
                                {  
                                   echo $nl;  
                                }
                                
                                        
                                ?>
                                </td>
                               


                                <?php   
                                      $basic_data = json_decode($data->basic_data);
                                      $inventory_data = json_decode($data->inventory_data);

                                ?>
                                
                                <td class="tblData txtCenter ">

                                    <?php if((strlen($basic_data->file_info_newdata)) > 0)
                                    { ?>
                                          <img class="tableImg" src="<?php echo $basic_data->file_info_newdata;?>" alt="">
                                    <?php }
                                          else
                                          {
                                            echo "NA";
                                          }
                                    ?>
                                    
                                </td>
                                
                                <!--<td class="tblData upperCase txtCenter ">
                                    <img class="tableImg" src="<?php echo base_url().  'images/tableImg.png' ?>" alt="">
                                </td>
                                -->
                          
                                <td class="tblData txtCenter blueText" 
                                <?php if(empty($basic_data->fabric_code)){ ?>
                                      
                                <?php  } else {?>
                                onClick = "edit_initial_fabric_detail('<?php echo $data->record_slug0; ?>')" <?php } ?>>
                                <?php 
                                      if(!empty($basic_data->fabric_code))
                                      {
                                        echo $basic_data->fabric_code;
                                      }
                                      else
                                      {
                                        echo "NA";
                                      }
                                 ?>
                                </td>

                                <td class="tblData txtCenter ">
                                <?php 
                                      if(!empty($basic_data->fabric_color))
                                      {
                                         echo $basic_data->fabric_color;
                                      }
                                      else
                                      
                                      {
                                         echo "NA"; 
                                      }
                                       
                                 ?> 
                                </td>
                                
                                 <td class="tblData txtCenter ">
                                
                                <?php 
                                       if(!empty($data->fabric_pattern_id))
                                       {  
                                            $sql= "SELECT * FROM `fabric_pattern_list` WHERE id=".$data->fabric_pattern_id; 
                                            $result = $this->db->query($sql);
	                                        $datanw = $result->result();
                                            echo $datanw[0]->name;
                                       }
                                       else
                                       {
                                          echo "NA";
                                       }
                                ?>    

                                </td>
                                
                                <td class="tblData txtCenter ">
                                
                                <?php 
                                       if(!empty($data->fabric_type_id))
                                       {
                                            $sql= "SELECT * FROM `fabric_type_list` WHERE id=".$data->fabric_type_id; 
                                            $result = $this->db->query($sql);
	                                        $datanw1 = $result->result();
                                            echo $datanw1[0]->name;
                                       }
                                       else
                                       {
                                          echo "NA";
                                       }
                                ?>    

                                </td>
                                <td class="tblData txtCenter ">
                                <?php 
                                      
                                      if(!empty($basic_data->info_data))
                                      {
                                         echo $basic_data->info_data;
                                      }
                                      else
                                      {
                                         echo "NA"; 
                                      }
                                      
                                ?> 
                                </td>

                                <td class="tblData txtCenter ">
                                <?php 
                                       if(!empty($inventory_data->store1))
                                       {
                                          echo $inventory_data->store1;
                                       }
                                       
                                       else
                                       {
                                          echo "NA";
                                       }
                                ?>
                                </td>
                                <td class="tblData txtCenter ">
                                
                                <?php 
                                       if(!empty($inventory_data->store2))
                                       {
                                           echo $inventory_data->store2;
                                       
                                       }
                                       else
                                       {
                                          echo "NA";
                                       }
                                ?>
                                </td>
                                
                               
                                
                                <td class="tblData txtCenter ">
                                
                                <?php 
                                       if(!empty($inventory_data->total_qty))
                                       {
                                           echo $inventory_data->total_qty;
                                       }
                                       else
                                       {
                                          echo "NA";
                                       }
                                ?>    

                                </td> 
                                
                               
                               
                               
                                <?php 
                                     $awdate = $data->created_on; 
                                     $newDatenw = date("d-m-Y", strtotime($awdate)); 
                                     $newDatenwTime = date('h:i A', strtotime($awdate)); 
                                ?> 

                                <td class="tblData txtCenter "> 
                                <?php 
                                    
                                      echo $newDatenw.'  |  '.$newDatenwTime;
                                ?> 
                                </td> 

                                <?php 
                                     $date = $data->updated_on; 
                                     $newDate = date("d-m-Y", strtotime($date)); 
                                     $newDateTime = date('h:i A', strtotime($date)); 
                                ?> 

                                <td class="tblData txtCenter "> 
                                <?php 
                                    
                                      echo $newDate.'  |  '.$newDateTime;
                                ?> 
                                </td> 
                            </tr>
                            <?php } }?>
                        </tbody>

                    </table>
                    <br> 
                     <?php echo $pagination->createLinks(); ?>   