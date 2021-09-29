<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitPricing;
use App\BuildingPhoto;
use DB;

class ReportsController extends Controller
{
    public function buildingReporting()
    {
        $buildings = DB::table('buildings')
        ->where('created_by', auth()->id())
        ->orWhere('owned_by', auth()->id())
        ->get();


         $buildings->map(function($b){
            $units = UnitPricing::where('building_id', $b->id)->sum('number_of_units');

             $b->number_of_units = $units;
             $b->photo = BuildingPhoto::where('building_id', $b->id)->get();

             return $b;
        });
       
        return view('landlord.reports.building.index', ['buildings' => $buildings]);
    }
}
