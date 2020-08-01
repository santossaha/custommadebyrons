<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use DB;
use Input;
use Image;
use Auth;
use Mail;

class Wishlist extends Model
{
	
	public function GetWishlistData($user_id=''){
		$query = DB::table('wishlists')
					->select('wishlists.*','products.product_name','products.product_alias','products.product_code','products.price','products.discount','product_images.product_image','product_images.default_image')
					->leftJoin('products', 'products.id', '=', 'wishlists.product_id')
					->leftJoin('product_images', 'product_images.product_id', '=', 'wishlists.product_id')
					->where('wishlists.user_id','=',$user_id)
					->where('wishlists.deleted_at',NULL)
					->where('products.status','=','Active')
					->where('products.deleted_at',NULL)
					->where('product_images.default_image','=',1);
		return $data = $query->orderBy('wishlists.id','DESC')->paginate(15);
		
	}
	public function addToWishList($data=''){
		return $res=DB::table('wishlists')->insert($data);
	}
	public function DeleteWishlistItem($id=''){
		return $res =DB::table('wishlists')->where('id', '=', $id)->delete();
	}
	public function getWishlistQtyData($id='',$pid='',$user_id=''){
		$query = DB::table('wishlists')->select('wishlists.*')
				->where('id',$id)
				->where('product_id',$pid)
				->where('user_id',$user_id);
		return $data = $query->first();
	}
	public function QuantityUpdate($data=''){
		return $res=DB::table('wishlists')->where('id','=',$data['id'])->update($data);
	}
	public function getdataByID($id=''){
		$query = DB::table('wishlists')->select('wishlists.*')
				->where('id',$id);
		return $data = $query->first();
	}

}
