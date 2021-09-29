<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingVendor extends Model
{

    protected $fillable = 
    [
    	'building_id',
    	'created_by',
    	'vendor_id'
    ];
}
