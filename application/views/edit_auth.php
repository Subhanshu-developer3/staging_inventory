<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>password Page</title>
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
            
            
            
            <!--<div class="headerIcons flex">
                <a href="#" class="HeaderIcon headerBell">
                    <svg viewBox="0 0 32 32" class="icon shapeCodepen headerBellIcon">
                        <use xlink:href="<?php echo base_url(); ?>SVG/sprite.svg#icon-bell-o"></use>
                    </svg>
                </a>
                <a href="#" class="HeaderIcon HeaderUser">
                    <svg viewBox="0 0 32 32" class="icon shapeCodepen headerUserIcon">
                        <use xlink:href="<?php echo base_url();?>SVG/sprite.svg#user-icon"></use>
                    </svg>
                </a>
            </div>-->
            
            
            <div class="headerIcons flex">
                <a href="javascript:void(0)" class="HeaderIcon headerBell">
                    <svg viewBox="0 0 32 32" class="icon shapeCodepen headerBellIcon">
                        <use xlink:href="<?php echo base_url(); ?>SVG/sprite.svg#icon-bell-o"></use>
                    </svg>
                </a>
                <div class="UserMenu">
                    <a href="javascript:void(0)" class="HeaderIcon HeaderUser" onClick="userdata()">
                        <svg viewBox="0 0 32 32" class="icon shapeCodepen headerUserIcon">
                            <use xlink:href="<?php echo base_url(); ?>SVG/sprite.svg#user-icon"></use>
                        </svg>
                    </a>
                    <ul class="subUseMenu" id="subUseMenu" style="display:none;">
                        <li class="subUserMenuItem"><a class="subusermenuLink" href="javascript:void(0)" onClick="generatedata()">Create Token</a></li>
                        <li class="subUserMenuItem"><a class="subusermenuLink" href="javascript:void(0)" onClick="logout()">Logout</a></li>
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
           .subusermenuLink{
           color:#757575;
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
                    
                    <li class="SidemenuItem uppercase"><a href="javascript:void(0)" onClick="configuration()">Masters</a></li>
                    
                </ul>
            </div>
            <div class="mainRight">
                <div class="flex tabViewBtns robotoReguler">



                    
                    <a href="javascript:void(0)" class="btn whiteBack upperCase tabViewBtn  upperCase greenBtn" onClick="info_basic_detail_re_render('<?php echo $url ?>')">basic Info</a>
                    <a href="javascript:void(0)" class="btn upperCase greenBtn tabViewBtn whiteBack" onClick="inventory_detail_re_render('<?php echo $url ?>')">Inventory Details</a>
                    <a href="javascript:void(0)" class="btn upperCase tabViewBtn blueBtn ">Vendor Details</a>
                </div>
                <!-- ===================information=================== -->
                <form action="">
                    <div class="mainBasicInfoSection">
                        <div class="ImageUpload section">
                            <p class="heading robotoMedium upperCase">Image Upload</p>
                            <div class="flex fullchooseBrowsFile mainInfoInputS robotoReguler">
                                <div class="mainChoosebrowseFile flex">
                                    <div class="maininfoInput12 TitleInputBox upperCase browsFile flex">
                                        <svg viewBox="0 0 32 32" class="icon shapeCodepen browsFileIcon">
                                            <use xlink:href="<?php echo base_url(); ?>SVG/sprite.svg#icon-folder"></use>
                                        </svg>
                                        <label class="custom-file-input filebrows">
                                            <input type="file">

                                        </label>
                                        <p class="imgUitText">only .jpg or png format</p>
                                    </div>
                                    <div class="maininfoInput13 TitleInputBox upperCase chooseFils flex">
                                        <svg viewBox="0 0 32 32" class="icon shapeCodepen chooseFileIcon">
                                            <use xlink:href="<?php  echo base_url(); ?>SVG/sprite.svg#icon-pictures"></use>
                                        </svg>
                                        <label class="custom-file-input fildrag">
                                            <input type="file">
                                        </label>
                                    </div>
                                </div>
                                <div class="imagePalce upperCase">Image</div>
                                <div class="mainTitleSwatches flex">
                                    <label class="addeddBy labelTitle">Added by</label>
                                    <div class="swatchesFullName flex">
                                        <input type="text" placeholder="Full name" class="transparent brdrNone">
                                        <a href="#" class="addSwatchBtn btn">Add Swatch</a>
                                    </div>
                                </div>
                                <div class="mainSaveBtn passwordSaveBtn flex">
                                    <input type="button" onClick="edit_auth()" class="saveBtn SaveBtnWidth upperCase blueBtn btn" value="Sumbit" href="javascript:void(0)"  >
                                </div>
                                <style type="text/css">
                                    .mainSaveBtn {
                                        align-items: flex-end;
                                        z-index: 999;
                                        justify-content: space-between;
                                    }
                                    .SaveBtnWidth{
                                        width: 120px;
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                   
                    <div class="backBlur"></div>
                    <div class="popupmsg flex robotoReguler" style="flex-wrap: wrap;">
                        <p class="passwordTitle">Enter password to view details</p>
                        <input type="password" name="password" id="password" placeholder="*********" class="infoInputTxt passwordInput">
                        <span id="error_data" href="javascript:void(0)" class="italic passordTxt" style="color: #dc3545;">* This field is invalid</span>

                        <span id="error_hide" href="javascript:void(0)" class="italic passordTxt" style="color: #68C819;">Access Granted &nbsp; <i class="fa fa-check-circle" aria-hidden="true"></i></span>
                       
                        <span id="authorize_data" href="javascript:void(0)" class="italic passordTxt" style="color: #dc3545;">Unauthorized Access &nbsp; <i class="fa fa-times" aria-hidden="true"></i></span>

                        
                        
                    </div>
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                


                    <input type="hidden" name="hash" id="hash" value="<?php echo $url;?>">
                    
                    </form>
            </div>
        




        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="<?php echo base_url();?>js/login.js" type="text/javascript"></script>
    <script type="text/javascript">
    $("span#error_data").css('display','none');
    $("span#authorize_data").css("display","none");
    $("span#error_hide").css("display","none");
</script>
</body>
</html>











