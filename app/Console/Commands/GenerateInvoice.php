<?php

namespace App\Console\Commands;
use App\TenantTransaction;
use DB;
use Carbon\Carbon;

use Illuminate\Console\Command;

class GenerateInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates invoices every invoicing day of the month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $units = DB::table('tenant_houses')
        ->join('buildings', 'buildings.id', '=', 'tenant_houses.building_id')
        ->join('users', 'users.id', '=', 'tenant_houses.tenant_id')
        ->join('unit_pricings', 'unit_pricings.id', '=', 'tenant_houses.pricing_id')
        ->join('building_labels', 'building_labels.id', '=', 'tenant_houses.unit_number')->get();


        $units->map(function($u){

            if ($u->tenant_rent_amount == null) {
             
                return $u->upcoming_rent_amount = $u->unit_price;
    
            } else {

               return $u->upcoming_rent_amount = $u->tenant_rent_amount;

            }

        });
        

        foreach ($units as $key) {


            $payments = DB::table('tenant_transactions')
            ->where('building_id', $key->building_id)
            ->where('unit_number', $key->label)
            ->whereMonth('tenant_transactions.created_at', Carbon::now()
            ->month)->sum('amount_paid');

            $data['tenant_id'] = $key->tenant_id;
            $data['amount_due'] = $key->upcoming_rent_amount;
            $data['amount_paid'] = $payments;
            $data['bill_type'] = 'rent';
            $data['building_id'] = $key->building_id;
            $data['unit_number'] = $key->label;

            TenantTransaction::create($data);

            $balance = (int) $key->upcoming_rent_amount - $payments;

            $msg = "Hi, $key->first_name kindly note that your invoice of $balance has been generated. Remember to make payment withing the next 10 days. Regards";


            mrentSMS($msg, $key->phone_number);
    
        }

    }
}
