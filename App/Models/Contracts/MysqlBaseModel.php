<?php

namespace App\Models\Contracts;

use PDOException;
use Medoo\Medoo;

class MysqlBaseModel extends BaseModel
{
    public function __construct($id)
    {
        try {
            $pdo = new \PDO('mysql:dbname=micro;host=127.0.0.1', 'root', '');
            $this->connection = new Medoo([
                'pdo' => $pdo,
                'type' => 'mysql'
            ]);
        } catch (PDOException $e) {
            die('Connection failed to database: ' . $e->getMessage());
        }
        $this->find($id);
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
        $this->connection->insert($this->table, $data);
        return $this->connection->id();
    }

    public function find(int $id): object
    {
        $record = $this->connection->get($this->table, '*', [$this->primary_key => $id]);
        if (!is_null($record)) {
            foreach ($record as $col => $val)
                $this->attributes[$col] = $val;
        }
        return $this;
    }
    public function get(array $columns, array $where): array
    {
        $result = $this->connection->get($this->table, $columns, $where);
        return $result;
    }

    public function getAll(): array
    {
        $result = $this->connection->select($this->table, '*');
        return $result;
    }

    public function update(array $data, array $where): int
    {
        $result = $this->connection->update($this->table, $data, $where);
        return $result->rowCount();
    }

    public function delete(array $where): int
    {
        $result = $this->connection->delete($this->table, $where);
        return $result->rowCount();
    }
    #------------------------------------------------------------
    #------------------------------------------------------------
    #------------------------------------------------------------
    public function remove(): int
    {
        $primary_key = $this->getAttribute($this->primary_key);
        return $this->delete([$this->primary_key => $primary_key]);
    }

    public function save(): int
    {
        return $this->update($this->attributes, [$this->primary_key => $this->attributes[$this->primary_key]]);
    }
}
