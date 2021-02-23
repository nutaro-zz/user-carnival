<?php


namespace App\Service;


interface IByField
{
    public function getByField(string $field, $value);
}