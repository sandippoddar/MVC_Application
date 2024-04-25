<?php
require './Controller/forgetPasswordController.php';
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
  <div class="container">
    <form action="ForgetPassword" method="post">
      <h1>Email For Reset Password</h1>

      <label for="otp">Enter Email</label>
      <input type="text" placeholder="Email" id="email" name ="email">

      <input type="submit" name="submit" value="Submit">

      <p><a href="/Login">GO TO LOGIN</a></p>
    </form>
    <div class="error">
      <?php if (isset($_POST['submit']) && count($message)) : ?>
        <?php foreach( $message as $msg) : ?>
          <h1><?php echo $msg; ?></h1>
        <?php endforeach; ?>
      <?php endif; ?>
  </div>
  </div>
</body>
</html>
