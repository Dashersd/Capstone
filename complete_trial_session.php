<?php
require_once 'db_connect.php';
header('Content-Type: application/json');

$file = 'trial_requests.json';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = isset($_POST['index']) ? intval($_POST['index']) : null;
    if ($index === null) {
        echo json_encode(['status' => 'error', 'message' => 'Missing request index.']);
        exit();
    }
    // Load requests from file
    $requests = [];
    if (file_exists($file)) {
        $json = file_get_contents($file);
        $requests = json_decode($json, true) ?: [];
    }
    if (!isset($requests[$index])) {
        echo json_encode(['status' => 'error', 'message' => 'Request not found.']);
        exit();
    }
    $req = $requests[$index];
    $conn = connectDB();
    $stmt = $conn->prepare("INSERT INTO registrations (student_name, address, parents_name, phone, email, parent_phone, school, class, parent_email, belt_rank, enroll_type, date_registered, status, trial_payment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'complete', 200.00)");
    $stmt->bind_param('ssssssssssss',
        $req['student_name'],
        $req['address'],
        $req['parents_name'],
        $req['phone'],
        $req['email'],
        $req['parent_phone'],
        $req['school'],
        $req['class'],
        $req['parent_email'],
        $req['belt_rank'],
        $req['enroll_type'],
        $req['date_requested']
    );
    if ($stmt->execute()) {
        // Remove from file
        array_splice($requests, $index, 1);
        file_put_contents($file, json_encode($requests, JSON_PRETTY_PRINT));
        echo json_encode(['status' => 'success', 'message' => 'Trial session marked as complete and saved to database.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save to database.', 'mysql_error' => $stmt->error]);
    }
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}