<?php

namespace App\Http\Controllers;

use App\Http\Requests\BicycleRequest;
use App\Models\Bicycle;
use App\Models\Location;
use App\Models\Repair;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        $repairs = Repair::pluck('type', 'id');
        $locations = Location::orderBy('name', 'asc')->get();
        return view('admin.bicycle.create', [
            'bicycle' => $bicycle,
            'repairs' => $repairs,
            'locations' => $locations,
        ]);
    }

    public function store(BicycleRequest $request)
    {
        Validator::make($request->all(), ['name' => Rule::unique(Bicycle::class)], ['unique' => 'Le vélo existe déjà'])->validate();
        $validated = $request->validated();
        if($request->validated('picture')) {
            $filename = Storage::disk('public')->put('bike', $request->validated('picture'));
            $validated['picture'] = $filename;
        }
        if($request->validated('qr_code')) {
            $qrcode = Storage::disk('public')->put('qrcode', $request->validated('qr_code'));
            $validated['qr_code'] = $qrcode;
        }
        $validated['slug'] = Str::slug($validated['name']);
        $validated['ref_number'] = uniqid('', true);
        $bicycle = Bicycle::create($validated);
        $bicycle->location()->associate($request->validated('location'))->save();
        $bicycle->repairs()->sync($request->validated('repairs'));
        return Redirect::route('bicycle.index');
    }

    public function show(Bicycle $bicycle): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('admin.bicycle.show', [
            'bicycle' => $bicycle,
        ]);
    }

    public function edit(Bicycle $bicycle): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $repairs = Repair::pluck('type', 'id');
        $locations = Location::all();
        return view('admin.bicycle.edit', [
            'bicycle' => $bicycle,
            'repairs' => $repairs,
            'locations' => $locations,
        ]);
    }

    public function update(BicycleRequest $request, Bicycle $bicycle)
    {
        Validator::make($request->all(), ['name' => Rule::unique(Bicycle::class)->ignore($bicycle)], ['unique' => 'Le vélo existe déjà'])->validate();
        $validated = $request->validated();
        if(!$bicycle->ref_number) {
            $validated['ref_number'] = uniqid('', true);
        }
        if($request->validated('picture')) {
            if($bicycle->picture) {
                Storage::disk('public')->delete($bicycle->picture);
            }
            $filename = Storage::disk('public')->put('bike', $request->validated('picture'));
            $validated['picture'] = $filename;
        }
        if($request->validated('qr_code')) {
            if($bicycle->qr_code) {
                Storage::disk('public')->delete($bicycle->qr_code);
            }
            $qr_code = Storage::disk('public')->put('qrcode', $request->validated('qr_code'));
            $validated['qr_code'] = $qr_code;
        }
        $bicycle->update($validated);
        $bicycle->location()->associate($request->validated('location'))->save();
        $bicycle->repairs()->sync($request->validated('repairs'));
        return Redirect::route('bicycle.index')->with('success', 'Le vélo a bien été modifié');
    }

    public function destroy(Bicycle $bicycle)
    {
        if($bicycle->picture) {
            Storage::disk('public')->delete($bicycle->picture);
        }
        if($bicycle->qr_code) {
            Storage::disk('public')->delete($bicycle->qr_code);
        }
        $bicycle->delete();
        return to_route('bicycle.index')->with('success', 'Le vélo a bien été supprimé');
    }
}
