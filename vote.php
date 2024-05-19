<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging: Output the content of the $_POST array
    var_dump($_POST);

    if (isset($_POST["candidate"])) {
        $candidateId = $_POST["candidate"];

        // Debugging: Output the value of $candidateId
        var_dump($candidateId);

        $servername = "localhost";
        $username = "root";
        $password = "sub";
        $dbname = "online_voting_system";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("UPDATE candidates SET votes = votes + 1 WHERE id = ?");
        $stmt->bind_param("i", $candidateId);

        if ($stmt->execute()) {
            echo "Vote recorded successfully";
        } else {
            echo "Error recording vote: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "No candidate selected";
    }
} else {
    echo "Invalid request";
}
?>
