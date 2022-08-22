<?php

namespace App\Middleware;

use App\Middleware\Contract\MiddlewareInterface;
use hisorange\BrowserDetect\Parser as Browser;

class BlockIE implements MiddlewareInterface
{
    public function handle()
    {
        // global $request;
        $data = [
            'title' => 'Browser error!',
            'browser' => 'Internet Explorer',
            'reason' => 'is forbidden for this page!'
        ];
        if (Browser::isIE()) {
            header('Http/1.1' . " 403 Forbidden");
            view('errors.middleware.browser', $data);
            die();
        }
    }
}
