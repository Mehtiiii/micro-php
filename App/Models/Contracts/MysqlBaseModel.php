<?php

namespace App\Models\Contracts;

use PDOException;

class MysqlBaseModel extends BaseModel
{
    public function construct()
    {
        try {
            $this->connection = new \PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASS']);
            $this->connection->exec('set names utf8;');
        } catch (PDOException $e) {
            die('Connection failed to database: ' . $e->getMessage());
        }
    }

    #------------------------------------------------------------
    #.
    #.
    #.
    #.
    #.
    # --- CRUD --------------------------------------------------
    #------------------------------------------------------------
    public function insert(array $data): int
    {
        return 1;
    }

    public function find(int $id): object|null
    {
        return (object) [];
    }
    public function get(array $columns, array $where): array|null
    {
        return [];
    }

    public function getAll(): array
    {
        return [];
    }

    public function update(array $data, array $where): int
    {
        return 1;
    }

    public function delete(array $where): int
    {
        return 1;
    }
    #------------------------------------------------------------
    #------------------------------------------------------------
    #------------------------------------------------------------
}
