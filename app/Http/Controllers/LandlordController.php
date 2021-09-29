<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Bank;
use App\Building;
use App\Bill;
use DB;
USE App\HouseBill;
use App\TenantBill;
use App\TenantHouse;
use App\ServiceRequest;
use App\Vendor;
use App\VacateNotice;
use App\UnitPricing;
use Carbon\Carbon;
use App\Expense;

class LandlordController extends Controller
{

    public function index()
    {

            $expected_bill_amount = DB::table('tenant_houses')
            ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
            ->join('house_bills', 'house_bills.building_id', '=', 'buildings.id')
            ->where('buildings.created_by', auth()->id())
            ->where('tenant_houses.occupancy_status',  1)
            ->orWhere('buildings.owned_by', auth()->id())->sum('fixed_bill_amount');


            $vacantunits = DB::table('unit_pricings')->select('unit_pricings.id as pricingid', 'buildings.building_name', 'units.unit_type_name', 'unit_pricings.unit_type_id', 'unit_pricings.building_id', 'unit_pricings.unit_price', 'unit_pricings.unit_deposit')
            ->join('buildings', 'buildings.id', '=', 'unit_pricings.building_id')
            ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
            ->where('buildings.created_by', auth()->id())
            ->orWhere('buildings.owned_by', auth()->id())
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


            $total_unts = UnitPricing::join('buildings', 'buildings.id', '=', 'unit_pricings.building_id')
            ->where('buildings.created_by', auth()->id())
            ->orWhere('buildings.owned_by', auth()->id())
            ->sum('number_of_units');

            $taken_unts = DB::table('tenant_houses')
                ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
                ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
                ->where('buildings.created_by', auth()->id())
                ->where('tenant_houses.occupancy_status',  1)
                // ->orWhere('buildings.owned_by', auth()->id())
                ->count();

            $tenants_count = DB::table('user_role')
            ->join('users', 'users.id', '=', 'user_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('roles.name', '=', 'tenant')
            ->where('users.created_by', auth()->id())
            ->count();

            $vendors_count = Vendor::where('created_by', auth()->id())->count();

            $buildings_count = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->count();

            $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

            $buildings->map(function($b){

                $math = DB::table('unit_pricings')->where('building_id', $b->id)->get();

                $val = 0;

                $depo = 0;

                foreach ($math as $key) {
                    $val += $key->number_of_units * $key->unit_price;
                    $depo += $key->number_of_units * $key->unit_deposit;
                }

                $mon = '0'.Carbon::now()->month;

                $mothly_payment_count = Building::whereMonth('invoicing_date', $mon)
                ->where('created_by', auth()->id())
                ->orWhere('owned_by', auth()->id())
                ->count();


                $build_count = Building::where('created_by', auth()->id())
                ->orWhere('owned_by', auth()->id())->count();


                $b['total_expected'] = $build_count * $val;
                $b['total_monthly_expected'] = $mothly_payment_count * $val;

                $b['total_deposit_expected'] = $build_count * $depo;

                return $b;
            });

            if (sizeof($buildings) > 0) {

                $expected_amount = $buildings[0]['total_expected'];

                $expected_monthly_amount = $buildings[0]['total_monthly_expected'];
                $expected_deposit= $buildings[0]['total_deposit_expected'];

            } else {
                $expected_amount = [];
                $expected_monthly_amount = [];
                $expected_deposit = [];
            }


            $tenants = DB::table('user_role')
            ->join('users', 'users.id', '=', 'user_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('roles.name', '=', 'tenant')
            ->where('users.created_by', auth()->id())
            ->orderBy('users.id', 'desc')->take(5)->get();

            $payments = DB::table('user_role')
                ->join('users', 'users.id', '=', 'user_role.user_id')
                ->join('roles', 'roles.id', '=', 'user_role.role_id')
                ->join('payments', 'payments.tenant_id', '=', 'users.id')
                ->where('roles.name', '=', 'tenant')
                ->where('users.created_by', auth()->id())
                ->orderBy('payments.id', 'desc')->take(5)->get();


            $total_collected = DB::table('user_role')
                ->join('users', 'users.id', '=', 'user_role.user_id')
                ->join('roles', 'roles.id', '=', 'user_role.role_id')
                ->join('payments', 'payments.tenant_id', '=', 'users.id')
                ->where('roles.name', '=', 'tenant')
                ->where('payments.payment_reason', '=', 'rent')
                ->whereMonth('payments.created_at', Carbon::now()->month)
                ->where('users.created_by', auth()->id())->sum('amount');

            $total_bills_collected = DB::table('user_role')
                ->join('users', 'users.id', '=', 'user_role.user_id')
                ->join('roles', 'roles.id', '=', 'user_role.role_id')
                ->join('payments', 'payments.tenant_id', '=', 'users.id')
                ->where('roles.name', '=', 'tenant')
                ->where('payments.payment_reason', '=', 'bills')
                ->whereMonth('payments.created_at', Carbon::now()->month)
                ->where('users.created_by', auth()->id())->sum('amount');


            $bills_arrears = $expected_bill_amount - $total_bills_collected;

            $requests = DB::table('service_requests')->select('service_requests.id as serviceid', 'request_title', 'building_name', 'unit_type_name', 'building_labels.label', 'service_requests.created_at')
            ->join('users', 'users.id', '=', 'service_requests.created_by')
            ->join('buildings', 'buildings.id', '=', 'service_requests.building_id')
            ->join('building_labels', 'building_labels.id', '=', 'service_requests.unit_number')
            ->join('units', 'units.id', '=', 'service_requests.unit_id')
            ->where('users.created_by', auth()->id())->get();

            $requestcount = DB::table('service_requests')->join('buildings', 'buildings.id', '=', 'service_requests.building_id')->where('buildings.created_by', auth()->id())->count();

            $monthly_expense = Expense::where('created_by', auth()->id())->whereMonth('created_at', Carbon::now()->month)->sum('amount');

            // notices

            $notices = DB::table('vacate_notices')->select('vacate_notices.id as noticeid', 'building_name', 'unit_type_name', 'label', 'vacate_notices.created_at', 'vacate_notice', 'first_name', 'last_name', 'id_number')
            ->join('users', 'users.id', '=', 'vacate_notices.tenant_id')
            ->join('tenant_houses', 'tenant_houses.account_number', '=', 'vacate_notices.account_number')
            ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
            ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
            ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
            ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
            ->where('buildings.created_by', auth()->id())->get();


        return view('landlord.index', ['tenants' => $tenants, 'tenants_count' => $tenants_count, 'buildings_count' => $buildings_count, 'expected_amount' => $expected_amount, 'vendors_count' => $vendors_count, 'expected_monthly_amount' => $expected_monthly_amount, 'total_collected' => $total_collected, 'expected_deposit' => $expected_deposit, 'requestcount' => $requestcount, 'payments' => $payments, 'vacant_count' => collect($vacantunits->sum('number_of_units'))[0], 'monthly_expense' => $monthly_expense, 'requests' => $requests, 'notices' => $notices, 'total_units' => $total_unts, 'total_bills_collected' => $total_bills_collected, 'expected_bill_amount' => $expected_bill_amount, 'bills_arrears' => $bills_arrears, 'occupied_units' => $taken_unts]);
    }







    function safeFileName($file)
    {
        
        $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file);
      
        $file = mb_ereg_replace("([\.]{2,})", '', $file);
        return $file;
    }


    
    public function createUnitType() {
        $units= Unit::all(); 

        return view('landlord.unit-types', ['units' => $units]);
    }



    public function listBills() 
    {
        $banks = Bank::all();

        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $bills = DB::table('bills')->join('banks', 'banks.bank_id', '=', 'bills.bill_bank_id')->where('bills.created_by', auth()->id())->get();

        return view('landlord.list-bills', ['bills' => $bills, 'banks' => $banks, 'buildings' => $buildings]);
    }

    public function listRequests ()
    {

        $requests = DB::table('service_requests')->select('service_requests.id as serviceid', 'request_title', 'building_name', 'unit_type_name', 'building_labels.label', 'service_requests.created_at')
        ->join('users', 'users.id', '=', 'service_requests.created_by')
        ->join('buildings', 'buildings.id', '=', 'service_requests.building_id')
        ->join('building_labels', 'building_labels.id', '=', 'service_requests.unit_number')
        ->join('units', 'units.id', '=', 'service_requests.unit_id')
        ->where('users.created_by', auth()->id())->get();


        return view('landlord.service-requests', ['requests' => $requests]);
    }

    public function vacateNotices()
    {

        $units = DB::table('tenant_houses')->select('tenant_houses.id as houseid', 'unit_pricings.unit_price as unit_price', 'tenant_houses.tenant_rent_amount as tenant_rent_amount', 'tenant_houses.account_number as account_number', 'tenant_houses.tenant_deposit_amount as tenant_deposit_amount', 'building_labels.label as label', 'buildings.building_name as building_name', 'unit_pricings.unit_deposit')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('tenant_houses.tenant_id', auth()->id())->get();

        $units->map(function($u){
            if ($u->tenant_rent_amount == null) {
             
                 $u->initial_rent_amount = $u->unit_price;
    
            } else {

                $u->initial_rent_amount = $u->tenant_rent_amount;

            }

            if ($u->tenant_deposit_amount == null) {
             
                 $u->initial_deposit_amount = $u->unit_deposit;
    
            } else {

                $u->initial_deposit_amount = $u->tenant_deposit_amount;

            }

            return $u;

        });


        $tenants = DB::table('user_role')->select('users.id as userid', 'first_name', 'middle_name', 'last_name', 'email', 'phone_number', 'id_number', 'citizenship', 'users.created_at as created_at')
        ->join('users', 'users.id', '=', 'user_role.user_id')
        ->join('roles', 'roles.id', '=', 'user_role.role_id')
        ->where('users.created_by', auth()->id())
        ->where('roles.name', '=', 'tenant')->get();

        $notices = DB::table('vacate_notices')->select('vacate_notices.id as noticeid', 'building_name', 'unit_type_name', 'label', 'vacate_notices.created_at', 'vacate_notice', 'first_name', 'last_name', 'id_number')
        ->join('users', 'users.id', '=', 'vacate_notices.tenant_id')
        ->join('tenant_houses', 'tenant_houses.account_number', '=', 'vacate_notices.account_number')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('buildings.created_by', auth()->id())->get();

        return view('landlord.vacate-notices', ['notices' => $notices, 'tenants' => $tenants]);
    }

    public function deleteBill($id)
    {
        Bill::destroy($id);

        toastr()->success('bill deleted!');

        return redirect()->back();
    }

    public function serviceRequestDetails($id)
    {
        $vendors = Vendor::where('created_by', auth()->id())->get();

        $service_request = ServiceRequest::select('service_requests.id as serviceid', 'first_name','last_name', 'building_name', 'unit_type_name', 'building_labels.label', 'request_status', 'request_title', 'assigned_to', 'service_cost')
        ->join('buildings', 'buildings.id', '=', 'service_requests.building_id')
        ->join('units', 'units.id', '=', 'service_requests.unit_id')
        ->join('building_labels', 'building_labels.id', '=', 'service_requests.unit_number')
        ->join('users', 'users.id', '=', 'service_requests.created_by')
        ->where('service_requests.id', $id)->first();

        if ($service_request->assigned_to) {
            $service_request->vendor_first_name = DB::table('vendors')->where('id', $service_request->assigned_to)->first()->first_name;
            $service_request->vendor_last_name = DB::table('vendors')->where('id', $service_request->assigned_to)->first()->last_name;
        } else {
            $service_request->vendor_first_name = '';
            $service_request->vendor_last_name = '';
        }
        

        return view('landlord.service-request-details', ['service_request' => $service_request, 'vendors' => $vendors]);
    }

    public function assignServiceRequest(Request $request)
    {
        $service = ServiceRequest::where('id', $request->serviceid)->first();
        if ($service) {
            $service->assigned_to = $request->assigned_to;
            $service->request_status = 'assigned';
            $service->save();
        }

        toastr()->success('request assigned!');

        return redirect()->back();
    }

    public function completeServiceRequest(Request $request)
    {
        $service = ServiceRequest::where('id', $request->serviceid)->first();
        if ($service) {
            $service->service_cost = $request->service_cost;
            $service->request_status = 'completed';
            $service->save();
        }

        toastr()->success('service request marked as complete!');

        return redirect()->back();


    }

    public function getTenantUnits($id)
    {
        $tenant_units = DB::table('tenant_houses')->select('tenant_houses.id as houseid', 'unit_pricings.unit_price as unit_price', 'tenant_houses.tenant_rent_amount as tenant_rent_amount', 'tenant_houses.account_number as account_number', 'tenant_houses.tenant_deposit_amount as tenant_deposit_amount', 'building_labels.label as label', 'buildings.building_name as building_name', 'unit_pricings.unit_deposit')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('tenant_houses.tenant_id', $id)->get();

        $tenant_units->map(function($u){
            if ($u->tenant_rent_amount == null) {
             
                 $u->initial_rent_amount = $u->unit_price;
    
            } else {

                $u->initial_rent_amount = $u->tenant_rent_amount;

            }

            if ($u->tenant_deposit_amount == null) {
             
                 $u->initial_deposit_amount = $u->unit_deposit;
    
            } else {

                $u->initial_deposit_amount = $u->tenant_deposit_amount;

            }

            return $u;

        });

        return response()->json($tenant_units);
    }

    public function generateVacateNotice(Request $request)
    {
        $request->validate([
            'vacate_notice.*' => 'required|file|mimes:jpg,jpeg,png,gif',
            'account_number' => 'required|max:255',
            'tenant_id' => 'required|max:255',
        ]);


            $data = $request->all();


            $filename = $this->storeNotice($request->vacate_notice, 'vacatenotice', '');

            $data['vacate_notice'] = $filename;
            $data['tenant_id'] = $request->tenant_id;
            $data['account_number'] = $request->account_number;
            $data['notice_status'] = 'submitted';

            VacateNotice::create($data);

            toastr()->success('Vacate Notice Submitted Successfully');

            return redirect()->back();
    }

    protected function storeNotice($doc, $title)
    {

            $destinationPath = 'Documents/Notices';

            $extension = $doc->getClientOriginalExtension();

            $fileName = $this->safeFileName($title.'-'.date('YmdHis').'.'.$extension);

            $doc->move($destinationPath, $fileName);

           return $fileName;
       
    }

    public function listCaretakers()
    {
        $caretakers = DB::table('user_role')
                    ->join('users', 'users.id', '=', 'user_role.user_id')
                    ->join('roles', 'roles.id', '=', 'user_role.role_id')
                    ->join('buildings', 'users.id', '=', 'buildings.created_by')
                    ->where('roles.name', '=', 'caretaker')
                    ->where('users.created_by', auth()->id())
                    ->where('buildings.created_by', auth()->id())
                    ->orWhere('buildings.owned_by', auth()->id())
                    ->orderBy('users.id', 'desc')->get();

    }

}
