<?php

namespace App\Service;

interface IService {
    public function get(int $id);
    public function getAll();
    public function getOrCreate(array $data): array;
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);
}