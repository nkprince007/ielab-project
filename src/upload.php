<?php
session_start();
include_once('includes/functions.php');
include_once('includes/config.php');

$q = "SELECT * FROM users WHERE age_group=:age_group AND user_id!=:owner;";
$stmt = $conn->prepare($q);
$stmt->bindValue('age_group', $_SESSION['UserData']['age_group']);
$stmt->bindValue('owner', $_SESSION['UserData']['user_id']);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
      <div class="input-group mb-3 col-s-12">
        <div class="custom-file">
          <input type="file" name="uploaded_file" class="custom-file-input" id="inputGroupFile02">
          <label class="custom-file-label" for="inputGroupFile02">Choose a file...</label>
        </div>
      </div>
      <div class="form-row mb-3">
        <select name="shared_with[]" class="custom-select" multiple="multiple" required>
          <option value="-1" class="d-none" selected>private</option>
          <?php
            foreach($users as $user) {
              echo "<option value='" . $user['user_id'] . "'>";
              echo $user['email']. "</option>";
            }
          ?>
        </select>
      </div>
      <div class="form-row text-center">
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </div>
    </form>
  </div>

  <?php include_once('includes/assets.php'); ?>
  <script>
    $('#inputGroupFile02').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
  </script>
</body>
</html>

<?php
if(!$_SESSION) {
  header("Location: /");
}

if(!empty($_FILES['uploaded_file'])) {
  $path = getUploadsDir();
  $name = basename($_FILES['uploaded_file']['name']);
  $path = $path . "/" . $name;
  $shared_with = array_diff($_POST['shared_with'], array(-1));
  $shared_with = '{' . implode(",", $shared_with). '}';

  if(!$_FILES['uploaded_file']['tmp_name']) {
    echo alert("danger", "No file chosen for submission");
    return;
  }

  if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
    $q = <<<EOSQL
INSERT INTO files(path, owner, shared_with, age_group, name) VALUES(:path, :owner, :shared_with, :age_group, :name);
EOSQL;
    $stmt = $conn->prepare($q);
    $stmt->bindValue('path', $path);
    $stmt->bindValue('name', $name);
    $stmt->bindValue('owner', $_SESSION['UserData']['user_id']);
    $stmt->bindValue('age_group', $_SESSION['UserData']['age_group']);
    $stmt->bindValue('shared_with', $shared_with);
    $r = $stmt->execute();
    if (!$r) {
      echo alert('danger', "Insertion into files database failed.");
      return;
    }

    echo alert("success", "The file ". $name. " has been uploaded");
  } else {
      echo alert("danger", "There was an error uploading the file, please try again!");
  }
}

?>
