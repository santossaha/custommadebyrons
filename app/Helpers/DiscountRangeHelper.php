<?php

namespace App\Helpers;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class DiscountRangeHelper
{

	public static function MaxDiscount()
	{
		$data = array();
		$max = DB::table('products')->where('status','Active')->where('deleted_at',NULL)->max('discount');
		//echo $max;die;
		$divider = 2;
		$parti = 10;
		$cel = ceil($max/$divider);
		//echo $cel;die;
		for($i=1;$i<=$divider;$i++){
			$temp = $parti*$i;
			if($i==$divider){
			   $data[$i]['discount'] = (($temp-$parti)+1).'-'.$max;
			}
			else{
				$data[$i]['discount'] = (($temp-$parti)+1).'-'.$temp;
			}
		}
		return $data;
	}
	public static function MinPrice()
	{
		return $min_price = DB::table('products')->where('status','Active')->where('deleted_at',NULL)->min('price');
	}
	public static function MaxPrice()
	{
		return $max_price = DB::table('products')->where('status','Active')->where('deleted_at',NULL)->max('price');
	}
}
