<?php
include '../database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        $student_id = $_POST['StudentId'];
        $first_name = $_POST['FirstName'];
        $last_name = $_POST['LastName'];
        $student_number = $_POST['StudentNumber'];
        $email = $_POST['Email'];

        // Start building the SQL query
        $sql = "UPDATE signup SET 
                FirstName = ?,
                LastName = ?,
                StudentNumber = ?,
                Email = ?
                WHERE StudentId = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $first_name, $last_name, $student_number, $email, $student_id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['success_message'] = "Profile updated successfully.";
            } else {
                $_SESSION['error_message'] = "No changes were made to the profile.";
            }
            $stmt->close();
        } else {
            $_SESSION['error_message'] = "Error updating profile: " . $stmt->error;
        }
    }

    // Redirect after handling the request
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$sql = "SELECT CONCAT(FirstName, ' ', LastName) AS full_name FROM signup WHERE Email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    $user = mysqli_fetch_assoc($result);
    $db_full_name = $user['full_name'];
} else {
    header("Location: index.php");
    exit();
}

// Fetch all users or just the current user depending on permissions
$stmt = $conn->prepare("SELECT * FROM signup WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
$stmt->close();
