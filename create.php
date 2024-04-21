<?php

$host       = "localhost";
$username   = "root";
$password   = "";
$dbname     = "notes_database"; 

// Database connection
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO notes (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        header("Location: index.php");
        echo "Note successfully added.";

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>

<h2>Add a note</h2>

<form method="post">
    <label for="title">Note title:</label>
    <input type="text" name="title" id="title">

    <label for="content">Note content:</label>
    <textarea name="content" id="content" rows="4" cols="50"></textarea>

    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>
