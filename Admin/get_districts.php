<?php
include('config.php'); // Include your database connection

if(isset($_POST['district'])) {
    $region_id = $_POST['region_id'];

    // Query to fetch districts based on the selected region_id
    $query = "SELECT * FROM districts WHERE region_id = $region_id";
    $result = mysqli_query($conn, $query);

    // Generate HTML options for districts
    $options = '<option value="">Select District</option>';
    while($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="'.$row['district_id'].'">'.$row['district_name'].'</option>';
    }

    echo $options;
}
?>
