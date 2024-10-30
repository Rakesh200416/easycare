<?php
session_start();
include 'db.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $appointment_type = $conn->real_escape_string($_POST['appointment_type']);
    $age = (int)$_POST['age'];
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $appointment_date = $conn->real_escape_string($_POST['appointment_date']);
    $appointment_time = $conn->real_escape_string($_POST['appointment_time']);

    // SQL query to insert appointment data
    $sql = "INSERT INTO appointments (appointment_type, age, name, email, appointment_date, appointment_time)
            VALUES ('$appointment_type', $age, '$name', '$email', '$appointment_date', '$appointment_time')";

    if ($conn->query($sql) === TRUE) {
        // Store appointment details in session for confirmation
        $_SESSION['appointment_type'] = $appointment_type;
        $_SESSION['age'] = $age;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['appointment_date'] = $appointment_date;
        $_SESSION['appointment_time'] = $appointment_time;
        $_SESSION['message'] = "Appointment made successfully!";
        
        header("Location: success_page.php"); // Redirect to the success page
        exit();
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: appointment_form.php"); // Redirect back to appointment form
        exit();
    }

    $conn->close(); // Close the connection
}
?>
