<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';


class SecurityController extends AppController {

    public function login() {

        if (!$this->isPost()) {
            return $this->render('login');
        }
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userRepository = new UserRepository();

        //create array for error messages
        $messages = [];

        try {
            $user = $userRepository->getUser($username);

            if ($user->getPassword() !== $password) {   
                $messages[] = 'Invalid password!';
            }

        } catch (Exception $exception) {
            $messages[] = $exception->getMessage();
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

    public function register() {
        if ($this->isGet()) {
            return $this->render('register');
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone_number = $_POST['phone_number'];

    }
}