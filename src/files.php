<?php
  session_start();
  if (!$_SESSION) {
    header('Location: /');
  }
  include_once('includes/functions.php');
  include_once('includes/create.php');

  $files = dirTree('./' . getUploadsDir());
  $no_files = sizeof($files) === 0;

  $q = <<<EOSQL
SELECT name FROM files WHERE age_group=:age_group AND (:user=ANY(shared_with) OR
:user=owner);
EOSQL;
  $stmt = $conn->prepare($q);
  $stmt->bindValue('user', $_SESSION['UserData']['user_id']);
  $stmt->bindValue('age_group', $_SESSION['UserData']['age_group']);
  $stmt->execute();
  $_shared_files = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $shared_files = array();
  foreach ($_shared_files as $file) {
    array_push($shared_files, $file['name']);
  }

  foreach ($files as $idx => $file) {
    if (!in_array($file, $shared_files))
      unset($files[$idx]);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>FileZilla</title>
</head>
<body>
  <?php include_once('includes/navbar.php') ?>

  <div class="jumbotron" <?= !$no_files ? 'style="display:none;"' : '' ?>>
    <h1 class="display-4">No files available!</h1>
    <p class="lead">Upload a file to proceed.</p>
    <hr class="my-4">
    <p class="lead">
      <a href="/upload.php" class="btn btn-success btn-lg" type="button">Upload</a>
    </p>
  </div>

  <div class="container mt-4" <?= $no_files ? 'style="display:none"': '' ?>>
    <table id="files" class="table">
      <thead>
        <tr>
          <th scope="col">File Name</th>
          <th scope="col">Download Link</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($files as $file) {
            echo "<tr>";
            echo "<td>". $file ."</td>";
            echo "<td><a href='/download.php?file=".urlencode($file)."'>". $file ."</a></td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>

  <?php include_once('includes/assets.php') ?>
</body>
</html>
