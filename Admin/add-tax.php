<?php
// Start a PHP session
session_start();

// Include database connection file
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $tax_name = $_POST['tax_name'];
    $tax_percentage = $_POST['tax_percentage'];
    $status = $_POST['status'];
    
    // Retrieve user_id from the session
    $user_id = $_SESSION['user_id'];

    // Prepare and execute SQL query to insert data into the database
    $sql = "INSERT INTO taxes (tax_name, tax_percentage, status, user_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $tax_name, $tax_percentage, $status, $user_id);
    
    // Check if the query executed successfully
    if ($stmt->execute()) {
        // Redirect to a success page or display a success message
        header("Location: tax.php");
        exit();
    } else {
        // Handle the case when the query fails
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
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
                <li class="nav-item"><a href="dash.html" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="transactions.html" class="nav-link">Transactions</a></li>
                <li class="nav-item"><a href="reports.html" class="nav-link">Reports</a></li>
                <!-- Add more navigation links as needed -->
                
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="assets/img/user.jpg" width="24" alt="User">
                            <span class="status online"></span>
                        </span>
                        <span>User Name</span> <!-- Replace with the user's name -->
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
                    <li class="menu-title">CRM</li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-users"></i> <span>Customers</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="active"><a href="customer.php">All Customers</a></li>
                            <li><a href="new-customer.php">New Customer</a></li>
                            
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-shopping-cart"></i> <span>Orders</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="all-orders.php">All Orders</a></li>
                            <li><a href="new-orders.php">new Orders</a></li>
                            
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-money"></i> <span>Sales</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="all-sales.php">All Sales</a></li>
                            <li><a href="new-sales.php">new Sales</a></li>
                            
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
                    <li class="submenu">
                        <a href="#"><i class="fa fa-line-chart"></i> <span>Investments</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="investment-portfolio.php">Investment Portfolio</a></li>
                            <li><a href="add-investment.php">Add Investment</a></li>
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
                    
                    <li class="submenu">
                        <a href="#"><i class="fa fa-file"></i> <span>Documents</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="all-documents.html">All Documents</a></li>
                            <li><a href="upload-document.html">Upload Document</a></li>
                           
                        </ul>
                    </li>
                    <li>
                        <a href="calendar.html"><i class="fa fa-calendar"></i> <span>Calendar</span></a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </div>

    <div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Tax</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="add-tax.php" method="POST">
                    <div class="form-group">
                        <label>Tax Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="tax_name" required>
                    </div>
                    <div class="form-group">
                        <label>Tax Percentage (%) <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="tax_percentage" required>
                    </div>
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="form-control select" name="status">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                        </select>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" type="submit">Create Tax</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

			
            
<!-- Add the delete_payment modal -->
<div id="delete_payment" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to delete this Payment?</h3>
                    <div class="m-t-20">
                        <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <a href = "delete.php">
                        <button type="submit" class="btn btn-danger">Delete</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
// Include the footer
include('footer.php');
?>

    
    <!-- payments23:19 -->
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
    </body>
    </html>


