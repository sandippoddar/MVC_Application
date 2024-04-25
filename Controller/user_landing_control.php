<?php
require_once './Model/login_signup.php';
// require './Controller/SessionCheck.php';
$obfetch = new LoginSignup();
$result = $obfetch->fetchProduct();
