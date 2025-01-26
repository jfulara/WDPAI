<?php

require_once 'Routing.php';
require_once 'src/controllers/AppController.php';


$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('login', 'SecurityController');
Routing::get('dashboard', 'DashboardController');
Routing::run($path);