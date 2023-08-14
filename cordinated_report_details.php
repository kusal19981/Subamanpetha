<?php
include('includes/checklogin.php');
check_login();
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
                  <h5 class="modal-title" style="float: left;">Coordinator Wise Reports</h5>
                </div>
                <div class="col-md-12 mt-4">
                  <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row ">
                      <!-- <div class="form-group col-md-6 ">
                    <label for="exampleInputPassword1">Select Coordinator</label>
                    <input type="date" id="fromdate" name="fromdate" value="" class="form-control" required="">
                  </div> -->



                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Coordiated By</label>
                        <select class="form-control" name="coordinatearea" id="dignity" required>
                          <option selected value="CoArea">Select All Cordinators</option>
                          <option value="Uchitha Sandamal">1 - Awissawella - Uchitha Sandamal</option>
                          <option value="Amila Cooray">2 - Dehiwala - Amila Cooray</option>
                          <option value="Kushan Madamayake">3 - Colombo - Kushan Madamayake</option>
                          <option value="Chathuranga Malshan">4 - Moratuwa - Chathuranga Malshan</option>

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
                        <label for="exampleInputName1">Inquiry Status</label>
                        <select class="form-control" name="inquiry" id="inquiry" required>
                          <option selected>Cordinated Area</option>
                          <option value="NULL">Pending</option>
                          <option value="NOT NULL">Approved</option>

                          <!-- <option value="IS NULL">Pending</option> -->

                        </select>
                      </div>

                      <!-- <div class="form-group col-md-6">
                    <label for="exampleInputName1">To Date </label>
                    <input type="date" id="todate" name="todate" value="" class="form-control" required="">
                  </div> -->
                    </div>

                    <button type="submit" style="float: left;" name="search" id="submit" class="btn btn-primary btn-sm  mb-4">Search</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <!--  start  modal -->
                <div id="editData5" class="modal fade">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">View Visitor details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" id="info_update5">
                        <?php @include("view_visitor_details.php"); ?>
                      </div>
                      <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>







                      </div>







                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                </div>
                <!--   end modal -->
                <?php
                if (isset($_POST['search']) & !empty($_POST['coordinatearea'])) {
                ?>
                  <div class="table-responsive p-3">
                    <form method="POST" action="pdf.php" target="_blank">
                      <?php
                      $fdate = $_POST['coordinatearea'];
                      $Idate = $_POST['inquiry'];

                      ?>
                      <h5 align="center" style="color:blue">Report Of Co-ordinator <?php echo $fdate ?>



                        <input type="submit" name="pdf_creator" class="btn btn-primary btn-sm mt-5" value="Download Report">




                        <select class="form-control" name="coordinatearea" id="dignity" required>
                          <option selected value="CoArea">Select All Cordinators</option>
                          <option value="Uchitha Sandamal">1 - Awissawella - Uchitha Sandamal</option>
                          <option value="Amila Cooray">2 - Dehiwala - Amila Cooray</option>
                          <option value="Kushan Madamayake">3 - Colombo - Kushan Madamayake</option>
                          <option value="Chathuranga Malshan">4 - Moratuwa - Chathuranga Malshan</option>
                        </select>



                        <select class="form-control" name="inquiry" id="inquiry" required>
                          <option selected>Cordinated Area</option>
                          <option value="NULL">Pending</option>
                          <option value="NOT NULL">Approved</option>

                          <!-- <option value="IS NULL">Pending</option> -->

                        </select>


                    </form>




                    </h5>
                    <hr />
                    <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th>Full Name</th>
                          <th>Contact Number</th>
                          <th>Coordinator</th>
                          <th>Reason To Meet</th>
                          <th>Reg Date</th>

                          <th class=" Text-center" style="width: 15%;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "select * from tblvisitor where CoArea = '$fdate' and remark IS $Idate ";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                          foreach ($results as $row) {
                        ?>
                            <tr>
                              <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                              <td class=""><?php echo htmlentities($row->FullName); ?></td>
                              <td class="text-center">0<?php echo htmlentities($row->MobileNumber); ?></td>
                              <td class="text-center"><?php echo htmlentities($row->CoArea); ?></td>
                              <td class="text-center"><?php echo htmlentities($row->ReasontoMeet); ?></td>
                              <td class="text-center"><?php echo htmlentities(date("d-m-Y", strtotime($row->EnterDate))); ?></td>
                              <td class=" text-center">
                                <a href="#" class=" edit_data5" id="<?php echo ($row->ID); ?>" title="click to view">&nbsp;<i class="mdi mdi-eye" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                        <?php
                            $cnt = $cnt + 1;
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>

                <?php
                } else {
                ?>
                  <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th>Full Name</th>
                          <th>Contact Number</th>
                          <th>Coordinator</th>
                          <th>Reason To Meet</th>
                          <th>Reg Date</th>

                          <th class=" Text-center" style="width: 15%;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * from tblvisitor ORDER BY id DESC";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                          foreach ($results as $row) {
                        ?>
                            <tr>
                              <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                              <td class=""><?php echo htmlentities($row->FullName); ?></td>
                              <td class="text-center">0<?php echo htmlentities($row->MobileNumber); ?></td>
                              <td class="text-center"><?php echo htmlentities($row->CoArea); ?></td>
                              <td class="text-center"><?php echo htmlentities($row->ReasontoMeet); ?></td>
                              <td class="text-center"><?php echo htmlentities(date("d-m-Y", strtotime($row->EnterDate))); ?></td>

                              <td class=" text-center">
                                <a href="#" class=" edit_data5" id="<?php echo ($row->ID); ?>" title="click to view">&nbsp;<i class="mdi mdi-eye" aria-hidden="true"></i></a>
                              </td>

                            </tr>
                        <?php
                            $cnt = $cnt + 1;
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>

                <?php
                } ?>

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
  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '.edit_data5', function() {
        var edit_id5 = $(this).attr('id');
        $.ajax({
          url: "view_visitor_details.php",
          type: "post",
          data: {
            edit_id5: edit_id5
          },
          success: function(data) {
            $("#info_update5").html(data);
            $("#editData5").modal('show');
          }
        });
      });
    });
  </script>


</body>

</html>