<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantTransaction extends Model
{
    protected $fillable = 
    [
    	'tenant_id',
    	'amount_due',
    	'amount_paid',
        'bill_type',
        'building_id',
        'unit_number'
    ];
}