<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use DB;
use App\UnitPricing;
use App\Unit;
use App\Bank;

class AdminController extends Controller
{
    public function index ()
    {
       
    }

    public function listLandlords()
    {

        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $landlords = DB::table('user_role')
        ->join('users', 'users.id', '=', 'user_role.user_id')
        ->join('roles', 'roles.id', '=', 'user_role.role_id')
        ->where('roles.name', '=', 'landlord')
        ->where('users.created_by', auth()->id())
        ->get();

        return view('admin.manage-landlords', ['landlords' => $landlords, 'buildings' => $buildings]);
    }

    public function showLandlord($id) 
    {

    }

    public function adminListBuildings() 
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

         $buildings->map(function($b){
            $units = UnitPricing::where('building_id', $b->id)->sum('number_of_units');

             $b['number_of_units'] = $units;

             return $b;
        });

       
        return view('admin.list-buildings', ['buildings' => $buildings]);
    }

    public function showBuilding($id) 
    {
        $building = DB::table('buildings')->select('buildings.id as bid', 'building_name', 'contact_number', 'buildings.bank_id', 'location', 'invoicing_date', 'owned_by', 'account_number', 'buildings.created_at', 'bank_name', 'paybill_number', 'users.first_name', 'users.last_name')
        ->join('banks', 'banks.bank_id', '=', 'buildings.bank_id')
        ->join('users', 'users.id', '=', 'buildings.owned_by')
        ->where('buildings.id', $id)->first();

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

        return view('admin.building-details', ['building' => $building, 'bills'=> $bills, 'mbills' => $mbills, 'tenants' => $tenants]);
    }

    public function createB()
    {
        $units= Unit::all(); 

        $banks = Bank::all();

        return view('admin.create-building', ['banks' => $banks, 'units' => $units]);
    }

    public function listTenants()
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $tenants = DB::table('user_role')
            ->join('users', 'users.id', '=', 'user_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('roles.name', '=', 'tenant')->get();

        return view('admin.list-tenants', ['tenants' => $tenants, 'buildings' => $buildings]);
    }

    public function listAgents()
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $agents = DB::table('user_role')
            ->join('users', 'users.id', '=', 'user_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('roles.name', '=', 'agent')->get();

        return view('admin.list-agents', ['agents' => $agents, 'buildings' => $buildings]);
    }




    public function showTenant($id)
    {
        $tenant = DB::table('tenant_houses')
        ->join('users', 'users.id', '=', 'tenant_houses.tenant_id')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->where('users.id', $id)->first();

        $bills = DB::table('house_bills')
        ->join('bills', 'bills.id', 'house_bills.bill_id')
        ->where('house_bills.created_by', auth()->id())
        ->where('house_bills.bill_type', '=', 'variable')
        ->get();

        if ($tenant) {
        $mbills = DB::table('house_bills')
        ->join('buildings', 'buildings.id', '=', 'house_bills.building_id')
        ->join('bills', 'bills.id', '=', 'house_bills.bill_id')
        ->where('house_bills.building_id', $tenant->building_id)
        ->where('house_bills.bill_type', '=', 'fixed')
        ->get();

        $vbills = DB::table('tenant_bills')
        ->join('users', 'users.id', '=', 'tenant_bills.tenant_id')
        ->join('house_bills', 'house_bills.id', '=', 'tenant_bills.bill_id')
        ->join('bills', 'bills.id', '=', 'house_bills.bill_id')
        ->where('tenant_bills.tenant_id', $tenant->id)
        ->where('house_bills.bill_type', '=', 'variable')
        ->get();


        } else {
            $mbills = [];
        }

        return view('landlord.tenant-details', ['tenant' => $tenant, 'mbills' => $mbills, 'bills' => $bills, 'vbills' => $vbills]);
    }


    public function listBills() {
        $banks = Bank::all();

        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $bills = DB::table('bills')->join('banks', 'banks.bank_id', '=', 'bills.bill_bank_id')->where('bills.created_by', auth()->id())->get();

        return view('admin.list-bills', ['bills' => $bills, 'banks' => $banks, 'buildings' => $buildings]);
    }
}
