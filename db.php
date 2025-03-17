<?php
$host = 'urban-server.mysql.database.azure.com';
$dbname = 'apartment_rentals';
$username = 'rjaoqirfmz';
$password = 'Nsxpas5k'; 

try {
    // Establish database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$conn = new mysqli($host, $username, $password, $dbname);

// Check for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
