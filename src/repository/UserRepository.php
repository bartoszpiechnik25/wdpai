<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../exceptions/NotFoundException.php';

class UserRepository extends Repository {

    public function getUser(string $username): User {
        $stmt = $this->database->connect()->prepare(
            'select * from users where username = :username'
        );
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            throw new NotFoundException("User not found");
        }

        return new User($user['username'], $user['password_hash']);
    }
}