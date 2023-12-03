<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController {

    public function login() {
        $user = new User('stary_pijany', '1234', 'Jan', 'Kowalski');

        if (!$this->isPost()) {
            return $this->render('login');
        }
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        //create array for message about username and password
        $messages = [];

        if ($user->getUsername() !== $username) {
            $messages[] = 'User not found!';
        }
        if ($user->getPassword() !== $password) {   
            $messages[] = 'Invalid password!';
        }

        if (empty($messages)) {
            //redirect to recipes.php
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/recipes");
        } else {
            //render login.php with messages
            $this->render('login', ['messages' => $messages]);
        }
    }
}