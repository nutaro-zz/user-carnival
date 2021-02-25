<?php


namespace App\Entities;


interface IBuild
{
    public static function getByField(array $values, string $table);
}