<?php

use App\Contracts\ReviewRepositoryInterface;
use App\Models\User;
use App\Services\ReviewService;
use Illuminate\Support\Facades\Request;
use App\Models\Review;
use Illuminate\Pagination\LengthAwarePaginator;

beforeEach(function () {
    $this->mockedRepository = mock(ReviewRepositoryInterface::class);
    $this->service = new ReviewService($this->mockedRepository);

    $user = new User();
    Request::shouldReceive('user')->andReturn($user);
});

test('createReview should create a review', function () {

    $inputData = [
        'place_id' => 1,
        'user_id' => 1,
        'rating' => 5,
        'comment' => 'Great place!',
    ];

    $expectedData = $inputData + ['created_by' => Request::user()->id];

    $fakeReview = (new Review())->forceFill($expectedData);

    $this->mockedRepository
        ->shouldReceive('create')
        ->once()
        ->with($expectedData)
        ->andReturn($fakeReview);

    $result = $this->service->create($inputData);

    expect($result)->toBeInstanceOf(Review::class);
    expect($result->place_id)->toBe($inputData['place_id']);
    expect($result->user_id)->toBe($inputData['user_id']);
    expect($result->rating)->toBe($inputData['rating']);
    expect($result->comment)->toBe($inputData['comment']);
});

test('deleteReview should delete a review', function () {

    $review = Mockery::mock(Review::class)->makePartial();

    $this->mockedRepository
        ->shouldReceive('delete')
        ->once()
        ->with($review, ['deleted_by' => Request::user()->id])
        ->andReturn(true);

    $result = $this->service->delete($review);

    expect($result)->toBeTrue();
});

test('updateReview should update a review', function () {

    $review = Mockery::mock(Review::class)->makePartial();

    $this->mockedRepository
        ->shouldReceive('update')
        ->once()
        ->with($review, [
            'rating' => null,
            'comment' => null,
            'updated_by' => Request::user()->id,
        ])
        ->andReturn(true);

    $result = $this->service->update($review, []);

    expect($result)->toBeTrue();
});

test('getReviewsByPlace should return reviews by place', function () {

    $placeId = 1;
    $perPage = 5;

    $this->mockedRepository
        ->shouldReceive('findByPlace')
        ->once()
        ->with($placeId, $perPage)
        ->andReturn(new LengthAwarePaginator([], 0, $perPage, 1));

    $result = $this->service->getReviewsByPlace($placeId);

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class);
});

test('getReviewById should return a review', function () {

    $reviewId = 1;

    $this->mockedRepository
        ->shouldReceive('findById')
        ->once()
        ->with($reviewId)
        ->andReturn(new Review());

    $result = $this->service->getReviewById($reviewId);

    expect($result)->toBeInstanceOf(Review::class);
});
