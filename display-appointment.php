<!DOCTYPE html>
<html>
<head>
    <title>Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url("MentalHealthAwarenessmonth.jpg");
}

.header {
    background-color: grey;
    color: #fff; 
    padding: 20px;
}
.links a {
    color: goldenrod; 
    text-decoration: none;
    margin-left: 20px; 
    font-weight: bold; 
    transition: color 0.3s ease;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff; 
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #007bff; 
}

table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
}

th, td {
    padding: 12px 15px;
    border-bottom: 1px solid #dee2e6; /* Light gray border */
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e2e6ea;
}

.btn {
    padding: 8px 12px;
    text-decoration: none;
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn.delete {
    background-color: #dc3545;
}

.btn.update {
    background-color: #28a745; 
}

.btn:hover {
    background-color: #0056b3; 
}
.footer {
    background-color: navajowhite; 
    color: #fff; 
    padding: 20px 0;
    text-align: center;
    margin-top: auto; 
}

/*.footer-links {
    list-style-type: none;
    padding: 0;
}

.footer-links li {
    display: inline;
}

.footer-links li:not(:last-child) {
    margin-right: 20px;
}

.footer-links a {
    color: #fff; 
    text-decoration: none;
}*/

    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Welcome to our WellnessHub Platform</h1>
            <div class="links">
                <a href="appointment.php">Appointments</a>
                <a href="message_form.php">Message</a>
                <a href="sessions.php">Book Session</a>
                <a href="insert_assessment.php">Assessment</a>
                <a href="insert_feedback.php">Feedback</a>
                <a href="login.php">Logout</a>
            </div>
        </div>
    </header>
    <?php
        
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

        // Fetch appointments from the database
        $sql = "SELECT appointment_id, counselor_id, client_id, appointment_datetime, duration, notes, status FROM appointments";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Counselor ID</th>
                        <th>Client ID</th>
                        <th>Appointment Datetime</th>
                        <th>Duration</th>
                        <th>Notes</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["appointment_id"]."</td>
                        <td>".$row["counselor_id"]."</td>
                        <td>".$row["client_id"]."</td>
                        <td>".$row["appointment_datetime"]."</td>
                        <td>".$row["duration"]."</td>
                        <td>".$row["notes"]."</td>
                        <td>".$row["status"]."</td>
                        <td>
                            <a href='update.php?id=".$row["appointment_id"]."&status=".$row["status"]."&notes=".$row["notes"]."&duration=".$row["duration"]."&appointment_datetime=".$row["appointment_datetime"]."&client_id=".$row["client_id"]."&counselor_id=".$row["counselor_id"]."' class='btn update'>Update</a>
                            <a href='delete-appointment.php?id=".$row["appointment_id"]."' class='btn delete'>Delete</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
    ?>
    <footer class="footer">
    <div class="container">
        <ul class="footer-links">
            <li><a href="terms_of_service.html">Terms of Service</a></li>
            <li><a href="Privacy.html">Privacy Policy</a></li>
        </ul>
         </div>
</footer>
</body>
</html>
