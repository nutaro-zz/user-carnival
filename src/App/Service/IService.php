<?php

namespace App\Service;

interface IService {
    public function create(array $data);
    public function getById(int $id);
    public function getByName(string $name);
}