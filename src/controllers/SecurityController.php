<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController {
    public function login(): void {
        $user = new User('stary_pijany', '1234', 'Jan', 'Kowalski');
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        //create array for message about username and password
        $messages = [];

        if ($user->getUsername() !== $username) {
            $messages[] = 'User not found!';
            return;
        }
        if ($user->getPassword() !== $password) {   
            $messages[] = 'Invalid password!';
            return;
        }
        
        //check if array is empty
        var_dump($messages);
        //print messages
        print_r($messages);

        if (empty($messages)) {
            //redirect to index.php
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/index");
            exit();
        } else {
            //render login.php with messages
            $this->render('login', ['messages' => $messages]);
        }
        die();
    }
}