<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch available services
$services = mysqli_query($conn, "SELECT * FROM services");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $service_id = $_POST['service_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "INSERT INTO bookings (user_id, service_id, appointment_date, appointment_time) 
            VALUES ('$user_id', '$service_id', '$date', '$time')";

    if (mysqli_query($conn, $sql)) {
        echo "Booking successful! <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<h2>Book an Appointment</h2>
<form method="post">
    <label>Select Service:</label>
    <select name="service_id" required>
        <?php while ($row = mysqli_fetch_assoc($services)) { ?>
            <option value="<?= $row['id']; ?>"><?= $row['name']; ?> - $<?= $row['price']; ?></option>
        <?php } ?>
    </select><br>

    <label>Date:</label>
    <input type="date" name="date" required><br>

    <label>Time:</label>
    <input type="time" name="time" required><br>

    <button type="submit">Book Now</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>