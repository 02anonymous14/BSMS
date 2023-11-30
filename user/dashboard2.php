<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
  header('location:logout.php');
}  
$page = $_SERVER['PHP_SELF'];
$sec = "5"; 
?>
<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
<?php @include("includes/head.php"); ?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
   
    <!-- /.navbar -->

                <div id="editData" class="modal fade">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">New Appointment</h5>
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
                <table id="example1" class="table table-bordered table-hover">
                  <thead> 
                    <tr> 
                      <th>#</th> 
                      <th> Services</th> 
                      <th>Name</th>
                      <th>Appointment Date</th>
                      <th>Appointment Time</th>
                      <th>Beautician</th>
                    
                    </tr> 
                  </thead> 
                  <tbody>
                    <?php
                    $ret=mysqli_query($con,"select *from  tblappointment where Status=''");
                    $cnt=1;
                    while ($row=mysqli_fetch_array($ret)) {

                      ?>

                      <tr> 
                        <th scope="row"><?php echo $cnt;?></th> 
                        <td><?= $row['Services'];?></td> 
                        <td><?= $row['Name'];?></td>
                        
                        <td><?= $row['AptDate'];?></td> 
                        <td><?= $row['AptTime'];?></td> 
                        <td><?= $row['Beautician'];?></td>
                            
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
  });
</script>
</body>
</html>
