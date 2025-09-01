<?php
header('Content-Type: application/json');

// File to store pending trial session requests
$file = 'trial_requests.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $request = [
        'student_name' => $_POST['student_name'] ?? '',
        'address' => $_POST['address'] ?? '',
        'parents_name' => $_POST['parent_name'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'email' => $_POST['email'] ?? '',
        'parent_phone' => $_POST['parent_phone'] ?? '',
        'school' => $_POST['school'] ?? '',
        'class' => $_POST['class'] ?? '',
        'parent_email' => $_POST['parent_email'] ?? '',
        'belt_rank' => $_POST['belt_rank'] ?? '',
        'enroll_type' => $_POST['enroll_type'] ?? '',
        'date_requested' => date('Y-m-d H:i:s')
    ];
    if ($request['enroll_type'] !== 'Trial Session') {
        echo json_encode(['status' => 'error', 'message' => 'Invalid enrollment type.']);
        exit();
    }
    // Read existing requests
    $requests = [];
    if (file_exists($file)) {
        $json = file_get_contents($file);
        $requests = json_decode($json, true) ?: [];
    }
    // Add new request
    $requests[] = $request;
    // Save back to file
    if (file_put_contents($file, json_encode($requests, JSON_PRETTY_PRINT))) {
        echo json_encode(['status' => 'success', 'message' => 'Trial session request submitted!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save request.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}