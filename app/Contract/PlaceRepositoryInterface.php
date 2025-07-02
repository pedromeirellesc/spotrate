<?php

namespace App\Contract;

use App\Models\Place;

interface PlaceRepositoryInterface
{
    public function create(array $data);

    public function update(Place $place, array $data);

    public function delete(Place $place, array $data = []);

    public function findById(int $id);

    public function findAll(array $requestParams = []);
}