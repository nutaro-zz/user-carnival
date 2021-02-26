<?php


namespace App\Service;

use App\Entities\City;
use App\Entities\State;
use App\Entities\User;
use App\Entities\Address;


class UserService extends Service implements IService
{

    protected static string $table;

    private User $entity;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return User
     */
    public function getEntity(): User
    {
        return $this->entity;
    }

    /**
     * @param User $entity
     */
    public function setEntity(User $entity): void
    {
        $this->entity = $entity;
    }

    public function create(array $data)
    {
        try {
            $this->connection->beginTransaction();
            $state = (new StateService())->getOrCreateState(array("name" => $data['state']));
            $city = (new CityService())->getOrCreateCity(array("name" => $data['city']), $state);
            var_dump($city);
            $address = new Address();
            $address->setState($state);
            $address->setCity($city);
            $address->setStreet($data['street']);
            $address->setNumber($data['number']);
            $address = (new AddressService())->getOrCreateAddress($address);
            $user = $this->entity;
            $user->setName($data["name"]);
            $user->setAddress($address);
            $user->add();
            $this->connection->commit();
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
}


    public function getById(int $name)
    {
        // TODO: Implement getById() method.
    }

    public function getByName(string $name)
    {
        // TODO: Implement getByName() method.
    }
}