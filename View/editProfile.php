<?php
require './Controller/editProfileControl.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="./View/CSS/Dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>
<body>
    <div class="container">
        <main>
        <article>
        <!-- header part start here -->
        <header class="header">
            <!-- this is the wrapper class -->
            <div class="flex-all wrapper-content">
              <div class="img-container">
                <img src="./View/IMAGES/head_logo.jpg" alt="">
              </div>

              <div class="input-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here..." class="searchprofile"/>
                <button class="button">Search</button>
              </div>
              
              <!-- nav part start here -->
              <nav>
                <ul class="header-ul">
                  <li><a href="/Dashboard">Home</a></li>
                  <li><a href="/Addpost">Add Post</a></li>
                  <li><a href="/EditProfile">Edit Profile</a></li>
                  <li><a href="/Profile">Profile</a></li>
                  <li><a href="./Controller/Logout.php">Logout</a></li>
                </ul>
              </nav>
                
                <!-- nav part end here -->
            </div>
        </header>
        <!-- header part end here -->

        <section>
          <div class="image">
            <?php echo '<img src="data:image;base64,' . base64_encode($result['Profileimg']) .'" class="img">'; ?>
          </div>
          
          <form action="/EditProfile" method = "post" enctype="multipart/form-data">
            <div class="form-ele">
              <label for="user">Your Username:</label>
              <input type="text" name="user" id="" value="<?= $result['UserName'];?>">
            </div>
            <div class="form-ele">
              <label for="email">Your Email:</label>
              <input type="text" name="email" id="" value="<?= $result['Email'];?>" readonly>
            </div>
            <div class="form-ele">
              <label for="image">Change image:</label>
              <input type="file" name="image" id="image" value="hii">
            </div>
            <input type="submit" value="Reset" name="submit" style="width:fit-content;padding: 10px 20px;">
          </form>
        </section>
</article>
</main>
</div>

<script>
  $(document).ready(function() {
  $(".button").click(function() {
    $.ajax({
      type: "POST",
      url: "./Controller/otpProcess.php",
      data: {email: $('#email').val()},
      success: function(response) {
        
      },
    });
  });
});
</script>
</body>
</html>