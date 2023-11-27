<?php

session_start();
error_reporting(0);

include('includes/dbconnection.php');

if(isset($_POST['save2'])){

  $cid=$_SESSION['aid'];
  $remark=$_POST['remark'];
  $status=$_POST['status'];
  $beautician=$_POST['beautician'];

  $invoiceid=mt_rand(100000000, 999999999); 
  
  $getapp=mysqli_query($con,"SELECT `Beautician`,`Services` FROM `tblappointment` where Appointment_ID='$cid'");
  $getappservice=mysqli_fetch_array($getapp);
  $clientservice = $getappservice['Services']; 
  $selectedbeautician = $getappservice['Beautician']; 

  $srvicesID = mysqli_query($con, "SELECT `Services_ID` FROM `tblservices` WHERE `ServiceName`= '$clientservice'");  
  $getserviceID = mysqli_fetch_array($srvicesID);
  $resServiceID = $getserviceID['Services_ID'];

    if($_POST['status'] == '2'){

      $query=mysqli_query($con, "update tblappointment set Remark='$remark',Status='$status',Beautician='$beautician' where Appointment_ID='$cid'");
      if ($query){

        echo "<script>alert('Updated Successfuly');</script>"; 
        echo "<script>window.location.href = 'new_appointment.php'</script>";

      }else{

        echo "<script>alert('Something Went Wrong. Please try again.');</script>";

      }
      
    }elseif($_POST['status'] == '1'){
      $query=mysqli_query($con, "update tblappointment set Remark='$remark',Status='$status' where Appointment_ID='$cid'");
      $query1=mysqli_query($con,"INSERT INTO tblinvoice_from_onlineappointment(beautician, Services_ID,BillingId,invoicefrom,Appointment_ID,Paymentstatus) VALUES('$selectedbeautician','$resServiceID','$invoiceid','ONLINE APPOINTMENT','$cid','UNPAID');");

      if ($query && $query1){

        echo "<script>alert('Updated Successfuly');</script>"; 
        echo "<script>window.location.href = 'new_appointment.php'</script>";

      }else{

        echo "<script>alert('Something Went Wrong. Please try again.');</script>";

      }
    } 
}   

?>

  <div class="tables" id="exampl" class="card-body">
    <?php
    $cid=$_POST['edit_id'];
    $ret=mysqli_query($con,"select * from tblappointment where Appointment_ID='$cid'");
    $cnt=1;
    while ($row=mysqli_fetch_array($ret)){
      $_SESSION['aid']=$row['Appointment_ID'];

      ?>
      <table class="table table-bordered" width="100%" border="1">
        <tr>
          <th>Appointment Number</th>
          <td><?php  echo $row['AptNumber'];?></td>
        </tr>

        <tr>
          <th>Name</th>
          <td><?php  echo $row['Name'];?></td>
        </tr>

        <tr>
          <th>Email</th>
          <td><?php  echo $row['Email'];?></td>
        </tr>

        <tr>
          <th>Mobile Number</th>
          <td><?php  echo $row['PhoneNumber'];?></td>
        </tr>

        <tr>
          <th>Appointment Date</th>
          <td><?php  echo $row['AptDate'];?></td>
        </tr>

        <tr>
          <th>Appointment Time</th>
          <td><?php  echo $row['AptTime'];?></td>
        </tr>

        <tr>
           
            <th>Beautician</th>
            <td><?php  echo $row['Beautician'];?></td>
           
        </tr>

        <tr>
          <th>Services</th>
          <td><?php  echo $row['Services'];?></td>
        </tr>

        <tr>
          <th>Apply Date</th>
          <td><?php  echo $row['ApplyDate'];?></td>
        </tr>  

        <tr>
          <th>Status</th>
          <td>  
            <?php  
              $status = mysqli_query($con,"select * from tblappointment where Appointment_ID='$cid'");
              $getstatus = mysqli_fetch_array($status);
              if($getstatus['Status']=="1"){
                echo "Accepted";
              }elseif($getstatus['Status']=="2")
              {
                echo "Rejected";
              }else{
                echo "Pending";
              }
            ;?>
          </td>
        </tr>
        
        <!--  -->
        <tr> 
          <?php if($row['Remark']==""){ ?>
            <td colspan="2">
              <div class="container">
                  
                <form name="update" method="post" enctype="multipart/form-data" > 
                  
                  <div class="row">
                    <label>Remarks :</label>
                    <textarea name="remark" placeholder="" rows="4" cols="6" class="form-control wd-450" required="true"></textarea>
                  </div>

                  <div class="row mb-3">
                    <label>Mark As :</label>
                    <select name="status" class="form-control wd-450" required="true" >
                      <option value="1" selected="true">Accepted</option>
                      <option value="2">Rejected</option>
                    </select>
                  </div> 
                  
                  <div class="row centered"> 
                    <button type="submit" name="save2" class="btn btn-primary mx-auto">Submit</button> 
                  </div> 
                </form>

              </div>
            
            </td>

          <?php } else { ?>
  
              <tr>
                <th>Remarks</th>
                <td><?php echo $row['Remark']; ?></td>
              </tr> 

              <tr>
                <th>Remark date</th>
                <td><?php echo $row['RemarkDate']; ?></td>
              </tr>   
            
          <?php } ?>
        </tr>
      </table>

      <?php if($row['Remark']==""){ ?>
        <!-- <div class="container">
            
          <form name="update" method="post" enctype="multipart/form-data" >
            
            <div class="row mb-3">
              <label>Beautician :</label>
              <select name="beautician" class="form-control wd-450" required="true" >
                <?php 
                  $beauticianlist = mysqli_query($con,"SELECT `Name` FROM tblbeauticians");
                  while ($allbeautician = mysqli_fetch_array($beauticianlist)):;
                ?>
                  <option value="<?php echo $allbeautician["Name"]; ?>">
                    <?php echo $allbeautician["Name"];?>
                  </option> 

                <?php
                    endwhile;
                ?> 
              </select>
            </div>
            
            <div class="row">
              <label>Remarks :</label>
              <textarea name="remark" placeholder="" rows="4" cols="6" class="form-control wd-450" required="true"></textarea>
            </div>

            <div class="row mb-3">
              <label>Mark As :</label>
              <select name="status" class="form-control wd-450" required="true" >
                <option value="1" selected="true">Accepted</option>
                <option value="2">Rejected</option>
              </select>
            </div>
            
            <div class="row centered">
              <button type="submit" name="save2" class="btn btn-primary">Submit</button>
            </div>

          </form>

        </div> -->

        <?php } else { ?>

          <!-- <table class="table table-bordered" width="100%" border="1">
            <tr>
              <th>Remarks</th>
              <td><?php echo $row['Remark']; ?></td>
            </tr> 

            <tr>
              <th>Remark date</th>
              <td><?php echo $row['RemarkDate']; ?></td>
            </tr> 
          </table> -->

          <p style="margin-top:1%" align="center">
            <i class="fa fa-print fa-2x" style="cursor: pointer;"  OnClick="CallPrint(this.value)" ></i>
          </p>
          
        <?php }
     } 
        ?>
  </div>

<script>
	function CallPrint(strid){
		var prtContent = document.getElementById("exampl");
		var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
</script>