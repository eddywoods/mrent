<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;
use App\Vendor;
use App\Service;
use App\ServiceVendor;
use App\BuildingVendor;
use App\Bank;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function landLordVendors()
    {
        $buildings = Building::where('created_by', auth()->id())->get();
        $services = Service::where('created_by', auth()->id())->get();

        $vendors = Vendor::where('created_by', auth()->id())->get();

        $banks = Bank::all();

        return view('landlord.vendors.index', ['buildings' => $buildings, 'vendors' => $vendors, 'services' => $services, 'banks' => $banks]);
    }

    public function agentVendors()
    {
        $buildings = Building::where('created_by', auth()->id())->get();
        $services = Service::where('created_by', auth()->id())->get();

        $vendors = Vendor::where('created_by', auth()->id())->get();

        $banks = Bank::all();

        return view('agent.vendors.index', ['buildings' => $buildings, 'vendors' => $vendors, 'services' => $services, 'banks' => $banks]);
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:users',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'id_number' => 'required|max:255',
            'postal_address' => 'required|max:255',
            'account_number' => 'required|max:255',
            'bank_id' => 'required|max:255',
        ]);

        $dat['created_by'] = auth()->id();
        $dat['email'] = $request->email;
        $dat['middle_name'] = $request->middle_name;
        $dat['last_name'] = $request->last_name;
        $dat['first_name'] = $request->first_name;
        $dat['phone_number'] = $request->phone_number;
        $dat['id_number'] = $request->id_number;
        $dat['postal_address'] = $request->postal_address;
        $dat['account_number'] = $request->account_number;
        $dat['bank_id'] = $request->bank_id;


        $vendor = Vendor::create($dat);


        if ($request->building_id) {

            $buildings = Building::whereIn('id', $request->building_id)->get();

            foreach ($buildings as $key) {
            
                $data['building_id'] = $key->id;
                $data['created_by'] = auth()->id();
                $data['vendor_id'] = $vendor->id;

                BuildingVendor::create($data);
            }
        } 



        if ($request->service_id) {

            $services = Service::whereIn('id', $request->service_id)->get();

            foreach ($services as $key) {
                $data['service_id'] = $key->id;
                $data['created_by'] = auth()->id();
                $data['vendor_id'] = $vendor->id;

                ServiceVendor::create($data);
            }
        } 

        toastr()->success('Vendor Created');

        return redirect()->back();
    }

    public function landlordServices()
    {
        $services = Service::where('created_by', auth()->id())->get();

        return view('landlord.services', ['services' => $services]);
    }

    public function agentServices()
    {
        $services = Service::where('created_by', auth()->id())->get();

        return view('agent.services', ['services' => $services]);
    }


    public function createService(Request $request)
    {

        $validated = $request->validate([
            'service_name' => 'required|max:255|unique:services',
        ]);
        
        $validated['created_by'] = auth()->id();

        Service::create($validated);

        toastr()->success('Service Added!');

        return redirect()->back();
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
}
