<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "Error: You must be logged in.";
    exit();
}

require_once 'config.php'; // Ensure to include the config file
$data = json_decode(file_get_contents("php://input"), true);
$latitude = $data['latitude'];
$longitude = $data['longitude'];
$user_id = $_SESSION['user_id'];

// Allowed location (Change to actual values)
$allowed_lat = 6.491373;  // Change to allowed latitude
$allowed_lon = 3.391494;  // Change to allowed longitude
$radius = 0.01;

if (abs($latitude - $allowed_lat) <= $radius && abs($longitude - $allowed_lon) <= $radius) {
    $sql = "INSERT INTO attendance (user_id, latitude, longitude) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idd", $user_id, $latitude, $longitude);
    
    if ($stmt->execute()) {
        echo "Attendance marked successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Error: You are not in the allowed area.";
}

$conn->close();
?>