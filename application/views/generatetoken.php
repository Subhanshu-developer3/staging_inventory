<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/style.css" />
</head>



<body>
    <div class="BasicInfoPage">
        <!--=============================== header ===============================-->
        <div class="header flex">
            <div class="logo">
                <img src="<?php echo base_url(); ?>images/logo.png" alt="" />
            </div>
            <div class="headerIcons flex">
                <a href="#" class="HeaderIcon headerBell">
                    <svg viewBox="0 0 32 32" class="icon shapeCodepen headerBellIcon">
                        <use xlink:href="<?php echo base_url(); ?>SVG/sprite.svg#icon-bell-o"></use>
                    </svg>
                </a>
                <a href="#" class="HeaderIcon HeaderUser">
                    <svg viewBox="0 0 32 32" class="icon shapeCodepen headerUserIcon">
                        <use xlink:href="<?php echo base_url(); ?>SVG/sprite.svg#user-icon"></use>
                    </svg>
                </a>
            </div>
        </div>
        <!-- =======================side baer and basic info section ======================= -->
        <div class="mainContentSection flex">
            <!-- ========================side bar section ======================== -->
            <div class="mainLeft">
                <ul class="sidebarMenu robotoReguler">
                    <li class="SidemenuItem upperCase activeMenuItem">
                        <a href="javascript:void(0)" onClick="fabric()">Fabric</a>
                    </li>
                    <li class="SidemenuItem upperCase"><a href="#">Inventory</a></li>
                    <li class="SidemenuItem upperCase"><a href="#">Trims</a></li>
                    <li class="SidemenuItem uppercase"><a href="javascript:void(0)" onClick="configuration()">Masters</a></li>
                </ul>
            </div>
            <div class="mainRight">
                
                <!-- ===================information=================== -->
                <form action="">
                    <div class="mainBasicInfoSection" style="background-color:#f8f8f8;">
                        <div class="information section">
                            <p class="heading robotoMedium upperCase">create access token</p>


                            <div class="flex mainInfoInputS robotoReguler">
                                <div class="vndrDebitnote robotoReguler upperCase flex field_wrapper" >
                                <label for="Price" class="robotoMedium labelTitle" style="margin:10px 0">Create</label> 
                                <div>
                                <input type="text" class="infoInputTxt Debitnoteinput vndrcontctaltprice upperCase addFabric" oninput="change_data()" style="border: 1px solid #ececec;background-color: #fbfbfb;margin: 0 10px 10px 10px;">
                                 <a href="javascript:void(0);" class="add_fabric_type" title="Add field"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                    <p class="errorMsg"><span id="error" style="display:none;">Requested fabric type already exits</span></p>
                                    <p class="sucessMsg"><span id="data_added" style="display: none;">Requested fabric type created successfully</span></p>
                                    <p class="sucessMsg"><span id="data_remove" style="display: none;">Requested fabric type removed successfully</span></p>

                                    <p class="errorMsg"><span id="data_error" style="display: none;">Invalid fabric type</span></p>

                                    
                                <div class="flex mainAddfilter" id="initial">
                                 
                                 
                                 <?php if(!empty($fabric_type_list)){ 
                                       foreach ($fabric_type_list as $value) 
                                 { ?>
                                    <div class="flex addFilterContent" id="<?php echo $value->id;?>">
                                    <button class="FliterTxt"><?php echo $value->name;?></button>
                                    <a href="javascript:void(0)" onClick="remove_fabric_type(<?php echo $value->id;?>)" class="addfilterLink danger">
                                        <i class="fa fa-close" ></i>
                                    </a>
                                 </div>
                                 <?php } } else { ?>
                                 <?php } ?>

                                 <span id="added" style="display: flex;"></span>
                                
                                 
                                 </div>
                                 </div>
                                </div>
<style>
    .addFilterContent {
    border: 1px solid #eee;
    padding: 10px;
    width: max-content;
    border-radius: 7px;
    margin-left:10px;
    flex-wrap: wrap;
}
.errorMsg{
    color:red;
    width:100%;
    font-size: 10px;
    margin:0 0 10px 10px;
}


.sucessMsg{

    color:green;
    width:100%;
    font-size: 10px;
    margin:0 0 10px 10px;
}
 .FliterTxt {
    background: transparent;
    border: 0;
    font-size: 12px;
    margin-right: 20px;
}
.addfilterLink{
    font-size: 12px;
    color: red;
}
</style>                            

                      </div>
                        </div>





                        



                        



                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style type="text/css">
        /*.container{
    padding: 20px;
}*/


.field_wrapper{
    margin-bottom:10px;
}
.add_button, .remove_button{
    vertical-align: middle;
    margin-left: 5px;
}
    </style>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="<?php echo base_url();?>js/login.js" type="text/javascript"></script>





<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" class="infoInputTxt Debitnoteinput vndrcontctaltprice upperCase" style="border: 1px solid #ececec;background-color: #fbfbfb;margin: 0 10px 10px 10px; display: inline-block;"><a href="javascript:void(0);"  class="remove_button"><i class="fa fa-minus-circle " ></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

























<script type="text/javascript">
$(document).ready(function(){
    //var errorMsg = $('#error').text();  
    var baseurl = '<?php echo base_url(); ?>';

    $('#error').css("display","none");
    $("#data_added").css("display", "none");
    $("#data_remove").css("display", "none");
    $("#data_error").css("display","none");
    var add = $('.add_fabric_type');   

    //Once add button is clicked
    $(add).click(function()
    {
       var addFabric = $('.addFabric').val(); 
       $("#data_added").css("display", "none");
       if(addFabric == null || addFabric == "")
       {
           $("#data_error").css("display","block");
           $(".addFabric").css('border', '1px solid red');
       }


       if(addFabric.length >= 1)
       {  
          var html = '';
          $.ajax({
                   url: baseurl + 'add_fabric_type',
                   method: 'POST',
                   data: {
                        type: 'add_fabric_type',
                        addFabric:addFabric
                    },
                    success: function(response){
                        let my_data = JSON.parse(response);
                        if(my_data.status === true)
                        {   
                           let add = my_data.all_data;
                           let added_id = my_data.id;
                           
                         

                           
                           html += '<div class="flex addFilterContent" id="'+my_data.id+'"><button class="FliterTxt">'+ my_data.data +'</button><a href="#" class="addfilterLink danger" onClick="remove_fabric_type('+ my_data.id +')"><i class="fa fa-close" ></i></a></div>';

                           //$("#initial").css("display","none");
                           $('#added').append(html);

                           $("#data_added").css("display", "block");
                           $("#data_remove").css("display", "none");
                           
                        }
                        else
                        {
                            $('#error').css("display", "block");
                        }
                    }


            });
                



          //ajax
       }

    });

});



function change_data()
{   
    $("#data_error").css("display","none");
    $(".addFabric").css('border', 'none');
    $('#error').css("display","none");
    $("#data_added").css("display", "none");
    $("#data_remove").css("display", "none");
}


$('.addFabricData').on('input', function() {
   $("#new_data_error").css("display","none");
    $(".addFabricData").css('border', 'none');
    $('#new_error').css("display","none");
    $("#new_data_added").css("display", "none");
    $("#new_data_remove").css("display", "none");
}); 






function add_fabric_pattern()
{
    var addFabricData = $('.addFabricData').val(); 
       /*$("#new_data_added").css("display", "none");
       $("#new_data_error").css("display","none");
       $("#new_error").css("display","none");*/
       $("#new_data_error").css("display","none");
       $(".addFabricData").css('border', 'none');
       $('#new_error').css("display","none");
       $("#new_data_added").css("display", "none");
       $("#new_data_remove").css("display", "none");
       if(addFabricData == null || addFabricData == "")
       {
           $("#new_data_error").css("display","block");
           $(".addFabricData").css('border', '1px solid red');
       }
       
       if(addFabricData.length >= 1)
       {  
          var htmldata = '';
          $.ajax({
                   url: baseurl + 'add_fabric_pattern',
                   method: 'POST',
                   data: {
                        type: 'add_fabric_pattern',
                        addFabricData:addFabricData
                    },
                    success: function(response){
                        let my_data = JSON.parse(response);
                        if(my_data.status === true)
                        {   
                          
                           
                            htmldata += '<div class="flex addFilterContent" id="'+my_data.id+'"><button class="FliterTxt">'+ my_data.data +'</button><a href="#" class="addfilterLink danger" onClick="remove_fabric_data('+ my_data.id +')"><i class="fa fa-close" ></i></a></div>';

                           $('#newadded').append(htmldata);

                           $("#new_data_added").css("display", "block");
                           $("#new_data_remove").css("display", "none");
                           
                        }
                        else
                        {
                            $('#new_error').css("display", "block");
                        }
                    }


            });
       }
}









$('.addData_nw').on('input', function() {
   
   $("#nw_new_data_error").css("display","none");
   $(".addData_nw").css('border', 'none');
   $('#nw_new_error').css("display","none");
   $("#nw_new_data_added").css("display", "none");
   $("#nw_new_data_remove").css("display", "none");
});  


function add_new()
{  
    var addData_nw = $('.addData_nw').val(); 
       $("#nw_new_data_error").css("display","none");
       $(".addData_nw").css('border', 'none');
       $('#nw_new_error').css("display","none");
       $("#nw_new_data_added").css("display", "none");
       $("#nw_new_data_remove").css("display", "none");
       if(addData_nw == null || addData_nw == "")
       {
           $("#nw_new_data_error").css("display","block");
           $(".addData_nw").css('border', '1px solid red');
       }
       
       if(addData_nw.length >= 1)
       {  
          var htmldata_nw = '';
          $.ajax({
                   url: baseurl + 'add_fabric_nwdata',
                   method: 'POST',
                   data: {
                        type: 'add_fabric_nwdata',
                        addData_nw:addData_nw
                    },
                    success: function(response){
                        let my_data = JSON.parse(response);
                        if(my_data.status === true)
                        {   
                          
                           
                            htmldata_nw += '<div class="flex addFilterContent" id="'+my_data.id+'"><button class="FliterTxt">'+ my_data.data +'</button><a href="#" class="addfilterLink danger" onClick="remove_fabric_data_nw('+ my_data.id +')"><i class="fa fa-close" ></i></a></div>';

                           $('#nw_newadded').append(htmldata_nw);

                           $("#nw_new_data_added").css("display", "block");
                           $("#nw_new_data_remove").css("display", "none");
                           
                        }
                        else
                        {
                            $('#nw_new_error').css("display", "block");
                        }
                    }


            });
       }
}

function remove_fabric_type(id)
{   
    $('#error').css("display","none");
    $("#data_added").css("display", "none");
    $("#data_remove").css("display", "none");
    $("#data_error").css("display","none");
    $("#data_remove").css("display", "none");
    $.ajax({
               url: baseurl + 'remove_fabric_type',
               method: 'POST',
               data: {
                    type: 'remove_fabric_type',
                    id:id
                },
                success: function(response){
                    let my_data = JSON.parse(response);
                    if(my_data.status === true)
                    {   
                        console.log(my_data.message);
                       //let add = my_data.data;
                       $("#"+id).css("display", "none");
                       $("#data_remove").css("display", "block");
                       console.log(added_id);
                    }
                    else
                    {
                        $('#error').css("display", "block");
                    }
                }


        });
}







function remove_fabric_data_nw(id)
{
    $("#nw_new_data_error").css("display","none");
    $('#nw_new_error').css("display","none");
    $("#nw_new_data_added").css("display", "none");
    $("#nw_new_data_remove").css("display", "none");

    $.ajax({
               url: baseurl + 'remove_fabric_data_nw',
               method: 'POST',
               data: {
                    type: 'remove_fabric_data_nw',
                    id:id
                },
                success: function(response){
                    let my_data = JSON.parse(response);
                    if(my_data.status === true)
                    {   
                        console.log(my_data.message);
                       //let add = my_data.data;
                       $("#"+id).css("display", "none");
                       $("#nw_new_data_remove").css("display", "block");
                    }
                    else
                    {
                        $('#nw_new_error').css("display", "block");
                    }
                }


      });
}



function remove_fabric_data(id)
{   
    $('#new_error').css("display","none");
    $("#new_data_added").css("display", "none");
    $("#new_data_remove").css("display", "none");
    $("#new_data_error").css("display","none");
    $("#new_data_remove").css("display", "none");
    $.ajax({
               url: baseurl + 'remove_fabric_pattern',
               method: 'POST',
               data: {
                    type: 'remove_fabric_pattern',
                    id:id
                },
                success: function(response){
                    let my_data = JSON.parse(response);
                    if(my_data.status === true)
                    {   
                        console.log(my_data.message);
                       //let add = my_data.data;
                       $("#"+id).css("display", "none");
                       $("#new_data_remove").css("display", "block");
                    }
                    else
                    {
                        $('#new_error').css("display", "block");
                    }
                }


        });
}
</script>