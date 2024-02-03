<?php 

include('includes/dbconnection.php');  

$ret=mysqli_query($con,"select *from  tblappointment");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

    $data[] = [
        '#'             => $cnt,
        'AptNumber'     => $row['AptNumber'],
        'Name'          => $row['Name'],
        'PhoneNumber'   => $row['PhoneNumber'],
        'AptDate'       => $row['AptDate'],
        'AptTime'       => $row['AptTime'],
        'action'        => '<td>
                                <div class="row">
                                    <div class="col-1"> 
                                       <a href="#" class="btn btn-sm btn-info edit_data" id="' . $row['Appointment_ID'] . '" title="click for edit">View</a>
                                    </div>
                                    <div class="col-1">
                                        <form method="post"> 
                                            <input type="hidden" name="deletethisid" value="' . $row['Appointment_ID'] . '">
                                            <input type="submit" name="delete" class="ml-5 btn btn-sm btn-danger" value="Delete">
                                        </form>
                                    </div> 
                                </div>
                            </td>', 
    ];

    $cnt=$cnt+1;
    
}

echo json_encode(['data' => $data]);

?>