<?php
require_once 'db_connect.php';

// Set timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

header('Content-Type: application/json');

try {
    $conn = connectDB();
    if (!$conn) {
        echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
        exit();
    }

    // Get the first day of next month (fallback)
    $firstDayNextMonth = date('Y-m-01', strtotime('first day of next month'));
    // Define current month window
    $startOfThisMonth = date('Y-m-01');
    $endOfThisMonth = date('Y-m-t');

    // Query students and their latest payment
    $sql = "
        SELECT s.jeja_no, s.full_name, s.phone, s.parent_phone, s.discount, s.date_enrolled, p.amount_paid, p.date_paid, p.status,
               (SELECT COUNT(*) FROM payments WHERE jeja_no = s.jeja_no) as payment_count
        FROM students s
        LEFT JOIN (
            SELECT p1.*
            FROM payments p1
            INNER JOIN (
                SELECT jeja_no, MAX(id) as max_id
                FROM payments
                GROUP BY jeja_no
            ) p2 ON p1.jeja_no = p2.jeja_no AND p1.id = p2.max_id
        ) p ON s.jeja_no = p.jeja_no
        WHERE (p.status IS NULL OR LOWER(p.status) != 'inactive')
          AND (p.date_paid < '$firstDayNextMonth' OR p.date_paid IS NULL)
        ORDER BY s.full_name ASC
    ";

    $result = $conn->query($sql);

    $dues = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $contact = !empty($row['parent_phone']) ? $row['parent_phone'] : $row['phone'];
            $base_amount = ($row['payment_count'] == 1) ? 1800 : 1500;
            $discount = isset($row['discount']) ? floatval($row['discount']) : 0.00;
            $amount = $base_amount; // Standard monthly fee
            $total_payment = max($amount - $discount, 0); // What the student actually needs to pay
            $amount_paid = isset($row['amount_paid']) ? floatval($row['amount_paid']) : 0.00;

            // Calculate personalized due date:
            // - If the student has a payment, due date is 1 month after last payment
            // - Else, due date is 1 month after enrollment
            // - Else, fallback to first day of next month
            $last_payment_date = isset($row['date_paid']) && $row['date_paid'] ? $row['date_paid'] : null;
            $enrollment_date = isset($row['date_enrolled']) && $row['date_enrolled'] ? $row['date_enrolled'] : null;
            
            if ($last_payment_date) {
                $due_date = date('Y-m-d', strtotime($last_payment_date . ' +1 month'));
            } elseif ($enrollment_date) {
                $due_date = date('Y-m-d', strtotime($enrollment_date . ' +1 month'));
            } else {
                $due_date = $firstDayNextMonth;
            }

            // Only include dues that fall within the current month window
            if ($due_date >= $startOfThisMonth && $due_date <= $endOfThisMonth) {
                // Remove 'STD-' prefix from jeja_no for display
                $display_jeja_no = preg_replace('/^STD-/', '', $row['jeja_no']);

                $dues[] = [
                    'due_date' => $due_date,
                    'id_name' => $display_jeja_no . ' - ' . $row['full_name'],
                    'amount' => number_format($amount, 2),
                    'discount' => number_format($discount, 2),
                    'total_payment' => number_format($total_payment, 2),
                    'amount_paid' => number_format($amount_paid, 2),
                    'contact' => $contact
                ];
            }
        }
    }

    $conn->close();

    echo json_encode([
        'status' => 'success',
        'dues' => $dues
    ]);

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
exit();
?>