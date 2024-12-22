<?php
// mark-notifications-read.php

// Include database connection
include './database/config.php';

// Retrieve data (if needed)
$data = json_decode(file_get_contents('php://input'), true);

// Update the database
$query = "UPDATE room_requests SET notification_read = 1 WHERE notification_read = 0";
if (mysqli_query($conn, $query)) {
    http_response_code(200); // Success
    echo json_encode(['message' => 'Notifications updated successfully.']);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Failed to update notifications.']);
}
