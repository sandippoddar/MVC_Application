<?php

require_once __dir__.'/../Model/login_signup.php';
session_start();

$pid = $_POST['product_id'];
$userEmail = $_SESSION['userEmail'];

$queryOb = new LoginSignup();
if (!$queryOb->isCart($userEmail,$pid)) {
  $queryOb->insertCart($userEmail,$pid);
}
