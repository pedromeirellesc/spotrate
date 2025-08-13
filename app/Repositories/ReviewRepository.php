<?php

namespace App\Repositories;

use App\Contracts\ReviewRepositoryInterface;
use App\Models\Review;
use App\Traits\CacheableRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ReviewRepository implements ReviewRepositoryInterface
{
    use CacheableRepository;

    public function __construct(private Review $review)
    {
    }

    public function create(array $data): Review
    {
        return $this->review->create($data);
    }

    public function update(Review $review, array $data): bool
    {
        return $review->update($data);
    }

    public function delete(Review $review, array $data = []): bool
    {
        return $review->delete($data);
    }

    public function findByPlace(int $placeId, int $perPage = 5, int $page = 1): LengthAwarePaginator
    {
        $cacheKey = $this->makeCacheKey('reviews_by_place_id', [
            'place_id' => $placeId,
            'per_page' => $perPage,
            'page' => $page,
        ]);

        $cacheTags = [Review::class];

        $cachedData = $this->remember($cacheKey, 3600, function () use ($placeId, $perPage, $page) {
            $query = $this->review
                ->where('place_id', $placeId)
                ->with(['user'])
                ->orderBy('created_at', 'desc');

            $paginator = $query->paginate($perPage, ['*'], 'page', $page);

            return [
                'data' => $paginator->items(),
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
            ];
        }, $cacheTags);

        return new LengthAwarePaginator(
            collect($cachedData['data']),
            $cachedData['total'],
            $cachedData['per_page'],
            $cachedData['current_page'],
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    }

    public function findById(int $id): Review
    {
        $cacheKey = $this->makeCacheKey('review', $id);

        return $this->remember($cacheKey, 3600, function () use ($id) {
            return $this->review->with([
                'user',
                'place' => fn ($query) => $query->withAvg('reviews', 'rating'),
            ])->findOrFail($id);
        }, [Review::class]);
    }
}
