<?php
require_once './Model/LoginSignup.php';
require './Controller/SessionCheck.php';
if(isset($_POST['Submit'])) {
  $ob = new LoginSignup();
  $comment = $_POST['caption'];
  $image = file_get_contents($_FILES['image']['tmp_name']);
  $ob->addPost($_SESSION['userEmail'], $comment, $image);
  header("location: /Dashboard");
}
