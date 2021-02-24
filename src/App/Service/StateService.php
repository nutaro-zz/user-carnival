<?php


namespace App\Service;


class StateService extends Service implements IService
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    public function getOne(int $data)
    {

    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function create(array $data)
    {
        $sql = "INSERT INTO ".$this->table." (name) VALUES (:name)";
        $query = $this->connection->prepare($sql);
        $query->bindParam('name', $data['name']);
        $query->execute();
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