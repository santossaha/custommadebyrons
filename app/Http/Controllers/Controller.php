<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Auth;
use Request;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static function CartCount(){
      return $cartCount = DB::table("carts")->where('deleted_at', NULL)->where('user_id','=',Auth::guard('web')->user()->id)->count();
    }
    public static function GetCartSum(){
		$query = DB::table("carts")
			    ->select(DB::raw("SUM(carts.total_price) as cart_total"))
			    ->where('carts.user_id','=',Auth::guard('web')->user()->id)
				->where('carts.deleted_at',NULL)
			    ->groupBy('carts.user_id');
		return $data = $query->orderBy('carts.id','DESC')->first();
	}
	public static function GetCartData(){
		$query = DB::table("carts")
			    ->select('*')
			    ->where('carts.user_id','=',Auth::guard('web')->user()->id)
				->where('carts.deleted_at',NULL);
		return $data = $query->orderBy('carts.id','DESC')->get();
	}
}
