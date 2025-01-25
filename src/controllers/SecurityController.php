<?php

require_once 'AppController.php';

class SecurityController extends AppController{
    public function login(){

        if($this->isGet()){
            return $this->render("login");
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $this->render("dashboard", [
            'name' => 'XYZ',
            'email' => $email,
            'password' => $password
        ]);
    }
}