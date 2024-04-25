<?php
require_once 'OtpEmail.php';
session_start();
$otpmail = new OtpEmail();
echo '<input type="text" placeholder="Enter OTP" id="otpInput" name="otpInput">';
$otp = rand(10000,99999);
$_SESSION['email'] = $_POST['email'];
$_SESSION['otp'] = $otp;
$otpm = $otpmail->sendOtp($_POST['email'], $otp);
