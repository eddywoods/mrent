<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaretakerHouse extends Model
{
    protected $fillable = [
        'building_id', 'caretaker_id'
    ];
}
