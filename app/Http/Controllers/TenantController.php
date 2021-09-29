<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tenant;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SMS;
use App\Traits\ApiResponser;
use Auth, DB;
use App\Role;
use App\Traits\IprsSearch;
use App\Building;
use App\UnitPricing;
use App\HouseBill;
use App\TenantBill;
use App\Payment;
use App\TenantDocument;
use App\BuildingLabel;
use App\ServiceRequest;
use App\TenantHouse;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use stdClass;
use Log;
use App\VacateNotice;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agentListTenants()
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $tenants = DB::table('user_role')->select('users.id as userid', 'first_name', 'middle_name', 'last_name', 'email', 'phone_number', 'id_number', 'citizenship', 'users.created_at as created_at')
            ->join('users', 'users.id', '=', 'user_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('users.created_by', auth()->id())
            ->where('roles.name', '=', 'tenant')->get();

        return view('agent.list-tenants', ['tenants' => $tenants, 'buildings' => $buildings]);
    }


    public function landlordListTenants()
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $tenants = DB::table('user_role')->select('users.id as userid', 'first_name', 'middle_name', 'last_name', 'email', 'phone_number', 'id_number', 'citizenship', 'users.created_at as created_at')
            ->join('users', 'users.id', '=', 'user_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('users.created_by', auth()->id())
            ->where('roles.name', '=', 'tenant')->get();

        return view('landlord.list-tenants', ['tenants' => $tenants, 'buildings' => $buildings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }


    public function landlordCreateTenant()
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();
        
        return view('landlord.create-tenant', ['buildings' => $buildings]);
    }


    public function agentCreateTenant()
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();
        
        return view('agent.create-tenant', ['buildings' => $buildings]);
    }


    public function getUnits($id)
    {
        $building = Building::where('id', $id)->first();

        $units = DB::table('unit_pricings')->select('units.id as unitid', 'unit_type_name')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->where('building_id', $id)->get();

        $units['labels'] = BuildingLabel::where('building_id', $id)->get();
        

        return response()->json($units);
    }


    public function agentShowTenant($id) 
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $rentunits = DB::table('tenant_houses')->select('tenant_houses.id as houseid', 'unit_pricings.unit_price as unit_price', 'tenant_houses.tenant_rent_amount as tenant_rent_amount', 'tenant_houses.account_number as account_number', 'tenant_houses.tenant_deposit_amount as tenant_deposit_amount', 'building_labels.label as label', 'buildings.building_name as building_name', 'unit_pricings.unit_deposit', 'entry_date', 'unit_type_name')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('tenant_houses.tenant_id', $id)->get();

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


        $tenant = DB::table('tenant_houses')
        ->join('users', 'users.id', '=', 'tenant_houses.tenant_id')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('users.id', $id)->first();


        if ($tenant) {

        $bills = DB::table('house_bills')
        ->join('bills', 'bills.id', 'house_bills.bill_id')
        ->where('house_bills.created_by', auth()->id())
        ->where('house_bills.bill_type', '=', 'variable')
        ->get();

        $mbills = DB::table('house_bills')
        ->join('buildings', 'buildings.id', '=', 'house_bills.building_id')
        ->join('bills', 'bills.id', '=', 'house_bills.bill_id')
        ->where('house_bills.building_id', $tenant->building_id)
        ->where('house_bills.bill_type', '=', 'fixed')
        ->get();

        $vbills = DB::table('tenant_bills')
        ->join('users', 'users.id', '=', 'tenant_bills.tenant_id')
        ->join('house_bills', 'house_bills.bill_id', '=', 'tenant_bills.bill_id')
        ->join('bills', 'bills.id', '=', 'house_bills.bill_id')
        ->where('tenant_bills.tenant_id', $id)
        ->where('house_bills.bill_type', '=', 'variable')
        ->get();

        $documents = TenantDocument::where('tenant_id', $id)->get();

        $payments = Payment::where('tenant_id', $id)->get();


        } else {
            $bills = [];

            $mbills = [];

            $vbills = [];

            $documents = [];

            $payments = [];
        }

        return view('agent.tenant-details', ['tenant' => $tenant, 'mbills' => $mbills, 'bills' => $bills, 'vbills' => $vbills, 'payments' => $payments, 'documents' => $documents, 'buildings' => $buildings, 'rentunits' => $rentunits]);
    }





    public function landlordShowTenant($id) 
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $rentunits = DB::table('tenant_houses')->select('tenant_houses.id as houseid', 'unit_pricings.unit_price as unit_price', 'tenant_houses.tenant_rent_amount as tenant_rent_amount', 'tenant_houses.account_number as account_number', 'tenant_houses.tenant_deposit_amount as tenant_deposit_amount', 'building_labels.label as label', 'buildings.building_name as building_name', 'unit_pricings.unit_deposit', 'entry_date', 'unit_type_name')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('tenant_houses.tenant_id', $id)->get();

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


        $tenant = DB::table('tenant_houses')
        ->join('users', 'users.id', '=', 'tenant_houses.tenant_id')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('users.id', $id)->first();


        if ($tenant) {

        $bills = DB::table('house_bills')
        ->join('bills', 'bills.id', 'house_bills.bill_id')
        ->where('house_bills.created_by', auth()->id())
        ->where('house_bills.bill_type', '=', 'variable')
        ->get();

        $mbills = DB::table('house_bills')
        ->join('buildings', 'buildings.id', '=', 'house_bills.building_id')
        ->join('bills', 'bills.id', '=', 'house_bills.bill_id')
        ->where('house_bills.building_id', $tenant->building_id)
        ->where('house_bills.bill_type', '=', 'fixed')
        ->get();

        $vbills = DB::table('tenant_bills')
        ->join('users', 'users.id', '=', 'tenant_bills.tenant_id')
        ->join('house_bills', 'house_bills.bill_id', '=', 'tenant_bills.bill_id')
        ->join('bills', 'bills.id', '=', 'house_bills.bill_id')
        ->where('tenant_bills.tenant_id', $id)
        ->where('house_bills.bill_type', '=', 'variable')
        ->get();

        $documents = TenantDocument::where('tenant_id', $id)->get();

        $payments = Payment::where('tenant_id', $id)->get();


        } else {
            $bills = [];

            $mbills = [];

            $vbills = [];

            $documents = [];

            $payments = [];
        }

        return view('landlord.tenant-details', ['tenant' => $tenant, 'mbills' => $mbills, 'bills' => $bills, 'vbills' => $vbills, 'payments' => $payments, 'documents' => $documents, 'buildings' => $buildings, 'rentunits' => $rentunits]);
    }








    public function attachTenantBill(Request $request)
    {

        $validated = $request->validate([
        'bill_id' => 'required|max:255',
        'tenant_id' => 'required|max:255',
        'number_of_units' => 'required|max:255',
        'building_id' => 'required|max:255',
        'unit_id' => 'required|max:255',
        'unit_number' => 'required|max:255',
        ]);

        $validated['created_by'] = auth()->id();

        TenantBill::create($validated);

        toastr()->success('Bill Attached');

        return redirect()->back();
    }


    function safeFileName($file)
    {
        
        $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file);
      
        $file = mb_ereg_replace("([\.]{2,})", '', $file);
        return $file;
    }



   public function storeTenantDocument(Request $request)
    {
        $request->validate([
        'tenant_document.*' => 'required|file|mimes:pdf,jpg,jpeg,png,docx',
        'document_name' => 'required|max:255',
        'tenant_id' => 'required|max:255',
        ]);
        
            $data = $request->all();

            $filename = $this->storeDocument($data['tenant_document'], 'Tenant Document', '');

            $data['created_by'] = auth()->id();

            $data['tenant_document'] = $filename;
            $data['document_name'] = $request->document_name;
            $data['tenant_id'] = $request->tenant_id;

            TenantDocument::create($data);

            toastr()->success('File uploaded Successfully');

        return redirect()->back();
    }



    protected function storeDocument($doc, $title)
    {

        $destinationPath = 'Documents/Tenant';


            $extension = $doc->getClientOriginalExtension();

            $fileName = $this->safeFileName($title.'-'.date('Ymd H is').'.'.$extension);

            $doc->move($destinationPath, $fileName);

           return $fileName;
       

    }



public function landlordtenantsUpload()
{
    $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

    return view('landlord.tenants-upload', ['buildings' => $buildings]);
}





public function agentVacateNotices()
{
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

    return view('agent.vacate-notices', ['notices' => $notices, 'tenants' => $tenants]);
}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function service ()
    {
        $buildings = DB::table('tenant_houses')->select('buildings.id as id', 'building_name')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->where('tenant_houses.tenant_id', auth()->id())->get();



        $requests = DB::table('service_requests')
        ->join('buildings', 'buildings.id', '=', 'service_requests.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'service_requests.unit_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->join('building_labels', 'building_labels.id', '=', 'service_requests.unit_number')
        ->where('service_requests.created_by', auth()->id())->get();

        return view('tenant.service-requests', ['buildings' => $buildings, 'requests' => $requests]);
    }

    public function serviceRequest(Request $request)
    {
        $request->validate([
            'request_title' => 'required|max:255',
            'building_id' => 'required|max:255',
            'unit_id' => 'required|max:255',
        ]);

         $request['created_by'] = auth()->id();
         $request['description'] =$request->description;
         $request['unit_number'] =$request->unit_number;
         $request['unit_id'] =$request->unit_id;

         ServiceRequest::create($request->all());

         toastr()->success('Request Sent!');

        return redirect()->back();
    }

    public function myRentalUnits()
    {
        $units = DB::table('tenant_houses')
                ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
                ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
                ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
                ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
                ->where('tenant_houses.tenant_id', auth()->id())->get();

                return view('tenant.rental-units', ['units' => $units]);
    }


    public function fixedBills()
    {
        $mbills = DB::table('house_bills')
        ->join('buildings', 'buildings.id', '=', 'house_bills.building_id')
        ->join('bills', 'bills.id', '=', 'house_bills.bill_id')
        ->where('house_bills.bill_type', '=', 'fixed')
        ->get();

     

        return view('tenant.fixed-bills', ['bills' => $mbills]);

    }

    public function variableBills()
    {

        $vbills = DB::table('tenant_bills')
        ->join('users', 'users.id', '=', 'tenant_bills.tenant_id')
        ->join('house_bills', 'house_bills.bill_id', '=', 'tenant_bills.bill_id')
        ->join('bills', 'bills.id', '=', 'house_bills.bill_id')
        ->where('tenant_bills.tenant_id', auth()->id())
        ->where('house_bills.bill_type', '=', 'variable')
        ->get();


        return view('tenant.variable-bills', ['bills' => $vbills]);
    }


    public function myPayments()
    {
        $payments = DB::table('payments')
        ->join('users', 'users.id', '=', 'payments.tenant_id')
        ->where('payments.tenant_id', auth()->id())
       ->get();

return view('tenant.payments', ['payments' => $payments]);
    }


    public function totalUnitPayables(Request $request)
    {

        $account = TenantHouse::where('account_number', $request->account_number)->first();

        $units = DB::table('tenant_houses')->select('tenant_houses.id as houseid', 'unit_pricings.unit_price as unit_price', 'tenant_houses.tenant_rent_amount as tenant_rent_amount', 'tenant_houses.account_number as account_number', 'tenant_houses.tenant_deposit_amount as tenant_deposit_amount', 'building_labels.label as label', 'buildings.building_name as building_name', 'unit_pricings.unit_deposit')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('tenant_houses.tenant_id', auth()->id())
        ->where('tenant_houses.unit_number', $account->unit_number)
        ->get();

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

        $fixed_bill_amount = DB::table('tenant_houses')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('house_bills', 'house_bills.building_id', '=', 'buildings.id')
        ->where('tenant_houses.tenant_id', auth()->id())->sum('fixed_bill_amount');

        $variable_bill_amount = DB::table('tenant_houses')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('tenant_bills', 'tenant_bills.building_id', '=', 'buildings.id')
        ->join('house_bills', 'house_bills.building_id', '=', 'buildings.id')
        ->join('units', 'units.id', '=', 'tenant_bills.unit_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('tenant_houses.tenant_id', auth()->id())
        ->where('tenant_houses.unit_number', $account->unit_number)
        ->get();

        $total_variable_bill_amount = collect($variable_bill_amount)->sum('number_of_units') * collect($variable_bill_amount)->sum('variable_bill_amount');


        $total_initial_amount = collect($units)->sum('initial_rent_amount') + collect($units)->sum('initial_deposit_amount');

        $amount = $bill_deposits + $fixed_bill_amount + $total_variable_bill_amount + $total_initial_amount;

        return response()->json($amount, 200);
    }


    public function totalBillsAmount(Request $request)
    {
        $account = TenantHouse::where('account_number', $request->account_number)->first();

    
        $bill_deposits = DB::table('tenant_houses')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('house_bills', 'house_bills.building_id', '=', 'buildings.id')
        ->where('tenant_houses.tenant_id', auth()->id())->sum('bill_deposit');

        $fixed_bill_amount = DB::table('tenant_houses')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('house_bills', 'house_bills.building_id', '=', 'buildings.id')
        ->where('tenant_houses.tenant_id', auth()->id())->sum('fixed_bill_amount');

        $variable_bill_amount = DB::table('tenant_houses')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('tenant_bills', 'tenant_bills.building_id', '=', 'buildings.id')
        ->join('house_bills', 'house_bills.building_id', '=', 'buildings.id')
        ->join('units', 'units.id', '=', 'tenant_bills.unit_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('tenant_houses.tenant_id', auth()->id())
        ->where('tenant_houses.unit_number', $account->unit_number)
        ->get();

        $total_variable_bill_amount = collect($variable_bill_amount)->sum('number_of_units') * collect($variable_bill_amount)->sum('variable_bill_amount');

        $amount = $bill_deposits + $fixed_bill_amount + $total_variable_bill_amount;

        return response()->json($amount, 200);
    }




    public function goTvBill(Request $request)
    {
        $account = $request->account;
        $account_type = 'gotv';
        $vid = 'mrent';

        $datastring = "account=".$account."&account_type=".$account_type."&vid=".$vid;
        $hashkey = "gchygyt65t6fgtr";
        $hashid = hash_hmac("sha256", $datastring, $hashkey);

        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://apis.ipayafrica.com/ipay-billing/billing/validate/account');
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"account=$account&account_type=$account_type&vid=$vid&hash=$hashid");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $data = curl_exec($ch);
        
        curl_close($ch);
        
      return response()->json(json_decode($data));
    }

    public function postPaidBill(Request $request)
    {
        $account = $request->account;
        $account_type = 'kplc_postpaid';
        $vid = 'mrent';

        $datastring = "account=".$account."&account_type=".$account_type."&vid=".$vid;
        $hashkey = "gchygyt65t6fgtr";
        $hashid = hash_hmac("sha256", $datastring, $hashkey);

        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://apis.ipayafrica.com/ipay-billing/billing/validate/account');
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"account=$account&account_type=$account_type&vid=$vid&hash=$hashid");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $data = curl_exec($ch);
        
        curl_close($ch);
        
      return response()->json(json_decode($data));
    }



    public function attachTenantToHouse(Request $request) 
    {
        $unitn = TenantHouse::where('pricing_id', $request->unit_id)->where('unit_number', $request->unit_number)->first();

        if ($unitn) {

            toastr()->error('That house unit has already been allocated');
            
            return redirect()->back();
        }

        $uniq = str_pad(rand(0,99999999),8, "0", STR_PAD_LEFT);

        $data['building_id'] = $request->building_id;
        $data['pricing_id'] = $request->unit_id;
        $data['tenant_id'] = $request->tenant_id;
        $data['unit_number'] = $request->unit_number;
        $data['entry_date'] = $request->entry_date;
        $data['account_number'] = $uniq;
        $data['occupancy_status'] = 1;
        $data['tenant_deposit_amount'] = $request->tenant_deposit_amount;
        $data['tenant_rent_amount'] = $request->tenant_rent_amount;

        TenantHouse::create($data);

        toastr()->success('Tenant Attached to a new unit Successfully');

        return redirect()->back();
    }


    public function vacateNotice(Request $request)
    {
        $request->validate([
            'vacate_notice.*' => 'required|file|mimes:jpg,jpeg,png,gif',
            'account_number' => 'required|max:255',
        ]);


            $data = $request->all();


            $filename = $this->storeNotice($request->vacate_notice, 'vacatenotice', '');

            $data['vacate_notice'] = $filename;
            $data['tenant_id'] = auth()->id();
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


    public function vacateNotices()
    {
        $notices = DB::table('vacate_notices')->select('vacate_notices.id as noticeid', 'building_name', 'unit_type_name', 'label', 'vacate_notices.created_at', 'vacate_notice')
        ->join('tenant_houses', 'tenant_houses.account_number', '=', 'vacate_notices.account_number')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')
        ->where('vacate_notices.tenant_id', auth()->id())->get();

        return view('tenant.vacate-notices', ['notices' => $notices]);
    }

    

}
