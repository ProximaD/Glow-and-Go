<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user bookings
$query = "SELECT b.id, s.name AS service_name, b.appointment_date, b.appointment_time
          FROM bookings b
          JOIN services s ON b.service_id = s.id
          WHERE b.user_id = ?
          ORDER BY b.appointment_date ASC, b.appointment_time ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">My Upcoming Appointments</h2>

        <?php if ($result->num_rows > 0) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['appointment_time']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="alert alert-info">You have no upcoming appointments.</p>
        <?php } ?>

        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>

</body>

</html>