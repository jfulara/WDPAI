<?php

require_once 'Routing.php';
require_once 'src/controllers/AppController.php';


$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('dashboard', 'DashboardController');
Routing::get('operations', 'OperationController');
Routing::get('logout', 'SecurityController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('addExpense', 'OperationController');
Routing::post('addIncome', 'OperationController');
Routing::post('searchExpense', 'OperationController');
Routing::post('searchIncome', 'OperationController');

Routing::run($path);