<?php
require_once __DIR__ . '/../vendor/autoload.php';
$client_id = "86zg2iikg29zdi";
$client_secret = "KqpCbeh6Ce1PDXrP";
$redirect_uri = "http://mvctask/Login";
$scope = rawurlencode('openid profile email');
$url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&state=foobar&scope=$scope";
