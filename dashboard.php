<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Check if user_name is set in the session before using it
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "Guest";
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .dashboard-card {
            min-height: 150px;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Glow and Go</a>
            <div class="ms-auto">
                <span class="text-white me-3">Welcome, <?php echo htmlspecialchars($user_name); ?>!</span>
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="mb-4">Dashboard</h2>

        <div class="row">
            <div class="col-md-4">
                <div class="card dashboard-card shadow">
                    <div class="card-body text-center">
                        <h4>Book an Appointment</h4>
                        <p>Schedule your next salon visit.</p>
                        <a href="book.php" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card dashboard-card shadow">
                    <div class="card-body text-center">
                        <h4>My Appointments</h4>
                        <p>View your upcoming bookings.</p>
                        <a href="view_bookings.php" class="btn btn-success">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card dashboard-card shadow">
                    <div class="card-body text-center">
                        <h4>Profile</h4>
                        <p>Manage your account details.</p>
                        <a href="edit_profile.php" class="btn btn-warning">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>