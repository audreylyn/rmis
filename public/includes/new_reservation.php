<?php
include '../database/config.php';

// Page redirect to login if no session
$usermail = $_SESSION['usermail'] ?? '';
if (!$usermail) {
    header("location: ../../index.php");
    exit();
}

// Get the email of the logged-in user from the session
$email = $_SESSION['usermail'];

// Prepared statement to prevent SQL injection
$sql = "SELECT FirstName FROM signup WHERE Email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if a user is found
if ($result->num_rows > 0) {
    $user = mysqli_fetch_assoc($result);
    $firstName = $user['FirstName'];
} else {
    header("Location: index.php");
    exit();
}

mysqli_stmt_close($stmt); // Close the prepared statement

// Get the full name of the logged-in user
$sql = "SELECT CONCAT(FirstName, ' ', LastName) AS full_name FROM signup WHERE Email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch the full name
if ($result->num_rows > 0) {
    $user = mysqli_fetch_assoc($result);
    $db_full_name = $user['full_name'];
} else {
    header("Location: index.php");
    exit();
}

mysqli_stmt_close($stmt); // Close the prepared statement

// Initialize message variables
$success_message = '';
$error_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $year_section = mysqli_real_escape_string($conn, $_POST['year_section']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $room_preferred = mysqli_real_escape_string($conn, $_POST['room_preferred']);
    $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
    $start_datetime = mysqli_real_escape_string($conn, $_POST['start_datetime']);
    $end_datetime = mysqli_real_escape_string($conn, $_POST['end_datetime']);

    // Validate full name
    if ($full_name !== $db_full_name) {
        $error_message = "The full name entered is incorrect or does not match our records.";
    } else {
        // Proceed with room reservation if full name matches
        $stmt = $conn->prepare("INSERT INTO room_requests (full_name, year_section, department, room_preferred, purpose, start_datetime, end_datetime) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssssss", $full_name, $year_section, $department, $room_preferred, $purpose, $start_datetime, $end_datetime);
            if ($stmt->execute()) {
                $success_message = "Room requisition submitted successfully!";
                // Clear form data
                $_POST = array();
            } else {
                $error_message = "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}

// Fetch room requests for the current user
$stmt = $conn->prepare("SELECT * FROM room_requests WHERE full_name = ? ORDER BY start_datetime DESC");
$stmt->bind_param("s", $db_full_name);
$stmt->execute();
$result = $stmt->get_result();
$requests = [];
while ($row = $result->fetch_assoc()) {
    $requests[] = $row;
}
$stmt->close();
