<?php
require_once 'db_connect.php';
$conn = connectDB();
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jeja_no = $conn->real_escape_string($_POST['jeja_no'] ?? '');
    $fullname = $conn->real_escape_string($_POST['full_name'] ?? '');
    $date_paid = $conn->real_escape_string($_POST['date_paid'] ?? '');
    $amount_paid = $conn->real_escape_string($_POST['amount_paid'] ?? '');
    $payment_type = $conn->real_escape_string($_POST['payment_type'] ?? '');
    $status = $conn->real_escape_string($_POST['status'] ?? '');
    $discount = isset($_POST['discount']) ? $conn->real_escape_string($_POST['discount']) : '0.00';
    $date_enrolled = date('Y-m-d');
    if ($jeja_no && $fullname && $date_paid && $amount_paid && $payment_type && $status) {
        $sql = "INSERT INTO payments (jeja_no, fullname, date_paid, amount_paid, payment_type, discount, date_enrolled, status) VALUES ('$jeja_no', '$fullname', '$date_paid', '$amount_paid', '$payment_type', '$discount', '$date_enrolled', '$status')";
        if ($conn->query($sql)) {
            // Log to activity_log
            session_start();
            $admin_account = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'unknown';
            $action_type = 'Payments';
            $student_id = $jeja_no;
            $details = "Amount: $amount_paid\nPayment Type: $payment_type\nStatus: $status\nDiscount: $discount";
            $stmt = $conn->prepare("INSERT INTO activity_log (action_type, datetime, admin_account, student_id, details) VALUES (?, NOW(), ?, ?, ?)");
            $stmt->bind_param("ssss", $action_type, $admin_account, $student_id, $details);
            $stmt->execute();
            $stmt->close();
            echo json_encode(['success' => true, 'message' => 'Payment saved successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
} 