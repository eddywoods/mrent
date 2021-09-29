<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = 
    [
   		    'expense_name',
            'created_by',
            'building_id',
            'unit_id',
            'amount',
            'description',
            'unit_number'
    ];
}
