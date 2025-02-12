<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "your_db_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch data for widgets
$revenueQuery = "SELECT SUM(amount) as total_revenue FROM sales";
$salesQuery = "SELECT COUNT(*) as total_sales FROM sales";
$growthQuery = "SELECT (SUM(amount) - LAG(SUM(amount)) OVER (ORDER BY month)) / LAG(SUM(amount)) OVER (ORDER BY month) * 100 as growth FROM sales GROUP BY month ORDER BY month DESC LIMIT 1";
$assetsQuery = "SELECT SUM(value) as total_assets FROM assets";

$revenueResult = $conn->query($revenueQuery);
$salesResult = $conn->query($salesQuery);
$growthResult = $conn->query($growthQuery);
$assetsResult = $conn->query($assetsQuery);

$revenue = $revenueResult->fetch_assoc()['total_revenue'];
$sales = $salesResult->fetch_assoc()['total_sales'];
$growth = $growthResult->fetch_assoc()['growth'];
$assets = $assetsResult->fetch_assoc()['total_assets'];

// Fetch data for charts
$salesChartQuery = "SELECT month, SUM(amount) as total_sales FROM sales GROUP BY month";
$expensesChartQuery = "SELECT month, SUM(amount) as total_expenses FROM expenses GROUP BY month";

$salesChartResult = $conn->query($salesChartQuery);
$expensesChartResult = $conn->query($expensesChartQuery);

$salesChartData = [];
$expensesChartData = [];

while ($row = $salesChartResult->fetch_assoc()) {
  $salesChartData[] = $row;
}

while ($row = $expensesChartResult->fetch_assoc()) {
  $expensesChartData[] = $row;
}

$response = [
  'revenue' => $revenue,
  'sales' => $sales,
  'growth' => $growth,
  'assets' => $assets,
  'salesChartData' => $salesChartData,
  'expensesChartData' => $expensesChartData,
];

echo json_encode($response);

$conn->close();
?>
