<?php

require_once 'Routing.php';

session_start();


$path = trim($_SERVER['REQUEST_URI'], "/");
$path = parse_url($path, PHP_URL_PATH);

$request_uri = $_SERVER['REQUEST_URI'];

Router::get('', 'DefaultController');
Router::get('recipes', 'RecipeController');
Router::get('recipe', 'DefaultController');
Router::get('liked', 'DefaultController');
Router::post('login', 'SecurityController');
Router::get('add', 'DefaultController');
Router::post('addRecipe', 'RecipeController');
Router::get('register', 'SecurityController');
Router::get('logout', 'SecurityController');
Router::post('search', 'RecipeController');

Router::run($path);
