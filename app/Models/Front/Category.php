<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

    protected $table = 'categories';
	protected $dates = ['deleted_at'];

	public function submenu()
	{
		return $this->hasMany('App\Models\Front\SubCategory','category_id','id');
	}
	

}
