<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubCategory extends Model
{
	use SoftDeletes;
	
    protected $table = 'sub_categories';
	protected $dates = ['deleted_at'];

	public function menu()
    {
        return $this->belongsTo('App\Models\Front\Category');
    }
   
}
