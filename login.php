<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style type="text/css">
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.login-box {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-box h2 {
    margin-bottom: 20px;
    color: #333;
}

.input-group {
    margin-bottom: 20px;
    text-align: left;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

.input-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.error-message {
    color: red;
    font-size: 14px;
    display: block;
    margin-top: 5px;
}

button[type="submit"] {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #45a049;
}


    </style>

<div class="login-container">
    <div class="login-box">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <small id="emailError" class="error-message"></small>
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <small id="passwordError" class="error-message"></small>
            </div>

            <button type="submit" name="login">Login</button>
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
    $email = $_POST["email"];
    $password = $_POST["password"];

    // SQL injection prevention: using prepared statements
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);

    // Execute the prepared statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if user exists and password is correct
    if ($result->num_rows == 1) {
        // Login successful
        session_start();
        $_SESSION["email"] = $email;
        header("Location: home.html");
        exit();
    } else {
        // Login failed
        echo "<p class='error-message'>Invalid email or password</p>";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<p>Don't have an account? <a href="register.php">Sign up here</a></p>
    </div>
</div>

<script>
    const loginForm = document.querySelector('form');

    loginForm.addEventListener('submit', function(event) {
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        let isValid = true;

        if (!isValidEmail(email.value)) {
            emailError.textContent = 'Please enter a valid email';
            isValid = false;
        } else {
            emailError.textContent = '';
        }

        if (!password.value) {
            passwordError.textContent = 'Please enter your password';
            isValid = false;
        } else {
            passwordError.textContent = '';
        }

        if (!isValid) {
            event.preventDefault(); // Prevent form submission
        }
    });

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
</script>

</body>
</html>
