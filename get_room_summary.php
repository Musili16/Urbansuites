<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.html");
    exit;
}

include 'db.php';

$sql = "SELECT type, 
               SUM(CASE WHEN status = 'Available' THEN 1 ELSE 0 END) AS available,
               SUM(CASE WHEN status = 'Booked' THEN 1 ELSE 0 END) AS booked
        FROM vacancies
        GROUP BY type";

$result = $conn->query($sql);

$roomSummary = [];
while ($row = $result->fetch_assoc()) {
    $roomSummary[] = $row;
}

echo json_encode($roomSummary);
?>
