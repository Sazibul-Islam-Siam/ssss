<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./new.css"/>
</head>
<body>
  <div class="container">
    <form action="c1.php" method="post">
        <h1>Registration</h1>
        <div class="input-box">
            <input type="text" placeholder="Enter Name" name="name" required>
        </div>
        
        <div class="input-box">
          <input type="tel" placeholder="Enter Mobile Number" name="mobile" required>
          
      </div>
      <div class="input-box">
            <input type="text" placeholder="Enter Email" name="email" required>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Enter Password" name="password" required>
            
        </div>
        
      
        <button type="submit"class="btn">Register</button>
        <div class="login-link">
            <p>
               <br> Already have an account? <a href="./login.html">Login</a>
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

    // Create the users table if it doesn't exist
    $create_table_sql = "CREATE TABLE IF NOT EXISTS users (
       `id` int(11) NOT NULL,
       `name` varchar(255) NOT NULL,
       `mobile` int(11) NOT NULL,
       `email` varchar(255) NOT NULL,
       `password` varchar(255) NOT NULL
    )";

    if ($conn->query($create_table_sql) === TRUE) {
        // Escape user inputs for security
        $name = $conn->real_escape_string($_POST['name']);
        $mobile = $conn->real_escape_string($_POST['mobile']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);
        // Hash password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert data into the table
        $insert_sql = "INSERT INTO users (name,mobile,email, password) VALUES ('$name','$mobile','$email', '$hashed_password')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>