<?php

namespace App\Repositories;

use App\Contracts\PlaceRepositoryInterface;
use App\Models\Place;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PlaceRepository implements PlaceRepositoryInterface
{
    public function __construct(private Place $place)
    {
    }

    public function create(array $data): Place
    {
        return $this->place->create($data);
    }

    public function update($place, array $data): bool
    {
        return $place->update($data);
    }

    public function delete($place, array $data = []): bool
    {
        return $place->delete($data);
    }

    public function findById(int $id): Place
    {
        return $this->place->findOrFail($id);
    }

    public function findAll(array $requestParams = []): LengthAwarePaginator
    {
        $perPage = $requestParams['per_page'] ?? 10;

        return $this->place->withAvg('reviews', 'rating')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

}
