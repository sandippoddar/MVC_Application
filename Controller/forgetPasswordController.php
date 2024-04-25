<?php
require_once __DIR__.'/../Model/LoginSignup.php';
require_once __DIR__.'/../Controller/ResetEmail.php';
if (isset($_POST["submit"])) {
  $userEmail = $_POST['email'];
  $ob = new LoginSignup();
  $emailObj = new ResetEmail();
  $emailDb = $ob->isEmailInDb($userEmail);
  $token = bin2hex(random_bytes(16));
  $token_hash = hash("sha256", $token);
  $expiry = date("Y-m-d H:i:s", time() + 60 * 6);
  $isToken = $ob->updateToken($userEmail, $token_hash, $expiry);
  $message = [];

  if (!$emailDb) {
    $message[] = 'Entered Email is not in the Database.';
  }
  $emailCheck = FALSE;
  if ($emailDb && $isToken) {
    $emailCheck = $emailObj->sendResetEmail($userEmail, $token_hash);
  }
  if ($emailCheck) {
    $message[] = 'Mail has sent!! check your Inbox.';
  }
}
