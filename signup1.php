<?php
session_start();
include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = $conn->real_escape_string($_POST['name']);
    $age = (int)$_POST['age'];
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']); // Store the password as plain text
    $phone = $conn->real_escape_string($_POST['phone']);

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM patients WHERE email='$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Email already exists! Please use a different email.";
        header("Location: signup.html"); // Redirect back to signup page
        exit();
    }

    // SQL query to insert data into patients table
    $sql = "INSERT INTO patients1 (name, age, email, password, phone)
            VALUES ('$name', $age, '$email', '$password', '$phone')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Patient signup successful!";
        header("Location: index.php"); // Redirect to home page after successful signup
        exit();
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: signup.html"); // Redirect back to signup page on error
        exit();
    }

    $conn->close(); // Close the connection
}
?>
