// Initialize the student overview chart
// document.addEventListener('DOMContentLoaded', function() {
//     const canvas = document.getElementById('studentChart');
//     if (canvas) {
//         const ctx = canvas.getContext('2d');
//         // Sample data for the pie chart
//         const data = {
//             labels: ["Today's Enrollees", "Weekly Enrollees"],
//             datasets: [{
//                 data: [123, 1234],
//                 backgroundColor: [
//                     '#0f0',
//                     'rgba(0, 255, 0, 0.3)'
//                 ],
//                 borderColor: [
//                     '#0f0',
//                     '#0f0'
//                 ],
//                 borderWidth: 1
//             }]
//         };
//         // Chart configuration and creation...
//         new Chart(ctx, config);
//     }
//     ... (rest of code for other charts and tables)
// });

// Fetch and update dashboard stat cards
fetch('get_dashboard_stats.php')
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Update stat cards with specific IDs
            const todayEnrollees = document.getElementById('today-enrollees');
            const weeklyEnrollees = document.getElementById('weekly-enrollees');
            const todayCollected = document.getElementById('today-collected');
            const weeklyCollected = document.getElementById('weekly-collected');
            
            if (todayEnrollees) todayEnrollees.textContent = data.todayEnrollees;
            if (weeklyEnrollees) weeklyEnrollees.textContent = data.weeklyEnrollees;
            if (todayCollected) todayCollected.textContent = '₱' + data.todayCollected.toLocaleString();
            if (weeklyCollected) weeklyCollected.textContent = '₱' + data.weeklyCollected.toLocaleString();
            // Update Student Overview chart if present
            const studentChartCanvas = document.getElementById('studentChart');
            if (studentChartCanvas && window.Chart) {
                const ctx = studentChartCanvas.getContext('2d');
                if (
                    window.studentOverviewChart &&
                    window.studentOverviewChart.data &&
                    window.studentOverviewChart.data.datasets &&
                    window.studentOverviewChart.data.datasets[0]
                ) {
                    window.studentOverviewChart.data.datasets[0].data = [data.todayEnrollees, data.weeklyEnrollees];
                    window.studentOverviewChart.update();
                } else {
                    window.studentOverviewChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ["Today's Enrollees", "Weekly Enrollees"],
                            datasets: [{
                                data: [data.todayEnrollees, data.weeklyEnrollees],
                                backgroundColor: [
                                    '#0f0',
                                    'rgba(0, 255, 0, 0.3)'
                                ],
                                borderColor: [
                                    '#0f0',
                                    '#0f0'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        color: '#0f0',
                                        font: { size: 12 },
                                        padding: 20
                                    }
                                }
                            }
                        }
                    });
                }
            }
            // Update Active vs. Inactive Students chart
            console.log('Dashboard stats data:', data);
            console.log('ActiveInactiveChart element:', document.getElementById('activeInactiveChart'));
            const active = Number(data.activePayments) || 0;
            const inactive = Number(data.inactivePayments) || 0;
            // Workaround: if both are zero, set to small value so chart always renders
            const chartActive = (active === 0 && inactive === 0) ? 0.0001 : active;
            const chartInactive = (active === 0 && inactive === 0) ? 0.0001 : inactive;
            console.log('Active/Inactive Payments (safe):', chartActive, chartInactive);
            const activeInactiveCanvas = document.getElementById('activeInactiveChart');
            if (activeInactiveCanvas && window.Chart) {
                const ctx = activeInactiveCanvas.getContext('2d');
                if (
                    window.activeInactiveChart &&
                    window.activeInactiveChart.data &&
                    window.activeInactiveChart.data.datasets &&
                    window.activeInactiveChart.data.datasets[0]
                ) {
                    window.activeInactiveChart.data.datasets[0].data = [chartActive, chartInactive];
                    window.activeInactiveChart.update();
                } else {
                    window.activeInactiveChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Active', 'Inactive'],
                            datasets: [{
                                data: [chartActive, chartInactive],
                                backgroundColor: ['#0f0', '#fff'],
                                borderColor: ['#0f0', '#fff'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        color: '#fff',
                                        padding: 10,
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return context.label + ': ' + context.raw + ' students';
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }
        }
    })
    .catch(error => {
        console.error('Error fetching dashboard stats:', error);
        // Show error state in stat cards
        const statElements = ['today-enrollees', 'weekly-enrollees', 'today-collected', 'weekly-collected'];
        statElements.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Error';
            }
        });
    }); 

// --- Collected vs. Uncollected Payments Chart Logic ---
let paymentsChart;

function fetchAndRenderPaymentsChart() {
    const fromDate = document.getElementById('from-date').value;
    const toDate = document.getElementById('to-date').value;
    fetch('get_payments.php')
        .then(response => response.json())
        .then(payments => {
            // Filter by date range
            const filtered = payments.filter(p => {
                const paidDate = new Date(p.date_paid);
                const from = fromDate ? new Date(fromDate) : null;
                const to = toDate ? new Date(toDate) : null;
                if (from && paidDate < from) return false;
                if (to && paidDate > to) return false;
                return true;
            });
            let collected = 0, uncollected = 0;
            filtered.forEach(p => {
                const amt = parseFloat(p.amount_paid) || 0;
                if (String(p.status).toLowerCase() === 'paid' || String(p.status).toLowerCase() === 'active') {
                    collected += amt;
                } else {
                    uncollected += amt;
                }
            });
            // Always show at least a small value so chart renders
            if (collected === 0 && uncollected === 0) {
                collected = 0.0001;
                uncollected = 0.0001;
            }
            const paymentsCanvas = document.getElementById('paymentsChart');
            if (paymentsCanvas && window.Chart) {
                const ctx = paymentsCanvas.getContext('2d');
                if (paymentsChart) paymentsChart.destroy();
                paymentsChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Collected', 'Uncollected'],
                        datasets: [{
                            data: [collected, uncollected],
                            backgroundColor: ['#0f0', 'rgba(0, 255, 0, 0.3)'],
                            borderColor: ['#0f0', '#0f0'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    color: '#fff',
                                    padding: 10,
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.label + ': ₱' + context.raw.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
}

// Event listeners for date filters
const fromDateInput = document.getElementById('from-date');
const toDateInput = document.getElementById('to-date');
if (fromDateInput && toDateInput) {
    fromDateInput.addEventListener('change', fetchAndRenderPaymentsChart);
    toDateInput.addEventListener('change', fetchAndRenderPaymentsChart);
    // Initial render
    fetchAndRenderPaymentsChart();
}

// --- Dues Table Population ---
function fetchAndPopulateDues() {
    fetch('get_dues.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const duesTableBody = document.querySelector('.dues-table tbody');
                if (duesTableBody) {
                    // Clear existing rows
                    duesTableBody.innerHTML = '';
                    
                    if (data.dues.length === 0) {
                        // Show "No dues found" message
                        const noDataRow = document.createElement('tr');
                        noDataRow.innerHTML = '<td colspan="4" style="text-align: center; color: #fff;">No dues found for this month</td>';
                        duesTableBody.appendChild(noDataRow);
                    } else {
                        // Populate with dues data
                        data.dues.forEach(due => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${due.due_date}</td>
                                <td>${due.id_name}</td>
                                <td>₱${due.amount}</td>
                                <td>₱${due.discount}</td>
                                <td>₱${due.total_payment}</td>
                                <td>₱${due.amount_paid}</td>
                                <td>${due.contact}</td>
                            `;
                            duesTableBody.appendChild(row);
                        });
                    }
                }
            } else {
                console.error('Error fetching dues:', data.message);
            }
        })
        .catch(error => {
            console.error('Error fetching dues:', error);
        });
}

function fetchAndRenderActiveInactiveChart() {
    fetch('get_active_inactive_counts.php')
        .then(response => response.json())
        .then(counts => {
            console.log('Active/Inactive counts:', counts); // Debug log
            const active = counts.active || 0;
            const inactive = counts.inactive || 0;
            const chartActive = (active === 0 && inactive === 0) ? 0.0001 : active;
            const chartInactive = (active === 0 && inactive === 0) ? 0.0001 : inactive;
            const activeInactiveCanvas = document.getElementById('activeInactiveChart');
            if (activeInactiveCanvas && window.Chart) {
                const ctx = activeInactiveCanvas.getContext('2d');
                // Only destroy if it's a Chart instance
                if (window.activeInactiveChart && typeof window.activeInactiveChart.destroy === 'function') {
                    window.activeInactiveChart.destroy();
                }
                window.activeInactiveChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Active', 'Inactive'],
                        datasets: [{
                            data: [chartActive, chartInactive],
                            backgroundColor: ['#0f0', '#f00'],
                            borderColor: ['#0f0', '#f00'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    color: '#fff',
                                    padding: 10,
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.label + ': ' + context.raw + ' students';
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                console.error('activeInactiveChart canvas or Chart.js not found!'); // Debug log
            }
        })
        .catch(err => {
            console.error('Error fetching active/inactive counts:', err); // Debug log
        });
}

// Initialize dues table on page load
document.addEventListener('DOMContentLoaded', function() {
    fetchAndPopulateDues();
    fetchAndRenderActiveInactiveChart();
    
    // Refresh dashboard data every 5 minutes
    setInterval(function() {
        // Refresh dashboard stats
        fetch('get_dashboard_stats.php')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update stat cards with specific IDs
                    const todayEnrollees = document.getElementById('today-enrollees');
                    const weeklyEnrollees = document.getElementById('weekly-enrollees');
                    const todayCollected = document.getElementById('today-collected');
                    const weeklyCollected = document.getElementById('weekly-collected');
                    
                    if (todayEnrollees) todayEnrollees.textContent = data.todayEnrollees;
                    if (weeklyEnrollees) weeklyEnrollees.textContent = data.weeklyEnrollees;
                    if (todayCollected) todayCollected.textContent = '₱' + data.todayCollected.toLocaleString();
                    if (weeklyCollected) weeklyCollected.textContent = '₱' + data.weeklyCollected.toLocaleString();
                    
                    // Update charts if they exist
                    if (window.studentOverviewChart) {
                        window.studentOverviewChart.data.datasets[0].data = [data.todayEnrollees, data.weeklyEnrollees];
                        window.studentOverviewChart.update();
                    }
                    
                    if (window.activeInactiveChart) {
                        const active = Number(data.activePayments) || 0;
                        const inactive = Number(data.inactivePayments) || 0;
                        const chartActive = (active === 0 && inactive === 0) ? 0.0001 : active;
                        const chartInactive = (active === 0 && inactive === 0) ? 0.0001 : inactive;
                        window.activeInactiveChart.data.datasets[0].data = [chartActive, chartInactive];
                        window.activeInactiveChart.update();
                    }
                }
            })
            .catch(error => console.error('Error refreshing dashboard stats:', error));
            
        // Refresh dues table
        fetchAndPopulateDues();
        fetchAndRenderActiveInactiveChart(); // Refresh active/inactive chart
    }, 300000); // 5 minutes = 300,000 milliseconds

    // Dropdown is hover-driven via CSS for all sizes; no click toggling on mobile
}); 