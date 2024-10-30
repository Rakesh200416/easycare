<?php
// Include your existing db.php file
include 'db.php';

// Retrieve data from the POST request
$heartRate = isset($_POST['heartRate']) ? intval($_POST['heartRate']) : null;
$waterIntake = isset($_POST['waterIntake']) ? intval($_POST['waterIntake']) : null;
$stressLevel = isset($_POST['stressLevel']) ? intval($_POST['stressLevel']) : null;
$bloodPressure = isset($_POST['bloodPressure']) ? $_POST['bloodPressure'] : null;

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO health_data (heart_rate, water_intake, stress_level, blood_pressure) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiis", $heartRate, $waterIntake, $stressLevel, $bloodPressure);

if ($stmt->execute()) {
    echo "Data saved successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
