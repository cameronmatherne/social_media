<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "notes_database";

// Database connection
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // SQL to delete a record
    $sql = "DELETE FROM notes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();

?>
