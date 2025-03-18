<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE bookings SET status='canceled' WHERE id='$booking_id' AND user_id='$user_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Booking canceled successfully! <a href='dashboard.php'>Go back</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>