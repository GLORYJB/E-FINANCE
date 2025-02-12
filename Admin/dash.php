<?php
session_start();
include('config.php');

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

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
        <?php


// Include database connection file
include('config.php');



// Initialize variables to store data
$total_payments = 0;
$total_transactions = 0;
$growth_percentage = 0;
$total_assets = 0;

// Fetch total payments
$sql = "SELECT SUM(amount) AS total_payments FROM payments";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_payments = $row['total_payments'];
}

// Fetch total transactions
$sql = "SELECT COUNT(*) AS total_transactions FROM transactions";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_transactions = $row['total_transactions'];
}

// Calculate growth percentage (this is just an example, you can adjust the logic as needed)
$sql = "SELECT ((SUM(current_month.amount) - SUM(previous_month.amount)) / SUM(previous_month.amount)) * 100 AS growth_percentage
        FROM (SELECT amount FROM payments WHERE MONTH(payment_date) = MONTH(CURRENT_DATE)) AS current_month,
             (SELECT amount FROM payments WHERE MONTH(payment_date) = MONTH(CURRENT_DATE) - 1) AS previous_month";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $growth_percentage = $row['growth_percentage'];
}

// Fetch total assets
$sql = "SELECT SUM(value) AS total_assets FROM assets";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_assets = $row['total_assets'];
}

// Close the database connection
$conn->close();
?>

            <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg1"><i class="fa fa-money" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3><?php echo number_format($total_payments); ?> TZS</h3>
                <span class="widget-title1">Payments <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa fa-shopping-cart"></i></span>
            <div class="dash-widget-info text-right">
                <h3><?php echo $total_transactions; ?></h3>
                <span class="widget-title2">Transactions <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg3"><i class="fa fa-line-chart" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3><?php echo number_format($growth_percentage, 2); ?>%</h3>
                <span class="widget-title3">Growth <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="dash-widget">
            <span class="dash-widget-bg4"><i class="fa fa-bank" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3><?php echo number_format($total_assets); ?> TZS</h3>
                <span class="widget-title4">Assets <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
                
                </div>
            </div>
            <?php


// Include database connection file
include('config.php');

// Fetch data for transactions
$transactions_data = [];
$sql = "SELECT DATE(transaction_date) as date, COUNT(*) as count FROM transactions GROUP BY DATE(transaction_date)";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $transactions_data[] = $row;
    }
}

// Fetch data for expenses and payments
$expenses_data = [];
$payments_data = [];
$sql = "SELECT DATE(payment_date) as date, SUM(amount) as total FROM payments GROUP BY DATE(payment_date)";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $payments_data[] = $row;
    }
}
$sql = "SELECT DATE(expense_date) as date, SUM(amount) as total FROM expenses GROUP BY DATE(expense_date)";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $expenses_data[] = $row;
    }
}

// Close the database connection
$conn->close();
?>

<div class="row">
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="chart-title">
                    <h4>Transactions Chart</h4>
                    <span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> 25% Higher than Last Month</span>
                </div>
                <canvas id="transactionsChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="chart-title">
                    <h4>Expenses vs. Payments</h4>
                    <span class="float-right">
                        <ul class="chat-user-total">
                            <li><i class="fa fa-circle current-users" aria-hidden="true"></i>Expenses</li>
                            <li><i class="fa fa-circle old-users" aria-hidden="true"></i>Payments</li>
                        </ul>
                    </span>
                </div>
                <canvas id="expensesPaymentsChart"></canvas>
            </div>
        </div>
    </div>
</div>




<?php


// Include database connection file
include('config.php');

// Fetch data for transactions
$transactions = [];
$sql = "SELECT transaction_id, customer_name, transaction_date, amount FROM transactions ORDER BY transaction_date DESC LIMIT 5";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
}

// Close the database connection
$conn->close();
?>


<div class="row">
    <div class="col-12 col-md-6 col-lg-8 col-xl-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Financial Summary</h4>
                <a href="transactions.html" class="btn btn-primary float-right">View all</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="d-none">
                            <tr>
                                <th>Customer</th>
                                <th>Transaction Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="text-right">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions as $transaction) : ?>
                                <tr>
                                    <td style="min-width: 200px;">
                                        <a class="avatar" href="profile.html"><?php echo strtoupper(substr($transaction['customer_name'], 0, 1)); ?></a>
                                        <h2><a href="profile.html"><?php echo $transaction['customer_name']; ?></a></h2>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Transaction Date</h5>
                                        <p><?php echo $transaction['transaction_date']; ?></p>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Amount</h5>
                                        <p><?php echo $transaction['amount']; ?></p>
                                    </td>
                                    
                                    <td class="text-right">
                                        <a href="transaction-details.php?id=<?php echo $transaction['transaction_id']; ?>" class="btn btn-outline-primary take-btn">View Details</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <?php


// Include database connection file
include('config.php');

// Fetch data for products
$products = [];
$sql = "SELECT product_id, product_name, product_date, quantity, description, unit_price, category, product_status FROM products";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Close the database connection
$conn->close();
?>

<div class="col-12 col-md-6 col-lg-4 col-xl-4">
    <div class="card member-panel">
        <div class="card-header bg-white">
            <h4 class="card-title mb-0">Products and Services</h4>
        </div>
        <div class="card-body">
            <ul class="contact-list">
                <?php foreach ($products as $product) : ?>
                <li>
                    <div class="contact-cont">
                        <div class="float-left user-img m-r-10">
                            <a href="product-details.php?id=<?php echo $product['product_id']; ?>" title="<?php echo $product['product_name']; ?>">
                                <img src="assets/img/product-placeholder.jpg" alt="<?php echo $product['product_name']; ?>" class="w-40 rounded-circle">
                                <span class="status <?php echo ($product['product_status'] == 'active') ? 'online' : 'offline'; ?>"></span>
                            </a>
                        </div>
                        <div class="contact-info">
                            <span class="contact-name text-ellipsis"><?php echo $product['product_name']; ?></span>
                            <span class="contact-date">Details about <?php echo $product['description']; ?></span>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="card-footer text-center bg-white">
    <a href="all-items.php" class="text-muted">View all Products</a>
</div>

    </div>
</div>



    </div>
    <div class="row">
    <div class="col-12 col-md-6 col-lg-8 col-xl-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">New Invoices</h4>
                <a href="invoice.php" class="btn btn-primary float-right">View all</a>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table mb-0 new-customer-table">
                        <tbody>
                            <?php
                            // Fetch new invoices data from the database
                            include('config.php'); // Include database connection

                            $sql = "SELECT invoice_id, invoice_number, invoice_date, customer_name, total_amount, due_date, status FROM invoices ORDER BY invoice_date DESC LIMIT 4";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo "<img width='28' height='28' class='rounded-circle' src='assets/img/user.jpg' alt=''>";
                                    echo "<h2>" . $row['customer_name'] . "</h2>";
                                    echo "</td>";
                                    echo "<td>" . $row['invoice_number'] . "</td>";
                                    echo "<td>" . $row['invoice_date'] . "</td>";
                                    echo "<td>" . $row['total_amount'] . "</td>";
                                    echo "<td><button class='btn btn-primary float-right'>" . $row['status'] . "</button></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No new invoices found</td></tr>";
                            }

                            // Close database connection
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


        <div class="col-12 col-md-6 col-lg-4 col-xl-4">
            <div class="hospital-barchart">
                <h4 class="card-title d-inline-block">Financial Management</h4>
            </div>
            <div class="bar-chart">
                <div class="legend">
                    <div class="item">
                        <h4>Sales</h4>
                    </div>
                    <div class="item">
                        <h4>Revenue</h4>
                    </div>
                    <div class="item text-right">
                        <h4>Expenses</h4>
                    </div>
                    <div class="item text-right">
                        <h4>Assets</h4>
                    </div>
                    <div class="item">
                        <h4>Liabilities</h4>
                    </div>
                    <div class="item">
                        <h4>Investment</h4>
                    </div>
                    <div class="item text-right">
                        <h4>Loans</h4>
                    </div>
                    <div class="item text-right">
                        <h4>Savings</h4>
                    </div>
                </div>
                <div class="chart clearfix">
                    <div class="item">
                        <div class="bar">
                            <span class="percent">16%</span>
                            <div class="item-progress" data-percent="16">
                                <span class="title">Sales</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bar">
                            <span class="percent">71%</span>
                            <div class="item-progress" data-percent="71">
                                <span class="title">Revenue</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bar">
                            <span class="percent">82%</span>
                            <div class="item-progress" data-percent="82">
                                <span class="title">Expenses</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bar">
                            <span class="percent">67%</span>
                            <div class="item-progress" data-percent="67">
                                <span class="title">Assets</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bar">
                            <span class="percent">30%</span>                                    
                            <div class="item-progress" data-percent="30">
                                <span class="title">Liabilities</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bar">
                            <span class="percent">50%</span>                                    
                            <div class="item-progress" data-percent="50">
                                <span class="title">Investment</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bar">
                            <span class="percent">20%</span>                                    
                            <div class="item-progress" data-percent="20">
                                <span class="title">Loans</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="bar">
                            <span class="percent">40%</span>                                    
                            <div class="item-progress" data-percent="40">
                                <span class="title">Savings</span>
                            </div>
                        </div>
                    </div>
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
    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
    var transactionsData = <?php echo json_encode($transactions_data); ?>;
    var expensesData = <?php echo json_encode($expenses_data); ?>;
    var paymentsData = <?php echo json_encode($payments_data); ?>;
</script>

<script>
    // Parse the transactions data
    var transactionDates = transactionsData.map(item => item.date);
    var transactionCounts = transactionsData.map(item => item.count);

    // Transactions Chart
    var ctx1 = document.getElementById('transactionsChart').getContext('2d');
    var transactionsChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: transactionDates,
            datasets: [{
                label: 'Transactions',
                data: transactionCounts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }
    });

    // Parse the expenses and payments data
    var expenseDates = expensesData.map(item => item.date);
    var expenseTotals = expensesData.map(item => item.total);
    var paymentDates = paymentsData.map(item => item.date);
    var paymentTotals = paymentsData.map(item => item.total);

    // Expenses vs. Payments Chart
    var ctx2 = document.getElementById('expensesPaymentsChart').getContext('2d');
    var expensesPaymentsChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: expenseDates,
            datasets: [{
                label: 'Expenses',
                data: expenseTotals,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Payments',
                data: paymentTotals,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });
</script>


</body>

</html>
