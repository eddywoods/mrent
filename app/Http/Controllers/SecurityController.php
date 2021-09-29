<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SMS;
use App\Traits\ApiResponser;
use Auth, DB;
use App\Role;
use App\Traits\IprsSearch;
use App\TenantHouse;
use App\CsvData;
use Excel;
use Session;
use App\Building;
use PDF;
use App\Jobs\SendBidLease;
use App\UnitPricing;
use App\CaretakerHouse;

class SecurityController extends Controller
{

    use ApiResponser, IprsSearch;

    public function signup (Request $request) 
    {

        $rules = [
            'email' => 'required|email|max:255|unique:users',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => 'required|max:255|unique:users',
            'id_number' => 'required|max:255|unique:users',
            'user_type' => 'required|max:255',
            'citizenship' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $request['password'] = Hash::make($request->password);

        $usr = User::create($request->all());

        $usr['requires_password_change'] = 0;
        $usr['created_by'] = auth()->id();

        $usr->save();

        if ($request->user_type == 'landlord') {
            $usr->roles()->attach(Role::where('name', '=', 'landlord')->first());
        } else if ($request->user_type == 'agent') {
            $usr->roles()->attach(Role::where('name', '=', 'agent')->first());
        } else if ($request->user_type == 'tenant') {
            $usr->roles()->attach(Role::where('name', '=', 'tenant')->first());
        } else {

            \Session::put('error', 'Wrong User Type provided');

            return redirect()->back();

        }

        $msg = 'You have successfully registered as a '. $request->user_type .' on Mrent. Welcome Onboard';


    
        if ($request->user_type == 'tenant') {
            $data['building_id'] = $request->building_id;
            $data['pricing_id'] = $request->unit_id;
            $data['tenant_id'] = $usr->id;
            $data['unit_number'] = $request->unit_number;
            $data['tenant_rent_amount'] = $request->tenant_rent_amount;
            $data['tenant_deposit_amount'] = $request->tenant_deposit_amount;

            TenantHouse::create($data);
        }

        \Session::put('success', 'User Created successfully');

        return redirect()->back();
    }


    public function createUser (Request $request) 
    {
        // dd($request->all());

        $rules = [
            'email' => 'required|email|max:255|unique:users',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'id_number' => 'required|max:255',
            'user_type' => 'required|max:255',
            'citizenship' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $pass = str_pad(rand(0,999999),6, "0", STR_PAD_LEFT);

        $request['password'] = Hash::make($pass);
      
        $request['created_by'] = auth()->id();

        $usr = User::create($request->all());

        $usr['requires_password_change'] = 1;
        $usr->save();

        if ($request->user_type == 'landlord') {
            $usr->roles()->attach(Role::where('name', '=', 'landlord')->first());
        } else if ($request->user_type == 'agent') {
            $usr->roles()->attach(Role::where('name', '=', 'agent')->first());
        } else {

            \Session::put('error', 'Wrong User Type provided');

            return redirect()->back();

        }

        $msg = "You have been successfully registered as  $request->user_type  on M-rent. Login with password $pass";

        mrentSMS($msg, $request->phone_number);

        toastr()->success('User Created successfully');

        return redirect()->back();

    
}



public function agentCreateTenant (Request $request) 
{

    $validated = $request->validate([
        'email' => 'required|email|max:255|unique:users',
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'phone_number' => 'required|max:255',
        'id_number' => 'required|max:255',
        'citizenship' => 'required|max:255',
        'unit_number' => 'required|max:255',
    ]);


    $pass = str_pad(rand(0,999999),6, "0", STR_PAD_LEFT);

    $validated['password'] = Hash::make($pass);
  
    $validated['created_by'] = auth()->id();

    $usr = User::create($validated);

    $usr['requires_password_change'] = 1;
    $usr->save();

    $usr->roles()->attach(Role::where('name', '=', 'tenant')->first());

    $msg = "You have been successfully registered as a tenant on M-rent. Login with password $pass, Check your email address for your tenancy agreement";

    mrentSMS($msg, $request->phone_number);

    $unitn = TenantHouse::where('pricing_id', $request->unit_id)->where('unit_number', $request->unit_number)->first();

    if ($unitn) {

        toastr()->error('That house unit has already been allocated');
        
        return redirect()->back();
    }

    $uniq = str_pad(rand(0,99999999),8, "0", STR_PAD_LEFT);

    $data['building_id'] = $request->building_id;
    $data['pricing_id'] = $request->unit_id;
    $data['tenant_id'] = $usr->id;
    $data['unit_number'] = $request->unit_number;
    $data['entry_date'] = $request->entry_date;
    $data['account_number'] = $uniq;
    $data['occupancy_status'] = 1;
    $data['tenant_deposit_amount'] = $request->tenant_deposit_amount;
    $data['tenant_rent_amount'] = $request->tenant_rent_amount;

    $house = TenantHouse::create($data);

    $rent = UnitPricing::where('unit_type_id', $request->unit_id)->first();

    if ($rent) {
        $rent_amount = $rent->unit_price;
        $deposit_amount = $rent->unit_deposit;
    } else {
        $rent_amount = $request->tenant_rent_amount;
        $deposit_amount = $request->tenant_deposit_amount;
    }

    $building = Building::where('id', $request->building_id)->first();

    $dat['t_first_name'] = $request->first_name;
    $dat['t_last_name'] = $request->last_name;
    $dat['l_first_name'] = auth()->user()->first_name;
    $dat['l_last_name'] = auth()->user()->last_name;
    $dat['rent_amount'] = $rent_amount;
    $dat['h_location'] = $building->location;
    $dat['deposit_amount'] = $deposit_amount;
    $dat['entry_date'] = $house->entry_date;
    $dat['building_name'] = $building->building_name;

    $pdf = PDF::loadView('tenancy-agreement', $dat);
    $pd = $pdf->output();
    $doc_raw = base64_encode($pd);

    dispatch(new SendBidLease($usr, $doc_raw));

    toastr()->success('Tenant created successfully');

    return redirect()->route('agent-tenant-details', $usr->id);


}





public function landlordCreateTenant (Request $request) 
{

    $validated = $request->validate([
        'email' => 'required|email|max:255|unique:users',
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'phone_number' => 'required|max:255',
        'id_number' => 'required|max:255',
        'citizenship' => 'required|max:255',
        'unit_number' => 'required|max:255',
    ]);


    $unitn = TenantHouse::where('pricing_id', $request->unit_id)->where('unit_number', $request->unit_number)->first();

    if ($unitn) {

        toastr()->error('That house unit has already been allocated');
        
        return redirect()->back();
    }


    $pass = str_pad(rand(0,999999),6, "0", STR_PAD_LEFT);

    $validated['password'] = Hash::make($pass);
  
    $validated['created_by'] = auth()->id();

    $usr = User::create($validated);

    $usr['requires_password_change'] = 1;
    $usr->save();

    $usr->roles()->attach(Role::where('name', '=', 'tenant')->first());

    $msg = "You have been successfully registered as a tenant on M-rent. Login with password $pass, Check your email address for your tenancy agreement";

    mrentSMS($msg, $request->phone_number);

    $uniq = str_pad(rand(0,99999999),8, "0", STR_PAD_LEFT);

    $data['building_id'] = $request->building_id;
    $data['pricing_id'] = $request->unit_id;
    $data['tenant_id'] = $usr->id;
    $data['unit_number'] = $request->unit_number;
    $data['entry_date'] = $request->entry_date;
    $data['account_number'] = $uniq;
    $data['occupancy_status'] = 1;
    $data['tenant_deposit_amount'] = $request->tenant_deposit_amount;
    $data['tenant_rent_amount'] = $request->tenant_rent_amount;

    $house = TenantHouse::create($data);

    $rent = UnitPricing::where('unit_type_id', $request->unit_id)->first();

    if ($rent) {
        $rent_amount = $rent->unit_price;
        $deposit_amount = $rent->unit_deposit;
    } else {
        $rent_amount = $request->tenant_rent_amount;
        $deposit_amount = $request->tenant_deposit_amount;
    }

    $building = Building::where('id', $request->building_id)->first();

    $dat['t_first_name'] = $request->first_name;
    $dat['t_last_name'] = $request->last_name;
    $dat['l_first_name'] = auth()->user()->first_name;
    $dat['l_last_name'] = auth()->user()->last_name;
    $dat['rent_amount'] = $rent_amount;
    $dat['h_location'] = $building->location;
    $dat['deposit_amount'] = $deposit_amount;
    $dat['entry_date'] = $house->entry_date;
    $dat['building_name'] = $building->building_name;

    $pdf = PDF::loadView('tenancy-agreement', $dat);
    $pd = $pdf->output();
    $doc_raw = base64_encode($pd);

    dispatch(new SendBidLease($usr, $doc_raw));

    toastr()->success('Tenant created successfully');

    return redirect()->route('landlord-tenant-details', $usr->id);


}




//caretaker creation

public function landlordCreateCaretaker (Request $request) 
{

    $validated = $request->validate([
        'email' => 'required|email|max:255|unique:users',
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'phone_number' => 'required|max:255',
        'id_number' => 'required|max:255',
        'citizenship' => 'required|max:255',
    ]);


    $pass = str_pad(rand(0,999999),6, "0", STR_PAD_LEFT);

    $validated['password'] = Hash::make($pass);
  
    $validated['created_by'] = auth()->id();

    $usr = User::create($validated);

    $usr['requires_password_change'] = 1;
    $usr->save();

    $usr->roles()->attach(Role::where('name', '=', 'caretaker')->first());

    $msg = "You have been successfully registered as a caretaker on M-rent. Login with password $pass";

    mrentSMS($msg, $request->phone_number);


    $data['building_id'] = $request->building_id;
    $data['caretaker_id'] = $usr->id;
    
    CaretakerHouse::create($data);

    toastr()->success('Caretaker created successfully');

    return redirect()->back();

}



public function tenantsUpload(Request $request)
{

    $rules = [
        'building_id' => 'required|max:255',
    ];

    $this->validate($request, $rules);

        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $path = $request->file('excel_file')->getRealPath();

        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }

        if (count($data) > 0) {
            if ($request->has('header')) {
            $csv_header_fields = [];
            foreach ($data[0] as $key => $value) {
            $csv_header_fields[] = $key;
        }

        }
        $csv_data = array_slice($data, 0, 2);

            $csv_data_file = CsvData::create([
        'csv_filename' => $request->file('excel_file')->getClientOriginalName(),
        'csv_header' => $request->has('header'),
        'csv_data' => json_encode($data),
        'building_id' => $request->building_id
    ]);
    
    } else {
        return redirect()->back();
    }

    return view('landlord.import-process', ['csv_header_fields' => $csv_header_fields, 'csv_data' => $csv_data, 'csv_data_file' => $csv_data_file, 'buildings' => $buildings]);
    }


    public function processImport (Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);

        foreach ($csv_data as $row) {
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {

                    self::searchAndSaveUser($row, $data->building_id);
                  
                } else {

                    self::searchAndSaveUser($row[$request->fields[$index]], $csv_data->building_id);
                    
                }
            }
         
    }

        Session::flash('success', 'upload completed successfully!');

    return redirect()->back();
    }


    function searchAndSaveUser($data, $building_id)
    {

         $resp = $this->searchById($data);

        if ($resp) {

        if ($resp['first_name'] != strtoupper($data['first_name'])) {

            \Session::put('error', 'Wrong first name provided for that ID number');

            return redirect()->back();

        } else if($resp['surname'] != strtoupper($data['last_name'])) {

            \Session::put('error', 'Wrong last name provided for that ID number');

            return redirect()->back();

        }

        if ($resp['valid']) {

        $user = User::where('id_number', $data['id_number'])
            ->where('phone_number', $data['phone_number'])->exists();

        if (!$user) {
            $pass = str_pad(rand(0,999999),6, "0", STR_PAD_LEFT);

            $data['password'] = Hash::make($pass);

            $data['created_by'] = auth()->id();
            $data['user_type'] = 'tenant';
    
            $usr = User::create($data);
    
            $usr['requires_password_change'] = 1;

            $usr->save();


            $usr->roles()->attach(Role::where('name', '=', 'tenant')->first());


            $dat['building_id'] = $building_id;
            $dat['tenant_deposit_amount'] = $data['tenant_deposit_amount'];
            $dat['tenant_rent_amount'] = $data['tenant_rent_amount'];
            $dat['tenant_id'] = $usr->id;
            $dat['unit_number'] = $data['unit_number'];
            $dat['unit_id'] = $data['unit_id'];

            TenantHouse::create($dat);

    
            $this->dispatch(
                new SMS($data['phone_number'], 'You have been successfully registered as a Tenant on BeeDee. Login with password ' .$pass)
            );
    

            \Session::put('success', 'Tenants Uploaded successfully');

            return redirect()->back();

        } else {

            \Session::put('error', 'User already exists, kindly login');

            return redirect()->back();

        }

        } else {

            \Session::put('error', 'Invalid ID Number');

            return redirect()->back();

        }

        } else {

            \Session::put('error', 'We were unable to validate your registration details, kindly try again');

            return redirect()->back();
        }
    }




    public function login (Request $request) 
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        $this->validate($request, $rules);

        $response = Request::create('/oauth/token','POST',[
                'grant_type' => 'password',
                'client_id' => env('PASSPORT_ID'),
                'client_secret' => env('PASSPORT_SECRET'),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ]
        );

        $token = app()->handle($response);

        return $this->successResponse($token->content(), $token->status());
    }

    public function initialize() 
    {
        if (Auth::guard('api')->user()) {
            $user = Auth::guard('api')->user()->only(['id', 'email', 'requires_password_change', 'first_name', 'last_name', 'phone_number']);


            $user['role'] = DB::table('user_role')->select('roles.name')
            ->join('users', 'users.id', '=', 'user_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('user_role.user_id', $user['id'])->first();

            return $this->successResponse($user, 200);
        } else {
            return $this->errorMessage('user not logged in', 401);
        }
    }


    public function logout()
    {
        $accessToken = Auth::guard('api')->user()->token();

        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        return response()->json(['status' => 200]);
    }


    public function changePassword(Request $request) {

        $rules = [
            'current_password' => 'required|max:191',
            'new_password' => 'required|min:6|confirmed',
        ];

        $this->validate($request, $rules);

        $user = Auth::guard('api')->user();

        $old_password = Auth::guard('api')->user()->password;

        if (Hash::check($request->current_password, $old_password)) {
           $usr = User::findOrFail($user->id);

           $usr->password = Hash::make($request->new_password);

           $usr->save();

           return $this->successResponse('password change success', 200);

        } else {

            return $this->errorMessage('Wrong Current Password, Please try again!', 400);

        }

    }


}

