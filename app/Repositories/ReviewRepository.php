<?php

namespace App\Repositories;

use App\Contracts\ReviewRepositoryInterface;
use App\Models\Review;
use Illuminate\Pagination\LengthAwarePaginator;

class ReviewRepository implements ReviewRepositoryInterface {

    public function __construct(private Review $review) {}

    public function create(array $data): Review {
        return $this->review->create($data);
    }

    public function update(Review $review, array $data): bool {
        return $review->update($data);
    }

    public function delete(Review $review, array $data = []): bool {
        return $review->delete($data);
    }

    public function findByPlace(int $placeId, int $perPage = 5): LengthAwarePaginator
    {
        return $this->review
            ->where('place_id', $placeId)
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
