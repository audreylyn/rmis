<?php
include '../database/config.php';

$sqlq = "SELECT * FROM room_requests";
$result = mysqli_query($conn, $sqlq);
$room_requests_record = array();

while ($rows = mysqli_fetch_assoc($result)) {
    $room_requests_record[] = $rows;
}

if (isset($_POST["exportexcel"])) {
    $filename = "room_requests_data_" . date('Ymd') . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    $show_column = false;
    if (!empty($room_requests_record)) {
        foreach ($room_requests_record as $record) {
            if (!$show_column) {
                echo implode("\t", array_keys($record)) . "\n";
                $show_column = true;
            }
            echo implode("\t", array_values($record)) . "\n";
        }
    }
    exit;
}
