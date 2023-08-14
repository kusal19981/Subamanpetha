<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_POST['update'])) {
  $eid = $_SESSION['editid'];
  $remark = $_POST['remark'];
  // $Filename = $_POST['Filename'];


  $query = mysqli_query($con, "update tblvisitor set remark='$remark' where  ID='$eid'");
  if ($query) {
    echo '<script>alert("Visitors Remark  has been Updated.")</script>';
    echo "<script>window.location.href ='manage_visitor.php'</script>";
  } else {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }
}



if (isset($_POST['updatepdf'])) {
  $eid = $_SESSION['editid'];

  $Filename = $_FILES['file']['name'];
  $FileTmpName = $_FILES['file']['tmp_name'];


  $upload_to = "uploads/" . $Filename;



  $query = mysqli_query($con, "update tblvisitor set  Filename='$Filename' where  ID='$eid'");
  if ($query) {
    move_uploaded_file($FileTmpName, $upload_to);
    echo '<script>alert("Visitors PDF has been Updated.")</script>';
  } else {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }
}

?>




<div class="card-body" id="visitordetail">
  <?php
  $eid = $_POST['edit_id5'];
  $sql = "SELECT * from tblvisitor  where ID=:eid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    foreach ($results as $row) {
      $_SESSION['editid'] = $row->ID; ?>

      <h4 style="color: blue">Visitor Information</h4>
      <table border="1" class="table table-bordered">
        <tr>
          <th>Full Names</th>
          <td><?php echo $row->AddressBy . " " . $row->FullName; ?></td>
        </tr>
        <tr>
          <th>NIC</th>
          <td><?php echo $row->Nic; ?></td>
        </tr>
        <tr>
          <th>Mobile Number</th>
          <td><?php echo $row->MobileNumber; ?></td>
        </tr>
        <tr>

        <tr>
          <th> <wbr> Co-ordinator</th>
          <td><?php echo $row->CoArea; ?></td>
        </tr>

        <th>Address</th>
        <td><?php echo $row->Address; ?></td>
        </tr>
        <tr>
          <th> <wbr> Contact By Who</th>
          <td><?php echo $row->WhomtoMeet; ?></td>
        </tr>
        <tr>
          <th>District</th>
          <td><?php echo $row->Deptartment; ?></td>
        </tr>
        <tr>
          <th> <wbr> Reason To Meet</th>
          <td><?php echo $row->ReasontoMeet; ?></td>
        </tr>









        <!-- download uploaded pdf start here -->

        <?php if ($row->Filename != "") { ?>
          <tr>
            <th> <wbr>Uploaded Letters</th>
            <td> <?php echo $row->Filename; ?>
              <!-- <i class="mdi mdi-download menu-icon"> -->

              <!-- <?php

                    $query2 = "select Filename from tblvisitor  where  ID='$eid'";
                    $run2 = mysqli_query($conn, $query2);


                    ?> -->


              <a href="download.php?file=<?php echo $row->Filename; ?>">Download File</a></i>
            </td>


          </tr>
        <?php
        } ?>



        <!-- upload pdf start here -->


        <tr>
          <th>Upload New Letter</th>
          <td>

            <form method="post" enctype="multipart/form-data">
              <input type="file" name="file" id="file" accept=".pdf">

              <button type="submit" name="updatepdf">Upload</button>

            </form>
          </td>
        </tr>





        <!-- upload pdf ends here -->


        <tr>
          <th>Visitor Entering Time</th>
          <td><?php echo $row->EnterDate; ?></td>
        </tr>

        <?php if ($row->DataRemark != "") { ?>
          <tr>
            <th>1st Remark </th>
            <td><?php echo $row->DataRemark; ?></td>
          </tr>
        <?php
        } ?>


        <?php if ($row->remark != "") { ?>
          <tr>
            <th>Approved Remark </th>
            <td><?php echo $row->remark; ?></td>
          </tr>


          <tr>
            <th>Approved Time</th>
            <td><?php echo $row->outtime; ?> </td>
          </tr>
        <?php
        } ?>


      </table>





      <?php if ($row->remark == "") { ?>
        <div class="card pt-4">
          <form method="post">

            <div class="row col-md-6 form-group">






              <label for="exampleInputPassword1">Enter Approved Remarks</label>
              <textarea name="remark" placeholder="Enter Approved Remarks" rows="4" cols="8" class="form-control wd-450" required="true"></textarea>



              <button type="submit" name="update" class="btn btn-primary btn-sm mt-4">Update</button>
            </div>


            <!-- <button type="submit" name="update">Upload</button>
                  <i class=" mdi mdi-file-pdf"></i> -->






          </form>
        </div>


  <?php
      }
    }
  } ?>



  <form method="POST" action="pdf.php" target="_blank">
    <input type="submit" name="pdf_creator" class="btn btn-primary btn-sm mt-5" value="Download Report">

  </form>
</div>