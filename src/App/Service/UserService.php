<?php


namespace App\Service;

use App\DataBase\Connection;
use App\Service\CityService;
use App\Service\StateService;

class UserService extends Service implements IService
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    public function create(array $data)
    {
        try {
            $this->connection->beginTransaction();
            $stateId = $this->geStateId($data['state']);
            $cityId = $this->getCityId(array("state_id" => $stateId, "name" => $data['city']));
            $sql = "INSERT INTO ".$this->table;
            $sql .= " (name, address, state_id, city_id) VALUES ";
            $sql .= "('".$data['name']."', '".$data['address']."', ".$stateId.", ".$cityId.")";
            $this->connection->exec($sql);
            $this->connection->commit();
        } catch (\PDOException $ex) {
            $this->connection->rollBack();
            echo $ex->getMessage();
        }

    }

    private function getCityId(array $fields): int
    {
        try {
            $cityService = new CityService();
            $city = $cityService->getByField($fields);
            if (!empty($city))
                return $city[0]['id'];
            $cityService->create($fields);
            $this->connection->commit();
            return $this->connection->lastInsertId();
        } catch (\PDOException $ex) {
            $this->connection->rollBack();
            echo $ex->getMessage();
        }
    }

    private function geStateId(string $name): int
    {
        try {
            $stateService = New StateService();
            $state = $stateService->getByField(array('name' => "{$name}"));
            if (!empty($state))
                return $state[0]['id'];
            $stateService->create(array("name" => $name));
            $this->connection->commit();
            return $this->connection->lastInsertId();
        } catch (\PDOException $ex) {
            $this->connection->rollBack();
            echo $ex->getMessage();
        }
    }

    public function getOne(int $data)
    {
        // TODO: Implement getOne() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
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