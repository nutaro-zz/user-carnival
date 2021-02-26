<?php


namespace App\Repository;


use App\Service\CityService;
use App\Service\StateService;

class UserRepository
{

    protected string $fullUserQuery;

    public function __construct()
    {
        $this->fullUserQuery = "SELECT users.name, users.address, state.name state, city.name city";
        $this->fullUserQuery .= " from users users INNER JOIN state state ON users.state_id = state.id";
        $this->fullUserQuery .= " LEFT JOIN city city ON users.city_id = city.id";
    }


    public function getUserById(int $id): string
    {
        return "{$this->fullUserQuery} WHERE users.id={$id}";

    }

    public function getAllUsers(): string
    {
        return $this->fullUserQuery;
    }

    public function updateStateId(array $content, string $stateName): string
    {
        $sql = "";
        if (!is_null($content['state'])) {
            $stateService = new StateService();
            $state = $stateService->getOrCreate(array("name" => $content['state']));
            if ($stateName != $state['name']) {
                $sql .= "state_id = '{$state['id']}', ";
            }
        }
        return $sql;
    }

    public function updateCityId(array $content, $stateId, $cityId): string
    {
        $sql = "";
        if (!is_null($content['city'])) {
            $cityService = new CityService();
            $city = $cityService->getOrCreate(array("name" => $content['city'], "state_id" => $stateId));
            if ($city['id'] != $cityId) {
                $sql .= "city_id = '{$city['id']}', ";
            }
        }
        return $sql;
    }

    public function updateUser(array $user, array $content): string
    {
        $sql = "UPDATE users SET ";
        $sql .= $this->updateStateId($content, $user['state']);
        $stateService = new StateService();
        $state = $stateService->getByField(array("name" => $content['state']));
        unset($content['state']);
        $sql .= $this->updateCityId($content, $state['id'], );
        unset($content['city']);
        foreach ($content as $key => $value) {
            if ($user[$key] != $value)
                $sql .= "{$key} = '{$value}', ";
        }

        $sql .= " WHERE id={$user['id']}";
        return $sql;
    }
}
