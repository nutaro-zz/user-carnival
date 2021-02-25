<?php


namespace App\Service;


class StateService extends Service implements IService
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'state';
    }

    public function create(array $data)
    {
        $sql = "INSERT INTO ".$this->table." (name) VALUES (:name)";
        $query = $this->connection->prepare($sql);
        $query->bindParam('name', $data['name']);
        $query->execute();
    }

    public function get(int $id)
    {
        // TODO: Implement get() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getOrCreate(array $data): array
    {
        $state = $this->getByField($data);
        if (!isset($state) && !$state){
            $this->create($data);
            $state = $this->getByField($data);
        }
        return $state;
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