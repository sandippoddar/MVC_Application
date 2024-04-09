<?php

require_once './Model/LoginSignup.php';
require_once './Controller/Validation.php';
session_start();

if (isset($_POST["submit"])) {
  print_r($_POST);
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
  if ($_POST['otpInput'] != $_SESSION['otp']) {
    $errorArr = 'Enter Correct OTP';
  }
  if (!strlen($userName) || !strlen($email) || !strlen($_POST['password'])) {
    $errorArr = [];
    $errorArr[] = 'Please Fill All the Fields!!!';
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
