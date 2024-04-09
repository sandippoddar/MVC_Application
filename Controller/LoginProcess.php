<?php
session_start();
require './Model/LoginSignup.php';
require_once './Controller/Linkedin.php';
$linked = new Linkedin();

if (isset($_SESSION['flag'])) {
  header('location: /Dashboard');
}
if (isset($_POST['login'])) {
  $emailUser = $_POST['emailUser'];
  $password = $_POST['password'];
  $obLogin = new LoginSignup();
  $isSignUp = $obLogin->LoginSelect($emailUser);

  if (password_verify($password, $isSignUp) && $isSignUp) {
    $_SESSION['flag'] = 1;
    $_SESSION['userEmail'] = $emailUser;
    header("location: /Dashboard");
    exit();
  }
  else {
    session_destroy();
    $isSignUp = FALSE;
  }
}

$linked->LinkedInApi();
