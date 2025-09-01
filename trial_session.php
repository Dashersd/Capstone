<?php
// trial_session.php
session_start();
require_once 'db_connect.php';

// File for pending trial session requests
$file = 'trial_requests.json';
$pending_requests = [];
if (file_exists($file)) {
    $json = file_get_contents($file);
    $pending_requests = json_decode($json, true) ?: [];
}

$conn = connectDB();
// Fetch complete trial sessions from DB only
$sql_complete = "SELECT * FROM registrations WHERE enroll_type = 'Trial Session' AND status = 'complete' ORDER BY date_registered DESC";
$result_complete = $conn->query($sql_complete);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trial Session | D'MARSIANS TAEKWONDO SYSTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="admin_enrollment.css">
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
            <a href="dashboard.php"><i class="fas fa-th-large"></i> DASHBOARD</a>
            <a href="student_management.php"><i class="fas fa-user-graduate"></i> STUDENT MANAGEMENT</a>
            <a href="collection.php"><i class="fas fa-money-bill-wave"></i> COLLECTION</a>
            <a href="payment.php"><i class="fas fa-credit-card"></i> PAYMENT</a>
            <a href="post_management.php"><i class="fas fa-bullhorn"></i> POST MANAGEMENT</a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">
                    <i class="fas fa-chart-bar"></i>ENROLLMENT REPORT
                    <i class="fas fa-chevron-down arrow"></i>
                </a>
                <div class="dropdown-content">
                    <a href="enrollment.php"><i class="fas fa-user-plus"></i>ENROLLMENT</a>
                    <a href="trial_session.php" class="active"><i class="fas fa-users"></i>TRIAL SESSION</a>
                </div>
            </div>
        </nav>
        <div class="logout-container">
            <a href="logout.php" class="logout">
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
        <h2>TRIAL SESSION</h2>
        <!-- Pending Trial Sessions Section -->
        <div class="enrollment-section">
            <div class="section-header">
                <h3>Pending Trial Sessions</h3>
                <div class="search-container">
                    <input type="text" id="searchPending" placeholder="Search pending...">
                    <i class="fas fa-search search-icon"></i>
                </div>
            </div>
            <div class="table-container">
                <table class="enrollment-table">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Date Requested</th>
                            <th>Full Name</th>
                            <th>Address</th>
                            <th>Phone No.</th>
                            <th>Email</th>
                            <th>School</th>
                            <th>Parent's Name</th>
                            <th>Parent's Phone</th>
                            <th>Parent's Email</th>
                            <th>Belt Rank</th>
                            <th>Class</th>
                            <th>Request</th>
                            <th>Convert to Enrollment</th>
                        </tr>
                    </thead>
                    <tbody id="pendingTableBody">
                        <?php if (count($pending_requests) > 0): ?>
                            <?php foreach ($pending_requests as $idx => $row): ?>
                                <tr>
                                    <td><?= $idx + 1 ?></td>
                                    <td><?= htmlspecialchars($row['date_requested']) ?></td>
                                    <td><?= htmlspecialchars($row['student_name']) ?></td>
                                    <td><?= htmlspecialchars($row['address']) ?></td>
                                    <td><?= htmlspecialchars($row['phone']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['school']) ?></td>
                                    <td><?= htmlspecialchars($row['parents_name']) ?></td>
                                    <td><?= htmlspecialchars($row['parent_phone']) ?></td>
                                    <td><?= htmlspecialchars($row['parent_email']) ?></td>
                                    <td><?= htmlspecialchars($row['belt_rank']) ?></td>
                                    <td><?= htmlspecialchars($row['class']) ?></td>
                                    <td><button class="btn-approve btn-complete" data-index="<?= $idx ?>">Complete</button></td>
                                    <td><button class="btn-approve">Convert</button></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="14">No trial session registrations found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Complete Trial Sessions Section -->
        <div class="enrollment-section">
            <div class="section-header">
                <h3>Complete Trial Sessions</h3>
                <div class="search-container">
                    <input type="text" id="searchComplete" placeholder="Search complete...">
                    <i class="fas fa-search search-icon"></i>
                </div>
            </div>
            <div class="table-container">
                <table class="enrollment-table">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Date Registered</th>
                            <th>Trial Date</th>
                            <th>Fullname</th>
                            <th>Parent's Phone</th>
                            <th>Amount Paid</th>
                            <th>Payment Type</th>
                            <th>Convert to Enrollment</th>
                        </tr>
                    </thead>
                    <tbody id="completeTableBody">
                        <?php if ($result_complete->num_rows > 0): ?>
                            <?php while($row = $result_complete->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td><?= htmlspecialchars($row['date_registered']) ?></td>
                                    <td><?= htmlspecialchars($row['date_registered']) ?></td>
                                    <td><?= htmlspecialchars($row['student_name']) ?></td>
                                    <td><?= htmlspecialchars($row['parent_phone']) ?></td>
                                    <td>&#8369; <?= number_format($row['trial_payment'], 2) ?></td>
                                    <td>Trial Session</td>
                                    <td><button class="btn-approve">Convert</button></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="9">No complete trial session registrations found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="trial_session.js"></script>
<!-- Bootstrap 5 JS bundle (Popper included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
// Mobile-safe dropdown: avoid touch+click double-trigger (match payment.php behavior)
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
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-complete').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var idx = this.getAttribute('data-index');
            if (confirm('Mark this trial session as complete?')) {
                fetch('complete_trial_session.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'index=' + encodeURIComponent(idx)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(err => alert('Request failed: ' + err));
            }
        });
    });
    // Convert to Enrollment handler for Complete table
    document.querySelectorAll('#completeTableBody .btn-approve').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var row = this.closest('tr');
            var regId = row.querySelector('td').textContent.trim(); // Transaction ID is first column
            if (confirm('Convert this trial session to full enrollment?')) {
                fetch('convert_trial_to_student.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'registration_id=' + encodeURIComponent(regId)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Converted to student successfully!');
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(err => alert('Request failed: ' + err));
            }
        });
    });
});
</script>
</body>
</html> 