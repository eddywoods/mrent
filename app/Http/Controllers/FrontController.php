<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\BuildingPhoto;
use App\Building;
use App\UnitPricing;

class FrontController extends Controller
{
    public function index()
    {
        // $houses = DB::table('buildings')
        // ->join('building_photos', function ($join) {
        //     $join->on('buildings.id', '=', 'building_photos.building_id');
        // })
        // ->get();
        
       $houses = Building::all();
       $houses->map(function ($h){
            return $h->photos = BuildingPhoto::where('building_id', $h->id)->get();
       });
    
        return view('welcome', ['houses' => $houses]);
    }

    public function getData()
    {
       $houses = Building::all();
       $houses->map(function ($h){
            return $h->photos = BuildingPhoto::where('building_id', $h->id)->get();
       });


       $houses->map(function($s){
        $s->address = $s->location;
        $s->latitude = $s->address_latitude;
        $s->longitude = $s->address_longitude;
        $s->title = $s->building_name;
        $s->imageB = "/Documents/Photos/".$s->photos[0]->image_url;
        $s->url = "more-info/".$s->id;
       });

       return response()->json($houses);
    
    }

    public function about()
    {
        return view('about-us');
    }

    public function listings()
    {
        $houses = Building::all();
       $houses->map(function ($h){
            return $h->photos = BuildingPhoto::where('building_id', $h->id)->get();
       });


       $houses->map(function($s){
        $s->address = $s->location;
        $s->latitude = $s->address_latitude;
        $s->longitude = $s->address_longitude;
        $s->title = $s->building_name;
        $s->imageB = "/Documents/Photos/".$s->photos[0]->image_url;
        $s->pricing = UnitPricing::where('building_id', $s->id)->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')->get();
       });


       return view('property-listings', ['houses' => $houses]);
    }

    public function moreInfo($id)
    {

        $house = Building::where('buildings.id', $id)->first();
        $house->photos = BuildingPhoto::where('building_id', $house->id)->get();
        $house->units = UnitPricing::where('building_id', $house->id)->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')->get();
        $house->units->map(function($u){
            return $u->number_of_units = UnitPricing::where('building_id', $u->building_id)->sum('number_of_units');
        }); 
        // ->join('building_photos', 'buildings.id', '=', 'building_photos.building_id')
        // ->join('unit_pricings', 'buildings.id', '=', 'unit_pricings.building_id')
        // ->get();
      

        // dd($house);
 
 
        return view('listing-details', ['house' => $house]);
    }
}