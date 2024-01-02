<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/RecipeController.php';


class Router {
    public static $routes;

    public static function get($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function run($url) {
        $action = explode("/", $url)[0];

        if (!array_key_exists($action, self::$routes)) {
            die("Wrong url");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'login';

        $object->$action();
    }
}

// require_once 'src/controllers/DefaultController.php';
// require_once 'src/controllers/SecurityController.php';
// require_once 'src/controllers/RecipeController.php';

// class Router {
//     public static $routes = [];

//     public static function get($pattern, $controller, $method = null) {
//         self::$routes['GET'][$pattern] = [$controller, $method];
//     }

//     public static function post($pattern, $controller, $method = null) {
//         self::$routes['POST'][$pattern] = [$controller, $method];
//     }

//     public static function run($url) {
//         $method = $_SERVER['REQUEST_METHOD'];

//         foreach (self::$routes[$method] as $pattern => $callback) {
//             if (preg_match('#^' . $pattern . '$#', $url, $params)) {
//                 array_shift($params); // Remove the first element, which is the full match

//                 $controller = new $callback[0]();
//                 $action = $callback[1] ?? 'login';

//                 call_user_func_array([$controller, $action], $params);
//                 return;
//             }
//         }

//         die("Wrong url");
//     }
// }