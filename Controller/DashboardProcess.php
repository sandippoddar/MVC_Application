<?php
require_once './Model/LoginSignup.php';
require './Controller/SessionCheck.php';
$obfetch = new LoginSignup();
$result = $obfetch->fetchUser();
