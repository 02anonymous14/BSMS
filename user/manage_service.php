<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
// if (strlen($_SESSION['bpmsaid']==0)) {
//   header('location:logout.php');
// } 

if(isset($_POST[('delete')])){
  $idtodelete = $_POST[('deletethisid')];
  $query = mysqli_query($con,"delete from tblservices where Services_ID ='$idtodelete' ");
  if ($query) {
    echo "<script>alert('Services has been Deleted.');</script>"; 
    echo "<script>window.location.href = 'manage_service.php'</script>"; 
  } else {
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
              <h1>Services</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Services</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Available Services</h3>
                </div>
                <!-- /.card-header -->
                <div id="editData" class="modal fade">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" id="info_update">
                       <?php @include("edit_service.php");?>
                     </div>
                     <div class="modal-footer ">
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </div>
              <!--   end modal -->
              <div class="card-body">
                  <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th> 
                      <th>Category</th>
                      <th>Service Name</th> 
                      <th>Service Price</th> 
                      <th>Creation Date</th>
                      <th>Action</th> 
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $ret=mysqli_query($con,"select *from  tblservices");
                    $cnt=1;
                    while ($row=mysqli_fetch_array($ret)) {
                      ?>
                      <tr>
                        <th scope="row"><?php echo $cnt;?></th>
                        <td><?php echo $row['Category'];?></td> 
                        <td><?php echo $row['ServiceName'];?></td>
                        <td><?php echo htmlentities(number_format($row['Cost'], 0, '.', ','));?></td>
                        <td><?php echo $row['CreationDate'];?></td> 
                        <td> 
                         <div class="row"> 
                            <a href="#"  class=" edit_data" id="<?php echo  $row['Services_ID']; ?>" title="click for edit">Edit</i></a>
                            <form method="post">
                              <input type="hidden" name="deletethisid" value="<?php echo $row['Services_ID']; ?>">
                              <input type="submit" name="delete" class="ml-3 btn btn-sm btn-danger" value="Delete">
                            </form> 
                          </div> 
                        </td>
                      </tr>   
                      <?php 
                      $cnt=$cnt+1;
                    }?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.edit_data',function(){
      var edit_id=$(this).attr('id');
      $.ajax({
        url:"edit_service.php",
        type:"post",
        data:{edit_id:edit_id},
        success:function(data){
          $("#info_update").html(data);
          $("#editData").modal('show');
        }
      });
    });
  });
</script>
</body>
</html>
