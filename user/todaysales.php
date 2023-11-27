<?php
session_start();
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']) == 0) {
    header('location: logout.php');
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
                            <h1 class="m-0 text-dark">Today's Sale Details</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Display the data for today's sale here -->
                    <?php
                    $query6 = mysqli_query($con, "SELECT tblinvoice.*, tblservices.Cost 
                                                  FROM tblinvoice 
                                                  JOIN tblservices ON tblservices.ID = tblinvoice.ServiceId 
                                                  WHERE DATE(PostingDate) = CURDATE();");
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Customer ID</th>
                                <th>Service ID</th>
                                <th>Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($query6)) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['userId']; ?></td>
                                    <td><?php echo $row['serviceId']; ?></td>
                                    <td><?php echo $row['Cost']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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
