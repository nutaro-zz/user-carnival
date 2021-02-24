<?php


namespace App\Service;


class CityService extends Service implements IService
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'city';
    }

    public function getOne(int $data)
    {
        // TODO: Implement getOne() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function create(array $data)
    {
        $sql = "INSERT INTO ".$this->table;
        $sql .= " (name, state_id) VALUES (".$data['name'].", ".$data['state_id'].")";
        $this->connection->exec($sql);
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}