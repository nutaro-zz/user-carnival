<?php


namespace App\Service;


use App\Entities\State;


class StateService extends Service implements IService
{

    protected static string $table = 'state';

    public function __construct()
    {
        parent::__construct();
    }

    public static function getOrCreateState(array $data)
    {
        try {
            $state = new State();
            $stateData = State::getByField($data, self::$table);
            if (empty($stateData) && !$stateData) {
                $state->setName($data["name"]);
                $state->add();
                return $state;
            }
            $state->build($stateData);
            return $state;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

//    public static function(data?)

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