<?php
include "db.php"; // Ensure this file correctly connects to your database

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $room_id = $_POST["room_id"];
    $available_rooms = $_POST["available_rooms"];

    $stmt = $conn->prepare("UPDATE room_count SET available_rooms = ? WHERE id = ?");
    $stmt->bind_param("ii", $available_rooms, $room_id);

    if ($stmt->execute()) {
        echo "Room availability updated successfully!";
    } else {
        echo "Error updating room availability.";
    }

    $stmt->close();
    $conn->close();
}
?>
