<?php

require_once 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], "/");
$path = parse_url($path, PHP_URL_PATH);

$request_uri = $_SERVER['REQUEST_URI'];

Router::get('index', 'DefaultController');
Router::get('login', 'DefaultController');
Router::run($path);
?>