<?php
require_once './Model/LoginSignup.php';
require './Controller/SessionCheck.php';

$queryOb = new LoginSignup();
$result = $queryOb->fetchUserProfile($_SESSION['userEmail']);
$oldName = $result['UserName'];
if (isset($_POST['submit'])) {
  $image = '';
  if (!$_FILES['image']['error']) {
    $image = file_get_contents($_FILES['image']['tmp_name']);
    $queryOb->editUser($_POST['user'], $image, $oldName);
    $_SESSION['userEmail'] = $_POST['user'];
  }
  else {
    $queryOb->editUser($_POST['user'], $image, $oldName);
    $_SESSION['userEmail'] = $_POST['user'];
    header("location: /EditProfile");
  }
}
