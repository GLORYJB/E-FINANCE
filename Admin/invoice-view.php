<?php
session_start();
include('config.php'); // Include database connection file
?>

<?php

// Function to sanitize CSV content
function sanitizeForCsv($value) {
    // Escape double quotes and enclose in double quotes
    return '"' . str_replace('"', '""', $value) . '"';
}

// Function to output CSV file
function outputCsvFile($filename, $data) {
    // Set headers for CSV file download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '.csv"');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Output CSV headers
    fputcsv($output, array('Item', 'Description', 'Unit Cost', 'Quantity', 'Total'));

    // Output CSV rows
    foreach ($data as $item) {
        fputcsv($output, array(
            sanitizeForCsv($item['product_name']),
            sanitizeForCsv($item['description']),
            sanitizeForCsv($item['unit_price']),
            sanitizeForCsv($item['quantity']), // Adjust as per your actual field names
            sanitizeForCsv($item['total']) // Adjust as per your actual field names
        ));
    }

    // Close output stream
    fclose($output);

    // Exit script to prevent further output
    exit();
}

// Check if CSV export button was clicked
if (isset($_POST['export_csv'])) {
    // Assume $product_details contains the invoice items data
    $product_details = []; // Replace with your actual data

    // Output CSV file
    outputCsvFile('invoice_export', $product_details);
}
?>

<?php
// Include TCPDF library
require_once('tcpdf/tcpdf.php');

// Function to generate PDF file
function generatePdf($data) {
    // Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Invoice Export');
    $pdf->SetHeaderData('', '', 'Invoice Export', '');

    // Set default header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // Add a page
    $pdf->AddPage();

    // Set content
    $html = '<h1>Invoice Export</h1>';
    $html .= '<table border="1">';
    $html .= '<tr><th>Item</th><th>Description</th><th>Unit Cost</th><th>Quantity</th><th>Total</th></tr>';
    foreach ($data as $item) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($item['product_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($item['description']) . '</td>';
        $html .= '<td>$' . number_format((float) $item['unit_price'], 2) . '</td>'; // Format as currency
        $html .= '<td>' . (int) $item['quantity'] . '</td>';
        $html .= '<td>$' . number_format((float) $item['total'], 2) . '</td>'; // Format as currency
        $html .= '</tr>';
    }
    $html .= '</table>';

    // Output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('invoice_export.pdf', 'D');
    exit; // Ensure that no further output is sent
}

// Check if PDF export button was clicked
if (isset($_POST['export_pdf'])) {
    // Example data - Replace with your actual data retrieval logic
    $product_details = [
        ['product_name' => 'Laptop', 'description' => 'Dell Inspiron', 'unit_price' => 800.00, 'quantity' => 1, 'total' => 800.00],
        ['product_name' => 'Delivery Van', 'description' => 'Ford Transit', 'unit_price' => 20000.00, 'quantity' => 1, 'total' => 20000.00],
        // Add more items as needed
    ];

    // Generate PDF file
    generatePdf($product_details);
}
?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>e-finServe </title>
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


    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-5 col-4">
                    <h4 class="page-title">Invoice</h4>
                </div>
                <div class="col-sm-7 col-8 text-right m-b-30">
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-white" onclick="window.print();"><i class="fa fa-print fa-lg"></i> Print</button>
                    <form method="post">
                        <button type="submit" name="export_csv" class="btn btn-white">CSV</button>
                    </form>
                    <form method="post">
                        <button type="submit" name="export_pdf" class="btn btn-white">PDF</button>
                    </form>
                </div>

                </div>
            </div>
            <?php
// Include database connection
include('config.php');

// Function to fetch invoice data by invoice_id
function getInvoiceData($conn, $invoice_id) {
    // Query to fetch invoice data
    $sql = "SELECT * FROM invoices WHERE invoice_id = '$invoice_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Function to fetch company settings data
function getCompanySettings($conn) {
    // Query to fetch company settings
    $sql = "SELECT * FROM company_settings WHERE setting_name IN ('Company Logo', 'Company Address', 'Company Phone')";
    $result = $conn->query($sql);

    $settings = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $settings[$row['setting_name']] = $row['setting_value'];
        }
    }
    return $settings;
}

// Example usage to fetch invoice data
$invoice_id = 'INV-001'; // Replace with actual invoice_id you want to fetch
$invoice_data = getInvoiceData($conn, $invoice_id);

// Example usage to fetch company settings data
$company_settings = getCompanySettings($conn);

// Close database connection
$conn->close();
?>

<?php

include('config.php'); // Include database connection file

// Fetch invoice data based on invoice_id (example query, adjust as per your database structure)
if (isset($_GET['invoice_id'])) {
    $invoice_id = $_GET['invoice_id'];
    $query = "SELECT * FROM invoices WHERE invoice_id = $invoice_id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $invoice_data = mysqli_fetch_assoc($result);
    } else {
        // Handle case where invoice_id doesn't exist or query fails
        $invoice_data = null;
    }
} else {
    // Handle case where invoice_id is not set
    $invoice_data = null;
}

// Fetch company settings based on setting_id (example query, adjust as per your database structure)
$setting_id = 1; // Assuming you have a specific setting_id to fetch
$query_settings = "SELECT * FROM company_settings WHERE setting_id = $setting_id";
$result_settings = mysqli_query($conn, $query_settings);
if ($result_settings && mysqli_num_rows($result_settings) > 0) {
    $company_settings = mysqli_fetch_assoc($result_settings);
} else {
    // Handle case where setting_id doesn't exist or query fails
    $company_settings = array(
        'Company Logo' => '', // Default if not found
        'Company Address' => '' // Default if not found
        // Add other defaults as needed
    );
}

mysqli_close($conn); // Close the database connection after fetching data
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row custom-invoice">
                    <div class="col-6 col-sm-6 m-b-20">
                        <img src="assets/img/<?php echo isset($company_settings['Company Logo']) ? $company_settings['Company Logo'] : ''; ?>" class="inv-logo" alt="Company Logo">
                        <ul class="list-unstyled">
                            <li>e-Fiserve</li>
                            <li><?php echo isset($company_settings['Company Address']) ? $company_settings['Company Address'] : ''; ?></li>
                            <!-- Add other company details as needed -->
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 m-b-20">
                        <div class="invoice-details">
                            <h3 class="text-uppercase">Invoice #<?php echo isset($invoice_data['invoice_number']) ? $invoice_data['invoice_number'] : ''; ?></h3>
                            <ul class="list-unstyled">
                                <li>Date: <span><?php echo isset($invoice_data['invoice_date']) ? $invoice_data['invoice_date'] : ''; ?></span></li>
                                <li>Due date: <span><?php echo isset($invoice_data['due_date']) ? $invoice_data['due_date'] : ''; ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-6 m-b-20">
                        <h5>Invoice to:</h5>
                        <ul class="list-unstyled">
                            <li>
                                <h5><strong><?php echo isset($invoice_data['customer_name']) ? $invoice_data['customer_name'] : ''; ?></strong></h5>
                            </li>
                            <li><span><?php echo isset($invoice_data['Address']) ? $invoice_data['Address'] : ''; ?></span></li>
                            <!-- Add other customer details as needed -->
                        </ul>
                    </div>
                    <div class="col-sm-6 col-lg-6 m-b-20">
                        <div class="invoices-view">
                            <span class="text-muted">Payment Details:</span>
                            <ul class="list-unstyled invoice-payment-details">
                                <li>
                                    <h5>Total Due: <span class="text-right">$<?php echo isset($invoice_data['total_amount']) ? $invoice_data['total_amount'] : ''; ?></span></h5>
                                </li>
                                <li>Country: <span><?php echo isset($invoice_data['Country']) ? $invoice_data['Country'] : ''; ?></span></li>
                                <li>City: <span><?php echo isset($invoice_data['City']) ? $invoice_data['City'] : ''; ?></span></li>
                                <li>Address: <span><?php echo isset($invoice_data['Address']) ? $invoice_data['Address'] : ''; ?></span></li>
                                <li>Account No: <span><?php echo isset($invoice_data['Account No']) ? $invoice_data['Account No'] : ''; ?></span></li>
                                <li>Routing No: <span><?php echo isset($invoice_data['Routing No']) ? $invoice_data['Routing No'] : ''; ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ITEM</th>
                                <th>DESCRIPTION</th>
                                <th>UNIT COST</th>
                                <th>QUANTITY</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Check if invoice_data exists and loop through invoice items -->
                            <?php if ($invoice_data && isset($invoice_data['Items'])): ?>
                                <?php $items = explode(',', $invoice_data['Items']); ?>
                                <?php foreach ($items as $index => $item): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo $item; ?></td>
                                        <td><?php echo isset($invoice_data['description']) ? $invoice_data['description'] : ''; ?></td>
                                        <td>TZS<?php echo isset($invoice_data['unit_cost']) ? $invoice_data['unit_cost'] : ''; ?></td>
                                        <td><?php echo isset($invoice_data['quantity']) ? $invoice_data['quantity'] : ''; ?></td>
                                        <td>TZS<?php echo isset($invoice_data['total_amount']) ? $invoice_data['total_amount'] : ''; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="row invoice-payment">
                        <div class="col-sm-7">
                        </div>
                        <div class="col-sm-5">
                            <div class="m-b-20">
                                <h6>Total due</h6>
                                <div class="table-responsive no-border">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal:</th>
                                                <td class="text-right">$<?php echo isset($invoice_data['total_amount']) ? $invoice_data['total_amount'] : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tax: <span class="text-regular">(8%)</span></th>
                                                <td class="text-right">$<?php echo isset($invoice_data['Tax']) ? $invoice_data['Tax'] : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td class="text-right text-primary">
                                                    <h5>$<?php echo isset($invoice_data['total_amount']) ? $invoice_data['total_amount'] : ''; ?></h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-info">
                        <h5>Additional Information</h5>
                        <p class="text-muted">Thank you for choosing e-Fiserve for your financial services. For any inquiries, please contact our support team.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- Add your additional scripts here -->
</body>

</html>