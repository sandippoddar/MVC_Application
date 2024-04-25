<?php
require './Controller/resetPasswordController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="stylesheet" href="./View/CSS/login.css">
</head>
<body>
  <div class="container">
    <h1>Set New Password</h1>
    <form action=<?php echo "/resetpassword?token="."$token"; ?> method="post">
      <div class="form-ele">
        <label for="password">Enter New Password: </label>
        <input type="text" name="password" id="password">
      </div>
      <input type="submit" value="Reset" name="submit">
    </form>
    <button>
      <a href="/Login">Go to login</a>
    </button>
    <h1>
      <?php
        if (isset($_POST["submit"]) && $update) {
          echo "updated Sucessfuly!!";
        }
      ?>
    </h1>
    <div class="error">
      <?php if (isset($_POST['submit']) && count($errorArr)) : ?>
        <?php foreach( $errorArr as $error) : ?>
          <h1><?php echo $error; ?></h1>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>