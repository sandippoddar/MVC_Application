<?php
session_start();
require './Model/login_signup.php';
// require_once './Controller/Linkedin.php';
// $linked = new Linkedin();

// if (isset($_SESSION['flag'])) {
//   header('location: /Dashboard');
// }
if (isset($_POST['login'])) {
  $emailUser = $_POST['emailUser'];
  $password = $_POST['password'];
  $obLogin = new LoginSignup();
  $isSignUp = $obLogin->LoginSelect($emailUser);
  $dbPassword = $isSignUp[0];
  $type = $isSignUp[1];

  if (password_verify($password, $dbPassword) && $isSignUp) {
    $_SESSION['flag'] = 1;
    $_SESSION['userEmail'] = $emailUser;
    $_SESSION['type'] = $type;
    if ($type == 'Admin') {
      header("location: /admin");
      exit();
    }
    else {
      header("location: /user");
      exit();
    }
  }
  else {
    session_destroy();
    $isSignUp = FALSE;
  }
}