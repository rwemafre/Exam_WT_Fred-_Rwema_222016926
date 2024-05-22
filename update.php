<!DOCTYPE html>
<html>
<head>
    <title>Update Appointment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .header {
    background-color: #007bff; 
    color: #fff; 
    padding: 20px 0; 
}

.header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}


.header h1 {
    margin: 0; 
    font-size: 24px;
}

.header .links a {
    color: #fff; 
    text-decoration: none; 
    margin-left: 20px; 
    transition: color 0.3s ease; 
}

.header .links a:hover {
    color: #f8f9fa; 
}
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .header {
            background-color: grey;
            color: #fff; 
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff; 
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff; 
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="datetime-local"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

       footer {
            background-color: #343a40;
            color: #fff;
            padding: 40px 0;
            text-align: center;
            margin-top: auto;
        }

        .footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-links {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .footer-links li {
            margin: 0 15px;
        }

        .footer-links a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #f8f9fa;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            color: #fff;
            margin: 0 10px;
            font-size: 24px;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #adb5bd;
        }

        @media (max-width: 768px) {
            .footer {
                text-align: center;
            }

            .footer-links {
                flex-direction: column;
            }

            .footer-links li {
                margin: 10px 0;
            }
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
                <a href="sessions.php">Book Session</a>
                <a href="insert_assessment.php">Assessment</a>
                <a href="insert_feedback.php">Feedback</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>

    <div class="container">
        <h2>Update Appointment</h2>
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
            // Check if an appointment ID is provided
            if(isset($_GET['id'])) {
                $appointment_id = $_GET['id'];

                // Fetch appointment details from the database
                $sql = "SELECT * FROM appointments WHERE appointment_id = $appointment_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    
                    echo "<form action='update_appointment_process.php' method='post'>
                    <input type='hidden' name='appointment_id' value='".$row['appointment_id']."'>
                            <input type='hidden' name='appointment_id' value='".$row['appointment_id']."'>
                            <label>Counselor ID:</label><br>
                            <input type='text' name='counselor_id' value='".$row['counselor_id']."'><br>
                            <label>Client ID:</label><br>
                            <input type='text' name='client_id' value='".$row['client_id']."'><br>
                            <label>Appointment Datetime:</label><br>
                            <input type='datetime-local' name='appointment_datetime' value='".date('Y-m-d\TH:i', strtotime($row['appointment_datetime']))."'><br>
                            <label>Duration:</label><br>
                            <input type='text' name='duration' value='".$row['duration']."'><br>
                            <label>Notes:</label><br>
                            <textarea name='notes'>".$row['notes']."</textarea><br>
                            <label>Status:</label><br>
                            <input type='text' name='status' value='".$row['status']."'><br>
                            <input type='submit' value='Update'>
                        </form>";
                } else {
                    echo "Appointment not found.";
                }
            } else {
                echo "Invalid appointment ID.";
            }
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
</body>
</html>
