<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
	
   use SoftDeletes;

    protected $table = 'pages';
	protected $dates = ['deleted_at'];
}
