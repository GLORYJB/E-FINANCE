<?php
// Include database connection file
include('config.php');

// Check if payment ID is provided in the URL
if(isset($_GET['payment_id'])) {
    // Get the payment ID from the URL
    $payment_id = $_GET['payment_id'];

    // Prepare a DELETE statement
    $query = "DELETE FROM payments WHERE payment_id = ?";
    $stmt = $conn->prepare($query);
    
    // Bind parameters and execute the statement
    $stmt->bind_param("i", $payment_id);
    if($stmt->execute()) {
        // If deletion is successful, redirect back to the page where the delete button was clicked
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // If deletion fails, display an error message
        echo "Error: " . $conn->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If payment ID is not provided, redirect to an error page
    header("Location: error.php");
    exit();
}
?>
