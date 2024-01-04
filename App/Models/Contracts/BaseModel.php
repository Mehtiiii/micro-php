<?php

namespace App\Models\Contracts;

abstract class BaseModel implements CrudInterface
{
    protected $connection;
    protected $table;
    protected $primary_key = 'id';
    protected $page_size;
    protected $attributes = [];

    public function getAttribute($key)
    {
        if (!$key || !array_key_exists($key, $this->attributes))
            return null;
        return $this->attributes[$key];
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function __get($property)
    {
        return $this->getAttribute($property);
    }

    public function __set($property, $value)
    {
        if (array_key_exists($property, $this->attributes)) {
            $this->attributes[$property] = $value;
        }
    }
}