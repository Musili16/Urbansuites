<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.html");
    exit;
}

include 'db.php';

$type = $_POST["type"];
$price = $_POST["price"];

$stmt = $conn->prepare("INSERT INTO vacancies (type, price, status) VALUES (?, ?, 'Available')");
$stmt->bind_param("sd", $type, $price);
$stmt->execute();
?>
