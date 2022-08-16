<?php

namespace App\Core\Routing;

class Route
{
    private static $routes = [];

    public static function add($methods, $uri, $action = null)
    {
        $methods = is_array($methods) ? $methods : [$methods];
        self::$routes[] = ['methods' => $methods, 'uri' => $uri, 'action' => $action];
    }

    public static function __callStatic($name, $arguments)
    {
        if (sizeof($arguments) > 1)
            self::add($name, $arguments[0], $arguments[1]);
        else
            self::add($name, $arguments[0]);
    }

    public static function routes()
    {
        return self::$routes;
    }
}