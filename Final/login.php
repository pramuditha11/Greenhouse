<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are set
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Simulated authentication process
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hardcoded username and password
        $correctUsername = "greenhouse";
        $correctPassword = "greenhouse";

        // Check if provided username and password match
        if ($username === $correctUsername && $password === $correctPassword) {
            // Authentication successful
            $_SESSION['username'] = $username;
            header("Location: home.html"); // Redirect to home page
            exit;
        } else {
            // Authentication failed
            echo "Invalid username or password";
        }
    } else {
        echo "Username or password not set";
    }
}
?>
