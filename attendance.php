<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT u.name, a.timestamp, a.latitude, a.longitude FROM attendance a 
        JOIN users u ON a.user_id = u.id 
        ORDER BY a.timestamp DESC";
$result = $conn->query($sql);

echo "<h2>Attendance Records</h2>";
echo "<table border='1'>
        <tr>
            <th>User Name</th>
            <th>Time</th>
            <th>Latitude</th>
            <th>Longitude</th>
        </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['name'] . "</td>
                <td>" . $row['timestamp'] . "</td>
                <td>" . $row['latitude'] . "</td>
                <td>" . $row['longitude'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No attendance records found.";
}

$conn->close();
?>
