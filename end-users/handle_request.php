
<?php
include '../database/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $request_id = $_POST['request_id'];

        // Delete action
        if ($_POST['action'] === 'delete') {
            // Only delete if status is pending
            $sql = "DELETE FROM room_requests WHERE request_id = ? AND status = 'pending'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $request_id);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $_SESSION['success_message'] = "Request deleted successfully.";
                } else {
                    $_SESSION['error_message'] = "Cannot delete: Request is not in pending status or doesn't exist.";
                }
            } else {
                $_SESSION['error_message'] = "Error deleting request.";
            }
        }
        // Update action
        elseif ($_POST['action'] === 'update') {
            $room_preferred = $_POST['room_preferred'];
            $purpose = $_POST['purpose'];
            $start_datetime = $_POST['start_datetime'];
            $end_datetime = $_POST['end_datetime'];
            $check_sql = "SELECT status FROM room_requests WHERE request_id = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("i", $request_id);
            $check_stmt->execute();
            $result = $check_stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row && $row['status'] === 'pending') {
                $sql = "UPDATE room_requests SET
                        room_preferred = ?,
                        purpose = ?,
                        start_datetime = ?,
                        end_datetime = ?
                        WHERE request_id = ? AND status = 'pending'";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param(
                    "ssssi",
                    $room_preferred,
                    $purpose,
                    $start_datetime,
                    $end_datetime,
                    $request_id
                );

                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        $_SESSION['success_message'] = "Request updated successfully.";
                    } else {
                        $_SESSION['error_message'] = "No changes were made to the request.";
                    }
                } else {
                    $_SESSION['error_message'] = "Error updating request.";
                }
            } else {
                $_SESSION['error_message'] = "Cannot update: Request is not in pending status or doesn't exist.";
            }
        }
    }
    header("Location: ./my_reservation.php");
    exit();
}
