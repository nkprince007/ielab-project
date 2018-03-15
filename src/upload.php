<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload your files</title>
</head>
<body>
  <?php include_once('includes/navbar.php'); ?>
  <?php include_once('includes/functions.php'); ?>

  <div class="jumbotron row">
    <form class="mx-auto" enctype="multipart/form-data" action="upload.php" method="POST">
      <div class="form-group">
        <label for="file" class="display-1">Choose a file</label>
        <input type="file" name="uploaded_file" class="form-control-file" id="file">
        <div class="my-4"></div>
        <input type="submit" value="Upload" class="btn btn-primary mb-2"></input>
      </div>
    </form>
  </div>

  <?php include_once('includes/assets.php'); ?>
</body>
</html>

<?php
if(!$_SESSION) {
  header("Location: /");
}

if(!empty($_FILES['uploaded_file'])) {
  $path = getUploadsDir();
  $path = $path . "/" . basename($_FILES['uploaded_file']['name']);

  if(!$_FILES['uploaded_file']['tmp_name']) {
    echo alert("danger", "No file chosen for submission");
    return;
  }

  if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
    echo alert("success", "The file ".  basename($_FILES['uploaded_file']['name']).
    " has been uploaded");
  } else {
      echo alert("danger", "There was an error uploading the file, please try again!");
  }
}

?>
