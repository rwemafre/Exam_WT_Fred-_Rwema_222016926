<!DOCTYPE html>
<html>
<head>
    <title>Update Appointment</title>
    <style>
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

        .footer {
            background-color: navajowhite; 
            color: #fff; 
            padding: 20px 0;
            text-align: center;
            margin-top: auto; 
        }
    </style>
</head>
<body>
    <header class="header">
        <!-- Your header content here -->
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
                    
                    // Create a form with pre-filled values for update
                    echo "<form action='update_appointment_process.php' method='post'>
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
        <!-- Your footer content here -->
    </footer>
</body>
</html>
