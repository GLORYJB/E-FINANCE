<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Include database connection file
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_payment'])) {
    // Get form data
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['pay_amount'];
    $payment_date = $_POST['pay_date'];
    $customer_id = $_POST['customer_id'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    // Get user ID from the session
    $user_id = $_SESSION['user_id'];

    // Prepare and bind parameters for the query
    $query = "INSERT INTO payments (invoice_number, amount, payment_date, customer_id, status, description, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $invoice_number, $amount, $payment_date, $customer_id, $status, $description, $user_id);

    // Execute the query
    if ($stmt->execute()) {
        // Payment created successfully
        $success_msg = "Payment created successfully.";
        header('Location: payments.php');
        exit;
    } else {
        // Error creating payment
        $error_msg = "Error: Unable to create payment. Please try again.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>e-finasa </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
<div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="index.html" class="logo">
                    <span>e-finasa</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <!-- Update navigation links below -->
                
                <li class="nav-item"><a href="#" class="nav-link">Upgrade</a></li>
                <!-- Add more navigation links as needed -->
                
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="assets/img/user.jpg" width="24" alt="User">
                            <span class="status online"></span>
                        </span>
                        <span >
                        <?php 
       
        include('config.php');
        if (isset($_SESSION['username'])) {

            $username = $_SESSION['username'];
            
            echo "Welcome, $username!";
        } else {
            echo "Unknown";
        }
        
        ?>
        </span> <!-- Replace with the user's name -->
                    </a>
                    <div class="dropdown-menu">
                        <!-- Customize user profile dropdown links -->
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                        <a class="dropdown-item" href="settings.html">Settings</a>
                        <a class="dropdown-item" href="login.php">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="login.php">Logout</a>
                </div>
            </div>
        </div>


    </div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">Main</li>
                    <li class="active">
                        <a href="dash.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-cog"></i> <span>Settings</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="company-settings.php">Company Settings</a></li>
                            <li><a href="account-settings.php">Account Settings</a></li>
                        </ul>
                    </li>
                    
                    
                    <li class="menu-title">ERP</li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-money"></i> <span>Transactions</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="all-transactions.php">View transactions</a></li>
                            <li><a href="new-transactions.php">new transactions</a></li>
                        
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-money"></i> <span>Payments</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="payments.php">View Payments</a></li>
                        
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-users"></i> <span>Assets</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="all-asset.php">All assets</a></li>
                            <li><a href="add-asset.php">Add assets</a></li>
                            
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-book"></i> <span>Accounts</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                        <li><a href="invoice.php">invoice</a></li>
                            <li><a href="expense.php">Expenses</a></li>
                            
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-users"></i> <span>Capital</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="all-capital.php">All capitals</a></li>
                            <li><a href="add-capital.php">Add capital</a></li>
                            
                        </ul>
                    </li>
                   
                   
                    <li class="menu-title">Supply chain</li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-cube"></i> <span>Inventory</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="all-items.php">All Items</a></li>
                            <li><a href="add-item.php">Add Item</a></li>
                            <li><a href="suppliers-list.php">Suppliers</a></li>
                            
                            
                        </ul>
                    </li>
                    <li class="menu-title">Reports</li>
                    
                    
                    <li>
                        <a href="invoices.php"><i class="fa fa-file-text-o"></i> <span>Invoices settings</span></a>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-bar-chart"></i> <span>Reports</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="financial-reports.php">Financial Reports</a></li>
                            <li><a href="sales-reports.php">Sales Reports</a></li>
                            
                        </ul>
                    </li>
                    
                    <li>
                        <a href="tax.php"><i class="fa fa-tasks"></i> <span>Tax</span></a>
                    </li>
                    <li class="menu-title">Other</li>
                    
                    <li>
                        <a href="forex.html"><i class="fa fa-bell-o"></i> <span>Forex Exchange</span></a>
                    </li>
                    
                    
                   
                </ul>
            </div>
        </div>
    </div>
    <div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Payment</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="new-payment.php" method="POST">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Invoice Number</label>
                                <select class="form-control select" name="invoice_number">
                                    <option value="">Select Invoice Number</option>
                                    <?php
                                    // Fetch invoice numbers from the database
                                    include('config.php'); // Include database connection

                                    $sql = "SELECT invoice_number FROM invoices";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['invoice_number'] . "'>" . $row['invoice_number'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No invoice numbers found</option>";
                                    }

                                    $conn->close(); // Close database connection
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Payment Amount</label>
                                <input class="form-control" type="text" name="pay_amount" placeholder="Enter payment amount">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Payment Date</label>
                                <input class="form-control" type="date" name="pay_date" placeholder="Enter payment date">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" placeholder="Enter description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Customer ID</label>
                            <select class="form-control select" name="customer_id">
                                <option value="">Select Customer ID</option>
                                <?php
                                // Fetch customer IDs from the database
                                include('config.php'); // Include database connection

                                $sql = "SELECT customer_id FROM customers";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['customer_id'] . "'>" . $row['customer_id'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No customers found</option>";
                                }

                                $conn->close(); // Close database connection
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="customer_active" value="Completed" checked>
                            <label class="form-check-label" for="customer_active">Completed</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="customer_inactive" value="Pending">
                            <label class="form-check-label" for="customer_inactive">Pending</label>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" name="create_payment">Create Payment</button>
                    </div>
                    <div class="m-t-20 text-left">
                        <a href="proceed_pay.php">
                            <button class="btn btn-success submit-btn" name="proceed_payment">Proceed to Payment</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <?php
// Include the footer
include('footer.php');
?>


    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- Add your additional scripts here -->
</body>

</html>