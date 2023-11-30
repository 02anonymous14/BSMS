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
				$ret=mysqli_query($con,"SELECT DISTINCT tblinvoice.PostingDate,tblinvoice.`Paymentstatus`,tblcustomers.Name,tblcustomers.Email,tblcustomers.MobileNumber,tblcustomers.Gender
				FROM  tblinvoice 
				JOIN tblcustomers ON tblcustomers.Customers_ID=tblinvoice.Customers_ID 
					where tblinvoice.BillingId='$invid'");
				$cnt=1; 
				while ($row=mysqli_fetch_array($ret)) 
				{
					?>		
					<h4 id="">Invoice #<?php echo $invid;?></h4>
					
					<input type="hidden" id="editthisid" value="<?= $invid;?>">
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
							<td colspan="1"><?php echo $row['PostingDate']?></td> 
							<th>Status</th> 
							<td id="invoicestatus" colspan="1"><?php echo $row['Paymentstatus']?></td> 
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
						// $ret=mysqli_query($con,"SELECT `beautician_with_services`.`Name`,`beautician_with_services`.`ServiceName`,`beautician_with_services`.`Cost` FROM tblinvoice 
						// JOIN `beautician_with_services` ON `beautician_with_services`.Services_ID=tblinvoice.Services_ID
						// where tblinvoice.BillingId='$invid'");

						// $ret=mysqli_query($con,"SELECT `beautician_with_services`.`Name`,`beautician_with_services`.`ServiceName`,`beautician_with_services`.`Cost` FROM tblinvoice 
						// JOIN `beautician_with_services` ON `beautician_with_services`.Services_ID=tblinvoice.Services_ID WHERE `beautician_with_services`.`Name` = tblinvoice.`beautician` AND tblinvoice.BillingId='$invid'");

						$ret=mysqli_query($con,"SELECT * FROM `tblinvoice` WHERE tblinvoice.BillingId='$invid' ORDER BY `tblinvoice`.`beautician` ASC");
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

						}  
					
					?>
					<tr>
						<th colspan="3" style="text-align:center">Grand Total</th>
						<th id="grandtotal"><?php echo $gtotal; ?></th>
						
					</tr>  
					<tr>
						<th colspan="3" style="text-align:right">Tendered Amount:<br>Amount Due:<br>Change:</th>
						<th id="payinfo"> 
						</th> 
					</tr> 
				</table>

				
				<p style="margin-top:1%"  align="center">
					<!-- <button class="btn-primary" data-toggle="modal" data-target="#modalID">Proceed to Payment</button> -->
					<!-- <i class="fa fa-print fa-2x" style="cursor: pointer;"  OnClick="CallPrint(this.value)" ></i> -->
				</p>
			</div>
		</div>
		
	</div>


	<div class="row">
		<div class="col-12">
			<div style="display: none;"class="card" id="paycard" >  
				<div class="card-body"> 
					<div class="container"> 
						<!-- <form method="post" action=""> -->
							<div class="row">
								<div class="col">
								</div>
								<div class="col"> 

									<label for="tenderbox">TENDER AMOUNT</label>
									<input type="hidden" id="topay" value="<?= $gtotal;?>">
									<input style="height:50px;width:400px; font-size: 30px;" type="text" class="form-control text-end" id="tenderbox" name="tenderbox" placeholder="Enter Amount" required> 
									
								</div>
								<div class="mt-2">  
									<div class="col-sm mt-4">
										<!-- <input type="submit" id="paynow" style="height:50px;width:80px; font-size: 30px;" value="PAY" class="btn-primary" onclick="assignValue()"> -->
										<input type="submit" id="paynow" style="height:50px;width:80px; font-size: 30px;" value="PAY" class="btn-primary">
									</div>
								</div>
								<div class="col">
								</div>
								<div class="col">
								</div>
							</div>
						<!-- </form> -->
					</div>
				
				</div>
				<!-- /.card-body -->
			</div>
		<!-- /.card -->
		</div>
		<!-- /.col -->
	</div>













	<div class="modal fade static" id="modalID" tabindex="-1" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Payment</h5>
					<buton type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</buton>
				</div>
				<div class="modal-body">
					<form id="myForm">
						<div class=" card-body" style="height:600px">
							

							<div class="form-group"> 
								<div class="container">
									<div class="row">
										<div class="col-1">
										</div>
										<div class="col-11">
											<label style="font-size: 80px; color:red">PAYMENT SUCCESSFUL</label> 
										</div>  
										<div class="col">
										</div>
									</div>

									</div><div class="row">
										<div class="col-sm">
											<label style="font-size: 50px;">Tendered Amount:</label> 
										</div> 
										<div class="col">
											<label id="tenderlabel" style="font-size: 50px;"></label>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm">
											<label style="font-size: 50px;">Amount Due:</label> 
										</div> 
										<div class="col"> 
											<label id="amountdue" style="font-size: 50px;"><?= "₱ " . number_format($gtotal) . ".00"?></label> 
										</div> 
									</div> 
									
<hr>
									<div class="row">
										<div class="col-sm">
											<label style="font-size: 80px;">Change:</label> 
										</div> 
										<div class="col">
										<label id="totalchange" style="font-size: 80px;"></label> 
										</div>
									</div>
									<!-- <div class="row">
										<div class="col-sm">
										</div>
										<div class="col-sm">
											<label for="tenderbox">TENDER AMOUNT</label>
											<input style="height:50px;width:600px; font-size: 30px;" type="text" class="form-control text-end" id="tenderbox" name="tenderbox" placeholder="Enter Amount" dir="rtl" required> 
										</div>
										<div class="col-sm">
										
										</div>
									</div> -->
								</div>
							</div>

						</div>

						<p style="margin-top:1%"  align="center">
							<i class="fa fa-print fa-2x" style="cursor: pointer;"  OnClick="CallPrint(this.value)" ></i>
						</p>
					</form>
				</div>
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
		location.reload()
		$("#modalID").modal('hide'); 
	}

	
	function assignValue() {
		
		var toeditId = document.getElementById("editthisid").value;  
		 
        var updatedData = {
            id: toeditId,  
            newData: "PAID"  
        };

        var xhr = new XMLHttpRequest();
        
        xhr.open('POST', 'updatewalkininvoicestatus.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
					
                    var response = JSON.parse(xhr.responseText);
                    console.log('Success:', response);
					document.getElementById("invoicestatus").textContent = "PAID";
					$("#modalID").modal('show'); 
                } else { 
                    console.error('Error:', xhr.statusText);
                }
            }
        };

        xhr.send(JSON.stringify(updatedData));
    } 

	$(document).ready(function(){
      $(document).on('click','#paynow',function(){
       
		var amountdue = parseFloat(document.getElementById("topay").value);
		var textBoxValue = parseFloat(document.getElementById("tenderbox").value);

		if (!isNaN(amountdue) && !isNaN(textBoxValue)) {
			if(textBoxValue >= amountdue){ 

				var totalChange = textBoxValue - amountdue;

				function addCommas(number) {
					
					var numStr = number.toString();

					var parts = numStr.split('.');
					var intPart = parts[0];
					var decPart = parts.length > 1 ? '.' + parts[1] : '';

					intPart = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

					return intPart + decPart;
				}

				var tenderedamount = textBoxValue;
				var change = totalChange;
				var thisdue = amountdue;

				var formatteddue = addCommas(thisdue);
				var formattedtenderamount = addCommas(tenderedamount);
				var formattedchange = addCommas(change);

				var formattedText = "₱ " + formattedtenderamount + ".00" + "<br>" + "₱ " + formatteddue + ".00" + "<br>" + "₱ " + formattedchange + ".00";

				var payinfoElement = document.getElementById("payinfo");

				payinfoElement.innerHTML = formattedText;  

				document.getElementById("tenderlabel").textContent = "₱ " + formattedtenderamount + ".00"; 

				document.getElementById("totalchange").textContent = "₱ " + formattedchange  + ".00"; 
				 
				assignValue();  
				
			}else{
				alert("Tendered Amount cannot be less than Amount Due!");
			}

		} else {
			alert("Please enter valid numeric values.");
		}

      });
    });
	 
</script>