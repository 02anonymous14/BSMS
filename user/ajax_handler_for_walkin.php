<?php 

include('includes/dbconnection.php');  

$ret = mysqli_query($con, "SELECT * FROM tblcustomers");
$cnt = 1;
$data = [];

while ($row = mysqli_fetch_assoc($ret)) {
    $data[] = [
        '#'             => $cnt,
        'Name'          => $row['Name'],
        'Mobile'        => $row['MobileNumber'],
        'Creation Date' => $row['CreationDate'],
        'action'        => '<td>
                                <div class="row">
                                    <div class="col-1">
                                        <a href="#" class="btn btn-sm btn-primary edit_data" id="' . $row['Customers_ID'] . '" title="click for edit">Edit</a>
                                    </div>
                                    <div class="col-1">
                                        <form method="post">
                                            <input type="hidden" name="deletethisid" value="' . $row['Customers_ID'] . '">
                                            <input type="submit" name="delete" class="ml-1 btn btn-sm btn-danger" value="Delete">
                                        </form>
                                    </div>
                                    <div class="col pl-5">
                                        <a href="#" class="btn btn-sm btn-info edit_data2" id="' . $row['Customers_ID'] . '" title="assign services">Assign Services</a>
                                    </div>
                                </div>
                             </td>', 
    ];
    $cnt = $cnt + 1;
}

echo json_encode(['data' => $data]);


?>