<?php
session_start();
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
  header('location:logout.php'); 
} 
?>
<!DOCTYPE html>
<html>
<?php @include("includes/head.php"); ?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php @include("includes/header.php"); ?>
        <!-- Main Sidebar Container -->
        <?php @include("includes/sidebar.php"); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6"> 
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <?php $query1=mysqli_query($con,"Select * from tblcustomers");
                                $totalcust=mysqli_num_rows($query1);
                                ?>
                                <div class="inner">
                                    <h3><?php echo $totalcust;?></h3>
                                    <p>Total Customers</p>
                                </div>
                                <a href="customer_list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <?php $query2=mysqli_query($con,"Select * from tblappointment");
                                $totalappointment=mysqli_num_rows($query2);
                                ?>
                                <div class="inner">
                                    <h3><?php echo $totalappointment;?></h3>

                                    <p>Total Appointments</p>
                                </div>
                                <a href="all_appointments.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <?php $query3=mysqli_query($con,"Select * from tblappointment where Status='1'");
                                $totalaccapt=mysqli_num_rows($query3);
                                ?>
                                <div class="inner">
                                    <h3><?php echo $totalaccapt;?></h3>

                                    <p>Accepted Appointments</p>
                                </div>
                                <a href="accepted_appointment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <?php $query4=mysqli_query($con,"Select * from tblappointment where Status='2'");
                                $totalrejapt=mysqli_num_rows($query4);
                                ?>
                                <div class="inner">
                                    <h3><?php echo $totalrejapt;?></h3>

                                    <p>Rejected Appointments</p>
                                </div>
                                <a href="rejected_appointment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                       <!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
        <?php
        // Todays Sale
        $query6 = mysqli_query($con, "SELECT SUM(Cost) AS todays_sale FROM allsales WHERE DATE(PostingDate) = CURDATE();");
        $row6 = mysqli_fetch_assoc($query6);
        $todays_sale = $row6['todays_sale'];
        ?>
        <div class="inner">
            <h3>
                <?php
                if (empty($todays_sale)) {
                    echo "0";
                } else {
                    echo htmlentities(number_format($todays_sale, 0, '.', ','));
                }
                ?>
            </h3>
            <p>Today Sales</p>
        </div>
        <a href="salesreport.php?from=<?= date('Y-m-d') ?>&to=<?= date('Y-m-d') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

    </div>
</div>
<!-- ./col -->

<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
        <?php
        // Yesterday's sale
        $query7 = mysqli_query($con, "SELECT SUM(Cost) AS yesterdays_sale FROM allsales WHERE DATE(PostingDate) = CURDATE() - INTERVAL 1 DAY;");
        $row7 = mysqli_fetch_assoc($query7);
        $yesterdays_sale = $row7['yesterdays_sale'];
        ?>
        <div class="inner">
            <h3>
                <?php
                if (empty($yesterdays_sale)) {
                    echo "0";
                } else {
                    echo htmlentities(number_format($yesterdays_sale, 0, '.', ','));
                }
                ?>
            </h3>
            <p>Yesterday Sales</p>
        </div>
        <a href="salesreport.php?from=<?= date('Y-m-d', strtotime('-1 day')) ?>&to=<?= date('Y-m-d', strtotime('-1 day')) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->

<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
        <?php
        // Last Seven Days Sale
        $query8 = mysqli_query($con, "SELECT SUM(Cost) AS seven_days_sale FROM allsales WHERE DATE(PostingDate) >= (CURDATE() - INTERVAL 7 DAY);");
        $row8 = mysqli_fetch_assoc($query8);
        $seven_days_sale = $row8['seven_days_sale'];
        ?>
        <div class="inner">
            <h3>
                <?php
                if (empty($seven_days_sale)) {
                    echo "0";
                } else {
                    echo htmlentities(number_format($seven_days_sale, 0, '.', ','));
                }
                ?>
            </h3>
            <p>Last Seven Days</p>
        </div>

        <?php  
            $todayDate = date('Y-m-d'); 
            $sevenDaysAgo = date('Y-m-d', strtotime('-7 days', strtotime($todayDate))); 

        ?>
         
        <a href="salesreport.php?from=<?= $sevenDaysAgo ?>&to=<?= date('Y-m-d')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->

<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
        <?php
        // Total Sale
        $query9 = mysqli_query($con, "SELECT SUM(Cost) AS total_sales FROM allsales");
        $row9 = mysqli_fetch_assoc($query9);
        $total_sales = $row9['total_sales'];

        
        $getfirstinvoice = mysqli_query($con, "SELECT PostingDate AS firstinvoice FROM `allsales` ORDER BY PostingDate ASC LIMIT 1"); 
        $thisinvoice = mysqli_fetch_assoc($getfirstinvoice);
        $formattedDate = date('Y-m-d', strtotime($thisinvoice['firstinvoice'])); 
        
        ?>
        <div class="inner">
            <h3><?php echo htmlentities(number_format($total_sales, 0, '.', ',')); ?></h3>
            <p>Total Sales</p>
        </div>
        <a href="salesreport.php?from=<?= $formattedDate ?>&to=<?= date('Y-m-d')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
        
                </div>
                <!-- /.row (main row) -->
            </div>
            <!-- /.container-fluid -->
        </section>
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
