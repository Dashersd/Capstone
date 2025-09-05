<?php
// admin_settings.php
require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings | D'MARSIANS TAEKWONDO SYSTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/admin_dashboard.css">
    <link rel="stylesheet" href="Styles/admin_settings.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<div class="container-fluid">
    <div class="sidebar offcanvas-md offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel" role="navigation" aria-label="Main Sidebar">
        <div class="logo">
            <img src="Picture/Logo2.png" alt="D'MARSIANS Logo" class="logo-img">
            <h2 class="offcanvas-title" id="sidebarLabel">D'MARSIANS<br>TAEKWONDO<br>SYSTEM</h2>
        </div>
        <nav>
            <a href="admin_dashboard.php"><i class="fas fa-th-large"></i> DASHBOARD</a>
            <a href="admin_student_management.php"><i class="fas fa-user-graduate"></i> STUDENT MANAGEMENT</a>
            <a href="admin_collection.php"><i class="fas fa-money-bill-wave"></i> COLLECTION</a>
            <a href="admin_payment.php"><i class="fas fa-credit-card"></i> PAYMENT</a>
            <a href="admin_post_management.php"><i class="fas fa-bullhorn"></i> POST MANAGEMENT</a>
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
    <div class="main-content">
        <h1 class="admin-settings-title">ADMIN SETTINGS</h1>
        <div class="settings-card">
            <div class="tabs">
                <button class="tab-btn active" onclick="showTab(event, 'activity-log')">ACTIVITY LOG</button>
                <button class="tab-btn" onclick="showTab(event, 'admins-account')">ADMINS ACCOUNT</button>
            </div>
            <div id="activity-log" class="tab-content" style="display:block;">
                <table class="activity-table">
                    <thead>
                        <tr>
                            <th>Action Type</th>
                            <th>Date & Time</th>
                            <th>Admin Account</th>
                            <th>Student ID</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM activity_log ORDER BY datetime DESC";
                        $result = $conn->query($sql);
                        if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['action_type']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['datetime']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['admin_account']) . "</td>";
                                echo "<td>" . htmlspecialchars(str_replace('STD-', '', $row['student_id'])) . "</td>";
                                echo "<td>" . nl2br(htmlspecialchars($row['details'])) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No activity found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="admins-account" class="tab-content" style="display:none;">
                <form class="admin-account-form">
                    <input type="hidden" id="admin-user-id" name="user_id" value="">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="admin-email">Email</label>
                            <input type="email" id="admin-email" name="email" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="admin-password">Password</label>
                            <input type="password" id="admin-password" name="password" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="admin-username">Username</label>
                            <input type="text" id="admin-username" name="username" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="admin-confirm-password">Confirm Password</label>
                            <input type="password" id="admin-confirm-password" name="confirm_password" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="action-btn save"><i class="fas fa-save"></i><span>SAVE</span></button>
                        <button type="button" class="action-btn update"><i class="fas fa-sync-alt"></i><span>UPDATE</span></button>
                        <button type="button" class="action-btn clear"><i class="fas fa-eraser"></i><span>CLEAR</span></button>
                
                    </div>
                </form>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>EMAIL</th>
                                <th>USERNAME</th>
                                <th>PASSWORD</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Admin accounts will be loaded dynamically via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="Scripts/admin_settings.js"></script>
<!-- Bootstrap 5 JS bundle (Popper included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
// Mobile-safe dropdown: same behavior as admin_payment.php
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