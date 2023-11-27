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
					$ret1=mysqli_query($con,"SELECT DISTINCT BillingId,invoicefrom FROM`allinvoices` WHERE BillingId='$invid'");
					$from = $getinvoicefrom['invoicefrom'] = mysqli_fetch_array($ret1);

					 

					if($from['invoicefrom'] =="ONLINE APPOINTMENT"){ 
						
					$ret=mysqli_query($con,"SELECT DISTINCT `tblinvoice_from_onlineappointment`.PostingDate,`tblappointment`.Name,`tblappointment`.Email,`tblappointment`.`PhoneNumber`
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
								<td colspan="5"><?php echo $row['PostingDate']?></td> 
							</tr> 
						</table> 
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
							$ret=mysqli_query($con,"SELECT `beautician_with_services`.`Name`,`beautician_with_services`.`ServiceName`,`beautician_with_services`.`Cost` FROM `tblinvoice_from_onlineappointment` 
							JOIN `beautician_with_services` ON `beautician_with_services`.Services_ID=`tblinvoice_from_onlineappointment`.Services_ID
							WHERE tblinvoice_from_onlineappointment.BillingId='$invid'");
							$cnt=1;
							while ($row=mysqli_fetch_array($ret)) {
								?>
								<tr>
									<th><?php echo $cnt;?></th>
									<td><?php echo $row['Name']?></td>
									<td><?php echo $row['ServiceName']?></td>	
									<td><?php echo $subtotal=$row['Cost']?></td>
								</tr>
								<?php 
								$cnt=$cnt+1;
								$gtotal+=$subtotal;
							} ?>
							<tr>
								<th colspan="3" style="text-align:center">Grand Total</th>
								<th><?php echo $gtotal?></th>
							</tr>
						</table>
						<p style="margin-top:1%"  align="center">
							<i class="fa fa-print fa-2x" style="cursor: pointer;"  OnClick="CallPrint(this.value)" ></i>
						</p>
					<?php 
					
					}?>
					
					
					<?php
					

				}elseif($from['invoicefrom'] =="WALK IN CLIENT"){ 

					$ret=mysqli_query($con,"select DISTINCT tblinvoice.PostingDate,tblcustomers.Name,tblcustomers.Email,tblcustomers.MobileNumber,tblcustomers.Gender
					from  tblinvoice 
					join tblcustomers on tblcustomers.Customers_ID=tblinvoice.Customers_ID 
					where tblinvoice.BillingId='$invid'");
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
							<td><?php echo $row['MobileNumber']?></td>
							<th>Email </th> 
							<td><?php echo $row['Email']?></td>
						</tr> 
						<tr> 
							<th>Gender</th> 
							<td><?php echo $row['Gender']?></td> 
							<th>Invoice Date</th> 
							<td colspan="3"><?php echo $row['PostingDate']?></td> 
						</tr> 
						<!-- <tr> 
							<th>Beautician</th> 
							<td colspan="5"> Sample beautician </td> 
						</tr>  -->
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
						$ret=mysqli_query($con,"SELECT `beautician_with_services`.`Name`,`beautician_with_services`.`ServiceName`,`beautician_with_services`.`Cost` FROM tblinvoice 
						JOIN `beautician_with_services` ON `beautician_with_services`.Services_ID=tblinvoice.Services_ID
						where tblinvoice.BillingId='$invid'");
					$cnt=1;
					while ($row=mysqli_fetch_array($ret)) {
						?>
						<tr>
							<th><?php echo $cnt;?></th>
							<td><?php echo $row['Name']?></td>	
							<td><?php echo $row['ServiceName']?></td>	
							<td><?php echo $subtotal=$row['Cost']?></td>
						</tr>
						<?php 
						$cnt=$cnt+1;
						$gtotal+=$subtotal;
					} ?>
					<tr>
						<th colspan="3" style="text-align:center">Grand Total</th>
						<th><?php echo $gtotal?></th>
					</tr>
				</table>
				<p style="margin-top:1%"  align="center">
					<i class="fa fa-print fa-2x" style="cursor: pointer;"  OnClick="CallPrint(this.value)" ></i>
				</p>
<?php
				}
				?>
				
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