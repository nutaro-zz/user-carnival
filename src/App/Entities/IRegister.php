<?php


namespace App\Entities;


interface IRegister
{
    public function add(): void;
    public function update(): void;
    public function delete(): void;
    public function build(array $data);
}