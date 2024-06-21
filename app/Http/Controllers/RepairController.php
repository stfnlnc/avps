<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepairRequest;
use App\Models\Repair;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RepairController extends Controller
{
    public function index(Request $request): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $search = $request->query('search');
        $repairs = Repair::where('repairs.type', 'like', '%' . $search . '%')
            ->orderBy('repairs.type', 'asc')
            ->paginate(25);

        return view('admin.repair.index', [
            'repairs' => $repairs,
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
        Validator::make($request->all(), ['name' => Rule::unique(Repair::class)], ['unique' => 'Le type de réparation existe déjà'])->validate();
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['type']);
        $repair = Repair::create($validated);
        return Redirect::route('repair.index');
    }

    public function edit(Repair $repair): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('admin.repair.edit', [
            'repair' => $repair,
        ]);
    }

    public function update(RepairRequest $request, Repair $repair)
    {
        Validator::make($request->all(), ['name' => Rule::unique(Repair::class)->ignore($repair)], ['unique' => 'Le vélo existe déjà'])->validate();
        $repair->update($request->validated());
        return Redirect::route('repair.index')->with('success', 'Le type de réparation a bien été modifié');
    }

    public function destroy(Repair $repair)
    {
        try {
            $repair->delete();
            return to_route('repair.index')->with('success', 'Le type de réparation a bien été supprimé');
        } catch (\Exception $e) {
            return to_route('repair.index')->with('danger', 'Ce type de réparation est lié à des vélos et ne peut pas être supprimé');
        }
    }
}
