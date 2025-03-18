<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>
<p>You are now logged in.</p>

<?php
include 'config.php';

$user_id = $_SESSION['user_id'];
$bookings = mysqli_query(
    $conn,
    "SELECT bookings.id, services.name AS service, appointment_date, appointment_time, status 
     FROM bookings 
     JOIN services ON bookings.service_id = services.id 
     WHERE bookings.user_id = '$user_id' 
     ORDER BY appointment_date ASC"
);
?>

<h3>Your Appointments</h3>
<table border="1">
    <tr>
        <th>Service</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($bookings)) { ?>
        <tr>
            <td><?= $row['service']; ?></td>
            <td><?= $row['appointment_date']; ?></td>
            <td><?= $row['appointment_time']; ?></td>
            <td><?= ucfirst($row['status']); ?></td>
        </tr>
    <?php } ?>
</table>

<p><a href="book.php">Book an Appointment</a></p>

<a href="logout.php">Logout</a>