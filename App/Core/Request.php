<?php

namespace App\Core;

class Request
{
    private $method;
    private $params;
    private $route_params = [];
    private $agent;
    private $ip;
    private $uri;

    public function __construct()
    {
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->params = $_REQUEST;
        $this->agent  = $_SERVER['HTTP_USER_AGENT'];
        $this->ip     = $_SERVER['REMOTE_ADDR'];
        $this->uri    = strtolower(strtok($_SERVER['REQUEST_URI'], '?'));
    }

    public function __call($name, $arguments)
    {
        if (property_exists($this, $name))
            return $this->$name;
    }

    // public function __get($property)
    // {
    //     return $this->params[$property] ?? null;
    // }

    public function add_route_params($key, $value)
    {
        $this->route_params[$key] = $value;
    }

    public function get_route_param($key)
    {
        return $this->route_params[$key];
    }

    public function input($key)
    {
        return $this->params[$key] ?? null;
    }

    public function isset($key)
    {
        return isset($this->params[$key]);
    }

    public function redirect($route)
    {
        header('Location: ' . realpath($_ENV['HOST']) . "views/Colors/$route");
        die();
    }
}