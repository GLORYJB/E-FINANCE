<?php
session_start();
include('config.php');

// Register new customer
if (isset($_POST['create_customer'])) {
    // Customer details
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $profile = $_POST['profile'];
    $status = $_POST['status'];

    // Validate required fields
    if (empty($name) || empty($email) || empty($address) || empty($phone) || empty($status)) {
        $err = "All fields are required.";
    } else {
        // Get user_id from session
        $user_id = $_SESSION['user_id'];

        // Prepare and bind parameters
        $query = "UPDATE FROM customers (name, email, address, phone, profile, status, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssi", $name, $email, $address, $phone, $profile, $status, $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            $success = "Customer updated successfully";
            header('Location: customer.php');
            exit;
        } else {
            $err = "Failed to create customer. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>e-finasa </title>
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
                        <a class="dropdown-item" href="profile.php">My Profile</a>
                        <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                        <a class="dropdown-item" href="settings.php">Settings</a>
                        <a class="dropdown-item" href="login.php">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <a class="dropdown-item" href="settings.php">Settings</a>
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
                <h4 class="page-title">Edit Customer</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="edit-customer.php" method="POST">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" type="text" placeholder="Enter full name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" name="email" type="email" placeholder="Enter email" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control" name="country" id="countrySelect" required>
                                    <option value="">Select Country</option>
                                    <option value="">Tanzania</option>
                                    <option value="">Kenya</option>
                                    <option value="">Uganda</option>
                                    <!-- Countries will be populated dynamically -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Region</label>
                                <select class="form-control" name="region" id="regionSelect" required>
                                    <option value="">Select Region</option>
                                    <option value="">Dar es salaam</option>
                                    <option value="">Dodoma</option>
                                    <option value="">Arusha</option>
                                    <option value="">Nairobi</option>
                                    <option value="">Kampala</option>
                                    <!-- Regions will be populated dynamically based on selected country -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>District</label>
                                <select class="form-control" name="district" id="districtSelect" required>
                                    <option value="">Select District</option>
                                    <option value="">Ilala</option>
                                    <option value="">Temeke</option>
                                    <option value="">Kinondoni</option>
                                    <!-- Districts will be populated dynamically based on selected region -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" name="address" id="address" placeholder="Enter address">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" name="phone" type="text" placeholder="Enter phone number">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Profile Image</label>
                                <div class="profile-upload">
                                    <div class="upload-img">
                                        <img alt="" src="assets/img/user.jpg">
                                    </div>
                                    <div class="upload-input">
                                        <input type="file" name="profile" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="status" type="radio" id="customer_active" value="Active" checked>
                            <label class="form-check-label" for="customer_active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="status" type="radio" id="customer_inactive" value="Inactive">
                            <label class="form-check-label" for="customer_inactive">Inactive</label>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" name="edit_customer">Update Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
            
    <!-- Add the delete_customer modal -->
<div id="delete_customer" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="assets/img/sent.png" alt="" width="50" height="46">
                <h3>Are you sure want to delete this Customer?</h3>
                <div class="m-t-20">
                    <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include the modified customer content here -->
<?php
// Include the footer
include('footer.php');
?>


<!-- customers23:19 -->
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

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get reference to filter inputs and search button
        var idInput = document.querySelector('.filter-row input[name="id"]');
        var customerSelect = document.querySelector('.filter-row select[name="customer_name"]');
        var statusInput = document.querySelector('.filter-row input[name="status"]');
        var searchButton = document.getElementById('searchBtn');

        // Initialize the DataTable
        var table = $('#table').DataTable();

        // Add event listener to search button
        searchButton.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default form submission behavior

            // Get filter values
            var id = idInput.value.trim();
            var customer = customerSelect.value;
            var status = statusInput.value.trim();

            // Perform filtering based on the filter values
            table.columns(0).search(id).columns(1).search(customer).columns(2).search(status).draw();
        });
        
    });
   


</script>


</body>
</html>

    