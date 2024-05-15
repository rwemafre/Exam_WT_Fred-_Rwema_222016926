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
} else {
    echo "ERROR: Form data is missing.";
}
?>
