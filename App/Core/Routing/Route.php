<?php

namespace App\Core\Routing;

class Route
{
    const HTTP_VERBS = ['get', 'post', 'put' ,'update','delete'];
    private static $routes = [];

    public static function add($methods, $uri, $action = null, $middlewares = [])
    {
        $methods = is_array($methods) ? $methods : [$methods];
        self::$routes[] = ['methods' => $methods, 'uri' => $uri, 'action' => $action, 'middlewares' => $middlewares];
    }

    public static function __callStatic($name, $arguments)
    {
        if(!in_array(strtolower($name),self::HTTP_VERBS))
            throw new \Exception("method not supported !");
        if (sizeof($arguments) > 2)
            self::add(strtolower($name), $arguments[0], $arguments[1], $arguments[2]);
        else
            self::add(strtolower($name), $arguments[0], $arguments[1]);
    }

    public static function routes()
    {
        return self::$routes;
    }
}