<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
// if (strlen($_SESSION['bpmsaid']==0)) {
//   header('location:logout.php');
// } 

if(isset($_POST[('delete')])){
  $idtodelete = $_POST[('deletethisid')];
  
  $query = mysqli_query($con,"delete from tblbeautician_expertise where Beautician_ID ='$idtodelete' ");
  $query1 = mysqli_query($con,"delete from tblbeauticians where Beautician_ID ='$idtodelete' ");
  if ($query && $query1) {
    echo "<script>alert('Beautician has been Deleted.');</script>"; 
    echo "<script>window.location.href = 'manage_beauticians.php'</script>"; 
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
                <h1>Beauticians</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Beauticians</li>
                </ol>
              </div>
            </div>
          </div>
        <!-- /.container-fluid -->
        </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Available Beautician</h3>
                </div>
                <!-- /.card-header -->
                <div id="editData" class="modal fade">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Beautician</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  <div class="modal-body" id="info_update">
                       <?php @include("edit_beauticians.php");?>
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
                      <th>Name</th> 
                      <th>Phone</th> 
                      <th>Email</th>
                      <th>Expertise</th>
                      <th>Action</th> 
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $ret=mysqli_query($con,"SELECT `tblbeauticians`.`Beautician_ID`,`tblbeauticians`.`Name`,`tblbeauticians`.`Phone`,`tblbeauticians`.`Email`,`tblservices`.`ServiceName` FROM `tblbeauticians` INNER JOIN `tblbeautician_expertise` ON `tblbeauticians`.`Beautician_ID` = tblbeautician_expertise.Beautician_ID INNER JOIN `tblservices` ON tblbeautician_expertise.`Services_ID` = tblservices.Services_ID");
                    $cnt=1;
                    while ($row=mysqli_fetch_array($ret)) {
                      ?>
                      <tr>
                        <!--$bname=$_POST['bname'];
                            $bphone=$_POST['bphone'];
                            $bemail=$_POST['bemail'];
                            $bservices=$_POST['bservices'];-->
                        <th scope="row"><?php echo $cnt;?></th> 
                        <td><?php  echo $row['Name'];?></td>
                        <td><?php  echo $row['Phone'];?></td>
                        <td><?php  echo $row['Email'];?></td>
                        <td><?php  echo $row['ServiceName'];?></td>
                        
                        <td>
                         
                         <div class="row"> 
                         <a href="#"  class="edit_data" id="<?php echo  $row['Beautician_ID']; ?>" title="click for edit">Edit</i></a>
                                <form method="post">
                                  <input type="hidden" name="deletethisid" value="<?php echo $row['Beautician_ID']; ?>">
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
        url:"edit_beauticians.php",
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
