<?php
require './Model/login_signup.php';

session_start();
$queryOb = new LoginSignup();

$userEmail = $_SESSION['userEmail'];
$result = $queryOb->fetchCart($userEmail);
$price = $queryOb->totalPrice($userEmail);
