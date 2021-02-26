<?php


namespace App\Entities;


use App\DataBase\Connection;


class City extends Entity implements IRegister
{
    private int $id;
    private string $name;
    private State $state;

    public function __construct()
    {
        $this->table = 'city';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $this->name = trim($name);
    }

    public function getState(): State
    {
        return $this->state;
    }

    public function setState(State $state): void
    {
        $this->state = $state;
    }


    public function add(): void
    {
        $connection = Connection::getInstance();
        $connection->exec("INSERT INTO {$this->table} (name, state_id) VALUES ('{$this->name}', {$this->getState()->getId()})");
        $this->id = $connection->lastInsertId();
    }

    public function update(): void
    {
        if (!isset($this->id))
            return;
        $connection = Connection::getInstance();
        $connection->exec("UPDATE {$this->table} SET name = \"{$this->name}\" WHERE id=\"{$this->id}\"");
    }

    public function delete(): void
    {
        $connection = Connection::getInstance();
        $connection->exec("DELETE FROM {$this->table} WHERE id=\"$this->id\"");
    }

    public function build(array $data)
    {
        $this->id = $data['id'];
        $this->setName($data['name']);
    }
}