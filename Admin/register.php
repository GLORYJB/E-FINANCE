<?php
session_start();

// Database configuration
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "efin";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    // Check if any field is empty
    if (empty($username) || empty($password) || empty($email)) {
        $error_message = "Please fill in all fields.";
    } else {
        // Check if username or email already exists
        $check_stmt = $conn->prepare("SELECT user_id FROM user WHERE username = ? OR email = ?");
        $check_stmt->bind_param("ss", $username, $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $error_message = "Username or email already exists. Please choose a different one.";
        } else {
            // Prepare and execute SQL query to insert user into the database
            $insert_stmt = $conn->prepare("INSERT INTO user (username, password, email) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("sss", $username, $password_hash, $email); // Adjust data types accordingly
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $insert_stmt->execute();

            // Check if the query was successful
            if ($insert_stmt->affected_rows > 0) {
                $_SESSION['user'] = $username;
                $succ = "Registration successful";
                header("Location: login.php");
                exit();
            } else {
                $error_message = "Registration failed. Please try again.";
            }

            // Close the statement
            $insert_stmt->close();
        }
    }

    // Close the connection
    $conn->close();
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Fiserve register</title>
    <!-- Add your stylesheet link or any other head elements if needed -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>




<body>
<div class="main-wrapper account-wrapper" style="background-color: lightblue;">

        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                <?php
    // Display error message if registration failed
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    if (isset($succ)) {
        echo "<p style='color: green;'>$succ</p>";
    }
    ?>

                    <form action="register.php" method="POST" class="form-signin">
						<div class="account-logo">
                            <a href="index-2.html"><img src="assets/img/logo10.png" alt=""></a>
                        </div>
                        <?php
    if(isset($error_message1)) {
        echo '<p style="color: red;">' . $error_message1 . '</p>';
    }
    ?>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text"  name="username" class="form-control">
                        </div>
                        <?php
    if(isset($error_message1)) {
        echo '<p style="color: red;">' . $error_message1 . '</p>';
    }
    ?>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email"name="email" class="form-control">
                        </div>
                        <?php
    if(isset($error_message1)) {
        echo '<p style="color: red;">' . $error_message1 . '</p>';
    }
    ?>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        
                        <div class="form-group checkbox">
                            <label>
                                <input type="checkbox"> I have read and agree the Terms & Conditions
                            </label>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit">Signup</button>
                        </div>
                        <div class="text-center login-link">
                            Already have an account? <a href="login.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- register24:03-->
</html>