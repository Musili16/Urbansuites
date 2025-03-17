<?php
header("Content-Type: application/json");
$conn = new mysqli("urban-server.mysql.database.azure.com", "rjaoqirfmz", "Nsxpas5k", "apartment_rentals");

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$sql = "SELECT images.image_url, vacancies.type, vacancies.status 
        FROM images 
        INNER JOIN vacancies ON images.vacancy_id = vacancies.id
        WHERE images.id BETWEEN 1 AND 4";
        
$result = $conn->query($sql);

$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = $row;
}

echo json_encode($images);
$conn->close();
?>
