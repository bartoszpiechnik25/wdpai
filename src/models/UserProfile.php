<?php

require_once 'User.php';

class UserProfile extends User {
    private string $name;
    private string $surname;
    private string $phone_number;

    public function __construct(string $username, string $password, string $email, int $role_id, string $name, string $surname, string $phone_number){
        parent::__construct($username, $password, $email, $role_id);
        $this->name = $name;
        $this->surname = $surname;
        $this->phone_number = $phone_number;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getSurname(): string {
        return $this->surname;
    }
    public function getPhone_number(): string {
        return $this->phone_number;
    }
    public function setName(string $name): void {
        $this->name = $name;
    }
    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }
    public function setPhone_number(string $phone_number): void {
        $this->phone_number = $phone_number;
    }
}