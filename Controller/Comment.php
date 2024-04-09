<?php
require_once __DIR__. '/../Model/LoginSignup.php';
require './Controller/SessionCheck.php';

$user = $_SESSION['userEmail'];
$post_id = $_POST['post_id'];
$input = $_POST['input'];
$obQuery = new LoginSignup();
if (!empty($input)) {
  $obQuery->insertCommentTable($user, $post_id, $input);
  $obQuery->incrementComment($post_id);
  $result = $obQuery->fetchComment($post_id);
  foreach($result as $row) {
    echo "<p>" . $row['COMMENT'] . "</p>";
  }
}
else {
  $result = $obQuery->getComment($post_id);
  echo json_encode($result['COMMENT']);
}
