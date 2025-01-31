<?php

require_once 'AppController.php';

class DefaultController extends AppController{
    public function index(){
        require_once 'session_config.php';

        if (isset($_SESSION['user_id'])) {
            return $this->render('dashboard');
        }

        return $this->render('login');
    }
}