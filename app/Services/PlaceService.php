<?php

namespace App\Services;

use App\Contract\PlaceRepositoryInterface;
use Illuminate\Support\Facades\Request;

class PlaceService
{

    public function __construct(private PlaceRepositoryInterface $placeRepository) {}

    public function getAllPlaces(array $requestParams = [])
    {
        return $this->placeRepository->findAll($requestParams);
    }

    public function createPlace(array $data)
    {
        $userData = [
            'name' => data_get($data, 'name'),
            'description' => data_get($data, 'description'),
            'address' => data_get($data, 'address'),
            'city' => data_get($data, 'city'),
            'state' => data_get($data, 'state'),
            'country' => data_get($data, 'country'),
            'instagram' => data_get($data, 'instagram'),
            'whatsapp' => data_get($data, 'whatsapp'),
            'website' => data_get($data, 'website'),
            'created_by' => Request::user()->id,
        ];

        return $this->placeRepository->create($userData);
    }

    public function updatePlace($place, array $data)
    {
        $userData = [
            'name' => data_get($data, 'name'),
            'description' => data_get($data, 'description'),
            'address' => data_get($data, 'address'),
            'city' => data_get($data, 'city'),
            'state' => data_get($data, 'state'),
            'country' => data_get($data, 'country'),
            'instagram' => data_get($data, 'instagram'),
            'whatsapp' => data_get($data, 'whatsapp'),
            'website' => data_get($data, 'website'),
            'updated_by' => Request::user()->id,
        ];

        return $this->placeRepository->update($place, $userData);
    }

    public function deletePlace($place)
    {
        $userData = [
            'deleted_by' => Request::user()->id,
        ];

        return $this->placeRepository->delete($place, $userData);
    }
}
