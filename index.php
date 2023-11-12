<?php
$request_uri = $_SERVER['REQUEST_URI'];

if ($request_uri === '/login') {
  header('Location: /login.html');
  exit;
} 
include 'index.html'
?>