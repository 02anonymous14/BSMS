<?php 

    include('includes/dbconnection.php');
    session_start();
    error_reporting(0); 
    
 
   // Get data from the AJAX request
    $cat =  $_POST['category'];
     
    
    // Insert data into the database
    // $sql = "INSERT INTO tblcategory (category) VALUES ('$cat')";
    $query=mysqli_query($con, "INSERT INTO tblcategory (category) VALUES ('$cat')");
    if ($query) {
      echo "<script>alert('Service has been added.');</script>"; 
      echo "<script>window.location.href = 'add_service.php'</script>";   
      $msg="";
    }
    else
    {
      echo "<script>alert('Something Went Wrong. Please try again.');</script>";    
    }

    // if ($conn->query($sql) === TRUE) {
    //     echo "Data inserted successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }

    // // Close the database connection
    // $conn->close();
    
?> 
