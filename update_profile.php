<?php
session_start();
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET full_name=?, email=?, password=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $full_name, $email, $hashed_password, $user_id);
    } else {
        $query = "UPDATE users SET full_name=?, email=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $full_name, $email, $user_id);
    }

    if ($stmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: dashboard.php");
    } else {
        echo "Error updating profile.";
    }
}
?>