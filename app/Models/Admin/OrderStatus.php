<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    protected $table = 'order_status';
    public $timestamps = true;
    use SoftDeletes;
}
