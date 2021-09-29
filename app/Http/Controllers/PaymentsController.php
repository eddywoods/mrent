<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use DB;
use App\Building;
use App\Expense;

class PaymentsController extends Controller
{


    public function landLordListPayment()
    {

        $tenants = DB::table('user_role')->select('users.id as tenantid', 'first_name', 'last_name')
        ->join('users', 'users.id', '=', 'user_role.user_id')
        ->join('roles', 'roles.id', '=', 'user_role.role_id')
        ->where('users.created_by', auth()->id())
        ->where('roles.name', '=', 'tenant')->get();

        $rentunits = DB::table('tenant_houses')->select('tenant_houses.id as houseid', 'unit_pricings.unit_price as unit_price', 'tenant_houses.tenant_rent_amount as tenant_rent_amount', 'tenant_houses.account_number as account_number', 'tenant_houses.tenant_deposit_amount as tenant_deposit_amount', 'building_labels.label as label', 'buildings.building_name as building_name', 'unit_pricings.unit_deposit', 'entry_date', 'unit_type_name')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('buildings.owned_by', auth()->id())
        ->orWhere('buildings.created_by', auth()->id())
        ->get();

        $rentunits->map(function($u){
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

        $payments = DB::table('payments')->join('users', 'users.id', '=', 'payments.tenant_id')
        ->where('users.created_by', auth()->id())
        ->get();
    
        return view('landlord.payments.index', ['payments' => $payments, 'tenants' => $tenants, 'rentunits' => $rentunits]);
    }



    public function agentLordListPayment()
    {
        $tenants = DB::table('user_role')->select('users.id as tenantid', 'first_name', 'last_name')
        ->join('users', 'users.id', '=', 'user_role.user_id')
        ->join('roles', 'roles.id', '=', 'user_role.role_id')
        ->where('users.created_by', auth()->id())
        ->where('roles.name', '=', 'tenant')->get();

        $rentunits = DB::table('tenant_houses')->select('tenant_houses.id as houseid', 'unit_pricings.unit_price as unit_price', 'tenant_houses.tenant_rent_amount as tenant_rent_amount', 'tenant_houses.account_number as account_number', 'tenant_houses.tenant_deposit_amount as tenant_deposit_amount', 'building_labels.label as label', 'buildings.building_name as building_name', 'unit_pricings.unit_deposit', 'entry_date', 'unit_type_name')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('buildings.owned_by', auth()->id())
        ->orWhere('buildings.created_by', auth()->id())
        ->get();

        $rentunits->map(function($u){
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

        $payments = DB::table('payments')->join('users', 'users.id', '=', 'payments.tenant_id')
        ->where('users.created_by', auth()->id())
        ->get();
    
        return view('agent.payments.index', ['payments' => $payments, 'tenants' => $tenants, 'rentunits' => $rentunits]);
    }


    

    public function makePayment (Request $request)
    {

        $validated = $request->validate([
            'tenant_id' => 'required|max:255',
            'payment_reason' => 'required|max:255',
            'amount' => 'required|max:255',
            'payment_method' => 'required|max:255',
            'account' => 'required|max:255',
        ]);

     
        $validated['created_by'] = auth()->id();
        $validated['payment_description'] = $request->payment_description;
        $validated['transaction_number'] = $request->transaction_number;
        $validated['transaction_date'] = now();

        unset($request['_token']);

        Payment::create($validated);

        toastr()->success('Payment Posted!');

        return redirect()->back();
    }

    public function landlordExpense()
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $expenses = DB::table('expenses')
        ->join('buildings', 'buildings.id', '=', 'expenses.building_id')
        ->join('units', 'units.id', '=', 'expenses.unit_id')
        ->where('expenses.created_by', auth()->id())->get();

        return view('landlord.expenses', ['expenses' => $expenses, 'buildings' => $buildings]);
    }


    public function agentExpense()
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $expenses = DB::table('expenses')
        ->join('buildings', 'buildings.id', '=', 'expenses.building_id')
        ->join('units', 'units.id', '=', 'expenses.unit_id')
        ->where('expenses.created_by', auth()->id())->get();

        return view('agent.expenses', ['expenses' => $expenses, 'buildings' => $buildings]);
    }




    public function createExpense(Request $request) 
    {
        $rules = [
            'expense_name' => 'required|max:255',
            'building_id' => 'required|max:255',
            'unit_id' => 'required|max:255',
            'amount' => 'required|max:255',
        ];

        $this->validate($request, $rules);

         $request['created_by'] = auth()->id();
         $request['description'] =$request->description;
         $request['unit_number'] =$request->unit_number;

        Expense::create($request->all());

        toastr()->success('Expense Posted');

        return redirect()->back();


    }
}
