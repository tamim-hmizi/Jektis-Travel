<?php
session_start();
require_once '../Config/Connexion.php';
require_once '../Model/User.php';

class UserController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connexion::getPDO();
    }

    public function register($name, $lastName, $email, $phoneNumber, $age, $password)
    {

        if ($this->isEmailRegistered($email)) {
            throw new Exception('Email already used');
        }


        $user = new User($name, $lastName, $email, $phoneNumber, $age, $password, "ROLE_USER");

        $stmt = $this->pdo->prepare('INSERT INTO user (name, lastName, email, phoneNumber, age, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $user->getName(),
            $user->getLastName(),
            $user->getEmail(),
            $user->getPhoneNumber(),
            $user->getAge(),
            $user->getPassword(),
            $user->getRole()
        ]);



        return $this->pdo->lastInsertId();
    }

    public function login($email, $password)
    {

        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && $password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['lastName'] = $user['lastName'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phoneNumber'] = $user['phoneNumber'];
            $_SESSION['age'] = $user['age'];
            $_SESSION['role'] = $user['role'];
            return true;
        } else {
            throw new Exception('Invalid email or password.');
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }

    private function isEmailRegistered($email)
    {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM user WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }
    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

}
