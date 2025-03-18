<?php
$servername = "localhost";
$username = "root"; // Change if using a different username
$password = ""; // Change if using a password
$database = "salon_booking";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>