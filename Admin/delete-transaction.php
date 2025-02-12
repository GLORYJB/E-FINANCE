<?php
// Include database connection
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['transaction_id'])) {
        $transaction_id = $_POST['transaction_id'];

        // Prepare the SQL statement to delete the transaction
        $sql = "DELETE FROM transactions WHERE transaction_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $transaction_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Deletion successful, redirect or output success message
            header("Location: transactions.php?status=success");
        } else {
            // Error occurred, redirect or output error message
            header("Location: transactions.php?status=error");
        }

        $stmt->close();
    }
}

$conn->close();
?>
