<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\Building;
use App\UnitPricing;
use App\BuildingDocument;
use App\BuildingPhoto;
use App\BuildingLabel;

class CaretakerController extends Controller
{
    public function serviceRequests()
    {
        if (auth()->user()->created_by != null) {

            $usr = User::where('id', auth()->user()->created_by)->first();

            $requests = DB::table('service_requests')->select('service_requests.id as serviceid', 'request_title', 'building_name', 'unit_type_name', 'building_labels.label', 'service_requests.created_at')
            ->join('users', 'users.id', '=', 'users.created_by')
            ->join('buildings', 'buildings.id', '=', 'service_requests.building_id')
            ->join('building_labels', 'building_labels.id', '=', 'service_requests.unit_number')
            ->join('units', 'units.id', '=', 'service_requests.unit_id')
            ->where('buildings.created_by', $usr->id)
            ->orWhere('buildings.owned_by', $usr->id)->get();

            return view('caretaker.service-requests', ['requests' => $requests]);
        } else {

            toastr()->success('The owner of this service request was unidentified!');

            return redirect()->back();
        }
        
    }

    public function serviceRequestDetails($id)
    {

        if (auth()->user()->created_by != null) {

            $usr = User::where('id', auth()->user()->created_by)->first();

            $service_request = ServiceRequest::select('service_requests.id as serviceid', 'first_name','last_name', 'building_name', 'unit_type_name', 'building_labels.label', 'request_status', 'request_title', 'assigned_to', 'service_cost')
            ->join('buildings', 'buildings.id', '=', 'service_requests.building_id')
            ->join('units', 'units.id', '=', 'service_requests.unit_id')
            ->join('building_labels', 'building_labels.id', '=', 'service_requests.unit_number')
            ->join('users', 'users.id', '=', 'service_requests.created_by')
            ->where('buildings.created_by', $usr->id)
            ->where('service_requests.id', $id)->first();

            if ($service_request->assigned_to) {
                $service_request->vendor_first_name = DB::table('vendors')->where('id', $service_request->assigned_to)->first()->first_name;
                $service_request->vendor_last_name = DB::table('vendors')->where('id', $service_request->assigned_to)->first()->last_name;
            } else {
                $service_request->vendor_first_name = '';
                $service_request->vendor_last_name = '';
            }
            

            return view('caretaker.service-request-details', ['service_request' => $service_request]);

        } else {

            toastr()->success('The owner of this service request was unidentified!');

            return redirect()->back();
        }

    }


    public function vacateNotices()
    {

        if (auth()->user()->created_by != null) {

            $usr = User::where('id', auth()->user()->created_by)->first();

            $notices = DB::table('vacate_notices')->select('vacate_notices.id as noticeid', 'building_name', 'unit_type_name', 'label', 'vacate_notices.created_at', 'vacate_notice', 'first_name', 'last_name', 'id_number')
            ->join('users', 'users.id', '=', 'vacate_notices.tenant_id')
            ->join('tenant_houses', 'tenant_houses.account_number', '=', 'vacate_notices.account_number')
            ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
            ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
            ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
            ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
            ->where('buildings.created_by', $usr->id)->get();
    

            return view('caretaker.vacate-notices', ['notices' => $notices]);

        } else {

            toastr()->success('The owner of this vacate notice was unidentified!');

            return redirect()->back();
        }
       
    }


    public function listTenants()
    {
        $usr = User::where('id', auth()->user()->created_by)->first();

        $buildings = Building::where('created_by', $usr->id)->orWhere('owned_by', $usr->id)->get();

        $tenants = DB::table('tenant_houses')->select('users.id as userid', 'first_name', 'middle_name', 'last_name', 'id_number', 'phone_number', 'email', 'citizenship', 'users.created_at')
        ->join('users', 'users.id', '=', 'tenant_houses.tenant_id')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('caretaker_houses', 'buildings.id', '=', 'caretaker_houses.building_id')
        ->where('caretaker_houses.caretaker_id', auth()->id())
        ->get();

        return view('caretaker.list-tenants', ['tenants' => $tenants, 'buildings' => $buildings]);
    }


    public function getUnits($id)
    {
        $building = Building::where('id', $id)->first();

        $units = DB::table('unit_pricings')->select('unit_pricings.id as unitid', 'unit_type_name')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->where('building_id', $id)->get();

        $units['labels'] = BuildingLabel::where('building_id', $id)->get();
        

        return response()->json($units);
    }

    public function vacantHouseUnits()
    {

        $vacantunits = DB::table('unit_pricings')->select('unit_pricings.id as pricingid', 'buildings.building_name', 'units.unit_type_name', 'unit_pricings.unit_type_id', 'unit_pricings.building_id', 'unit_pricings.unit_price', 'unit_pricings.unit_deposit')
        ->join('buildings', 'buildings.id', '=', 'unit_pricings.building_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->join('caretaker_houses', 'buildings.id', '=', 'caretaker_houses.building_id')
        ->where('caretaker_houses.caretaker_id', auth()->id())
        ->get();


        $vacantunits->map(function($u){

            $total_units = UnitPricing::where('unit_type_id', $u->unit_type_id)
            ->where('unit_pricings.building_id', $u->building_id)
            ->sum('number_of_units');


            $taken_units = DB::table('tenant_houses')
            ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
            ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
            ->where('tenant_houses.building_id', $u->building_id)
            ->where('tenant_houses.pricing_id', $u->pricingid)
            ->where('tenant_houses.occupancy_status',  1)
            ->count();

           return $u->number_of_units = $total_units - $taken_units;

        });


        return view('caretaker.vacant-units', ['vacantunits' => $vacantunits]);
    }


    public function showBuilding($id)
    {
        $building = DB::table('buildings')->select('buildings.id as bid', 'building_name', 'contact_number', 'buildings.bank_id', 'location', 'invoicing_date', 'owned_by', 'account_number', 'buildings.created_at', 'bank_name', 'paybill_number', 'users.first_name', 'users.last_name', 'grouping_type')
        ->join('banks', 'banks.bank_id', '=', 'buildings.bank_id')
        ->join('users', 'users.id', '=', 'buildings.owned_by')
        ->where('buildings.id', $id)->first();


        $houseunits = DB::table('unit_pricings')
        ->join('buildings', 'buildings.id', '=', 'unit_pricings.building_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->where('buildings.id', $id)
        ->get();

        $houseunits->map(function($u){
           return $u->number_of_units = UnitPricing::where('unit_type_id', $u->unit_type_id)
           ->where('unit_pricings.building_id', $u->building_id)
           ->sum('number_of_units');
        });


        $bills = DB::table('bills')
            ->where('created_by', auth()->id())
            ->get();

        $mbills = DB::table('house_bills')
                    ->join('buildings', 'buildings.id', '=', 'house_bills.building_id')
                    ->join('bills', 'bills.id', '=', 'house_bills.bill_id')
                    ->where('house_bills.building_id', $id)->get();

        $tenants = DB::table('tenant_houses')
                    ->join('users', 'users.id', '=', 'tenant_houses.tenant_id')
                    ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
                    ->where('building_id', $id)->get();


        $caretakers = DB::table('caretaker_houses')
                    ->join('buildings', 'buildings.id', '=', 'caretaker_houses.building_id')
                    ->join('users', 'users.id', '=', 'caretaker_houses.caretaker_id')
                    ->where('buildings.id', $id)->get();


        $documents = BuildingDocument::where('building_id', $id)->get();

        $photos = BuildingPhoto::where('building_id', $id)->get();

        $labels = BuildingLabel::where('building_id', $id)->get();

        $units = DB::table('units')->select('units.id as unitid', 'units.unit_type_name')
                ->join('unit_pricings', 'units.id', '=', 'unit_pricings.unit_type_id')
                ->where('building_id', $id)->get();

    
        return view('caretaker.building-details', ['building' => $building, 'bills'=> $bills, 'mbills' => $mbills, 'tenants' => $tenants, 'documents' => $documents, 'photos' => $photos, 'labels' => $labels, 'units' => $units, 'houseunits' => $houseunits, 'caretakers' => $caretakers]);
    }



}
