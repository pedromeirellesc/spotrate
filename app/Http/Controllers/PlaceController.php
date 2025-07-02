<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Models\Place;
use App\Services\PlaceService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class PlaceController extends Controller
{

    use AuthorizesRequests; 

    public function __construct(private PlaceService $placeService) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Place::class);

        $places = $this->placeService->getAllPlaces($request->all());
        return view('places.index', ['places' => $places]);
    }

    public function create()
    {
        $this->authorize('create', Place::class);
        
        return view('places.create');
    }

    public function store(PlaceRequest $request)
    {
        $this->authorize('create', Place::class);

        $validatedData = $request->validated();

        $this->placeService->createPlace($validatedData);

        return redirect()->route('places.index')->with('success', 'Place created successfully.');
    }

    public function show(Place $place)
    {
        $this->authorize('view', $place);

        return view('places.show', ['place' => $place]);
    }

    public function edit(Place $place)
    {
        $this->authorize('update', $place);

        return view('places.edit', ['place' => $place]);
    }

    public function update(PlaceRequest $request, Place $place)
    {
        $this->authorize('update', $place);

        $validatedData = $request->validated();

        $this->placeService->updatePlace($place, $validatedData);

        return redirect()->route('places.index')->with('success', 'Place updated successfully.');
    }

    public function destroy(Place $place)
    {
        $this->authorize('delete', $place);

        $this->placeService->deletePlace($place);

        return redirect()->route('places.index')->with('success', 'Place deleted successfully.');
    }
}
