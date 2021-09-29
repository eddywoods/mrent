<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceVendor extends Model
{
     protected $fillable = 
    [
    	'service_id',
    	'created_by',
    	'vendor_id'
    ];
}
