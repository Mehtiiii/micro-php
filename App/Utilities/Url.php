<?php

namespace App\Utilities;

class Url
{
    public static function current()
    {
        return isset($_SERVER['https']) && $_SERVER['https'] == 'on' ? 'https' : 'http' . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    }

    public static function current_route()
    {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }
}