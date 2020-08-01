<?php

namespace App\Helpers;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class SiteSettingHelper
{

	public static function SiteSetting()
	{
		return $data = DB::table('site_settings')->select('*')->where('id',1)->first();
		
	}
}
