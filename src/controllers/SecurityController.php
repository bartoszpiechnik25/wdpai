<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserProfile.php';
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

            if (!password_verify($password, $user->getPassword())) {   
                $messages[] = 'Invalid password!';
            }

        } catch (Exception $exception) {
            $messages[] = $exception->getMessage();
        }

        if (empty($messages)) {
            //redirect to recipes.php
            $user_id = $userRepository->getUserId($username);
            $_SESSION["logged_user"] = $user_id;
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/recipes");
        } else {
            //render login.php with messages
            $this->render('login', ['messages' => $messages]);
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }

    public function register() {
        if ($this->isGet()) {
            return $this->render('register');
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $role_id = 1;
        $password = $_POST['password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone_number = $_POST['phone_number'];

        $repository = new UserRepository();
        $messages = [];

        if ($repository->usernameExists($username)) {
            $messages[] = 'This username: '.$username.' is already taken!';
        }
        if ($repository->emailExists($email)) {
            $messages[] = 'Account with this email: '.$email.' already exists!';
        }
        $password = password_hash($password, PASSWORD_BCRYPT);
        $newUser = new UserProfile($username, $password, $email, $role_id, $name, $surname, $phone_number);
        $repository->addUser($newUser);
        // var_dump($newUser);
        // die();

        if (empty($messages)) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        } else {
            $this->render('register', ['messages' => $messages]);
        }
    }
}