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
    <title>Admin Payment - D'MARSIANS Taekwondo System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="admin_dashboard.css">
    <link rel="stylesheet" href="admin_payment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                <a href="admin_collection.php"><i class="fas fa-money-bill-wave"></i> COLLECTION</a>
                <a href="admin_payment.php" class="active"><i class="fas fa-credit-card"></i> PAYMENT</a>
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
                <a href="admin_settings.php"><i class="fas fa-cogs"></i> ADMIN SETTINGS</a>
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
            <!-- Payment Form Section -->
            <div class="payment-form-section">
                <h2>PAYMENT</h2>
                <form id="paymentForm" class="payment-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="jeja_no">STD No.</label>
                            <input type="text" id="jeja_no" name="jeja_no" required>
                        </div>
                        <div class="form-group">
                            <label for="payment_type">Payment Type</label>
                            <select id="payment_type" name="payment_type" required>
                                <option value="">Select Payment Type</option>
                                <option value="Full Payment">Full Payment</option>
                                <option value="Half Payment">Half Payment</option>
                                <option value="Advance Payment">Advance Payment</option>
                                <option value="Postponed Payment">Postponed Payment</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" id="full_name" name="full_name" required>
                        </div>
                        <div class="form-group">
                            <label for="date_paid">Date Paid</label>
                            <input type="date" id="date_paid" name="date_paid" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="amount_paid">Amount Paid</label>
                            <input type="number" id="amount_paid" name="amount_paid" step="0.01" value="0.00" required>
                        </div>
                        <div class="form-group">
                            <label for="discount">Discount</label>
                            <input type="number" id="discount" name="discount" step="0.01" value="0.00" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Freeze">Freeze</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> SAVE
                        </button>
                    </div>
                </form>
            </div>

            <!-- Payment Records Section -->
            <div class="payment-records-section">
                <div class="records-header">
                    <h3>Payments Records</h3>
                    <div class="search-container">
                        <input type="text" id="searchPayment" placeholder="Search payments...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>
                <div class="table-container">
                    <table class="payment-table">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>STD No.</th>
                                <th>Fullname</th>
                                <th>Date Paid</th>
                                <th>Amount Paid</th>
                                <th>Payment Type</th>
                                <th>Discount</th>
                                <th>Date Enrolled</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="paymentTableBody">
                            <!-- Table rows will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Non Discount Students Table -->
            <div class="payment-records-section">
                <div class="records-header">
                    <h3>Non Discount Students</h3>
                    <div class="search-container">
                        <input type="text" id="searchNonDiscount" placeholder="Search non-discount students...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>
                <div class="table-container">
                    <table class="payment-table">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>STD No.</th>
                                <th>Fullname</th>
                                <th>Date Paid</th>
                                <th>Amount Paid</th>
                                <th>Payment Type</th>
                                <th>Discount</th>
                                <th>Date Enrolled</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="nonDiscountTableBody"></tbody>
                    </table>
                </div>
            </div>

            <!-- Discount Students Table -->
            <div class="payment-records-section">
                <div class="records-header">
                    <h3>Discount Students</h3>
                    <div class="search-container">
                        <input type="text" id="searchDiscount" placeholder="Search discount students...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>
                <div class="table-container">
                    <table class="payment-table">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>STD No.</th>
                                <th>Fullname</th>
                                <th>Date Paid</th>
                                <th>Amount Paid</th>
                                <th>Payment Type</th>
                                <th>Discount</th>
                                <th>Date Enrolled</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="discountTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="admin_payment.js"></script>
    <!-- Bootstrap 5 JS bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    // Enable hover-like behavior on touch: open dropdown on touchstart/mouseenter, close on mouseleave
    (function(){
        const dropdown = document.querySelector('.sidebar .dropdown');
        const toggle = dropdown ? dropdown.querySelector('.dropdown-toggle') : null;
        if(!dropdown || !toggle) return;

        function open(){ dropdown.classList.add('open'); }
        function close(){ dropdown.classList.remove('open'); }

        toggle.addEventListener('click', function(e){
            // Prevent navigation and just toggle open state on click
            e.preventDefault();
            dropdown.classList.toggle('open');
        });
        toggle.addEventListener('touchstart', function(e){ e.preventDefault(); open(); }, {passive:false});
        dropdown.addEventListener('mouseenter', open);
        dropdown.addEventListener('mouseleave', close);
        // Close when clicking outside
        document.addEventListener('click', function(e){ if(!dropdown.contains(e.target)) close(); });
    })();
    </script>
    <div id="paymentMessage" style="display:none;"></div>
</body>
</html> 