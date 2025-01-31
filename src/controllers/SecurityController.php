<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController{
    public function login(){
        require_once 'session_config.php';

        if (isset($_SESSION['user_id'])) {
            return $this->render('dashboard');
        }

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $errors = [];

        if ($this->isEmailInputEmpty($email)) {
            $errors['empty_email'] = 'All fields must be filled!';
        } else if ($this->isUserNotExistent($email)) {
            $errors['user_not_existent'] = 'User with this email does not exist!';
        } else if ($this->isPasswordInputEmpty($password)) {
            $errors['empty_password'] = 'All fields must be filled!';
        } else if ($this->isPasswordWrong($email, $password)) {
            $errors['wrong_password'] = 'Wrong password!';
        }

        if ($errors) {
            $_SESSION["login_errors"] = $errors;

            $loginData = [
                'email' => $email
            ];

            $_SESSION["login_data"] = $loginData;

            return $this->render('login');
        }

        $_SESSION["user_id"] = $this->getUserId($email);
        $_SESSION["user_name"] = htmlspecialchars($this->getUserName($email));

        $_SESSION['last_regeneration'] = time();

        return $this->render('dashboard');
    }

    public function register() {
        require_once 'session_config.php';

        if (isset($_SESSION['user_id'])) {
            return $this->render('dashboard');
        }

        if (!$this->isPost()) {
            return $this->render('register');
        }

        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        $errors = [];

        if ($this->isRegisterInputEmpty($name, $surname, $email, $password, $confirmPassword)) {
            $errors['empty_input'] = 'All fields must be filled!';
        }

        if (!$this->isEmailInputEmpty($email) && $this->isEmailInvalid($email)) {
            $errors['invalid_email'] = 'Invalid email!';
        }

        if ($this->isEmailTaken($email)) {
            $errors['email_used'] = 'Account with this email already exists!';
        }

        if ($this->arePasswordsDifferent($password, $confirmPassword)) {
            $errors['different_passwords'] = 'Passwords do not match!';
        }

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

    public function logout() {
        session_start();
        session_unset();
        session_destroy();

        return $this->render('login');
    }

    function isEmailInputEmpty(string $email): bool {
        if (empty($email)) {
            return true;
        } else {
            return false;
        }
    }

    function isUserNotExistent(string $email): bool {
        $userRepository = new UserRepository();
        $user = $userRepository->getUser($email);

        if (!$user) {
            return true;
        } else {
            return false;
        }
    }

    function isPasswordInputEmpty(string $password): bool {
        if (empty($password)) {
            return true;
        } else {
            return false;
        }
    }

    function isPasswordWrong(string $email, string $password): bool {
        $userRepository = new UserRepository();
        $user = $userRepository->getUser($email);

        if(!password_verify($password, $user->getPassword())) {
            return true;
        } else {
            return false;
        }
    }

    function getUserId($email): int {
        $userRepository = new UserRepository();
        $user = $userRepository->getUser($email);
        return $user->getId();
    }

    function getUserName($email): string {
        $userRepository = new UserRepository();
        $user = $userRepository->getUser($email);
        return $user->getName();
    }

    function isRegisterInputEmpty(string $name, string $surname, string $email, string $password, string $confirmPassword): bool {
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