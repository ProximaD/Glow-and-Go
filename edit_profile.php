<?php
session_start();
require 'config.php'; // Ensure database connection is correct

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please log in.");
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Ensure user data exists
$full_name = $user['full_name'] ?? ''; // Avoids undefined array key error
$email = $user['email'] ?? '';
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
    <h2>Edit Profile</h2>
    <form action="update_profile.php" method="POST">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">

        <label>Full Name:</label>
        <input type="text" name="full_name" value="<?= htmlspecialchars($full_name) ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

        <label>Password (Leave blank to keep current):</label>
        <input type="password" name="password">

        <button type="submit">Update Profile</button>
    </form>
</body>

</html>