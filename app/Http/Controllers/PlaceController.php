<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Models\Place;
use App\Services\PlaceService;
use App\Services\ReviewService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlaceController extends Controller
{

    use AuthorizesRequests;

    public function __construct(private PlaceService $placeService, private ReviewService $reviewService)
    {
    }

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Place::class);

        $places = $this->placeService->getAllPlaces($request->all());

        return view('places.index', ['places' => $places]);
    }

    public function create(): View
    {
        $this->authorize('create', Place::class);

        return view('places.create');
    }

    public function search(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Place::class);

        $search = $request->get('q');

        $places = Place::where('name', 'LIKE', '%' . $search . '%')
            ->limit(10)
            ->get(['id', 'name']);

        return response()->json($places);
    }

    public function store(PlaceRequest $request): RedirectResponse
    {
        $this->authorize('create', Place::class);

        $this->placeService->createPlace($request->validated());

        return redirect()->route('places.index');
    }

    public function show(Place $place, Request $request): View
    {
        $this->authorize('view', $place);

        $place = $this->placeService->show($place);
        $reviews = $this->reviewService->getReviewsByPlace($place->id, $request->all());

        return view('places.show', [
            'place' => $place,
            'reviews' => $reviews
        ]);
    }

    public function edit(Place $place): View
    {
        $this->authorize('update', $place);

        return view('places.edit', ['place' => $place]);
    }

    public function update(PlaceRequest $request, Place $place): RedirectResponse
    {
        $this->authorize('update', $place);

        $validatedData = $request->validated();

        $this->placeService->updatePlace($place, $validatedData);

        return redirect()->route('places.index');
    }

    public function destroy(Place $place): RedirectResponse
    {
        $this->authorize('delete', $place);

        $this->placeService->deletePlace($place);

        return redirect()->route('places.index');
    }
}
