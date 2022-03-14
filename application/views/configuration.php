<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://inventory.deebaco.com/style/style.css" />
</head>



<body>
    <div class="BasicInfoPage">
        <!--=============================== header ===============================-->
        <div class="header flex">
            <div class="logo">
                <img src="https://inventory.deebaco.com/images/logo.png" alt="" />
            </div>




            <!--<div class="headerIcons flex">
                <a href="#" class="HeaderIcon headerBell">
                    <svg viewBox="0 0 32 32" class="icon shapeCodepen headerBellIcon">
                        <use xlink:href="https://inventory.deebaco.com/SVG/sprite.svg#icon-bell-o"></use>
                    </svg>
                </a>
                <a href="#" class="HeaderIcon HeaderUser">
                    <svg viewBox="0 0 32 32" class="icon shapeCodepen headerUserIcon">
                        <use xlink:href="https://inventory.deebaco.com/SVG/sprite.svg#user-icon"></use>
                    </svg>
                </a>
            </div>-->





            <div class="headerIcons flex">
                <a href="javascript:void(0)" class="HeaderIcon headerBell">
                    <svg viewBox="0 0 32 32" class="icon shapeCodepen headerBellIcon">
                        <use xlink:href="https://inventory.deebaco.com/SVG/sprite.svg#icon-bell-o"></use>
                    </svg>
                </a>
                <div class="UserMenu">
                    <a href="javascript:void(0)" class="HeaderIcon HeaderUser" onClick="userdata()">
                        <svg viewBox="0 0 32 32" class="icon shapeCodepen headerUserIcon">
                            <use xlink:href="https://inventory.deebaco.com/SVG/sprite.svg#user-icon"></use>
                        </svg>
                    </a>
                    <ul class="subUseMenu" id="subUseMenu" style="display:none;">
                        <li class="subUserMenuItem"><a class="subusermenuLink" href="javascript:void(0)"
                                onClick="generatedata()">Create Token</a></li>
                        <li class="subUserMenuItem"><a class="subusermenuLink" href="javascript:void(0)"
                                onClick="logout()">Logout</a></li>
                    </ul>

                    <input type="hidden" name="userdata" id="userdata" value="0">
                </div>

                <style type="text/css">
                    .UserMenu {
                        position: relative;
                    }



                    ul.subUseMenu {
                        position: absolute;
                        padding: 1rem 0;
                        top: 3.5rem;
                        right: 0;
                        z-index: 99;
                        background: #fff;
                        border-radius: .5rem;
                        width: max-content;
                    }




                    .subUserMenuItem {
                        padding: 1rem;
                        width: initial;
                    }

                    .subUserMenuItem:first-child {
                        border-bottom: 1px solid #757575;
                    }

                    .subusermenuLink {
                        color: #757575;
                    }
                </style>
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
                    <li class="SidemenuItem upperCase"><a href="#"> Vendor Management</a></li>
                    <li class="SidemenuItem uppercase"><a href="javascript:void(0)"
                            onClick="configuration()">Masters</a></li>
                </ul>
            </div>
            <div class="mainRight">

                <!-- ===================information=================== -->
                <form action="">
                    <div class="mainBasicInfoSection">
                        <div class="information section">
                            <p class="heading robotoMedium upperCase">Add New Fabric Type</p>


                            <div class="flex mainInfoInputS robotoReguler">
                                <div class="vndrDebitnote robotoReguler upperCase flex field_wrapper">
                                    <label for="Price" class="robotoMedium labelTitle">Create</label>
                                    <div>
                                        <input type="text"
                                            class="infoInputTxt Debitnoteinput vndrcontctaltprice upperCase addFabric"
                                            oninput="change_data()"
                                            style="border: 1px solid #ececec;background-color: #fbfbfb;margin: 0 10px 10px 10px;">
                                        <a href="javascript:void(0);" class="add_fabric_type" title="Add field"><i
                                                class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                        <p class="errorMsg"><span id="error" style="display:none;">Requested fabric type
                                                already exits</span></p>
                                        <p class="sucessMsg"><span id="data_added" style="display: none;">Requested
                                                fabric type created successfully</span></p>
                                        <p class="sucessMsg"><span id="data_remove" style="display: none;">Requested
                                                fabric type removed successfully</span></p>

                                        <p class="errorMsg"><span id="data_error" style="display: none;">Invalid fabric
                                                type</span></p>


                                        <div class="flex mainAddfilter" id="initial">


                                            <?php if(!empty($fabric_type_list)){ 
                                       foreach ($fabric_type_list as $value) 
                                 { ?>
                                            <div class="flex addFilterContent" id="<?php echo $value->id;?>">
                                                <button class="FliterTxt">
                                                    <?php echo $value->name;?>
                                                </button>

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
                                        margin-left: 10px;
                                        flex-wrap: wrap;
                                    }

                                    .errorMsg {
                                        color: red;
                                        width: 100%;
                                        font-size: 10px;
                                        margin: 0 0 10px 10px;
                                    }


                                    .sucessMsg {

                                        color: green;
                                        width: 100%;
                                        font-size: 10px;
                                        margin: 0 0 10px 10px;
                                    }

                                    .FliterTxt {
                                        background: transparent;
                                        border: 0;
                                        font-size: 12px;
                                        margin-right: 20px;
                                    }

                                    .addfilterLink {
                                        font-size: 12px;
                                        color: red;
                                    }

                                    /*===============================*/
                                    .mainAddfilter {
                                        flex-wrap: wrap;
                                    }

                                    .addFilterContent {
                                        margin-bottom: .7rem;
                                    }
                                </style>

                            </div>
                        </div>





                        <div class="defects section">
                            <p class="heading robotoMedium upperCase">Add New Fabric Pattern</p>
                            <div class="flex mainInfoInputS robotoReguler">
                                <div class="vndrDebitnote robotoReguler upperCase flex field_wrapper">
                                    <label for="Price" class="robotoMedium labelTitle">Create</label>
                                    <div>
                                        <input type="text"
                                            class="infoInputTxt Debitnoteinput vndrcontctaltprice upperCase addFabricData"
                                            oninput="change_data()"
                                            style="border: 1px solid #ececec;background-color: #fbfbfb;margin: 0 10px 10px 10px;">
                                        <a href="javascript:void(0);" class="add_fabric_pattern"
                                            onClick="add_fabric_pattern()" title="Add field"><i
                                                class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                        <p class="errorMsg"><span id="new_error" style="display: none;">Requested fabric
                                                pattern already exits</span></p>
                                        <p class="sucessMsg"><span id="new_data_added" style="display: none;">Requested
                                                pattern type created successfully</span></p>
                                        <p class="sucessMsg"><span id="new_data_remove" style="display: none;">Requested
                                                pattern type removed successfully</span></p>

                                        <p class="errorMsg"><span id="new_data_error" style="display: none;">Invalid
                                                fabric pattern</span></p>


                                        <div class="flex mainAddfilter" id="initial">


                                            <?php if(!empty($fabric_pattern_list)){ 
                                       foreach ($fabric_pattern_list as $value) 
                                    { ?>
                                            <div class="flex addFilterContent" id="<?php echo $value->id;?>">
                                                <button class="FliterTxt">
                                                    <?php echo $value->name;?>
                                                </button>

                                            </div>
                                            <?php } } else { ?>
                                            <?php } ?>


                                            <span id="newadded" style="display: flex;"></span>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>





                        <div class="shirnkage section">
                            <p class="heading robotoMedium upperCase">Add New SI Unit
                            </p>
                            <div class="flex mainInfoInputS robotoReguler">
                                <div class="vndrDebitnote robotoReguler upperCase flex field_wrapper">
                                    <label for="Price" class="robotoMedium labelTitle">Create</label>
                                    <div>
                                        <input type="text"
                                            class="infoInputTxt Debitnoteinput vndrcontctaltprice upperCase addData_nw"
                                            oninput="change_data()"
                                            style="border: 1px solid #ececec;background-color: #fbfbfb;margin: 0 10px 10px 10px;">
                                        <a href="javascript:void(0);" class="add_new" onClick="add_new()"
                                            title="Add field"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                        <p class="errorMsg"><span id="nw_new_error" style="display: none;">Requested
                                                unit already exits</span></p>
                                        <p class="sucessMsg"><span id="nw_new_data_added"
                                                style="display: none;">Requested unit created successfully</span></p>
                                        <p class="sucessMsg"><span id="nw_new_data_remove"
                                                style="display: none;">Requested unit removed successfully</span></p>

                                        <p class="errorMsg"><span id="nw_new_data_error" style="display: none;">This
                                                field is invalid</span></p>


                                        <div class="flex mainAddfilter" id="initial">


                                            <?php if(!empty($unit)){ 
                                       foreach ($unit as $value) 
                                    { ?>
                                            <div class="flex addFilterContent" id="<?php echo $value->id;?>">
                                                <button class="FliterTxt">
                                                    <?php echo $value->name;?>
                                                </button>

                                            </div>
                                            <?php } } else { ?>
                                            <?php } ?>


                                            <span id="nw_newadded" style="display: flex;"></span>

                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>



                        <div class="shirnkage section">
                            <p class="heading robotoMedium upperCase">Add New Color
                            </p>
                            <div class="flex mainInfoInputS robotoReguler">
                                <div class="vndrDebitnote robotoReguler upperCase field_wrapper">
                                      <div class="colrcdcolrnm flex">
                                            <div class="flex">
                                                   <label for="Price" class="robotoMedium labelTitle">Color Name </label>
                                                   <div>
                                                        <input type="text"
                                                            class="infoInputTxt Debitnoteinput vndrcontctaltprice upperCase addData_nwnaew"
                                                            oninput="changenwnaewdata()"
                                                            style="border: 1px solid #ececec;background-color: #fbfbfb;margin: 0 10px 10px 10px;">
                                                        
                                                        
                                                        
                                                                <p class="errorMsg"><span id="nwnaew_error" style="display: none;">Requested
                                                                        color name already exits</span></p>
                                                                <p class="sucessMsg"><span id="nwnaew_data_added"
                                                                        style="display: none;">Requested color data added successfully</span>
                                                                </p>
                        
                                                                <p class="errorMsg"><span id="nwnaew_data_error" style="display: none;">This
                                                                        field is invalid</span></p>
                                                                        
                                                                <p class="errorMsg"><span id="newnw_error" style="display: none;">Requested
                                                                        color code already exits</span></p>
                                                                
                                                                <p class="errorMsg"><span id="newnwerror" style="display: none;">This
                                                                        field is invalid</span></p>
                                                </div>
                                                 </div>
                                            <div class="flex">
                                                <label for="Price" class="robotoMedium labelTitle">Color Code </label>
                                                <div>
                                                        <input type="text"
                                                            class="infoInputTxt Debitnoteinput vndrcontctaltprice upperCase addData_newnw"
                                                            oninput="changnwdata()"
                                                            style="border: 1px solid #ececec;background-color: #fbfbfb;margin: 0 10px 10px 10px;">
                                                        <a href="javascript:void(0);" class="add_new" onClick="add_newcode()"
                                                            title="Add field"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                        
                                              </div>
                                                </div>
                                      </div>
                                        <div class="flex mainAddfilter" id="initial">


                                            <?php if(!empty($color)){ 
                                       foreach ($color as $value) 
                                    { ?>
                                            <div class="flex addFilterContent" id="<?php echo $value->id;?>">
                                                <button class="FliterTxt">
                                                     <?php if($value->color_code == ''){ ?>
                                                     <?php echo $value->color_name;?>
                                                     <?php }else { ?>
                                                     <?php echo $value->color_name."  ( ".$value->color_code. " )"; }?>
                                                     
                                                    
                                                     
                                                    
                                                </button>

                                            </div>
                                            <?php } } else { ?>
                                            <?php } ?>


                                            <span id="nwnaew_newadded" style="display: flex;"></span>

                                        </div>
                                </div>


                                </div>


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


        .field_wrapper {
            margin-bottom: 10px;
        }

        .add_button,
        .remove_button {
            vertical-align: middle;
            margin-left: 5px;
        }
    </style>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://inventory.deebaco.com/js/login.js" type="text/javascript"></script>





<script type="text/javascript">
    $(document).ready(function () {
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" class="infoInputTxt Debitnoteinput vndrcontctaltprice upperCase" style="border: 1px solid #ececec;background-color: #fbfbfb;margin: 0 10px 10px 10px; display: inline-block;"><a href="javascript:void(0);"  class="remove_button"><i class="fa fa-minus-circle " ></i></a></div>'; //New input field html 
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function () {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function (e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>

























<script type="text/javascript">
    $(document).ready(function () {
        //var errorMsg = $('#error').text();  
        //var baseurl = 'https://inventory.deebaco.com/index.php/';

        $('#error').css("display", "none");
        $("#data_added").css("display", "none");
        $("#data_remove").css("display", "none");
        $("#data_error").css("display", "none");
        var add = $('.add_fabric_type');

        //Once add button is clicked
        $(add).click(function () {
            var addFabric = $('.addFabric').val();
            $("#data_added").css("display", "none");
            if (addFabric == null || addFabric == "") {
                $("#data_error").css("display", "block");
                $(".addFabric").css('border', '1px solid red');
            }


            if (addFabric.length >= 1) {
                var html = '';

                var baseurl = 'https://inventory.deebaco.com/index.php/';
                $.ajax({
                    url: baseurl + 'add_fabric_type',
                    method: 'POST',
                    data: {
                        type: 'add_fabric_type',
                        addFabric: addFabric
                    },
                    success: function (response) {
                        let my_data = JSON.parse(response);
                        if (my_data.status === true) {
                            let add = my_data.all_data;
                            let added_id = my_data.id;




                            html += '<div class="flex addFilterContent" id="' + my_data.id + '"><button class="FliterTxt">' + my_data.data + '</button></div>';

                            //$("#initial").css("display","none");
                            $('#added').append(html);

                            $("#data_added").css("display", "block");
                            $("#data_remove").css("display", "none");
                            $('.addFabric').val('');

                        }
                        else {
                            $('#error').css("display", "block");
                        }
                    }


                });




                //ajax
            }

        });

    });



    function change_data() {
        $("#data_error").css("display", "none");
        $(".addFabric").css('border', 'none');
        $('#error').css("display", "none");
        $("#data_added").css("display", "none");
        $("#data_remove").css("display", "none");
    }


    $('.addFabricData').on('input', function () {
        $("#new_data_error").css("display", "none");
        $(".addFabricData").css('border', 'none');
        $('#new_error').css("display", "none");
        $("#new_data_added").css("display", "none");
        $("#new_data_remove").css("display", "none");
    });






    function add_fabric_pattern() {
        var addFabricData = $('.addFabricData').val();
        /*$("#new_data_added").css("display", "none");
        $("#new_data_error").css("display","none");
        $("#new_error").css("display","none");*/
        $("#new_data_error").css("display", "none");
        $(".addFabricData").css('border', 'none');
        $('#new_error').css("display", "none");
        $("#new_data_added").css("display", "none");
        $("#new_data_remove").css("display", "none");
        if (addFabricData == null || addFabricData == "") {
            $("#new_data_error").css("display", "block");
            $(".addFabricData").css('border', '1px solid red');
        }

        if (addFabricData.length >= 1) {
            var htmldata = '';
            var baseurl = 'https://inventory.deebaco.com/index.php/';
            $.ajax({
                url: baseurl + 'add_fabric_pattern',
                method: 'POST',
                data: {
                    type: 'add_fabric_pattern',
                    addFabricData: addFabricData
                },
                success: function (response) {
                    let my_data = JSON.parse(response);
                    if (my_data.status === true) {


                        htmldata += '<div class="flex addFilterContent" id="' + my_data.id + '"><button class="FliterTxt">' + my_data.data + '</button></div>';

                        $('#newadded').append(htmldata);

                        $("#new_data_added").css("display", "block");
                        $("#new_data_remove").css("display", "none");
                        $('.addFabricData').val('');

                    }
                    else {
                        $('#new_error').css("display", "block");
                    }
                }


            });
        }
    }









    $('.addData_nw').on('input', function () {

        $("#nw_new_data_error").css("display", "none");
        $(".addData_nw").css('border', 'none');
        $('#nw_new_error').css("display", "none");
        $("#nw_new_data_added").css("display", "none");
        $("#nw_new_data_remove").css("display", "none");
    });


    function add_new() {
        var addData_nw = $('.addData_nw').val();
        $("#nw_new_data_error").css("display", "none");
        $(".addData_nw").css('border', 'none');
        $('#nw_new_error').css("display", "none");
        $("#nw_new_data_added").css("display", "none");
        $("#nw_new_data_remove").css("display", "none");
        if (addData_nw == null || addData_nw == "") {
            $("#nw_new_data_error").css("display", "block");
            $(".addData_nw").css('border', '1px solid red');
        }

        if (addData_nw.length >= 1) {
            var htmldata_nw = '';
            var baseurl = 'https://inventory.deebaco.com/index.php/';
            $.ajax({
                url: baseurl + 'add_fabric_nwdata',
                method: 'POST',
                data: {
                    type: 'add_fabric_nwdata',
                    addData_nw: addData_nw
                },
                success: function (response) {
                    let my_data = JSON.parse(response);
                    if (my_data.status === true) {


                        htmldata_nw += '<div class="flex addFilterContent" id="' + my_data.id + '"><button class="FliterTxt">' + my_data.data + '</button></div>';

                        $('#nw_newadded').append(htmldata_nw);

                        $("#nw_new_data_added").css("display", "block");
                        $("#nw_new_data_remove").css("display", "none");
                        $('.addData_nw').val('');

                    }
                    else {
                        $('#nw_new_error').css("display", "block");
                    }
                }


            });
        }
    }

    function remove_fabric_type(id) {
        $('#error').css("display", "none");
        $("#data_added").css("display", "none");
        $("#data_remove").css("display", "none");
        $("#data_error").css("display", "none");
        $("#data_remove").css("display", "none");
        var baseurl = 'https://inventory.deebaco.com/index.php/';
        $.ajax({
            url: baseurl + 'remove_fabric_type',
            method: 'POST',
            data: {
                type: 'remove_fabric_type',
                id: id
            },
            success: function (response) {
                let my_data = JSON.parse(response);
                if (my_data.status === true) {
                    console.log(my_data.message);
                    //let add = my_data.data;
                    $("#" + id).css("display", "none");
                    $("#data_remove").css("display", "block");
                    console.log(added_id);
                }
                else {
                    $('#error').css("display", "block");
                }
            }


        });
    }







    function remove_fabric_data_nw(id) {
        $("#nw_new_data_error").css("display", "none");
        $('#nw_new_error').css("display", "none");
        $("#nw_new_data_added").css("display", "none");
        $("#nw_new_data_remove").css("display", "none");
        var baseurl = 'https://inventory.deebaco.com/index.php/';
        $.ajax({
            url: baseurl + 'remove_fabric_data_nw',
            method: 'POST',
            data: {
                type: 'remove_fabric_data_nw',
                id: id
            },
            success: function (response) {
                let my_data = JSON.parse(response);
                if (my_data.status === true) {
                    console.log(my_data.message);
                    //let add = my_data.data;
                    $("#" + id).css("display", "none");
                    $("#nw_new_data_remove").css("display", "block");
                }
                else {
                    $('#nw_new_error').css("display", "block");
                }
            }


        });
    }



    function remove_fabric_data(id) {
        $('#new_error').css("display", "none");
        $("#new_data_added").css("display", "none");
        $("#new_data_remove").css("display", "none");
        $("#new_data_error").css("display", "none");
        $("#new_data_remove").css("display", "none");

        var baseurl = 'https://inventory.deebaco.com/index.php/';
        $.ajax({
            url: baseurl + 'remove_fabric_pattern',
            method: 'POST',
            data: {
                type: 'remove_fabric_pattern',
                id: id
            },
            success: function (response) {
                let my_data = JSON.parse(response);
                if (my_data.status === true) {
                    console.log(my_data.message);
                    //let add = my_data.data;
                    $("#" + id).css("display", "none");
                    $("#new_data_remove").css("display", "block");
                }
                else {
                    $('#new_error').css("display", "block");
                }
            }


        });
    }
</script>




















<script>
    function add_newcode() {
        var addData_nw = $('.addData_nwnaew').val();
        var addDatanw = $('.addData_newnw').val();
        $("#nwnaew_data_error").css("display", "none");
        $(".addData_nwnaew").css('border', 'none');
        $('#nwnaew_error').css("display", "none");
        $("#nwnaew_data_added").css("display", "none");
        $("#nwnaew_data_remove").css("display", "none");
        if (addData_nw == null || addData_nw == "") {
            $("#nwnaew_data_error").css("display", "block");
            $(".addData_nwnaew").css('border', '1px solid red');
        } 

        if (addData_nw.length >= 1) {
            var htmldata_nw = '';

            var baseurl = 'https://inventory.deebaco.com/index.php/';
            $.ajax({
                url: baseurl + 'add_colora',
                method: 'POST',
                data: {
                    type: 'add_colorc',
                    addData_nw: addData_nw, addDatanw: addDatanw
                },
                success: function (response) {
                    let my_data = JSON.parse(response);
                    if (my_data.status === true) {console.log(my_data.data);
                          htmldata_nw += '<div class="flex addFilterContent" id="' + my_data.id + '"><button class="FliterTxt">' + my_data.data +' ( ' + my_data.nwdata + ' )  </button></div>';
                          $('#nwnaew_newadded').append(htmldata_nw);
                          $('#nw_newadded').append(htmldata_nw);
                          
                          $('.addData_nwnaew').val(''); 
                          $('.addData_newnw').val(''); 
                          $("#nwnaew_data_added").css("display", "block");

                    
                        
                    
                    }
                    else {
                        
                        
                        $(".addData_nwnaew").css('border', '1px solid red');
                        $('#nwnaew_error').css("display", "block"); 
                    }
                }


            });
        }
    }
</script>

<script>
   /* function add_newcode() {
        var addData_nw = $('.addData_nwnaew').val();
        $("#newnwerror").css("display", "none");
        $(".addData_nwnaew").css('border', 'none');
        $('#nwnaew_error').css("display", "none");
        $("#nwnaew_data_added").css("display", "none");
        $("#nwnaew_data_remove").css("display", "none");
        if (addData_nw == null || addData_nw == "") {
            $("#newnwerror").css("display", "block");
            $(".addData_nwnaew").css('border', '1px solid red');
        }

        if (addData_nw.length >= 1) {
            var htmldata_nw = '';
            $.ajax({
                url: baseurl + 'add_colorc',
                method: 'POST',
                data: {
                    type: 'add_colorc',
                    addData_nw: addData_nw
                },
                success: function (response) {
                    let my_data = JSON.parse(response);
                    if (my_data.status === true) {

                        $("#nwnaew_data_added").css("display", "block");
                        $("#nwnaew_data_remove").css("display", "none");
                        $('.addData_nwnaew').val('');

                    }
                    else {
                        $('#nwnaew_error').css("display", "block");
                    }
                }


            });
        }
    }*/
</script>



<script>
    function changenwnaewdata() {
        var addData_nw = $('.addData_nwnaew').val();
        $("#nwnaew_data_error").css("display", "none");
        $(".addData_nwnaew").css('border', 'none');
        $('#nwnaew_error').css("display", "none");
        $("#nwnaew_data_added").css("display", "none");
        $("#nwnaew_data_remove").css("display", "none");
        if (addData_nw == null || addData_nw == "") {
            $("#nwnaew_data_error").css("display", "block");
            $(".addData_nwnaew").css('border', '1px solid red');
        }

        if (addData_nw.length >= 1) {
            var htmldata_nw = '';

            var baseurl = 'https://inventory.deebaco.com/index.php/';
            $.ajax({
                url: baseurl + 'add_colorc',
                method: 'POST',
                data: {
                    type: 'add_colorc',
                    addData_nw: addData_nw
                },
                success: function (response) {
                    let my_data = JSON.parse(response);
                    if (my_data.status === true) {

                          console.log(my_data.data);
                          $("#nwnaew_data_remove").css("display", "none");

                    }
                    else {
                        
                        
                        $(".addData_nwnaew").css('border', '1px solid red');
                        $('#nwnaew_error').css("display", "block"); 
                    }
                }


            });
        }
    }
</script>

<script>
    function changnwdata() {
        var addData_nw = $('.addData_newnw').val();
        $("#newnw_error").css("display", "none");
        $("#newnwerror").css("display", "none");
        $("#nw_new_data_error").css("display", "none");
        $(".addData_newnw").css('border', 'none');
        $('#newnw_error').css("display", "none");
        $("#newnw_added").css("display", "none");
        $("#nwnaew_data_remove").css("display", "none");
        if (addData_nw == null || addData_nw == "") {
            $("#newnwerror").css("display", "block");
            $(".addData_newnw").css('border', '1px solid red');
            return 1;
       }  
      
       
        if (addData_nw.length >= 1) {
            var htmldata_nw = ''; 

            var baseurl = 'https://inventory.deebaco.com/index.php/';
            $.ajax({
                url: baseurl + 'add_coloracode',
                method: 'POST',
                data: {
                    type: 'add_coloracode',
                    addData_nw: addData_nw
                },
                success: function (response) {
                    let my_data = JSON.parse(response);
                    if (my_data.status === true) {

                          console.log(my_data.data);
                          $("#nwnaew_data_remove").css("display", "none");

                    }
                    else {
                        
                        $(".addData_newnw").css('border', '1px solid red');
                        $('#newnwerror').css("display", "block"); 
                    }
                }


            });
        }
        else{ 
            
            $(".addData_newnw").css('border', '1px solid red');
            $('#newnwerror').css("display", "none"); 
        }
        
    }
</script>





