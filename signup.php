<?php
session_start();
include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = $conn->real_escape_string($_POST['name']);
    $experience = (int)$_POST['experience'];
    $qualification = $conn->real_escape_string($_POST['qualification']);
    $current_hospital = $conn->real_escape_string($_POST['current_hospital']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']); // Use plain text password
    $phone = $conn->real_escape_string($_POST['phone']);
    
    // SQL query to insert data into doctors table without photo and without password hashing
    $sql = "INSERT INTO doctors (name, experience, qualification, current_hospital, email, password, phone)
            VALUES ('$name', $experience, '$qualification', '$current_hospital', '$email', '$password', '$phone')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Doctor signup successful!";
        header("Location: index.php"); // Redirect to signup page after successful signup
        exit();
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: signup.html"); // Redirect back to signup page on error
        exit();
    }
    
    $conn->close(); // Close the connection
}
?>
