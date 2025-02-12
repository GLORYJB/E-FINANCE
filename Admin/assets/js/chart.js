 // Sales Chart Data (Area Chart)
 var salesData = {
	labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
	datasets: [{
		label: 'Sales',
		backgroundColor: 'rgba(0, 158, 251, 0.5)',
		borderColor: 'rgba(0, 158, 251, 1)',
		borderWidth: 1,
		data: [35, 59, 80, 81, 56, 55]
	}]
};

// Expenses vs. Revenue Chart Data (Bar Chart)
var expensesData = {
	labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
	datasets: [
		{
			label: 'Expenses',
			backgroundColor: 'rgba(255, 99, 132, 0.5)',
			borderColor: 'rgba(255, 99, 132, 1)',
			borderWidth: 1,
			data: [12, 19, 3, 5, 2, 3]
		},
		{
			label: 'Revenue',
			backgroundColor: 'rgba(75, 192, 192, 0.5)',
			borderColor: 'rgba(75, 192, 192, 1)',
			borderWidth: 1,
			data: [20, 15, 18, 25, 10, 12]
		}
	]
};

// Sales Chart (Area Chart)
var ctxSales = document.getElementById('salesChart').getContext('2d');
var salesChart = new Chart(ctxSales, {
	type: 'line',
	data: salesData,
	options: {
		responsive: true,
		legend: {
			display: true,
		},
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero: true
				}
			}]
		}
	}
});

// Expenses vs. Revenue Chart (Bar Chart)
var ctxExpenses = document.getElementById('expensesChart').getContext('2d');
var expensesChart = new Chart(ctxExpenses, {
	type: 'bar',
	data: expensesData,
	options: {
		responsive: true,
		legend: {
			display: true,
		},
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero: true
				}
			}]
		}
	}
});