<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    protected $table = 'banners';
    use SoftDeletes;
	//protected $dates = ['deleted_at'];
}
