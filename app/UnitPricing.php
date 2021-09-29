<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitPricing extends Model
{

    protected $fillable = 
    [
        'building_id',
        'unit_type_id',
        'number_of_units',
        'unit_price',
        'unit_deposit',
        'unit_number',
    ];
}
