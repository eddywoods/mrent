<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = [
        'building_name',
        'contact_number',
        'account_number',
        'bank_id',
        'address_latitude',
        'address_longitude',
        'owned_by',
        'created_by',
        'location',
        'invoicing_date',
        'grouping_type'
    ];
}
