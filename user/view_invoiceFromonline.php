<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<div id="page-wrapper">
	<div class="main-page">
		<div class="tables" id="exampl">
			<h3 class="title1">Invoice Details</h3>
			<div class="table-responsive bs-example widget-shadow">
				<?php
				$invid=$_POST['edit_id'];
				$ret=mysqli_query($con,"SELECT DISTINCT `tblinvoice_from_onlineappointment`.PostingDate,`tblinvoice_from_onlineappointment`.`Paymentstatus`,`tblappointment`.Name,`tblappointment`.Email,`tblappointment`.`PhoneNumber`
				FROM  tblinvoice_from_onlineappointment 
				JOIN `tblappointment` ON `tblappointment`.`Appointment_ID`=tblinvoice_from_onlineappointment.`Appointment_ID`
					where tblinvoice_from_onlineappointment.BillingId='$invid'");
				$cnt=1;
				while ($row=mysqli_fetch_array($ret)) 
				{
					?>		
					<h4>Invoice #<?php echo $invid;?></h4>
					<table class="table table-bordered" width="100%" border="1"> 
						<tr>
							<th colspan="6">Customer Details</th>	
						</tr>
						<tr> 
							<th>Name</th> 
							<td><?php echo $row['Name']?></td> 
							<th>Contact no.</th> 
							<td><?php echo $row['PhoneNumber']?></td>
							<th>Email </th> 
							<td><?php echo $row['Email']?></td>
						</tr> 
						<tr>   
							<th>Invoice Date</th> 
								<td colspan="3"><?php echo $row['PostingDate']?></td> 
								<th>Status</th> 
							<td colspan="2"><?php echo $row['Paymentstatus']?></td> 
						</tr> 
					</table> 
					<?php 
				}?>
				<table class="table table-bordered" width="100%" border="1"> 
					<tr>
						<th colspan="4">Services Details</th>	
					</tr>
					<tr>
						<th>#</th>	
						<th>Beautician</th>
						<th>Service</th>
						<th>Cost</th>
					</tr>

					<?php
					$ret=mysqli_query($con,"SELECT * FROM `tblinvoice_from_onlineappointment` WHERE tblinvoice_from_onlineappointment.BillingId='$invid'");
					$cnt=1;
					while ($row=mysqli_fetch_array($ret)) {
						$serviesID = $row['Services_ID'];
						$get=mysqli_query($con,"SELECT `ServiceName`, `Cost` FROM `tblservices` WHERE `Services_ID` = '$serviesID'");
						$row1=mysqli_fetch_array($get)
						?>
						<tr>
							<th><?php echo $cnt;?></th>
							<td><?php echo $row['beautician']?></td>	
							<td><?php echo $row1['ServiceName']?></td>	
							<td><?php echo $subtotal=$row1['Cost']?></td>
						</tr>
						<?php 
						$cnt=$cnt+1;
						$gtotal+=$subtotal;
					} ?> 
					<tr>
						<th colspan="3" style="text-align:center">Grand Total</th>
						<th><?php echo $gtotal;$_SESSION['topay']=$gtotal;?></th>
					</tr>
				</table>
				<p style="margin-top:1%"  align="center">
					<i class="fa fa-print fa-2x" style="cursor: pointer;"  OnClick="CallPrint(this.value)" ></i>
				</p>
			</div>
		</div>
	</div>
</div>

<script>
	function CallPrint(strid){
		var prtContent = document.getElementById("exampl");
		var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
</script>