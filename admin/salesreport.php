<?php
session_start();
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
  header('location:logout.php');  
    
  
  $datefrom = '';
  $newdatefrom  = '';
  $dateto = '';
  $newdateto = '';

  if (!empty($_GET['from']) && !empty($_GET['to'])) {
          
    $datefrom = '';
    $newdatefrom  = '';
    $dateto = '';
    $newdateto = '';

    if (!empty($_GET['from']) && !empty($_GET['to'])) {
            
        $datefrom = $_GET['from'];
        $dateto = $_GET['to'];

        $newdatefrom = $datefrom.' '.'00:00:00';
        $newdateto = $dateto.' '.'23:59:59';
        
    }
    
    // $sql = "SELECT * FROM  AllSales WHERE PostingDate BETWEEN '$newdatefrom' AND '$newdateto'";
    // $stmt = $con->prepare($sql);
    // $stmt->execute();
    // $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
  }
  
} 
?>
<!DOCTYPE html>
<html>
<?php @include("includes/head.php"); ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes"> 
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> -->
  <link rel="stylesheet" href="plugins/jquery.dataTables1.min.css">
  <!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->
  <script src="plugins/jquery.dataTables2.min.js"></script>
 </head>
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
                        
                        <div class="col-sm-12">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Sales Report</li>
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

                    <div align="center" class="container mt-5">
                        <h1 align="center">Sales Report</h1><br> 

                            <form class="myForm" method="get" enctype="application/x-www-form-urlencoded" action="salesreport.php">
                            
                                <div class="form-row" align="left">
                                    <div class="form-group col-md-3">
                                        <label>From Date:</label>
                                        <input type="date" class="datepicker btn-block"  name="from" id="fromDate" Placeholder="Select From Date" value="<?php echo isset($_GET['from']) ? $_GET['from'] : '' ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>To Date:  </label>
                                        <input type="date" name="to" id="toDate" class="datepicker btn-block"  Placeholder="Select To Date" value="<?php echo isset($_GET['to']) ? $_GET['to'] : '' ?>">
                                    </div>

                                    <div class="form-group col-md-2 pt-4 mt-2">
                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                
                                    <div class="form-group col-md-2 pt-4 mt-2">
                                        <a href="salesreport.php" class="btn btn-danger btn-block">Reset</a></span>
                                    </div>

                                    <div class="form-group col-md-2 pt-4 mt-2">
                                        <button type="submit" class="btn btn-info btn-block "  OnClick="CallPrint(this.value)" ></i> Print</button>
                                    </div>
                                </div> 
                            </form>
                        
                            <br>
                            <style type="text/css">
                                @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                                <div class="tg-wrap">
                                    <div class="tables" id="exampl">
                                        <table id="table" class="display" cellspacing="0" style="width:100%" border="1">
                                        <thead style="font: bold; active" align="center">
                                        <h4 style="color:red">Total Sales from : <?php if(!empty($_GET['from'])){echo ( date('F d, Y', strtotime($_GET['from'])));} if(!empty($_GET['from'])){ echo (' to');}?> <?php if(!empty($_GET['from'])){echo (date('F d, Y', strtotime($_GET['to'])));} ?> </h4>
                                        </thead>
                                        <thead style="font: bold; active" align="center">
                                        <tr>
                                        <td>No.</td>
                                        <td align= center>Billing Id</td>
                                        <td align= center>Posting Date</td>
                                        <td align= center>Client Type</td>
                                        <td align= center>Services</td>
                                        <td align= center>Amount</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        
                                        if (isset($_GET['from'])) {
                                            $from = $_GET['from'];
                                        } else {
                                            $from = '';
                                        }
                                        
                                        if (isset($_GET['to'])) {
                                            $to = $_GET['to'];
                                        } else {
                                            $to = '';
                                        }

                                        $query=mysqli_query($con,"SELECT * FROM AllSales WHERE PostingDate BETWEEN '$from' AND '$to'");

                                        // $sql = "SELECT * FROM AllSales WHERE PostingDate BETWEEN '$from' AND '$to'";
                                        // $stmt = $con->prepare($sql);
                                        // $stmt->execute();
                                        // $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        
    
                                        $total = [
                                        'total' => 0, 
                                        'totalsales' => 0,
                                        ];
                                        $index = 0;
                                                while($row=mysqli_fetch_array($query))
                                                {
                                                    $total = [
                                                    'totalsales' => $total['totalsales'] + $row['Cost'],
                                                    ];
                                                    echo '<tr>';
                                                    echo '<td align= center>' . ($index = $index + 1) . '</td>';
                                                        echo '<td align= center>' . $row['BillingId'] . '</td>';
                                                    echo '<td align= center>' . $row['PostingDate'] . '</td>';
                                                    echo '<td align= center>' . $row['invoicefrom'] . '</td>';
                                                    echo '<td align= center>' . $row['ServiceName'] . '</td>';
                                                    echo '<td align= center>' . $row['Cost'] . '</td>'; 
                                                    echo '</tr>';
                                                }
                                        echo '<tr align= center>';
                                        echo '<th colspan="5" style="text-align: right;">Grand Total</th>';
                                        echo '<td ><b>' . $total['totalsales'] . '</b></td>';
                                        echo '</tr>';
                                         
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- </div> -->


        
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
        <br>
   <br><br>
   <script type="text/javascript">
   $(document).ready(function() {
   $('#table').dataTable();
   } );

   function CallPrint(strid){
		var prtContent = document.getElementById("exampl");
		var WinPrint = window.open('', '', 'left=190,top=100,width=1500,height=900,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
   </script>
  </body>
</html>
