<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
  header('location:logout.php');
} 

// Check if the user is logged in or redirect to a login page if necessary.
// Replace the following lines with your authentication logic.
// if (strlen($_SESSION['bpmsaid'] == 0)) {
//     header('location:logout.php');
// }

// Initialize variables for date filtering
$fromDate = date('Y-m-d', strtotime('-1 month')); // Default From date (one month ago)
$toDate = date('Y-m-d'); // Default To date (today)
$showPrintButton = false; // Initially, hide the Print Report button
$salesData = array();

if (isset($_POST['filter'])) {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $showPrintButton = true; // Show the Print Report button after filtering

    // Perform SQL query to retrieve sales data within the date range
    $query = "SELECT
        i.id AS InvoiceId,
        c.Name AS CustomerName,
        i.PostingDate AS InvoiceDate,
        s.ServiceName AS ServiceName,
        s.Cost AS ServiceCost
    FROM tblinvoice AS i
    INNER JOIN tblusers AS u ON i.Userid = u.id
    INNER JOIN tblappointment AS a ON i.BillingId = a.ID
    INNER JOIN tblservices AS s ON a.Services = s.ServiceName
    INNER JOIN tblcustomers AS c ON u.id = c.ID
    WHERE i.PostingDate BETWEEN '$fromDate' AND '$toDate'";

    // Execute the SQL query
    // Replace the following line with your database query execution logic
    // $result = mysqli_query($con, $query);

    // Fetch and store the sales data
    // Replace the following loop with your database fetch logic
    // while ($row = mysqli_fetch_assoc($result)) {
    //     $salesData[] = $row;
    // }
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
                            <h1>Sales Report</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Filter Options -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <form method="post">
                                <div class="form-group">
                                    <label for="fromDate">From Date:</label>
                                        <input type="date" class="form-control" id="fromDate" name="fromDate"
                                               value="<?php echo $fromDate; ?>">
                                    </div> 
                                    <label for="toDate">To Date:</label>
                                        <input type="date" class="form-control" id="toDate" name="toDate"
                                               value="<?php echo $toDate; ?>" max="<?php echo date('Y-m-d'); ?>">
                                    </td>
                                    </div>
                                    <p style="margin-left:1%"  align="left">
                                    <p style="margin-top:2%"  align="left">
                                    <button type="submit" class="btn btn-primary" name="filter">Submit</button>
                                    <div class="form-group">
                                    </td>
                                    </div>
                                    <p style="margin-left:2%"  align="left">
                                    <p style="margin-top:2.5%"  align="left">
                                     <i class="fa fa-print fa-2x" style="cursor: pointer;"  OnClick="CallPrint(this.value)" ></i>
                                    
                                    
                                    <?php
                                ?>

                 <script>
                     function CallPrint(strid) {
                         var prtContent = document.getElementById("exampl");
                         var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
                         WinPrint.document.write(prtContent.innerHTML);
                         WinPrint.document.close();
                         WinPrint.focus();
                         WinPrint.print();
                         WinPrint.close();
                     }
                 </script>