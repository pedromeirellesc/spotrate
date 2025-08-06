<?php

namespace App\Services;

use App\Contracts\PlaceRepositoryInterface;
use App\Models\Place;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;

class PlaceService
{
    public function __construct(private PlaceRepositoryInterface $placeRepository)
    {
    }

    public function getPlaceById(int $id): Place
    {
        return $this->placeRepository->findById($id);
    }

    public function getAllPlaces(array $requestParams = []): LengthAwarePaginator
    {
        $places = $this->placeRepository->findAll($requestParams);

        return $places;
    }

    public function createPlace(array $data): Place
    {
        $userData = [
            'name' => data_get($data, 'name'),
            'description' => data_get($data, 'description'),
            'address' => data_get($data, 'address'),
            'instagram' => data_get($data, 'instagram'),
            'whatsapp' => data_get($data, 'whatsapp'),
            'website' => data_get($data, 'website'),
            'created_by' => Request::user()->id,
        ];

        return $this->placeRepository->create($userData);
    }

    public function updatePlace($place, array $data): bool
    {
        $userData = [
            'name' => data_get($data, 'name'),
            'description' => data_get($data, 'description'),
            'address' => data_get($data, 'address'),
            'instagram' => data_get($data, 'instagram'),
            'whatsapp' => data_get($data, 'whatsapp'),
            'website' => data_get($data, 'website'),
            'updated_by' => Request::user()->id,
        ];

        return $this->placeRepository->update($place, $userData);
    }

    public function deletePlace($place): bool
    {
        $userData = [
            'deleted_by' => Request::user()->id,
        ];

        return $this->placeRepository->delete($place, $userData);
    }

    public function show(Place $place)
    {
        $place = $place->load(['reviews']);
        $place->loadAvg('reviews', 'rating');

        return $place;
    }
}
