<?php

class User {
    private string $username;
    private string $password;
    private string $email;
    private int $role_id;

    public function __construct(string $username, string $password, string $email, int $role_id){
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role_id = $role_id;
    }
    public function getUsername(): string {
        return $this->username;
    }
    public function getPassword(): string {
        return $this->password;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function getRole_id(): int {
        return $this->role_id;
    }
    public function setUsername(string $username): void {
        $this->username = $username;
    }
    public function setPassword(string $password): void {
        $this->password = $password;
    }
    public function setEmail(string $email): void {
        $this->email = $email;
    }
    public function setRole_id(int $role_id): void {
        $this->role_id = $role_id;
    }
}