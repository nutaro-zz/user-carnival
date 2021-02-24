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
        $this->table = 'user';
    }

    public function create(array $data)
    {
        $name = $data['name'];
        $address = $data['address'];
        $stateId = $this->geStateId(data['state']);
        $city_id = $this->getCityId(array("state_id" => $stateId, "name" => Sdata['city']));
        $sql = "INSERT INTO ".$this->table."(name, address, state_id, city_id) VALUES (:name, :address, )";

    }

    private function getCityId(array $fields): int
    {
        $cityService = new CityService();
        $city = $cityService->getByField($fields);
        if ($city)
            return $city['id'];
        $city = $cityService->create($fields);
        return $city['id'];

    }

    private function geStateId(string $name)
    {
        $stateService = New StateService();
        $state = $stateService->getByField('name', $name);
        if ($state)
            return $state['id'];
        $state = $stateService->create(array("name", $name));
        return $state['id'];
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