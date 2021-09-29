<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    
    protected $fillable = [
        'bank_id','bank_name'
    ];
}
