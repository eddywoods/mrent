<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingCommissionSetting extends Model
{
    protected $fillable = 
    [
        'building_id', 'commission_value'
    ];
}
