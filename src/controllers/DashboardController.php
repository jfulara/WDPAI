<?php

require_once 'AppController.php';

class DashboardController extends AppController{
    public function dashboard(){
        require_once 'session_config.php';

        if (!isset($_SESSION['user_id'])) {
            return $this->render('login');
        }

        return $this->render("dashboard");
    }
}