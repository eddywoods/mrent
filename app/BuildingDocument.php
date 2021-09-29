<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingDocument extends Model
{
    protected $fillable = 
    [
    	'document_name',
    	'building_id',
    	'created_by',
    	'building_document'
    ];
}
