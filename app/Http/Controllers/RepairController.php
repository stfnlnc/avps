<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepairRequest;
use App\Models\Repair;
use Illuminate\Console\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\Factory;
use View;

class RepairController extends Controller
{
    public function index(Request $request): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $search = $request->query('search');

        $repair = Repair::where('repair.type', 'like', '%' . $search . '%')
            ->paginate(25);

        return view('admin.repair.index', [
            'repair' => $repair,
        ]);
    }

    public function create(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $repair = new Repair();
        return view('admin.repair.create', [
            'repair' => $repair
        ]);
    }

    public function store(RepairRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['type']);
        $repair = Repair::create($validated);
        return Redirect::route('repair.index');
    }

    public function show(string $id): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('admin.repair.show');
    }

    public function edit(Repair $repair): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('admin.repair.edit', [
            'repair' => $repair,
        ]);
    }

    public function update(RepairRequest $request, Repair $repair)
    {
        $repair->update($request->validated());
        return Redirect::route('repair.index')->with('success', 'Le type de réparation a bien été modifié');
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();
        return to_route('repair.index')->with('success', 'Le type de réparation a bien été supprimé');
    }
}
