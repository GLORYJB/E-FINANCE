<?php
// Include the configuration file
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_asset'])) {
    // Get form data
    $asset_id = $_POST['asset_id'];
    $purchased_date = $_POST['date'];
    $value = $_POST['value'];
    $description = $_POST['description'];
    $asset_status = $_POST['asset_status'];

    // Prepare and execute SQL query to update asset details
    $sql = "UPDATE assets SET purchased_date=?, value=?, description=?, asset_status=? WHERE asset_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $purchased_date, $value, $description, $asset_status, $asset_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Asset details successfully updated
        header('Location: all-asset.php'); // Redirect to all assets page
        exit;
    } else {
        // Failed to update asset details
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
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
        <h4 class="page-title">Edit Asset</h4>
    </div>
</div>
<?php 
// Check if the asset ID is provided in the URL
if (isset($_GET['asset_id'])) {
    $asset_id = $_GET['asset_id'];

    // Fetch asset details from the database based on the asset ID
    $sql = "SELECT * FROM assets WHERE asset_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $asset_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the asset exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $asset_number = $row['asset_number'];
        $purchased_date = $row['purchased_date'];
        $value = $row['value'];
        $description = $row['description'];
        $asset_status = $row['asset_status'];
    } else {
        // Asset not found
        $error_msg = "Asset not found.";
    }

    // Close statement and result set
    $stmt->close();
}

// Close connection
$conn->close();
?>

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form action="edit-asset.php" method="POST">
            <!-- Asset ID as a hidden field -->
            <input type="hidden" name="asset_id" value="<?php echo $asset_id; ?>">

            <div class="row">
                <!-- Asset Number -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Asset Number <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="asset_number" value="<?php echo $asset_number; ?>" readonly required>
                    </div>
                </div>

                <!-- Purchased Date -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Purchased Date</label>
                        <input class="form-control" type="date" name="purchased_date" value="<?php echo $purchased_date; ?>" placeholder="Enter purchased date">
                    </div>
                </div>

                <!-- Value -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Value</label>
                        <input class="form-control" type="text" name="value" value="<?php echo $value; ?>" placeholder="Enter value">
                    </div>
                </div>

                <!-- Description -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" placeholder="Enter description"><?php echo $description; ?></textarea>
                    </div>
                </div>

                <!-- Asset Status -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Asset Status</label>
                        <select class="form-control" name="asset_status">
                            <option value="">Select Asset Status</option>
                            <option value="active" <?php if($asset_status == 'active') echo 'selected'; ?>>Active</option>
                            <option value="inactive" <?php if($asset_status == 'inactive') echo 'selected'; ?>>Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn" name="update_asset" type="submit">Update Asset</button>
                </div>
            </div>
        </form>
        <?php
        if (isset($error_msg)) {
            echo "<p class='text-danger'>$error_msg</p>";
        }
        ?>
    </div>
</div>
    </div>
</div>

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
