<?php


namespace App\Entities;


use App\DataBase\Connection;

class User extends Entity implements IRegister
{
    protected int $id;
    protected string $name;
    protected Address $address;

    public function __construct()
    {
        $this->table = 'user';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $this->name = trim($name);
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function add(): void
    {
        $connection = Connection::getInstance();
        $sql = "INSERT INTO {$this->table} (name, address_id) ";
        $sql .= "VALUES ('{$this->name}', '{$this->getAddress()->getId()}')";
        $connection->exec($sql);
        $this->id = $connection->lastInsertId();
    }

    public function update(): void
    {
        // TODO: Implement update() method.
    }

    public function delete(): void
    {
        // TODO: Implement delete() method.
    }

    public function build(array $data)
    {
        // TODO: Implement build() method.
    }
}