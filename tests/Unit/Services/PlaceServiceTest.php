<?php

use App\Contracts\PlaceRepositoryInterface;
use App\Models\Place;
use App\Models\User;
use App\Services\PlaceService;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

beforeEach(function () {
    $this->mockedRepository = mock(PlaceRepositoryInterface::class);
    $this->service = new PlaceService($this->mockedRepository);

    $user = new User();
    Request::shouldReceive('user')->andReturn($user);
});

test('getPlaceById should return a place', function () {
    $placeId = 1;

    $fakePlace = new Place();
    $fakePlace->id = $placeId;
    $fakePlace->name = 'Fake Place';

    $this->mockedRepository
        ->shouldReceive('findById')
        ->once()
        ->with($placeId)
        ->andReturn($fakePlace);

    $result = $this->service->getPlaceById($placeId);

    expect($result)->toBeInstanceOf(Place::class);
    expect($result->id)->toBe($fakePlace->id);
    expect($result->name)->toBe($fakePlace->name);
});

test('getPlaceId should throw an exception if the place does not exist ', function () {
    $placeId = 999;

    $this->mockedRepository
        ->shouldReceive('findById')
        ->once()
        ->with($placeId)
        ->andThrow(ModelNotFoundException::class);

    $this->expectException(ModelNotFoundException::class);

    $this->service->getPlaceById($placeId);
});

test('getAllPlaces should return all places', function () {

    $place1 = new Place(['id' => 1, 'name' => 'Place 1']);
    $place2 = new Place(['id' => 2, 'name' => 'Place 2']);

    $items = collect([$place1, $place2]);
    $total = $items->count();
    $perPage = 10;
    $currentPage = 1;
    $path = '/';

    $paginator = new LengthAwarePaginator($items, $total, $perPage, $currentPage, [
        'path' => $path,
    ]);

    $this->mockedRepository
        ->shouldReceive('findAll')
        ->once()
        ->andReturn($paginator);

    $result = $this->service->getAllPlaces();

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class);
    expect($result->count())->toBe($items->count());
});

test('createPlace should create a place', function () {

    $inputData = [
        'name' => 'Place',
        'description' => 'A description',
        'address' => 'Address',
        'instagram' => '@place',
        'whatsapp' => '11999999999',
        'website' => 'https://place.com',
    ];

    $expectedData = $inputData + ['created_by' => Request::user()->id];

    $fakePlace = (new Place())->forceFill($expectedData);

    $this->mockedRepository
        ->shouldReceive('create')
        ->once()
        ->with($expectedData)
        ->andReturn($fakePlace);

    $result = $this->service->createPlace($inputData);

    expect($result)->toBeInstanceOf(Place::class);
    expect($result->name)->toBe($inputData['name']);
    expect($result->created_by)->toBe(Request::user()->id);
});

test('updatePlace should update a place', function () {

    $place = new Place();
    $place->name = 'Place';
    $place->description = 'A description';

    $inputData = [
        'name' => 'Updated Place',
        'description' => 'A updated description',
        'address' => 'Address',
        'instagram' => '@place',
        'whatsapp' => '11999999999',
        'website' => 'https://place.com',
    ];

    $userData = $inputData + ['updated_by' => Request::user()->id];

    $this->mockedRepository
        ->shouldReceive('update')
        ->once()
        ->with($place, $userData)
        ->andReturn(true);

    $result = $this->service->updatePlace($place, $inputData);

    expect($result)->toBeTrue();
});

test('deletePlace should delete a place', function () {

    $place = new Place();
    $place->name = 'Place';
    $place->description = 'A description';

    $userData = [
        'deleted_by' => Request::user()->id,
    ];

    $this->mockedRepository
        ->shouldReceive('delete')
        ->once()
        ->with($place, $userData)
        ->andReturn(true);

    $result = $this->service->deletePlace($place);

    expect($result)->toBeTrue();
});

test('show should return a place with loaded relationships', function () {
    $place = Mockery::mock(Place::class)->makePartial();

    $place->name = 'Place';
    $place->description = 'A description';

    $place->shouldReceive('load')
        ->once()
        ->with(['reviews'])
        ->andReturnSelf();

    $place->shouldReceive('loadAvg')
        ->once()
        ->with('reviews', 'rating')
        ->andReturnSelf();

    $result = $this->service->show($place);

    expect($result)->toBeInstanceOf(Place::class);
    expect($result->name)->toBe($place->name);
    expect($result->description)->toBe($place->description);
});
