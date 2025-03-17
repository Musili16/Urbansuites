<?php
include 'db.php';

$username = "Jeff";
$password = "Nsxpas5k"; // Change this as needed
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);

if ($stmt->execute()) {
    echo "Admin inserted successfully.";
} else {
    echo "Error inserting admin: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
