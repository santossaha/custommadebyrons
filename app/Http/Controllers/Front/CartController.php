<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\Cart;
use App\Models\Front\Wishlist;
use App\Models\Front\Product;
use DB;
use Redirect;
use Auth;
  
  class CartController extends Controller{ 

  public function AddCart(Request $request){
  	$cart_object = new Cart();
    $pro_object = new Product();
  	$alldata = $request->post();
    $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
    $product =  $pro_object->getProductDetailsByID($alldata['product_id']);

    $cart_data =  $cart_object->getCartProductDetailsByID($alldata['product_id'],$alldata['user_id']);
    $cart_quantity='1';
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
  			'product_id' => $alldata['product_id'],
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
    // $update_data = array(
    //     'updated_at' => date('Y-m-d h:i:s')
    // );
    if(count($cart_data)>0){
  	  // $id = $cart_data[0]->id;
     //  $res = DB::table('carts')->where('id', $id)->update($update_data);
      $res = '3';
    }else{
      $res = $cart_object->addToCart($insert_data);
    }
		return json_encode(array('status'=>$res,'msg'=>'Product Added to Cart'));
  }
  public function CartItemDelete(Request $request)
  {
    $cart_object = new Cart();
    $id = $request->id;
    $data = $cart_object->DeleteCartItem($id);
  if($data){
    $return = 1; 
  }else{
    $return = 2; 
  }
  return $return;
  }
  public function CartQuantityUpdate(Request $request){
    //echo "dk";die;
    $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
    $alldata = $request->post();
    $cart_object = new Cart();
    $cart_data =  $cart_object->getCartQtyData($alldata['id'],$alldata['pid'],$user_id);
    $cart_quantity = 1;
    $quantity = (($cart_quantity) * ($alldata['total_quantity']));
    $total_price = ($quantity*$cart_data->product_price);
    $id = $cart_data->id;
    $data = array(
      'id' =>$id,
      'cart_quantity' => $quantity,
      'total_price' => $total_price,
      'updated_at' => date('Y-m-d h:i:s')
    );
    if($cart_data){
      $cart_object->QuantityUpdate($data);
      $return = 1;
    }else{
      $return = 2;
    }
    return $return;
  }
  
}
