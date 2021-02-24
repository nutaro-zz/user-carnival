<?php
namespace App\Service;

use App\Entities\Address;
use App\Entities\City;
use App\Entities\State;


class AddressService implements IService
{

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function getById()
    {
        // TODO: Implement getByID() method.
    }


    public static function getOrCreateAddress(array $data, State $state,City $city): Address
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

}