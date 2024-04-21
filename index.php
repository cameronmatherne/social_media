<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "social_db";

// Database connection
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT post_id, title, content, created_at, like_count FROM posts";
$result = $conn->query($sql);

$posts = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $row['time_ago'] = time_elapsed_string($row['created_at']);
    $posts[] = $row;
  }
}

$conn->close();

function time_elapsed_string($datetime, $full = false)
{
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = [
    'y' => 'year',
    'm' => 'month',
    'w' => 'week',
    'd' => 'day',
    'h' => 'hour',
    'i' => 'minute',
    's' => 'second',
  ];

  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    } else {
      unset($string[$k]);
    }
  }

  if (!$full)
    $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Sample Social Media App</title>

  <link rel="stylesheet" href="css/style.css" />
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php include 'navbar.php'; ?>
  <div class="mt-5"></div>
  <div class="container d-flex align-items-center flex-column">
    <?php foreach ($posts as $post): ?>
      <div class=" d-flex justify-content-between card" style="height: 300px; width: 500px;">
        <div class="card-body">
          <div class="d-flex g-2">
            <h3 class="card-title"><?php echo $post['title']; ?></h3>
            <small class="text-muted d-flex align-items-center"><?php echo $post['time_ago']; ?></small>
          </div>
          <p class="card-text"><?php echo $post['content']; ?></p>
        </div>

        <div class="footer d-flex m-1 justify-content-between">
          <div class="d-flex g-2">
            <form action="delete.php" method="post" class="">
              <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
              <button type="submit" class="btn btn-sm btn-danger">Delete post</button>
            </form>
            <a class="btn btn-sm btn-primary ml-2"> Like Post </a>
          </div>
          <small class="text-muted ml-3"> Likes: <?php echo $post['like_count']; ?></small>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>