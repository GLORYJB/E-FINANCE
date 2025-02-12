<?php
// Start session
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

    // Check if username or password is empty
    if (empty($username) || empty($password)) {
        $error_message = "Please fill in both username and password fields.";
    } else {
        // Prepare and execute SQL query to retrieve user from the database
        $stmt = $conn->prepare("SELECT user_id, password FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        // Check if the user exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $stored_password);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $stored_password)) {
                $_SESSION['user'] = $username;
                $_SESSION['user_id'] = $user_id;
                header("Location: dash.php"); // Redirect to dashboard or any other page
                exit();
            } else {
                $error_message = "Invalid password. Please try again.";
            }
        } else {
            $error_message = "User not found. Please check your username.";
        }

        // Close the statement
        $stmt->close();
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
    <title>e-Fiserve Login</title>
    <!-- Add your stylesheet link or any other head elements if needed -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
   
<!--
[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
<div class="main-wrapper account-wrapper" style="background-color: lightblue;">

        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                <?php if(isset($error_message)) { echo '<p style="color:red;">' . $error_message . '</p>'; } ?>
                    <form action="login.php" method="POST" class="form-signin">
                        <div class="account-logo">
                            <a href="index-2.html"><img src="assets/img/logo10.png" alt="e-Fiserve Logo"></a>
                        </div>
                        <?php
    if(isset($error_message1)) {
        echo '<p style="color: red;">' . $error_message1 . '</p>';
    }
    ?>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name= "username"  class="form-control">
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
                        <div class="form-group text-right">
                            <a href="forgot-password.html">Forgot your password?</a>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn">Login</button>
                        </div>
                        <div class="text-center register-link">
                            Don’t have an account? <a href="register.php">Register Now</a>
                        </div>

                        <div class="form-group text-center">
    <a href="../PUBLIC1/index.html" class="btn btn-warning account-btn">
        <i class="fa fa-arrow-left"></i> Back
    </a>
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
    <!-- Add your additional scripts here -->
</body>

</html>
