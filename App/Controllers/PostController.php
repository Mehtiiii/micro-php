<?php

namespace App\Controllers;

class PostController
{
    public function single()
    {
        global $request;
        echo $slug = $request->get_route_param('slug');
    }

    public function comment()
    {
        global $request;
        echo $c_id = $request->get_route_param('c_id');
        echo $slug = $request->get_route_param('slug');
    }
}