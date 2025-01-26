<?php

require_once 'AppController.php';

class DashboardController extends AppController{
    public function index(){
        $this->render('login');
    }
    public function dashboard(){
        $this->render("dashboard", ['name' => "Jakub"]);
    }
}