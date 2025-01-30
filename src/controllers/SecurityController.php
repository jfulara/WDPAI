<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController{
    public function login(){
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User does not exist!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with that email does not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        return $this->render('dashboard');

        /*if($this->isGet()){
            return $this->render("login");
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $this->render("dashboard", [
            'name' => 'XYZ',
            'email' => $email,
            'password' => $password
        ]);*/
    }

    public function register() {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('register');
        }

        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        $errors = [];

        if ($this->isInputEmpty($name, $surname, $email, $password, $confirmPassword)) {
            $errors['empty_input'] = 'All fields must be filled!';
        }

        if ($this->isEmailInvalid($email)) {
            $errors['invalid_email'] = 'Invalid email!';
        }

        if ($this->isEmailTaken($email)) {
            $errors['email_used'] = 'Account with this email already exists!';
        }

        if ($this->arePasswordsDifferent($password, $confirmPassword)) {
            $errors['different_passwords'] = 'Passwords do not match!';
        }

        require_once 'session_config.php';

        if ($errors) {
            $_SESSION["signup_errors"] = $errors;

            $signupData = [
                'name' => $name,
                'surname' => $surname,
                'email' => $email
            ];

            $_SESSION["signup_data"] = $signupData;

            return $this->render('register');
        }

        $this->createUser($name, $surname, $email, $password);

        return $this->render('login', ['confirmations' => ['Registration successful!']]);
    }

    function isInputEmpty(string $name, string $surname, string $email, string $password, string $confirmPassword): bool {
        if (empty($name) || empty($surname) || empty($email) || empty($password) || empty($confirmPassword)) {
            return true;
        } else {
            return false;
        }
    }

    function isEmailInvalid(string $email): bool {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    function isEmailTaken(string $email): bool {
        $userRepository = new UserRepository();
        $user = $userRepository->getUser($email);
        if (!$user) {
            return false;
        } else {
            return true;
        }
    }

    function arePasswordsDifferent(string $password, string $confirmPassword): bool {
        return !($password === $confirmPassword);
    }

    function createUser($name, $surname, $email, $password): void {
        $userRepository = new UserRepository();
        $userRepository->createUser($name, $surname, $email, $password);
    }
}