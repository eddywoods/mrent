<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantHouse extends Model
{

    protected $fillable = 
    [
        'building_id',
        'pricing_id',
        'tenant_id',
        'unit_number',
        'tenant_deposit_amount',
        'tenant_rent_amount',
        'unit_id',
        'account_number',
        'occupancy_status',
        'vacate_date',
        'entry_date'
    ];
}
