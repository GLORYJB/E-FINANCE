
<?php

session_start();
// Include database connection
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Retrieve form data
     $invoice_number = $_POST['invoice_number'];
     $customer_name = $_POST['customer_id']; // Assuming you need the customer name instead of ID
     $status = $_POST['status'];
     $tax = $_POST['tax'];
     $address = $_POST['address'];
     $invoice_date = $_POST['invoice_date'];
     $due_date = $_POST['due_date'];
     $total_amount = $_POST['total'];
     $tax_amount = $_POST['tax_amount'];
     $discount = $_POST['discount'];
     $grand_total = $_POST['grand_total'];
     $other_info = $_POST['other_info'];
     $user_id = 1; // Replace with the actual user ID if available


     // Prepare items and description fields
    $items = [];
    $descriptions = [];
    $unit_costs = [];
    $quantities = [];
    foreach ($_POST['items'] as $item) {
        $items[] = $item['product_id'];
        $descriptions[] = $item['description'];
        $unit_costs[] = $item['unit_price'];
        $quantities[] = $item['quantity'];
    }

    $items_str = implode(', ', $items);
    $descriptions_str = implode(', ', $descriptions);
    $unit_costs_str = implode(', ', $unit_costs);
    $quantities_str = implode(', ', $quantities);

    // Insert invoice data
    $sql = "INSERT INTO invoices (invoice_number, invoice_date, customer_name, total_amount, due_date, tax, address, items, description, status, user_id, unit_cost, quantity)
            VALUES ('$invoice_number', '$invoice_date', '$customer_name', '$total_amount', '$due_date', '$tax', '$address', '$items_str', '$descriptions_str', '$status', '$user_id', '$unit_costs_str', '$quantities_str')";

    if (mysqli_query($conn, $sql)) {
        $invoice_id = mysqli_insert_id($conn);

        // Insert invoice items
        foreach ($_POST['items'] as $item) {
            $product_id = $item['product_id'];
            $description = $item['description'];
            $unit_price = $item['unit_price'];
            $quantity = $item['quantity'];
            $total = $item['total'];

            $item_sql = "INSERT INTO poducts (invoice_id, product_id, description, unit_price, quantity, total)
                         VALUES ('$invoice_id', '$product_id', '$description', '$unit_price', '$quantity', '$total')";

            mysqli_query($conn, $item_sql);
        }

        echo "Invoice and items have been successfully saved.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);

    // Redirect or display a success message
    // For example:
    // header('Location: invoice_success.php');
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>e-finasa</title>
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
            <div class="col-sm-12">
                <h4 class="page-title">Create Invoice</h4>
            </div>
        </div>
        <div class="row">
    <div class="col-sm-12">
        <form action="new-invoice.php" method="post">
            <div class="row">
                <!-- Invoice Number -->
                <?php
                // Include database connection
                include('config.php');

                // Function to generate the next invoice number
                function generateInvoiceNumber($conn) {
                    // Query to get the latest invoice number
                    $sql = "SELECT MAX(invoice_id) AS max_id FROM invoices";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $max_id = $row['max_id'];

                        // Extract the numeric part of the invoice number
                        $numeric_part = intval(substr($max_id, 4));

                        // Increment the numeric part to generate the next invoice number
                        $next_numeric_part = $numeric_part + 6;

                        // Format the next invoice number with leading zeros (if needed)
                        $next_invoice_number = 'INV-' . str_pad($next_numeric_part, 3, '0', STR_PAD_LEFT);

                        return $next_invoice_number;
                    } else {
                        // If no existing invoices, start with INV-001
                        return 'INV-001';
                    }
                }

                // Generate the next invoice number
                $next_invoice_number = generateInvoiceNumber($conn);

                // Close database connection
                $conn->close();
                ?>

                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label>Invoice Number</label>
                        <input class="form-control" type="text" name="invoice_number" value="<?php echo $next_invoice_number; ?>" readonly>
                    </div>
                </div>

                <!-- Customer Dropdown -->
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label>Customer <span class="text-danger">*</span></label>
                        <select class="select form-control" name="customer_id">
                            <option value="">Please Select</option>
                            <?php
                            // Establish database connection
                            include('config.php');

                            // Query to fetch customers
                            $customer_query = "SELECT * FROM customers";
                            $customer_result = mysqli_query($conn, $customer_query);

                            // Loop through each customer and generate option tag
                            while ($customer_row = mysqli_fetch_assoc($customer_result)) {
                                echo "<option value='" . $customer_row['customer_id'] . "'>" . $customer_row['name'] . "</option>";
                            }

                            // Close database connection
                            mysqli_close($conn);
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Status Dropdown -->
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="select form-control" name="status">
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </div>
                </div>

                <!-- Tax Dropdown -->
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label>Tax</label>
                        <select class="select form-control" name="tax">
                            <option value="Select Tax">Select Tax</option>
                            <option value="VAT">VAT</option>
                            <option value="GST">GST</option>
                            <option value="No Tax">No Tax</option>
                        </select>
                    </div>
                </div>

                <!-- Address -->
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="3" name="address"></textarea>
                    </div>
                </div>

                <!-- Invoice Date -->
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label>Invoice Date <span class="text-danger">*</span></label>
                        <div class="cal-icon">
                            <input class="form-control datetimepicker" type="text" name="invoice_date">
                        </div>
                    </div>
                </div>

                <!-- Due Date -->
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label>Due Date <span class="text-danger">*</span></label>
                        <div class="cal-icon">
                            <input class="form-control datetimepicker" type="text" name="due_date">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="row">
            <?php
include('config.php');

if (isset($_GET['product_name'])) {
    $product_name = mysqli_real_escape_string($conn, $_GET['product_name']);
    $query = "SELECT unit_price, description FROM products WHERE name = '$product_name'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        echo json_encode($product);
    } else {
        echo json_encode(['unit_price' => 0, 'description' => '']);
    }
}

mysqli_close($conn);
?>

                <div class="col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-white">
                        <thead>
    <tr>
        <th style="width: 20px">#</th>
        <th class="col-sm-2">Item</th>
        <th class="col-md-6">Description</th>
        <th style="width:100px;">Unit Cost</th>
        <th style="width:80px;">Qty</th>
        <th>Amount</th>
        <th> </th>
    </tr>
</thead>
<tbody id="invoiceItems">
    <tr>
        <td>1</td>
        <td>
            <select class="form-control product-select" name="items[0][product_name]" style="min-width:150px">
                <option value="">Select Product</option>
                <?php
                // Fetch products from database
                include('config.php');
                $product_query = "SELECT * FROM products";
                $product_result = mysqli_query($conn, $product_query);
                while ($product_row = mysqli_fetch_assoc($product_result)) {
                    echo "<option value='" . $product_row['product_id'] . "' data-price='" . $product_row['unit_price'] . "'>" . $product_row['product_name'] . "</option>";
                }
                mysqli_close($conn);
                ?>
            </select>
        </td>
        <td><input class="form-control" type="text" name="items[0][description]" style="min-width:150px"></td>
        <td><input class="form-control unit-price" type="text" name="items[0][unit_price]" style="width:100px" readonly></td>
        <td><input class="form-control quantity" type="text" name="items[0][quantity]" style="width:80px"></td>
        <td><input class="form-control form-amt total-amount" readonly style="width:120px" type="text" name="items[0][total]"></td>
        <td><a href="javascript:void(0)" class="text-success font-18 add-item" title="Add"><i class="fa fa-plus"></i></a></td>
    </tr>
    </tr>
</tbody>

                        </table>
                    </div>
                </div>
            </div>

            <!-- Total, Tax, Discount, Grand Total -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-white">
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">Total</td>
                                    <td style="text-align: right; padding-right: 30px;width: 230px"><input class="form-control text-right" readonly type="text" name="total" value="0"></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">Tax</td>
                                    <td style="text-align: right; padding-right: 30px;width: 230px"><input class="form-control text-right" readonly type="text" name="tax_amount" value="0"></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">Discount %</td>
                                    <td style="text-align: right; padding-right: 30px;width: 230px"><input class="form-control text-right" type="text" name="discount"></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right; font-weight: bold">Grand Total</td>
                                    <td style="text-align: right; padding-right: 30px; font-weight: bold; font-size: 16px;width: 230px"><input class="form-control text-right" readonly type="text" name="grand_total" value="0"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Other Information -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Other Information</label>
                        <textarea class="form-control" name="other_info"></textarea>
                    </div>
                </div>
            </div>

            <!-- Save buttons -->
            <div class="text-center m-t-20">
                <button class="btn btn-grey submit-btn m-r-10" type="submit" name="save_send">Save & Send</button>
                <button class="btn btn-primary submit-btn" type="submit" name="save">Save</button>
            </div>
        </form>
    </div>
</div>





    <!-- Delete customer modal -->
    <div id="delete_invoice" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure you want to delete this Invoice?</h3>
                    <div class="m-t-20">
                        <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
// JavaScript to dynamically add or remove invoice items
document.querySelector('.add-item').addEventListener('click', function() {
    let tableBody = document.getElementById('invoiceItems');
    let rowCount = tableBody.rows.length;
    let row = tableBody.insertRow(rowCount);

    row.innerHTML = `
        <td>${rowCount + 1}</td>
        <td><input class="form-control" type="text" name="items[${rowCount}][product_name]" style="min-width:150px"></td>
        <td><input class="form-control" type="text" name="items[${rowCount}][description]" style="min-width:150px"></td>
        <td><input class="form-control" type="text" name="items[${rowCount}][unit_price]" style="width:100px"></td>
        <td><input class="form-control" type="text" name="items[${rowCount}][quantity]" style="width:80px"></td>
        <td><input class="form-control form-amt" readonly style="width:120px" type="text" name="items[${rowCount}][total]"></td>
        <td><a href="javascript:void(0)" class="text-danger font-18 remove-item" title="Remove"><i class="fa fa-trash-o"></i></a></td>
    `;
});

document.querySelector('#invoiceItems').addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-item')) {
        let row = e.target.closest('tr');
        row.parentNode.removeChild(row);
    }
});
</script>

<script>
function fetchProductDetails(index) {
    const productName = document.querySelectorAll('.product-select')[index].value;

    // AJAX request to fetch product details from the database
    fetch(`get_product_details.php?product_name=${encodeURIComponent(productName)}`)
        .then(response => response.json())
        .then(data => {
            const priceInput = document.querySelectorAll('input[name="items[' + index + '][unit_price]"]')[0];
            const descriptionInput = document.querySelectorAll('input[name="items[' + index + '][description]"]')[0];
            priceInput.value = data.unit_price;
            descriptionInput.value = data.description;
            calculateItemTotal(index);
        });
}

function calculateItemTotal(index) {
    const price = parseFloat(document.querySelectorAll('input[name="items[' + index + '][unit_price]"]')[0].value) || 0;
    const quantity = parseFloat(document.querySelectorAll('input[name="items[' + index + '][quantity]"]')[0].value) || 0;
    const total = price * quantity;
    document.querySelectorAll('input[name="items[' + index + '][total]"]')[0].value = total.toFixed(2);
    updateTotals();
}

function updateTotals() {
    let grandTotal = 0;
    const items = document.querySelectorAll('#invoiceItems tr');
    items.forEach((item, index) => {
        const itemTotal = parseFloat(item.querySelector('input[name="items[' + index + '][total]"]').value) || 0;
        grandTotal += itemTotal;
    });

    const discount = parseFloat(document.querySelector('input[name="discount"]').value) || 0;
    const taxRate = 0.15; // Example tax rate of 15%
    const taxAmount = grandTotal * taxRate;
    const total = grandTotal - (grandTotal * (discount / 100));
    const grandTotalValue = total + taxAmount;

    document.querySelector('input[name="total"]').value = grandTotal.toFixed(2);
    document.querySelector('input[name="tax_amount"]').value = taxAmount.toFixed(2);
    document.querySelector('input[name="grand_total"]').value = grandTotalValue.toFixed(2);
}

function addItem() {
    const table = document.getElementById('invoiceItems');
    const rowCount = table.rows.length;
    const row = table.insertRow(rowCount);
    row.innerHTML = `
        <td>${rowCount + 1}</td>
        <td>
            <input class="form-control product-select" type="text" name="items[${rowCount}][product_name]" style="min-width:150px" onchange="fetchProductDetails(${rowCount})">
        </td>
        <td><input class="form-control" type="text" name="items[${rowCount}][description]" style="min-width:150px"></td>
        <td><input class="form-control" type="text" name="items[${rowCount}][unit_price]" style="width:100px" readonly></td>
        <td><input class="form-control" type="text" name="items[${rowCount}][quantity]" style="width:80px" oninput="calculateItemTotal(${rowCount})"></td>
        <td><input class="form-control form-amt" readonly style="width:120px" type="text" name="items[${rowCount}][total]"></td>
        <td><a href="javascript:void(0)" class="text-danger font-18 remove-item" title="Remove" onclick="removeItem(this)"><i class="fa fa-trash-o"></i></a></td>
    `;
}

function removeItem(element) {
    const row = element.closest('tr');
    row.remove();
    updateTotals();
}
</script>

<script>
$(document).ready(function() {
    function calculateRowTotal(row) {
        var unitPrice = parseFloat($(row).find('.unit-price').val()) || 0;
        var quantity = parseInt($(row).find('.quantity').val()) || 0;
        var total = unitPrice * quantity;
        $(row).find('.total-amount').val(total.toFixed(2));
    }

    function calculateTotal() {
        var total = 0;
        $('#invoiceItems .total-amount').each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        $('input[name="total"]').val(total.toFixed(2));
        
        var tax = total * 0.1; // assuming 10% tax
        $('input[name="tax_amount"]').val(tax.toFixed(2));
        
        var discount = parseFloat($('input[name="discount"]').val()) || 0;
        var grandTotal = total + tax - discount;
        $('input[name="grand_total"]').val(grandTotal.toFixed(2));
    }

    $(document).on('change', '.product-select', function() {
        var unitPrice = $(this).find('option:selected').data('price');
        var row = $(this).closest('tr');
        $(row).find('.unit-price').val(unitPrice);
        calculateRowTotal(row);
        calculateTotal();
    });

    $(document).on('input', '.quantity, input[name="discount"]', function() {
        var row = $(this).closest('tr');
        calculateRowTotal(row);
        calculateTotal();
    });

    $(document).on('click', '.add-item', function() {
        var newRow = $('#invoiceItems tr:first').clone();
        newRow.find('input').val('');
        newRow.find('select').val('');
        $('#invoiceItems').append(newRow);
    });

    $(document).on('click', '.remove-item', function() {
        $(this).closest('tr').remove();
        calculateTotal();
    });
});
</script>





</body>

</html>
