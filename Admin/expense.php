<?php
session_start();
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
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
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
                <div class="col-sm-8 col-5">
                    <h4 class="page-title">Expenses</h4>
                </div>
                <div class="col-sm-4 col-7 text-right m-b-30">
                    <a href="add-expense.html" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Expense</a>
                </div>
            </div>
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus">
                        <label class="focus-label">Item Name</label>
                        <input type="text" class="form-control floating">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
    <div class="form-group form-focus select-focus">
        <label class="focus-label">Purchased By</label>
        <select id="purchasedBy" class="form-control select" name="purchased_by">
            <option> -- Select -- </option>
            <?php
            // Include database connection file
            include('config.php');

            // Fetch options for "Purchased By" from the database
            $query = "SELECT DISTINCT purchased_by FROM expenses";
            $result = $conn->query($query);

            // Check if there are any options retrieved
            if ($result->num_rows > 0) {
                // Output each option
                while ($row = $result->fetch_assoc()) {
                    echo "<option>" . $row['purchased_by'] . "</option>";
                }
            }
            // Close database connection
            $conn->close();
            ?>
        </select>
    </div>
</div>

                
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus">
                        <label class="focus-label">From</label>
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus">
                        <label class="focus-label">To</label>
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <a href="#" id="searchBtn" class="btn btn-success btn-block"> Search </a>
                </div>
            </div>
     


            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                <th>Expense ID</th>
            <th>Expense Date</th>
            <th>Purchased By</th>
            <th>Amount</th>
            <th>Description</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

// Include database connection file
include('config.php');

// Check if the user is logged in

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Get the user_id from the session
$user_id = $_SESSION['user_id'];

// Fetch expense data from the database
$sql = "SELECT * FROM expenses WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any expenses
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['expense_id'] . "</td>";
        echo "<td>" . $row['expense_date'] . "</td>";
        echo "<td>" . $row['purchased_by'] . "</td>";
        echo "<td>" . $row['amount'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td class='text-center'>";
        echo "<div class='dropdown action-label'>";
        if ($row['status'] == 'Pending') {
            echo "<a class='custom-badge status-red dropdown-toggle' href='#' data-toggle='dropdown' aria-expanded='false'>Pending</a>";
        } else if ($row['status'] == 'Approved') {
            echo "<a class='custom-badge status-green dropdown-toggle' href='#' data-toggle='dropdown' aria-expanded='false'>Approved</a>";
        }
        echo "<div class='dropdown-menu dropdown-menu-right'>";
        echo "<a class='dropdown-item' href='#'>Pending</a>";
        echo "<a class='dropdown-item' href='#'>Approved</a>";
        echo "</div>";
        echo "</div>";
        echo "</td>";
        echo "<td class='text-right'>";
        echo "<div class='dropdown dropdown-action'>";
        echo "<a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>";
        echo "<div class='dropdown-menu dropdown-menu-right'>";
        echo "<a class='dropdown-item' href='edit-expense.html'><i class='fa fa-pencil m-r-5'></i> Edit</a>";
        echo "<a class='dropdown-item' href='#' data-toggle='modal' data-target='#delete_expense'><i class='fa fa-trash-o m-r-5'></i> Delete</a>";
        echo "</div>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No expenses found</td></tr>";
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>


                            </tbody>
                        </table>
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
    document.getElementById('searchBtn').addEventListener('click', function() {
        var itemName = document.getElementById('itemName').value;
        var purchasedBy = document.getElementById('purchasedBy').value;
        // Get other filter criteria if needed

        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'search.php?itemName=' + itemName + '&purchasedBy=' + purchasedBy, true);
        xhr.onload = function() {
            if (xhr.status == 200) {
                // Handle the response from the server
                var result = xhr.responseText;
                // Update the DOM with the filtered data
                // Example: document.getElementById('filteredData').innerHTML = result;
            }
        };
        xhr.send();
    });
</script>

</body>
</html>

    