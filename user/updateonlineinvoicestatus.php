<?php 

    include('includes/dbconnection.php');
    session_start();
    error_reporting(0); 

    // Handle the POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the data from the request body
        $requestData = json_decode(file_get_contents("php://input"), true);

        // Perform the data update (replace this with your actual update logic)
        $id = $requestData['id'];
        $newData = $requestData['newData'];

        // Your database update logic or other update process goes here
        $query = mysqli_query($con, "UPDATE tblinvoice_from_onlineappointment SET Paymentstatus='$newData' WHERE BillingId='$id' AND Paymentstatus='UNPAID'");

        if ($query) {
            // If the query is successful
            $response = ['status' => 'success', 'message' => 'Data updated successfully'];
        } else {
            // If the query fails
            $response = ['status' => 'error', 'message' => 'Error updating data: ' . mysqli_error($con)];
        }
        echo json_encode($response);
    } else {
        // Respond with an error message for unsupported request method
        $response = ['status' => 'error', 'message' => 'Invalid request method'];
        echo json_encode($response);
    }
    
?>
     