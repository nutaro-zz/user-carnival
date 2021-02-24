<?php

namespace App\Service;

interface IService {
    public function create(array $data);
    public function getById();
}