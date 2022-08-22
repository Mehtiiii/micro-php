<?php

namespace App\Models\Contracts;

abstract class BaseModel implements CrudInterface
{
    protected $connection;
    protected $table;
    protected $primary_key = 'id';
    protected $page_size;
    protected $attributes = [];

    protected function __construct()
    {
        # if mysql => set mysql connection
    }

    public function getAttribute($key)
    {
        if (!$key || !array_key_exists($key, $this->attributes))
            return null;
        return $this->attributes[$key];
    }
}