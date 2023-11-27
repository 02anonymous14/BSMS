<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  $sername=$_POST['sername'];
  $cost=$_POST['cost'];

  $eid=$_SESSION['edid'];
  $query=mysqli_query($con, "update  tblservices set ServiceName='$sername',Cost='$cost' where Services_ID='$eid' ");
  if ($query) {
    //$msg="Service has been Updated.";
    echo '<script>alert("Service has been updated")</script>';
  }
  else
  {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
    //$msg="Something Went Wrong. Please try again";
  }
}
?> 

<h4 class="card-title">Update Service Form </h4>
<form role="form" method="post">
  <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
  <?php
    $eid=$_POST['edit_id'];
    $ret=mysqli_query($con,"select * from  tblservices where Services_ID='$eid'");
    $cnt=1;
    
    while ($row=mysqli_fetch_array($ret))
    {
      $_SESSION['edid']=$row['Services_ID'];
  ?> 
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Service Name</label>
        <input type="text" class="form-control" id="sername" name="sername" placeholder="Service Name" value="<?php  echo $row['ServiceName'];?>" required="true">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Cost</label>
        <input type="text" id="cost" name="cost" class="form-control" placeholder="Cost" value="<?php  echo $row['Cost'];?>" required="true">
      </div>
      <?php 
    } ?>
    <div class="card-footer">
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      <span style="float: right;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </span>
    </div>
  </div>
  <!-- /.card-body -->
</form>