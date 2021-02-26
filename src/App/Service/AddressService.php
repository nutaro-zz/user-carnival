<?php
namespace App\Service;

use App\Entities\Address;
use App\Entities\City;
use App\Entities\State;


class AddressService implements IService
{
    public string $table = 'address';

    public function getOrCreateAddress(Address $address): Address
    {
        try {
            $values = array("street" => $address->getStreet(), 'number' => $address->getNumber(),
                            "state_id" => $address->getState()->getId(), 'city_id' => $address->getCity()->getId());
            $addressData = $address->getByField($values);
            if ($addressData){
                $address->build($addressData);
                return $address;
            }
            $address->add();
            return $address;
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

    public function get(int $id)
    {
        // TODO: Implement get() method.
    }
}