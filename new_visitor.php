<?php
include('includes/checklogin.php');

check_login();
if (isset($_POST['save'])) {
  $addressby = $_POST['addressby'];
  $fullname = $_POST['fullname'];
  $mobnumber = $_POST['mobilenumber'];
  $nic = $_POST['nic'];
  $address = $_POST['address'];
  $meet = $_POST['whomtomeet'];
  $department = $_POST['department'];
  $reason = $_POST['reasontomeet'];
  $gndivision = $_POST['gndivision'];
  $electionseat = $_POST['electionseat'];
  $coordinatearea = $_POST['coordinatearea'];
  $birthday = $_POST['dateofbirth'];
  $polldevision = $_POST['polldevision'];
  $dataremark = $_POST['dataremark'];
  $sql = "insert into tblvisitor(AddressBy,FullName,Nic,MobileNumber,DateOfBirth,Address,WhomtoMeet,Deptartment,ReasontoMeet,GnDevision,Electionseat,CoArea,PollDevision,DataRemark) value(:addressby,:fullname,:nic,:mobnumber,:birthday,:address,:meet,:department,:reason,:gndivision,:electionseat,:coordinatearea,:polldevision,:dataremark)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':addressby', $addressby, PDO::PARAM_STR);
  $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
  $query->bindParam(':nic', $nic, PDO::PARAM_STR);
  $query->bindParam(':mobnumber', $mobnumber, PDO::PARAM_STR);
  $query->bindParam(':address', $address, PDO::PARAM_STR);
  $query->bindParam(':meet', $meet, PDO::PARAM_STR);
  $query->bindParam(':department', $department, PDO::PARAM_STR);
  $query->bindParam(':reason', $reason, PDO::PARAM_STR);
  $query->bindParam(':gndivision', $gndivision, PDO::PARAM_STR);
  $query->bindParam(':electionseat', $electionseat, PDO::PARAM_STR);
  $query->bindParam(':coordinatearea', $coordinatearea, PDO::PARAM_STR);
  $query->bindParam(':birthday', $birthday, PDO::PARAM_STR);
  $query->bindParam(':polldevision', $polldevision, PDO::PARAM_STR);
  $query->bindParam(':dataremark', $dataremark, PDO::PARAM_STR);
  $query->execute();
  $LastInsertId = $dbh->lastInsertId();
  if ($LastInsertId > 0) {
    echo '<script>alert("Registered successfully")</script>';
    echo "<script>window.location.href ='new_visitor.php'</script>";
  } else {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }


  // sms gateway start here


  // $user = "94773102373";
  // $password = "6133";
  // $text = urlencode("Sugeeshwara Bandara: Thankyou Mr.{$fullname} for Registered with SubhaManpetha. Your Inquiry is been Processed. Please be kind enough to contact +94777712345
  // give us feedback");
  // $to = "$mobnumber";

  // $baseurl = "http://www.textit.biz/sendmsg";
  // $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
  // $ret = file($url);

  // $res = explode(":", $ret[0]);

  // if (trim($res[0]) == "OK") {
  //   echo '<script>alert("Message Sent - ID : ".$res[1])</script>';
  // } else {
  //   echo "Sent Failed - Error : " . $res[1];
  // }




  // $user = "grandmasterminds";
  // $password = "Grand@123";
  // $text = urlencode("Sugeeshwara Bandara: Thankyou Mr.{$fullname} for Registered with SubhaManpetha. Your Inquiry is been Processed. Please be kind enough to contact +94777712345
  // give us feedback");
  // $to = "$mobnumber";

  // $baseurl = "https://api.dialog.lk/sms/send";
  // $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
  // $ret = file($url);

  // $res = explode(":", $ret[0]);

  // if (trim($res[0]) == "OK") {
  //   echo '<script>alert("Message Sent - ID : ".$res[1])</script>';
  // } else {
  //   echo "Sent Failed - Error : " . $res[1];
  // }

  require('PHP-SMS-API-lib-main/send_sms_impl.php');


  $sendSmsImpl = new SendSMSImpl();
  $tokenBody = new TokenBody();

  $tokenBody->setUsername("grandmasterminds");
  $tokenBody->setPassword("Grand@123");

  $sendTextBody = new SendTextBody();

  // $sendTextBody->setSourceAddress("https://e-sms.dialog.lk/api/v2/sms");
  $sendTextBody->setMsisdn($sendSmsImpl->setMsisdns(array("$mobnumber")));

  $sendTextBody->setTransactionId("157");

  $sendTextBody->setMessage("{$addressby} {$fullname} 
සුභ මංපෙත සමඟ ලියාපදිංචි වු ඔබට ස්තුතියි.
ඔබගේ ඉල්ලීම සිදුවෙමින් පවතී. 
විමසීම් - {$coordinatearea}  

~ සුගීෂ්වර බණ්ඩාර ~
   ");

  $transactionBody = new TransactionBody();
  $transactionBody->setTransactionId("157");


  $response = $sendSmsImpl->sendText($sendTextBody, $sendSmsImpl->getToken($tokenBody)->getToken())->getData()->getUserId();
}

?>







<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php"); ?>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php @include("includes/header.php"); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php @include("includes/sidebar.php"); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="modal-header">
                  <h5 class="modal-title" style="float: left;">Register Visitor</h5>
                </div>
                <div class="col-md-12 mt-4">
                  <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row ">

                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Mr / Mrs / Reverend</label>
                        <!-- <input type="text" id="reasontomeet" name="reasontomeet" placeholder="Reason To Meet" class="form-control" required=""> -->
                        <select class="form-control" name="addressby" id="dignity" required>
                          <!-- <option selected>Mr.</option> -->
                          <option value="Mr.">Mr.</option>
                          <option value="Mrs.">Mrs. </option>
                          <option value="Ms.">Ms. </option>
                          <option value="Rev.">Reverend </option>


                        </select>
                      </div>


                      <div class="form-group col-md-6 ">
                        <label for="exampleInputPassword1">Full Names</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Full Name" class="form-control" required="">
                      </div>



                    </div>

                    <div class="row ">



                      <div class="form-group col-md-6  ">
                        <label for="exampleInputPassword1">Address</label>
                        <textarea name="address" id="address" rows="6" placeholder="Enter Visitor Address..." class="form-control" required=""></textarea>
                      </div>


                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">NIC</label>
                        <input type="text" id="email" name="nic" placeholder="Enter NIC" class="form-control" maxlength="12" required="">
                      </div>




                    </div>


                    <div class="row ">



                      <div class="form-group col-md-6 ">
                        <label for="exampleInputPassword1">Contact Number</label>
                        <input type="text" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number" class="form-control" maxlength="10" required="">
                      </div>


                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Date Of Birth</label>
                        <input type="date" id="dateofbirth" name="dateofbirth" placeholder="Date Of Birth" class="form-control" required="">
                      </div>









                    </div>



                    <div class="row ">






                      <div class="form-group col-md-6 ">
                        <label for="exampleInputPassword1">District</label>


                        <!-- <input type="text" id="department" name="department" placeholder="Department" class="form-control" required=""> -->
                        <select class="form-control" name="department" id="dignity" required>
                          <option value="Colombo">Colombo </option>
                          <option value="Gampaha">Gampaha</option>
                          <option value="Kaluthara">Kaluthara</option>
                          <!-- <option value="Kandy">Kandy</option>
                          <option value="Matale">Matale</option>
                          <option value="Nuwara Eliya">Nuwara Eliya</option>
                          <option value="Galle">Galle</option>
                          <option value="Matara">Matara</option>
                          <option value="Hambantota">Hambantota</option>
                          <option value="Jaffna">Jaffna</option>
                          <option value="Kilinochchi">Kilinochchi</option>
                          <option value="Mannar">Mannar</option>
                          <option value="Vavuniya">Vavuniya</option>
                          <option value="Mullaitivu">Mullaitivu</option>
                          <option value="Batticaloa">Batticaloa</option>
                          <option value="Ampara">Ampara</option>
                          <option value="Trincomalee">Trincomalee</option>
                          <option value="Kurunegala">Kurunegala</option>
                          <option value="Puttalam">Puttalam</option>
                          <option value="Anuradhapura">Anuradhapura</option>
                          <option value="Polonnaruwa">Polonnaruwa</option>
                          <option value="Badulla">Badulla</option>
                          <option value="Moneragala">Moneragala</option>
                          <option value="Kegalle">Kegalle</option> -->
                        </select>

                      </div>




                      <div class="form-group col-md-6 ">
                        <label for="exampleInputPassword1">Election Seat</label>
                        <input type="text" id="electionseat" name="electionseat" placeholder="Election Seat" class="form-control">
                      </div>










                    </div>


                    <div class="row ">









                      <div class="form-group col-md-6 ">
                        <label for="exampleInputPassword1">Polling Division</label>
                        <input type="text" id="polldevision" name="polldevision" placeholder="Polling Devision" class="form-control">
                      </div>


                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Grama Niladari Division</label>
                        <input type="text" id="gndivision" name="gndivision" placeholder="Grama Niladari Division" class="form-control">
                      </div>











                    </div>
                    <div class="row ">


                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Reason To Meet </label>
                        <input type="text" id="reasontomeet" name="reasontomeet" placeholder="Reason To Meet" class="form-control">
                      </div>



                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Contact By Who</label>
                        <input type="text" id="whomtomeet" name="whomtomeet" placeholder="Contact By Who" class="form-control">
                      </div>

                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Coordiated By</label>
                        <!-- <input type="text" id="reasontomeet" name="reasontomeet" placeholder="Reason To Meet" class="form-control" required=""> -->
                        <select class="form-control" name="coordinatearea" id="dignity" required>
                          <!--<option selected>Cordinator</option>-->
                          <option value="Uchitha Sandamal">1 - Awissawella - Uchitha Sandamal</option>
                          <option value="Amila Cooray">2 - Dehiwala - Amila Cooray</option>
                          <option value="Kushan Madamayake">3 - Borella - Kushan Madamayake</option>
                          <option value="Rukman De Soisa">4 - Colombo East - Mr. Rukman De Soisa</option>
                          <!-- <option value="Rukman De Soisa">4 - Colombo North - Mr. </option>
                          <option value="Rukman De Soisa">4 - Colombo Central - Mr. </option> 
                          <option value="Rukman De Soisa">4 - Colombo West - Mr. </option>
                          <option value="Rukman De Soisa">4 - Kolonnawa - Mr. </option>
                          <option value="Rukman De Soisa">4 - Kaduwela - Mr. </option>
                          <option value="Rukman De Soisa">4 - Homagama - Mr. </option> -->
                          <option value="Pubudu Madushan">5 - Ratmalana - Mr. Pubudu Madushan</option>
                          <option value="Vimukthi Jayasooriya">6 - Kotte - Mr. Vimukthi Jayasooriya</option>
                          <option value="Manoj Ranga">7 - Maharagama - Mr. Manoj Ranga</option>
                          <option value="Anura Karunarathne">8 - Kesbewa - Mr. Anura Karunarathne</option>
                          <option value="Samitha Thero">9 - Moratuwa - Ven. Samitha Thero</option>

                          <!-- <option value="5">Colombo 5 - Narahenpita</option>
                       <option value="6">Colombo 6 - Wellawatta</option>
                       <option value="7">Colombo 7 - Cinnamon Garden</option>
                       <option value="8">Colombo 8 - Borella</option>
                       <option value="9">Colombo 9 - Dematagoda</option>
                       <option value="10">Colombo 10 - Maradana</option>
                       <option value="11">Colombo 11 - Pettah</option>
                       <option value="12">Colombo 12 - Aluthkade</option>
                       <option value="13">Colombo 13 - Kotahena</option>
                       <option value="14">Colombo 14 - Grandpass</option>
                       <option value="15">Colombo 15 - Mattakkuliya</option> -->
                        </select>
                      </div>












                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Remark</label>
                        <input type="text" id="dataremark" name="dataremark" placeholder="Remark" class="form-control">
                      </div>
















                    </div>

                    <button type="submit" style="float: left;" name="save" class="btn btn-info  mr-2 mb-4">Save</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php @include("includes/footer.php"); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <?php @include("includes/foot.php"); ?>
  <!-- End custom js for this page -->
</body>

</html>