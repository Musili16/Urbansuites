<?php
session_start();
$conn = new mysqli("urban-server.mysql.database.azure.com", "rjaoqirfmz", "Nsxpas5k", "apartment_rentals");

if ($connection->connect_error) {
    die("Database connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT id, full_name, password FROM tenants WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $full_name, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['tenant_id'] = $id;
            $_SESSION['tenant_name'] = $full_name;
            echo "Login successful! Redirecting...";
            header("refresh:2; url=dashboard.php");
        } else {
            echo "Error: Incorrect password.";
        }
    } else {
        echo "Error: No account found with this email.";
    }

    $stmt->close();
}

$connection->close();
?>
