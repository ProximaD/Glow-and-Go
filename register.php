<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="post">
    <label>Name:</label>
    <input type="text" name="name" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Register</button>
</form>