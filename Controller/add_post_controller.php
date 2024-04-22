<?php
require_once './Model/login_signup.php';
// require './Controller/SessionCheck.php';
if(isset($_POST['Submit'])) {
  $ob = new LoginSignup();
  $comment = $_POST['caption'];
  $image = file_get_contents($_FILES['image']['tmp_name']);
  $ob->addPost($_POST['product'], $comment, $image);
  header("location: /admin");
}
