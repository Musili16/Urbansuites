<?php
include "db.php"; // Ensure database connection

$sql = "SELECT id, type, total_rooms, available_rooms FROM room_count";
$result = $conn->query($sql);

$rooms = [];

while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

echo json_encode($rooms);
$conn->close();
?>