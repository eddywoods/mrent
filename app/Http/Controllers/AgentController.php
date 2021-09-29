<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use DB;
use App\UnitPricing;
use App\Unit;
use App\Bank;
use App\User;
use App\BuildingCommissionSetting;
use App\BuildingPhoto;
use App\BuildingLabel;
use App\VacateNotice;

class AgentController extends Controller
{
    public function index ()
    {

       
    }


    function safeFileName($file)
    {
        
        $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file);
      
        $file = mb_ereg_replace("([\.]{2,})", '', $file);
        return $file;
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

        return view('agent.manage-landlords', ['landlords' => $landlords, 'buildings' => $buildings]);
    }

    public function showLandLord($id) 
    {

        $landlord = User::findOrFail($id);

        return view('agent.landlord-details', ['landlord' => $landlord]);
    }


    public function createBuilding (Request $request) 
    {
        $request->validate([
            'building_name' => 'required|max:255',
            'lat' => 'required|max:255',
            'long' => 'required|max:255',
            'contact_number' => 'required|max:255',
            'account_number' => 'required|max:255',
            'bank_id' => 'required|max:255',
            'grouping_type' => 'required|max:255',
            'commission_value' => 'required|max:255',
        ]);

        if ($request->owned_by) {
            $owned = $request->owned_by;
        } else {
            $owned = auth()->id();
        }
        
        $building['building_name'] = $request->building_name;
        $building['contact_number'] = $request->contact_number;
        $building['account_number'] = $request->account_number;
        $building['bank_id'] = $request->bank_id;
        $building['invoicing_date'] = $request->invoicing_date;
        $building['address_latitude'] = $request->lat;
        $building['address_longitude'] = $request->long;
        $building['grouping_type'] = $request->grouping_type;
        $building['location'] = $request->mapSearchInput;
        $building['created_by'] = auth()->id();
        $building['owned_by'] = $owned;

       $building =  Building::create($building);

       $commis = BuildingCommissionSetting::where('building_id', $building->id)->first();

       if ($commis == null) {
           
        $com['building_id'] = $building->id;
        $com['commission_value'] = $request->commission_value;
 
        BuildingCommissionSetting::create($com);
       }

       if ($request->image) {
        $filename = $this->storePhotos($request->image, 'buildingphoto', '');

       } else {
          $filename = 'cottage.png';
       }
       $data['image_url'] = $filename;
       $data['building_id'] = $building->id;
   
       BuildingPhoto::create($data);

       if ($request->grouping_type == 'one' ) {

        $chucked = array_chunk($request->unit_type, 4);

        foreach ($chucked as $key) {

         if (!empty($key[0]) || !empty($key[1]) || !empty($key[2]) || !empty($key[3])) {
           $unit['unit_type_id'] = $key[0];
           $unit['unit_price'] = $key[1];
           $unit['unit_deposit'] = $key[2];
           $unit['building_id'] = $building->id;
           $unit['number_of_units'] = 1;

           UnitPricing::create($unit);

           $lab = BuildingLabel::where('label', $key[3])->where('building_id', $building->id)->first();

           if ($lab) {
            toastr()->error('Duplicate Unit Label skipped');
           } else {

           $label['building_id'] = $building->id;
           $label['label'] = $key[3];
           $label['unit_id'] = $key[0];

           BuildingLabel::create($label);

            }

         }
        }
           
        } else if ($request->grouping_type == 'group') {

            if ($request->units_file) {
                $file = $request->file('units_file');

                 // File Details 
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $tempPath = $file->getRealPath();
                $fileSize = $file->getSize();
                $mimeType = $file->getMimeType();

                $valid_extension = array("csv");

                // 2MB in Bytes
                $maxFileSize = 2097152; 


                
                if(in_array(strtolower($extension),$valid_extension)){

                   
                    if($fileSize <= $maxFileSize){

                   
                    $location = 'uploads/buildingunits';

                    
                    $file->move($location,$filename);

                    
                    $filepath = public_path($location."/".$filename);

                    
                    $file = fopen($filepath,"r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata );
                        
                       
                        if($i == 0){
                            $i++;
                            continue; 
                        }
                        for ($c=0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);

                   
                    foreach($importData_arr as $importData){

                        $unit_type = Unit::where('unit_type_name', $importData[0])->first();
                        if ($unit_type) {
                           
                            $unit['unit_type_id'] = $unit_type->id;
                            $unit['unit_price'] = $importData[1];
                            $unit['unit_deposit'] = $importData[2];
                            $unit['building_id'] = $building->id;
                            $unit['number_of_units'] = 1;
                 
                            UnitPricing::create($unit);


                            $lab = BuildingLabel::where('label', $importData[3])->where('building_id', $building->id)->first();

                            if ($lab) {
                             toastr()->error('Duplicate Unit Label skipped');
                            } else {
                 
                                $label['building_id'] = $building->id;
                                $label['label'] = $importData[3];
                                $label['unit_id'] = $unit_type->id;
                     
                                BuildingLabel::create($label);
                 
                             }
                           

                        } else {

                            toastr()->error('Wrong Name for unit type');

                        }


                    }

                } else {

                    toastr()->error('File too large. File must be less than 2MB.');

            }

            }else{

                toastr()->error('Invalid File Extension');

            }

            }

    
        }

        toastr()->success('Building Added Successfully');

        return redirect()->route('agent-building-details', $building->id);
    }



    protected function storePhotos($doc, $title)
    {

            $destinationPath = 'Documents/Photos';

            $extension = $doc->getClientOriginalExtension();

            $fileName = $this->safeFileName($title.'-'.date('YmdHis').'.'.$extension);

            $doc->move($destinationPath, $fileName);

           return $fileName;
       
    }
   
   



    public function listBuildings() 
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

         $buildings->map(function($b){
            $units = UnitPricing::where('building_id', $b->id)->sum('number_of_units');

             $b['number_of_units'] = $units;

             return $b;
        });

       
        return view('agent.list-buildings', ['buildings' => $buildings]);
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

        return view('agent.building-details', ['building' => $building, 'bills'=> $bills, 'mbills' => $mbills, 'tenants' => $tenants]);
    }

    public function createB()
    {
        $units= Unit::all(); 

        $banks = Bank::all();

        $landlords = DB::table('user_role')->select('users.id as userid', 'first_name', 'last_name')
        ->join('users', 'users.id', '=', 'user_role.user_id')
        ->join('roles', 'roles.id', '=', 'user_role.role_id')
        ->where('roles.name', '=', 'landlord')
        ->where('users.created_by', auth()->id())
        ->get();

        return view('agent.create-building', ['banks' => $banks, 'units' => $units, 'landlords' => $landlords]);
    }

    public function listTenants()
    {
        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $tenants = DB::table('user_role')
            ->join('users', 'users.id', '=', 'user_role.user_id')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('roles.name', '=', 'tenant')->get();

        return view('agent.list-tenants', ['tenants' => $tenants, 'buildings' => $buildings]);
    }


    public function listBills() {
        $banks = Bank::all();

        $buildings = Building::where('created_by', auth()->id())->orWhere('owned_by', auth()->id())->get();

        $bills = DB::table('bills')
        ->join('banks', 'banks.bank_id', '=', 'bills.bill_bank_id')
        ->where('bills.created_by', auth()->id())->get();

        return view('agent.list-bills', ['bills' => $bills, 'banks' => $banks, 'buildings' => $buildings]);
    }


    public function listRequests ()
    {

        $requests = DB::table('service_requests')->select('service_requests.id as serviceid', 'request_title', 'building_name', 'unit_type_name', 'building_labels.label', 'service_requests.created_at')
        ->join('users', 'users.id', '=', 'service_requests.created_by')
        ->join('buildings', 'buildings.id', '=', 'service_requests.building_id')
        ->join('building_labels', 'building_labels.id', '=', 'service_requests.unit_number')
        ->join('units', 'units.id', '=', 'service_requests.unit_id')
        ->where('buildings.created_by', auth()->id())->get();

        return view('agent.service-requests', ['requests' => $requests]);
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


    public function editBuilding($id)
    {
        return view('agent.edit-building', ['building' => Building::findOrFail($id), 'banks' => Bank::all()]);
    }


    public function deleteBuilding($id)
    {
        Building::destroy($id);

        toastr()->success('building deleted!');

        return redirect()->back();
    }



    public function updateBuilding (Request $request, $id) 
    {
        $building = Building::findOrFail($id);
        
        $building->building_name = $request->building_name;
        $building->contact_number = $request->contact_number;
        $building->account_number = $request->account_number;
        $building->invoicing_date = $request->invoicing_date;
        $building->address_latitude = $request->lat;
        $building->address_longitude = $request->long;
        $building->location = $request->mapSearchInput;

       $building->save();

        toastr()->success('Building Updated Successfully');

        return redirect()->back();
    }


}
