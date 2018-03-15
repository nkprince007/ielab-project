<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>FileZilla</title>
</head>
<body>
  <?php session_start(); ?>
  <?php include_once('includes/navbar.php') ?>
  <div class="jumbotron d-flex flex-column">
    <h1 class="display-4">Welcome to <b>FileZilla</b>!</h1>
    <p class="lead">A simple file sharing application for the intranet.</p>
    <hr class="my-4">
    <p>Dive right in to learn more.</p>
    <p class="lead" <?= $_SESSION ? 'hidden': '' ?>>
      <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#signInModal">Login</button>
      <button class="btn btn-secondary btn-lg" type="button" data-toggle="modal" data-target="#signUpModal">Register</button>
    </p>
    <p class="lead" <?= !$_SESSION ? 'hidden': '' ?>>
      <a href="/files.php" class="btn btn-primary btn-lg" type="button">Files</a>
    </p>
  </div>
  <?php include_once('includes/modal.php') ?>
  <?php include_once('includes/assets.php') ?>
</body>
</html>
