<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use App\Traits\ApiResponser;
use App\Bank;
use App\Unit;
use App\UnitPricing;
use App\Bill;
use DB;
use App\HouseBill;
use App\BuildingDocument;
use App\BuildingPhoto;
use App\CaretakerHouse;
use App\BuildingLabel;

class BuildingController extends Controller
{

    use ApiResponser;

    public function index() 
    {

    }

    public function create(){

        $units= Unit::all(); 

        $banks = Bank::all();

        return view('landlord.create-building', ['banks' => $banks, 'units' => $units]);
    }

    public function storeUnitType(Request $request) 
    {
        $rules = [
            'unit_type_name' => 'required|max:255|unique:units',
        ];

        $this->validate($request, $rules);

        Unit::create($request->all());

        toastr()->success('Unit Type added');

        return redirect()->back();
    }


    public function attachBill(Request $request) 
    {
        $rules = [
            'bill_id' => 'required|max:255',
            'building_id' => 'required|max:255',
            'bill_type' => 'required|max:255',
            'bill_deposit' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $request['created_by'] = auth()->id();

        if ($request->bill_type == 'fixed') {
            $request['fixed_bill_amount'] = $request->fixed_bill_amount;
            $request['bill_frequency'] = $request->bill_frequency;
        } else if ($request->bill_type == 'variable'){
            $request['variable_bill_amount'] = $request->variable_bill_amount;
        }

        HouseBill::create($request->all());

        toastr()->success('Bill Attached');


        return redirect()->back();
    }



    public function addBill(Request $request)
    {

        $rules = [
            'bill_name' => 'required|max:255',
            'bill_account_name' => 'required|max:255',
            'bill_bank_id' => 'required|max:255',
            'bill_account_number' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $request['created_by'] = auth()->id();

        Bill::create($request->all());

        toastr()->success('Bill Created');

        return redirect()->back();
    }




    public function landlordCreateBuilding (Request $request) 
    {
        $request->validate([
            'building_name' => 'required|max:255',
            'lat' => 'required|max:255',
            'long' => 'required|max:255',
            'contact_number' => 'required|max:255',
            'account_number' => 'required|max:255',
            'bank_id' => 'required|max:255',
            'grouping_type' => 'required|max:255',
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
                        $num = count($filedata);
                        
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

        return redirect()->route('landlord-building-details', $building->id);
    }



   




    public function landlordListBuildings() 
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
       
        return view('landlord.list-buildings', ['buildings' => $buildings]);
    }


    function safeFileName($file)
    {
        
        $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file);
      
        $file = mb_ereg_replace("([\.]{2,})", '', $file);
        return $file;
    }

    public function storeBuildingDocument(Request $request)
    {
           $rules = [
                'building_document.*' => 'required|file|mimes:pdf,jpg,jpeg,png,docx',
                'document_name' => 'required|max:255',
                'building_id' => 'required|max:255',
            ];

            $this->validate($request, $rules);

            $data = $request->all();

            $filename = $this->storeDocument($data['building_document'], 'Building Document', '');

            $data['created_by'] = auth()->id();

            $data['building_document'] = $filename;
            $data['document_name'] = $request->document_name;
            $data['building_id'] = $request->building_id;

            BuildingDocument::create($data);
            
            toastr()->success('File uploaded Successfully');

        return redirect()->back();
    }



    public function storeBuildingPhotos(Request $request)
    {
        $request->validate([
            'image.*' => 'required|file|mimes:jpg,jpeg,png,gif',
            'building_id' => 'required|max:255',
        ]);

        if ($request->image) {
            $filename = $this->storePhotos($request->image, 'buildingphoto', '');

            $data['image_url'] = $filename;
            $data['building_id'] = $request->building_id;
        
            BuildingPhoto::create($data);

            toastr()->success('Photos uploaded Successfully');

            return redirect()->back();

        } else {

            toastr()->error('No Image Selected');

            return redirect()->back();

        }

        
    }





    protected function storeDocument($doc, $title)
    {

            $destinationPath = 'Documents/Building';

            $extension = $doc->getClientOriginalExtension();

            $fileName = $this->safeFileName($title.'-'.date('YmdHis').'.'.$extension);

            $doc->move($destinationPath, $fileName);

           return $fileName;
       

    }


   

    public function agentcreateUnitType() {

        $units= Unit::all(); 

        return view('agent.unit-types', ['units' => $units]);
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

    
        return view('landlord.building-details', ['building' => $building, 'bills'=> $bills, 'mbills' => $mbills, 'tenants' => $tenants, 'documents' => $documents, 'photos' => $photos, 'labels' => $labels, 'units' => $units, 'houseunits' => $houseunits, 'caretakers' => $caretakers]);
    }


    public function agentShowBuilding($id)
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


        $documents = BuildingDocument::where('building_id', $id)->get();

        $photos = BuildingPhoto::where('building_id', $id)->get();

        $labels = BuildingLabel::where('building_id', $id)->get();

        $units = DB::table('units')->select('units.id as unitid', 'units.unit_type_name')
        ->join('unit_pricings', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->where('building_id', $id)->get();


    
        return view('agent.building-details', ['building' => $building, 'bills'=> $bills, 'mbills' => $mbills, 'tenants' => $tenants, 'documents' => $documents, 'photos' => $photos, 'labels' => $labels, 'units' => $units, 'houseunits' => $houseunits]);
    }


  

    public function landlordServiceRequests()
    {
        return view('landlord.service-requests');
    }

    public function addLabel (Request $request)
    {

        $request->validate([
            'building_id' => 'required|max:255',
            'label' => 'required|max:255',
            'unit_id' => 'required|max:255',
            'unit_price' => 'required|max:255',
            'unit_deposit' => 'required|max:255',

        ]);

        $lab = BuildingLabel::where('label', $request->label)->where('building_id', $request->building_id)->first();

        if ($lab) {

        toastr()->error('Unit Label exists');

        return redirect()->back();

        } else {

            $unitlab = UnitPricing::where('building_id', $request->building_id)->where('unit_type_id', $request->unit_id)->first();

            if ($unitlab) {

                $unitlab->number_of_units = $unitlab->number_of_units + 1;
                $unitlab->save();


                $label['building_id'] = $request->building_id;
                $label['label'] = $request->label;
                $label['unit_id'] = $request->unit_id;

                BuildingLabel::create($label);


                toastr()->success('Unit added Successfully');

                return redirect()->back();

                
            } else {


            $unit['unit_type_id'] = $request->unit_id;
            $unit['unit_price'] = $request->unit_price;
            $unit['unit_deposit'] = $request->unit_deposit;
            $unit['building_id'] = $request->building_id;
            $unit['number_of_units'] = 1;

            UnitPricing::create($unit);

            $label['building_id'] = $request->building_id;
            $label['label'] = $request->label;
            $label['unit_id'] = $request->unit_id;

            BuildingLabel::create($label);


            toastr()->success('Unit added Successfully');

            return redirect()->back();


            }


        }


    }

    public function landlordHouseUnits()
    {
        $houseunits = DB::table('unit_pricings')
        ->join('buildings', 'buildings.id', '=', 'unit_pricings.building_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->where('buildings.created_by', auth()->id())
        ->get();

        $houseunits->map(function($u){
           return $u->number_of_units = UnitPricing::where('unit_type_id', $u->unit_type_id)
           ->where('unit_pricings.building_id', $u->building_id)
           ->sum('number_of_units');
        });


        return view('landlord.house-units', ['houseunits' => $houseunits]);
    }

    public function agentHouseUnits()
    {
        $houseunits = DB::table('unit_pricings')
        ->join('buildings', 'buildings.id', '=', 'unit_pricings.building_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
        ->get();

        $houseunits->map(function($u){
           return $u->number_of_units = UnitPricing::where('unit_type_id', $u->unit_type_id)
           ->where('unit_pricings.building_id', $u->building_id)
           ->sum('number_of_units');
        });


        return view('agent.house-units', ['houseunits' => $houseunits]);
    }




    public function landlordVacantHouseUnits()
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


        return view('landlord.vacant-units', ['vacantunits' => $vacantunits]);
    }

    public function agentVacantHouseUnits()
    {

    
        $vacantunits = DB::table('unit_pricings')->select('unit_pricings.id as pricingid', 'buildings.building_name', 'units.unit_type_name', 'unit_pricings.unit_type_id', 'unit_pricings.building_id', 'unit_pricings.unit_price', 'unit_pricings.unit_deposit')
        ->join('buildings', 'buildings.id', '=', 'unit_pricings.building_id')
        ->join('units', 'units.id', '=', 'unit_pricings.unit_type_id')
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


        return view('agent.vacant-units', ['vacantunits' => $vacantunits]);
    }



    public function edit($id)
    {
        return view('landlord.edit-building', ['building' => Building::findOrFail($id), 'banks' => Bank::all()]);
    }


    public function delete($id)
    {
        Building::destroy($id);

        toastr()->success('building deleted!');

        return redirect()->back();
    }



    public function update (Request $request, $id) 
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
