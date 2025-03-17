<?php
session_start();
include 'db.php';  // Include database connection

// Check if tenant is logged in
if (!isset($_SESSION['tenant_id'])) {
    echo "You must be logged in to book a room.";
    exit();
}

// Get data from the POST request
$tenant_id = $_SESSION['tenant_id'];
$room_id = $_POST['room_id'];

// Check if the room is available
$stmt = $pdo->prepare("SELECT * FROM vacancies WHERE id = ? AND status = 'available'");
$stmt->execute([$room_id]);
$room = $stmt->fetch();

if ($room) {
    // Update room status to 'occupied'
    $update_room = $pdo->prepare("UPDATE vacancies SET status = 'occupied' WHERE id = ?");
    $update_room->execute([$room_id]);

    // Link the tenant to the room in the tenants table
    $update_tenant = $pdo->prepare("UPDATE tenants SET room_id = ?, status = 'current' WHERE id = ?");
    $update_tenant->execute([$room_id, $tenant_id]);

    echo "Room booked successfully!";
} else {
    echo "Room is not available for booking.";
}
?>
