<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
  header('location:logout.php');
} else{
  if(isset($_POST['submit']))
  {
    $category=$_POST['Category'];
    $sername=$_POST['sername'];
    $cost=$_POST['cost'];
    $query=mysqli_query($con, "insert into  tblservices(category,ServiceName,Cost) value('$category','$sername','$cost')");
    if ($query) {
      echo "<script>alert('Service has been added.');</script>"; 
      echo "<script>window.location.href = 'add_service.php'</script>";   
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
  <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>
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
                  <li class="breadcrumb-item active">Add service</li>
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
                  <h3 class="card-title">Add service</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post">
                  <div class="card-body">
                  <div class="row">
                    <div class="col-sm-11">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select class="form-control" id="Category" name="Category" > 
                        <option value="">--Select Category--</option>
                        <?php 
                        $getcategory = mysqli_query($con,"SELECT `category` FROM tblcategory");
                        while ($allgetcategory = mysqli_fetch_array($getcategory)):;
                        ?> 
                          <option value="<?= $allgetcategory['category'];?>"><?= $allgetcategory['category'];?></option> 
                        <?php
                          endwhile;  
                        ?> 
                      </select> 
                      </div> 
                    </div> 
                    <div class="col "><div class="form-group mt-3" >

                    
                      <div class="form-group position-absolute mt-3" > 
                        <svg id="MT"class="btn-success rounded-circle "xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16" data-toggle="modal" data-target="#modalID">
                          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                      </div> 
                    </div> 
                    </div> 
                  </div> 
                     
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Name</label>
                      <input type="text" class="form-control" id="sername" name="sername" placeholder="Enter service name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Cost</label>
                      <input type="text" class="form-control" id="cost" name="cost" placeholder="cost">
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form> 

                  <div class="modal fade" id="modalID" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Category</h5>
                                <buton type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </buton>
                            </div>
                            <div class="modal-body">
                                <form id="myForm">
                                    <div class="card-body">
                                        
                                        <div class="form-group">
                                            <label for="Category11">Category</label>
                                            <input type="text" class="form-control" id="Category1" name="Category1" placeholder="Enter Category" required> 
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                      <center>
                                        <button type="submit" id="addcategory" class="btn btn-primary mx-auto" onclick="insertData()">Submit</button>
                                      </center>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>  
                  
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

<script>
    
  document.getElementById("addcategory").addEventListener("click", function() {
    refreshPage();
  });
   
  function insertData() {
    var Category = $("#Category1").val(); 

    // Make an AJAX request
    $.ajax({
        type: "POST",
        url: "insertcategory.php",
        data: {
            category: Category,
        }, 
        success: function(response) {
            console.log(response);
        },
        error: function(error) { 
            console.log(error);
        } 
        
    }); 
     
  }

  function refreshPage() { 
    location.reload();
  }

</script>

  </script>
</html>
<?php
}?>
