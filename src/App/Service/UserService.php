<?php


namespace App\Service;

use App\DataBase\Connection;
use App\Repository\UserRepository;

use App\Exceptions\ResourceAlreadyExistsException;
use App\Exceptions\UnprocessableEntityException;
use App\Exceptions\NotFoundException;

use PDOException;
use PDO;

class UserService extends Service implements IService
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    public function create(array $data)
    {
        try {
            $stateId = $this->getStateId($data['state']);
            $cityId = $this->getCityId(array("state_id" => $stateId, "name" => $data['city']));
            $sql = "INSERT INTO ".$this->table;
            $sql .= " (name, address, state_id, city_id) VALUES ";
            $sql .= "('".$data['name']."', '".$data['address']."', ".$stateId.", ".$cityId.")";
            $this->connection->beginTransaction();
            $this->connection->exec($sql);
            $this->connection->commit();
        } catch (PDOException $ex) {
            $this->connection->rollBack();
            if ($ex->getCode() == "23000")
                throw new ResourceAlreadyExistsException();
        }

    }

    private function getCityId(array $fields): int
    {
        try {
            $cityService = new CityService();
            $city = $cityService->getByField($fields);
            if (!empty($city))
                return $city[0]['id'];
            $cityService->create($fields);
            $this->connection->commit();
            return $this->connection->lastInsertId();
        } catch (\PDOException $ex) {
            $this->connection->rollBack();
            echo $ex->getMessage();
        }
    }

    private function getStateId(string $name): int
    {
        try {
            $stateService = New StateService();
            $state = $stateService->getByField(array('name' => "{$name}"));
            if (!empty($state))
                return $state[0]['id'];
            $stateService->create(array("name" => $name));
            $this->connection->commit();
            return $this->connection->lastInsertId();
        } catch (\PDOException $ex) {
            $this->connection->rollBack();
            echo $ex->getMessage();
        }
    }

    public function validateFields(array $data, array $required_fields)
    {
        foreach ($required_fields as $field){
            if (!isset($data[$field])) {
                $exception = new UnprocessableEntityException();
                $exception->setMessage(array("Mandatory" => $required_fields));
                throw $exception;
            }
        }

    }


    public function getAll()
    {
        $repository = new UserRepository();
        $sql = $repository->getAllUsers();
        $data = $this->connection->query($sql);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(array $data)
    {
        $id = $data['id'];
        $user = $this->get($id);
        $content = $data['content'];
        $userRepository = new UserRepository();
        $sql = $userRepository->updateUser($user, $content);
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function get(int $id)
    {
        try {
            $connection = Connection::getInstance();
            $repository = new UserRepository();
            $sql = $repository->getUserById($id);
            $data = $connection->query($sql);
            $content = $data->fetch(PDO::FETCH_ASSOC);
            if (!isset($content))
                throw new NotFoundException();
        } catch (\PDOException $ex) {
            throw $ex;
        }
        return $content;
    }

    public function getByName(string $name)
    {
        // TODO: Implement getByName() method.
    }

    public function getOrCreate(array $data): array
    {
        return [];
    }
}