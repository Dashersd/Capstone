<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'MARSIANS Taekwondo System - Admin Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="admin_collection.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container-fluid">
        <!-- Sidebar: Bootstrap responsive offcanvas (offcanvas on < md, static on >= md) -->
        <div class="sidebar offcanvas-md offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel" role="navigation" aria-label="Main Sidebar">
            <div class="logo">
                <img src="Picture/Logo2.png" alt="D'MARSIANS Logo" class="logo-img">
                <h2 class="offcanvas-title" id="sidebarLabel">D'MARSIANS<br>TAEKWONDO<br>SYSTEM</h2>
            </div>
            <nav>
                <a href="admin_dashboard.php"><i class="fas fa-th-large"></i> DASHBOARD</a>
                <a href="admin_student_management.php"><i class="fas fa-user-graduate"></i> STUDENT MANAGEMENT</a>
                <a href="admin_collection.php" class="active"><i class="fas fa-money-bill-wave"></i> COLLECTION</a>
                <a href="admin_payment.php"><i class="fas fa-credit-card"></i> PAYMENT</a>
                <a href="admin_post_management.php"><i class="fas fa-bullhorn"></i> POST MANAGEMENT</a>
                
                <!-- Enrollment Report Dropdown -->
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fas fa-chart-bar"></i>ENROLLMENT REPORT
                        <i class="fas fa-chevron-down arrow"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="admin_enrollment.php"><i class="fas fa-user-plus"></i>ENROLLMENT</a>
                        <a href="admin_trial_session.php"><i class="fas fa-users"></i>TRIAL SESSION</a>
                    </div>
                </div>
                <a href="admin_settings.php" class="active"><i class="fas fa-cogs"></i> ADMIN SETTINGS</a>
                <a href="admin_profile.php"><i class="fas fa-user-circle"></i> PROFILE</a>
            </nav>
            
            <!-- Logout container -->
            <div class="logout-container">
                <a href="admin_logout.php" class="logout">
                    <i class="fas fa-power-off"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>

        <!-- Mobile topbar with toggle button -->
        <div class="mobile-topbar d-flex d-md-none align-items-center justify-content-between p-2">
            <button class="btn btn-sm btn-outline-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar" aria-label="Open sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <span class="text-success fw-bold">D'MARSIANS</span>
            <span></span>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="collection-header">
                <h1>Collection</h1>
            </div>

            <!-- Collection Stats -->
            <div class="collection-stats">
                <div class="stat-box monthly">
                    <h3>Monthly Collected Amount</h3>
                    <div class="amount">₱135,654</div>
                </div>
                <div class="stat-box yearly">
                    <h3>Yearly Collected Amount</h3>
                    <div class="amount">₱433,076</div>
                </div>
            </div>

            <!-- Payment Transaction History -->
            <div class="transaction-section">
                <h2>Payment Transaction History</h2>
                <div class="transaction-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Reference</th>
                                <th>Total Paid</th>
                                <th>Amount Paid</th>
                                <th>Payment Type</th>
                                <th>Discount</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="transactionTableBody">
                            <!-- Table rows will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Collection Trend Chart -->
            <div class="trend-section">
                <div class="trend-header">
                    <h2>Collection Trend</h2>
                    <select id="trendPeriod">
                        <option value="yearly">Yearly</option>
                        <option value="monthly">Monthly</option>
                        <option value="weekly">Weekly</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="collectionTrendChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="admin_collection.js"></script>
    <!-- Bootstrap 5 JS bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    // Mobile-safe dropdown: avoid touch+click double-trigger
    (function(){
        const dropdown = document.querySelector('.sidebar .dropdown');
        const toggle = dropdown ? dropdown.querySelector('.dropdown-toggle') : null;
        if(!dropdown || !toggle) return;

        function open(){ dropdown.classList.add('open'); }
        function close(){ dropdown.classList.remove('open'); }

        let touched = false;
        toggle.addEventListener('click', function(e){
            if (touched) { e.preventDefault(); touched = false; return; }
            e.preventDefault();
            dropdown.classList.toggle('open');
        });
        toggle.addEventListener('touchstart', function(e){
            e.preventDefault();
            touched = true;
            open();
            setTimeout(function(){ touched = false; }, 300);
        }, {passive:false});

        dropdown.addEventListener('mouseenter', open);
        dropdown.addEventListener('mouseleave', close);
        document.addEventListener('click', function(e){ if(!dropdown.contains(e.target)) close(); });
    })();
    </script>
</body>
</html> 