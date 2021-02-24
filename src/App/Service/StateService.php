<?php


namespace App\Service;


use App\Entities\State;


class StateService extends Service implements IService
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'state';
    }

    public static function getOrCreateState(array $data): State
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

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function getById()
    {
        // TODO: Implement getById() method.
    }

}