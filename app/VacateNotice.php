<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacateNotice extends Model
{
    protected $fillable =
    [
        'tenant_id',
        'vacate_notice',
        'account_number',
        'notice_status'
    ];
}
