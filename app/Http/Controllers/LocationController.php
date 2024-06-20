<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use App\Models\Repair;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    public function index(Request $request): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $search = $request->query('search');

        $locations = Location::where('locations.name', 'like', '%' . $search . '%')
            ->paginate(25);

        return view('admin.location.index', [
            'locations' => $locations,
        ]);
    }

    public function create(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $location = new location();

        return view('admin.location.create', [
            'location' => $location
        ]);
    }

    public function store(locationRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);
        $location = Location::create($validated);
        return Redirect::route('location.index');
    }

    public function show(string $id): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('admin.location.show');
    }

    public function edit(Location $location): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('admin.location.edit', [
            'location' => $location,
        ]);
    }

    public function update(LocationRequest $request, location $location)
    {
        $location->update($request->validated());
        return Redirect::route('location.index')->with('success', 'Le type de réparation a bien été modifié');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return to_route('location.index')->with('success', 'Le type de réparation a bien été supprimé');
    }
}
