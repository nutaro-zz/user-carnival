<?php



namespace App\Service;


use App\Entities\City;
use App\Entities\State;

class CityService extends Service implements IService
{

    protected static string $table = 'city';

    public function __construct()
    {
        parent::__construct();
    }

    public static function getOrCreateCity(array $data, State $state)
    {
        try {
            $cityData = City::getByField(array("state_id" => $state->getId(), "name" => $data['name']), self::$table);
            $city = new City();
            if (empty($cityData) && $cityData) {
                $city->build($cityData);
                return $city;
            }
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


    public function getById(int $id)
    {
        // TODO: Implement getById() method.
    }

    public function getByName(string $name)
    {
        // TODO: Implement getByName() method.
    }
}