<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantBill extends Model
{

    protected $fillable = [
        'bill_id',
        'tenant_id',
        'number_of_units',
        'payment_status',
        'building_id',
        'unit_id',
        'unit_number'
    ];
}
