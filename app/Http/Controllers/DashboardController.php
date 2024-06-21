<?php

namespace App\Http\Controllers;

use App\Models\Bicycle;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $locations = DB::table('locations')
            ->join('bicycles', 'locations.id', '=', 'bicycles.location_id')
            ->groupBy('bicycles.location_id')
            ->selectRaw('locations.*, COUNT(bicycles.location_id) as location_count')
            ->get();

        $repaired = DB::table('locations')
            ->join('bicycles', 'locations.id', '=', 'bicycles.location_id')
            ->where('bicycles.end_date', '<', date('Y-m-d'))
            ->groupBy('bicycles.location_id')
            ->selectRaw('locations.*, COUNT(bicycles.location_id) as location_count')
            ->get();

        $progress = DB::table('locations')
            ->join('bicycles', 'locations.id', '=', 'bicycles.location_id')
            ->where('bicycles.start_date', '<', date('Y-m-d'))
            ->where('bicycles.end_date', '>', date('Y-m-d'))
            ->orWhere('bicycles.end_date', '=', null)
            ->groupBy('bicycles.location_id')
            ->selectRaw('locations.*, COUNT(bicycles.location_id) as location_count')
            ->get();

        $delivered = DB::table('locations')
            ->join('bicycles', 'locations.id', '=', 'bicycles.location_id')
            ->where('bicycles.delivery_status', '=', true)
            ->groupBy('bicycles.location_id')
            ->selectRaw('locations.*, COUNT(bicycles.location_id) as location_count')
            ->get();

        return view('admin.dashboard', [
            'locations' => $locations,
            'repaired' => $repaired,
            'progress' => $progress,
            'delivered' => $delivered,
        ]);
    }
}
