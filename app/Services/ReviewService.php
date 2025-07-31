<?php

namespace App\Services;

use App\Contracts\ReviewRepositoryInterface;
use App\Models\Review;
use Illuminate\Support\Facades\Request;

class ReviewService
{

    public function __construct(private ReviewRepositoryInterface $reviewRepository) {}

    public function create(array $data): Review
    {
        $data = [
            'user_id' => data_get($data, 'user_id', Request::user()->id),
            'place_id' => data_get($data, 'place_id'),
            'rating' => data_get($data, 'rating'),
            'comment' => data_get($data, 'comment'),
            'created_by' => Request::user()->id,
        ];

        return $this->reviewRepository->create($data);
    }

    public function delete(Review $review, array $data = []): bool
    {
        $data = [
            'deleted_by' => Request::user()->id,
        ];

        return $this->reviewRepository->delete($review, $data);
    }

    public function update($review, array $data): bool
    {
        $data = [
            'rating' => data_get($data, 'rating'),
            'comment' => data_get($data, 'comment'),
            'updated_by' => Request::user()->id,
        ];

        return $this->reviewRepository->update($review, $data);
    }

    public function getReviewsByPlace(int $placeId, array $requestParams = [])
    {
        $perPage = $requestParams['per_page'] ?? 5;

        return $this->reviewRepository->findByPlace($placeId, $perPage);
    }
}
