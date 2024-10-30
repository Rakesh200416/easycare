<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the session message is set
if (!isset($_SESSION['message'])) {
    header("Location: appointment_form.php"); // Redirect to appointment form if accessed directly
    exit();
}

// Get appointment details from the session
$appointment_type = $_SESSION['appointment_type'] ?? 'N/A';
$age = $_SESSION['age'] ?? 'N/A';
$name = $_SESSION['name'] ?? 'N/A';
$email = $_SESSION['email'] ?? 'N/A';
$appointment_date = $_SESSION['appointment_date'] ?? 'N/A';
$appointment_time = $_SESSION['appointment_time'] ?? 'N/A';

// Clear session message and appointment details
$message = $_SESSION['message'];
unset($_SESSION['message']);
unset($_SESSION['appointment_type'], $_SESSION['age'], $_SESSION['name'], $_SESSION['email'], $_SESSION['appointment_date'], $_SESSION['appointment_time']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="stylesheet" href="style.css">

    <style>
        body { overflow: hidden; }
        header { position: relative; }
        .exam {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 80vh;
            width: 80%;
            margin: auto;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/logo.png" alt="">
            <h2>Easy<span class="danger">Care</span></h2>
        </div>
        <div class="navbar">
            <a href="index.php">
                <span class="material-icons-sharp">home</span>
                <h3>Home</h3>
            </a>
            <a href="timetable.html" onclick="timeTableAll()">
                <span class="material-icons-sharp">today</span>
                <h3>Time Table</h3>
            </a>
            <a href="exam.html" class="active">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Examination</h3>
            </a>
            <a href="password.html">
                <span class="material-icons-sharp">password</span>
                <h3>Change Password</h3>
            </a>
            <a href="#">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </div>
        <div id="profile-btn" style="display: none;">
            <span class="material-icons-sharp">person</span>
        </div>
        <div class="theme-toggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
        </div>
    </header>

    <main>
        <div class="exam timetable">
            <h2>Appointment Confirmation</h2>
            <p><?php echo $message; ?></p>
            <table>
                <thead>
                    <tr>
                        <th>Appointment Type</th>
                        <th>Age</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($appointment_type); ?></td>
                        <td><?php echo htmlspecialchars($age); ?></td>
                        <td><?php echo htmlspecialchars($name); ?></td>
                        <td><?php echo htmlspecialchars($email); ?></td>
                        <td><?php echo htmlspecialchars($appointment_date); ?></td>
                        <td><?php echo htmlspecialchars($appointment_time); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>
<script src="app.js"></script>
</html>
