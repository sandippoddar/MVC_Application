<?php
require './Controller/DashboardProcess.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADVANCE TASK 2</title>
  <link rel="stylesheet" href="./View/CSS/Dashboard.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                    <img src="./View/IMAGES/head_logo.jpg">
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
        <section class="res">
          <?php foreach ($result as $row) : ?>
          <div class="profile">
            <p>User Name: <?php echo $row['User'] ?></p>
            <div class="image">
              <?php echo '<img src="data:image;base64,' . base64_encode($row['Image']) .'" class="im">'; ?>
            </div>
            <p>Caption: <?php echo $row['Caption'] ?></p>
            <div class="social">
              <div class="social-ele like" data-post-id="<?php echo $row['POST_ID']; ?>">
                <i class="uil uil-thumbs-up"></i>
                <p><?php echo $row['LIKE']; ?></p>
              </div>
              <div class="social-ele comment" data-post-id="<?php echo $row['POST_ID']; ?>">
                <i class="uil uil-comment"></i>
                <p><?php echo $row['COMMENT']; ?></p>
              </div>
            </div>
            <div class="comments">
              <h1>Comments</h1>
              <div class="comm1"></div>
              <h1>Post your Comments here</h1>
              <div class="input">
                <textarea name="comm" id="comm" cols="30" rows="5"></textarea>
                <button class="post">POST</button>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </section>
        <section>
          <button class="button load">Load More Contents</button>
        </section>
</article>
</main>
</div>

<script>
  $(document).ready(function() {
    let countLoad = 0;
    $(".comments").hide();

    $(document).on("click", ".comment", function(){
      $(".comments").hide();
      var postId = $(this).data('post-id');
      var parentDiv = $(this).parent().parent('.profile');
      parentDiv.find(".comments").show();
      $.ajax({
        type: 'POST',
        url: './Controller/fetchComment.php',
        data: { postId: postId },
        success: function(data) {
          parentDiv.find(".comments .comm1").html(data);
        }
      })
    });

    $(document).on("click", ".load", function() {
      countLoad = countLoad + 2;
      $.ajax({
        type: 'POST',
        url: './Controller/loadComments.php',
        data: { count: countLoad },
        success: function(data) {
          $('.res').append(data);
          $(".comments").hide();
        }
      })

    });

    $(document).on("click", ".like", function(){
      var postId = $(this).data('post-id');
      var likeCountElement = $(this).find('p');
        $.ajax({
          type: 'POST',
          url: './Controller/likeFeature.php', 
          data: { post_id: postId },
          success: function(response) {
            likeCountElement.text(response);
          }
        });
    });

    $(document).on("click", ".post", function() {
        var parentDiv = $(this).closest('.profile');
        var postId = parentDiv.find('.comment').data('post-id');
        var input = parentDiv.find("textarea").val(); // Get the value of textarea

        $.ajax({
          url: './Controller/Comment.php',
          type: 'POST', 
          data: { post_id: postId, input: input },
          success: function(response) {
            console.log(response);
            parentDiv.find('.comments .comm1').html(response);
            input = '';
          }
        });
    });
  });
</script>
</body>
</html>