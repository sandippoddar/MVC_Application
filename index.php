<?php
$url = $_SERVER['REQUEST_URI'];
$urlArr = explode('/',$url);
$route = '';
if (strpos($urlArr[1],'?')) {
  $urlNew = explode('?',$urlArr[1]);
  $route = $urlNew[0];
}
else {
  $route = $urlArr[1];
}
// echo $route;

switch ($route) {
  case '':
    require './View/login.php';
    break;
  case 'login':
    require './View/login.php';
    break;
  case 'register':
    require './View/Registration.php';
    break;
  case 'admin':
    require './View/admin_dashboard.php';
    break;
  case 'user':
    require './View/user_dashboard.php';
    break;
  case 'addproduct':
    require './View/add_product.php';
    break;
}
