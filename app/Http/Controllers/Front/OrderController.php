<?php
namespace App\Http\Controllers\Front;

use App\Models\Admin\Brand;
use App\Models\Admin\Order;
use App\Http\Controllers\Controller;
use DB;
use Redirect;
use Auth;

  class OrderController extends Controller{

    public function myOrder(){
        $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
        $datums = Order::where('user_id',$user_id)->where('order_status',4)->get();
        $brands = Brand::get();
        if($user_id!=''){
            return view('front.myorder.my_order',compact('datums','brands'));
        }else{
            return redirect()->route('my_account');
        }

    }

}
