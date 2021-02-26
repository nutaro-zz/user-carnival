<?php

namespace App\Service;

interface IService {
    public function create(array $data);
    public function get(int $id);
    public function getByName(string $name);
}