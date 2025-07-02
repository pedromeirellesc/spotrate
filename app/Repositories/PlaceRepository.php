<?php

namespace App\Repositories;

use App\Contract\PlaceRepositoryInterface;
use App\Models\Place;

class PlaceRepository implements PlaceRepositoryInterface
{

    public function __construct(private Place $place) {}

    public function create(array $data)
    {
        return $this->place->create($data);
    }

    public function update($place, array $data)
    {
        return $place->update($data);
    }

    public function delete($place, array $data = [])
    {
        return $place->delete($data);
    }

    public function findById(int $id)
    {
        return $this->place->findOrFail($id);
    }

    public function findAll(array $requestParams = [])
    {
        $perPage = $requestParams['per_page'] ?? 10;

        return $this->place->paginate($perPage);
    }
}
