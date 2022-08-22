<?php

namespace App\Models\Contracts;

class JsonBaseModel extends BaseModel
{
    protected $base_path;
    protected $table_filepath;

    public function __construct()
    {
        $this->base_path = BASEPATH . 'storage/json-db/';
        $this->table_filepath = $this->base_path . $this->table . '.json';
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
        $table_data = $this->read_table();
        $table_data[] = $data;
        $this->write_file($table_data);
        return $data[$this->primary_key];
    }

    public function find(int $id): object|null
    {
        $data = $this->read_table();
        foreach ($data as $row) {
            if ($row->{$this->primary_key} == $id)
                return $row;
        }
        return null;
    }
    public function get(array $columns, array $where): array
    {
        $table_data = $this->read_table();
        $data_user = [];
        $data = [];
        $where_key = array_keys($where);
        foreach ($table_data as $user) {
            for ($i = 0; $i < sizeof($where_key); $i++) {
                if ($where[$where_key[$i]] == $user->{$where_key[$i]}) {
                    $data_user = (array) $user;
                }
            }
        }
        foreach ($columns as $column) {
            $data[$column] = $data_user[$column];
        }
        return $data;
    }

    public function getAll(): array
    {
        return $this->read_table();
    }

    public function update(array $data, array $where): int
    {
        $table_data = $this->read_table();
        foreach ($table_data as $user) {
            $key_data = array_keys($where)[0];
            if ($where[$key_data] == $user->{$key_data}) {
                foreach ($data as $column) {
                    $key = array_keys($data);
                    $i = 0;
                    $user->{$key[$i]} = $data[$key[$i]];
                    $this->write_file($table_data);
                }
                return 1;
            }
            return 0;
        }
    }

    public function delete(array $where): int
    {
        $return = 0;
        $table_data = $this->read_table();
        $key_data = array_keys($where)[0];
        $i = 0;
        foreach ($table_data as $user) {
            if ($where[$key_data] == $user->{$key_data}) {
                unset($table_data[$i]);
                $return = 1;
            }
            $i++;
        }
        $this->write_file($table_data);
        return $return;
    }
    #------------------------------------------------------------
    #------------------------------------------------------------
    #------------------------------------------------------------

    private function read_table()
    {
        return json_decode(file_get_contents($this->table_filepath));
    }
    private function write_file($data)
    {
        file_put_contents($this->table_filepath, json_encode($data));
    }
}
