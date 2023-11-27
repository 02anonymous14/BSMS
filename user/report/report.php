<?php
session_start(); 
?>
<?php
include("header.php");
?>
<?php 

try{
    $con = new PDO("mysql:host=localhost; dbname=beauty", 'root', '');
} catch(PDOExection $e) {
echo $e->getMessage();
}

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
 
$sql = "SELECT * FROM  AllSales WHERE PostingDate BETWEEN '$newdatefrom' AND '$newdateto'";
$stmt = $con->prepare($sql);
$stmt->execute();
$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes"> 
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> -->
  <link rel="stylesheet" href="plugins/jquery.dataTables1.min.css">
  <!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->
  <script src="plugins/jquery.dataTables2.min.js"></script>
 </head>
 <body>
  <div align="center" class="container mt-5">
   <h1 align="center">Sales Report</h1><br> 

    <form class="myForm" method="get" enctype="application/x-www-form-urlencoded" action="report.php">
    
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
                <a href="report.php" class="btn btn-danger btn-block">Reset</a></span>
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
            <h4 style="color:red">Total Sales from : <?php if(!empty($_GET['from'])){echo ($datefrom = date('F d, Y', strtotime($datefrom)));} if(!empty($_GET['from'])){ echo (' to');}?> <?php if(!empty($_GET['from'])){echo ($dateto= date('F d, Y', strtotime($dateto)));} ?> </h4>
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
            $total = [
            'total' => 0, 
            'totaltaka' => 0,
            ];
            foreach ($arr as $index => $unit) {
            $total = [
            'totaltaka' => $total['totaltaka'] + $unit['Cost'],
            ];
            echo '<tr>';
            echo '<td align= center>' . ($index + 1) . '</td>';
                echo '<td align= center>' . $unit['BillingId'] . '</td>';
            echo '<td align= center>' . $unit['PostingDate'] . '</td>';
            echo '<td align= center>' . $unit['invoicefrom'] . '</td>';
            echo '<td align= center>' . $unit['ServiceName'] . '</td>';
            echo '<td align= center>' . $unit['Cost'] . '</td>'; 
            echo '</tr>';
            }
            echo '<tr align= center>';
            echo '<th colspan="5" style="text-align: right;">Grand Total</th>';
            echo '<td ><b>' . $total['totaltaka'] . '</b></td>';
            echo '</tr>';
            ?>
            </tbody>
            </table>
        </div>
   </div>
   <!-- </div> -->
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