<?php
include_once('includes/functions.php')
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">FileZilla</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?= active('Home') ? 'active': '' ?>" <?= $_SESSION ? 'hidden' : '' ?>>
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item <?= active('Files') ? 'active': '' ?>">
        <a class="nav-link" href="/files.php">Files</a>
      </li>
      <li class="nav-item <?= active('Upload') ? 'active': '' ?>">
        <a class="nav-link" href="/upload.php">Upload</a>
      </li>
    </ul>
    <div class="nav-item dropdown" <?= !$_SESSION ? 'hidden': '' ?>>
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php
          if($_SESSION)
            echo $_SESSION['UserData']['email'];
        ?>
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="/logout.php">Logout</a>
      </div>
    </div>
  </div>
</nav>
