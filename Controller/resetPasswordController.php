<?php
require_once __DIR__.'/../Model/LoginSignup.php';
require __DIR__.'/../Controller/Validation.php';

$token = $_GET['token'];
echo $token;
$queryob = new LoginSignup();
$validOb = new Validation();
$tokenArray = $queryob->checkToken($token);

if ($tokenArray) {
  $userId = $tokenArray['UserId'];
  $tokenExpire = $tokenArray['tokenExpire'];
}
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
$passCheck = $validOb->isPassword($_POST['password']);
$isTokenExpire = $validOb->isTokenExpire($tokenArray['tokenExpire']);
$errorArr = [];

if (is_string($passCheck)) {
  $errorArr[] = $passCheck;
}
if (is_string($isTokenExpire)) {
  $errorArr[] = $isTokenExpire;
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && !is_string($isTokenExpire) && !is_string($passCheck)) {
  $update = $queryob->updateUser($userId, $password);
  // if ($update) {
  //   header("location: /Login");
  //   exit;
  // }
}
