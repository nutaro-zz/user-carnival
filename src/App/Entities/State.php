<?php


namespace App\Entities;


use App\DataBase\Connection;


class State extends Entity implements IRegister
{

    protected static string $table = 'state';
    private int $id;
    private string $name;


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
        $name = filter_input(INPUT_POST, $name, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->name = trim($name);
    }


    public function add(): void
    {
        $connection = Connection::getInstance();
        $connection->exec("INSERT INTO state (name) VALUES ('{$this->name}')");
        $this->id = $connection->lastInsertId();
    }

    public function update(): void
    {
        if (!isset($this->id))
            return;
        $connection = Connection::getInstance();
        $connection->exec("UPDATE state SET name = '{$this->name}' WHERE id='{$this->id}'");
    }

    public function delete(): void
    {
        $connection = Connection::getInstance();
        $connection->exec("DELETE FROM state WHERE id='$this->id'");
    }

    public function build(array $data)
    {
        $this->id = $data['id'];
        $this->setName($data['name']);
    }
}