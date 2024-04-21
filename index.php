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

$sql = "SELECT id, title, content FROM notes";
$result = $conn->query($sql);

$notes = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $notes[] = $row;
  }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Database Notes Application</title>

  <link rel="stylesheet" href="css/style.css" />
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <h1 class="text-center mt-3"> Community Blog</h1>
  <a href="create.php" class="btn btn-primary ml-5">New Post</a>
  
</form> 
  <ul>
    <?php foreach ($notes as $note): ?>
      <div class="d-flex justify-content-center mt-5">
        <div class="card" style="width: 180rem;">
          <div class="card-body">
            <h3 class="card-title"><?php echo $note['title']; ?></h3>
            <p class="card-text"><?php echo $note['content']; ?></p>
            <form action="delete.php" method="post">
              <input type="hidden" name="id" value="<?php echo $note['id']; ?>">
              <button type="submit" class="btn btn-sm btn-danger">Delete post</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </ul>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>