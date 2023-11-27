<?php
include('dbconnection.php');

$sql = "select Appointment_ID from  tblappointment where Status=''";
$result = $con->query($sql);

echo $result->num_rows;

?>