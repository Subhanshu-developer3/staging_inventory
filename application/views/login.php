<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LogIn Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript">
        var baseurl = 'https://inventory.deebaco.com/index.php/';
    </script>


    
    <link rel="stylesheet" href="https://inventory.deebaco.com/style/style.css" />
</head>

<body>
    <div class="loginScreen">
        <!--=============================== header ===============================-->
        <div class="loinPageHeader">
            <div class="logo">
                <img src="https://inventory.deebaco.com/images/logo.png" alt="" />
            </div>
        </div>
        <div class="loginForm">
            <form id="login_form">
                <div class="mainForm flex">
                <p class="loginTitle robotoReguler upperCase" style="font-size: 19px !important;">Login to Your Account Now</p>

                <input type="email" class="infoInputTxt logOInInput" placeholder="Email Address" id="email" required="" />
                <input type="password" class="infoInputTxt logOInInput" placeholder="Password" id="password" required="" />
                <input type="button" onClick="login()" value="LOGIN" class="loginBtn btn blueBtn">
            </div>
            </form>
        </div>
            </div>
        </div>
    </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://inventory.deebaco.com/js/login.js" type="text/javascript"></script>







<script type="text/javascript">
    

       //code_comment
   //var baseurl = "https://inventory.deebaco.com/index.php/";

  //var baseurl = "http://localhost/inventory/";   
  //code_added
  //var baseurl = "http://localhost/naew/";  

  function login()
  {     var baseurl = "https://inventory.deebaco.com/index.php/";
        var email = $("#email").val();
        var password = $("#password").val();
        $.ajax({
            url: baseurl + 'login',
            method: 'POST',
            data: {
                type: 'login',
                email: email,
                password: password,
                },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        toastr.success(mydata.message);
                        window.location = mydata.redirect;
                    
                    }
                    else
                    {    
                        toastr.error(mydata.message);
                    } }
          });
       return false;
    }
   
   /*function fabricode_error()
   {
       var fabric_code = $("#fabric_code").val();  
       if(fabric_code == null || fabric_code.length === 0)
       {
         
           $(".error_fabric_code").css("display","block");
           $("#fabric_code").css('border', '1px solid red');
       }
       else if(fabric_code.length > 0)
       {
           $(".error_fabric_code").css("display","none");
           $("#fabric_code").css('border', '1px solid #ececec');
       } 
   }*/



 
   function fabricode_error()
   {  
       var baseurl = "https://inventory.deebaco.com/index.php/";
       var fabric_code = $("#fabric_code").val();  
       if(fabric_code == null || fabric_code.length === 0)
       {
         
           $(".error_fabric_code").css("display","block");
           $("#fabric_code").css('border', '1px solid red');
       }
       else if(fabric_code.length > 0)
       {   
           $.ajax({
            url: baseurl + 'fabric_code',
            method: 'POST',
            

            data: {
                type: 'fabric_code',
                fabric_code: fabric_code
                },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        $(".error_fabric_code").css("display","none");
                        $("#fabric_code").css('border', '1px solid red');
                        $(".fabricode_errornew").css("display","block");
                    }
                    else
                    {   
                        $(".error_fabric_code").css("display","none");
                        $("#fabric_code").css('border', '1px solid #ececec');
                        $(".fabricode_errornew").css("display","none");
                    } }
          });
         return false;

           
       } 
   }
   
   function fabricolor_error()
   {
       var fabric_color = $("#fabric_color").val();
       if(fabric_color == null || fabric_color.length === 0)
       {
          $(".error_fabric_color").css("display","block");
          $("#fabric_color").css('border', '1px solid red');
       }
       else if(fabric_color.length > 0)
       {
          $(".error_fabric_color").css("display","none");
          $("#fabric_color").css('border', '1px solid #ececec');
       
       }
    }
    



    function fabrictype_error()
    {
        var fabric_type = $('select[name="fabric_type"]').val();  
        if(fabric_type == null || fabric_type.lenth === 0)
        {
           $(".error_fabric_type").css("display","block");
           $("#fabric_type").css('border', '1px solid red');
        }
        else if(fabric_type.length > 0)
        {
           $(".error_fabric_type").css("display","none");
           $("#fabric_type").css('border', '1px solid #ececec');
        }
    }
    

    function fabricdetail_error()
    {
       var fabric_pattern = $('select[name="fabric_pattern"]').val(); 
       if(fabric_pattern == null || fabric_pattern.length === 0)
       {
         $(".error_fabric_pattern").css("display","block");
         $("#fabric_pattern").css('border', '1px solid red');
       
       }
       else if(fabric_pattern.length > 0)
       {
         $(".error_fabric_pattern").css("display","none");
         $("#fabric_pattern").css('border', '1px solid #ececec');
       }
    }


    /*function defectype_error()
    {
      var defect_type = $("#defect_type").val();
      if(defect_type == null || defect_type.length === 0)
      {
        $(".error_defect_type").css("display","block");
        $("#defect_type").css('border', '1px solid red');
      }
      else if(defect_type.length > 0)
      {
        $(".error_defect_type").css("display","none");
        $("#defect_type").css('border', '1px solid #ececec');
      }
    }*/







    
    /*function defectqty_error()
    {
        var defect_qty = $("#defect_qty").val();  
        if(defect_qty == null || defect_qty.length === 0)
        {
          $(".error_defect_qty").css("display","block");
          $("#defect_qty").css('border', '1px solid red');
        }
        else if(defect_qty.length > 0)
        {
          $(".error_defect_qty").css("display","none");
          
          $("#defect_qty").css('border', '1px solid #ececec');
        }
    }*/


    function fullname_error()
    {
        var fullname = $("#fullname").val();    console.log(typeof(fullname));
        if(fullname == null || fullname.length === 0 )
        {
          $(".error_fullname").css("display","block");
          $("#fullname").css('border', '1px solid red');
          $("#fullname").css('border-radius', '5px');
        }
        else if(fullname.length > 0)
        {
           $(".error_fullname").css("display","none");
           $("#fullname").css('border', '1px solid #ececec');
           $("#fullname").css('border-radius', '5px');
        }
    }
  
   
   //--------------commented starts--------------------------------------------------//
   //-----------------------------//
   /*function info()
   {  
   } */







   


   













     $('.submenu ul').hide();
     $(".submenu a").click(function () {
     $(this).parent(".submenu").children("ul").slideToggle();
     });
    
     function archieve_nwdetails() 
     {  
        var baseurl = "https://inventory.deebaco.com/index.php/";
        window.location = baseurl + 'render_unarchive_lists';
     }

     function unarchieve_nwdetails()   
     {  
        var baseurl = "https://inventory.deebaco.com/index.php/";
        window.location = baseurl + 'list-fabric';
     }









    function show_cpurchase_cvendor() 
    {



      var baseurl = "https://inventory.deebaco.com/index.php/";
      window.location = baseurl + 'render_cpurchase_cvendor_detail';
    }

    
    function fabricinvoiceid_error()
   {   
       var baseurl = "https://inventory.deebaco.com/index.php/";
       var invoiceId = $("#invoiceId").val(); 
       //var baseurl = "http://localhost/inventory/";
       if(invoiceId == null || invoiceId.length === 0)
       {
         
           $(".error_fabricinvoiceid").css("display","block");
           $("#invoiceId").css('border', '1px solid red');
       }
       else if(invoiceId.length > 0)
       {   
           $.ajax({
            url: baseurl + 'fabric_invoiceid',
            method: 'POST',
            

            data: {
                type: 'fabric_invoiceid',
                invoiceId: invoiceId
                },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        $(".error_fabricinvoiceid").css("display","none");
                        $("#invoiceId").css('border', '1px solid red');
                        $(".error_fabricinvoiceid_new").css("display","block");
                    }
                    else
                    {   
                        $(".error_fabricinvoiceid").css("display","none");
                        $("#invoiceId").css('border', '1px solid #ececec');
                        $(".error_fabricinvoiceid_new").css("display","none");
                    } }
          });
         return false;

           
       } 
   }
   

   function edit_modal_data(hash_id)
   {
      //alert(hash_id);
       
      $('#modal_edit_data').show();
   }





   //---------------added new code------------//
   function info()
   {  
      
     //fabric code
     $(".error_fabric_code").css("display","none");
     $("#fabric_code").css('border', '1px solid #ececec');
     //fabric color
     $(".error_fabric_color").css("display","none");
     $("#fabric_color").css('border', '1px solid #ececec');
     //fabric type
     $(".error_fabric_type").css("display","none");
     $("#fabric_type").css('border', '1px solid #ececec');
     //fabric pattern
     $(".error_fabric_pattern").css("display","none");
     $("#fabric_pattern").css('border', '1px solid #ececec');
     
     

      

      var fabric_code = $("#fabric_code").val();
      var fabric_color = $("#fabric_color").val();
      var fabric_type = $('select[name="fabric_type"]').val(); 
      var fabric_pattern = $('select[name="fabric_pattern"]').val();
      var swatch_card = $("#swatch_card").val();
      var file_info_newdata = $("#file_info_newdata").val();

      if((fabric_code == '') && (fabric_color == '') && (fabric_pattern == '') && (fabric_type == ''))
      { 
        $(".error_fabric_code").css("display","block");
        $("#fabric_code").css('border', '1px solid red');
        $(".error_fabric_color").css("display","block");
        $("#fabric_color").css('border', '1px solid red');
        
        $(".error_fabric_type").css("display","block");
        $("#fabric_type").css('border', '1px solid red');
        $(".error_fabric_pattern").css("display","block");
        $("#fabric_pattern").css('border', '1px solid red'); alert("hii");
        return true;
      }

       if((fabric_code == null || fabric_code.length === 0) && 
       (fabric_color == null || fabric_color.length === 0))
       {
           $(".error_fabric_code").css("display","block");
           $("#fabric_code").css('border', '1px solid red');
           $(".error_fabric_color").css("display","block");
           $("#fabric_color").css('border', '1px solid red');
           return true;
       }

       if(fabric_code == null || fabric_code.length === 0)
       {
           $(".error_fabric_code").css("display","block");
           $("#fabric_code").css('border', '1px solid red');
           return true;
       }
     

       var fabric_color = $("#fabric_color").val(); 
       if(fabric_color == null || fabric_color.length === 0)
       {
           $(".error_fabric_color").css("display","block");
           $("#fabric_color").css('border', '1px solid red');
           return true;
       }

       if((fabric_pattern == null || fabric_pattern.length === 0) && 
       (fabric_type == null || fabric_type.length === 0))
       {
           $(".error_fabric_type").css("display","block");
           $("#fabric_type").css('border', '1px solid red');
           $(".error_fabric_pattern").css("display","block");
           $("#fabric_pattern").css('border', '1px solid red');
           return true;
       }

       if(fabric_type == null || fabric_type.length === 0)
       {
         $(".error_fabric_type").css("display","block");
         $("#fabric_type").css('border', '1px solid red');
         return true;
       }

    
       if(fabric_pattern == null || fabric_pattern.length === 0)
       {
         $(".error_fabric_pattern").css("display","block");
         $("#fabric_pattern").css('border', '1px solid red');
         return true;
       }
       

       var file = $("#file").val();
       var file_data = $("#file_data").val();


       
       /*if(file_info_newdata === 'file_info_newdata')
       {
         $(".errorfiledatanw").css("display","block");
         $("#errorfiledatanw").css('border', '1px solid red');
         return true;
       }
       else
       {
         $(".errorfiledatanw").css("display","none");
         $("#errorfiledatanw").css('border', '1px solid #ececec');
       }*/
      
      var fabric_id = $("#fabric_codeid").val();
      var fabric_codeid = parseInt(fabric_id);
      if(fabric_codeid == 0) {
       //code added
      if( (fabric_code != null || fabric_code != "") && (fabric_color != null || fabric_color != "") && (fabric_type != null || fabric_type != "") && (fabric_pattern != null || fabric_pattern != ""))
      { 

       var baseurl = "https://inventory.deebaco.com/index.php/";
       $.ajax({
            url: baseurl + 'add_info',
            method: 'POST',
            data: {
            type: 'info_detail',fabric_code:fabric_code,fabric_color:fabric_color,fabric_type:fabric_type,
                  fabric_pattern:fabric_pattern,swatch_card:swatch_card, file_info_newdata:file_info_newdata
            },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        window.location = mydata.redirect;
                        toastr.success("Fabric data added successfully");
                        $("#nwbutton1").css("display","none");
                        $("#fabric_codeid").val('');
                        $("#fabric_codeid").val(mydata.fabric_codeid);
                        $("#nwedit1").css("display","block");
                        
                        
                        console.log(mydata.fabric_codeid);
                        $('#fabric_code').attr("disabled", true);  
                        $('#fabric_code').css('cursor', 'not-allowed');
                        $('select[name="fabric_type"]').attr("disabled", true);
                        $('select[name="fabric_type"]').css('cursor', 'not-allowed');
                        $('select[name="fabric_pattern"]').attr("disabled", true);
                        $('select[name="fabric_pattern"]').css('cursor', 'not-allowed');
                        $('#fabric_color').attr("disabled", true);
                        $('#fabric_color').css('cursor', 'not-allowed');
                        $('#swatch_card').attr("disabled", true);
                        $('#swatch_card').css('cursor', 'not-allowed');
                        $('#file_info_newdata').attr("disabled", true);
                        $('#file_info_newdata').css('cursor', 'not-allowed');
                    }
                    else
                    {    
                        //toastr.error(mydata.message);
                    }
            }
        });
      }
      return false;
      }
      
      


      else if(fabric_codeid != 0 ) 
      {
           if( (fabric_code != null || fabric_code != "") && (fabric_color != null || fabric_color != "") && (fabric_type != null || fabric_type != "") && (fabric_pattern != null || fabric_pattern != ""))
           { 
             var baseurl = "https://inventory.deebaco.com/index.php/";
             $.ajax({
                url: baseurl + 'edit-info',
                method: 'POST',
                data: {
                type: 'edit_info_detail',fabric_code:fabric_code,fabric_color:fabric_color,fabric_type:fabric_type,
                      fabric_pattern:fabric_pattern,swatch_card:swatch_card, file_info_newdata:file_info_newdata,
                      fabric_codeid:fabric_codeid
                },
                success: function(remes){
                        
                        var mydata = $.parseJSON(remes);
                        if(mydata.status == 'success')
                        {   
                            //window.location = mydata.redirect;
                            toastr.success("Fabric data added successfully");
                            $("#nwbutton1").css("display","none");
                            $("#fabric_codeid").val('');
                            $("#fabric_codeid").val(mydata.fabric_codeid);
                            $("#nwedit1").css("display","block");
                            
                            
                            console.log(mydata.fabric_codeid);
                            $('#fabric_code').attr("disabled", true);  
                            $('#fabric_code').css('cursor', 'not-allowed');
                            $('select[name="fabric_type"]').attr("disabled", true);
                            $('select[name="fabric_type"]').css('cursor', 'not-allowed');
                            $('select[name="fabric_pattern"]').attr("disabled", true);
                            $('select[name="fabric_pattern"]').css('cursor', 'not-allowed');
                            $('#fabric_color').attr("disabled", true);
                            $('#fabric_color').css('cursor', 'not-allowed');
                            $('#swatch_card').attr("disabled", true);
                            $('#swatch_card').css('cursor', 'not-allowed');
                            $('#file_info_newdata').attr("disabled", true);
                            $('#file_info_newdata').css('cursor', 'not-allowed');
                        }
                        else
                        {    
                            //toastr.error(mydata.message);
                        }
                  }
                });
            }
            return false;
        }
    } 

  






  function editInfo()
  { //alert("hii");
    $("#nwbutton1").css("display","block");
    $("#nwedit1").css("display","none");
    /*$('#fabric_code').attr("disabled", false);  
    $('#fabric_code').css('cursor', 'default');*/
    $('select[name="fabric_type"]').attr("disabled", false);
    $('select[name="fabric_type"]').css('cursor', 'default');
    $('select[name="fabric_pattern"]').attr("disabled", false);
    $('select[name="fabric_pattern"]').css('cursor', 'default');
    $('#fabric_color').attr("disabled", false);
    $('#fabric_color').css('cursor', 'default');
    $('#swatch_card').attr("disabled", false);
    $('#swatch_card').css('cursor', 'default');
    $('#file_info_newdata').attr("disabled", false);
    $('#file_info_newdata').css('cursor', 'default');
    
    $("#file_info").attr("disabled", false);
    
    
    $("#file_info").prop("type", "file");
  }

   
  
  function addInfomodaldata() 
  {   
     var invoiceId = $("#invoiceId").val();
     var cpurchase_qty = $("#cpurchase_qty").val();
     var cpurchase_qty_units = $('select[name="cpurchase_qty_units"]').val();   //alert(cpurchase_qty_units); 
     var fabric_width = $("#fabric_width").val(); 
     var fabric_width_units = $('select[name="fabric_width_units"]').val();  //alert(fabric_width_units);
     var cpriceInfo = $("#cpriceInfo").val();
     var total_price = $("#total_price").val(); 
     var vendor_details = $('select[name="vendor_details"]').val();  
     var dateofentry = $('#dateofentry').val();  
     var user_added = $('#user_added').val(); 
     var fabric_codeid = $("#fabric_codeid").val();

     if(invoiceId == null || invoiceId.length === 0)
     {    
         $(".error_fabricinvoiceid").css("display","block");
         $("#invoiceId").css('border', '1px solid red');
         return true;
     }
     else
     {
         $(".error_fabricinvoiceid").css("display","none"); 
         $("#invoiceId").css('border', '1px solid #ececec');
     }


     if(vendor_details == null || vendor_details.length === 0 || vendor_details == 0)
     {    
         $(".error_vendor_details").css("display","block");
         $('select[name="vendor_details"]').css('border', '1px solid red');
         return true;
     }
     else
     {
         $(".error_vendor_details").css("display","none"); 
         $('select[name="vendor_details"]').css('border', '1px solid #ececec');
     }

     if(dateofentry == null || dateofentry.length === 0 || dateofentry == '')
     {    
         $(".error_dateofentry").css("display","block");
         $('#dateofentry').css('border', '1px solid red');
         return true;
     }
     else
     {
         $(".error_dateofentry").css("display","none"); 
         $('#dateofentry').css('border', '1px solid #ececec');
     }

     
     if(user_added == null || user_added.length === 0 || user_added == '')
     {    
         $(".error_user_added").css("display","block");
         $('#user_added').css('border', '1px solid red');
         return true;
     }
     else
     {
         $(".error_user_added").css("display","none"); 
         $('#user_added').css('border', '1px solid #ececec');
     }


     
    /* if((invoiceId != null || invoiceId != "") && (cpurchase_qty != null || cpurchase_qty != "") && 
         (cpurchase_qty_units != null || cpurchase_qty_units != "") && (fabric_width != null || fabric_width != "") &&
         (fabric_width_units != null  || fabric_width_units != "") && (cpriceInfo != null || cpriceInfo != "") &&
         (total_price != null || total_price != "") && (vendor_details != null || vendor_details != "") &&
         (dateofentry != null || dateofentry != "") && (user_added !=null || user_added != "") && (fabric_codeid != 0)
      )*/
     if((invoiceId != null || invoiceId.length  != 0))
     { 




       var baseurl = "https://inventory.deebaco.com/index.php/";
       $.ajax({
            url: baseurl + 'add_infomodal_data',
            method: 'POST',
            data: {
            type: 'add_infomodal_data',invoiceId:invoiceId,cpurchase_qty:cpurchase_qty,cpurchase_qty_units:cpurchase_qty_units,
                  fabric_width:fabric_width,fabric_width_units:fabric_width_units, cpriceInfo:cpriceInfo,total_price:total_price,
                  vendor_details:vendor_details,dateofentry:dateofentry,user_added:user_added,fabric_codeid:fabric_codeid
            },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        toastr.success("Fabric purchase details saved successfully");
                        window.location = mydata.redirect;
                    }
                    else
                    {    
                        toastr.error("Something went wrong");
                    }
            }
        });
      }
      return false;
  }










  function editInfomodaldata() 
  {   
     
     var cpurchase_qty = $(".cpurchase_qty_nw").val();
     var cpurchase_qty_units = $('select[name="cpurchase_qty_units_nw"]').val(); 
     var fabric_width = $("#fabric_width_nw").val(); 
     var fabric_width_units = $('select[name="fabric_width_units_nw"]').val(); 
     var cpriceInfo = $("#cpriceInfo_nw").val();
     var total_price = $("#total_price_nw").val(); 
     var vendor_details = $('select[name="vendor_detail_data"]').val();  
     var fabric_codeid = $("#modaledit").val();
     var data_id = $("#data_id").val();

  
     


     if(vendor_details == null || vendor_details.length === 0 || vendor_details == 0)
     {    
         $(".error_vendor_details").css("display","block");
         $('select[name="vendor_details"]').css('border', '1px solid red');
         return true;
     }
     else
     {
         $(".error_vendor_details").css("display","none"); 
         $('select[name="vendor_details"]').css('border', '1px solid #ececec');
     }

     
     if(data_id > 0)
     { 


       var baseurl = "https://inventory.deebaco.com/index.php/";
       $.ajax({
            url: baseurl + 'edit_infomodal_data',
            method: 'POST',
            data: {
            type: 'edit_infomodal_data',cpurchase_qty:cpurchase_qty,cpurchase_qty_units:cpurchase_qty_units,
                  fabric_width:fabric_width,fabric_width_units:fabric_width_units, cpriceInfo:cpriceInfo,total_price:total_price,
                  vendor_details:vendor_details,data_id:data_id,fabric_codeid:fabric_codeid
            },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        toastr.success("Fabric purchase details updated successfully");
                        window.location = mydata.redirect;
                    }
                    else
                    {    
                        toastr.error("Something went wrong");
                    }
            }
        });
      }
      return false;
  }
















  

  function createInfomodaldata() 
  {   
     var invoiceId = $("#invoiceId").val();
     var cpurchase_qty = $("#cpurchase_qty").val();
     var cpurchase_qty_units = $('select[name="cpurchase_qty_units_nwa"]').val(); 
     var fabric_width = $("#fabric_width").val();
     var fabric_width_units = $('select[name="fabric_width_units_nwa"]').val();
     var cpriceInfo = $("#cpriceInfo").val();
     var total_price = $("#total_price").val(); 
     var vendor_details = $('select[name="vendor_details"]').val();  
     var dateofentry = $('#dateofentry').val();  
     var user_added = $('#user_added').val(); 
     var fabric_codeid = $("#fabric_codeid").val();
     
     




     if(invoiceId == null || invoiceId.length === 0)
     {    
         $(".error_fabricinvoiceid").css("display","block");
         $("#invoiceId").css('border', '1px solid red');
         return true;
     }
     else
     {
         $(".error_fabricinvoiceid").css("display","none"); 
         $("#invoiceId").css('border', '1px solid #ececec');
     }


     if(vendor_details == null || vendor_details.length === 0 || vendor_details == 0)
     {    
         $(".error_vendor_details").css("display","block");
         $('select[name="vendor_details"]').css('border', '1px solid red');
         return true;
     }
     else
     {
         $(".error_vendor_details").css("display","none"); 
         $('select[name="vendor_details"]').css('border', '1px solid #ececec');
     }

     if(dateofentry == null || dateofentry.length === 0 || dateofentry == '')
     {    
         $(".error_dateofentry").css("display","block");
         $('#dateofentry').css('border', '1px solid red');
         return true;
     }
     else
     {
         $(".error_dateofentry").css("display","none"); 
         $('#dateofentry').css('border', '1px solid #ececec');
     }

     
     if(user_added == null || user_added.length === 0 || user_added == '')
     {    
         $(".error_user_added").css("display","block");
         $('#user_added').css('border', '1px solid red');
         return true;
     }
     else
     {
         $(".error_user_added").css("display","none"); 
         $('#user_added').css('border', '1px solid #ececec');
     }


     
     var hash_id = $("#hash_id").val();
     var total_rows = $("#total_rows").val();
     
     

     /*if((invoiceId != null || invoiceId != "") && (cpurchase_qty != null || cpurchase_qty != "") && 
         (cpurchase_qty_units != null || cpurchase_qty_units != "") && (fabric_width != null || fabric_width != "") &&
         (fabric_width_units != null  || fabric_width_units != "") && (cpriceInfo != null || cpriceInfo != "") &&
         (total_price != null || total_price != "") && (vendor_details != null || vendor_details != "") &&
         (dateofentry != null || dateofentry != "") && (user_added !=null || user_added != "") && (fabric_codeid != 0)
      )*/
     if((invoiceId != null || invoiceId.length  != 0))
     { 


       var baseurl = "https://inventory.deebaco.com/index.php/";
       $.ajax({
            url: baseurl + 'add_infomodal_data',
            method: 'POST',
            data: {
            type: 'add_infomodal_data',invoiceId:invoiceId,cpurchase_qty:cpurchase_qty,cpurchase_qty_units:cpurchase_qty_units,
                  fabric_width:fabric_width,fabric_width_units:fabric_width_units, cpriceInfo:cpriceInfo,total_price:total_price,
                  vendor_details:vendor_details,dateofentry:dateofentry,user_added:user_added,fabric_codeid:fabric_codeid
            },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        window.location = mydata.redirect;
                        toastr.success("Fabric purchase details saved successfully");
                        
                    }
                    else
                    {    
                        toastr.error("Something went wrong");
                    }
            }
        });
      }
      return false;
  }
 







 function delete_fabric_detail(id)
  {   var naewid = "#id_"+id;
      swal({
        title: "Are you sure to delete this record ?",
        text: "Delete Confirmation?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false
      },
      function() {

        var baseurl = "https://inventory.deebaco.com/index.php/";
        $.ajax({
            url: baseurl + 'remove_purchase_record',
            method: 'POST',
            data: {
            type: 'remove_purchase_record',id:id
            },
            success: function(data) { $(naewid).remove(); }
          })
          .done(function(data) {
            $(naewid).remove();
            swal("Deleted!", "Data successfully Deleted!", "success");
          })
          .error(function(data) {
            swal("Oops", "Something went wrong!", "error");
          });
      }
    );
  }


  
 

 function add_fabric_inventory_details(hash_id, id)
 {  
    var baseurl = "https://inventory.deebaco.com/index.php/";
    window.location = baseurl+'add-inventory/'+hash_id+'/'+id;
 }


  function read_fabric_inventory_details(hash_id, id)
  { 
    var baseurl = "https://inventory.deebaco.com/index.php/";
    window.location = baseurl+'inventory_detail_read/'+hash_id+'/'+id;
  }

  function edit_fabric_inventory_details(hash_id)
  {  
     var baseurl = "https://inventory.deebaco.com/index.php/";
     window.location = baseurl+'edit_inventory_detail/'+hash_id;
  }
 
 function edit_initial_fabric_detail(hash_id)
 {  
    var baseurl = "https://inventory.deebaco.com/index.php/";
    $.ajax({
            url: baseurl + 'url_data',
            method: 'POST',
            data: {
            type: 'url_data', hash_id:hash_id },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        
                        window.location = mydata.redirect;
                       
                    }
                    else if(mydata.status == 'error')
                    {    
                        window.location = mydata.redirect;
                    }
            }
        });
      return false;
 }





 function edit_disable_initial_fabric_detail(hash_id)
 {  
    var baseurl = "https://inventory.deebaco.com/index.php/";
    $.ajax({
            url: baseurl + 'url_querydata',
            method: 'POST',
            data: {
            type: 'url_querydata', hash_id:hash_id },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        
                        window.location = mydata.redirect;
                       
                    }
                    else if(mydata.status == 'error')
                    {    
                        window.location = mydata.redirect;
                    }
            }
        });
      return false;
 }



    



      





      function showcvendornwdata(hash_id) 
      {  
         var baseurl = "https://inventory.deebaco.com/index.php/";
         var redirect = 'render_cvendor_lists/'
         window.location = baseurl + redirect + hash_id; 
      }

      function rendercbasicinfoadata(hash_id) 
      {  
         var baseurl = "https://inventory.deebaco.com/index.php/";
         var redirect = 'add-fabric-basic-info/'
         window.location = baseurl + redirect + hash_id; 
      }



 function archieve_fabric_data()
 {  
    var baseurl = "https://inventory.deebaco.com/index.php/";
    var redirect = 'render_unarchive_lists'
    window.location = baseurl + redirect; 
 }
 //------------------------commented ends -------------------------------------------//


  function add_fabric()
  {   
    
    //var baseurl = 'http://localhost/code/';
    var baseurl = "https://inventory.deebaco.com/index.php/";
    var redirect = 'create-initial-fabric'
    window.location = baseurl + redirect;
  }


  function with_water(i)
  {
   if(i == true)
   {
    $("#with_water").addClass("activeBlueBtn");
    $("#with_water_re").removeClass("activeBlueBtn");
    $('#with_water_response').val('on');
   }

   if(i == false)
   {
    $("#with_water_re").addClass("activeBlueBtn");
    $("#with_water").removeClass("activeBlueBtn");
    $('#with_water_response').val('off');
   }
  }


  function with_soap_re(i)
  {
   
   if(i == true)
   {
    $("#with_soap_re_true").addClass("activeBlueBtn");
    $("#with_soap_re_false").removeClass("activeBlueBtn");
    $('#with_soap_response').val('on');
   }

   
   if(i == false)
   {
    $("#with_soap_re_false").addClass("activeBlueBtn");
    $("#with_soap_re_true").removeClass("activeBlueBtn");
    $('#with_soap_response').val('off');
   }
 }





  function info_basic_detail_re_render(id)
  {
     //var baseurl = 'http://localhost/code/';
     var baseurl = "https://inventory.deebaco.com/index.php/";
     var redirect = 'basic_info/'+id;
     window.location = baseurl + redirect; 
  }

   function inventory_detail_re_render(id)
   {
     //var baseurl = 'http://localhost/code/';
     var baseurl = "https://inventory.deebaco.com/index.php/";
     var redirect = 'edit_inventory_detail/'+id;
     window.location = baseurl + redirect; 
   }


   
   function show_cvendor_detail(id)
   {
     //var baseurl = 'http://localhost/code/';
     var baseurl = "https://inventory.deebaco.com/index.php/";
     var redirect = 'edit-cvendor-detail/'+id;
     window.location = baseurl + redirect; 
   }
  
  

  function add_new_cvendor(id)
  {
     var redirect = 'add-new-cvendor/'+id;
     var baseurl = "https://inventory.deebaco.com/index.php/";
     window.location = baseurl + redirect; 
  }


  function chnage_re_render_inventory_detail(hash_id, id)
  {
     //var baseurl = 'http://localhost/code/';
     var baseurl = "https://inventory.deebaco.com/index.php/";
     var redirect = 'change_inventory_detail/';
     window.location = baseurl + redirect; 
  }



  /*$(".add_qty").change(function () 
  {
     var store2 = $("#store2").val();
     
     var store1 = $("#store1").val();
     var total_qty = parseInt(store1) + parseInt(store2);
     var total_qty = total_qty + ' meter';
     $("#total_qty").val(total_qty);
  });*/




 /* $(".add_qtynew").change(function () 
  {
     var store2 = $("#store2").val();
     if (store2 == null || store2 == "") 
     {    
          var qty = '0';
          var store1 = $("#store1").val();
          var total_qty = parseInt(store1) + parseInt(qty);
          var total_qty = total_qty + ' meter';
          $("#total_qty").val(total_qty);
     }
  }); */
  
  
  







  




  function data_storeunit1()
  {
     $(".dataerror_store1").css("display","none");
     $("#storeunit1").css('border', 'none'); 

     $(".data_error_totalqty0").css('display','none');
     $(".data_error_totalqty2").css('display','none'); 
     //$(".data_error_totalqty1").css('display','none');
     $("#storeunit1").css('border', '1px solid #ececec');
     $("#data_totalQtyunit_data_1").css('border', '1px solid #ececec');

     var storeunit1text;
     var data_totalQtyunit_data_1 = $('select[name="data_totalQtyunit_data_1"]').val();  console.log(data_totalQtyunit_data_1)
     var storeunit1 = $('select[name="storeunit1"]').val(); console.log(storeunit1)

     if(isNaN(storeunit1))
     {  
        //$(".dataerror_store1").css("display","block");
        $(".dataerror_store1").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
        $("#storeunit1").css('border', '1px solid red'); 
        return true;
     }
     else
     {
        if(data_totalQtyunit_data_1 === storeunit1)
        {
           

           storeunit1text = $('select[name="storeunit1"]').find(":selected").text();
        }
        else
        {        
          //$(".data_error_totalqty0").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
          $("#data_totalQtyunit_data_1").css('border','1px solid red');
          $("#storeunit1").css('border','1px solid red');
          $(".total_qtyunit").val('UNIT');
          $(".total_qtyunit").css("text-transform", "uppercase");
          return true;
        }
      
      }
 }



  function data_storeunit2()
  {  
     $(".dataerror_store2").css("display","none");
     $("#storeunit2").css('border', 'none'); 
     //$(".data_error_totalqty1").css('display','none');
     $("#storeunit2").css('border', '1px solid #ececec');
     $("#data_totalQtyunit_data_1").css('border', '1px solid #ececec');

     var storeunit2text;
     var data_totalQtyunit_data_1 = $('select[name="data_totalQtyunit_data_1"]').val();

     var storeunit1 = $('select[name="storeunit1"]').val(); console.log(storeunit1)
     if(isNaN(storeunit1))
     {  
        //$(".dataerror_store1").css("display","block");
        $(".dataerror_store1").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
        $("#storeunit1").css('border', '1px solid red'); 
        return true;
     }

     var storeunit2 = $('select[name="storeunit2"]').val(); 
     if(isNaN(storeunit2))
     {  
        $(".dataerror_store2").css("display","block");
        $("#storeunit2").css('border', '1px solid red'); 
        return true;
     }
     
        if( (data_totalQtyunit_data_1 === storeunit2) && (data_totalQtyunit_data_1 === storeunit1) && (storeunit1 === storeunit2))
        {
            



            storeunit2text = $('select[name="storeunit2"]').find(":selected").text();
            $(".total_qtyunit").val('');
            $(".total_qtyunit").val(storeunit2text);

        }
        else
        {        
          //$(".data_error_totalqty1").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
          $("#data_totalQtyunit_data_1").css('border','1px solid red');
          $("#storeunit2").css('border','1px solid red');
          return true;
        }
      
    
  }


 
  



  //store1
  function add_qtynewdata_old()
  {  
     
     $(".dataerror_totalqty").css("display","none");
     var fabricQtyCount = parseInt($("#total_fabricqty_count").val());
     //console.log(fabricQtyCount+"fabricQtyCount");     

     var data_total_fabric_qty = parseInt($("#data_total_fabric_qty_data_"+fabricQtyCount).val());   
     if(isNaN(data_total_fabric_qty))
     {   
         $("#store1").attr("readonly", true);
         $("#store1").css("cursor","not-allowed");
         $("#store2").attr("readonly", true);
         $("#store2").css("cursor","not-allowed");
         $("#data_total_fabric_qty_data_"+fabricQtyCount).css("border","1px solid red");
         $(".data_error_totalqty_error_"+fabricQtyCount).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
     }
     else if(data_total_fabric_qty === 0)
     {
         $("#store1").attr("readonly", true);
         $("#store1").css("cursor","not-allowed");
         $("#store2").attr("readonly", true);
         $("#store2").css("cursor","not-allowed");
         $("#data_total_fabric_qty_data_"+fabricQtyCount).css("border","1px solid red");
         $(".data_error_totalqty_error_"+fabricQtyCount).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });   
     }
     
     else
     {
         $("#store1").attr("readonly", false);
         $("#store1").css("cursor","auto");
         $("#store2").attr("readonly", false);
         $("#store2").css("cursor","auto");
         $("#data_total_fabric_qty_data_"+fabricQtyCount).css('border','1px solid #ececec');
         $(".data_error_totalqty_error_"+fabricQtyCount).css("display","none");
     }
     
     var totalqtyleftnaew = parseInt($("#totalqtyleftnaew").val());

     //console.log(data_total_fabric_qty+"data_total_fabric_qty");
     //console.log(totalqtyleftnaew+"totalqtyleftnaew");

     if(isNaN(data_total_fabric_qty))
     {
        
        datanw = '0';
        $("#total_qty").val('0');
     } 
     else
     {
        datanw = data_total_fabric_qty;
     }

     if(data_total_fabric_qty == null || data_total_fabric_qty == "" || datanw == '0')
     {
        //$(".data_error_totalqty").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
        $("#data_total_fabric_qty_data_"+fabricQtyCount).css('border','1px solid red');
        //alert("Total quantity must be a valid number greater than 0 unit");
        $("#total_qty").val('0');
        return true;
     }

     var store2 = $("#store2").val();
     
     if (store2 == null || store2 == "" || store2 === "0") 
     {    
          var store1 = $("#store1").val();
          var total_qty = parseInt(store1) + parseInt(store2);   
          var totalnwqty = totalqtyleftnaew + data_total_fabric_qty;
          
          if(total_qty > totalnwqty)
          {   
              $("#total_qty").val('0');
              $(".total_qtyunit").val('UNIT');
              //alert("Quantity in store1 will have to be exactly or less than total quantity entered");
              //$(".data_error_totalqty").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
              $("#data_total_fabric_qty_data_"+fabricQtyCount).css('border','1px solid red');
              $("#store1").css('border','1px solid red');
          } 
          else
          {     
             $("#total_qty").val('');
             $("#total_qty").val(total_qty);
             $(".total_qtyunit").val('');
             //$("#data_error_totalqty_store1").css('display','none');
             //$(".data_error_totalqty").css('display','none');
             $("#data_total_fabric_qty_data_"+fabricQtyCount).css('border','1px solid #ececec');
             $("#store1").css('border','1px solid #ececec');
             var data_totalQtyunit_data_1 = $('select[name="data_totalQtyunit_data_1"]').val(); 
             var storeunit1text = $('select[name="data_totalQtyunit_data_1"]').find(":selected").text();
             $(".total_qtyunit").val('');
             $(".total_qtyunit").val(storeunit1text);
            // $(".total_qtyunit").css("text-transform", "uppercase");
         }
       }
       else
       {    


            var store1 = $("#store1").val();
            var store2 = $("#store2").val();
            var total_qty = parseInt(store1) + parseInt(store2);  
            var totalnwqty = totalqtyleftnaew + data_total_fabric_qty; 

            if(total_qty > totalnwqty)
            {   
              $("#total_qty").val('0');
              $(".total_qtyunit").val('UNIT');
              $("#data_total_fabric_qty_data_"+fabricQtyCount).css('border','1px solid red');
              $("#store1").css('border','1px solid red');
            
            }
            else
            {     
             $("#total_qty").val('');
             $("#total_qty").val(total_qty);
             $(".total_qtyunit").val('');
             $("#data_total_fabric_qty_data_"+fabricQtyCount).css('border','1px solid #ececec');
             $("#store1").css('border','1px solid #ececec');
             var data_totalQtyunit_data_1 = $('select[name="data_totalQtyunit_data_1"]').val(); 
             var storeunit1text = $('select[name="data_totalQtyunit_data_1"]').find(":selected").text();
             $(".total_qtyunit").val('');
             $(".total_qtyunit").val(storeunit1text);
             //$(".total_qtyunit").css("text-transform", "uppercase");
            } 
       
       }
  }

     


  
  

    
    
    //fabric quantity
    function data_total_fabric_qty_data_1_new_old(z)
    {  
      var x = parseInt(z);
      $(".data_error_newerrorall_"+x).css('display','none'); 
      var data_total_fabric_qty_data = $("#data_total_fabric_qty_data_"+x).val();
        if((data_total_fabric_qty_data.length == 0) || (data_total_fabric_qty_data == 'null'))
        {
             $("#data_total_fabric_qty_data_"+x).css("border","1px solid red");
             $(".data_error_newerrorall_"+x).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
        
        }
        else
        {
             $(".data_error_newerrorall_"+x).css('display','none'); 

             $("#data_total_fabric_qty_data_"+x).css('border','1px solid #ececec');
        }

      var datanew = parseInt($("#data_total_fabric_qty_data_"+x).val()); 
      if(isNaN(datanew))
      {   
         $("#store1").attr("readonly", true);
         $("#store1").css("cursor","not-allowed");
         $("#store2").attr("readonly", true);
         $("#store2").css("cursor","not-allowed");
         $("#data_total_fabric_qty_data_"+x).css("border","1px solid red");
         $(".data_error_totalqty_error").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
      }
      else if(datanew === 0)
      {
         $("#store1").attr("readonly", true);
         $("#store1").css("cursor","not-allowed");
         $("#store2").attr("readonly", true);
         $("#store2").css("cursor","not-allowed");
         $("#data_total_fabric_qty_data_"+x).css("border","1px solid red");
         $(".data_error_totalqty_error").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });   
      }
      else
      {
         $("#store1").attr("readonly", false);
         $("#store1").css("cursor","auto");
         $("#store2").attr("readonly", false);
         $("#store2").css("cursor","auto");
         $("#data_total_fabric_qty_data_"+x).css('border','1px solid #ececec');
         $(".data_error_totalqty_error").css("display","none");
      }
      
      //$(".data_error_totalqty").css('display','none'); 
      $("#data_total_fabric_qty_data_"+x).css('border','1px solid #ececec');
    
      var store1 = parseInt($("#store1").val());
      if(isNaN(store1))
      { 
         return true;
      } 
      
      if(store1 == null || store1 == "")
      {
          return true;
      }
      
      var data_total_fabric_qty = parseInt($("#data_total_fabric_qty_data_"+x).val());
      
      
      
      if(isNaN(data_total_fabric_qty))
      {  
         //$(".data_error_totalqty").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
         $("#data_total_fabric_qty_data_"+x).css('border','1px solid red');
         return true;
      }
      if(data_total_fabric_qty > 0 )
      {
       
       if(store1 == null || store1 == "")
       {
          return true;
       }
       
       else
       {
           if(store1 > data_total_fabric_qty)
           {
              $("#total_qty").val('0');
              $(".total_qtyunit").val('UNIT');
              $(".total_qtyunit").css("text-transform", "uppercase");
              //$(".data_error_totalqty_store1").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0'});
              $("#data_total_fabric_qty_data_"+x).css('border','1px solid red');
              $("#store1").css('border','1px solid red');
           }
           else
           {
              $("#total_qty").val(store1);
              $(".total_qtyunit").val('UNIT'); 
              $(".total_qtyunit").css("text-transform", "uppercase");
              //$(".data_error_totalqty_store1").css('display','none');
              $("#data_total_fabric_qty_data_"+x).css('border','1px solid #ececec');
              $("#store1").css('border','1px solid #ececec');
           }
       }
      
         
      }
      else
      {
         //$(".data_error_totalqty").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
         $("#data_total_fabric_qty_data_"+x).css('border','1px solid red');
         //alert("Total quantity must be a valid number greater than 0 unit");
         return true;
      }




    
      var store2 = $("#store2").val();
      if(store1 == null || store1 == "")
      {
         return true;
      }
      else
      {

      }

      if(store2 == null || store2 == "")
      {
          
          return true;
      }  
    }
    




    




    

  
 

 function addsku(x)
 {  
    var y = parseInt(x);
    if(y === 4)
    {
       document.getElementById("sku2").style.display = "block";  
       document.getElementById("deletesku2").style.display = "block";
       document.getElementById("addsku4").style.display = "none";
       document.getElementById("addsku3").style.display = "block";
    }
    else if(y === 3)
    {
       document.getElementById("sku3").style.display = "block";
       document.getElementById("deletesku3").style.display = "block";
       document.getElementById("addsku3").style.display = "none";
       document.getElementById("addsku2").style.display = "block";
    }
    else if(y === 2)
    {
       document.getElementById("sku4").style.display = "block";
       document.getElementById("deletesku4").style.display = "block";
       document.getElementById("addsku2").style.display = "none";
       document.getElementById("addsku1").style.display = "block";
    }
    else if(y === 1)
    {
       document.getElementById("sku5").style.display = "block";
       document.getElementById("deletesku5").style.display = "block";
       document.getElementById("addsku1").style.display = "none";
    }
 

 }






  function deletesku(x)
  {
     var y = parseInt(x);
     if(y === 1)
     {
        document.getElementById("sku1").style.display = "none";
        document.getElementById("deletesku").style.display = "none";
        document.getElementById("addsku1").style.display = "block";
     }
  }

  
  





  function  shrinkage_nah()
  {
     var shrinkage_before_test_h = $("#shrinkage_before_test_h").val(); 
     if((shrinkage_before_test_h == null || shrinkage_before_test_h == ''))
     {
       //$(".error_shrinkage_before_test_h").css("display","block");
       $("#shrinkage_before_test_h").css('border', '1px solid red');
       return true;
     }
     else
     {
       //$(".error_shrinkage_before_test_h").css("display","none");
       $("#shrinkage_before_test_h").css('border', '1px solid #ececec');
       return true;
     }
  }
  
  
  
  
  function  shrinkage_naw()
  {
     var shrinkage_before_test_w = $("#shrinkage_before_test_w").val(); 
     if((shrinkage_before_test_w == null || shrinkage_before_test_w == ''))
     {
       //$(".shrinkage_before_test_w").css("display","block");
       $("#shrinkage_before_test_w").css('border', '1px solid red');
       return true;
     }
     else
     {
       //$(".shrinkage_before_test_w").css("display","none");
       $("#shrinkage_before_test_w").css('border', '1px solid #ececec');
       return true;
     }
  }
  
  
  
  
   function  shrinkage_codeh()
  {
     var shrinkage_fabric_code_h = $("#shrinkage_fabric_code_h").val(); 
     if((shrinkage_fabric_code_h == null || shrinkage_fabric_code_h == ''))
     {
       //$(".shrinkage_fabric_code_h").css("display","block");
       $("#shrinkage_fabric_code_h").css('border', '1px solid red');
       return true;
     }
     else
     {
       //$(".shrinkage_fabric_code_h").css("display","none");
       $("#shrinkage_fabric_code_h").css('border', '1px solid #ececec');
       return true;
     }
  }
  
  
  
  
  
  
  
  
  
  function  shrinkage_codew()
  {
     var shrinkage_fabric_code_w = $("#shrinkage_fabric_code_w").val(); 
     if((shrinkage_fabric_code_w == null || shrinkage_fabric_code_w == ''))
     {
       //$(".shrinkage_fabric_code_w").css("display","block");
       $("#shrinkage_fabric_code_w").css('border', '1px solid red');
       return true;
     }
     else
     {
       //$(".shrinkage_fabric_code_w").css("display","none");
       $("#shrinkage_fabric_code_w").css('border', '1px solid #ececec');
       return true;
     }
  }
  
  
  
  
  
  

 function chnage_re_render_basic_info_detail(record_slug, id)
 {
     //var baseurl = "http://localhost/code/";
     
     //fabric code
     $(".error_fabric_code").css("display","none");
     $("#fabric_code").css('border', '1px solid #ececec');
     //fabric color
     $(".error_fabric_color").css("display","none");
     $("#fabric_color").css('border', '1px solid #ececec');

     //fabric type
     $(".error_fabric_type").css("display","none");
     $("#fabric_type").css('border', '1px solid #ececec');
     //fabric pattern
     $(".error_fabric_pattern").css("display","none");
     $("#fabric_pattern").css('border', '1px solid #ececec');
     
     //defect type
     //$(".error_defect_type").css("display","none");
     
     //$("#defect_type").css('border', '1px solid #ececec');


     //defect quantity
     //$(".error_defect_qty").css("display","none");
     //$("#defect_qty").css('border', '1px solid #ececec');
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     //$(".error_shrinkage_before_test_h").css("display","none");
     $("#shrinkage_before_test_h").css('border', '1px solid #ececec');
     //$(".shrinkage_before_test_w").css("display","none");
     $("#shrinkage_before_test_w").css('border', '1px solid #ececec');
     //$(".shrinkage_fabric_code_h").css("display","none");
     $("#shrinkage_fabric_code_h").css('border', '1px solid #ececec');
     //$(".shrinkage_fabric_code_w").css("display","none");
     $("#shrinkage_fabric_code_w").css('border', '1px solid #ececec');
     

     $(".error_fullname").css("display","none");
     $("#fullname").css('border', '1px solid #ececec');
     $("#fullname").css('border-radius', '5px');


     var fabric_code = $("#fabric_code").val();
     var fabric_color = $("#fabric_color").val();
     
     
     
     if((fabric_code == null || fabric_code.length === 0) && (fabric_color == null || fabric_color.length === 0)){
       $(".error_fabric_code").css("display","block");
       $("#fabric_code").css('border', '1px solid red');
       $(".error_fabric_color").css("display","block");
       $("#fabric_color").css('border', '1px solid red');
       return true;
     }
     
     if(fabric_code == null || fabric_code.length === 0){
       $(".error_fabric_code").css("display","block");
       $("#fabric_code").css('border', '1px solid red');
       return true;
     }
     

      
     if(fabric_color == null || fabric_color.length === 0){
       $(".error_fabric_color").css("display","block");
       $("#fabric_color").css('border', '1px solid red');
       return true;
     }

     var info_data = $("#vendor").val();
     
     

     //var total_qty = $("#total_qty").val();
     //var fabric_width = $("#fabric_width").val();
     var fabric_defect_qty = $('select[name="fabric_width_unit"]').val();
     var fabric_type = $('select[name="fabric_type"]').val();
     
     var fabric_pattern = $('select[name="fabric_pattern"]').val();
     
      if((fabric_pattern == null || fabric_pattern.length === 0) && (fabric_type == null || fabric_type.length === 0))
      {
       $(".error_fabric_type").css("display","block");
       $("#fabric_type").css('border', '1px solid red');
       $(".error_fabric_pattern").css("display","block");
       $("#fabric_pattern").css('border', '1px solid red');
       return true;
      }
      
     if(fabric_type == null || fabric_type.length === 0){
       $(".error_fabric_type").css("display","block");
       $("#fabric_type").css('border', '1px solid red');
       return true;
     }

     if(fabric_pattern == null || fabric_pattern.length === 0){
       $(".error_fabric_pattern").css("display","block");
       $("#fabric_pattern").css('border', '1px solid red');
       return true;
     }


     var swatch_card = $("#swatch_card").val();
     var defect_type = $("#defect_type").val();
     var defect_qty = $("#defect_qty").val();    
     /*if(defect_qty == null || defect_qty.length === 0){
       $(".error_defect_qty").css("display","block");
       $("#defect_qty").css('border', '1px solid red'); 
     }*/

      /*if(defect_type == null || defect_type.length === 0){
       $(".error_defect_type").css("display","block");
       $("#defect_type").css('border', '1px solid red');
     }*/

     var defect_remarks = $("#defect_remarks").val();
     var shrinkage_before_test_h = $("#shrinkage_before_test_h").val(); 
     var shrinkage_before_test_w = $("#shrinkage_before_test_w").val();
     
     var shrinkage_fabric_code_h = $("#shrinkage_fabric_code_h").val();
     var shrinkage_fabric_code_w = $("#shrinkage_fabric_code_w").val();
     
     if((shrinkage_before_test_h == null || shrinkage_before_test_h == '') && (shrinkage_before_test_w == null || shrinkage_before_test_w == '') &&  (shrinkage_fabric_code_h == null || shrinkage_fabric_code_h == '') && (shrinkage_fabric_code_w == null || shrinkage_fabric_code_w == '') )
     {
       //$(".error_shrinkage_before_test_h").css("display","block");
       $("#shrinkage_before_test_h").css('border', '1px solid red');
       //$(".shrinkage_before_test_w").css("display","block");
       $("#shrinkage_before_test_w").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_h").css("display","block");
       $("#shrinkage_fabric_code_h").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_w").css("display","block");
       $("#shrinkage_fabric_code_w").css('border', '1px solid red');
       return true;
     }
     
     
     
     
     
     
     
     
     
     
     if((shrinkage_before_test_h == null || shrinkage_before_test_h == '') && (shrinkage_before_test_w == null || shrinkage_before_test_w == '')  && (shrinkage_fabric_code_w == null || shrinkage_fabric_code_w == '') )
     {
       //$(".error_shrinkage_before_test_h").css("display","block");
       $("#shrinkage_before_test_h").css('border', '1px solid red');
       //$(".shrinkage_before_test_w").css("display","block");
       $("#shrinkage_before_test_w").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_w").css("display","block");
       $("#shrinkage_fabric_code_w").css('border', '1px solid red');
       return true;
     }
     
     
     
     if((shrinkage_before_test_w == null || shrinkage_before_test_w == '') &&  (shrinkage_fabric_code_h == null || shrinkage_fabric_code_h == '') && (shrinkage_fabric_code_w == null || shrinkage_fabric_code_w == '') )
     {
       //$(".shrinkage_before_test_w").css("display","block");
       $("#shrinkage_before_test_w").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_h").css("display","block");
       $("#shrinkage_fabric_code_h").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_w").css("display","block");
       $("#shrinkage_fabric_code_w").css('border', '1px solid red');
       return true;
     }
     
     
     if((shrinkage_before_test_h == null || shrinkage_before_test_h == '')  &&  (shrinkage_fabric_code_h == null || shrinkage_fabric_code_h == '') && (shrinkage_fabric_code_w == null || shrinkage_fabric_code_w == '') )
     {
       //$(".error_shrinkage_before_test_h").css("display","block");
       $("#shrinkage_before_test_h").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_h").css("display","block");
       $("#shrinkage_fabric_code_h").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_w").css("display","block");
       $("#shrinkage_fabric_code_w").css('border', '1px solid red');
       return true;
     }
     
     
     
     if((shrinkage_before_test_h == null || shrinkage_before_test_h == '') && (shrinkage_before_test_w == null || shrinkage_before_test_w == '')  && (shrinkage_fabric_code_w == null || shrinkage_fabric_code_w == '') )
     {
       //$(".error_shrinkage_before_test_h").css("display","block");
       $("#shrinkage_before_test_h").css('border', '1px solid red');
       //$(".shrinkage_before_test_w").css("display","block");
       $("#shrinkage_before_test_w").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_w").css("display","block");
       $("#shrinkage_fabric_code_w").css('border', '1px solid red'); 
       return true;
     }
     
     
     
     
      if((shrinkage_before_test_h == null || shrinkage_before_test_h == '') && (shrinkage_before_test_w == null || shrinkage_before_test_w == '') &&  (shrinkage_fabric_code_h == null || shrinkage_fabric_code_h == ''))
     {
       //$(".error_shrinkage_before_test_h").css("display","block");
       $("#shrinkage_before_test_h").css('border', '1px solid red');
       //$(".shrinkage_before_test_w").css("display","block");
       $("#shrinkage_before_test_w").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_h").css("display","block");
       $("#shrinkage_fabric_code_h").css('border', '1px solid red');
       return true;
     }
     
     
     if((shrinkage_before_test_h == null || shrinkage_before_test_h == '') && (shrinkage_before_test_w == null || shrinkage_before_test_w == '') )
     {
       //$(".error_shrinkage_before_test_h").css("display","block");
       $("#shrinkage_before_test_h").css('border', '1px solid red');
       //$(".shrinkage_before_test_w").css("display","block");
       $("#shrinkage_before_test_w").css('border', '1px solid red');
       return true;
     }
     
     
     
     
     if((shrinkage_fabric_code_h == null || shrinkage_fabric_code_h == '') && (shrinkage_fabric_code_w == null || shrinkage_fabric_code_w == '') )
     {
       //$(".shrinkage_fabric_code_h").css("display","block");
       $("#shrinkage_fabric_code_h").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_w").css("display","block");
       $("#shrinkage_fabric_code_w").css('border', '1px solid red');
       return true;
     }
     
     
     
     if((shrinkage_before_test_h == null || shrinkage_before_test_h == '')  &&  (shrinkage_fabric_code_h == null || shrinkage_fabric_code_h == ''))
     {
       //$(".error_shrinkage_before_test_h").css("display","block");
       $("#shrinkage_before_test_h").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_h").css("display","block");
       $("#shrinkage_fabric_code_h").css('border', '1px solid red');
       return true;
     }
     
     
     
     
     
     if( (shrinkage_before_test_w == null || shrinkage_before_test_w == '') &&  (shrinkage_fabric_code_h == null || shrinkage_fabric_code_h == '') )
     {
       //$(".shrinkage_before_test_w").css("display","block");
       $("#shrinkage_before_test_w").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_h").css("display","block");
       $("#shrinkage_fabric_code_h").css('border', '1px solid red');
       return true;
     }
     
     
     if( (shrinkage_before_test_w == null || shrinkage_before_test_w == '') &&  (shrinkage_fabric_code_w == null || shrinkage_fabric_code_w == '') )
     {
       //$(".shrinkage_before_test_w").css("display","block");
       $("#shrinkage_before_test_w").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_w").css("display","block");
       $("#shrinkage_fabric_code_w").css('border', '1px solid red');
       return true;
     }
     
     
     
     
     
     
     
     
     
     if((shrinkage_before_test_h == null || shrinkage_before_test_h == '')  && (shrinkage_fabric_code_w == null || shrinkage_fabric_code_w == '') )
     {
       //$(".error_shrinkage_before_test_h").css("display","block");
       $("#shrinkage_before_test_h").css('border', '1px solid red');
       //$(".shrinkage_fabric_code_w").css("display","block");
       $("#shrinkage_fabric_code_w").css('border', '1px solid red');
       return true;
     }
     
     
     if((shrinkage_before_test_h == null || shrinkage_before_test_h == ''))
     {
       //$(".error_shrinkage_before_test_h").css("display","block");
       $("#shrinkage_before_test_h").css('border', '1px solid red');
       return true;
     }
     
     if((shrinkage_before_test_w == null || shrinkage_before_test_w == ''))
     {
       //$(".shrinkage_before_test_w").css("display","block");
       $("#shrinkage_before_test_w").css('border', '1px solid red');
       return true;
     }
     
     
     if((shrinkage_fabric_code_h == null || shrinkage_fabric_code_h == ''))
     {
       //$(".shrinkage_fabric_code_h").css("display","block");
       $("#shrinkage_fabric_code_h").css('border', '1px solid red');
       return true;
     }
     
     if((shrinkage_fabric_code_w == null || shrinkage_fabric_code_w == ''))
     {
       //$(".shrinkage_fabric_code_w").css("display","block");
       $("#shrinkage_fabric_code_w").css('border', '1px solid red');
       return true;
     }
     
     
     
     /*var shrinkage_before_test_h = $("#shrinkage_before_test_h").val();
     var shrinkage_before_test_w = $("#shrinkage_before_test_w").val();
     var shrinkage_fabric_code_h = $("#shrinkage_fabric_code_h").val();
     var shrinkage_fabric_code_w = $("#shrinkage_fabric_code_w").val();*/
     var shrinkage_comments = $("#shrinkage_comments").val();
     var with_water_response = $("#with_water_response").val();
     var with_soap_response = $("#with_soap_response").val();
     
     if((with_water_response == null || with_water_response == '')  && (with_soap_response == null || with_soap_response == '') )
     {
       //$(".with_water_response").css("display","block");
       $("#with_water_response").css('border', '1px solid red');
       //$(".with_soap_response").css("display","block");
       $("#with_soap_response").css('border', '1px solid red');
       return true;
     }
     
     
     if((with_water_response == null || with_water_response == '') )
     {
       //$(".with_water_response").css("display","block");
       $("#with_water_response").css('border', '1px solid red');
       return true;
     }
     
     
     if((with_soap_response == null || with_soap_response == '') )
     {
       //$(".with_soap_response").css("display","block");
       $("#with_soap_response").css('border', '1px solid red');
       return true;
     }
     
     var colorbleed_comments = $("#colorbleed_comments").val();
     var file = $("#file").val();
     var file_data = $("#file_data").val();
     var fullname = $("#fullname").val();
      if(fullname == null || fullname.length === 0){
       $(".error_fullname").css("display","block");
       $("#fullname").css('border', '1px solid red');
       $("#fullname").css('border-radius', '5px'); 
       return true;
     }

    var file_info_newdata = $("#file_info_newdata").val(); 
    if(file_info_newdata === 'file_info_newdata')
     {
         $(".errorfiledatanw").css("display","block");
         $("#errorfiledatanw").css('border', '1px solid red');
         return true;
     }
     else
     {
         $(".errorfiledatanw").css("display","none");
         $("#errorfiledatanw").css('border', '1px solid #ececec');
     }
    
    
    
    
     var baseurl = "https://inventory.deebaco.com/index.php/";
     $.ajax({
            url: baseurl + 'change_basic_info',
            method: 'POST',
            data: {
            type: 'info_detail',fabric_code:fabric_code,fabric_color:fabric_color,info_data:info_data,fabric_type:fabric_type,fabric_pattern:fabric_pattern,swatch_card:swatch_card,
                  defect_type:defect_type,defect_qty:defect_qty,defect_remarks:defect_remarks, 
                  shrinkage_before_test_h:shrinkage_before_test_h,shrinkage_before_test_w:shrinkage_before_test_w,
                  shrinkage_fabric_code_h:shrinkage_fabric_code_h,shrinkage_fabric_code_w:shrinkage_fabric_code_w,
                  shrinkage_comments:shrinkage_comments,with_water_response:with_water_response,with_soap_response:with_soap_response,
                  with_soap_response:with_soap_response,colorbleed_comments:colorbleed_comments,file:file,file_data:file_data,
                  fullname:fullname,record_slug:record_slug,id:id,fabric_defect_qty:fabric_defect_qty,file_info_newdata:file_info_newdata
            },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   //alert(mydata.redirect);
                        window.location = mydata.redirect; 
                        toastr.success(mydata.message);               
                    }
                    
                    else
                    {    
                        toastr.error(mydata.message);
                    }
            }
        });
    
    return false;
 }



  
     function  edit_show_inventory_detail_on_redirect(id)
     {
         //var baseurl = "http://localhost/code/";
         var baseurl = "https://inventory.deebaco.com/index.php/";
         var url = "edit_inventory_detail/";
         window.location = baseurl + url + id;
     }


    function  edit_show_cvendor_detail_on_redirect(id)
    {
         //var baseurl = "http://localhost/code/";
         var baseurl = "https://inventory.deebaco.com/index.php/";
         var url = "edit-cvendor-detail/";
         window.location = baseurl + url + id;
    }





   function add() {
     
    //Create an input type dynamically.
    var element = document.createElement("input");
    //Assign different attributes to the element.
    element.setAttribute("type", "text");
    //element.setAttribute("value", "");
    element.setAttribute("class", "infoInputTxt upperCase")
    element.setAttribute("placeholder","Enter BILL NO.")
    element.setAttribute('margin-right', '10px')
    element.setAttribute("margin-bottom", '10px')
    element.setAttribute("width","max-content")
    var no = parseInt($("#billaddIcon").val());
    var count = no + 1;
    var str = "bill_no_" + count;
    element.setAttribute("id", str); 


    element.setAttribute("name", str);
    //$("str1").css('margin-right', '10px');
    var foo = document.getElementById("fooBar");
    //Append the element in page (in span).
    foo.appendChild(element);
    $("#billaddIcon").val('');
    
    $("#billaddIcon").val(count);
  }


  function edit() {
     
    //Create an input type dynamically.
    var element_editnew = document.createElement("input");

    //Assign different attributes to the element.
    element_editnew.setAttribute("type", "text");
    //element.setAttribute("value", "");
    element_editnew.setAttribute("class", "infoInputTxt upperCase")
    element_editnew.setAttribute("placeholder","Enter BILL NO.")
    element_editnew.setAttribute('margin-right', '10px')
    element_editnew.setAttribute("margin-bottom", '10px')
    element_editnew.setAttribute("width","max-content")
    var no = parseInt($("#billaddIcon").val());
    var count = no + 1;
    var str = "bill_no_" + count;
    element_editnew.setAttribute("id", str) 
    element_editnew.setAttribute("name", str);
    //$("str1").css('margin-right', '10px');
    var fooelement_editnew = document.getElementById("element_editnew");
    //Append the element in page (in span).
    fooelement_editnew.appendChild(element_editnew);
    $("#billaddIcon").val('');
    $("#billaddIcon").val(count);
 }



  $(document).ready(function () {
    
     //Create an input type dynamically.
    var element = document.createElement("input");

    //Assign different attributes to the element.
    element.setAttribute("type", "text");
    //element.setAttribute("value", "");
    element.setAttribute("name", "bill_no_1");
    

    element.setAttribute("class", "infoInputTxt upperCase")
    element.setAttribute("placeholder","Enter BILL NO.")
    element.setAttribute('margin-right', '10px')
    element.setAttribute("margin-bottom", '10px')
    element.setAttribute("width","max-content")
    var str = "bill_no_1";
    element.setAttribute("id", str)
    element.setAttribute("name", str)
    var foo = document.getElementById("fooBar");
    foo.appendChild(element);
    $("#billaddIcon").val('');
    $("#billaddIcon").val(1);


    //Create an input type dynamically.
    var elementnew1 = document.createElement("input");  
    //Assign different attributes to the element.
    elementnew1.setAttribute("type", "text");
    //element.setAttribute("value", "");
    elementnew1.setAttribute("name", "debit_no_1");
    elementnew1.setAttribute("class", "infoInputTxt Debitnoteinput upperCase")
    elementnew1.setAttribute("placeholder","Enter debit price")
    elementnew1.setAttribute('margin-right', '10px')
    elementnew1.setAttribute("margin-bottom", '10px')
    elementnew1.setAttribute("width","max-content")
    
    var str1 = "debit_no_1";
    elementnew1.setAttribute("id", str1)
    var foo1 = document.getElementById("debitnote"); 
    //Append the element in page (in span).
    foo1.appendChild(elementnew1);
    $("#debitaddIcon").val('');
    $("#debitaddIcon").val(1);

   });



    
    //onload show 
    //Create an input type dynamically.
    var elementsku = document.createElement("input");
    //Assign different attributes to the element.
    elementsku.setAttribute("type", "text");
    elementsku.setAttribute("name", "add_sku_list");
    elementsku.setAttribute("class", "infoInputTxt SkuInput")
    elementsku.setAttribute("placeholder","SKU45648561541254658")
    var straddsku = "add_sku_no_1";
    elementsku.setAttribute("id", straddsku)
    var foosku = document.getElementById("addedallsku");
    //Append the element in page (in span).
    foosku.appendChild(elementsku);
    $("#addskuCount").val(''); $("#addskuCount").val(1);
    $("#deletehiddensku").attr('onClick','deletesku(1)');
    $("#deletehiddensku").css('display','block');




   
    
    function  addaSku()
    {
        var no = parseInt($("#addskuCount").val());
        var count = no + 1;
        $("#addskuCount").val('');
        $("#addskuCount").val(count);
        var str = "add_sku_no_" + count;
        $('#'+str).css('display','block');
        
        $("#delete_sku_"+count).css('display','block');


        if(no == 4){
            $("#addskuCount").val('');
            $("#addskuCount").val(count);
            $("#addSku").css('display','none');
        }
    }


    function deleteaSku(x)
    {
       var no = parseInt(x);
       
       var total = $("#addskuCount").val();
       var count = total - 1;
       $("#addskuCount").val('');
       $("#addskuCount").val(count);

       if(no <= 5)
       {
          $("#addSku").css('display','block');
       }

       

       if(no !== 1)
       {
           var str = "add_sku_no_" + no;
           $("#"+str).val('');
           $("#"+str).css('display','none');
           $("#delete_sku_"+no).css('display','none');
       }
    }

     


     function debitnoteadd()
     {
        //Create an input type dynamically.
        var element2 = document.createElement("input");
        //Assign different attributes to the element.
        element2.setAttribute("type", "text");
        
        //element.setAttribute("value", "");
        element2.setAttribute("class", "infoInputTxt Debitnoteinput upperCase")
        element2.setAttribute("placeholder","Enter debit price")

        element2.setAttribute('margin-right', '10px')
        element2.setAttribute("margin-bottom", '10px')
        element2.setAttribute("width","max-content")
        
        var no = parseInt($("#debitaddIcon").val());
        var count = no + 1;
        var str = "debit_no_" + count;
        element2.setAttribute("id", str)
        element2.setAttribute("name", str);
        var foonew = document.getElementById("debitnote");
        //Append the element in page (in span).
        foonew.appendChild(element2);
        $("#debitaddIcon").val('');
        $("#debitaddIcon").val(count);
     }





      function debitnote_edit()
      {
          //Create an input type dynamically.
          var elementedit = document.createElement("input");
          //Assign different attributes to the element.
          elementedit.setAttribute("type", "text");
          
          //element.setAttribute("value", "");
          elementedit.setAttribute("class", "infoInputTxt Debitnoteinput upperCase")
          elementedit.setAttribute("placeholder","Enter debit price")

          elementedit.setAttribute('margin-right', '10px')
          elementedit.setAttribute("margin-bottom", '10px')
          elementedit.setAttribute("width","max-content")
          
          var no = parseInt($("#debitaddIcon").val());
          var count = no + 1;
          var str = "debit_no_" + count;
          elementedit.setAttribute("id", str)
          elementedit.setAttribute("name", str);
          var foonewedit = document.getElementById("debitnote_edit");
          //Append the element in page (in span).
          foonewedit.appendChild(elementedit);
          $("#debitaddIcon").val('');
          $("#debitaddIcon").val(count);
      }





        function edit_info_detail(x)
        {
            var str = x;
            var baseurl = "https://inventory.deebaco.com/index.php/";
            window.location = baseurl + "basic_info/" + str; 
        }



        function addnewrecord()
        {  
         
           
           var nodatanew = parseInt($("#recordCount").val());  //alert(nodatanew); 
           
           var no = (nodatanew - 1);           



           //codenew_added  

           $("#show_data_"+no).css("display","none");
           $("#err_data_"+no).css("display","none");
           
           var data_date_n = ".data_date_"+no;  
           var dataerr_date= ".dataerr_date_"+no;
           $(dataerr_date).css("display","none");
           $(data_date_n).css('border', '1px solid #ececec');  
           
           var storeqty_n = "#storeqty_"+no;  
           var data_storeqty= ".data_storeqty_"+no;
           $(data_storeqty).css("display","none");
           $(storeqty_n).css('border', '1px solid #ececec');  
           
           
           var enter_n = "#enter_"+no;
           var data_enter= ".data_enter_"+no;
           $(data_enter).css("display","none");
           $(enter_n).css('border', '1px solid #ececec');   
           
           
           var dataerror_fabricdate_old = $(data_date_n).val();    
           var data_storeqty_old = $(storeqty_n).val();  
           var data_enter_old = $(enter_n).val();    
           
           
           if((dataerror_fabricdate_old == null || dataerror_fabricdate_old == "" ) && (data_storeqty_old == null || data_storeqty_old == "" )  && (data_enter_old == null || data_enter_old == "" ))
           {
             $(dataerr_date).css("display","block");
             $(data_date_n).css('border', '1px solid red');       
             $(data_date_n).css('border-radius', '5px');    
             
             $(data_storeqty).css("display","block");
             $(storeqty_n).css('border', '1px solid red');   
             $(storeqty_n).css('border-radius', '5px');
             
             
             $(data_enter).css("display","block");
             $(enter_n).css('border', '1px solid red');   
             $(enter_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(dataerr_date).css("display","none");
             $(data_date_n).css('border', '1px solid #ececec'); 
             $(data_storeqty).css("display","none");
             $(storeqty_n).css('border', '1px solid #ececec'); 
             $(data_enter).css("display","none");
             $(enter_n).css('border', '1px solid #ececec');   
           }
           
           
           
            if((data_storeqty_old == null || data_storeqty_old == "" )  && (data_enter_old == null || data_enter_old == "" ))
           {
            
             
             $(data_storeqty).css("display","block");
             $(storeqty_n).css('border', '1px solid red');   
             $(storeqty_n).css('border-radius', '5px');
             
             
             $(data_enter).css("display","block");
             $(enter_n).css('border', '1px solid red');   
             $(enter_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             
             $(data_storeqty).css("display","none");
             $(storeqty_n).css('border', '1px solid #ececec'); 
             $(data_enter).css("display","none");
             $(enter_n).css('border', '1px solid #ececec');   
           }
           
           
            if((dataerror_fabricdate_old == null || dataerror_fabricdate_old == "" )  && (data_enter_old == null || data_enter_old == "" ))
           {
             $(dataerr_date).css("display","block");
             $(data_date_n).css('border', '1px solid red');   
             $(data_date_n).css('border-radius', '5px');
             
            
             
             $(data_enter).css("display","block");
             $(enter_n).css('border', '1px solid red');   
             $(enter_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(dataerr_date).css("display","none");
             $(data_date_n).css('border', '1px solid #ececec'); 
             
             $(data_enter).css("display","none");
             $(enter_n).css('border', '1px solid #ececec');   
           }
           
           
           
           
           if(dataerror_fabricdate_old == null || dataerror_fabricdate_old == "" )
           {
             $(dataerr_date).css("display","block");
             $(data_date_n).css('border', '1px solid red');   
             $(data_date_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(dataerr_date).css("display","none");
             $(data_date_n).css('border', '1px solid #ececec');   
           }
           
           
           
           
           if(data_storeqty_old == null || data_storeqty_old == "" )
           {
             $(data_storeqty).css("display","block");
             $(storeqty_n).css('border', '1px solid red');   
             $(storeqty_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(data_storeqty).css("display","none");
             $(storeqty_n).css('border', '1px solid #ececec');   
           }
           
           
           
           
           
           if(data_enter_old == null || data_enter_old == "" )
           {
             $(data_enter).css("display","block");
             $(enter_n).css('border', '1px solid red');   
             $(enter_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(data_enter).css("display","none");
             $(enter_n).css('border', '1px solid #ececec');   
           }
           //var count = no + 1;
           var count = nodatanew + 1;
           var date = "date_"+count;
           var in_2 = "in_"+count;
           var out_2 = "out_"+count;
           
           //added
           var outerr_outerror_out_n = "outerr_outerror_"+out_2;
           var lotno1_outerrorstore1_out_n = "lotno1_outerrorstore1_"+out_2;
           var lotno2_outerrorstore2__out_n = "lotno2_outerrorstore2_"+out_2;
            
                                                
           var storeqty_2 = "storeqty_"+count;   
           var skurecord_2 = "skurecord_"+count;
           var qtystoredata = "qtystoredata("+count+")"; 

           var total_qty_left_2 = "total_qty_left_"+count;
           var enter_2 = "enter_"+count;
           var dataerr_date_naewnw = "errorMsg  dataerr_date_"+count;
           var classnw = "infoInputTxt upperCase infoInput4 inputSltlft data_date_"+count;
           var data_storeqty_anew = "errorMsg data_storeqty_"+count;
           var  data_enter_anew  = "errorMsg data_enter_"+count;
           var lotno2_outerrorstore2_out_new = "lotno2_outerrorstore2_out_"+count;
           var lotno1_outerrorstore1_outnew = "lotno1_outerrorstore1_out_"+count;
 
           



           //codeadded_new
           var record_created = "record_created("+count+")";
           var show_data_n = "show_data_"+count;
           var err_data_n = "err_data_"+count;
           var datarecordnw = "datarecordnw_"+count;
           var datarecordnwdelete = "datarecordnwdelete_"+count;
           var record_deleted = "record_deleted("+count+")";





           var record_newdataid = "FullDateYear_"+count;
           var data =  "<div class='FullDateYear  flex' id='"+record_newdataid+"'><div class='flex inptLbldateInOut1'><label for='date' class='robotoMedium  labelTitle'>Date</label><div class='requiredMsg'><input type='date' name='"+date+"' id='"+date+"' style='width:143px;' class='"+classnw+"' placeholder='24-OCT-2020'> <p class='" + dataerr_date_naewnw+ "' style='color:#dc3545;font-size: 10px;margin-top: 3px;margin-left: 2px; display:none;'>* This field is invalid</p></div></div><div class='flex inptLbldateInOut2'><label for='IN' class='robotoMedium labelTitle'>IN</label><input type='text' name='"+in_2+"'  id='"+in_2+"' oninput='inchnge();'  class='upperCase infoInputTxt filterDate2'></div><div class='flex inptLbldateInOut3'><label for='OUT' class='robotoMedium labelTitle'>OUT</label><div class='requiredMsg filterDate3'><input type='text' name='"+out_2+"' id='"+out_2+"' oninput='ouchnge();' class='upperCase infoInputTxt filterDate3'placeholder=''><p class='errorMsg' id='"+outerr_outerror_out_n+"' style='color:#dc3545;font-size: 10px;margin-top: 3px;margin-left: 2px; display:none;'>* This field is invalid</p><p class='errorMsg' id='"+lotno1_outerrorstore1_outnew+"' style='display:none;'>* Total quantity must be a valid number less than and equal to quantity in store 1</p><p class='errorMsg' id='"+lotno2_outerrorstore2_out_new+"' style='display:none;'>Total quantity must be a valid number less than and equal to quantity in store 2</p></div></div><div class='flex inptLbldateInOut4'><label for='OUT' class='robotoMedium labelTitle'>STORE</label><div class='requiredMsg filterDate4'><select type='text' name='"+storeqty_2+"' id='"+storeqty_2+"' class='infoInputTxt filterDate4' placeholder='' style='width:75px;' onchange='getaldata();'><option value='' selected disabled hidden>Select</option><option value='1'>Store 1</option><option value='2'>Store 2</option></select><p class='"+ data_storeqty_anew +"' style='color: rgb(220, 53, 69); font-size: 10px; margin-top: 3px; margin-left: 2px; display: none;'>* This field is invalid</div></div><div class='flex inptLbldateInOut5'><label for='OUT' style='margin-left:15px;font-size:12px;' class='robotoMedium labelTitle'>SKU</label><input type='text' name='"+skurecord_2+"' id='"+skurecord_2+"' style='margin-left:12px;' class='upperCase infoInputTxt filterDate5'></div><div class='flex inptLbldateInOut6'><label for='OUT' class='robotoMedium labelTitle' style='margin-left:50px;'>TOTAL QTY LEFT</label><input type='text' name='"+total_qty_left_2+"'  id='"+total_qty_left_2+"' class='upperCase infoInputTxt filterDate6' placeholder='' style='cursor:not-allowed;' readonly></div><div class='flex inptLbldateInOut7'><label for='OUT' class='robotoMedium labelTitle'>EDIT BY</label><div class='requiredMsg filterDate7'><input type='text' name='"+enter_2+"' id='"+enter_2+"' class='upperCase infoInputTxt filterDate7' placeholder=''><p class='"+ data_enter_anew+"' style='color: rgb(220, 53, 69); font-size: 10px; margin-top: 3px; margin-left: 2px; display: none;'>* This field is invalid</p></div></div> <div class='minSaveBtn MainfebInMngmntBtn flex' style='justify-content:flex-end;'><input type='button' onclick= '"+ record_deleted +"' class='saveBtn blueBtn btn febInMngmntBtn' value='Cancel' id='"+datarecordnwdelete+"' style='background: #ff000085;margin-left: 1rem;'><input type='button' onclick= '"+ record_created +"' class='saveBtn blueBtn btn febInMngmntBtn' style='margin-left: 1rem;' value='Save' id='"+datarecordnw+"'><a href='javascript:void(0)' id='datanw'  style='height: auto; width: auto; margin: 0;' class='sucsessIconPad editDateinout addDateinout'><i class='fa fa-check-circle' id='"+show_data_n+"' style='display:none; text-align: right; color:#4ab442;'></i><i class='fa fa-times-circle' id='"+err_data_n+"' style='display:none;text-align: right;color:red;'></i></a></div> </div>";       
           
           //var data = "<div class='tblRow' id='"+record_newdataid+"'><div class='tableGrayBox'><div class='maininfoInput9 inputSelectbtn upperCase flex'><div class='flex'><label for='Fabric Code' class='infoInputLabel13 labelTitle'>Date</label><input type='date' class='"+classnw+"' name='"+date+"' id='"+date+"' placeholder='24-OCT-2020'><p class='" + dataerr_date_naewnw+ "' style='color:#dc3545;display:none;'>* This field is invalid</p></div></div><div class='maininfoInput5 inputSelectbtn upperCase flex'><label for='Fabric Code' class='infoInputLabel13 labelTitle'>IN &nbsp;</label><div class='inpuSltBtn flex'><input type='text' class='infoInputTxt upperCase filterDate2' name='"+in_2+"'  id='"+in_2+"' oninput='inchnge();'></div></div><div class='maininfoInput5 inputSelectbtn upperCase flex'><label for='Fabric Code' class='infoInputLabel13 labelTitle'>OUT</label><div class='EinpuSltBtn flex'><input type='text' class='infoInputTxt upperCase infoInput12 inputSltlft' name='"+out_2+"' id='"+out_2+"' oninput='ouchnge();' style='width: 39%;'><p class='errorMsg' id='"+outerr_outerror_out_n+"' style='color:#dc3545;display:none;'>* This field is invalid</p><p class='errorMsg' id='"+lotno1_outerrorstore1_outnew+"' style='display:none;'>* Total quantity must be a valid number less than and equal to quantity in store 1</p><p class='errorMsg' id='"+lotno2_outerrorstore2_out_new+"' style='display:none;'>Total quantity must be a valid number less than and equal to quantity in store 2</p></div></div><div class='maininfoInput5 upperCase flex'><label for='Fabric Code' class='infoInputLabel13 labelTitle'>Store</label><div class='requiredmsg infoInput1 flex flexWrap'><select type='text' name='"+storeqty_2+"' id='"+storeqty_2+"' class='infoInputTxt' placeholder='' onchange='getaldata();'><option value='' selected disabled hidden>Select Store No.</option><option value='1'>Store 1</option><option value='2'>Store 2</option></select><p class='"+ data_storeqty_anew +"' style='color: rgb(220, 53, 69);display: none;'>* This field is invalid</div></div><div class='maininfoInput12 upperCase flex'><label for='Fabric Code' class='infoInputLabel13 labelTitle' style='margin-left:10px;'>SKU</label><div class='requiredmsg infoInput3 flex flexWrap'><input type='text' class='infoInputTxt upperCase completeWidth' placeholder=''  name='"+skurecord_2+"' id='"+skurecord_2+"' ></div></div><div class='maininfoInput12 inputSelectbtn upperCase mRgt0 flex'><label for='Fabric Code' class='infoInputLabel13 labelTitle'>Total Qty Left</label><div class='inpuSltBtn flex'><input type='text' class='infoInputTxt upperCase infoInput12 inputSltlft' type='text' name='"+total_qty_left_2+"' id='"+total_qty_left_2+"'  style='cursor:not-allowed;' readonly></br><div class='flex btmBox'><div class='maininfoInput14  upperCase flex'><label for='Fabric Code' class='infoInputLabel1 labelTitle'>Edit By</label><div class='requiredmsg infoInput10 flex flexWrap'><input type='text' class='infoInputTxt upperCase completeWidth SkuInput' type='text' name='"+enter_2+"' id='"+enter_2+"'><p class='"+ data_enter_anew+"' style='color: rgb(220, 53, 69);  display: none;'>* This field is invalid</p></div><div class='cancelSavBtns flex'><a href='javascript:void(0)' onclick= '"+ record_deleted +"'  class='btn cnlBtn bleedBtn' id='"+datarecordnwdelete+"'>Cancel</a><a href='javascript:void(0)'' onclick= '"+ record_created +"' class='btn bleedBtn' id='"+datarecordnw+"' >Save</a></div> </div>";       






           $("span#showhtml").append(data);

           
           $(".MainfebInMngmntBtn").css("justify-content","flex-end");
           $("#datanw").css("height","auto");
           $("#datanw").css("width","auto");
           $("#datanw").css("margin","0");
           $(".febInMngmntBtn").css("margin-left","1rem");
           $("#date_"+no).attr('readonly', true);
           $("#date_"+no).css("cursor","not-allowed");
           $("#in_"+no).attr('readonly', true);
           $("#in_"+no).css("cursor","not-allowed");


           $("#out_"+no).attr('readonly', true);
           $("#out_"+no).css("cursor","not-allowed");
           $("#storeqty_"+no).attr('readonly', true);
           $("#storeqty_"+no).css("cursor","not-allowed");
           $("#skurecord_"+no).attr('readonly', true);
           $("#skurecord_"+no).css("cursor","not-allowed");
           $("#total_qty_left_"+no).attr('readonly', true);
           $("#total_qty_left_"+no).css("cursor","not-allowed");
           $("#enter_"+no).attr('readonly', true);
           $("#enter_"+no).css("cursor","not-allowed");
           $("#recordCount").val('');
           $("#recordCount").val(count);
        }





     //addedcode_added
       function ouchnge(){
        //console.log($("#recordCount").val());
       var no = parseInt($("#recordCount").val());  
       var storeqty_n = "#storeqty_"+no;
       var storeqty_data = "storeqty_"+no;
       var new_storeqty_data = $('select[name='+storeqty_data+']').val();
       var out_data = '#out_'+no;
       var new_out_data = $(out_data).val();
       $("#lotno2_outerrorstore2_out_"+no).css("display", "none"); 
       $("#outerr_outerror_out_"+no).css("display", "none");
      
       var in_data = '#in_'+no;
       var new_in_data = $(in_data).val(); 
       var total_qty_left = "#total_qty_left_"+no;
       var store1 = parseInt($("#store1").val());
       
       
       if((new_out_data == '') || (new_out_data == null) || isNaN(new_out_data))
       {
           var total_qty_left = "#total_qty_left_"+no;
           $(total_qty_left).val('0');
           console.log(new_out_data);
           $(total_qty_left).val(' ');
           return 1;
       }
       
       if(new_storeqty_data == '1')
       { 
           
             if((new_storeqty_data == '') || (new_storeqty_data == null) || isNaN(new_storeqty_data))
             {
               return 1;
             
                 
             } 
    
             else if((new_out_data != '') || (new_out_data != null))
             {
                 var store1 = parseInt($("#store1").val());
                 
                 if((isNaN(store1)) || (new_out_data > store1) ) 
                    {  
                       $("#lotno2_outerrorstore2_out_"+no).css("display", "block");
                       $("#lotno2_outerrorstore2_out_"+no).css("font-size", "10px");
                       $("#lotno2_outerrorstore2_out_"+no).css("color", "red");
                       $("#lotno2_outerrorstore2_out_"+no).css("padding", "5px 0px");
                       $("#out_"+no).css("border", "1px solid red");
                       $("#outerr_outerror_out_"+no).css("display", "none");
                       return 1;
                    }
                    else if((new_out_data == '') || (new_out_data == null))
                    {  
                       $("#out_"+no).css("border", "1px solid red");
                       $("#outerr_outerror_out_"+no).css("display", "block");
                       return 1;
                    }
                    else
                    {  
                       
                       var total_qty =  parseInt($("#total_qty").val());
                       var neindata = parseInt(new_out_data);
                       var no = parseInt($("#recordCount").val());  
                       var total_qty_left = "#total_qty_left_"+no; 
                       var totalqtydata = total_qty - neindata; 
                       $(total_qty_left).val('');
                       console.log(totalqtydata);
                       $(total_qty_left).val(totalqtydata);
                       $("#out_"+no).css("border", "1px solid #ececec");
                       $("#lotno2_outerrorstore2_out_"+no).css("display", "none"); 
                       $("#outerr_outerror_out_"+no).css("display", "none");
                       $("#nwinerr_inerror_in_"+no).css("display", "none"); 
                       $("#in_"+no).css("border", "1px solid #ececec");
                    
                        
                    }
             
                }
                
                
                else
                {
                    
                   var total_qty_left = "#total_qty_left_"+no;
                   $(total_qty_left).val('0');
                   $("#nwinerr_inerror_in_"+no).css("display", "none"); 
                   $("#in_"+no).css("border", "1px solid #ececec");
                   console.log(new_out_data);
                   $(total_qty_left).val(' ');
                   return 1;
                }
                
                
                
        
           
           
       }
        
        
       console.log(new_storeqty_data);console.log("----------");
       if(new_storeqty_data == '2')
       { 
           
             if((new_storeqty_data == '') || (new_storeqty_data == null) || isNaN(new_storeqty_data))
             {
               return 1;
             
                 
             } 
    
             else if((new_out_data != '') || (new_out_data != null))
             {
                 
                 var store2 = parseInt($("#store2").val());
                 
                 if((isNaN(store2)) || (new_out_data > store2) ) 
                    {  
                       $("#lotno2_outerrorstore2_out_"+no).css("display", "block");
                       $("#lotno2_outerrorstore2_out_"+no).css("font-size", "10px");
                       $("#lotno2_outerrorstore2_out_"+no).css("color", "red");
                       $("#lotno2_outerrorstore2_out_"+no).css("padding", "5px 0px");
                       $("#out_"+no).css("border", "1px solid red");
                       $("#outerr_outerror_out_"+no).css("display", "none");
                       return 1;
                    }
                    else if((new_out_data == '') || (new_out_data == null))
                    {  
                       $("#out_"+no).css("border", "1px solid red");
                       $("#outerr_outerror_out_"+no).css("display", "block");
                       return 1;
                    }
                    else
                    {  
                       
                       var total_qty =  parseInt($("#total_qty").val());
                       var neindata = parseInt(new_out_data);
                       var no = parseInt($("#recordCount").val());  
                       var total_qty_left = "#total_qty_left_"+no; 
                       var totalqtydata = total_qty - neindata; 
                       $(total_qty_left).val('');
                       console.log(totalqtydata);
                       $(total_qty_left).val(totalqtydata);
                       $("#out_"+no).css("border", "1px solid #ececec");
                       $("#lotno2_outerrorstore2_out_"+no).css("display", "none");
                       $("#outerr_outerror_out_"+no).css("display", "none");
                       $("#nwinerr_inerror_in_"+no).css("display", "none");  
                       $("#in_"+no).css("border", "1px solid #ececec"); 
                    
                        
                    }
             
                }
                
                
                else
                {
                    
                   var total_qty_left = "#total_qty_left_"+no;
                   $(total_qty_left).attr('value', '0');
                   $("#nwinerr_inerror_in_"+no).css("display", "none"); 
                   $("#in_"+no).css("border", "1px solid #ececec");
                   console.log(new_out_data);
                   $(total_qty_left).val(' ');
                   return 1;
                }
                
                
                
        } 
       
       
       
      
    }
    
  //addedcodeadded


       function addnewfabricquantity()
       {
           
           var no = parseInt($("#total_fabricqty_count").val());
           var count = no + 1;
           var data_total_fabric_qty_data = "data_total_fabric_qty_data_"+count;
           var fabric_total_width = "data_fabric_width_data_"+count;
           var fabric_total_date = "data_fabric_date_data_"+count;
           var data_fabricWidthunit_data = "data_fabricWidthunit_data_"+count;
           var data_totalQtyunit_data = "data_totalQtyunit_data_"+count;  
           var data_fabric_date_data = "data_fabric_date_data_"+count;

           var data_error_newerrorall = "errorMsg data_error_newerrorall_"+count;
           var dataerror_fabricwidth =  "errorMsg dataerror_fabricwidth_"+count;
           var dataerror_fabricdate = "errorMsg dataerror_fabricdate_"+count;
           var data_total_fabric_qty_data_1_new = "data_total_fabric_qty_data_1_new("+count+")";
          
           //console.log(allnewunitdetail);
           
          var allnewunitdetail = $("#allnewunit").val();  
           //console.log(allnewunitdetail);
           
           var detaildata = "";
           var option_val = "<option value=";
           var calssdata = "class='ttlqtyoption'>";
           var option_close = "</option> ";
           var anaew = "'";
           var anewa = "'";
           
           var data =  "<div class='flex mainInfoInputS inventoryDetails robotoReguler'><div class='flex FebstoreQty upperCase'><div class='febricInventoryTtlQty upperCase flex'><label for='Store 1' class='robotoMedium labelTitle'>Total Qty<sup style='color:red;'>*</sup></label><div class='febricInventinput1 requiredmsg flex'><input type='text' class='infoInputTxt upperCase febricInventoryinput' placeholder=''  name='"+data_total_fabric_qty_data+"'   id='"+data_total_fabric_qty_data+"' oninput='"+ data_total_fabric_qty_data_1_new+"'><select class='infoInputTxt febricInventoryinput febricInventoryselect upperCase' name='"+data_totalQtyunit_data+"' id='"+data_totalQtyunit_data+"' onchange='newdataqtyunit()'><option value='3' class='ttlqtyoption'>in</option> <option value='2' class='ttlqtyoption'>m</option> <option value='1' class='ttlqtyoption'>ft</option> </select> <p class='"+ data_error_newerrorall+"' style='display:none;'>* This feild is invalid</p> <p class='errorMsg data_error_totalqty' style='display:none;'>Total quantity must be a valid number greater than zero unit</p><p class='errorMsg data_error_totalqty_store1' style='display:none;'>Total quantity in store1 will have to be exactly or less than total quantity entered</p><p class='errorMsg data_error_totalqty_store2' style='display:none;'>Total quantity in store2 will have to be exactly or less than total quantity entered</p><p class='errorMsg data_error_totalqty_store12' style='display:none;'>Aggregate quantity in store1 and store2 will have to be exactly or less than total quantity entered</p><p class='errorMsg data_error_totalqty0' style='display:none;'>si unit didn't match with store1 unit</p><p class='errorMsg data_error_totalqty1' style='display:none;'>si unit didn't match with store2 unit</p></div></div><div class='febricInventoryTtlQty upperCase flex'><label for='Store 1' class='robotoMedium labelTitle'>Fabric Width<sup style='color:red;'>*</sup></label><div class='febricInventinput1 requiredmsg flex'><input type='text' class='infoInputTxt upperCase febricInventoryinput' placeholder='' name='"+fabric_total_width+"' id='"+fabric_total_width+"' oninput='fabric_width_datanwerror()'><select class='infoInputTxt febricInventoryinput febricInventoryselect upperCase' name='"+data_fabricWidthunit_data+"' id='"+data_fabricWidthunit_data+"' ><option value='3' class='ttlqtyoption'>in</option><option value='2' class='ttlqtyoption'>m</option><option value='1' class='ttlqtyoption'>ft</option></select><p class='"+ dataerror_fabricwidth +"' style='display:none;'>* This field is invalid</p></div></div><div class='flex inptLbldateInOut1'><label for='date' class='robotoMedium  labelTitle'>Date<sup style='color:red;'>*</sup></label><input type='date' class='upperCase infoInputTxt filterDate1' placeholder='24-OCT-2020' name='"+data_fabric_date_data+"' id='"+data_fabric_date_data+"' oninput='fabric_date_datanwerror()'><p class='"+dataerror_fabricdate+"' style='display:none;''>* This field is invalid</p></div>";
           $("span#showfabricqtyhtml").append(data);
           $("#data_total_fabric_qty_data_"+no).attr('readonly', true);
           $("#data_total_fabric_qty_data_"+no).css("cursor","not-allowed");


           $("#data_fabric_width_data_"+no).attr('readonly', true);
           $("#data_fabric_width_data_"+no).css("cursor","not-allowed");
           $("#data_fabric_date_data_"+no).attr('readonly', true);
           $("#data_fabric_date_data_"+no).css("cursor","not-allowed");
           

           $("#data_fabricWidthunit_data_"+no).attr('readonly', true);
           $("#data_fabricWidthunit_data_"+no).attr('disabled', true);
           $("#data_fabricWidthunit_data_"+no).css("cursor","not-allowed");

           $("#data_totalQtyunit_data_"+no).attr('readonly', true);
           $("#data_totalQtyunit_data_"+no).attr('disabled', true);
           $("#data_totalQtyunit_data_"+no).css("cursor","not-allowed");
           var disableFabricount = parseInt($("#total_disablefabricqty_count").val());
           var totaldisableFabricount = disableFabricount + 1;
           $("#total_disablefabricqty_count").val('');
           $("#total_disablefabricqty_count").val(totaldisableFabricount);
           $("#total_fabricqty_count").val('');
           $("#total_fabricqty_count").val(count);
       
       }

      
       function auth()
       {
        //var baseurl = "http://localhost/code/";
        

        var password = $("#password").val();
       
        var id = $("#id").val();
        var hash = $("#hash").val();
        


        if(password == null || password == "")
        {
           $("span#error_data").css("display","block");
           $("#password").css('border', '1px solid red');
        }
        else
        {   var baseurl = "https://inventory.deebaco.com/index.php/";
            $.ajax({
                  url: baseurl + 'auth',
                  method: 'POST',
                  data: {
                  type: 'auth',password:password,id:id,hash:hash
                 },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        $("span#error_data").css("display","none");
                        $("span#error_hide").css("display","block");
                        $("span#authorize_data").css("display","none");
                        
                        //window.location = mydata.redirect;
                        window.setTimeout(function(){
                            window.location.href = mydata.redirect;

                        }, 500);
                        //toastr.success(mydata.message);
                    }
                    else
                    {    
                        $("span#error_data").css("display","none");
                        $("span#authorize_data").css("display","block");
                        $("span#error_hide").css("display","none");
                        //toastr.error(mydata.message);
                    }
              }
          });
          return false;
        }
     }









     







     function edit_auth()
      {
        //var baseurl = "http://localhost/code/";
        var password = $("#password").val();
        var id = $("#id").val();
        var hash = $("#hash").val();

        if(password == null || password == "")
        {
           $("span#error_data").css("display","block");
           $("#password").css('border', '1px solid red');
        }
        else
        {   var baseurl = "https://inventory.deebaco.com/index.php/";
            $.ajax({
                  url: baseurl + 'edit_auth',
                  method: 'POST',
                  data: {
                  type: 'edit_auth',password:password,id:id,hash:hash
                 },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        $("span#error_data").css("display","none");
                        $("span#error_hide").css("display","block");
                        $("span#authorize_data").css("display","none");
                        
                        //window.location = mydata.redirect;
                        window.setTimeout(function(){
                            window.location.href = mydata.redirect;

                        }, 500);
                        //toastr.success(mydata.message);
                    }
                    else
                    {    
                        $("span#error_data").css("display","none");
                        $("span#authorize_data").css("display","block");
                        $("span#error_hide").css("display","none");
                        //toastr.error(mydata.message);
                    }
              }
          });
          
          return false;
        
        }
     }

      function fabric()
      {     
         //var baseurl = "http://localhost/code/";
         var baseurl = "https://inventory.deebaco.com/index.php/";
         window.location.href = baseurl + 'list-fabric';
      } 

     function filter()
     {
        var filter_data = $('select[name="filter_data"]').val();
        var year_data = $('select[name="year_data"]').val();
     }

     /*function configuration()
     {
         //var baseurl ="http://localhost/code/";
         var admin = "admin";
         window.location.href = baseurl+ admin;

     }*/

     function configuration()
     {   var baseurl = "https://inventory.deebaco.com/index.php/";
         var admin = "configuration";
         window.location.href = baseurl+ admin;

     }
    
     
     function add_data_cvendor_detail_rerender(hash_id)
     {
         var admin = "edit-cvendor-detail/";
         var baseurl = "https://inventory.deebaco.com/index.php/";
         window.location.href = baseurl+ admin+ hash_id;
     }

     function addnewcvendordetail(hash_id)
     {
         var url = "add-cvendor-detail/";
         var baseurl = "https://inventory.deebaco.com/index.php/";
         window.location.href= baseurl + url + hash_id;
     }

     function fetch_all_email_detail(id, hash_id, recordid)
     {  
         var baseurl = "https://inventory.deebaco.com/index.php/";
         var url = "edit_rerender_cvendor_detail/";
         window.location.href = baseurl + url + id + '-'+ recordid;

     }

    






    function newcvendor_info_error()
    {  
       $(".error_cvendor_info").css("display","none");
       $("#swatch_card").css('border', '1px solid #ececec');
       var swatch_card = $("#swatch_card").val();
       if(swatch_card == null || swatch_card.length === 0)  
       {
         
           $(".error_cvendor_info").css("display","block");
           $("#swatch_card").css('border', '1px solid red');
       }
       else if(swatch_card.length > 0)
       {
           $(".error_cvendor_info").css("display","none");
           $("#swatch_card").css('border', '1px solid #ececec');
       } 
    }



    function newcvendor_email_error()
    {  
       $(".error_cvendor_email").css("display","none");
       $(".newcvendoremail").css('border', '1px solid #ececec');
       var newcvendoremail = $(".newcvendoremail").val();  console.log(newcvendoremail.length); 
       if((newcvendoremail == null) || (newcvendoremail.length == 0))  
       {      
           $(".error_cvendor_email").css("display","block");
           $(".newcvendoremail").css('border', '1px solid red');
       }
       else
       {
           $(".error_cvendor_email").css("display","none");
           $(".newcvendoremail").css('border', '1px solid #ececec');
       } 
    }



    





    function newcvendor_contact_error()
    {  
       $(".error_cvendor_contact").css("display","none");
       $(".newcvendorcontact").css('border', '1px solid #ececec');
       var newcvendorcontact = $(".newcvendorcontact").val();
       if(newcvendorcontact == null || newcvendorcontact.length === 0)  
       {
         
           $(".error_cvendor_contact").css("display","block");
           $(".newcvendorcontact").css('border', '1px solid red');
       }
       else if(swatch_card.length > 0)
       {
           $(".error_cvendor_contact").css("display","none");
           $(".newcvendorcontact").css('border', '1px solid #ececec');
       } 
    }



    function newcvendor_address_error()
    { 
       $(".error_cvendor_address").css("display","none");
       $(".newcvendoraddress").css('border', '1px solid #ececec');
       var newcvendoraddress = $(".newcvendoraddress").val();
       if(newcvendoraddress == null || newcvendoraddress.length === 0)  
       {
         
           $(".error_cvendor_address").css("display","block");
           $(".newcvendoraddress").css('border', '1px solid red');
       }
       else if(swatch_card.length > 0)
       {
           $(".error_cvendor_address").css("display","none");
           $(".newcvendoraddress").css('border', '1px solid #ececec');
       } 
    }



    function newcvendor_gstin_error()

    {
       var newcvendorgstin = $(".newcvendorgstin").val();
       if(newcvendorgstin == null || newcvendorgstin.length === 0)  
       {
         
           $(".error_cvendor_gstin").css("display","block");
           $(".newcvendorgstin").css('border', '1px solid red');
       }
       else if(swatch_card.length > 0)
       {
           $(".error_cvendor_gstin").css("display","none");
           $(".newcvendorgstin").css('border', '1px solid #ececec');
       } 
    }





    
    function logout()
    {  




        var baseurl = "https://inventory.deebaco.com/index.php/";
       window.location = baseurl+ "logout";
    }

    function generatedata()
    {  
       var baseurl = "https://inventory.deebaco.com/index.php/";
       window.location = baseurl+ 'generatetoken';
    }



   function userdata()
   {  
      
      var userdata = parseInt($("#userdata").val());
      if(userdata == false)
      {  
         $("#subUseMenu").css("display","block");
         $("#userdata").val('');
         $("#userdata").val('1');
      }
      else

      {
         $("#subUseMenu").css("display","none");
         $("#userdata").val('');
         $("#userdata").val('0');
      }
      
       $(document).on("click", function(event){
        var $trigger = $(".UserMenu");
        if($trigger !== event.target && !$trigger.has(event.target).length){
         $("#subUseMenu").css("display","none");
         $("#userdata").val('');
         $("#userdata").val('0');
        }            
      });
    }

     




     function xyz(formData){
         var settings = {
                          "async": true,
                          "crossDomain": true,
                          "url": "https://www.googleapis.com/oauth2/v4/token",
                          "method": "POST",
                          "headers": {
                            "Content-Type": "application/json"
                          },
                          "processData": false,
                          "data": "{\r\n  \"client_id\": \"599433503635-9g6m6t79ssaus5pi575v0mnblfck7oe4.apps.googleusercontent.com\",\r\n  \"client_secret\": \"hZUW32Du7h98G64Q4HRwexIr\",\r\n  \"refresh_token\": \"1//0gGkjZByfCjBwCgYIARAAGBASNwF-L9IruXaIbAaLWfkMkiFTEtqFnQexe278kZEZD5talGHfhIU2NfRFCoAyhD7NdnSBfuOwXEA\",\r\n  \"grant_type\": \"refresh_token\"\r\n}"
                        }

                    $.ajax(settings).done(function (response) {
                      var newatoken;
                      //console.log(response);
                    
                      newatoken = response.access_token;
                      
                      //console.log(newatoken);
                      file_info_data_newtoken(newatoken, formData)
                    });
     }
     
     
     
     function file_info_data_newtoken(newatoken, formData)
      {
        var accessToken = newatoken;
        
         
        /*var file = $("#file_info")[0].files[0]; 
        var formData = new FormData();
        formData.append("file", file, file.name);
        formData.append("upload_file", true);
        var loader = baseurl+ 'images/loader.gif';
        $("#loaderdata").attr("src", loader);
        $("#loaderdata").css("display","block");*/
    
        $.ajax({
            type: "POST",
            beforeSend: function(request) {
                request.setRequestHeader("Authorization", "Bearer" + " " + accessToken);
                
            },
            url: "https://www.googleapis.com/upload/drive/v2/files",
            data:{
                uploadType:"media"
            },
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                   // console.log("progress");
                }
                return myXhr;
            },
            success: function (data) {
                
                window.setTimeout(function(){
                //console.log(data.thumbnailLink);
                $("#file_info_newdata").val('');
                $("#file_info_newdata").val(data.thumbnailLink);
                var alldata = $("#file_info_newdata").val();
                $("#infosrc").attr("src", alldata);
                $("#loaderdata").attr("src", "");
                $("#loaderdata").css("display","none");
                $(".imgRmveBtn").css("display","block");
                }, 1000);
                

                
            },
            error: function (error) {
                console.log(error);
                $("#loaderdata").attr("src", "");
                $("#loaderdata").css("display","none");
                $(".imgRmveBtn").css("display","none");
                $("#file_info_newdata").val('');
            },
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000
        });
      }

     
     
           function file_info_data()
      {
        var accessToken = "ya29.a0ARrdaM_v5GzFnNkavhetP4CKp2X-G8FNBfNPMgQ7jy1QvnJBI-uARS5yQDfv1akQdQ6vqykWOuugOVdX7rzeC0azaf-gWLDVC5gR5LdgsmfxzphTd0iwCh8tw2iRF51q8fBOyLtSndRnSruPUAclTB1ubNyQ";
        
        var baseurl = "https://inventory.deebaco.com/";
        var file = $("#file_info")[0].files[0]; 
        var formData = new FormData();
        formData.append("file", file, file.name);
        formData.append("upload_file", true);
        var loader = baseurl+ 'images/loader.gif';
        $("#loaderdata").attr("src", loader);
        $("#loaderdata").css("display","block");
    
        $.ajax({
            type: "POST",
            beforeSend: function(request) {
                request.setRequestHeader("Authorization", "Bearer" + " " + accessToken);
                
            },
            url: "https://www.googleapis.com/upload/drive/v2/files",
            data:{
                uploadType:"media"
            },
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                   // console.log("progress");
                }
                return myXhr;
            },
            success: function (data) {
                
                window.setTimeout(function(){
                //console.log(data.thumbnailLink);
                $("#file_info_newdata").val('');
                $("#file_info_newdata").val(data.thumbnailLink);
                var alldata = $("#file_info_newdata").val();
                $("#infosrc").attr("src", alldata);
                $("#loaderdata").attr("src", "");
                $("#loaderdata").css("display","none");
                $(".imgRmveBtn").css("display","block");
                }, 1000);
                

                
            },
            error: function (error) {
                //console.log(error);
                /*$("#loaderdata").attr("src", "");
                $("#loaderdata").css("display","none");
                $(".imgRmveBtn").css("display","none");
                $("#file_info_newdata").val('');*/
                xyz(formData);
            },
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000
        });
      }
     
     
     
          /* function file_info_data()
      {
        var accessToken = "ya29.a0ARrdaM_v5GzFnNkavhetP4CKp2X-G8FNBfNPMgQ7jy1QvnJBI-uARS5yQDfv1akQdQ6vqykWOuugOVdX7rzeC0azaf-gWLDVC5gR5LdgsmfxzphTd0iwCh8tw2iRF51q8fBOyLtSndRnSruPUAclTB1ubNyQ";
        
         
        var file = $("#file_info")[0].files[0]; 
        var formData = new FormData();
        formData.append("file", file, file.name);
        formData.append("upload_file", true);
        var loader = baseurl+ 'images/loader.gif';
        $("#loaderdata").attr("src", loader);
        $("#loaderdata").css("display","block");
    
        $.ajax({
            type: "POST",
            beforeSend: function(request) {
                request.setRequestHeader("Authorization", "Bearer" + " " + accessToken);
                
            },
            url: "https://www.googleapis.com/upload/drive/v2/files",
            data:{
                uploadType:"media"
            },
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                   // console.log("progress");
                }
                return myXhr;
            },
            success: function (data) {
                
                window.setTimeout(function(){
                //console.log(data.thumbnailLink);
                $("#file_info_newdata").val('');
                $("#file_info_newdata").val(data.thumbnailLink);
                var alldata = $("#file_info_newdata").val();
                $("#infosrc").attr("src", alldata);
                $("#loaderdata").attr("src", "");
                $("#loaderdata").css("display","none");
                $(".imgRmveBtn").css("display","block");
                }, 1000);
                

                
            },
            error: function (error) {
                console.log(error);
                $("#loaderdata").attr("src", "");
                $("#loaderdata").css("display","none");
                $(".imgRmveBtn").css("display","none");
                $("#file_info_newdata").val('');
            },
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000
        });
      }*/

     
     function add_inventory_detail_old()
     {
        
        
           
           
           
           
        var alldata = $('form').serialize();
        var total_data = $("#total_fabricqty_count").val(); 
    
        $("#data_total_fabric_qty_data_"+total_data).css('border','1px solid #ececec');
        $(".data_error_newerrorall_"+total_data).css("display", "none");

        $("#data_fabric_width_data_"+total_data).css('border','1px solid #ececec');
        $(".dataerror_fabricwidth_"+total_data).css("display", "none");

        $("#data_fabric_date_data_"+total_data).css('border','1px solid #ececec');
        $(".dataerror_fabricdate_"+total_data).css("display", "none");
      

        //add error total qty
        var data_total_fabric_qty_data = $("#data_total_fabric_qty_data_"+total_data).val();
        var data_fabric_width_data = $("#data_fabric_width_data_"+total_data).val();
        var data_fabric_date_data = $("#data_fabric_date_data_"+total_data).val();

        if(((data_total_fabric_qty_data.length == 0) || (data_fabric_date_data == 'null')) &&  ((data_fabric_date_data.length == 0) || (data_total_fabric_qty_data == 'null'))  && ((data_fabric_width_data.length == 0) || (data_fabric_width_data == 'null')))
        {
             $("#data_total_fabric_qty_data_"+total_data).css("border","1px solid red");
             $(".data_error_newerrorall_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
             $("#data_fabric_width_data_"+total_data).css("border","1px solid red");
             $(".dataerror_fabricwidth_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
             $("#data_fabric_date_data_"+total_data).css("border","1px solid red");
             $(".dataerror_fabricdate_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '59px' });
             $(".inptLbldateInOut1").css("flex-wrap", "wrap")
             return true;
        }

        if(((data_total_fabric_qty_data.length == 0) || (data_total_fabric_qty_data == 'null')) &&  ((data_fabric_width_data.length == 0) || (data_fabric_width_data == 'null')))
        {
             $("#data_total_fabric_qty_data_"+total_data).css("border","1px solid red");
             $(".data_error_newerrorall_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
             //$("#data_total_fabric_qty_data_"+total_data).css("border","1px solid red");
             //$(".data_error_newerrorall_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
             $("#data_fabric_width_data_"+total_data).css("border","1px solid red");
             $(".dataerror_fabricwidth_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
             return true;
        }


        if(((data_total_fabric_qty_data.length == 0) || (data_total_fabric_qty_data == 'null'))  && ((data_fabric_date_data.length == 0) || (data_fabric_date_data == 'null')))
        {
             $("#data_total_fabric_qty_data_"+total_data).css("border","1px solid red");
             $(".data_error_newerrorall_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
             $("#data_fabric_date_data_"+total_data).css("border","1px solid red");
             $(".dataerror_fabricdate_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '59px' });
             $(".inptLbldateInOut1").css("flex-wrap", "wrap")
             return true;
        }
        





        if(((data_fabric_date_data.length == 0) || (data_fabric_date_data == 'null'))  && ((data_fabric_width_data.length == 0) || (data_fabric_width_data == 'null')))
        {
             $("#data_fabric_width_data_"+total_data).css("border","1px solid red");
             $(".dataerror_fabricwidth_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
             $("#data_fabric_date_data_"+total_data).css("border","1px solid red");
             $(".dataerror_fabricdate_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '59px' });
             $(".inptLbldateInOut1").css("flex-wrap", "wrap")
             return true;
        }

        if((data_total_fabric_qty_data.length == 0) || (data_total_fabric_qty_data == 'null'))
        {
             $("#data_total_fabric_qty_data_"+total_data).css("border","1px solid red");
             $(".data_error_newerrorall_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
             return true;
        }

        //add error fabric width
        if((data_fabric_width_data.length == 0) || (data_fabric_width_data == 'null'))
        {
             $("#data_fabric_width_data_"+total_data).css("border","1px solid red");
             $(".dataerror_fabricwidth_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
             return true;

        }
     
       //add error fabric date
       
       if((data_fabric_date_data.length == 0) || (data_fabric_date_data == 'null'))
       {
             $("#data_fabric_date_data_"+total_data).css("border","1px solid red");
             $(".dataerror_fabricdate_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '59px' });
             $(".inptLbldateInOut1").css("flex-wrap", "wrap")
             return true;
       } 
       
       
       
       
       var no = parseInt($("#recordCount").val()); 
       
      if(no !=  1){
           
           var data_date_n = ".data_date_"+no;
           var dataerr_date= ".dataerr_date_"+no;
           $(dataerr_date).css("display","none");
           $(data_date_n).css('border', '1px solid #ececec');  
           
           var storeqty_n = "#storeqty_"+no;
           var data_storeqty= ".data_storeqty_"+no;
           $(data_storeqty).css("display","none");
           $(storeqty_n).css('border', '1px solid #ececec');  
           
           
           var enter_n = "#enter_"+no;
           var data_enter= ".data_enter_"+no;
           $(data_enter).css("display","none");
           $(enter_n).css('border', '1px solid #ececec');   
           
           
           var dataerror_fabricdate_old = $(data_date_n).val();    
           var data_storeqty_old = $(storeqty_n).val();  
           var data_enter_old = $(enter_n).val();    
           
           
           
           
           
           
           
           
           
           if((dataerror_fabricdate_old == null || dataerror_fabricdate_old == "" ) && (data_storeqty_old == null || data_storeqty_old == "" )  && (data_enter_old == null || data_enter_old == "" ))
           {
             $(dataerr_date).css("display","block");
             $(data_date_n).css('border', '1px solid red');   
             $(data_date_n).css('border-radius', '5px');
             
             $(data_storeqty).css("display","block");
             $(storeqty_n).css('border', '1px solid red');   
             $(storeqty_n).css('border-radius', '5px');
             
             
             $(data_enter).css("display","block");
             $(enter_n).css('border', '1px solid red');   
             $(enter_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(dataerr_date).css("display","none");
             $(data_date_n).css('border', '1px solid #ececec'); 
             $(data_storeqty).css("display","none");
             $(storeqty_n).css('border', '1px solid #ececec'); 
             $(data_enter).css("display","none");
             $(enter_n).css('border', '1px solid #ececec');   
           }
           
           
           
            if((data_storeqty_old == null || data_storeqty_old == "" )  && (data_enter_old == null || data_enter_old == "" ))
           {
            
             
             $(data_storeqty).css("display","block");
             $(storeqty_n).css('border', '1px solid red');   
             $(storeqty_n).css('border-radius', '5px');
             
             
             $(data_enter).css("display","block");
             $(enter_n).css('border', '1px solid red');   
             $(enter_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             
             $(data_storeqty).css("display","none");
             $(storeqty_n).css('border', '1px solid #ececec'); 
             $(data_enter).css("display","none");
             $(enter_n).css('border', '1px solid #ececec');   
           }
           
           
            if((dataerror_fabricdate_old == null || dataerror_fabricdate_old == "" )  && (data_enter_old == null || data_enter_old == "" ))
           {
             $(dataerr_date).css("display","block");
             $(data_date_n).css('border', '1px solid red');   
             $(data_date_n).css('border-radius', '5px');
             
            
             
             $(data_enter).css("display","block");
             $(enter_n).css('border', '1px solid red');   
             $(enter_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(dataerr_date).css("display","none");
             $(data_date_n).css('border', '1px solid #ececec'); 
             
             $(data_enter).css("display","none");
             $(enter_n).css('border', '1px solid #ececec');   
           }
           
           
           
           
           if(dataerror_fabricdate_old == null || dataerror_fabricdate_old == "" )
           {
             $(dataerr_date).css("display","block");
             $(data_date_n).css('border', '1px solid red');   
             $(data_date_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(dataerr_date).css("display","none");
             $(data_date_n).css('border', '1px solid #ececec');   
           }
           
           
           
           
           if(data_storeqty_old == null || data_storeqty_old == "" )
           {
             $(data_storeqty).css("display","block");
             $(storeqty_n).css('border', '1px solid red');   
             $(storeqty_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(data_storeqty).css("display","none");
             $(storeqty_n).css('border', '1px solid #ececec');   
           }
           
           
           
           
           
           if(data_enter_old == null || data_enter_old == "" )
           {
             $(data_enter).css("display","block");
             $(enter_n).css('border', '1px solid red');   
             $(enter_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(data_enter).css("display","none");
             $(enter_n).css('border', '1px solid #ececec');   
           }
       
        
       }
         var baseurl = "https://inventory.deebaco.com/index.php/";
         $.ajax({
            url: baseurl + 'add-inventory-detail',
            method: 'POST',
            data:alldata,
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        window.location.replace(baseurl + mydata.redirect);
                        //window.location = mydata.redirect;
                    }
                   


                    else
                    {    
                        //toastr.error(mydata.message);
                    }
            }
        });
     }

     


     function change_edit_inventory_detail()
     {
        
        var no = parseInt($("#recordCount").val()); 
           
        var alldata = $('form').serialize();
        var total_data = $("#total_fabricqty_count").val(); 
    
         var baseurl = "https://inventory.deebaco.com/index.php/";
         $.ajax({
            url: baseurl + 'change_inventory_detail',
            method: 'POST',
            data:alldata,
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        window.location.replace(baseurl + mydata.redirect);
                        //window.location = mydata.redirect;
                    }
                   


                    else
                    {    
                        //toastr.error(mydata.message);
                    }
            }
        });
     }



     function fabric_width_datanwerror()
     { 
       var total_data = $("#total_fabricqty_count").val();
       $(".dataerror_fabricwidth_"+total_data).css('display','none'); 
       $("#data_fabric_width_data_"+total_data).css('border','1px solid #ececec');
       var data_fabric_width_data = $("#data_fabric_width_data_"+total_data).val();
        if((data_fabric_width_data.length == 0) || (data_fabric_width_data == 'null'))
        {
             $("#data_fabric_width_data_"+total_data).css("border","1px solid red");
             $(".dataerror_fabricwidth_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
        
        }
        else
        
        {
             $(".dataerror_fabricwidth_"+total_data).css('display','none'); 
             $("#data_fabric_width_data_"+total_data).css('border','1px solid #ececec');          
        }
     }


     

     function fabric_date_datanwerror()
     { 
       var total_data = $("#total_fabricqty_count").val();
       $("#data_fabric_date_data_"+total_data).css('border','1px solid #ececec');
       $(".dataerror_fabricdate_"+total_data).css("display", "none");
       var data_fabric_date_data = $("#data_fabric_date_data_"+total_data).val();
       if((data_fabric_date_data.length == 0) || (data_fabric_date_data == 'null'))
       {
             $("#data_fabric_date_data_"+total_data).css("border","1px solid red");
             $(".dataerror_fabricdate_"+total_data).css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '59px' });
             $(".inptLbldateInOut1").css("flex-wrap", "wrap")
       }
       else
       {
             $("#data_fabric_date_data_"+total_data).css('border','1px solid #ececec');
             $(".dataerror_fabricdate_"+total_data).css("display", "none");
       }
     }










      




      function cvendor_detail()
      {  
         var alldata = $('form').serialize();
         $("#swatch_card").css('border','1px solid #ececec');
         $(".error_cvendor_info").css("display", "none");
         $("#email").css('border','1px solid #ececec');
         $(".error_cvendor_email").css("display", "none");
         $("#contact_no").css('border','1px solid #ececec');
         $(".error_cvendor_contact").css("display", "none");
         $("#address").css('border','1px solid #ececec');
         $(".error_cvendor_address").css("display", "none");
         var swatch_card = $("#swatch_card").val();
         var email = $("#email").val();
         var contact_no = $("#contact_no").val();
         var address = $("#address").val();

         if(((swatch_card.length == 0) || (swatch_card == 'null')) && ((email.length == 0) || (email == 'null'))  && ((contact_no.length == 0) || (contact_no == 'null'))  && ((address.length == 0) || (address == 'null')))
         {
             $("#swatch_card").css("border","1px solid red");
             $(".error_cvendor_info").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '115px' });
             $("#email").css("border","1px solid red");
             $(".error_cvendor_email").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '54px' });
             $("#contact_no").css("border","1px solid red");
             $(".error_cvendor_contact").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '97px' });
             $("#address").css("border","1px solid red"); 
             $(".error_cvendor_address").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '70px' });
             return true;
         }

         if((swatch_card.length == 0) || (swatch_card == 'null'))
         {
             $("#swatch_card").css("border","1px solid red");
             $(".error_cvendor_info").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '115px' });
             return true;
         }  

         
         if(((email.length == 0) || (email == 'null'))   && ((contact_no.length == 0) || (contact_no == 'null')) && ((address.length == 0) || (address == 'null')) )
         {
             $("#email").css("border","1px solid red");
             $(".error_cvendor_email").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '54px' });
             $("#contact_no").css("border","1px solid red");
             $(".error_cvendor_contact").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '97px' });
             $("#address").css("border","1px solid red"); 
             $(".error_cvendor_address").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '70px' });
             return true;
         }




         



         if((email.length == 0) || (email == 'null'))
         {
             $("#email").css("border","1px solid red");
             $(".error_cvendor_email").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '54px' });
             return true;
         }  
         
         if((contact_no.length == 0) || (contact_no == 'null') && ((address.length == 0) || (address == 'null')))
         {
            $("#contact_no").css("border","1px solid red");
            $(".error_cvendor_contact").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '97px' });
            $("#address").css("border","1px solid red"); 
            $(".error_cvendor_address").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '70px' });
            return true;
         }
         if((contact_no.length == 0) || (contact_no == 'null'))
         {
             $("#contact_no").css("border","1px solid red");
             $(".error_cvendor_contact").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '97px' });
             return true;    
         }  

    
         if((address.length == 0) || (address == 'null'))
         {
             $("#address").css("border","1px solid red"); 
             $(".error_cvendor_address").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '70px' });
             return true;
         }  
         var baseurl = "https://inventory.deebaco.com/index.php/";
         $.ajax({
            url: baseurl + 'add-detail',
            method: 'POST',
            data:alldata,
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        window.location.replace(baseurl + mydata.redirect);
                        //window.location = mydata.redirect;
                    }
                   


                    else
                    {    
                        //toastr.error(mydata.message);
                    }
            }
        });
      }  


       function vendorlist_redirec(url)
    {
        //var baseurl = '<?php echo base_url(); ?>';
        var baseurl = "https://inventory.deebaco.com/index.php/";
        var urlnew = baseurl + "add-new-cvendor/"+url;
        window.location.replace(urlnew);
    }


      function edit_cvendor_detail()
      {  
         var alldata = $('form').serialize();
         $("#swatch_card").css('border','1px solid #ececec');
         $(".error_cvendor_info").css("display", "none");
         $("#email").css('border','1px solid #ececec');
         $(".error_cvendor_email").css("display", "none");
         $("#contact_no").css('border','1px solid #ececec');
         $(".error_cvendor_contact").css("display", "none");
         $("#address").css('border','1px solid #ececec');
         $(".error_cvendor_address").css("display", "none");
         var swatch_card = $("#swatch_card").val();
         var email = $("#email").val();
         var contact_no = $("#contact_no").val();
         var address = $("#address").val();

         if(((swatch_card.length == 0) || (swatch_card == 'null')) && ((email.length == 0) || (email == 'null'))  && ((contact_no.length == 0) || (contact_no == 'null'))  && ((address.length == 0) || (address == 'null')))
         {
             $("#swatch_card").css("border","1px solid red");
             $(".error_cvendor_info").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '115px' });
             $("#email").css("border","1px solid red");
             $(".error_cvendor_email").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '54px' });
             $("#contact_no").css("border","1px solid red");
             $(".error_cvendor_contact").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '97px' });
             $("#address").css("border","1px solid red"); 
             $(".error_cvendor_address").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '70px' });
             return true;
         }

         if((swatch_card.length == 0) || (swatch_card == 'null'))
         {
             $("#swatch_card").css("border","1px solid red");
             $(".error_cvendor_info").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '115px' });
             return true;
         }  

         
         if(((email.length == 0) || (email == 'null'))   && ((contact_no.length == 0) || (contact_no == 'null')) && ((address.length == 0) || (address == 'null')) )
         {
             $("#email").css("border","1px solid red");
             $(".error_cvendor_email").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '54px' });
             $("#contact_no").css("border","1px solid red");
             $(".error_cvendor_contact").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '97px' });
             $("#address").css("border","1px solid red"); 
             $(".error_cvendor_address").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '70px' });
             return true;
         }




         



         if((email.length == 0) || (email == 'null'))
         {
             $("#email").css("border","1px solid red");
             $(".error_cvendor_email").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '54px' });
             return true;
         }  
         
         if((contact_no.length == 0) || (contact_no == 'null') && ((address.length == 0) || (address == 'null')))
         {
            $("#contact_no").css("border","1px solid red");
            $(".error_cvendor_contact").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '97px' });
            $("#address").css("border","1px solid red"); 
            $(".error_cvendor_address").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '70px' });
            return true;
         }
         if((contact_no.length == 0) || (contact_no == 'null'))
         {
             $("#contact_no").css("border","1px solid red");
             $(".error_cvendor_contact").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '97px' });
             return true;    
         }  

    
         if((address.length == 0) || (address == 'null'))
         {
             $("#address").css("border","1px solid red"); 
             $(".error_cvendor_address").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0', 'margin-left' : '70px' });
             return true;
         }  
        



         var baseurl = "https://inventory.deebaco.com/index.php/";
         $.ajax({
            url: baseurl + 'change_cvendor_detail',
            method: 'POST',
            data:alldata,
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        window.location.replace(baseurl + mydata.redirect);
                        //window.location = mydata.redirect;
                    }
                   


                    else
                    {    
                        //toastr.error(mydata.message);
                    }
            }
        });
      

      } 











      function record_created(x)
    {
       
        var no = parseInt($("#recordCount").val());
       
        
        //outerr_outerror_out_1  //total_qty_left_1
        var data_date_n = ".data_date_"+no;  //alert(data_date_n);
        var dataerr_date= ".dataerr_date_"+no;
        $(dataerr_date).css("display","none");
        $(data_date_n).css('border', '1px solid #ececec');  
           
        var storeqty_n = "#storeqty_"+no;
        var data_storeqty= ".data_storeqty_"+no;
        $(data_storeqty).css("display","none");
        $(storeqty_n).css('border', '1px solid #ececec');  
           
           
        var enter_n = "#enter_"+no;
        var data_enter= ".data_enter_"+no;
        $(data_enter).css("display","none");
        $(enter_n).css('border', '1px solid #ececec');   
           
           
        var dataerror_fabricdate_old = $(data_date_n).val();    
        var data_storeqty_old = $(storeqty_n).val();  
        var data_enter_old = $(enter_n).val(); 
   
    
        if((dataerror_fabricdate_old == null || dataerror_fabricdate_old == "" ) && (data_storeqty_old == null || data_storeqty_old == "" )  && (data_enter_old == null || data_enter_old == "" ))
           {
             $(dataerr_date).css("display","block");
             $(data_date_n).css('border', '1px solid red');   
             $(data_date_n).css('border-radius', '5px');
             
             $(data_storeqty).css("display","block");
             $(storeqty_n).css('border', '1px solid red');   
             $(storeqty_n).css('border-radius', '5px');
             
             
             $(data_enter).css("display","block");
             $(enter_n).css('border', '1px solid red');   
             $(enter_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(dataerr_date).css("display","none");
             $(data_date_n).css('border', '1px solid #ececec'); 
             $(data_storeqty).css("display","none");
             $(storeqty_n).css('border', '1px solid #ececec'); 
             $(data_enter).css("display","none");
             $(enter_n).css('border', '1px solid #ececec');   
           }
           
           
           
            if((data_storeqty_old == null || data_storeqty_old == "" )  && (data_enter_old == null || data_enter_old == "" ))
           {
            
             
             $(data_storeqty).css("display","block");
             $(storeqty_n).css('border', '1px solid red');   
             $(storeqty_n).css('border-radius', '5px');
             
             
             $(data_enter).css("display","block");
             $(enter_n).css('border', '1px solid red');   
             $(enter_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             
             $(data_storeqty).css("display","none");
             $(storeqty_n).css('border', '1px solid #ececec'); 
             $(data_enter).css("display","none");
             $(enter_n).css('border', '1px solid #ececec');   
           }
           
           
            if((dataerror_fabricdate_old == null || dataerror_fabricdate_old == "" )  && (data_enter_old == null || data_enter_old == "" ))
           {
             $(dataerr_date).css("display","block");
             $(data_date_n).css('border', '1px solid red');   
             $(data_date_n).css('border-radius', '5px');
             
            
             
             $(data_enter).css("display","block");
             $(enter_n).css('border', '1px solid red');   
             $(enter_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(dataerr_date).css("display","none");
             $(data_date_n).css('border', '1px solid #ececec'); 
             
             $(data_enter).css("display","none");
             $(enter_n).css('border', '1px solid #ececec');   
           }
           
           
           
           
           if(dataerror_fabricdate_old == null || dataerror_fabricdate_old == "" )
           {
             $(dataerr_date).css("display","block");
             $(data_date_n).css('border', '1px solid red');   
             $(data_date_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(dataerr_date).css("display","none");
             $(data_date_n).css('border', '1px solid #ececec');   
           }
           
           
           
           
           if(data_storeqty_old == null || data_storeqty_old == "" )
           {
             $(data_storeqty).css("display","block");
             $(storeqty_n).css('border', '1px solid red');   
             $(storeqty_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(data_storeqty).css("display","none");
             $(storeqty_n).css('border', '1px solid #ececec');   
           }
           
           if(data_enter_old == null || data_enter_old == "" )
           {
             $(data_enter).css("display","block");
             $(enter_n).css('border', '1px solid red');   
             $(enter_n).css('border-radius', '5px');
             return true;
           }
           else 
           {
             $(data_enter).css("display","none");
             $(enter_n).css('border', '1px solid #ececec');   
           }
    

        var date_data = '#date_'+no;
        var in_data = '#in_'+no;
        var out_data = '#out_'+no;
        var storeqty_data = "storeqty_"+no;
        var skurecord_data = "#skurecord_"+no;
        var total_qty_left = "#total_qty_left_"+no;
        var enter = "#enter_"+no;

        var new_date_data = $(date_data).val();
        var new_in_data = $(in_data).val();
        var new_out_data = $(out_data).val();
        var new_storeqty_data = $('select[name='+storeqty_data+']').val();
        var new_skurecord_data = $(skurecord_data).val();
        var new_total_qty_left = $(total_qty_left).val();
        var new_enter = $(enter).val();
        //var baseurl = 'http://inventory.ssrtechvision.com/';
        var baseurl = "https://inventory.deebaco.com/index.php/";
        console.log(baseurl);
        var fabric_id = $("#idnew").val();
        //alert(fabric_id);
        naew(new_date_data,new_in_data,new_out_data,new_storeqty_data,new_skurecord_data,new_total_qty_left,new_enter,fabric_id,no);
}







  




function naew(new_date_data,new_in_data,new_out_data,new_storeqty_data,new_skurecord_data,new_total_qty_left,new_enter,fabric_id,no)
{   
   
    var store1 = parseInt($("#store1").val()); 
    var store2 = parseInt($("#store2").val());   
    
    
    var fabric_id = $('#fabric_codeid').val(); 
    
       var totalqtydata;
       var newstore1;
       var newstore2;
       var storedata;
       
       var newtotal_quantity;
       
       var alqty;
       
      
       
       
       
       if(new_in_data)
       {
          if((new_in_data) && (new_storeqty_data == '1'))
          {
           var total_qty =  parseInt($("#total_qty_left_"+no).val()); 
           totalqtydata = total_qty;  
           storedata = 1;
           
           var nwin_data = parseInt(new_in_data); 
           newstore1 = store1 + nwin_data; 
           $("#store1").val(newstore1);
           newtotal_quantity = totalqtydata; 
           alqty =  totalqtydata;
           //$("#qtystoredata").val(totalqtydata);
          }
          
         
         
         
         
         
         if(((new_in_data)) && (new_storeqty_data == '2'))
         {
           var total_qty =  parseInt($("#total_qty_left_"+no).val()); 
           totalqtydata = total_qty;  
           storedata = 2;
           
           
           var nwin_data = parseInt(new_in_data); 
           newstore2 = store2 + nwin_data;
           $("#store2").val(newstore2);
          
           newtotal_quantity = totalqtydata; 
           alqty =  totalqtydata;  
           //$("#qtystoredata").val(totalqtydata);
         }
       }
       
       
       
       
       
       
       
       if(new_out_data)
       {
         if((new_out_data) && (new_storeqty_data == '1'))
         {
           var total_qty =  parseInt($("#total_qty_left_"+no).val()); 
           totalqtydata = total_qty;
           storedata = 1
           
           var newaout_data = parseInt(new_out_data); 
           newstore1 = (store1 - newaout_data);  
           newtotal_quantity = totalqtydata;
           $("#store1").val(newstore1);
           
           
           alqty =  totalqtydata; 
           //$("#qtystoredata").val(totalqtydata)
        }
        
        
        
        
        
        
        if((new_out_data) && (new_storeqty_data == '2'))
        {
           var total_qty =  parseInt($("#total_qty_left_"+no).val());
           totalqtydata = total_qty;
           storedata = 2
           
           
           var newaout_data = parseInt(new_out_data); 
           newstore2 = store2 - newaout_data;
           newtotal_quantity = totalqtydata;
           $("#store2").val(newstore2);
           
           
           
           
           alqty =  totalqtydata; 
           //$("#qtystoredata").val(totalqtydata)
        }
      }
       
       
       
      
      
       
       
      
      
      
      
      
      
    var fabricpurchaseid = $('#fabricpurchaseid').val();
    var nodata = no + 1; 
    //var baseurl ='http://localhost/inventory/';
    //var baseurl = 'http://inventory.ssrtechvision.com/';

    var baseurl = "https://inventory.deebaco.com/index.php/";
    $.ajax({
            url: baseurl + 'add-inventory-detail-record', 
            method: 'POST',
            data: {
                new_date_data: new_date_data,
                new_in_data: new_in_data,
                new_out_data: new_out_data,
                new_storeqty_data: new_storeqty_data,
                new_skurecord_data: new_skurecord_data,
                new_total_qty_left: totalqtydata,
                new_enter: new_enter,
                no:no,
                fabric_id:fabric_id,
                fabricpurchaseid:fabricpurchaseid,
                store1:store1,
                total_quantity:newtotal_quantity,
                storedata:storedata,
                store2:store2
                },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {     
                          
                           
                           
                           
                    
                         
                          var z = no.toString();
                          
                          //qtystoredata(z);
                          
                          $("#total_qty").val(alqty);
                          //$("#data_total_fabric_qty_data_1").val(alqty);  
                          $("#datarecordnw_"+no).css("display","none");
                          $("#datarecordnwdelete_"+no).css("display","none");
                          
                          
                          $("#show_data_"+no).css("display","block");
                          $("#show_data_"+no).css("font-size", "2rem");
                          $(".minSaveBtn").css("justify-content","flex-end");
                          $("#date_"+no).attr("readonly", true);
                          $("#date_"+no).css("cursor","not-allowed");
                          $("#in_"+no).attr("readonly", true);
                          $("#in_"+no).css("cursor","not-allowed");
                          $("#out_"+no).attr("readonly", true);
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          $("#out_"+no).css("cursor","not-allowed"); 
                          $("#out_"+no).css("border","1px solid #ececec"); 
                          $("#lotno1_outerrorstore1_out_"+no).css("display","none");
                          $("#lotno2_outerrorstore2_out_"+no).css("display","none");
                          $("#storeqty_"+no).attr("readonly", true);
                          $("#storeqty_"+no).css("cursor","not-allowed");
                          $("#storeqty_"+no).css("disabled",true);
                          $("#skurecord_"+no).attr("readonly", true);
                          $("#skurecord_"+no).css("cursor","not-allowed");
                          $("#total_qty_left_"+no).attr("readonly", true);
                          $("#total_qty_left_"+no).css("cursor","not-allowed");
                          $("#enter_"+no).attr("readonly", true);
                          $("#enter_"+no).css("cursor","not-allowed");
                          $("#recordCount").val(nodata); 
                          

                    
                    }
                   

                    else
                    {    
                         $("#datarecordnw_"+no).css("display","block");
                         $("#err_data_"+no).css("display","block");
                         $("#err_data_"+no).css("font-size", "2rem");
                         $(".minSaveBtn").css("justify-content","flex-end");
                    } }
          });
       return false;
}





















function record_deleted(x)
{  
    if(x != 1){
    var myobj = document.getElementById("FullDateYear_"+x);
    myobj.remove();  
    var newdata = x-1;
    $("#recordCount").val(newdata);
    }
}

 function getaldata(){
     
       var no = parseInt($("#recordCount").val());  //alert(no); 
       var storeqty_n = "#storeqty_"+no;
      
       var in_data = '#in_'+no;
       var out_data = '#out_'+no;
       
       var new_in_data = $(in_data).val();
       var new_out_data = $(out_data).val();
       
       var storeqty_data = "storeqty_"+no;
       var new_storeqty_data = $('select[name='+storeqty_data+']').val();
       var total_qty_left = "#total_qty_left_"+no;
       //var new_total_qty_left = $(total_qty_left).val();
       var store1 = parseInt($("#store1").val());
       
       
       
       if(new_storeqty_data == 1)
       { 
        if((isNaN(store1)) /*|| (new_in_data > store1)*/ ) 
        {  
           $("#lotno1_outerrorstore1_out_"+no).css("display", "block");
           $("#lotno1_outerrorstore1_out_"+no).css("font-size", "10px");
           $("#lotno1_outerrorstore1_out_"+no).css("color", "red");
           $("#lotno1_outerrorstore1_out_"+no).css("padding", "5px 0px");
           $("#in_"+no).css("border", "1px solid red");
           $("#nwinerr_inerror_in_"+no).css("display", "none");
           return 1;
        }
        else if((new_in_data == '') || (new_in_data == null) || (isNaN(new_in_data)) )
        { 
           $("#in_"+no).css("border", "1px solid red");
           $("#nwinerr_inerror_in_"+no).css("display", "block");
           return 1;
        }
        else
        {


            var total_qty =  parseInt($("#total_qty").val());
            var indata = parseInt(new_in_data);
            
            var totalqtydata = indata + total_qty; 
            $(total_qty_left).val('');
            $(total_qty_left).val(totalqtydata);
           $("#in_"+no).css("border", "1px solid #ececec");
           $("#lotno1_outerrorstore1_out_"+no).css("display", "none");
           $("#nwinerr_inerror_in_"+no).css("display", "none");
        }
       } 
       
       
       
       
       
       
       
       
       
       
       
       
       
    var store2 = parseInt($("#store2").val());
   
    if(new_storeqty_data == 2)
    {
        if((isNaN(store2))/* || (new_out_data > store2)*/ ) 
        {  
           $("#lotno2_outerrorstore2_out_"+no).css("display", "block");
           $("#lotno2_outerrorstore2_out_"+no).css("font-size", "10px");
           $("#lotno2_outerrorstore2_out_"+no).css("color", "red");
           $("#lotno2_outerrorstore2_out_"+no).css("padding", "5px 0px");
           $("#out_"+no).css("border", "1px solid red");
           $("#outerr_outerror_out_"+no).css("display", "none");
           return 1;
        }
        else if((new_out_data == '') || (new_out_data == null))
        { 
           $("#out_"+no).css("border", "1px solid red");
           $("#outerr_outerror_out_"+no).css("display", "block");
           return 1;
        }
        else
        
        {  
           
           var total_qty =  parseInt($("#total_qty").val());
           var neindata = parseInt(new_out_data);
            
           var totalqtydata = total_qty - neindata; 
           $(total_qty_left).val('');
           $(total_qty_left).val(totalqtydata);
           $("#out_"+no).css("border", "1px solid #ececec");
           $("#lotno1_outerrorstore1_out_"+no).css("display", "none");
           $("#outerr_outerror_out_"+no).css("display", "none");
        }
    }
    }  

    //-----------------commented_code_inventory-----------------------------------//
    function inventory_redirectbasic(hash_id)
    {   var baseurl = "https://inventory.deebaco.com/index.php/";
        window.location = baseurl + 'add-fabric-basic-info/'+hash_id;
    }

    function inventory_redirectbasicread(hash_id)
    {   var baseurl = "https://inventory.deebaco.com/index.php/";
        window.location = baseurl + 'add-fabric-basic-info-read/'+hash_id;
    }

    function nwinventory(hash_id, id)
    {   var baseurl = "https://inventory.deebaco.com/index.php/";
        window.location = baseurl + 'edit_rerender_inventory_detail/'+hash_id+'/'+id;  
    }

    function add_inventory_detail()
    {
       // alert("hii");
           $(".data_error_newerrorall_1").css("display", "none");
           $("#data_total_fabric_qty_data_1").css("border", "1px solid #ececec");
           $(".dataerror_fabricwidth").css("display", "none");
           $("#data_fabric_width_data_1").css("border", "1px solid #ececec");
           $(".dataerror_fabricdate_1").css("display", "none");
           $("#data_fabric_date_data_1").css("border", "1px solid #ececec");
           
           
       var defect_type = $("#defect_type").val();
       var defect_qty = $("#defect_qty").val();  
       var defect_qty_unit = $('select[name="defect_qty_unit"]').val(); 
       var defect_remarks = $("#defect_remarks").val();
       
       var with_water_response = $("#with_water_response").val();
       var with_soap_response = $("#with_soap_response").val();
       var colorbleed_comments = $("#colorbleed_comments").val();
       
       var shrinkage_before_test_h = $("#shrinkage_before_test_h").val(); 
       var shrinkage_before_test_w = $("#shrinkage_before_test_w").val();
       var shrinkage_fabric_code_h = $("#shrinkage_fabric_code_h").val();
       var shrinkage_fabric_code_w = $("#shrinkage_fabric_code_w").val();
       var shrinkage_comments = $("#shrinkage_comments").val();
       
       var return_qty = $("#return_qty").val();
       var return_qty_unit = $('select[name="retnqtyunit1"]').val(); 
       var return_date = $("#return_date").val();
       var return_reason = $("#return_reason").val();

       var total_qty = $("#data_total_fabric_qty_data_1").val();      
       var total_qty_unit = $('select[name="data_totalQtyunit_data_1"]').val();
       var fabric_width = $("#data_fabric_width_data_1").val();
       var fabric_width_unit = $('select[name="data_fabricWidthunit_data_1"]').val();
       var data_fabric_date_data_1 = $("#data_fabric_date_data_1").val();  
       
       
       
       
       if(((total_qty == '') || (total_qty == null)) &&  ((fabric_width == '') || (fabric_width == null))  && ((data_fabric_date_data_1 == '') || (data_fabric_date_data_1 == null)) ) 
       
       {   console.log("hii");
           $(".data_error_newerrorall_1").css("color", "red");
           $(".data_error_newerrorall_1").css("display", "block");
           $(".data_error_newerrorall_1").css("padding", "5px 0px");    
           $("#data_total_fabric_qty_data_1").css("border", "1px solid red");
           $(".dataerror_fabricwidth").css("color", "red");
           $(".dataerror_fabricwidth").css("display", "block");
           $(".dataerror_fabricwidth").css("padding", "5px 0px");    
           $("#data_fabric_width_data_1").css("border", "1px solid red");
           $(".dataerror_fabricdate_1").css("color", "red");
           $(".dataerror_fabricdate_1").css("display", "block");
           $(".dataerror_fabricdate_1").css("padding", "5px 0px");    
           $("#data_fabric_date_data_1").css("border", "1px solid red");
           return 1;
       }
       
       
       if( (((total_qty == '') || (total_qty == null))) && (((fabric_width == '') || (fabric_width == null))) )
       {   console.log("hey");
           $(".data_error_newerrorall_1").css("color", "red");
           $(".data_error_newerrorall_1").css("display", "block");
           $(".data_error_newerrorall_1").css("padding", "5px 0px");    
           $("#data_total_fabric_qty_data_1").css("border", "1px solid red");
           $(".dataerror_fabricwidth").css("color", "red");
           $(".dataerror_fabricwidth").css("display", "block");
           $(".dataerror_fabricwidth").css("padding", "5px 0px");    
           $("#data_fabric_width_data_1").css("border", "1px solid red");
           return 1;
       }
       
       
       
       
       if((((fabric_width == '') || (fabric_width == null)))  && (((data_fabric_date_data_1 == '') || (data_fabric_date_data_1 == null))))
       {   
           $(".dataerror_fabricwidth").css("color", "red");
           $(".dataerror_fabricwidth").css("display", "block");
           $(".dataerror_fabricwidth").css("padding", "5px 0px");    
           $("#data_fabric_width_data_1").css("border", "1px solid red");
           $(".dataerror_fabricdate_1").css("color", "red");
           $(".dataerror_fabricdate_1").css("display", "block");
           $(".dataerror_fabricdate_1").css("padding", "5px 0px");    
           $("#data_fabric_date_data_1").css("border", "1px solid red");
           return 1;
       } 
      
       
       
       if( (((fabric_width == '') || (fabric_width == null)))  && (((data_fabric_date_data_1 == '') || (data_fabric_date_data_1 == null))) )
       {   
           $(".dataerror_fabricwidth").css("color", "red");
           $(".dataerror_fabricwidth").css("display", "block");
           $(".dataerror_fabricwidth").css("padding", "5px 0px");    
           $("#data_fabric_width_data_1").css("border", "1px solid red");
           $(".dataerror_fabricdate_1").css("color", "red");
           $(".dataerror_fabricdate_1").css("display", "block");
           $(".dataerror_fabricdate_1").css("padding", "5px 0px");    
           $("#data_fabric_date_data_1").css("border", "1px solid red");
           return 1;
       }

       
       if(((total_qty == '') || (total_qty == null))) 
       {   
           $(".data_error_newerrorall_1").css("color", "red");
           $(".data_error_newerrorall_1").css("display", "block");
           $(".data_error_newerrorall_1").css("padding", "5px 0px");    
           $("#data_total_fabric_qty_data_1").css("border", "1px solid red");
           return 1;
       }
       
       
       
       if(((fabric_width == '') || (fabric_width == null))) 
       {   
           $(".dataerror_fabricwidth").css("color", "red");
           $(".dataerror_fabricwidth").css("display", "block");
           $(".dataerror_fabricwidth").css("padding", "5px 0px");    
           $("#data_fabric_width_data_1").css("border", "1px solid red");
           return 1;
       }
       
       if(((data_fabric_date_data_1 == '') || (data_fabric_date_data_1 == null))) 
       {   
           $(".dataerror_fabricdate_1").css("color", "red");
           $(".dataerror_fabricdate_1").css("display", "block");
           $(".dataerror_fabricdate_1").css("padding", "5px 0px");    
           $("#data_fabric_date_data_1").css("border", "1px solid red");
           return 1;
       }
       
       
       
       

       var store1 = $("#store1").val();
       var storeunit1 = $('select[name="storeunit1"]').val(); 
       var store2 = $("#store2").val();
       var storeunit2 = $('select[name="storeunit2"]').val();
       var storetotal_qty = $("#total_qty").val();
       var storetotal_qty_unit = $('select[name="storetotal_qty_unit"]').val(); 

       var add_sku_no_1 = $("#add_sku_no_1").val();  
       var add_sku_no_2 = $("#add_sku_no_2").val();   
       var add_sku_no_3 = $("#add_sku_no_3").val();   
       var add_sku_no_4 = $("#add_sku_no_4").val();   
       var add_sku_no_5 = $("#add_sku_no_5").val();   
       var fabric_codeid =  $("#fabric_codeid").val();  
       var fabricpurchaseid =  $("#fabricpurchaseid").val(); 
       




       var hash_id = $("#hash_id").val();  
       
       var lotno1 = $("#lotno1").val();
       var lotno2 = $("#lotno2").val();
       var after_shrinkage_qty = $("#after_shrinkage_qty").val();
       var after_shrinkage_qtyunits = $('select[name="after_shrinkage_qtyunits"]').val(); 
       
       var baseurl = "https://inventory.deebaco.com/index.php/";
       $.ajax({
            url: baseurl + 'addnew_inventory_detail',
            method: 'POST',
            data: {
            type: 'addnew_inventory_detail',defect_type:defect_type,defect_qty:defect_qty,defect_qty_unit:defect_qty_unit,
                  defect_remarks:defect_remarks,with_water_response:with_water_response, with_soap_response:with_soap_response,colorbleed_comments:colorbleed_comments,
                  shrinkage_before_test_h:shrinkage_before_test_h,shrinkage_before_test_w:shrinkage_before_test_w,shrinkage_fabric_code_h:shrinkage_fabric_code_h,shrinkage_fabric_code_w:shrinkage_fabric_code_w,
                  shrinkage_fabric_code_w:shrinkage_fabric_code_w,shrinkage_comments:shrinkage_comments,
                  return_qty:return_qty,return_qty_unit:return_qty_unit,return_date:return_date,
                  return_reason:return_reason,total_qty:total_qty,total_qty_unit:total_qty_unit,
                  fabric_width:fabric_width,fabric_width_unit:fabric_width_unit,data_fabric_date_data_1:data_fabric_date_data_1,
                  store1:store1,storeunit1:storeunit1,store2:store2,storeunit2:storeunit2,
                  storetotal_qty:storetotal_qty,storetotal_qty_unit:storetotal_qty_unit,
                  add_sku_no_1:add_sku_no_1,add_sku_no_2:add_sku_no_2,add_sku_no_3:add_sku_no_3,
                  add_sku_no_4:add_sku_no_4,add_sku_no_5:add_sku_no_5,fabric_codeid:fabric_codeid,
                  fabricpurchaseid:fabricpurchaseid,hash_id:hash_id,lotno1:lotno1,lotno2:lotno2,
                  after_shrinkage_qty:after_shrinkage_qty,after_shrinkage_qtyunits:after_shrinkage_qtyunits

            },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        //alert(mydata.redirect); 
                        window.location = mydata.redirect; 
                        toastr.success("Inventory details saved successfully");
                        
                    } 
                    else 
                    {    
                        toastr.error("Something went wrong");
                    }
            }
        });

      return false;
    }













    function edit_chnage_inventory_nwdetail()
    {
       // alert("hii");
       var defect_type = $("#defect_type").val();
       var defect_qty = $("#defect_qty").val();  
       var defect_qty_unit = $('select[name="defect_qty_unit"]').val(); 
       var defect_remarks = $("#defect_remarks").val();
       
       var with_water_response = $("#with_water_response").val();
       var with_soap_response = $("#with_soap_response").val();
       var colorbleed_comments = $("#colorbleed_comments").val();
       
       var shrinkage_before_test_h = $("#shrinkage_before_test_h").val(); 
       var shrinkage_before_test_w = $("#shrinkage_before_test_w").val();
       var shrinkage_fabric_code_h = $("#shrinkage_fabric_code_h").val();
       var shrinkage_fabric_code_w = $("#shrinkage_fabric_code_w").val();
       var shrinkage_comments = $("#shrinkage_comments").val();
       
       var return_qty = $("#return_qty").val();
       var return_qty_unit = $('select[name="retnqtyunit1"]').val(); 
       var return_date = $("#return_date").val();
       var return_reason = $("#return_reason").val();

       var total_qty = $("#data_total_fabric_qty_data_1").val();
       var total_qty_unit = $('select[name="data_totalQtyunit_data_1"]').val();
       var fabric_width = $("#data_fabric_width_data_1").val();
       var fabric_width_unit = $('select[name="data_fabricWidthunit_data_1"]').val();
       var data_fabric_date_data_1 = $("#data_fabric_date_data_1").val();

       var store1 = $("#store1").val();
       var storeunit1 = $('select[name="storeunit1"]').val(); 
       var store2 = $("#store2").val();
       var storeunit2 = $('select[name="storeunit2"]').val();
       var storetotal_qty = $("#total_qty").val();
       var storetotal_qty_unit = $('select[name="storetotal_qty_unit"]').val(); 

       var add_sku_no_1 = $("#add_sku_no_1").val();  
       var add_sku_no_2 = $("#add_sku_no_2").val();   
       var add_sku_no_3 = $("#add_sku_no_3").val();   
       var add_sku_no_4 = $("#add_sku_no_4").val();   
       var add_sku_no_5 = $("#add_sku_no_5").val();   
       var fabric_codeid =  $("#fabric_codeid").val();  
       var fabricpurchaseid =  $("#fabricpurchaseid").val(); 
       




       var hash_id = $("#hash_id").val();  
       
       var lotno1 = $("#lotno1").val();
       var lotno2 = $("#lotno2").val();
       var after_shrinkage_qty = $("#after_shrinkage_qty").val();
       var after_shrinkage_qtyunits = $('select[name="after_shrinkage_qtyunits"]').val();
       var inventory_id = $("#inventory_id").val(); 
       
       var baseurl = "https://inventory.deebaco.com/index.php/";
       $.ajax({
            url: baseurl + 'chnage_inventory_detail',
            method: 'POST',
            data: {
            type: 'addnew_inventory_detail',defect_type:defect_type,defect_qty:defect_qty,defect_qty_unit:defect_qty_unit,
                  defect_remarks:defect_remarks,with_water_response:with_water_response, with_soap_response:with_soap_response,colorbleed_comments:colorbleed_comments,
                  shrinkage_before_test_h:shrinkage_before_test_h,shrinkage_before_test_w:shrinkage_before_test_w,shrinkage_fabric_code_h:shrinkage_fabric_code_h,shrinkage_fabric_code_w:shrinkage_fabric_code_w,
                  shrinkage_fabric_code_w:shrinkage_fabric_code_w,shrinkage_comments:shrinkage_comments,
                  return_qty:return_qty,return_qty_unit:return_qty_unit,return_date:return_date,
                  return_reason:return_reason,total_qty:total_qty,total_qty_unit:total_qty_unit,
                  fabric_width:fabric_width,fabric_width_unit:fabric_width_unit,data_fabric_date_data_1:data_fabric_date_data_1,
                  store1:store1,storeunit1:storeunit1,store2:store2,storeunit2:storeunit2,
                  storetotal_qty:storetotal_qty,storetotal_qty_unit:storetotal_qty_unit,
                  add_sku_no_1:add_sku_no_1,add_sku_no_2:add_sku_no_2,add_sku_no_3:add_sku_no_3,
                  add_sku_no_4:add_sku_no_4,add_sku_no_5:add_sku_no_5,fabric_codeid:fabric_codeid,
                  fabricpurchaseid:fabricpurchaseid,hash_id:hash_id,lotno1:lotno1,lotno2:lotno2,
                  after_shrinkage_qty:after_shrinkage_qty,after_shrinkage_qtyunits:after_shrinkage_qtyunits,inventory_id:inventory_id

            },
            success: function(remes){
                    
                    var mydata = $.parseJSON(remes);
                    if(mydata.status == 'success')
                    {   
                        //alert(mydata.redirect); 
                        window.location = mydata.redirect; 
                        toastr.success("Inventory details updated successfully");
                        
                    } 
                    else 
                    {    
                        toastr.error("Something went wrong");
                    }
            }
        });

      return false;
    }















   


   
    function data_total_fabric_qty_data_1_new()
    {
             var data_total_fabric_qty = parseInt($("#data_total_fabric_qty_data_1").val());
            

             if(isNaN(data_total_fabric_qty))
              { 
                 $("#data_total_fabric_qty_data_1").css('border','1px solid red');
                 $(".total_qtyunit").val('UNIT');
                 $(".total_qtyunitvalue").val('0');
                 return true;
              }
              if(data_total_fabric_qty > 0 )
              {    
                   $("#store1").attr("disabled", false);
                   $("#store1").css("cursor", "default");
                   $("#store2").attr("disabled", false);
                   $("#store2").css("cursor","default");

                   $("#data_total_fabric_qty_data_1").css("border","1px solid #ececec");
                   $(".data_error_totalqty_store1").css({'display':'none'});
                   /*$("#store1").val('');
                   $("#store2").val('');
                   $("#total_qty").val(''); 

                   $(".total_qtyunit").val('UNIT');
                   $(".total_qtyunitvalue").val('0');*/
             

                   var store1 = parseInt($("#store1").val());
                   if(isNaN(store1))
                   { 
                     return true;
                   } 
      
                   else if(store1 == null || store1 == "")
                   {
                      return true;
                   }
                   else
                   {
                       if(store1 > data_total_fabric_qty)
                       {
                          $("#total_qty").val('0');
                          $(".total_qtyunit").val('UNIT');
                          $(".total_qtyunit").css("text-transform", "uppercase");
                          $("#data_total_fabric_qty_data_1").css('border','1px solid red');
                          $("#store1").css('border','1px solid red');
                       }
                       else
                       {
                          $("#total_qty").val(store1);
                          $(".total_qtyunit").val('UNIT'); 
                          $(".total_qtyunit").css("text-transform", "uppercase");
                          $("#data_total_fabric_qty_data_1").css('border','1px solid #ececec');
                          $("#store1").css('border','1px solid #ececec');
                       }
                   }
      
               }
               else
               {
                   $("#data_total_fabric_qty_data_1").css('border','1px solid red');
                   $(".total_qtyunit").val('UNIT');
                   $(".total_qtyunitvalue").val('0');
                   return true;
               }

        }  













  //store1
  function add_qtynewdata()
  {  
     
     $(".dataerror_totalqty").css("display","none");
     var data_total_fabric_qty = parseInt($("#data_total_fabric_qty_data_1").val());   
     if(isNaN(data_total_fabric_qty))
     {   
         $("#store1").attr("disabled", true);
         $("#store1").css("cursor","not-allowed");
         $("#data_total_fabric_qty_data_1").css("border","1px solid red");
         $(".data_error_totalqty_store1").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
         $(".total_qtyunit").val('UNIT');
         $(".total_qtyunitvalue").val('0');
         $("#store1").val('');
     }
     else if(data_total_fabric_qty === 0)
     {
         $("#store1").attr("readonly", true);
         $("#store1").css("cursor","not-allowed");
         $("#data_total_fabric_qty_data_1").css("border","1px solid red");
         $(".data_error_totalqty1").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });   
     }
     
     else
     {
         $("#store1").attr("readonly", false);
         $("#store1").css("cursor","auto");
         $("#data_total_fabric_qty_data_1").css('border','1px solid #ececec');
         $(".data_error_totalqty1").css("display","none");
     }
     




     
     var totalqtyleftnaew = parseInt($("#totalqtyleftnaew").val());  
     
     if(isNaN(data_total_fabric_qty))
     {   
        datanw = '0';
        $("#total_qty").val('0');
        $(".total_qtyunit").val('UNIT');
        $(".total_qtyunitvalue").val('0');
     } 
     else
     {
        datanw = data_total_fabric_qty;
     }

     if(data_total_fabric_qty == null || data_total_fabric_qty == "" || datanw == '0')
     {
        $("#data_total_fabric_qty_data_1").css('border','1px solid red');
        $(".data_error_totalqty_store1").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
        $("#total_qty").val('0');
        return true;
     }

     var store2 = $("#store2").val();
     
     if (store2 == null || store2 == "" || store2 === "0") 
     {    
          var store1 = $("#store1").val();
          var total_qty = parseInt(store1);   
          var totalnwqty = totalqtyleftnaew + data_total_fabric_qty;
          
          if(total_qty > totalnwqty)
          {   
              $("#total_qty").val('0');
              $(".total_qtyunit").val('UNIT');
              $("#data_total_fabric_qty_data_1").css('border','1px solid red');
              $("#store1").css('border','1px solid red');
          } 
          else
          {     
             $("#total_qty").val('');
             $("#total_qty").val(total_qty);
             $(".total_qtyunit").val('');
             $("#data_total_fabric_qty_data_1").css('border','1px solid #ececec');
             $("#store1").css('border','1px solid #ececec');
             var data_totalQtyunit_data_1 = $('select[name="data_totalQtyunit_data_1"]').val(); 
             var storeunit1text = $('select[name="data_totalQtyunit_data_1"]').find(":selected").text();
             var storeunit1textvalue = $('select[name="data_totalQtyunit_data_1"]').find(":selected").val();
             $(".total_qtyunit").val('');
             $(".total_qtyunit").val(storeunit1text);
             $(".total_qtyunitvalue").val('');
             $(".total_qtyunitvalue").val(storeunit1textvalue);
            // $(".total_qtyunit").css("text-transform", "uppercase");
         }
       }
       else
       {    


            var store1 = $("#store1").val(); 
            var store2 = $("#store2").val();   
            var total_qty = parseInt(store1) + parseInt(store2);  
            var totalnwqty = totalqtyleftnaew + data_total_fabric_qty; 

            if(total_qty > totalnwqty)
            {   
              $("#total_qty").val('0');
              $(".total_qtyunit").val('UNIT');
              $("#data_total_fabric_qty_data_1").css('border','1px solid red');
              $("#store1").css('border','1px solid red');
            
            }
            else
            {     
             $("#total_qty").val('');
             $("#total_qty").val(total_qty);
             $(".total_qtyunit").val('');
             $("#data_total_fabric_qty_data_1").css('border','1px solid #ececec');
             $("#store1").css('border','1px solid #ececec');
             var data_totalQtyunit_data_1 = $('select[name="data_totalQtyunit_data_1"]').val(); 
             var storeunit1text = $('select[name="data_totalQtyunit_data_1"]').find(":selected").text();
             $(".total_qtyunit").val('');
             $(".total_qtyunit").val(storeunit1text);
             //$(".total_qtyunit").css("text-transform", "uppercase");
            } 
       
       }
  }

     


    

   //store 2
   function add_qty()
   {  
     $(".dataerror_store2").css("display","none");
     $("#storeunit2").css('border','1px solid #ececec');

     $("#data_total_fabric_qty_data_1").css('border','1px solid #ececec');
     $("#storeunit1").css('border','1px solid #ececec');   
     var store2, store1, storeunit2text, toatlquantity_new;
     
     
     var data_total_fabric_qty = parseInt($("#data_total_fabric_qty_data_1").val());   
     if(isNaN(data_total_fabric_qty))
     {   
         $("#store2").attr("disabled", true);
         $("#store2").css("cursor","not-allowed");
         $("#data_total_fabric_qty_data_1").css("border","1px solid red");
         $(".data_error_totalqty_store1").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });
         $("#store1").val('');
         $("#total_qty").val('0');
         $(".total_qtyunit").val('UNIT');
         $(".total_qtyunitvalue").val('0');
     }
     else if(data_total_fabric_qty === 0)
     {
         $("#store2").attr("disabled", true);
         $("#store2").css("cursor","not-allowed");
         $("#data_total_fabric_qty_data_1").css("border","1px solid red");
         $(".data_error_totalqty1").css({'display':'block', 'font-size':'10px','color':'red','padding': '5px 0' });   
     }
     
     else
     {
         $("#store2").attr("disabled", false);
         $("#store2").css("cursor","auto");
         $("#data_total_fabric_qty_data_1").css('border','1px solid #ececec');
         $(".data_error_totalqty1").css("display","none");
     }

     var totalqtyleftnaew = parseInt($("#totalqtyleftnaew").val());

         if(isNaN(data_total_fabric_qty))
         { 
           $(".total_qtyunit").val('UNIT');
           $(".total_qtyunitvalue").val('0');
           return true;
         } 

         if(data_total_fabric_qty == null || data_total_fabric_qty == "")
         {  
            $("#total_qty").val('0');
            $(".total_qtyunit").val('UNIT');
            $(".total_qtyunitvalue").val('0');
            $("#data_total_fabric_qty_data_1").css('border','1px solid red');
            return true;
         }

         var store1 = parseInt($("#store1").val()); 
         var store2 = parseInt($("#store2").val());  

     
         if(isNaN(store1))
         {  
            store1 = 0;
            //return true;  
         }

         if(isNaN(store2))
         {  
           
            store2 = 0;
            //return true;
         }
         
         var totalqtyleftnaew = data_total_fabric_qty + totalqtyleftnaew;
         toatlquantity_new = store1 + store2; 
         if(toatlquantity_new > totalqtyleftnaew)
         {    
              $("#total_qty").val('0');
              //$(".total_qtyunit").val('UNIT');
              var data_totalQtyunit_data_1 = $('select[name="data_totalQtyunit_data_1"]').val(); 
              var storeunit1text = $('select[name="data_totalQtyunit_data_1"]').find(":selected").text();
              
              var storeunit1textvalue = $('select[name="data_totalQtyunit_data_1"]').find(":selected").val();
              $(".total_qtyunit").val('');
              $(".total_qtyunit").val(storeunit1text);
              $(".total_qtyunitvalue").val('');
              $(".total_qtyunitvalue").val(storeunit1textvalue);

              $("#data_total_fabric_qty_data_1").css('border','1px solid red');
              $("#store1").css('border','1px solid red');
              $("#store2").css('border','1px solid red');
         } 
         else
         {     
             $("#total_qty").val('');
             $("#total_qty").val(toatlquantity_new);
             $(".total_qtyunit").val('');
             var data_totalQtyunit_data_1 = $('select[name="data_totalQtyunit_data_1"]').val(); 
             var storeunit1text = $('select[name="data_totalQtyunit_data_1"]').find(":selected").text();
             
             var storeunit1textvalue = $('select[name="data_totalQtyunit_data_1"]').find(":selected").val();
             $(".total_qtyunit").val('');
             $(".total_qtyunit").val(storeunit1text);
             $(".total_qtyunitvalue").val('');
             $(".total_qtyunitvalue").val(storeunit1textvalue);
             $("#data_total_fabric_qty_data_1").css('border','1px solid #ececec');
             $("#store1").css('border','1px solid #ececec');
             $("#store2").css('border','1px solid #ececec');
             }  
 }  
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 function fildata()
     {
         
            //var fileName = e.target.files[0].name;
            //var formData = new FormData("file_info")[0]; 
            //formData.append('file_info', fileName);
            //alert("hey");
            var name = document.getElementById("file_info").files[0].name;
            var form_data = new FormData();  
            var ext = name.split('.').pop().toLowerCase();
            form_data.append("file_info", document.getElementById('file_info').files[0]);  
            console.log(form_data);
            //var baseurl = "http://localhost.inventory/";
            //var baseurl = "http://inventory.ssrtechvision.com/";

            var baseurl = "https://inventory.deebaco.com/index.php/";

            $.ajax({
                url:baseurl + 'upload',
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function()
                {

                  var loader = 'https://inventory.deebaco.com/images/loader.gif';
                  $("#loaderdata").attr("src", loader);
                  $("#loaderdata").css("display","block");
                },   
                success:function(data)
                { 
                  var nwdata = JSON.parse(data);
                  console.log(nwdata);
                    window.setTimeout(function(){
                    $("#file_info_newdata").val('');
                    $("#file_info_newdata").val(nwdata.url);
                    var alldata = $("#file_info_newdata").val();
                    $("#infosrc").attr("src", alldata);
                    $("#loaderdata").attr("src", "");
                    $("#loaderdata").css("display","none");
                    $(".imgRmveBtn").css("display","block");
                    }, 1000);
                
                }
            });
        
      
    }
  






</script>
</body>
</html>