<?php
$host       = "localhost";
$username   = "root";
$password   = "root";
$dbname     = "notes_database"; 

// Database connection
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

