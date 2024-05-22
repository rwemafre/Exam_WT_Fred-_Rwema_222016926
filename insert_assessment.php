<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background-image: url(mental-health-stock-image.jpg);
            color: #333;
        }
        .header {
            background-color: grey;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
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
        input[type="text"],
        input[type="date"],
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
        .footer {
    background-color: #343a40; /* Footer background color */
    color: #fff; /* Footer text color */
    padding: 20px 0;
    text-align: center;
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
    color: #fff; /* Footer link text color */
    text-decoration: none;
}

.social-icons {
    margin-top: 20px;
}

.social-icon {
    color: #fff; /* Social icon color */
    margin-right: 10px;
    font-size: 24px; /* Social icon size */
}
    </style>
</head>
<body>
    <header class="header">
        <h1>Welcome to our WellnessHub Platform</h1>
            <div class="links">
                <a href="appointment.php">Appointments</a>
                <a href="message_form.php">Message</a>
                <a href="sessions.php">Book Session</a>
                <a href="insert_assessment.php">Assessment</a>
                <a href="insert_feedback.php">Feedback</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>

    <div class="container">
        <h2>Assessment Form</h2>
        <form action="insert_assessment.php" method="post" id="assessmentForm">
            <label for="client_id">Client ID:</label>
            <input type="text" id="client_id" name="client_id" required><br><br>

            <label for="assessment_type">Assessment Type:</label>
            <select id="assessment_type" name="assessment_type" required>
                <option value="initial">Initial</option>
                <option value="follow-up">Follow-up</option>
                <option value="final">Final</option>
            </select>

            <label for="assessment_date">Assessment Date:</label>
            <input type="date" id="assessment_date" name="assessment_date" required><br><br>

            <label for="scores">Scores:</label>
<select id="scores" name="scores" required>
    <option value="">Select Score</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="other">Other</option>
</select>

            <label for="goals">Goals:</label>
            <select id="goals" name="goals" required>
                <option value="reduce_anxiety">Reduce Anxiety</option>
                <option value="improve_sleep">Improve Sleep</option>
                <option value="enhance_focus">Enhance Focus</option>
                <option value="increase_motivation">Increase Motivation</option>
                <option value="manage_stress">Manage Stress</option>
                <option value="build_self-esteem">Build Self-Esteem</option>
                <option value="strengthen_relationships">Strengthen Relationships</option>
                <option value="develop_coping_skills">Develop Coping Skills</option>
                <option value="other">Other</option>
            </select>

            <label for="progress_notes">Progress Notes:</label>
            <textarea id="progress_notes" name="progress_notes" rows="4" cols="50"></textarea><br><br>

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
    $client_id = $_POST["client_id"];
    $assessment_type = $_POST["assessment_type"];
    $assessment_date = $_POST["assessment_date"];
    $scores = $_POST["scores"];
    $goals = $_POST["goals"];
    $progress_notes = $_POST["progress_notes"];

    // Prepare SQL statement to insert data into the assessments table
    $stmt = $conn->prepare("INSERT INTO assessments (client_id, assessment_type, assessment_date, scores, goals, progress_notes) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $client_id, $assessment_type, $assessment_date, $scores, $goals, $progress_notes);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Assessment recorded successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>


       </div>
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
        document.getElementById("assessmentForm").addEventListener("submit", function(event) {
            var client_id = document.getElementById("client_id").value;
            var assessment_type = document.getElementById("assessment_type").value;
            var scores = document.getElementById("scores").value;

            if (client_id.trim() === "" || assessment_type.trim() === "" || scores.trim() === "") {
                alert("Please fill out all required fields.");
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
