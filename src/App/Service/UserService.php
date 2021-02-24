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
                $state = $this->getOrCreateState(array("name" => $data['state']));
            $city = $this->getOrCreateCity(array("name" => $data['city']), $state);

            $body = array('street' => $data['street'],
                          'complement' => $data['complement'],
                          'state_id' => $state->getId(),
                          'city_id' => $city->getId());
            $address = $this->getOrCreateAddress($body);

        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }

}


    private function getOrCreateCity(array $data, State $state): City
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

    private function getOrCreateAddress(array $data, State $state,City $city): Address
    {
        try {
            $address = Address::getByField($data);
            if (!empty($address))
                return $address;
            $address = new Address();
            $address->setState($state);
            $address->setCity($city);
            $address->setComplement($data['complement']);
            $address->setStreet($data['street']);
            $address->setNumber($data['number']);
            $address->add();
            return $address;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }

    }


    private function getOrCreateState(array $data): State
    {
        try {
            $state = State::getByField($data);
            if (!empty($state))
                return $state;
            $state = new State();
            $state->setName($data["name"]);
            $state->add();
            return $state;
        } catch (\PDOException $ex) {
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