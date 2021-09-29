<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCache extends Model
{
    protected $fillable = [
        'surname', 'other_name', 'id_number', 'gender', 'first_name', 'dob',
        'citizenship'
    ];
}
