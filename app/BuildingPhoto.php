<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingPhoto extends Model
{
    protected $fillable = 
    [
    	'image_url',
    	'building_id',
    	'created_by',
    ];
}
