<?php
session_start();

// Connect to MySQL (Replace with your database credentials)
include 'config.php';

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get user input from the login form
$username = $_POST['username'];
$password = $_POST['password'];

// Retrieve user from the database
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $row['id'];
        header("Location: index.php");
    } else {
        echo '<script>alert("Invalid password!"); window.location.href = "login.php";</script>';
    }
}
$mysqli->close();
?>
