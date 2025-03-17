<?php
session_start();
include 'db.php'; // Make sure db.php correctly initializes $conn

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $row["password"])) {
            $_SESSION["admin_logged_in"] = true;
            $_SESSION["admin_id"] = $row["id"]; // 🔴 Fix: Correctly assign admin_id

            header("Location: admin_dashboard.html"); // 🔴 Fix: Redirect to PHP file
            exit();
        } else {
            $_SESSION["login_error"] = "Invalid username or password.";
        }
    } else {
        $_SESSION["login_error"] = "Invalid username or password.";
    }

    $stmt->close();
}

// Redirect back to login page if authentication fails
header("Location: admin_login.html");
exit();
?>
