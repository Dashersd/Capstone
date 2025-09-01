<?php
session_start();
require_once 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    die(json_encode(['status' => 'error', 'message' => 'Unauthorized access']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connectDB();
    
    // Prepare the data
    $jeja_no = mysqli_real_escape_string($conn, $_POST['jeja_no']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $school = mysqli_real_escape_string($conn, $_POST['school']);
    $parent_name = mysqli_real_escape_string($conn, $_POST['parent_name']);
    $parent_phone = mysqli_real_escape_string($conn, $_POST['parent_phone']);
    $parent_email = mysqli_real_escape_string($conn, $_POST['parent_email']);
    $belt_rank = mysqli_real_escape_string($conn, $_POST['belt_rank']);
    $discount = floatval($_POST['discount']);
    $schedule = mysqli_real_escape_string($conn, $_POST['schedule']);

    // Check if this is an update (if jeja_no already exists)
    $check_sql = "SELECT id FROM students WHERE jeja_no = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $jeja_no);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update existing student
        $sql = "UPDATE students SET 
                full_name = ?, 
                address = ?, 
                phone = ?, 
                email = ?, 
                school = ?, 
                parent_name = ?, 
                parent_phone = ?, 
                parent_email = ?, 
                belt_rank = ?, 
                discount = ?, 
                schedule = ? 
                WHERE jeja_no = ?";
                
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssdss", 
            $full_name, 
            $address, 
            $phone, 
            $email, 
            $school, 
            $parent_name, 
            $parent_phone, 
            $parent_email, 
            $belt_rank, 
            $discount, 
            $schedule, 
            $jeja_no
        );
        
        $message = "Student updated successfully";
    } else {
        // Insert new student without jeja_no
        $sql = "INSERT INTO students (
                full_name, address, phone, email, school, 
                parent_name, parent_phone, parent_email, 
                belt_rank, discount, schedule
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssdds", 
            $full_name, 
            $address, 
            $phone, 
            $email, 
            $school, 
            $parent_name, 
            $parent_phone, 
            $parent_email, 
            $belt_rank, 
            $discount, 
            $schedule
        );
        
        $message = "Student saved successfully";
    }
    
    if ($stmt->execute()) {
        // If new student, update jeja_no after insert
        if (!isset($jeja_no) || empty($jeja_no)) {
            $new_id = $conn->insert_id;
            $new_jeja_no = 'STD-' . str_pad($new_id, 5, '0', STR_PAD_LEFT);
            $update = $conn->prepare("UPDATE students SET jeja_no = ? WHERE id = ?");
            $update->bind_param("si", $new_jeja_no, $new_id);
            $update->execute();
            $update->close();
            // Log to activity_log for new student
            $admin_account = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'unknown';
            $action_type = 'Student Enrollment';
            $student_id = $new_jeja_no;
            $details = "Enrolled student: $full_name";
            $log_stmt = $conn->prepare("INSERT INTO activity_log (action_type, datetime, admin_account, student_id, details) VALUES (?, NOW(), ?, ?, ?)");
            $log_stmt->bind_param("ssss", $action_type, $admin_account, $student_id, $details);
            $log_stmt->execute();
            $log_stmt->close();
        }
        // Insert registration data
        $stmt = $conn->prepare("INSERT INTO registrations (student_name, address, parents_name, phone, email, parent_phone, school, class, parent_email, belt_rank, enroll_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssssssss', $full_name, $address, $parent_name, $phone, $email, $parent_phone, $school, $schedule, $parent_email, $belt_rank, $enroll_type);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        if ($success) {
            echo json_encode(['status' => 'success', 'message' => 'Student saved successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Registration failed. Please try again.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
} 