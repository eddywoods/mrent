<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Building;
use App\Vendor;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use stdClass;
use Log;
use App\Expense;
use App\UnitPricing;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    

    public function admin()
    {
        return view('admin.index');
    }

    public function agent()
    {
        $vacantunits = DB::table('unit_pricings')->select('unit_pricings.id as pricingid', 'buildings.building_name', 'units.unit_type_name', 'unit_pricings.unit_type_id', 'unit_pricings.building_id', 'unit_pricings.unit_price', 'unit_pricings.unit_deposit')
        ->join('buildings', 'buildings.id', '=', 'unit_pricings.building_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->where('buildings.created_by', auth()->id())
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
            if ($math) {

                foreach ($math as $key) {
                    $val += $key->number_of_units * $key->unit_price;
                    $depo += $key->number_of_units * $key->unit_deposit;
                }
    
            }

            $mon = '0'.Carbon::now()->month;

             $mothly_payment_count = Building::where('created_by', auth()->id())
            ->whereMonth('invoicing_date', $mon)
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
            ->whereMonth('payments.created_at', Carbon::now()->month)
            ->where('users.created_by', auth()->id())->sum('amount');

            $requestcount = DB::table('service_requests')->join('buildings', 'buildings.id', '=', 'service_requests.building_id')->where('buildings.created_by', auth()->id())->count();

            $monthly_expense = Expense::where('created_by', auth()->id())->whereMonth('created_at', Carbon::now()->month)->sum('amount');


        return view('agent.index', ['tenants' => $tenants, 'tenants_count' => $tenants_count, 'buildings_count' => $buildings_count, 'expected_amount' => $expected_amount, 'vendors_count' => $vendors_count, 'expected_monthly_amount' => $expected_monthly_amount, 'total_collected' => $total_collected, 'expected_deposit' => $expected_deposit, 'requestcount' => $requestcount, 'payments' => $payments, 'vacant_count' => collect($vacantunits->sum('number_of_units'))[0], 'monthly_expense' => $monthly_expense]);
    }

     public function tenant()
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

        $bill_deposits = DB::table('tenant_houses')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('house_bills', 'house_bills.building_id', '=', 'buildings.id')
        ->where('tenant_houses.tenant_id', auth()->id())->sum('bill_deposit');

        $bill_amount = DB::table('tenant_houses')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('house_bills', 'house_bills.building_id', '=', 'buildings.id')
        ->where('tenant_houses.tenant_id', auth()->id())->sum('fixed_bill_amount');

        $variable_bills_last_month = DB::table('tenant_bills')
        ->join('house_bills', 'house_bills.bill_id', '=', 'tenant_bills.bill_id')
        ->join('bills', 'bills.id', '=', 'house_bills.bill_id')
        ->where('tenant_id', auth()->id())
        ->where('house_bills.bill_type', '=', 'variable')
        ->whereMonth('tenant_bills.created_at', Carbon::today()->subMonths(1))
        ->get();

        $total_variable_bills_last_month = 0;

        foreach ($variable_bills_last_month as $key) {
            $total_variable_bills_last_month += $key->variable_bill_amount * $key->number_of_units;
        }


        $total_initial_amount = collect($units)->sum('initial_rent_amount') + collect($units)->sum('initial_deposit_amount') + $bill_deposits;

        $total_upcoming_amount = collect($units)->sum('initial_rent_amount') + $bill_amount;

        $total_paid_this_month = DB::table('payments')
        ->where('tenant_id', auth()->id())
        ->whereMonth('payments.created_at', Carbon::now()->month)
        ->sum('amount');

        $total_rent_paid_this_month = DB::table('payments')
        ->where('tenant_id', auth()->id())
        ->where('payment_reason', '=', 'rent')
        ->whereMonth('payments.created_at', Carbon::now()->month)
        ->sum('amount');

        $total_amount_due_last_month = collect($units)->sum('initial_rent_amount') + $bill_amount + $total_variable_bills_last_month;


        $total_outstanding_amount = $total_paid_this_month - $total_amount_due_last_month;

        $response =  (object) $this->billers();

        $resp =  $response->data;

        return view('tenant.index', ['total' => $total_initial_amount, 'units' => $units, 'billers' => $resp, 'upcoming_amount' => $total_upcoming_amount, 'total_paid_this_month' => $total_paid_this_month, 'total_rent_paid_this_month' => $total_rent_paid_this_month, 'total_amount_due_last_month' => $total_amount_due_last_month, 'total_outstanding_amount' => $total_outstanding_amount]);
    }


    //caretaker home

    public function caretaker()
    {
        $buildings = DB::table('caretaker_houses')->select('buildings.id as buildingid', 'building_name', 'location', 'invoicing_date', 'contact_number', 'account_number', 'buildings.created_at')
        ->join('buildings', 'buildings.id', '=', 'caretaker_houses.building_id')
        ->join('users', 'users.id', '=', 'caretaker_houses.caretaker_id')
        ->where('caretaker_houses.caretaker_id', auth()->id())->get();

        $buildings->map(function($b){
            $units = UnitPricing::where('building_id', $b->buildingid)->sum('number_of_units');

             $b->number_of_units = $units;

             return $b;
        });


        return view('caretaker.index', ['buildings' => $buildings]);
    }





    //end caretaker

     function billers()
    {


        $client = new Client();

        $url = config("ipay.IPAY_URL") . "/billing/list?vid=mrent";
    
        try {
    
        $res = $client->get($url);
    
        $response = json_decode($res->getBody()->getContents(), true);

        return $response;

     } catch (ClientException $e) {
        $response = new stdClass();
        $response->valid = false;
        Log::error($e->getMessage());
      } catch (\Exception $e) {
        $response = new stdClass();
        $response->valid = false;
        Log::error($e->getMessage());
  
      }

      return $response;
    }

}
