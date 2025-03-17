<?php
include 'db.php';

$stmt = $pdo->prepare("SELECT type, available_rooms FROM room_count");
$stmt->execute();
$available_rooms = $stmt->fetchAll();

foreach ($available_rooms as $room) {
    echo "Type: " . $room['type'] . " - Available Rooms: " . $room['available_rooms'] . "<br>";
}
?>
