<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .form-container {
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
        input[type="text"],
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
                <a href="message_form.php">Message</a>
                <a href="insert_session.php">Book Session</a>
                <a href="insert_assessment.php">Assessment</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>

    <div class="form-container">
        <h2>Book a Session</h2>
        <form action="insert_session.php" method="post" id="sessionForm">
            <label for="counselor_id">Counselor ID:</label>
            <input type="number" id="counselor_id" name="counselor_id" required><br><br>

            <label for="client_id">Client ID:</label>
            <input type="number" id="client_id" name="client_id" required><br><br>

            <label for="session_start">Session Start:</label>
            <input type="datetime-local" id="session_start" name="session_start" required><br><br>

            <label for="session_end">Session End:</label>
            <input type="datetime-local" id="session_end" name="session_end" required><br><br>

            <label for="session_type">Session Type:</label>
            <select id="session_type" name="session_type" required>
                <option value="">Select Session Type</option>
                <option value="Individual Therapy">Individual Therapy</option>
                <option value="Group Therapy">Group Therapy</option>
                <option value="Family Therapy">Family Therapy</option>
                <option value="Couples Therapy">Couples Therapy</option>
                <option value="Cognitive Behavioral Therapy">Cognitive Behavioral Therapy (CBT)</option>
                <option value="Psychodynamic Therapy">Psychodynamic Therapy</option>
                <option value="Support Group">Support Group</option>
                <option value="Consultation">Consultation</option>
                <option value="Crisis Intervention">Crisis Intervention</option>
                <option value="Follow-Up Session">Follow-Up Session</option>
            </select><br><br>

            <label for="duration">Duration (in minutes):</label>
            <input type="number" id="duration" name="duration" required><br><br>

            <label for="notes">Notes:</label><br>
            <textarea id="notes" name="notes" rows="4" cols="50"></textarea><br><br>

            <input type="submit" value="Submit">
        </form>
    </div>
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
    $counselor_id = $_POST["counselor_id"];
    $client_id = $_POST["client_id"];
    $session_start = $_POST["session_start"];
    $session_end = $_POST["session_end"];
    $session_type = $_POST["session_type"];
    $duration = $_POST["duration"];
    $notes = $_POST["notes"];

    // Prepare SQL statement to insert data into the sessions table
    $stmt = $conn->prepare("INSERT INTO sessions (counselor_id, client_id, session_start, session_end, session_type, duration, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssis", $counselor_id, $client_id, $session_start, $session_end, $session_type, $duration, $notes);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Session booked successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>


    <footer class="footer">
    <div class="container">
        <ul class="footer-links">
            <li><a href="terms_of_service.html">Terms of Service</a></li>
            <li><a href="Privacy.html">Privacy Policy</a></li>
            
        </ul>
        <div class="social-icons">
            <!-- Footer Section -->
<footer class="footer">
    <div class="container">
        <ul class="footer-links">
            <li><a href="terms_of_service.html">Terms of Service</a></li>
            <li><a href="Privacy.html">Privacy Policy</a></li>
        </ul>
        <div class="social-icons">
            <a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
</footer>

        </div>
    </div>
</footer>
    <script>
        document.getElementById("sessionForm").addEventListener("submit", function(event) {
            // Basic form validation
            var duration = document.getElementById("duration").value;
            if (isNaN(duration) || duration <= 0) {
                alert("Please enter a valid duration.");
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
</body>
</html>
