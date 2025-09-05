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
    <title>Student Management - D'MARSIANS Taekwondo System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" media="(max-width: 767.98px)">
    <link rel="stylesheet" href="Styles/dashboard.css">
    <link rel="stylesheet" href="Styles/student_management.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar offcanvas-md offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel" role="navigation" aria-label="Main Sidebar">
            <div class="logo d-flex align-items-center gap-2">
                <img src="Picture/Logo2.png" alt="D'MARSIANS Logo" class="logo-img img-fluid" style="max-width: 56px; height: auto;">
                <h2 class="m-0">D'MARSIANS<br>TAEKWONDO<br>SYSTEM</h2>
            </div>
            <nav>
                <a href="dashboard.php"><i class="fas fa-th-large"></i><span>DASHBOARD</span></a>
                <a href="student_management.php" class="active"><i class="fas fa-user-graduate"></i><span>STUDENT MANAGEMENT</span></a>
                <a href="collection.php"><i class="fas fa-money-bill-wave"></i><span>COLLECTION</span></a>
                <a href="payment.php"><i class="fas fa-credit-card"></i><span>PAYMENT</span></a>
                <a href="post_management.php"><i class="fas fa-bullhorn"></i><span>POST MANAGEMENT</span></a>
                
                <!-- Enrollment Report Dropdown -->
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fas fa-chart-bar"></i><span>ENROLLMENT REPORT</span>
                        <i class="fas fa-chevron-down arrow"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="enrollment.php"><i class="fas fa-user-plus"></i><span>ENROLLMENT</span></a>
                        <a href="trial_session.php"><i class="fas fa-users"></i><span>TRIAL SESSION</span></a>
                    </div>
                </div>
            </nav>
            
            <!-- Separate logout container -->
            <div class="logout-container">
                <a href="logout.php" class="logout">
                    <i class="fas fa-power-off"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Mobile menu button (visible on small screens only) -->
            <button class="btn btn-outline-primary d-md-none mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <i class="fas fa-bars"></i> Menu
            </button>
            <h1 class="page-title">STUDENT MANAGEMENT</h1>
            
            <div class="student-form-container">
                <form class="student-form" id="studentForm" onsubmit="return handleFormSubmit(event)">
                    <div class="form-grid">
                        <!-- Left Column -->
                        <div class="form-column">
                            <div class="form-group">
                                <label>STD No.</label>
                                <input type="text" name="jeja_no" readonly placeholder="Auto-generated" style="background:#eee;cursor:not-allowed;">
                            </div>
                            
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="full_name" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Phone No.</label>
                                <input type="tel" name="phone" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" required>
                            </div>
                            
                            <div class="form-group">
                                <label>School</label>
                                <select name="school" required>
                                    <option value="">Select</option>
                                    <option value="SCC">SCC</option>
                                    <option value="ZSSAT">ZSSAT</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Class</label>
                                <select name="class" required>
                                    <option value="">Select</option>
                                    <option value="Poomsae">Poomsae</option>
                                    <option value="Kyorugi">Kyorugi</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div class="form-column">
                            <div class="form-group">
                                <label>Parent's Name</label>
                                <input type="text" name="parent_name">
                            </div>
                            
                            <div class="form-group">
                                <label>Parent's Phone</label>
                                <input type="tel" name="parent_phone">
                            </div>
                            
                            <div class="form-group">
                                <label>Parent's Email</label>
                                <input type="email" name="parent_email">
                            </div>
                            
                            <div class="form-group">
                                <label>Belt Rank</label>
                                <div class="belt-rank-container">
                                    <select name="belt_rank" required>
                                        <option value="">Select</option>
                                        <option value="White">White</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="Green">Green</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Red">Red</option>
                                        <option value="Black">Black</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Discount</label>
                                <div class="discount-container">
                                    <input type="number" name="discount" value="0.00" step="0.01">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Schedule</label>
                                <select name="schedule" required>
                                    <option value="">Select</option>
                                    <option value="MWF-PM">MWF Afternoon</option>
                                    <option value="TTS-PM">TTS Afternoon</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-save">
                            <span class="btn-content"><i class="fas fa-save"></i><span>SAVE</span></span>
                        </button>       
                        <button type="button" class="btn btn-update">
                            <span class="btn-content"><i class="fas fa-sync-alt"></i><span>UPDATE</span></span>
                        </button>
                        <button type="reset" class="btn btn-clear">
                            <span class="btn-content"><i class="fas fa-eraser"></i><span>CLEAR</span></span>
                        </button>
                        <button type="button" class="btn btn-export">
                            <span class="btn-content"><i class="fas fa-file-export"></i><span>EXPORT</span></span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Student Table -->
			<!-- Mobile toolbar (hidden on md and up) -->
			<div class="d-flex gap-2 align-items-center mb-2 d-md-none" id="enrolleesToolbar">
				<input class="form-control form-control-sm" id="enrolleesSearch" placeholder="Search...">
				<select class="form-select form-select-sm" id="enrolleesFilter">
					<option value="">All</option>
					<option value="Active">Active</option>
					<option value="Inactive">Inactive</option>
				</select>
			</div>

			<div class="table-container table-responsive enrollees-card">
                <table class="student-table table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>STD No.</th>
                            <th class="d-none d-md-table-cell">Date Enrolled</th>
                            <th>Fullname</th>
                            <th class="d-none d-md-table-cell">Address</th>
                            <th>Phone No.</th>
                            <th class="d-none d-md-table-cell">Email</th>
                            <th class="d-none d-md-table-cell">School</th>
                            <th class="d-none d-md-table-cell">Parent's Name</th>
                            <th class="d-none d-md-table-cell">Parent's Phone</th>
                            <th class="d-none d-md-table-cell">Parent's Email</th>
                            <th class="d-none d-md-table-cell">Belt Rank</th>
                            <th class="d-none d-md-table-cell">Discount</th>
                            <th class="d-none d-md-table-cell">Schedule</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                        <!-- Data will be loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="Scripts/student_management.js"></script>
    <script src="Scripts/sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    async function handleFormSubmit(event) {
        event.preventDefault();
        
        const form = event.target;
        const formData = new FormData(form);
        
        try {
            const response = await fetch('save_student.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.status === 'success') {
                alert(result.message);
                loadStudents(); // Reload the students table
                form.reset(); // Clear the form
            } else {
                alert('Error: ' + result.message);
            }
        } catch (error) {
            alert('Error submitting form: ' + error.message);
        }
        
        return false;
    }

    async function loadStudents() {
        try {
            const response = await fetch('get_students.php');
            const result = await response.json();
            
            if (result.status === 'success') {
                const tbody = document.getElementById('studentTableBody');
                tbody.innerHTML = ''; // Clear existing rows
                
                result.data.forEach(student => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${student.jeja_no ? student.jeja_no.replace(/^STD-/, '') : ''}</td>
                        <td class="d-none d-md-table-cell">${student.date_enrolled}</td>
                        <td>${student.full_name}</td>
                        <td class="d-none d-md-table-cell">${student.address}</td>
                        <td>${student.phone}</td>
                        <td class="d-none d-md-table-cell">${student.email || ''}</td>
                        <td class="d-none d-md-table-cell">${student.school || ''}</td>
                        <td class="d-none d-md-table-cell">${student.parent_name || ''}</td>
                        <td class="d-none d-md-table-cell">${student.parent_phone || ''}</td>
                        <td class="d-none d-md-table-cell">${student.parent_email || ''}</td>
                        <td class="d-none d-md-table-cell">${student.belt_rank}</td>
                        <td class="d-none d-md-table-cell">₱${parseFloat(student.discount).toFixed(2)}</td>
                        <td class="d-none d-md-table-cell">${student.schedule}</td>
                        <td class="status-${student.status.toLowerCase()}">${student.status}</td>
                        <td>
                            <button onclick="editStudent('${student.jeja_no}')" class="btn-edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteStudent('${student.jeja_no}')" class="btn-delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            }
        } catch (error) {
            console.error('Error loading students:', error);
        }
    }

    async function editStudent(jejaNo) {
        try {
            const response = await fetch(`get_students.php?jeja_no=${jejaNo}`);
            const result = await response.json();
            
            if (result.status === 'success' && result.data.length > 0) {
                const student = result.data[0];
                const form = document.getElementById('studentForm');
                
                // Fill the form with student data
                Object.keys(student).forEach(key => {
                    const input = form.elements[key];
                    if (input) {
                        input.value = student[key];
                    }
                });
            }
        } catch (error) {
            console.error('Error loading student details:', error);
        }
    }

    async function deleteStudent(jejaNo) {
        if (confirm('Are you sure you want to delete this student?')) {
            try {
                const response = await fetch('delete_student.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ jeja_no: jejaNo })
                });
                
                const result = await response.json();
                
                if (result.status === 'success') {
                    alert(result.message);
                    loadStudents(); // Reload the table
                } else {
                    alert('Error: ' + result.message);
                }
            } catch (error) {
                alert('Error deleting student: ' + error.message);
            }
        }
    }

    // Load students when the page loads
    document.addEventListener('DOMContentLoaded', loadStudents);

    // Client-side search/filter for mobile toolbar
    (function setupEnrolleesToolbar(){
        const searchInput = document.getElementById('enrolleesSearch');
        const filterSelect = document.getElementById('enrolleesFilter');
        if(!searchInput || !filterSelect) return;

        function applyFilters(){
            const term = (searchInput.value || '').toLowerCase();
            const statusFilter = (filterSelect.value || '').toLowerCase();
            const tbody = document.getElementById('studentTableBody');
            if(!tbody) return;
            [...tbody.querySelectorAll('tr')].forEach(tr => {
                const text = tr.textContent.toLowerCase();
                const statusCell = tr.querySelector('[class^="status-"]');
                const rowStatus = statusCell ? statusCell.textContent.toLowerCase() : '';
                const matchesText = !term || text.includes(term);
                const matchesStatus = !statusFilter || rowStatus === statusFilter;
                tr.style.display = (matchesText && matchesStatus) ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', applyFilters);
        filterSelect.addEventListener('change', applyFilters);
    })();
    </script>
</body>
</html> 