<?php
include('config.php'); // Include your database connection

if(isset($_POST['region'])) {
    $country_id = $_POST['country_id'];

    // Query to fetch regions based on the selected country_id
    $query = "SELECT * FROM regions WHERE country_id = $country_id";
    $result = mysqli_query($conn, $query);

    // Generate HTML options for regions
    $options = '<option value="">Select Region</option>';
    while($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="'.$row['region_id'].'">'.$row['region_name'].'</option>';
    }

    echo $options;
}
?>
