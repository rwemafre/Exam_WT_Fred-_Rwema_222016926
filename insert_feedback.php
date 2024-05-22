<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Feedback Form</title>
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

.header h1 {
    margin: 0;
    font-size: 24px;
}

.links {
    margin-top: 10px;
}

.links a {
    color: #fff; 
    text-decoration: none;
    margin-right: 20px;
    font-weight: bold;
}

.links a:hover {
    text-decoration: underline;
}


.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.container h2 {
    text-align: center;
}

.container form {
    display: flex;
    flex-direction: column;
}

.container label {
    font-weight: bold;
    margin-bottom: 5px;
}

.container input[type="number"],
.container textarea {
    margin-bottom: 10px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.container input[type="submit"] {
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.container input[type="submit"]:hover {
    background-color: #0056b3;
}

.container #error-message {
    color: red;
    margin-top: 10px;
}

/* Footer Styles */
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
    color: #fff; 
    margin-right: 10px;
    font-size: 24px;
}    </style>
</head>
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
<body>
    <div class="container">
        <h2>Submit Feedback</h2>
        <form action="" method="post" id="feedbackForm">
            <label for="counselor_id">Counselor ID:</label>
            <input type="number" id="counselor_id" name="counselor_id" required><br>

            <label for="client_id">Client ID:</label>
            <input type="number" id="client_id" name="client_id" required><br>

            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required><br>

            <label for="comments">Comments:</label><br>
            <textarea id="comments" name="comments" rows="4" cols="50" required></textarea><br>

            <input type="submit" value="Submit Feedback">
            <p id="error-message" class="error-message"></p>
        </form>
    </div>

    <script>
        document.getElementById("feedbackForm").addEventListener("submit", function(event) {
            var rating = document.getElementById("rating").value;
            if (isNaN(rating) || rating < 1 || rating > 5) {
                document.getElementById("error-message").innerText = "Please enter a valid rating between 1 and 5.";
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "wellnesshub database";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $counselor_id = $_POST["counselor_id"];
        $client_id = $_POST["client_id"];
        $rating = $_POST["rating"];
        $comments = $_POST["comments"];

        
        $sql = "INSERT INTO `feedback-reviews` (counselor_id, client_id, rating, comments, date_submitted) VALUES ('$counselor_id', '$client_id', '$rating', '$comments', NOW())";


        if ($conn->query($sql) === TRUE) {
            echo "<p>Feedback submitted successfully.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
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
</body>
</html>
