<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
class UserRepository extends Repository
{
    public function getUser(string $email): ?User {
        $stmt = $this->database->connect()->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User($user['name'], $user['surname'], $user['email'], $user['password'], $user['id']);
    }

    public function createUser(string $name, string $surname, string $email, string $password): void {
        $stmt = $this->database->connect()->prepare("
            INSERT INTO users(name, surname, email, password)
            VALUES (:name, :surname, :email, :password)");

        $options = [
            'cost' => 12
        ];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->execute();
    }
}