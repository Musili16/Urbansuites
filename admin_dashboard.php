<?php
session_start();

// Protect Admin Dashboard
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php'; // Ensure db.php initializes $pdo or $conn

// Admin Vacancy Addition Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_vacancy'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $status = $_POST['status'];

    // Insert into vacancies table
    $stmt = $pdo->prepare("INSERT INTO vacancies (title, description, type, price, location, status) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $type, $price, $location, $status]);

    echo "Vacancy added successfully!";
}
?>

<!-- Admin Dashboard HTML -->
<h2>Welcome to the Admin Dashboard</h2>

<!-- Admin Form -->
<form method="POST">
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <select name="type" required>
        <option value="single room">Single Room</option>
        <option value="bedsitter">Bedsitter</option>
        <option value="one-bedroom">One Bedroom</option>
        <option value="two-bedroom">Two Bedroom</option>
    </select>
    <input type="number" name="price" placeholder="Price" required>
    <input type="text" name="location" placeholder="Location" required>
    <select name="status" required>
        <option value="available">Available</option>
        <option value="occupied">Occupied</option>
    </select>
    <button type="submit" name="add_vacancy">Add Vacancy</button>
</form>

<!-- Logout button -->
<a href="admin_logout.php">Logout</a>
