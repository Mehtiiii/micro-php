<?php

function site_url($route = null)
{
    return $_ENV['HOST'] . $route;
}

function assets_url($route)
{
    return site_url("assets/{$route}");
}

function view($path, $data = [])
{
    extract($data);
    $path = str_replace('.', '/', $path);
    $view_full_path = realpath(BASEPATH . "Views/{$path}.php");
    include_once $view_full_path;
}

function include_and_die($viewPath)
{
    require_once $viewPath;
    die();
}
