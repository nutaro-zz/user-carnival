<?php
namespace App\Service;

use App\Entities\Address;
use App\Entities\City;
use App\Entities\State;


class AddressService implements IService
{
    public static string $table = 'address';

    public static function getOrCreateAddress(array $data, State $state, City $city): Address
    {
        try {
            var_dump($data);
            $address = new Address();
            $address->setState($state);
            $address->setCity($city);
            $addressData = Address::getByField($data);
            if (!empty($addressData) && $addressData){
                $address->build($addressData);
                return $address;
            }
            $address->setStreet($data['street']);
            $address->setNumber($data['number']);
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
}