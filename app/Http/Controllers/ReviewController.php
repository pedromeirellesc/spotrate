<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Place;
use App\Services\ReviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function __construct(private ReviewService $reviewService)
    {
    }

    public function create(Place $place): View
    {
        $this->authorize('create', [Review::class, $place]);

        return view('reviews.create', ['place' => $place]);
    }

    public function selectPlace(): View
    {
        return view('reviews.select-place');
    }

    public function store(ReviewRequest $request): RedirectResponse
    {
        $place = Place::findOrFail($request->input('place_id'));
        $this->authorize('create', [Review::class, $place]);

        $review = $this->reviewService->create($request->validated());

        return redirect()->route('places.show', $review->place_id)
            ->with('success', 'Review created successfully.');
    }

    public function edit(int $id): View
    {
        $review = $this->reviewService->getReviewById($id);

        $this->authorize('update', $review);

        return view('reviews.edit', ['review' => $review]);
    }

    public function update(ReviewRequest $request, int $id): RedirectResponse
    {
        $review = $this->reviewService->getReviewById($id);

        $this->authorize('update', $review);

        $this->reviewService->update($review, $request->validated());

        return redirect()->route('places.show', $review->place_id)
            ->with('success', 'Review updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $review = $this->reviewService->getReviewById($id);

        $this->authorize('delete', $review);

        $this->reviewService->delete($review);

        return redirect()->route('places.show', $review->place_id)
            ->with('success', 'Review deleted successfully.');
    }
}
