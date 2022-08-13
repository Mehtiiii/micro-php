<?php

namespace App\Core;

use App\Utilities\Url;

class StupidRouter
{
    private $route;

    public function __construct()
    {
        $this->route = [
            '/colors/blue' => 'colors/blue.php',
            '/colors/red' => 'colors/red.php',
            '/colors/green' => 'colors/green.php'
        ];
    }

    public function run()
    {
        $current_url = Url::current_route();
        
        foreach ($this->route as $route => $view) {
            if ($route == strtolower($current_url))
                $this->includeAndDie(realpath($_ENV['BASEPATH'] . "Views/{$view}"));
        }
        header('Http/1.1 404 Not Found');
        $this->includeAndDie(realpath($_ENV['BASEPATH'] . 'Views/errors/404.php'));
    }

    private function includeAndDie($viewPath)
    {
        include $viewPath;
        die();
    }
}