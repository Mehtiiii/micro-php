<?php

namespace App\Models;

use App\Models\Contracts\MysqlBaseModel;

class user extends MysqlBaseModel
{
    protected $table = 'users';
}