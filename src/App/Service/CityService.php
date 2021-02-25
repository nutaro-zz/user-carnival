<?php


namespace App\Service;


use App\Exceptions\ResourceAlreadyExistsException;

use PDO;

class CityService extends Service implements IService
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'city';
    }

    public function getAll()
    {
        $sql = "SELETC * from {$this->table}";
        $query = $this->connection->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        try {
            $sql = "INSERT INTO " . $this->table;
            $sql .= " (name, state_id) VALUES ('";
            $sql .= $data['name'] . "', '" . $data['state_id'] . "')";
            $this->connection->beginTransaction();
            $this->connection->exec($sql);
            $this->connection->commit();
        } catch (\PDOException $ex) {
            $this->connection->rollBack();
            if ($ex->getCode() == "23000")
                throw new ResourceAlreadyExistsException();
            throw new \Exception();
        }
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function get(int $id)
    {
        $sql = "SELETC * from {$this->table} WHERE id{$id}";
        $query = $this->connection->query($sql);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrCreate(array $data): array
    {
        $city = $this->getByField($data);
        if (!isset($city) && !$city){
            $this->create($data);
            $city = $this->getByField($data);
        }
        return $city;
    }
}