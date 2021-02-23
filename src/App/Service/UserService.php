<?php


namespace App\Service;

use App\DataBase\Connection;
use App\Service\CityService;

class UserService extends Service implements IService
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }

    public function create(array $data)
    {
        $this->connection->beginTransaction();
        $name = $data['name'];
        $address = $data['address'];
        $city = $data['city'];
        $state = $this->geStateId(data['state']);
        $cityService = new CityService();
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