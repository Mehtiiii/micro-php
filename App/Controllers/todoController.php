<?php

namespace App\Controllers;

class TodoController
{
    public function list()
    {
        # database:
        $data = ['باشگاه', 'زبان انگلیسی', 'برنامه‌نویسی'];
        $data = [
            'tasks' => $data,
            'title' => 'لیست تسک‌ها'
        ];
        view('todo.list', $data);
    }

    public function add()
    {
        echo 'added ...';
        die();
    }
}
