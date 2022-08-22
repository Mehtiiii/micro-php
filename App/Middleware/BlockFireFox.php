<?php

namespace App\Middleware;

use App\Middleware\Contract\MiddlewareInterface;
use hisorange\BrowserDetect\Parser as Browser;

class BlockFirefox implements MiddlewareInterface
{
    public function handle()
    {
        // global $request;
        $data = [
            'title' => 'Browser error!',
            'browser' => 'Firefox',
            'reason' => 'is forbidden for this page!'
        ];
        if (Browser::isFirefox()) {
            header('Http/1.1'." 403 Forbidden");
            view('errors.middleware.browser', $data);
            die();
        }
    }
}
