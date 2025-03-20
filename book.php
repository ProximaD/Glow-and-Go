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

    // Check if service_id is set
    if (!isset($_POST['service_id']) || empty($_POST['service_id'])) {
        die("Error: Service ID is missing.");
    }

    $service_id = $_POST['service_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Validate if service_id exists in the database
    $stmt = $conn->prepare("SELECT id FROM services WHERE id = ?");
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        die("Error: Invalid service ID.");
    }

    // Insert into bookings
    $sql = "INSERT INTO bookings (user_id, service_id, appointment_date, appointment_time) 
            VALUES ('$user_id', '$service_id', '$date', '$time')";

    if (mysqli_query($conn, $sql)) {
        echo "Booking successful! <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .booking-container {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
        }

        a {
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="booking-container">
            <h2>Book an Appointment</h2>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Select Service:</label>
                    <select name="service_id" class="form-control" required>
                        <option value="">Select a service</option>
                        <?php while ($row = mysqli_fetch_assoc($services)) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name'] . " - $" . $row['price']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Date:</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Time:</label>
                    <input type="time" name="time" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Book Now</button>
            </form>

            <a href="dashboard.php" class="text-primary">Back to Dashboard</a>
        </div>
    </div>

</body>

</html>