<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "social_db";

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $poster = $_POST['poster'];
    $sql = "INSERT INTO posts (title, content, poster) VALUES ('$title', '$content', '$poster')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Post</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Add a Post</h2>
        <form method="post">
            <div class="form-group">
                <label for="poster">Username:</label>
                <input type="text" class="form-control" name="poster" id="poster" required>
            </div>

            <div class="form-group">
                <label for="title">Note title:</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>

            <div class="form-group">
                <label for="content">Note content:</label>
                <textarea class="form-control" name="content" id="content" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>

        <a href="index.php" class="btn btn-secondary mt-3">Back to Home</a>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>