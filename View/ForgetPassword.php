<?php
// require_once '../Controller/OtpProcess.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email ResetPassword</title>
  <link rel="stylesheet" href="./View/CSS/login.css">
</head>
<body>
  <div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
  </div>
  <form action="ForgetPassword" method="post">
    <h3>Email For Reset Password</h3>

    <label for="otp">Enter Email</label>
    <input type="text" placeholder="Email" id="email" name ="email">

    <input type="submit" name="submit" value="Submit">

    <p><a href="/Login">GO TO LOGIN</a></p>
  </form>
</body>
</html>
