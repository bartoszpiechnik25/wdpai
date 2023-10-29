<!DOCTYPE html>
<html>
  <head>
    <title>Portfolio Manager</title>
    <style>
      body {
        font-family: 'Roboto', Arial;
        background-color: #f2f2f2;
        font-size: 1.5rem;
      }
      h1 {
        text-align: center;
        color: #333;
        font-size: 3rem;
        margin-top: 2rem;
      }
      p {
        font-size: 1.2rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
      }
      a {
        color: #4CAF50;
        text-decoration: none;
        font-weight: bold;
      }
      a:hover {
        text-decoration: underline;
      }
      form {
        background-color: #fff;
        border-radius: 5px;
        padding: 20px;
        width: 50%;
        margin: 0 auto;
      }
      label {
        display: block;
        margin-bottom: 5px;
        color: #333;
      }
      input[type="text"],
      input[type="password"],
      input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
      }
      input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
      }
      input[type="submit"]:hover {
        background-color: #45a049;
      }
      .error {
        color: red;
      }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Roboto&display=swap" rel="stylesheet">
  </head>
  <body>
    <h1>Portfolio Manager</h1>
    <p>Welcome to Portfolio Manager! This web application allows you to keep track of your various investment assets.</p>
    <p>To get started, please <a href="{{ url_for('auth.register') }}">register</a> or <a href="{{ url_for('auth.login') }}">login</a>.</p>
    {% if current_user.is_authenticated %}
    <a href="{{ url_for('auth.logout')}} "> logout  {{ current_user.username }}</a>
    {% else %}
    <footer>Hi {{ current_user.username }}!</footer>
    {% endif %}
  </body>
</html>

<?php

echo "Hello World!";