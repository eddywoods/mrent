<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Vendor extends Model
{
    protected $fillable = 
    [
    	'first_name',
    	'middle_name',
    	'last_name',
    	'phone_number',
    	'id_number',
    	'email',
    	'postal_address',
    	'created_by',
    	'building_id',
    	'service_id',
    	'account_number',
    	'bank_id'
    ];
}
