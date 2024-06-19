<?php

namespace App\Http\Controllers;

use App\Http\Requests\BicycleRequest;
use App\Models\Bicycle;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class BicycleController extends Controller
{

    public function index(Request $request): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $search = $request->query('search');

        $bicycles = Bicycle::where('bicycles.name', 'like', '%' . $search . '%')
            ->orWhere('bicycles.serial_number', 'like', '%' . $search . '%')
            ->paginate(25);

        return view('admin.bicycle.index', [
            'bicycles' => $bicycles,
        ]);
    }

    public function create(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $bicycle = new Bicycle();
        return view('admin.bicycle.create', [
            'bicycle' => $bicycle
        ]);
    }

    public function store(BicycleRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);
        $bicycle = Bicycle::create($validated);
        return Redirect::route('bicycle.index');
    }

    public function show(string $id): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('admin.bicycle.show');
    }

    public function edit(Bicycle $bicycle): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('admin.bicycle.edit', [
            'bicycle' => $bicycle,
        ]);
    }

    public function update(BicycleRequest $request, Bicycle $bicycle)
    {
        $bicycle->update($request->validated());
        return Redirect::route('bicycle.index')->with('success', 'Le vélo a bien été modifié');
    }

    public function destroy(Bicycle $bicycle)
    {
        $bicycle->delete();
        return to_route('bicycle.index')->with('success', 'Le vélo a bien été supprimé');
    }
}
