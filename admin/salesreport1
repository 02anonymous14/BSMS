<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
// if (strlen($_SESSION['bpmsaid']==0)) {
//   header('location:logout.php');
// } 
 



try{
  $con = new PDO("mysql:host=localhost; dbname=test2022", 'root', '');
} catch(PDOExection $e) {
  echo $e->getMessage();
}
  // define daterange
  $dateCond = '';
  if (!empty($_GET['from']) && !empty($_GET['to'])) {
  $dateCond = "DATE(trn_date) >= '{$_GET['from']}' AND DATE(trn_date) <= '{$_GET['to']}'";
  }
  // define clienttype filter
  $clienttype = '';
  if (!empty($_GET['clienttype'])) {
  $product = "clienttype='{$_GET['clienttype']}'";
  }
  
  // search query
  $sql = "SELECT city as city, farm_name as farm_name, salesdate as salesdate, rate as rate, product as product,
  sum(amount) as amount,
  sum(totaltaka) as totaltaka FROM sales WHERE farm_name = '{$_SESSION["username"]}' AND {$dateCond} AND {$product}  AND {$city} OR usertype = '{$_SESSION["usertype"]}' AND {$dateCond} AND {$product} AND {$city} GROUP BY city, farm_name, salesdate, rate, product order by product, salesdate asc";
  $stmt = $con->prepare($sql);
  $stmt->execute();
  $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

 



?>
<!DOCTYPE html>
<html>
<head>
	<title>Beauty Salon Management System</title> 

	<link rel="stylesheet" href="dist/css/animate.css"> 
	<!-- <link rel="stylesheet" href="dist/css/owl.carousel.min.css"> -->
	<!-- <link rel="stylesheet" href="dist/css/owl.theme.default.min.css"> -->
	<!-- <link rel="stylesheet" href="dist/css/magnific-popup.css">  -->
	<link rel="stylesheet" href="dist/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="dist/css/jquery.timepicker.css"> 
	<!-- <link rel="stylesheet" href="dist/css/flaticon.css"> -->
	<!-- <link rel="stylesheet" href="dist/css/style.css"> -->

</head>
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
              <h1>Sales Report</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Sales Report</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>  
       

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">   

                <form class="myForm" method="get" enctype="application/x-www-form-urlencoded" action="salesreport.php">
                  <div class="form-row pl-2" align="left">
                    <div class="form-group col-md-3">
                      <label>From Date:</label>
                      <input type="date" class="datepicker btn-block"  name="from" id="fromDate" Placeholder="Select From Date" value="<?php echo isset($_GET['from']) ? $_GET['from'] : '' ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                      <label>To Date:  </label>
                      <input type="date" name="to" id="toDate" class="datepicker btn-block"  Placeholder="Select To Date" value="<?php echo isset($_GET['to']) ? $_GET['to'] : '' ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                      <label>Cient Type:  </label>
                      <select class="custom-select" name="clienttype" id="clienttype">
                      <option value="">--Select Type--</option>
                      <option value="ONLINE APPOINTMENT">ONLINE APPOINTMENT</option>
                      <option value="WALK IN CLIENT">WALK IN CLIENT</option>
                      </select>
                    </div> 

                    <div class="form-row mt-1 pt-1" align="left"> 
                      <div class="form-group pl-2">
                        <button type="submit" class="btn btn-primary btn-block mt-4 "><i class="fa fa-paper-plane"></i> Filter</button>
                      </div>
                      
                    </div>

                    <div class="form-row mt-1 pt-1 pl-2" align="left">  
                      <div class="form-group pl-2">
                        <a href="salesreport.php" class="btn btn-danger btn-block  mt-4"><i class="fa fa-refresh"></i> Reset</a></span>
                      </div>
                    </div>
                    <div class="form-row mt-1 pt-1 pl-2" align="left">  
                      <div class="form-group pl-2">
                        <a href="#" class="btn btn-info btn-block  mt-4"><i class="fa fa-print"></i> Print</a></span>
                      </div>
                    </div>
                  </div> 
                </form> 

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
 
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Sales List</h3>
                </div>
                <!-- /.card-header -->
                <div id="editData" class="modal fade">
                  <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">View invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" id="info_update">
                        <?php @include("view_invoice.php");?>
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
                      <th>Invoice Id</th> 
                      <th>Invoice Date</th> 
                      <th>Services</th> 
                      <th>Cost</th>
                    </tr> 
                  </thead> 
                  <tbody>

                    <?php 
                      $ret=mysqli_query($con,"SELECT tblinvoice.BillingId,tblinvoice.PostingDate,tblservices.ServiceName,tblservices.Cost FROM  tblinvoice 
                      JOIN tblservices ON tblservices.ID=tblinvoice.ServiceId ");
                      $cnt=1;
                      while ($row=mysqli_fetch_array($ret)) { 
                    ?> 

                      <tr> 
                        <th scope="row"><?php echo $cnt;?></th> 
                        <td><?php  echo $row['BillingId'];?></td>
                        <td><?php  echo $row['PostingDate'];?></td> 
                        <td><?php  echo $row['ServiceName'];?></td>
                        <td><?php echo  $row['Cost']; ?></td>  
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
    $(document).ready(function() {
    $('#example1').dataTable();
    } );
  </script> 
</body>

	<script src="dist/js/jquery-migrate-3.0.1.min.js"></script>
	<script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/jquery.easing.1.3.js"></script>
	<script src="dist/js/jquery.waypoints.min.js"></script>
	<script src="dist/js/jquery.stellar.min.js"></script>
	<script src="dist/js/owl.carousel.min.js"></script>
	<script src="dist/js/jquery.magnific-popup.min.js"></script>
	<script src="dist/js/jquery.animateNumber.min.js"></script>
	<script src="dist/js/bootstrap-datepicker.js"></script>
	<script src="dist/js/jquery.timepicker.min.js"></script>
	<script src="dist/js/scrollax.min.js"></script>
	<script src="dist/js/main.js"></script>
</html>
