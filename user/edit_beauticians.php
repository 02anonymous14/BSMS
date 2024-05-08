<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
{
  $bname=$_POST['bname'];
  $bphone=$_POST['bphone'];
  $bemail=$_POST['bemail'];
  $bexpertise=$_POST['bexpertise'];
  $eid=$_SESSION['edid'];

  $query=mysqli_query($con,"update tblbeauticians set Name='$bname', Phone='$bphone', Email='$bemail', Department='$bexpertise' where Beautician_ID='$eid' ");
  // $query1=mysqli_query($con,"UPDATE `tblbeautician_expertise` SET `Services_ID` ='$bexpertise' WHERE Beautician_ID='$eid' ");

  if ($query) {
    //$msg="Service has been Updated.";
    echo '<script>alert("Beautician has been updated")</script>';
    echo "<script>window.location.href = 'manage_beauticians.php'</script>"; 
  }
  else
  {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
    //$msg="Something Went Wrong. Please try again";
  }
}
?> 
  
<h4 class="card-title">Update Beautician Form </h4>

<form role="form" method="post">
  <p style="font-size:16px; color:red" align="center"> <?php if($msg){ echo $msg; } ?> </p>
  <?php
    $eid=$_POST['edit_id'];
    $ret=mysqli_query($con,"select * from  tblbeauticians where Beautician_ID='$eid'");
    $cnt=1;
    
    while ($row=mysqli_fetch_array($ret))
    {
      $_SESSION['edid']=$row['Beautician_ID'];
  ?> 

    <div class="card-body">
    <div class="form-group">
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" id="bname" name="bname" placeholder="Name" value="<?php  echo $row['Name'];?>" required="true">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Phone</label>
        <input type="text" class="form-control" id="bphone" name="bphone" placeholder="Phone" value="<?php  echo $row['Phone'];?>" required="true">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="text" class="form-control" id="bemail" name="bemail" placeholder="Email" value="<?php  echo $row['Email'];?>" required="true">
        <div class="form-group">
          <label for="exampleInputPassword1">Department</label>
          <select class="form-control" id="Expertise" name="bexpertise" >

            <?php 
              $allservices = mysqli_query($con,"SELECT DISTINCT Category FROM tblservices");
              while ($services = mysqli_fetch_array($allservices)):;
            ?>
              
              <option value="<?php echo $services["Category"]; ?>">
                <?php echo $services["Category"];?>
              </option> 

            <?php
                endwhile;
            ?>

          </select> 
          <!-- <input type="text" class="form-control" id="Expertise" name="bexpertise" placeholder="Enter Services"> -->
        </div>  
      <?php
    } 
    ?>
    <div class="card-footer">
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      <span style="float: right;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </span>
    </div>
  </div>
  <!-- /.card-body -->
</form>