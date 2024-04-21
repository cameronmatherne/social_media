<?php

/**
  * Function to query information based on
  * a parameter: in this case, note title.
  *
  */

if (isset($_POST['submit'])) {
  try {
    require "/config.php";
    require "/common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM notes
    WHERE title LIKE :title";

    $title = '%' . $_POST['title'] . '%';

    $statement = $connection->prepare($sql);
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Note Title</th>
          <th>Note Content</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($result as $row) { ?>
          <tr>
            <td><?php echo escape($row["id"]); ?></td>
            <td><?php echo escape($row["title"]); ?></td>
            <td><?php echo escape($row["content"]); ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <p>No results found for note with title containing "<?php echo escape($_POST['title']); ?>".</p>
  <?php }
} ?>

<h2>Find note based on title</h2>

<form method="post">
  <label for="title">Note Title</label>
  <input type="text" id="title" name="title">
  <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>


