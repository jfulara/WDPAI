<?php

require_once 'AppController.php';

class DashboardController extends AppController{
    public function dashboard(){
        $this->render("dashboard", ['name' => "Jakub"]);
    }
}