<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = 
    [
    'bill_name',
    'created_by',
    'bill_account_name',
    'bill_bank_id',
    'bill_account_number'
    ];
}