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
            if ($request->uri() == $route['uri'] && !in_array($request->method(), $route['methods'])  ) {
                return false;
            }
            if ($this->regex_matched($route))
                return $route;
        }
        return null;
    }

    public function regex_matched($route)
    {
        global $request;
        $pattern = '/^' . str_replace(['/', '{', '}'], ['\/', '(?<', '>[-%\w]+)'], $route['uri']) . '$/';
        $result = preg_match($pattern, $this->request->uri(), $matches);
        if (!$result) {
            return false;
        }
        foreach ($matches as $key => $value) {
            if (!is_int($key))
                $request->add_route_params($key, $value);
        }
        return true;
    }

    public function run()
    {
        # 405 : Invalid request method
        if ($this->invalidRequest($this->request))
            $this->dispatch405();

        # 404 : Uri not exist
        if (is_null($this->current_route))
            $this->dispatch404();

        # Run middlewares :
        $this->run_global_middlewares(\App\Middleware\Global\globalMiddlewares::$middlewares);
        $this->run_route_middlewares($this->current_route);

        # action :
        $this->dispatch($this->current_route);
    }

    private function invalidRequest(Request $request): bool
    {
        foreach ($this->routes as $route) {
            if ($request->uri() == $route['uri'] && !in_array($request->method(), $route['methods'])) {
                return true;
            }
        }
        return false;
    }

    private function run_global_middlewares($middlewares)
    {
        foreach ($middlewares as $middleware) {
            $middleware_obj = new $middleware();
            $middleware_obj->handle();
        }
    }

    private function run_route_middlewares($current_route)
    {
        $middlewares = $this->current_route['middlewares'];
        foreach ($middlewares as $middleware) {
            $middleware_obj = new $middleware;
            $middleware_obj->handle();
        }
    }

    private function dispatch405(): void
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed");
        view('errors.http.405');
        die();
    }

    private function dispatch404(): void
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        view('errors.http.404');
        die();
    }

    private function dispatch($route)
    {
        $action = $route['action'];

        # action : null
        if (is_null($action) || empty($action))
            return;

        # action : closure
        if (is_callable($action)) {
            $action();
            # or :
            // call_user_func($action);
        }

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
