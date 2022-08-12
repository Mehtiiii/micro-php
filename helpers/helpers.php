<?php

function site_url($route = null)
{
    return $_ENV['HOST'] . $route;
}

function assets_url($route)
{
    return site_url("assets/{$route}");
}