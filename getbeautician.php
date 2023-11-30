<?php 

    include('includes/dbconnection.php');
    session_start();
    error_reporting(0); 
    $q = ($_GET['q']);
    echo "<div>";
    echo "<div class='icon'><span class='fa fa-chevron-down'></span></div>";
    echo "<select name='beautician' id='beautician' class='form-control' required>";
    echo "<option style='color: black;'> Select Beautician </option>";
    $getcategory = mysqli_query($con,"SELECT DISTINCT Category FROM tblservices WHERE ServiceName ='".$q."'");
    $categoryrow = mysqli_fetch_array($getcategory);
    $category = $categoryrow['Category']; 

    // $beauticianlist = mysqli_query($con,"SELECT	NAME FROM beautician_with_services WHERE Services_ID ='$crntsrvsID'");
    $beauticianlist = mysqli_query($con,"SELECT `Name` FROM tblbeauticians where Department='$category'");
    while ($allbeautician = mysqli_fetch_array($beauticianlist)):;
    echo "<option style='color: black;' value='" . $allbeautician['Name'] . "'>" . $allbeautician['Name'] . "</option>";

    // echo $allbeautician["Name"] ;
    
?>
    
<?php
    endwhile; 
    echo "</select>";
    echo "</div>";
?>
