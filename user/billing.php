<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
// if (strlen($_SESSION['bpmsaid']==0)) {
//   header('location:logout.php');
// }  

if(isset($_POST[('delete')])){
  $idtodelete = $_POST[('deletethisid')];
  $query = mysqli_query($con,"delete from tblinvoice where BillingId ='$idtodelete' ");
  if ($query) {
    echo "<script>alert('Invoice has been Deleted.');</script>"; 
    echo "<script>window.location.href = 'invoices.php'</script>"; 
  } else {
    echo "<script>alert('Something Went Wrong. Please try again.');</script>";    
  } 
}
    $_SESSION['paythis'] = $_SESSION['amounttopay'];
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
              <h1>Billing</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Billing</li>
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
                    <!-- /.card-header -->
                    
                    <div class="card-body">
                        <div class="modal-body" id="info_update">
                            
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-12">
                    <div style="display: none;"class="card" id="paycard" >  
                        <div class="card-body"> 
                            <div class="container"> 
                                <div class="row">
                                    <div class="col">
                                    </div>
                                    <div class="col"> 

                                        <label for="tenderbox">TENDER AMOUNT</label>
                                        <input style="height:50px;width:600px; font-size: 30px;" type="text" class="form-control text-end" id="tenderbox" name="tenderbox" placeholder="Enter Amount" > 
                                        
                                    </div>
                                    <div class="mt-2">  
                                        <div class="col-sm mt-4">
                                            <input type="submit" style="height:50px;width:80px; font-size: 30px;" value="PAY" class="btn-primary" data-toggle="modal" data-target="#modalID">
                                        </div>
                                    </div>
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                                
                            </div>
                        
                        </div>
                        <!-- /.card-body -->
                    </div>
                <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>







            


            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Unpaid Invoice From Online and Walkin Client</h3>
                    </div>
                    <!-- /.card-header --> 
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                    <thead> 
                        <tr> 
                        <th>#</th> 
                        <th>Invoice Id</th> 
                        <th>Customer Name</th> 
                        <th>Client Type</th> 
                        <th>Invoice Date</th> 
                        <th>Action</th>
                        </tr> 
                    </thead> 
                    <tbody>

                        <?php 
                        $ret=mysqli_query($con,"select * from searchforinvoice where Paymentstatus ='UNPAID'");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($ret)) { 
                        ?> 

                        <tr> 
                            <th scope="row"><?php echo $cnt;?></th> 
                            <td><?php  echo $row['BillingId'];?></td>
                            <td><?php  echo $row['Name'];?></td>
                            <td><?php  echo $row['invoicefrom'];?></td>
                            <td><?php  echo $row['PostingDate'];?></td>
                            <td>
                            <div class="row"> 
                                <a href="#"  class="<?php if($row['invoicefrom'] == 'ONLINE APPOINTMENT'){echo "edit_data1";}else{echo "edit_data";} ?>" id="<?php echo  $row['BillingId']; ?>" title="click to view">Proccess Payment</a>
                                <!-- <form method="post">
                                    <input type="hidden" name="deletethisid" value="<?php echo $row['BillingId']; ?>">
                                    <input type="submit" name="delete" class="ml-3 btn btn-sm btn-danger" value="Delete">
                                </form>  -->
                            </div> 
                            </td>
                        </tr>   
                        <?php 
                            $cnt=$cnt+1;
                        }
                        ?>

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
          url:"view_invoice_forbilling.php",
          type:"post",
          data:{edit_id:edit_id},
          success:function(data){
            $("#info_update").html(data);
            $("#editData").modal('show'); 
            showpaycard();
          }
        });
        
      });
    });
    $(document).ready(function(){
      $(document).on('click','.edit_data1',function(){
        var edit_id=$(this).attr('id');
        $.ajax({
          url:"view_invoiceFromonlineview_forbilling.php",
          type:"post",
          data:{edit_id:edit_id},
          success:function(data){
            $("#info_update").html(data);
            $("#editData").modal('show'); 
            showpaycard();
          }
        });
      });
      
    });

    function showpaycard(){
        $("#paycard").show();
    }
 
  </script>
</body>
</html>
