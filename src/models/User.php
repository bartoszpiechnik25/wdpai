<?php

class User {
    private string $username;
    private string $password;
    private string $name;
    private string $surname;

    public function __construct(string $username, string $password, string $name, string $surname){
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
    }
    public function getUsername(): string {
        return $this->username;
    }
    public function getPassword(): string {
        return $this->password;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getSurname(): string {
        return $this->surname;
    }
    public function setEmail(string $username): void {
        $this->username = $username;
    }
    public function setPassword(string $password): void {
        $this->password = $password;
    }
    public function setName(string $name): void {
        $this->name = $name;
    }
    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }
}