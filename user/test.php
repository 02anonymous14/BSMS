<?php

include('includes/dbconnection.php');


  $bname='a';
  $bphone='a';
  $bemail='a';
  $bexpertise='a';
  $eid='3';

  $query=mysqli_query($con,"update  tblbeauticians set Name='$bname', Phone='$bphone', Email='$bemail', Expertise='$bexpertise' where ID='$eid' ");
  
  ?>