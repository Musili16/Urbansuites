<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.html");
    exit;
}

include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["id"], $data["price"])) {
    $stmt = $conn->prepare("UPDATE vacancies SET price = ? WHERE id = ?");
    $stmt->bind_param("di", $data["price"], $data["id"]);
    $stmt->execute();
}

if (isset($data["id"], $data["status"])) {
    $stmt = $conn->prepare("UPDATE vacancies SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $data["status"], $data["id"]);
    $stmt->execute();
}
?>
