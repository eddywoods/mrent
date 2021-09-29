<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseBill extends Model
{
    protected $fillable = [
        'bill_id',
        'building_id',
        'fixed_bill_amount',
        'bill_frequency',
        'bill_type',
        'bill_deposit',
        'variable_bill_amount',
        'created_by'
    ];
}