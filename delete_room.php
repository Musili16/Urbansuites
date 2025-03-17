<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.html");
    exit;
}

include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["id"])) {
    $stmt = $conn->prepare("DELETE FROM vacancies WHERE id = ?");
    $stmt->bind_param("i", $data["id"]);
    $stmt->execute();
}
?>
