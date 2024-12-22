<?php
// Include database connection
include('./database/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['request_id'];
    $full_name = $_POST['full_name'];
    $year_section = $_POST['year_section'];
    $department = $_POST['department'];
    $room_preferred = $_POST['room_preferred'];
    $purpose = $_POST['purpose'];
    $start_datetime = $_POST['start_datetime'];
    $end_datetime = $_POST['end_datetime'];

    // Update reservation in the database
    $stmt = $pdo->prepare("UPDATE room_requests SET full_name = ?, year_section = ?, department = ?, room_preferred = ?, purpose = ?, start_datetime = ?, end_datetime = ? WHERE request_id = ?");
    $stmt->execute([$full_name, $year_section, $department, $room_preferred, $purpose, $start_datetime, $end_datetime, $id]);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
