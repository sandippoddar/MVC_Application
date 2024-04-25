<?php
require_once './Model/login_signup.php';
// require './Controller/SessionCheck.php';
if(isset($_POST['Submit'])) {
  $ob = new LoginSignup();
  $comment = $_POST['caption'];
  $price = $_POST['price'];
  $image = file_get_contents($_FILES['image']['tmp_name']);
  $ob->addProduct($_POST['product'], $comment, $image, $price);
  header("location: /admin");
}
