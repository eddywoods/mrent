<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = 
    [
   		    'request_title',
            'created_by',
            'building_id',
            'unit_id',
            'description',
            'unit_number'
    ];
}
