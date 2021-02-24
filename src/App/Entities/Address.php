<?php


namespace App\Entities;


class Address implements IRegister
{

    private string $table;
    public int $id;
    private string $street;
    private string $complement;
    private int $number;
    private State $state;
    private City $city;

    public function __construct(){
        $this->table = 'address';
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
     * @return string
     */
    public function getComplement(): string
    {
        return $this->complement;
    }

    /**
     * @param string $complement
     */
    public function setComplement(string $complement): void
    {
        $complement = filter_input(INPUT_POST, $complement, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->complement = $complement;
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
        // TODO: Implement add() method.
    }

    public function update(): void
    {
        // TODO: Implement update() method.
    }

    public function delete(): void
    {
        // TODO: Implement delete() method.
    }

    public static function getByField(array $values)
    {
        // TODO: Implement getByField() method.
    }
}