<?php
session_start();
$conn = new mysqli("urban-server.mysql.database.azure.com", "rjaoqirfmz", "Nsxpas5k", "apartment_rentals");


if ($connection->connect_error) {
    die("Database connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("Error: Passwords do not match.");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO tenants (full_name, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss", $full_name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        header("Location: login.html?message=Account created successfully! Please log in.");
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }    

    $stmt->close();
}

$connection->close();
?>
