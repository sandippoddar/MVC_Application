<?php
require './Controller/RegistrationController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./View/CSS/login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
  <div class="container">
    <h1>Registration Page</h1>
    <form action="/Registration" method="post">
      <div class="form-ele">
        <label for="userName">Enter User-Name:</label>
        <input type="text" name="userName" id="userName" placeholder="User Name" value = "<?php echo isset($_POST['signup']) ? htmlspecialchars($_POST['userName'], ENT_QUOTES) : ''; ?>">
      </div>
      <div class="form-ele">
        <label for="email">Enter Email:</label>
        <input type="email" name="email" id="email"  placeholder="Email" value = "<?php echo isset($_POST['signup']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>">
      </div>
      <div class="form-ele">
        <label for="password">Enter Password:</label>
        <input type="password" name="password" id="password"  placeholder="Password" value = "<?php echo isset($_POST['signup']) ? htmlspecialchars($_POST['password'], ENT_QUOTES) : ''; ?>">
      </div>
      <div class="form-ele" id="getotpfield"></div>
      <input type="button" value="GET OTP" id ="getotp">
      <input type="submit" value="signup" name="submit">
    </form>
    <button>
      <a href="/Login">Go to login</a>
    </button>
    <div class="error">
      <?php if (isset($_POST['submit']) && count($errorArr)) : ?>
        <?php foreach( $errorArr as $error) : ?>
          <h1><?php echo $error; ?></h1>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <script src="./View/JS/OTP.js"></script>
</body>
</html>
