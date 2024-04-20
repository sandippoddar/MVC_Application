<?php
require_once './Model/LoginSignup.php';
require_once './Controller/Validation.php';
session_start();

if (!isset($_SESSION['expiryTime'])) {
  $_SESSION['expiryTime'] = time() + 60 * 3;
}

if (isset($_POST["submit"])) {
  if (time() > $_SESSION['expiryTime']) {
    session_unset();
    session_destroy();
    header("location: /Message");
    exit();
  }

  $obSignup = new LoginSignup();
  $obValid = new Validation();
  $userName = $_POST['userName'];
  $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
  $email = $_POST['email'];
  $isExist = $obSignup->Duplicate($userName, $email);
  $errorArr = [];
  if (!$isExist) {
    $emailCheck = $obValid->isValidMail($email);
    $passCheck = $obValid->isPassword($_POST['password']);
    if (is_string($emailCheck)) {
      $errorArr[] = $emailCheck;
    }
    if (is_string($passCheck)) {
      $errorArr[] = $passCheck;
    }
  }
  if (is_string($isExist)) {
    $errorArr[] = $isExist;
  } 
  if (empty($_POST['otpInput'])) {
    $errorArr[] = 'You Need OTP to Register.';
  }
  elseif ($_POST['otpInput'] != $_SESSION['otp'] || $email != $_SESSION['email']) {
    $errorArr[] = 'Enter Correct OTP';
  }
  $dummyImgPath = './View/IMAGES/profile.webp';
  $imageData = file_get_contents($dummyImgPath); 
  $encodedImage = base64_encode($imageData);

  if (empty($errorArr)) {
    session_destroy();
    $obSignup->insert($userName, $email, $password,  $imageData);
    header("location: /Login");
  }
}
