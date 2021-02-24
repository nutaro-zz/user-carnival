<?php


namespace App\Service;

use App\Entities\City;
use App\Entities\State;
use App\Entities\User;
use App\Entities\Address;


class UserService extends Service implements IService
{

    private User $entity;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
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
            $state = StateService::getOrCreateState(array("name" => $data['state']));
            $city = CityService::getOrCreateCity(array("name" => $data['city']), $state);

            $body = array('street' => $data['street'],
                          'complement' => $data['complement'],
                          'state_id' => $state->getId(),
                          'city_id' => $city->getId());
            $address = AddressService::getOrCreateAddress($body);
            $user = $this->entity;
            $user->setName($data["name"]);
            $user->setAddress($address);
            $user->add();
            $this->connection->commit();
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
}







    public function getOne(int $data)
    {
        // TODO: Implement getOne() method.
    }


    public function getById()
    {
        // TODO: Implement getById() method.
    }
}