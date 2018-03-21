<?php

include_once("includes/config.php");
include_once("includes/create.php");
include_once("includes/functions.php");

$Return = array('result'=>array(), 'error'=>'');

function getUser($id) {
  $stmt = $conn->prepare('SELECT * FROM users WHERE user_id=:id LIMIT 1;');
  $stmt->bindParam('id', $id);
  $r = $stmt->execute();
  if (!$r) return NULL;
  return $stmt->fetch();
}

if(!empty($_POST) && $_POST['Action']==='login') {
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);

  /* Server side PHP input validation */
  if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      $Return['error'] = "Please enter a valid Email address.";
  }elseif($password===''){
      $Return['error'] = "Please enter Password.";
  }
  if($Return['error']!=''){
      output($Return);
  }

  /* Check Email and Password existence in DB */
  $stmt = $conn->prepare('SELECT * FROM users WHERE email=:email AND password=:password LIMIT 1;');
  $stmt->bindParam('email', $email);
  $stmt->bindParam('password', md5(md5($password)));
  $r = $stmt->execute();
  $result = $stmt->fetch();

  if(!$result) {
    $Return['dump'] = json_encode($result);
    /* Unsuccessful attempt: Set error message */
    $Return['error'] = 'Invalid login credentials.';
  } else {
    /* Success: Set session variables and redirect to Protected page */
    session_start();
    $Return['result'] = $_SESSION['UserData'] = $result;
  }

  /*Return*/
  output($Return);
} else if(!empty($_POST) && $_POST['Action']==='registration') {
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
  $ageGroup = htmlspecialchars($_POST['ageGroup']);
  $passwordSafe = $password === $confirmPassword;

  /* Server side PHP input validation */
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $Return['error'] = "Please enter a valid Email address.";
  } elseif($password === '' || $confirmPassword === '') {
    $Return['error'] = "Please enter Password.";
  } elseif(!$passwordSafe) {
    $Return['error'] = "Passwords do not match.";
  }

  if($Return['error']!=''){
      output($Return);
  }

  /* Check Email existence in DB */
  $stmt = $conn->prepare('SELECT * FROM users WHERE email=:email LIMIT 1;');
  $stmt->bindParam('email', $email);
  $r = $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_UNIQUE);

  if($result) {
      /*Email already exists: Set error message */
      $Return['error'] = 'You have already registered with us, please login.';
  } else {
            $q = <<<EOSQL
INSERT INTO users(email,password,age_group)
values(:email,:password,:age_group);
EOSQL;
      $stmt = $conn->prepare($q);
      $stmt->bindParam('email', $email);
      $stmt->bindParam('password', md5(md5($password)));
      $stmt->bindParam('age_group', $ageGroup);
      $r = $stmt->execute();
      if ($r) {
        session_start();
        $id = $conn->lastInsertId();
        $stmt = $conn->prepare(
          "SELECT * FROM users WHERE email=:email LIMIT 1;");
        $stmt->bindParam('email', $email);
        $r = $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_UNIQUE);
        $Return['result'] = $_SESSION['UserData'] = $result;
      }
  }
  /*Return*/
  output($Return);
}
