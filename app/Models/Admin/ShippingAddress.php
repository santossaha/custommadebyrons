<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $table = 'shipping_address';
    public $timestamps = true;
   // use SoftDeletes;
}
