<?php
/*
Router Class: This class is used to define our roots and redirect traffic to the selected root
*/

namespace Core;

use Core\Controllers\Home;
use Core\Helpers\Tests;

class Router
{
    use Tests;

    public static $get_routes = [];
    public static $post_routes = [];
    public static $put_routes = [];
    public static $delete_routes = [];


    public static function redirect()
    {
        $request = $_SERVER['REQUEST_URI'];
        $request = explode('?', $request)[0]; 
        $routes = [];             


        switch ($_SERVER['REQUEST_METHOD']) {

            case "GET":
                $routes = self::$get_routes;
                break;

            case "POST":
                $routes = self::$post_routes;
                break;

            case "PUT":
                $routes = self::$put_routes;
                break;

            case "DELETE":
                $routes = self::$delete_routes;
                break;
        }
        if (empty($routes) || !array_key_exists($request, $routes)) {
            http_response_code(404);
            die("Page is not existed!");
        }

        /////////////// Here we will reach out the pages and the functions in th files ///////////////////////
        $controller_namespace = "Core\\Controllers\\";
        $controller_methods = explode('.', $routes[$request]);  
        $controller_name = $controller_namespace . ucfirst(strtolower($controller_methods[0])); 
        $controller = new $controller_name;    
        if (count($controller_methods) == 2) { 
            call_user_func([$controller, $controller_methods[1]]); 
        }
        $controller->render();
    }

    public static function get($route, $controller)
    {
        self::$get_routes[$route] = $controller;
    }


    public static function post($route, $controller)
    {
        self::$post_routes[$route] = $controller;
    }

    public static function put($route, $controller)
    {
        self::$put_routes[$route] = $controller;
    }

    public static function delete($route, $controller)
    {
        self::$delete_routes[$route] = $controller;
    }
}
