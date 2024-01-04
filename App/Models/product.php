<?php

namespace App\Models;

use App\Models\Contracts\MysqlBaseModel;

class product extends MysqlBaseModel
{
    protected $table = 'products';
}