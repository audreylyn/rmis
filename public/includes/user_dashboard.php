<?php
include '../database/config.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Page redirect to login if no session
$usermail = $_SESSION['usermail'] ?? '';
if (!$usermail) {
    header("Location: ../index.php");
    exit();
}

// Get total room count
$count_sql = "SELECT COUNT(*) as total_rooms FROM rooms";
$count_result = $conn->query($count_sql);
$total_rooms = 0;
if ($count_result) {
    $total_rooms = $count_result->fetch_assoc()['total_rooms'];
}

// Function to safely get user data
function getUserData($conn, $email)
{
    $sql = "SELECT FirstName, LastName, CONCAT(FirstName, ' ', LastName) AS full_name FROM signup WHERE Email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        throw new Exception("Database preparation failed: " . $conn->error);
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows === 0) {
        mysqli_stmt_close($stmt);
        return null;
    }

    $userData = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $userData;
}

// Function to get booking statistics
function getBookingStats($conn, $full_name)
{
    $stats = ['booking_count' => 0, 'pending_count' => 0, 'cancelled_count' => 0];
    $statuses = [
        'booking_count' => 'Success',
        'pending_count' => 'pending',
        'cancelled_count' => 'Declined'
    ];

    foreach ($statuses as $key => $status) {
        $sql = "SELECT COUNT(*) AS count FROM room_requests WHERE full_name = ? AND status = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ss", $full_name, $status);
            $stmt->execute();
            $result = $stmt->get_result();
            $stats[$key] = $result->fetch_assoc()['count'];
            $stmt->close();
        }
    }

    return $stats;
}

try {
    // Get user data
    $userData = getUserData($conn, $usermail);
    if (!$userData) {
        throw new Exception("User not found");
    }

    $firstName = $userData['FirstName'];
    $db_full_name = $userData['full_name'];

    // Initialize message variables
    $success_message = '';
    $error_message = '';

    // Handle booking form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['start_datetime'])) {
        // Validate datetime inputs
        $start_datetime = new DateTime($_POST['start_datetime']);
        $end_datetime = new DateTime($_POST['end_datetime']);

        if ($end_datetime <= $start_datetime) {
            throw new Exception("End time must be after start time");
        }

        // Validate full name
        if ($_POST['full_name'] !== $db_full_name) {
            throw new Exception("Full Name does not match our records");
        }

        // Prepare data for insertion
        $data = [
            'full_name' => $db_full_name,
            'year_section' => $_POST['year_section'],
            'department' => $_POST['department'],
            'room_preferred' => $_POST['room_preferred'],
            'purpose' => $_POST['purpose'],
            'start_datetime' => $start_datetime->format('Y-m-d H:i:s'),
            'end_datetime' => $end_datetime->format('Y-m-d H:i:s')
        ];

        // Insert room request
        $stmt = $conn->prepare("INSERT INTO room_requests (full_name, year_section, department, room_preferred, purpose, start_datetime, end_datetime) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("sssssss", ...array_values($data));
        if (!$stmt->execute()) {
            throw new Exception("Failed to submit request: " . $stmt->error);
        }

        $success_message = "Room requisition submitted successfully!";
        $_POST = array(); // Clear form data
        $stmt->close();
    }

    // Get booking statistics
    $stats = getBookingStats($conn, $db_full_name);
} catch (Exception $e) {
    $error_message = $e->getMessage();
}



// Fetch room requests with pagination
$rowsPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startLimit = ($page - 1) * $rowsPerPage;

// Fetch total number of rows for pagination
$sqlCount = "SELECT COUNT(*) AS total FROM room_requests";
$countResult = $conn->query($sqlCount);
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $rowsPerPage);

// Fetch the data for the current page
$sql = "SELECT * FROM room_requests LIMIT $startLimit, $rowsPerPage";
$result = $conn->query($sql);
