<?php
session_start();
include('config.php');

// Function to generate asset number
function generateAssetNumber($conn) {
    // Retrieve the latest asset number from the database
    $sql = "SELECT MAX(asset_number) AS max_asset_number FROM assets"; // Assuming 'assets' is your table name
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestAssetNumber = $row['max_asset_number'];

        // Extract the numeric part of the asset number and increment it
        $numericPart = intval(substr($latestAssetNumber, 4)); // Extract the numeric part and convert to integer
        $nextNumericPart = $numericPart + 1;

        // Format the next asset number
        $nextAssetNumber = "AST-" . str_pad($nextNumericPart, 3, '0', STR_PAD_LEFT); // Ensure the numeric part is three digits with leading zeros

        return $nextAssetNumber;
    } else {
        // If no asset number exists yet, start with AST-001
        return "AST-021";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_asset'])) {
    // Generate asset number
    $asset_no = generateAssetNumber($conn);

    // Get other form data
    $purchase_date = $_POST['date'];
    $value = $_POST['value'];
    $description = $_POST['description'];
    $asset_status = $_POST['asset_status'];
   
    // Get user_id from session
    $user_id = $_SESSION['user_id'];

    // Prepare and bind parameters
    $query = "INSERT INTO assets (asset_number, purchased_date, value, description, asset_status, user_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $asset_no, $purchase_date, $value, $description, $asset_status, $user_id );

    // Execute the statement
    if ($stmt->execute()) {
        // Asset successfully created
        $succ_msg = "Asset created successfully";
        header('Location: all-asset.php');
        exit;
    } else {
        // Failed to create asset
        echo "Error: " . $stmt->error;
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
                <h4 class="page-title">Add Asset</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="add-asset.php" method="POST">
                    <div class="row">
                    <div class="col-sm-6">
    <div class="form-group">
        <label>Asset number <span class="text-danger">*</span></label>
        <input class="form-control" type="text" id="asset_no" placeholder="Asset number" readonly required>
    </div>
</div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Purchased date</label>
                                <input class="form-control" type="date" name="date" placeholder="Enter date">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Value</label>
                                <input class="form-control" type="text" name="value" placeholder="Enter value">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" type="text" name="description" placeholder="Enter description"></textarea>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
    <div class="form-group">
        <label>asset Status</label>
        <select class="form-control select" name="asset_status">
            <option value="">Select asset Status</option>
            <option>active</option>
            <option>Inactive</option>


</select>
    </div>
</div>

                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" name = "create_asset" type="submit">Add asset</button>
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


    
    <!-- orders23:19 -->
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
    $(document).ready(function() {
        // Function to generate asset number
        function generateAssetNumber() {
            // Retrieve the latest asset number from the database or storage
            var latestAssetNumber = "AST-021"; // Placeholder for the latest asset number, you should fetch this from your database

            // Extract the numeric part of the asset number and increment it
            var numericPart = parseInt(latestAssetNumber.substr(4)); // Extract the numeric part and convert to integer
            var nextNumericPart = numericPart + 1;

            // Format the next asset number
            var nextAssetNumber = "AST-" + ("000" + nextNumericPart).slice(-3); // Ensure the numeric part is three digits

            // Update the input field value
            $('#asset_no').val(nextAssetNumber);
        }

        // Generate asset number when the page loads
        generateAssetNumber();

        // Update asset number before form submission
        $('#orderForm').submit(function() {
            generateAssetNumber(); // Ensure asset number is up to date before form submission
        });
    });
</script>



    </body>
    </html>
    