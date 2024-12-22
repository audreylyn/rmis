<?php

include '../database/config.php';
session_start();

// page redirect
$usermail = "";
$usermail = $_SESSION['usermail'];
if ($usermail == true) {
} else {
    header("location: ../index.php");
}

// Get the email of the logged-in user from the session
$email = $_SESSION['usermail'];

// Prepared statement to prevent SQL injection
$sql = "SELECT FirstName FROM signup WHERE Email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email); // "s" denotes string type
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if a user is found
if ($result->num_rows > 0) {
    // Fetch the user details
    $user = mysqli_fetch_assoc($result);
    $firstName = $user['FirstName'];
} else {
    // If user not found, redirect to login page
    header("Location: index.php");
    exit();
}

mysqli_stmt_close($stmt); // Close the prepared statement
