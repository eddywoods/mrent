<?php

use Illuminate\Database\Seeder;
use App\GlobalCommissionSetting;

class GlobalCommission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commission = new GlobalCommissionSetting;
        $commission->commission_value = 1;
        $commission->save();
    
    }
}
