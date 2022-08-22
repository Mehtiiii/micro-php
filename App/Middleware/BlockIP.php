<?php

namespace App\Middleware;

use App\Middleware\Contract\MiddlewareInterface;

class BlockIP implements MiddlewareInterface
{
    public function handle()
    {
        global $request;
        $data = [
            'title' => 'Block IP!',
            'ip' => $request->ip(),
            'reason' => 'was blocked for this website!'
        ];
        if ($request->ip() == '127.0.0.1') {
            header('Http/1.1' . " 403 Forbidden");
            view('errors.middleware.ip', $data);
            die();
        }
    }
}
