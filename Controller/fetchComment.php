<?php
require_once __DIR__. '/../Model/LoginSignup.php';
$obQuery = new LoginSignup();
$postid = $_POST['postId'];
$result = $obQuery->fetchComment($postid);
foreach($result as $row) {
  echo "<p>" . $row['COMMENT'] . "</p>";
}
