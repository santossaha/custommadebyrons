<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\Brand;
use App\Models\Front\Wishlist;
use App\Models\Front\Cart;
use App\Models\Front\Product;
use DB;
use Auth;
use Redirect;


class WishlistController extends Controller{

  public function Wishlist(){
    $pageTitle = 'Wishlist';
    $wish_object = new WishList();
    $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
    $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
    $datums = $wish_object->GetWishlistData($user_id);
    //echo "<pre>";print_r($datums);die;
    if($user_id!='') {
      return view('front.wishlist.wishlist',['pageTitle'=>$pageTitle,'brands'=>$brands,'datums'=>$datums,'user_id'=>$user_id]);
    }
    else{
      return redirect()->route('my_account')->with('error', 'Login first.');
    }
  }
  public function AddWishlist(Request $request){
    $wish_object = new WishList();
    $alldata = $request->post();
    //echo "<pre>";print_r($alldata);die;
    $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
    $data = array(
        'user_id' => $user_id,
        'product_id' => $alldata['product_id'],
        'quantity' => $alldata['quantity'],
        'created_at' => date('Y-m-d h:i:s')
    );
    $chk_data = DB::table('wishlists')->select('wishlists.*')->where('product_id',$alldata['product_id'])->where('user_id',$user_id)->first();
    if($chk_data){
      // $int_res = DB::table('wishlists')->where('id','=',$chk_data->id)->update(['updated_at'=>date('Y-m-d h:i:s')]);
      $int_res = '3';
    }else{
     $int_res = $wish_object->addToWishList($data);
    }
    return json_encode(array('status'=>$int_res,'msg'=>'Product Added to Wishlist','error_msg'=>'Something Went Wrong'));
  }
  public function QuantityUpdate(Request $request){
    //echo "dk";die;
    $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
    $alldata = $request->post();
    $wish_object = new WishList();
    $wish_data =  $wish_object->getWishlistQtyData($alldata['id'],$alldata['pid'],$user_id);
    $cart_quantity = 1;
    $quantity = (($cart_quantity) * ($alldata['total_quantity']));
    $id = $wish_data->id;
    $data = array(
      'id' =>$id,
      'quantity' => $quantity,
      'updated_at' => date('Y-m-d h:i:s')
    );
    if($wish_data){
      $wish_object->QuantityUpdate($data);
      $return = 1;
    }else{
      $return = 2;
    }
    return $return;
  }
  public function WishlistItemDelete(Request $request){
    $wish_object = new WishList();
    $id = $request->id;
    $data = $wish_object->DeleteWishlistItem($id);
  if($data){
    $return = 1;
  }else{
    $return = 2;
  }
  return $return;
  }
  public function WishlistToAddCart(Request $request){
    //echo "string";die;
    $wish_object = new Wishlist();
    $cart_object = new Cart();
    $pro_object = new Product();
    $alldata = $request->post();
    $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
    $wishlist_data = $wish_object->getdataByID($alldata['id']);
    $cart_data =  $cart_object->getCartProductDetailsByID($wishlist_data->product_id,$user_id);
    $product =  $pro_object->getProductDetailsByID($wishlist_data->product_id);
    $cart_quantity= isset($wishlist_data->quantity)?$wishlist_data->quantity:'1';
    if($product->discount!=''){
      $discount = isset($product->discount)?$product->discount:'';
      $price = $product->price;
      $discountprice = ($price*$discount)/100;
      $product_price = $price - $discountprice;
      $actual_price = ($cart_quantity*$product_price);
    }else{
      $product_price = $product->price;
      $actual_price = ($cart_quantity*$product_price);
    }
    $insert_data = array(
        'user_id' => $user_id,
        'product_id' => $wishlist_data->product_id,
        'product_code' => $product->product_code,
        'product_name' => $product->product_name,
        'product_alias' => $product->product_alias,
        'cart_quantity' => $cart_quantity,
        'product_price' => $product_price,
        'total_price' => $actual_price,
        'discount' => $product->discount,
        'original_price' =>$product->price,
        'product_image' => $product->product_image,
        'created_at' => date('Y-m-d h:i:s')
    );
    if(count($cart_data)>0){
      $res = '3';
    }else{
      $res = $cart_object->addToCart($insert_data);
      $wish_object->DeleteWishlistItem($wishlist_data->id);
    }
    return json_encode(array('status'=>$res,'msg'=>'Product Added to Cart'));
  }


}
