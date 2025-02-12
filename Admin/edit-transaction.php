<?php
session_start(); 
include('config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_transaction'])) {
    // Get form data
    $transaction_id = $_POST['transaction_id'];
    $transaction_no = $_POST['transaction_no'];
    $transaction_date = $_POST['transaction_date'];
    $transaction_type = $_POST['transactionType']; 
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $customer_name = $_POST['customer_name'];
    
    
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; 
    } else {
        
        echo "Error: user_id is not set in the session.";
        exit; 
    }

    
    $sql = "UPDATE transactions SET transaction_number=?, transaction_date=?, transaction_type=?, amount=?, description=?, customer_name=? WHERE transaction_id=? AND user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdssii", $transaction_no, $transaction_date, $transaction_type, $amount, $description, $customer_name, $transaction_id, $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Transaction updated successfully
        header('Location: all-transactions.php'); // Redirect to all transactions page
        exit;
    } else {
       
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}


if (isset($_GET['transaction_id'])) {
    $transaction_id = $_GET['transaction_id'];

    // Fetch transaction details from the database based on the transaction ID
    $sql = "SELECT * FROM transactions WHERE transaction_id=? AND user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $transaction_id, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the transaction exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $transaction_no = $row['transaction_number'];
        $transaction_date = $row['transaction_date'];
        $transaction_type = $row['transaction_type'];
        $amount = $row['amount'];
        $description = $row['description'];
        $customer_name = $row['customer_name'];
    } else {
        // Transaction not found
        echo "Transaction not found";
    }

    // Close statement and result set
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

<body>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Edit Transaction</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="edit-transaction.php" method="POST">
                    <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Transaction No <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="transaction_no" value="<?php echo $transaction_no; ?>" placeholder="Enter transaction ID" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input class="form-control" type="text" name="amount" value="<?php echo $amount; ?>" placeholder="Enter transaction amount">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input class="form-control datetimepicker" name="transaction_date" value="<?php echo $transaction_date; ?>" placeholder="Enter transaction date">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input class="form-control" type="text" name="description" value="<?php echo $description; ?>" placeholder="Enter transaction description">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Customer</label>
                                <select class="form-control select" name="customer_name">
                                    <option value="">Select Customer</option>
                                    <?php
                                    // Fetch customers from the database and populate the dropdown menu
                                    include('config.php');
                                    $query = "SELECT * FROM customers";
                                    $result = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = ($row['name'] == $customer_name) ? "selected" : "";
                                            echo "<option value='" . $row['name'] . "' $selected>" . $row['name'] . "</option>";
                                        }
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="display-block">Transaction Type</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="transactionType" id="credit" value="credit" <?php if ($transaction_type == 'credit') echo 'checked'; ?>>
                                    <label class="form-check-label" for="credit">Credit</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="transactionType" id="debit" value="debit" <?php if ($transaction_type == 'debit') echo 'checked'; ?>>
                                    <label class="form-check-label" for="debit">Debit</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" name="edit_transaction" type="submit">Update Transaction</button>
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