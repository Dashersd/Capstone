<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['student_name'] ?? '';
    $address = $_POST['address'] ?? '';
    $parent_name = $_POST['parents_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $parent_phone = $_POST['parent_phone'] ?? '';
    $school = $_POST['school'] ?? '';
    $class = $_POST['class'] ?? '';
    $parent_email = $_POST['parent_email'] ?? '';
    $belt_rank = $_POST['belt_rank'] ?? '';
    $enroll_type = $_POST['enroll_type'] ?? '';
    if ($enroll_type !== 'Enroll') {
        echo json_encode(['status' => 'error', 'message' => 'Invalid enrollment type.']);
        exit();
    }
    $stmt = $conn->prepare("INSERT INTO enrollment_requests (full_name, phone, school, belt_rank, address, email, class, parent_name, parent_phone, parent_email, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("ssssssssss", $full_name, $phone, $school, $belt_rank, $address, $email, $class, $parent_name, $parent_phone, $parent_email);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Enrollment request submitted! Please wait for approval.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to submit request.']);
    }
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
} 