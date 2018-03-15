<?php

function alert($style, $msg) {
  return "<div class='alert alert-". $style ."' role='alert'>". $msg ."</div>";
}

function active($page) {
  $url = $_SERVER['REQUEST_URI'];
  if (!$url) return false;
  switch($page) {
    case 'Home':
      return '/' === $url || '/index.php' === $url;
    case 'Files':
      return '/files.php' === $url;
    case 'Upload':
      return '/upload.php' === $url;
  }
}

function getUploadsDir() {
  return "../uploads/" . $_SESSION['UserData']['age_group'];
}

/*Function to get directory structure */
function dirTree($dir) {
    $d = dir($dir);
    $results = array();
    while (false !== ($entry = $d->read())) {
      if($entry != '.' && $entry != '..' && is_file($dir.'/'.$entry))
        array_push($results, $entry);
    }
    $d->close();
    return $results;
}

/*Function to set JSON output*/
function output($Return=array()){
    /*Set response header*/
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    /*Final JSON response*/
    exit(json_encode($Return));
}
