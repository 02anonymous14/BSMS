<?php
  session_start();
  error_reporting(0);

  include('includes/dbconnection.php');

  if(isset($_POST['save'])){

    $uid=$_SESSION['gid'];
    $invoiceid=mt_rand(100000000, 999999999);
    $sid=$_POST['sids'];
    $btcan=$_POST['beautician']; 
 
    $array = $btcan; 
    $result = array_filter($array, function ($value) { 
        return !empty($value);
    });
 
    $result = array_values($result);
 
    // for($i=0;$i<count($result);$i++){
    //   echo '<script>alert("'.$i.'"+" beauticians "+"'.$result[$i].'")</script>';
    // }

    for($i=0;$i<count($sid);$i++){
      $svid=$sid[$i];
      $btcan1 = $result[$i];
      $ret=mysqli_query($con,"insert into tblinvoice(beautician,Customers_ID,Services_Id,BillingId,invoicefrom,Paymentstatus) values('$btcan1','$uid','$svid','$invoiceid','WALK IN CLIENT','UNPAID');");
      echo '<script>alert("Invoice created successfully. Invoice number is "+"'.$invoiceid.'")</script>';
      echo "<script>window.location.href ='invoices.php'</script>";
    }
  }
?>

<div class="card-body ">
  <h4>Assign Services:</h4>
  <form method="post">
    <table class="table table-bordered"> 
      <thead>
       <tr>
        <th>#</th> <th>Service Name</th> <th>Service Price</th> <th>Beatician</th> <th>Action</th> 
      </tr> 
    </thead> 
    <tbody>
      <?php
      $eid=$_POST['edit_id'];
      $ret=mysqli_query($con,"select * from  tblcustomers where Customers_ID='$eid'");
      $cnt=1;
      while ($row=mysqli_fetch_array($ret)) 
      {
        $_SESSION['gid']=$row['Customers_ID'];
      }
      $ret=mysqli_query($con,"select * from  tblservices");
      $cnt=1;  
      while ($row=mysqli_fetch_array($ret)) {
        $crntsrvsID = $row['Services_ID']; 

        ?>
        
          <tr> 
            <th scope="row"><?php echo $cnt;?></th> 
            <td><?php echo $row['ServiceName'];?></td> 
            <td><?php echo $row['Cost'];?></td> 
            <td>
              <select name="beautician[]" class="form-control wd-450" id="<?= $cnt ?>" onchange="checkCheckbox(this)">
              <option value=""></option> 
                <?php 
                  $getcategory = mysqli_query($con,"SELECT DISTINCT Category FROM tblservices WHERE Services_ID ='$crntsrvsID'");
                  $categoryrow = mysqli_fetch_array($getcategory);
                  $category = $categoryrow['Category']; 
  
                  // $beauticianlist = mysqli_query($con,"SELECT	NAME FROM beautician_with_services WHERE Services_ID ='$crntsrvsID'");
                  $beauticianlist = mysqli_query($con,"SELECT `Name` FROM tblbeauticians where Department='$category'");
                  while ($allbeautician = mysqli_fetch_array($beauticianlist)):;
                ?>

                  <option value="<?php echo $allbeautician["Name"]; ?>">
                    <?php echo $allbeautician["Name"];?>
                  </option> 

                <?php
                    endwhile;
                ?> 
              </select>
            </td>
            <td><input type="checkbox" id="checkbox<?= $cnt ?>" name="sids[]" value="<?php  echo $row['Services_ID'];?>" ></td>
          </tr>   

        <?php 
        $cnt=$cnt+1;
      }?>

      <tr>
        <td colspan="4" align="center">
          <button type="submit" name="save" class="btn btn-success">Submit</button>   
        </td>
      </tr>
    </tbody> 
  </table> 
</form>
</div>
<script>
function checkCheckbox(selectElement,num) { 
    var selectedBoxid = selectElement.id 
    var checkbox = document.getElementById('checkbox' + selectedBoxid);
    console.log(selectedBoxid); 
    checkbox.checked = (selectElement.value !== '');
}
</script>
  <!-- /.card-body -->