<?php
require_once './Model/LoginSignup.php';

session_start();
if (!isset($_SESSION["flag"])) {
  header("location: /Login");
}
$queryOb = new LoginSignup();
$result = $queryOb->fetchUserProfile($_SESSION['userEmail']);
