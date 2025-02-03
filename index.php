<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <button id="dark-mode-btn" class="dark-mode-btn" onclick="toggleDarkMode()">Switch to Dark Mode</button>
    </header>

    <div class="profile">
        <a href="profile.php">
            <div class="profile-image">
                <!-- Ensure the image path is correct -->
                <img src="<?php echo htmlspecialchars($_SESSION['user_profile_pic']); ?>" alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%;">
            </div>
            <div class="profile-name">
                <p><?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
            </div>
        </a>
    </div>

    <h2>Mark Attendance</h2>
    <button onclick="markAttendance()">Mark Attendance</button>
    <div class="spinner" id="spinner"></div>
    <p id="status"></p>
    <a href="logout.php">Logout</a>

    <script>
        function markAttendance() {
            document.getElementById("spinner").style.display = "block"; // Show spinner
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    let lat = position.coords.latitude;
                    let lon = position.coords.longitude;
                    fetch('mark_attendance.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ latitude: lat, longitude: lon })
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('status').innerText = data;
                        document.getElementById("spinner").style.display = "none"; // Hide spinner
                    });
                });
            } else {
                document.getElementById('status').innerText = "Geolocation is not supported.";
                document.getElementById("spinner").style.display = "none"; // Hide spinner
            }
        }

        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            let button = document.getElementById('dark-mode-btn');
            button.innerText = document.body.classList.contains('dark-mode') ? "Switch to Light Mode" : "Switch to Dark Mode";
        }
    </script>
</body>
</html>