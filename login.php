<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./new.css"/>

</head>
<body>
    <div class="container">
        <form action="action">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit"class="btn">Login</button>
            <div class="register-link">
                <p>
                    Don't have an account? <a href="#">Register</a>
                </p>

            </div>
        </form>
    </div>
</body>
</html>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost"; // Change this if your database is hosted elsewhere
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "dbsiam"; // Name of your database

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs for security
    $name = $conn->real_escape_string($_POST['name']);
    $password = $conn->real_escape_string($_POST['password']);

    // SQL query to fetch user from database
    $sql = "SELECT * FROM users WHERE name='$name'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Login successful!";
            // Redirect to dashboard or home page
            // header("Location: dashboard.php");
            // exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }

    // Close connection
    $conn->close();
}
?>