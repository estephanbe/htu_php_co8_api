<?php 
/**
 * Router Class: this class is used to define our routes and to redirect traffic to the selected route
 */
namespace Core;

use Core\Helpers\Tests;

class Router {

    use Tests;

    public static $get_routes = [];
    public static $post_routes = [];
    public static $put_routes = [];
    public static $delete_routes = [];

    public static function redirect(){

        $request = $_SERVER['REQUEST_URI'];
        $request = explode('?', $request)[0];
        
        $routes = [];

        switch ($_SERVER['REQUEST_METHOD']){
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

        if( empty($routes) || !array_key_exists($request, $routes)){
            http_response_code(404);
            die("Page is not existed");
        }

        $controller_namespace = "Core\\Controllers\\"; // define the class namespace. 
        $controller_methods = explode('.', $routes[$request]);
        $controller_name = $controller_namespace . ucfirst(strtolower($controller_methods[0])); // Concatinate name space with the class controller name. but before that, lowercase the class name, and convert the first letter to uppercase. 
        $controller = new $controller_name; // create new instance of the requested class. 
        if(count($controller_methods) == 2){
            call_user_func([$controller, $controller_methods[1]]);
        }
        $controller->render();
    }
    
    public static function get($route, $controller){
        self::$get_routes[$route] = $controller;
    }

    public static function post($route, $controller){
        self::$post_routes[$route] = $controller;
    }

    public static function put($route, $controller){
        self::$put_routes[$route] = $controller;
    }

    public static function delete($route, $controller){
        self::$delete_routes[$route] = $controller;
    }

}