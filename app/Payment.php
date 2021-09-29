<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

  protected $fillable = 
  [
    'tenant_id', 'payment_reason', 'amount', 'payment_method', 'payment_description', 'transaction_number', 'transaction_date', 'account'
  ];
}
