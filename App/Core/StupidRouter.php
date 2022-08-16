<?php

namespace App\Core;

use App\Utilities\Url;

class StupidRouter
{
    private $route;

    public function __construct()
    {
        $this->route = [
            '/'             => 'home/index.php',
            '/colors/blue'  => 'colors/blue.php',
            '/colors/red'   => 'colors/red.php',
            '/colors/green' => 'colors/green.php'
        ];
    }

    public function run()
    {
        $current_route = Url::current_route();
        
        foreach ($this->route as $route => $view) {
            if ($route == strtolower($current_route))
                include_and_die(realpath($_ENV['BASEPATH'] . "Views/{$view}"));
        }
        header('Http/1.1 404 Not Found');
        include_and_die(realpath($_ENV['BASEPATH'] . 'Views/errors/404.php'));
    }

    // private function includeAndDie($viewPath)
    // {
    //     include $viewPath;
    //     die();
    // }
}