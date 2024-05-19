<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Simple validation
    if (empty($username) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
    } else if ($password != $confirm_password) {
        echo "Passwords do not match.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Database connection parameters
        $servername = "localhost";
        $db_username = "root";
        $db_password = "sub";
        $dbname = "online_voting_system";

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert user into the 'users' table
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to the voting portal after successful registration
            header("Location: http://localhost/online_voting_system/");
            exit(); // Make sure to exit after sending the header
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
header("Location: vote.php");
exit();
ob_end_flush();
?>
