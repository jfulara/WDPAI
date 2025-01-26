<?php

require_once 'src/controllers/DashboardController.php';
require_once 'src/controllers/SecurityController.php';

class Routing{
    public static $routes;

    public static function get($url, $controller){
        self::$routes[$url] = $controller;
    }
    public static function run ($url) {
        $action = explode("/", $url)[0];
        $controller = null;

        if (!array_key_exists($action, self::$routes)) {
            die("Wrong url!"); //TODO 404
        }

        
        if(in_array($action, ["dashboard", ""])){
            $controller = "DashboardController";
            $action = 'dashboard';
        }

        if(in_array($action, ["register", "login"])){
            $controller = "SecurityController";
            $action = 'login';
        }
    
        //$controller = self::$routes[$action];
        $object = new $controller;
        //$action = $action ?: 'index';
    
        $object->$action();
    }
}