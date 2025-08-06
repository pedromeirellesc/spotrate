<?php

namespace App\Contracts;

use App\Models\Review;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ReviewRepositoryInterface
{
    public function create(array $data): Review;

    public function update(Review $review, array $data): bool;

    public function delete(Review $review, array $data = []): bool;

    public function findByPlace(int $placeId, int $perPage = 10): LengthAwarePaginator;

    public function findById(int $id): Review;
}
