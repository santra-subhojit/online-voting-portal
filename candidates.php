<?php
$servername = "localhost";
$username = "root";
$password = "sub";
$dbname = "online_voting_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM candidates";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<label><input type='radio' name='candidate' value='" . $row["id"] . "'>" . $row["name"] . "</label><br>";
    }
} else {
    echo "No candidates available";
}

$conn->close();
?>
