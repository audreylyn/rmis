<?php
// Include database connection
include('./database/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['request_id'];

    // Delete reservation from the database
    $stmt = $pdo->prepare("DELETE FROM room_requests WHERE request_id = ?");
    $stmt->execute([$id]);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
