<?php

namespace App\Service;

interface IService {
    public function getOne(int $data);
    public function getAll();
    public function create(array $data);
    public function update(array $data);
    public function delete(int $id);
}