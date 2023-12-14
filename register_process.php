<?php
session_start();

include 'config.php';

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get user input from the registration form
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Check if the username already exists
$check_username_query = "SELECT * FROM users WHERE username='$username'";
$check_username_result = $mysqli->query($check_username_query);

if ($check_username_result->num_rows > 0) {
    // Username already exists, display an error message
    echo "Username already exists. Please choose a different username.";
} else {
    // Insert user into the database
    $insert_user_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($mysqli->query($insert_user_query) === TRUE) {
        // Retrieve the user ID of the newly created user
        $user_id = $mysqli->insert_id;

        // Set session variables for the logged-in user
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;

        // Redirect to the index page
        header("Location: index.php");
    } else {
        echo "Error: " . $insert_user_query . "<br>" . $mysqli->error;
    }
}

$mysqli->close();
?>
