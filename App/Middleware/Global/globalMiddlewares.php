<?php

namespace App\Middleware\Global;

class globalMiddlewares
{
    public static $middlewares = [
        'BlockIE' => \App\Middleware\BlockIE::class,
        // 'BlockIP' => \App\Middleware\BlockIP::class,
    ];
}
