<?php
// Check if appointment ID is provided in the URL
if(isset($_GET['id'])) {
    // Retrieve appointment ID from the URL parameter
    $appointment_id = $_GET['id'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "wellnesshub database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Construct SQL query to delete appointment
    $sql = "DELETE FROM appointments WHERE appointment_id = $appointment_id";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        // Appointment deleted successfully, redirect back to appointments page
        header("Location: display-appointment.php");
        exit(); // Ensure no further code execution after redirection
    } else {
        echo "Error deleting appointment: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    // If appointment ID is not provided, display error message
    echo "Appointment ID not provided.";
}
?>
