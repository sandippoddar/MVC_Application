<?php
require_once '../Model/LoginSignup.php';
$obQuery = new LoginSignup();
$countLoad = $_POST['count'];
$result = $obQuery->loadProfile($countLoad);
foreach ($result as $row) : ?>
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
