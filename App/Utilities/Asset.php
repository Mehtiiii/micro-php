<?php

namespace App\Utilities;

class Asset
{
    public static function __callStatic($name, $arguments)
    {
        $path = realpath($_ENV['PATH'] . "assets/" . $name . '/' . $arguments[0]);
        if (!file_exists($path))
            return false;
        return $file = $_ENV['HOST'] . "assets/" . $name . '/' . $arguments[0];
    }
}