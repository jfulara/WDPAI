<?php

require_once 'Routing.php';
require_once 'src/controllers/AppController.php';


$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('dashboard', 'DashboardController');
Routing::get('expenses', 'ExpenseController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('addExpense', 'ExpenseController');
Routing::post('searchExpense', 'ExpenseController');

Routing::run($path);