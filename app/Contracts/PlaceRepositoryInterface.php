<?php

namespace App\Contracts;

use App\Models\Place;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PlaceRepositoryInterface
{
    public function create(array $data): Place;

    public function update(Place $place, array $data): bool;

    public function delete(Place $place, array $data = []): bool;

    public function findById(int $id): Place;

    public function findAll(array $requestParams = []): LengthAwarePaginator;
}
