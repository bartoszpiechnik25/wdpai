<?php

require_once 'src/controllers/DefaultController.php';

class Router {
    public static $routes;

    public static function get($url, $controller) {
        if ($url == "" || $url == "/") {
            $url = "index";
        }
        self::$routes[$url] = $controller;
    }

    public static function run($url) {
        print($url);
        $action = explode("/", $url)[0];
        print($action);

        if (!array_key_exists($action, self::$routes)) {
            die("Wrong url");
        }

        $controller = self::$routes[$action];
        $object = new $controller;

        $object->$action();
    }
}