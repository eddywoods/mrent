<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingLabel extends Model
{
    protected $fillable = 
    [
    	'label',
    	'building_id',
    	'unit_id',
    ];
}
