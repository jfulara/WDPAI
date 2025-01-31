<?php

require_once 'src/controllers/DashboardController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/OperationController.php';
require_once 'src/controllers/DefaultController.php';

class Routing{
    public static $routes;

    public static function get($url, $controller){
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller){
        self::$routes[$url] = $controller;
    }

    public static function run ($url) {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if (!array_key_exists($action, self::$routes)) {
            die("Wrong url!"); //TODO 404
        }

        /*if(in_array($action, ["dashboard"])){
            $action = 'dashboard';
        }

        if(in_array($action, ["register", "login"])){
            $action = 'login';
        }*/

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';

        $id = $urlParts[1] ?? '';
        $object->$action($id);
    }
}