<?php
session_start();
require_once 'config.php'; // Ensure to include the config file

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $profile_pic_path = $user['profile_picture']; // Default to the current profile picture

    // Handle profile picture upload (if any)
    if ($_FILES['profile_picture']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['profile_picture']['name']);
        
        // Move the uploaded file to the uploads folder
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            $profile_pic_path = $target_file; // Update the path to the new image
        } else {
            echo "Error uploading the image.";
        }
    }

    // Update user information in the database
    $update_query = "UPDATE users SET name = ?, email = ?, profile_picture = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssi", $name, $email, $profile_pic_path, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['user_name'] = $name; // Update session name
        $_SESSION['user_profile_pic'] = $profile_pic_path; // Update session profile picture
        header("Location: index.php"); // Redirect to index page
        exit();
    } else {
        echo "Error updating profile!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="profile-container">
        <h2>Edit Your Profile</h2>
        <form action="profile.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture" id="profile_picture">
            </div>
            <button type="submit">Update Profile</button>
        </form>
        
        <!-- Display current profile picture -->
        <div>
            <h3>Current Profile Picture:</h3>
            <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" style="width:100px; height:auto;">
        </div>
    </div>
</body>
</html>