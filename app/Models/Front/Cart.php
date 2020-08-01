<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use DB;
use Auth;

class Cart extends Model
{
	
	public function addToCart($data=''){
		return $res=DB::table('carts')->insert($data);
	}
	// public function addToCartUpdate($id=''){
	// 	return $res=DB::table('carts')->where('id','=',$id)->update(['updated_at'=>date('Y-m-d h:i:s')]);
	// }
	public function getCartProductDetailsByID($product_id='',$user_id=''){
		$query = DB::table('carts')
				->select('carts.*')
                ->where('product_id',$product_id)
                ->where('user_id',$user_id);
        return $data = $query->get();

	}
	public function DeleteCartItem($id=''){
		return $res =DB::table('carts')->where('id', '=', $id)->delete();
	}
	public function getCartQtyData($id='',$pid='',$user_id=''){
		$query = DB::table('carts')->select('carts.*')
				->where('id',$id)
				->where('product_id',$pid)
				->where('user_id',$user_id);
		return $data = $query->first();
	}
	public function QuantityUpdate($data=''){
		return $res=DB::table('carts')->where('id','=',$data['id'])->update($data);
	}
	public function GetCartData($user_id=''){
		$query = DB::table('carts')
					->select('*')
					->where('user_id','=',$user_id)
					->where('deleted_at',NULL);
		return $data = $query->orderBy('id','DESC')->get();
	}
	public function GetCartSum($user_id=''){
		$query = DB::table("carts")
			    ->select(DB::raw("SUM(carts.total_price) as order_total"))
			    ->where('carts.user_id','=',$user_id)
				->where('carts.deleted_at',NULL)
			    ->groupBy('carts.user_id');
		return $data = $query->orderBy('carts.id','DESC')->first();
	}
	

}
