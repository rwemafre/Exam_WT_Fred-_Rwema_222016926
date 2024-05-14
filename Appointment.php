<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
    padding: 0;
    background-image: url("mental-health-awareness-month.jpg");
    color: #333;
}
.header {
    background-color: grey;
    color: #fff; 
    padding: 20px;
}

/*.container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}*/

.links {
    margin-right: 20px;
}

.links a {
    color: #f1f1ff; 
    text-decoration: none;
    margin-left: 20px; 
    font-weight: bold; 
    transition: color 0.3s ease;
}

.links a:hover {
    color: #0056b3; 
    text-decoration: underline; 
}



.container {
    flex: 1; 
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Footer Styles */
.footer {
    background-color: #343a40; 
    color: #fff; 
    padding: 20px 0;
    text-align: center;
    margin-top: auto; 
}

.footer-links {
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
}


.social-icons {
    margin-top: 20px;
}

.social-icon {
    color: #fff;
    margin-right: 10px;
    font-size: 24px; 
}
        .container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

h2 {
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="datetime-local"],
input[type="number"],
textarea {
    margin-bottom: 10px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="submit"] {
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Welcome to our WellnessHub Platform</h1>
            <div class="links">
                <a href="appointment.php">Appointments</a>
                <a href="login.php">Logout</a>
            </div>
        </div>
    </header>

<div class="container">
    <h2>Book an Appointment</h2>
    <form action="" method="post" id="appointmentForm">


        <label for="duration">counselor id:</label>
        <input type="text" id="counselor" name="counselor_id" required><br><br>

          <label for="duration">client id</label>
        <input type="text" id="client" name="client_id" required><br><br>
  
        <label for="datetime">appointment Date & time:</label>
        <input type="datetime-local" id="datetime" name="appointment_datetime" required><br><br>


        <label for="datetime">Duration</label>
        <input type="time" id="time" name="duration" required><br><br>

        <label for="notes">Notes:</label><br>
        <textarea id="notes" name="notes"></textarea><br><br>

        <input type="submit" value="Submit">
    </form>
    <?php
// Database configuration
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
      $counselor_id=$_POST['counselor_id'];
    $client_id=$_POST['client_id'];
    $appointment_datetime= $_POST["appointment_datetime"];
    $duration = $_POST["duration"];
    $notes = $_POST["notes"];
  
    // Prepare SQL statement to insert data into the appointment table



       $sql = "INSERT INTO `appointments` (`appointment_id`, `counselor_id`, `client_id`, `appointment_datetime`, `duration`, `notes`) VALUES (NULL, '$counselor_id', '$client_id', '$appointment_datetime', '$duration', '$notes')";

    $stmt = mysqli_query($conn, $sql);

     if ($stmt) {
        // Redirect user to display_appointments.php
        header("Location: display-appointment.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close connection
$conn->close();
?>

</div>

<script src="script.js">
    document.getElementById("appointmentForm").addEventListener("submit", function(event) {
    // Basic form validation
    var duration = document.getElementById("duration").value;
    if (isNaN(duration) || duration <= 0) {
        alert("Please enter a valid duration.");
        event.preventDefault(); // Prevent form submission
    }
});

</script>
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




