<?php

namespace App\Helpers;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class BrandHelper
{

	public static function Brands()
	{
		return $data = DB::table('brands')->select('id','brand_name','brand_alias')->where('status','Active')->where('deleted_at',NULL)->get();
		
	}
}
