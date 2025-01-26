<?php

require_once 'Routing.php';
require_once 'src/controllers/AppController.php';


$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DashboardController');
Routing::get('dashboard', 'DashboardController');
Routing::post('login', 'SecurityController');
Routing::run($path);