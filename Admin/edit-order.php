<?php
// Include database connection file
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_order'])) {
    // Get form data
    $order_id = $_POST['order_id'];
    $product_name = $_POST['product_name'];
    $order_date = $_POST['order_date'];
    $quantity = $_POST['quantity'];
    $shipping_address = $_POST['shipping_address'];
    $payment_method = $_POST['payment_method'];
    $total_amount = $_POST['total_amount'];
    $order_status = $_POST['order_status'];
    $customer_name = $_POST['customer_name'];

    // Prepare and execute SQL query to update order details
    $sql = "UPDATE orders SET product_name=?, order_date=?, quantity=?, shipping_address=?, payment_method=?, total_amount=?, order_status=?, customer_name=? WHERE order_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $product_name, $order_date, $quantity, $shipping_address, $payment_method, $total_amount, $order_status, $customer_name, $order_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Order successfully updated
        header('Location: all-orders.php'); // Redirect to all orders page
        exit;
    } else {
        // Failed to update order
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Check if the order ID is provided in the URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details from the database based on the order ID
    $sql = "SELECT * FROM orders WHERE order_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the order exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['product_name'];
        $order_date = $row['order_date'];
        $quantity = $row['quantity'];
        $shipping_address = $row['shipping_address'];
        $payment_method = $row['payment_method'];
        $total_amount = $row['total_amount'];
        $order_status = $row['order_status'];
        $customer_name = $row['customer_name'];
    } else {
        // Order not found
        echo "Order not found";
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
                <h4 class="page-title">Edit Order</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="edit-order.php" method="POST">
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Product Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="product_name" value="<?php echo $product_name; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input class="form-control" type="date" name="order_date" value="<?php echo $order_date; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input class="form-control" type="number" min="1" name="quantity" value="<?php echo $quantity; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Shipping Address</label>
                                <input class="form-control" type="text" name="shipping_address" value="<?php echo $shipping_address; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Payment Method</label>
                                <select class="form-control select" name="payment_method">
                                    <option <?php if ($payment_method == 'Credit Card') echo 'selected'; ?>>Credit Card</option>
                                    <option <?php if ($payment_method == 'M-pesa') echo 'selected'; ?>>M-pesa</option>
                                    <option <?php if ($payment_method == 'T-pesa') echo 'selected'; ?>>T-pesa</option>
                                    <option <?php if ($payment_method == 'A-money') echo 'selected'; ?>>A-money</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Total Amount</label>
                                <input class="form-control" type="text" name="total_amount" value="<?php echo $total_amount; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Order Status</label>
                                <select class="form-control select" name="order_status">
                                    <option <?php if ($order_status == 'processing') echo 'selected'; ?>>processing</option>
                                    <option <?php if ($order_status == 'Delivered') echo 'selected'; ?>>Delivered</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input class="form-control" type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" name="edit_order" type="submit">Update Order</button>
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
    // Function to calculate total amount
    function calculateTotal() {
        var price = parseFloat($('#product_name option:selected').data('price'));
        var quantity = parseInt($('#quantity').val());
        var total = price * quantity;
        $('#total_amount').val(total.toFixed(2)); // Display total with 2 decimal places
    }

    $(document).ready(function() {
        // Calculate total when product or quantity changes
        $('#product_name, #quantity').change(function() {
            calculateTotal();
        });
    });
</script>

    </body>
    </html>
    