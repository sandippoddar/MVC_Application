<?php
require_once __DIR__. '/../Model/LoginSignup.php';
require './Controller/SessionCheck.php';

$user = $_SESSION['userEmail'];
$post_id = $_POST['post_id'];
$obQuery = new LoginSignup();
if (!$obQuery->isliked($user, $post_id)) {
  $obQuery->insertLikeTable($user, $post_id);
  $obQuery->incrementLike($post_id);
  $result = $obQuery->getLike($post_id);
  echo $result['LIKE'];
}
else {
  $result = $obQuery->getLike($post_id);
  echo $result['LIKE'];
}
