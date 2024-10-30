<?php
session_start();
include 'db.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Get the plain text password

    // SQL query to select user
    $sql = "SELECT * FROM patients1 WHERE email='$email'";
    // $sql = "SELECT * FROM doctors WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, check password
        $row = $result->fetch_assoc();
        
        // For simplicity, we are using plain text comparison.
        // Ideally, use password_verify() if you are storing hashed passwords.
        if ($row['password'] === $password) {
            // Store user information in session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header("Location: index.php"); // Redirect to home page after successful sign-in
            exit();
        } else {
            $_SESSION['message'] = "Invalid password. Please try again.";
            header("Location: signin.html"); // Redirect back to sign-in page
            exit();
        }
    } else {
        $_SESSION['message'] = "No account found with that email.";
        header("Location: signin.html"); // Redirect back to sign-in page
        exit();
    }

    $conn->close(); // Close the connection
}
?>
