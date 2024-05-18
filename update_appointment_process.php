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
    // Sanitize input data = 
    $appointment_id = $_POST['appointment_id'];
      $counselor_id=$_POST['counselor_id'];
    $client_id=$_POST['client_id'];
    $appointment_datetime= $_POST["appointment_datetime"];
    $duration = $_POST["duration"];
    $notes = $_POST["notes"];
  
    // Prepare SQL statement to insert data into the appointment table



       // $sql = "INSERT INTO `appointments` (`appointment_id`, `counselor_id`, `client_id`, `appointment_datetime`, `duration`, `notes`) VALUES (NULL, '$counselor_id', '$client_id', '$appointment_datetime', '$duration', '$notes')";

    $sql = "UPDATE appointments SET counselor_id = '$counselor_id', client_id = '$client_id', appointment_datetime = '$appointment_datetime', duration = '$duration', notes = '$notes' WHERE appointment_id = $appointment_id";


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
