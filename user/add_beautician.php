<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
  header('location:logout.php');
} else{
  if(isset($_POST['submit']))
  {
    $bname=$_POST['bname'];
    $bphone=$_POST['bphone'];
    $bemail=$_POST['bemail'];
    $bexpertise=$_POST['bexpertise'];  
    // $query=mysqli_query($con, "insert into tblbeauticians(Name, Phone, Email, Expertise) value('$bname','$bphone','$bemail','$bexpertise')");
    
    $query=mysqli_query($con, "insert into tblbeauticians(Name, Phone, Email, Department) value('$bname','$bphone','$bemail','$bexpertise')");
    $last_id = mysqli_insert_id($con); 
     
    // $query1=mysqli_query($con, "INSERT INTO `tblbeautician_expertise`(`Beautician_ID`,`Services_ID`) value('$last_id','$bexpertise')");

    if ($query) {
      echo "<script>alert('Beatician has been added.');</script>"; 
      echo "<script>window.location.href = 'add_beautician.php'</script>";   
      $msg="";
    }
    else
    {
      echo "<script>alert('Something Went Wrong. Please try again.');</script>";    
    }
   
  }

?>

  <!DOCTYPE html>
  <html>
  <?php @include("includes/head.php"); ?>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      <?php @include("includes/header.php"); ?>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <?php @include("includes/sidebar.php"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Add Beautician</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row offset-md-2">
             <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Beautician</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" id="Name" name="bname" placeholder="Enter beautician name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Phone</label>
                      <input type="text" class="form-control" id="Phone" name="bphone" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Email</label>
                      <input type="text" class="form-control" id="Email" name="bemail" placeholder="Enter email address">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Deparment</label>
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

                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php @include("includes/footer.php"); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>

  <!-- ./wrapper -->
  <?php @include("includes/foot.php"); ?>
</body>
</html>
<?php
}?>
