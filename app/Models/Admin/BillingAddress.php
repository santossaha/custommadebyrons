<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingAddress extends Model
{

    protected $table = 'billing_address';
    public $timestamps = true;
    use SoftDeletes;
}
