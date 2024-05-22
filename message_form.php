<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Message Form</title>
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
            background-image: url("mental-health-awareness-month.jpg");
            margin: 0;
            padding: 0;
        }

        ..container {
    max-width: 500px;
    margin: 50px auto;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
}

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        form{
            margin-left: 30%;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"],
        textarea {
    width: 50%; /* Adjust the width as needed */
    margin: 0 auto; 
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

        textarea {
            height: 120px;
            resize: vertical;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 14px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            margin-top: 10px;
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
<body>
    <h2>Insert Message</h2>
    <form action="insert_message.php" method="post">

        <label for="sender_id">Sender ID:</label><br>
        <input type="text" id="sender_id" name="sender_id">
        
        <label for="receiver_id">Receiver ID:</label><br>
        <input type="text" id="receiver_id" name="receiver_id"><br>
        
        <label for="message_content">Message Content:</label><br>
        <textarea id="message_content" name="message_content" rows="4" cols="50"></textarea><br>
        
        <input type="submit" value="Submit">
    </form>
  <?php
// Check if form is submitted and contains necessary data
if(isset($_POST['sender_id'], $_POST['receiver_id'], $_POST['message_content'])) {
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

    // Escape user inputs for security
    $sender_id = mysqli_real_escape_string($conn, $_POST['sender_id']);
    $receiver_id = mysqli_real_escape_string($conn, $_POST['receiver_id']);
    $message_content = mysqli_real_escape_string($conn, $_POST['message_content']);
    $timestamp = date('Y-m-d H:i:s'); // Assuming you want to use the current timestamp

    // Check if the sender_id exists in the users table
    $check_sender_query = "SELECT * FROM users WHERE user_id = '$sender_id'";
    $result = $conn->query($check_sender_query);
    if ($result->num_rows == 0) {
        echo "ERROR: Sender ID does not exist.";
        exit;
    }

    // Attempt insert query execution
    $sql = "INSERT INTO messages (sender_id, receiver_id, message_content, timestamp, read_status) VALUES ('$sender_id', '$receiver_id', '$message_content', '$timestamp', 'unread')";
    if ($conn->query($sql) === TRUE) {
        echo "Message inserted successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . $conn->error;
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
