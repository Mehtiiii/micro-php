<?php

namespace App\Core\Routing;

use \App\Core\Request;
use \App\Core\Routing\Route;

class Router
{
    private $request;
    private $routes;
    private $current_route;
    const BASE_CONTROLLER = 'App\Controllers\\';

    public function __construct()
    {
        $this->request = new Request();
        $this->routes = Route::routes();
        $this->current_route = $this->findRoute($this->request);
    }

    private function findRoute(Request $request)
    {
        foreach ($this->routes as $route) {
            if (in_array($request->method(), $route['methods']) && $request->uri() == $route['uri']) {
                return $route;
            }
        }
        return null;
    }

    public function run()
    {
        # 405 : Invalid request method
        if ($this->invalidRequest($this->request))
            $this->dispatch405();
    
        # 404 : Uri not exist
        if (is_null($this->current_route))
            $this->dispatch404();

        # action :
        $this->dispatch($this->current_route);
    }

    private function invalidRequest(Request $request) : bool
    {
        foreach ($this->routes as $route) {
            if ($request->uri() == $route['uri'] && !in_array($request->method(), $route['methods'])) {
                return true;
            }
        }
        return false;
    }

    private function dispatch405() : void
    {
        header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed");
        view('errors.405');
        die();
    }

    private function dispatch404() : void
    {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
        view('errors.404');
        die();
    }

    private function dispatch($route)
    {
        $action = $route['action'];

        # action : null
        if (is_null($action) || empty($action))
            return ;
        
        # action : closure
        if (is_callable($action))
            $action();
            # or :
            // call_user_func($action);

        # action : Controller@method
        if (is_string($action))
            $action = explode('@', $action);

        # action : ['Controller', 'method']
        if (is_array($action)) {
            $class_name = self::BASE_CONTROLLER . $action[0];
            $method = $action[1];
            if (!class_exists($class_name))
                throw new \Exception("Class $class_name not exists!");
            $controller = new $class_name;
            if (!method_exists($controller, $method))
                throw new \Exception("Method $method not exists in class $class_name");
            $controller->{$method}();
        }
    }
}
