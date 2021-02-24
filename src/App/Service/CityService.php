<?php



namespace App\Service;


use App\Entities\City;
use App\Entities\State;

class CityService extends Service implements IService
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'city';
    }

    public static function getOrCreateCity(array $data, State $state): City
    {
        try {
            $city = City::getByField(array("state_id" => $state->getId(), "name" => $data['name']));
            if (!empty($city))
                return $city;
            $city = new City();
            $city->setState($state);
            $city->setName($data['name']);
            $city->add();
            return $city;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function getById()
    {
        // TODO: Implement getById() method.
    }
}