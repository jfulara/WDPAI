<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController{
    public function login(){
        $user = new User('johnw@pk.edu.pl', 'admin', 'John', 'Wojtas');

        if ($this->isPost()) {
            return $this->login('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

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
}