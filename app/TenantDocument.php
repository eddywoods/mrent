<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantDocument extends Model
{
     protected $fillable = 
    [
    	'document_name',
    	'tenant_id',
    	'created_by',
    	'tenant_document'
    ];
}
