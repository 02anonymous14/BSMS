<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
  header('location:logout.php');
} 

if(isset($_POST[('delete')])){
  $idtodelete = $_POST[('deletethisid')];
  $query = mysqli_query($con,"delete from tblappointment where Appointment_ID ='$idtodelete' ");
  if ($query) {
    echo "<script>alert('Appointment has been Deleted.');</script>"; 
    echo "<script>window.location.href = 'all_appointments.php'</script>"; 
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
              <h1>Appointments</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">All Appointments</li>
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
                  <h3 class="card-title">DataTable with All Appointment</h3>
                </div>
                <!-- /.card-header -->
                <div id="editData" class="modal fade">
                  <div class="modal-dialog  ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">View Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" id="info_update">
                        <?php @include("view_appointment.php");?>
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
                  


                  <table id="dataTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                              <th>#</th> 
                              <th> Appointment Number</th> 
                              <th>Name</th><th>Mobile Number</th> 
                              <th>Appointment Date</th>
                              <th>Appointment Time</th>
                              <th>Action</th> 
                            </tr>
                        </thead> 
                    </table>
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
          url:"view_appointment.php",
          type:"post",
          data:{edit_id:edit_id},
          success:function(data){
            $("#info_update").html(data);
            $("#editData").modal('show');
          }
        });
      });


      $('#dataTable').DataTable({
        ajax: {
            url: 'ajax_handler_for_appointment.php',
            type: 'GET',       
            dataSrc: 'data'  
        },
        columns: [
            { data: '#' },
            { data: 'AptNumber' },
            { data: 'Name' },
            { data: 'PhoneNumber' },
            { data: 'AptDate' },
            { data: 'AptTime' },
            { data: 'action' } 
        ]
      });


    });
  </script>
</body>
</html>
