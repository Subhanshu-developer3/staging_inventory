<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title> Vendor Details </title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
      <link rel="stylesheet" href="https://inventory.deebaco.com/cvendor_detail/style/style.css" />
   </head>
   <body>
      <div class="BasicInfoPage">
      <!--========= header ==============-->
      <div class="header flex">
         <div class="logo">
            <img src="https://inventory.deebaco.com/cvendor_detail/images/logo.png" alt="" />
         </div>
         <div class="headerIcons flex">
            <a href="#" class="HeaderIcon headerBell">
               <img src="https://inventory.deebaco.com/cvendor_detail/images/notification_icon.png" alt="">
            </a>
            <a href="#" class="HeaderIcon HeaderUser">
               <img src="https://inventory.deebaco.com/cvendor_detail/images/user_login.png" alt="">
            </a>
         </div>
      </div>
      <!-- ===== side baer and basic info section ======== -->
      <div class="mainContentSection flex">
         <!-- ======== side bar section ========== -->
         <div class="mainLeft">
            <ul class="sidebarMenu robotoReguler">
               <li class="SidemenuItem upperCase ">
                  <a href="#">Fabric</a>
               </li>
               <li class="SidemenuItem upperCase"><a href="#">Inventory</a></li>
               <li class="SidemenuItem upperCase"><a href="#">Trims</a></li>
               <li class="SidemenuItem upperCase activeMenuItem"><a href="#"> Vendor</a></li>
            </ul>
         </div>
         <div class="mainRight">
            <div class="flex tabViewBtns robotoReguler">
               <a href="basicInfo.html" class="btn upperCase tabViewBtn whiteBack  upperCase">basic Info</a>
               <a href="VendorDeatlis.html" class="btn upperCase tabViewBtn  blueBtn">Vendor Details</a>
            </div>
            <!-- ===================information=================== -->
            <form action="">
               <div class="mainBasicInfoSection">
                  <div class="flex mainInfoInputS robotoReguler BasicInfoInformaiotn">
                     <div class="infoInput12 TitleInputBox upperCase flex">
                        <label for="Fabric Code" class="infoInputLabel8 labelTitle">Vendor Name</label>
                        <div class="requiredmsg infoInput8 flex flexWrap">
                           <input type="text" class="infoInputTxt upperCase  completeWidth" placeholder="Fabric Vendor PVT LTD">
                        </div>
                     </div>
                  </div>
                  <div class="vendor-detail section">
                     <p class="heading robotoMedium upperCase">Vendor Details </p>
                     <div class="flex mainInfoInputS robotoReguler BasicInfoInformaiotn">
                        <div class="maininfoInput1 TitleInputBox  upperCase flex">
                           <label for="Fabric Code" class="infoInputLabel1 labelTitle">Primary No.</label>
                           <div class="requiredmsg infoInput8 flex flexWrap">
                              <input type="text" class="infoInputTxt upperCase completeWidth"
                                 placeholder="+91 956-7564-896" />
                           </div>
                        </div>
                        <div class="maininfoInput1 TitleInputBox upperCase flex">
                           <label for="Fabric Code" class="infoInputLabel1 labelTitle">ALT No.</label>
                           <div class="requiredmsg infoInput8 flex flexWrap">
                              <input type="text" class="infoInputTxt upperCase completeWidth"
                                 placeholder="+91 852-2345-526" />
                           </div>
                        </div>
                        <div class="maininfoInput1 TitleInputBox upperCase flex">
                           <label for="Fabric Code" class="infoInputLabel1 labelTitle">Email</label>
                           <div class="requiredmsg infoInput3 flex flexWrap">
                              <input type="text" class="infoInputTxt upperCase completeWidth"
                                 placeholder="Robbit@robbit.com" />
                           </div>
                        </div>
                        <div class="maininfoInput1 TitleInputBox upperCase flex">
                           <label for="Fabric Code" class="infoInputLabel1 labelTitle">ALT Email</label>
                           <div class="requiredmsg infoInput3 flex flexWrap">
                              <input type="text" class="infoInputTxt upperCase completeWidth"
                                 placeholder="Robbit@robbit.com" />
                           </div>
                        </div>
                        <div class="maininfoInput4 TitleEditBox upperCase flex">
                           <div class="requiredmsg infoeditBox4 flex flexWrap">
                              <a href="#" class="">
                              <img src="images/edit_icon.png" alt=""> </a>
                           </div>
                        </div>
                        <div class="maininfoInput8 TitleInputBox upperCase flex">
                           <label for="Fabric Code" class="infoInputLabel8 labelTitle">Address</label>
                           <div class="requiredmsg infoInput8 flex flexWrap">
                              <input type="text" class="infoInputTxt upperCase  completeWidth"
                                 placeholder="20/561 Noida, UP" />
                           </div>
                        </div>
                        <div class="maininfoInput12 TitleInputBox upperCase flex">
                           <label for="Fabric Code" class="infoInputLabel8 labelTitle">GSTIN</label>
                           <div class="requiredmsg infoInput8 flex flexWrap">
                              <input type="text" class="infoInputTxt upperCase  completeWidth"
                                 placeholder="GST4516845AB62" />
                           </div>
                        </div>
                     </div>
                     <div class="vendor-table section">
                        <div class="flex productTable robotoReguler">
                           <div class="product--list-table">
                              <table class="admin-product--tbl">
                                 <thead class="tbl--head">
                                    <tr>
                                       <th scope="col">S.No. </th>
                                       <th scope="col">Fabric Code</th>
                                       <th scope="col">Fabric Color</th>
                                       <th scope="col">Fabric Type</th>
                                       <th scope="col">Fabric Pattern</th>
                                       <th scope="col">Date of purchase</th>
                                       <th scope="col">Qty</th>
                                       <th scope="col">Remaining Qty</th>
                                       <th scope="col">Price per MTR</th>
                                       <th scope="col">Total Price</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td class="firtsChild">01
                                       </td>
                                       <td>FB-203</td>
                                       <td>White</td>
                                       <td>Denim Fabric</td>
                                       <td> Brocade</td>
                                       <td> 21-Jan-2022</td>
                                       <td> 206 mtr</td>
                                       <td> 26 mtr</td>
                                       <td> RS.1500</td>
                                       <td> RS.20,000 </td>
                                    </tr>
                                    <tr>
                                       <td> 02
                                       </td>
                                       <td>FB-203</td>
                                       <td>Black</td>
                                       <td>Silk Fabric</td>
                                       <td> Chintz</td>
                                       <td> 21-Jan-2022</td>
                                       <td> 3005 mtr</td>
                                       <td> 18 mtr</td>
                                       <td> RS.1000</td>
                                       <td> RS.20,000</td>
                                    </tr>
                                    <tr>
                                       <td> 03
                                       </td>
                                       <td>FB-203</td>
                                       <td>RED</td>
                                       <td>Dyed Fabric</td>
                                       <td> Chintz</td>
                                       <td> 21-Jan-2022</td>
                                       <td> 10256 MTR</td>
                                       <td> 22 mtr</td>
                                       <td> RS.100</td>
                                       <td> RS.18,654</td>
                                    </tr>
                                    <tr>
                                       <td> 04
                                       </td>
                                       <td>FB-203</td>
                                       <td>RED</td>
                                       <td>Dyed Fabric</td>
                                       <td> Ditsy</td>
                                       <td> 21-Jan-2022</td>
                                       <td> 200 MTR</td>
                                       <td> 10 mtr</td>
                                       <td> RS.500</td>
                                       <td> RS.15,124</td>
                                    </tr>
                                    <tr>
                                       <td>05
                                       </td>
                                       <td>FB-203</td>
                                       <td>RED</td>
                                       <td>Dyed Fabric</td>
                                       <td> Brocade</td>
                                       <td> 21-Jan-2022</td>
                                       <td> 305 MTR</td>
                                       <td> 28 mtr</td>
                                       <td> RS.2000</td>
                                       <td> RS.12,765</td>
                                    </tr>
                                    <tr>
                                       <td> 06
                                       </td>
                                       <td>FB-203</td>
                                       <td>RED</td>
                                       <td>Dyed Fabric</td>
                                       <td> Brocade</td>
                                       <td> 21-Jan-2022</td>
                                       <td> 305 MTR</td>
                                       <td> 40 mtr</td>
                                       <td> RS.400</td>
                                       <td> RS.30,250</td>
                                    </tr>
                                    <tr>
                                       <td> 07
                                       </td>
                                       <td>FB-203</td>
                                       <td>pink</td>
                                       <td>Dyed Fabric</td>
                                       <td> Chintz</td>
                                       <td> 21-Jan-2022</td>
                                       <td> 305 MTR</td>
                                       <td> 45 mtr</td>
                                       <td> RS.500</td>
                                       <td> RS.40,000</td>
                                    </tr>
                                    <tr>
                                       <td>08
                                       </td>
                                       <td>FB-203</td>
                                       <td>Yellow</td>
                                       <td>Dyed Fabric</td>
                                       <td> Chintz</td>
                                       <td> 21-Jan-2022</td>
                                       <td> 305 MTR</td>
                                       <td> 50 mtr</td>
                                       <td> RS.1000</td>
                                       <td> RS.35,400</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </body>
</html>