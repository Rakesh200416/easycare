<?php
include 'db.php'; // Include your database connection file

// SQL query to fetch data from patient1 and health_data
$sql = "SELECT p.patient_id, p.name, hd.heart_rate, hd.blood_pressure, hd.water_intake, hd.date
        FROM patient1 AS p
        JOIN health_data AS hd ON p.patient_id = hd.patient_id
        ORDER BY hd.date DESC"; // Adjust the order as necessary

$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Start HTML output
    echo "<h1>Patient Health Dashboard</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Patient ID</th><th>Name</th><th>Heart Rate</th><th>Blood Pressure</th><th>Water Intake</th><th>Date</th></tr>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['patient_id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['heart_rate'] . "</td>";
        echo "<td>" . $row['blood_pressure'] . "</td>";
        echo "<td>" . $row['water_intake'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close(); // Close the connection
?>

