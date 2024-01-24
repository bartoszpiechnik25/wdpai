<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserProfile.php';
require_once __DIR__.'/../exceptions/NotFoundException.php';

class UserRepository extends Repository {

    public function __construct()
    {
        parent::__construct();
        //generate password for admin with password_hash
        $password = password_hash(ADMINPASSWORD, PASSWORD_BCRYPT);
        $stmt = $this->database->connect()->prepare("update users set password_hash=:passwd where username='admin'");
        $stmt->bindParam(':passwd', $password, PDO::PARAM_STR);
        $stmt->execute();
    }

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

        return new User($user['username'], $user['password_hash'], $user['email'], $user['role_id']);
    }

    public function getUserId(string $username): int {
        $stmt = $this->database->connect()->prepare(
            'select user_id from users where username = :username'
        );
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user_id = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_id == false) {
            throw new NotFoundException("User not found");
        }

        return (int)$user_id['user_id'];
    }

    public function addUser(UserProfile $user): void {
        try {
            $connection = $this->database->connect();
            $connection->beginTransaction();
            $stmt = $connection->prepare(
                'INSERT INTO users (username, password_hash, email, role_id) 
                VALUES (?, ?, ?, ?)'
            );
            $stmt->execute([
                $user->getUsername(),
                $user->getPassword(),
                $user->getEmail(),
                $user->getRole_id(),
            ]);
        
            $user_id = (int)$connection->lastInsertId();
            
            $stmt = $connection->prepare(
                'INSERT INTO userprofile (user_id, name, surname, phone_number)
                VALUES (?, ?, ?, ?)'
            );
            $stmt->execute([
                $user_id,
                $user->getName(),
                $user->getSurname(),
                $user->getPhone_number(),
            ]);
            $connection->commit();
        } catch (PDOException $e) {
            $connection->rollBack();
            die($e->getMessage());
        }

    }

    public function usernameExists(string $username): bool {
        $stmt = $this->database->connect()->prepare(
            'select count(*) from users where username = :username'
        );
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['count'] > 0;
    }

    public function emailExists(string $email): bool {
        $stmt = $this->database->connect()->prepare(
            'select count(*) from users where email = :email'
        );
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['count'] > 0;
    }
}