<?php


namespace App\Entities;


class Address extends Entity implements IRegister
{

    protected string $table = 'address';
    public int $id;
    private string $street;
    private int $number;
    private State $state;
    private City $city;

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
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $street = filter_input(INPUT_POST, $street, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->street = $street;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @param State $state
     */
    public function setState(State $state): void
    {
        $this->state = $state;
    }

    /**
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @param City $city
     */
    public function setCity(City $city): void
    {
        $this->city = $city;
    }

    public function add(): void
    {
        $connection = Connection::getInstance();
        $sql = "INSERT INTO {$this->table} (street, number, state_id, city_id)";
        $sql .= " VALUES ('{$this->street}', '{$this->number}'";
        $sql .= ", '{$this->getState()->getId()}', '{$this->getCity()->getId()}')";
        $connection->exec(sql);
        $this->id = $connection->lastInsertId();
    }

    public function update(): void
    {
        $connection = Connection::getInstance();
        $sql = "UPDATE {$this->table} SET street='{$this->getStreet()}', ";
        $sql .= "number='{$this->getNumber()}', state_id='{$this->getState()->getId()}', ";
        $sql .= "city_id='{$this->getCity()->getId()}'";
        $connection->exec(sql);
    }

    public function delete(): void
    {
        $connection = Connection::getInstance();
        $sql = "DELETE FROM {self::table} WHERE id={$this->getId()}";
        $connection->exec(sql);
    }

    public function build(array $data)
    {
        $this->id = data['id'];
        $this->setStreet($data['street']);
        $this->setNumber($data['number']);
    }
}