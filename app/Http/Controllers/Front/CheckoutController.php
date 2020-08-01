<?php
namespace App\Http\Controllers\Front;

use App\Mail\ForgotPassMail;
use App\Mail\Testing;
use App\Models\Admin\Delivery;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\Brand;
use App\Models\Front\Cart;
use App\Models\Front\Country;
use App\Models\Front\State;
use App\Models\Front\UserProfile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;

class CheckoutController extends Controller{

    public function Checkout()
    {
        $pageTitle = "Checkout";
        $user_address_obj = new UserProfile();
        $cart_obj = new Cart();
        $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
        $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
        $countries = Country::get();
        $states = State::get();
        $user_address = $user_address_obj->getAllUseraddress($user_id);
        //echo "<pre>";print_r($user_address);die;
        $datums = $cart_obj->GetCartData($user_id);
        $sub_total = $cart_obj->GetCartSum($user_id);
        $deliverCharge = Delivery::first();
        //echo "<pre>";print_r($sub_total);die;
        if(Auth::guard('web')->user()){
            return view('front.order.checkout',['pageTitle'=>$pageTitle,'brands'=>$brands,'countries'=>$countries,'states'=>$states,'user_address'=>$user_address,'datums'=>$datums,'sub_total'=>$sub_total,'deliverCharge'=>$deliverCharge]);
        }else{
            return redirect()->route('my_account');
        }

    }
    public function CheckoutProcess(Request $request)
    {
        $deliverCharge = Delivery::first();
        $payment_mode = $request->payment_mode;
        $same_billing_shipping = $request->same_billing_shipping;
        $pageTitle = 'Orders';
        $cart_object = new Cart();
        $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
        $cart_data = $cart_object->GetCartData($user_id);
        $bill_details = $cart_object->GetCartSum($user_id);
        $ord_no = "ORD-".time();
        $setting = DB::table('site_settings')->select('*')->where('id','=',1)->first();
        $from_email = $setting->email;
        $email_title = $setting->title;
        $user_details = User::where('id',$user_id)->first();
        $to_mail = $user_details->email;
        $buyer_name = $user_details->name;
        $phone = $user_details->phone;
        $email = $user_details->email;
        $order_total = $bill_details->order_total;
        if($order_total>$deliverCharge->max_delivery_charge){
            $amount = number_format((float)$order_total, 2, '.', '');
        }else{
            $charges = $deliverCharge->delivery_amount;
            $amt = ($order_total + $charges);
            $amount = number_format((float)$amt, 2, '.', '');
        }
        if($payment_mode==1){
            $save_billing_data = DB::table('billing_address')->insertGetId([
                'user_id' => $user_id,
                'order_id' => $ord_no,
                'first_name' => $request->billing_fname,
                'last_name' => $request->billing_lname,
                'email' => $request->billing_email,
                'phone' => $request->billing_phone,
                'company_name' => $request->billing_company_name,
                'address_one' => $request->billing_address_one,
                'address_two' => $request->billing_adddress_two,
                'country_id' => $request->billing_country,
                'state_id' => $request->billing_state,
                'city' => $request->billing_city,
                'zipcode' => $request->billing_zipcode,
                'created_at' => date('Y-m-d h:i:s')
            ]);
            if(!empty($same_billing_shipping)){
                $save_shipping_data = DB::table('shipping_address')->insertGetId([
                    'user_id' => $user_id,
                    'order_id' => $ord_no,
                    'first_name' => $request->shipping_fname,
                    'last_name' => $request->shipping_lname,
                    'email' => $request->shipping_email,
                    'phone' => $request->shipping_phone,
                    'company_name' => $request->shipping_company_name,
                    'address_one' => $request->shipping_address_one,
                    'address_two' => $request->shipping_address_two,
                    'country_id' => $request->country_shipping,
                    'state_id' => $request->state_shipping,
                    'city' => $request->shipping_city,
                    'zipcode' => $request->shipping_zipcode,
                    'created_at' => date('Y-m-d h:i:s')
                ]);
            }else{
                $save_shipping_data = DB::table('shipping_address')->insertGetId([
                    'user_id' => $user_id,
                    'order_id' => $ord_no,
                    'first_name' => $request->billing_fname,
                    'last_name' => $request->billing_lname,
                    'email' => $request->billing_email,
                    'phone' => $request->billing_phone,
                    'company_name' => $request->billing_company_name,
                    'address_one' => $request->billing_address_one,
                    'address_two' => $request->billing_adddress_two,
                    'country_id' => $request->billing_country,
                    'state_id' => $request->billing_state,
                    'city' => $request->billing_city,
                    'zipcode' => $request->billing_zipcode,
                    'created_at' => date('Y-m-d h:i:s')
                ]);
            }
            $sub_total = 0;
            $qty = 0;
            foreach ($cart_data as $value) {
                $order_data = array();
                $sub_total += $value->total_price;
                $qty += $value->cart_quantity;
                $res = DB::table('orders')->insert([
                    'user_id' => $user_id,
                    'product_id' => $value->product_id,
                    'product_code' => $value->product_code,
                    'order_id' => $ord_no,
                    'shipping_id' =>$save_shipping_data,
                    'billing_id' =>$save_billing_data,
                    'product_name' => $value->product_name,
                    'product_alias' =>$value->product_alias,
                    'quantity' =>$value->cart_quantity,
                    'product_price' =>$value->product_price,
                    'total_price' =>$value->total_price, // total price single product
                    'discount' =>$value->discount,
                    'original_price' =>$value->original_price,
                    'product_image' =>$value->product_image,
                    'payment_mode' =>$payment_mode,
                    'status' =>'Active',
                    'order_status'=>4,
                    'created_at' =>date('Y-m-d h:i:s')
                ]);

            }
            if($sub_total>$deliverCharge->max_delivery_charge){
                $charge = 0;
            }
            else{
                $charge = $deliverCharge->delivery_amount;
            }
            $total_amount =  $sub_total + $charge;
            DB::table('order_status')->insert([
                'user_id' => $user_id,
                'order_id' => $ord_no,
                'total_amount' => $total_amount,
                'shipping_charge' => $charge,
                'order_type'=>'COD',
                'qty' => $qty,
                'message' => 'Order is Complete',
                'order_status'=>4,
                'created_at' =>date('Y-m-d h:i:s')
            ]);
            DB::table('carts')->where('id',$value->id)->delete();
            $order_data = DB::table('orders')->where('order_id',$ord_no)->get();
        }else if($payment_mode==2){
            $country_id = $request->billing_country;
            $state_id = $request->billing_state;
            $currency_data =  DB::table('countries')->select('currency_code','name')->where('id',$country_id)->first();
            $currency_code= isset($currency_data->currency_code)?$currency_data->currency_code:'USD';
            $state_data =  DB::table('states')->select('name')->where('id',$state_id)->first();
            $state_name =  isset($state_data->name)?$state_data->name:'';
            try {
                $save_billing_data = DB::table('billing_address')->insertGetId([
                    'user_id' => $user_id,
                    'order_id' => $ord_no,
                    'first_name' => $request->billing_fname,
                    'last_name' => $request->billing_lname,
                    'email' => $request->billing_email,
                    'phone' => $request->billing_phone,
                    'company_name' => $request->billing_company_name,
                    'address_one' => $request->billing_address_one,
                    'address_two' => $request->billing_adddress_two,
                    'country_id' => $request->billing_country,
                    'state_id' => $request->billing_state,
                    'city' => $request->billing_city,
                    'zipcode' => $request->billing_zipcode,
                    'created_at' => date('Y-m-d h:i:s')
                ]);
                if(!empty($same_billing_shipping)){
                    $save_shipping_data = DB::table('shipping_address')->insertGetId([
                        'user_id' => $user_id,
                        'order_id' => $ord_no,
                        'first_name' => $request->shipping_fname,
                        'last_name' => $request->shipping_lname,
                        'email' => $request->shipping_email,
                        'phone' => $request->shipping_phone,
                        'company_name' => $request->shipping_company_name,
                        'address_one' => $request->shipping_address_one,
                        'address_two' => $request->shipping_address_two,
                        'country_id' => $request->country_shipping,
                        'state_id' => $request->state_shipping,
                        'city' => $request->shipping_city,
                        'zipcode' => $request->shipping_zipcode,
                        'created_at' => date('Y-m-d h:i:s')
                    ]);
                }else{
                    $save_shipping_data = DB::table('shipping_address')->insertGetId([
                        'user_id' => $user_id,
                        'order_id' => $ord_no,
                        'first_name' => $request->billing_fname,
                        'last_name' => $request->billing_lname,
                        'email' => $request->billing_email,
                        'phone' => $request->billing_phone,
                        'company_name' => $request->billing_company_name,
                        'address_one' => $request->billing_address_one,
                        'address_two' => $request->billing_adddress_two,
                        'country_id' => $request->billing_country,
                        'state_id' => $request->billing_state,
                        'city' => $request->billing_city,
                        'zipcode' => $request->billing_zipcode,
                        'created_at' => date('Y-m-d h:i:s')
                    ]);

                    foreach ($cart_data as $value) {
                        $order_data = array();
                        $res = DB::table('orders')->insert([
                            'user_id' => $user_id,
                            'product_id' => $value->product_id,
                            'product_code' => $value->product_code,
                            'order_id' => $ord_no,
                            'shipping_id' =>$save_shipping_data,
                            'billing_id' =>$save_billing_data,
                            'product_name' => $value->product_name,
                            'product_alias' =>$value->product_alias,
                            'quantity' =>$value->cart_quantity,
                            'product_price' =>$value->product_price,
                            'total_price' =>$value->total_price,
                            'discount' =>$value->discount,
                            'original_price' =>$value->original_price,
                            'product_image' =>$value->product_image,
                            'payment_mode' =>$payment_mode,
                            'status' =>'Active',
                            'order_status'=>3,
                            'created_at' =>date('Y-m-d h:i:s')
                        ]);

                    }
                }
                $sub_total = 0;
                $qty = 0;
                foreach ($cart_data as $value){
                    $sub_total += $value->total_price;
                    $qty += $value->cart_quantity;
                }
                if($sub_total>$deliverCharge->max_delivery_charge){
                    $charge = 0;
                }
                else{
                    $charge = $deliverCharge->delivery_amount;
                }
                $total_amount =  $sub_total + $charge;

                DB::table('order_status')->insert([
                    'user_id' => $user_id,
                    'order_id' => $ord_no,
                    'total_amount' => $total_amount,
                    'order_type'=>'online',
                    'qty' => $qty,
                    'shipping_charge' => $charge,
                    'message' => 'Order incomplete',
                    'order_status'=>3,
                    'created_at' =>date('Y-m-d h:i:s')
                ]);
                return view('front.order.paypal',compact('total_amount','ord_no'));

            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Order failed');
            }
        }

        if($res){
            return view('front.order.order-success');

        }else{
            return redirect()->back()->with('error', 'Order failed');
        }

    }
    public function order_success(Request $request){
        if($request->payment_status == "Completed"){
            $cart_object = new Cart();
            $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
            $cart_data = $cart_object->GetCartData($user_id);
            $bill_details = $cart_object->GetCartSum($user_id);

            foreach ($cart_data as $value) {
                $order_data = array();
                $res = DB::table('orders')->where('product_code',$value->product_code)->update([
                    'order_status'=>4,
                    'updated_at' =>date('Y-m-d h:i:s')
                ]);

                DB::table('order_status')->where('order_id',$request->order_id)->update([
                    'message' => 'Order is Confirm',
                    'order_status'=>4,
                    'token'=>$request->receiver_id,
                    'updated_at' =>date('Y-m-d h:i:s')
                ]);
                DB::table('carts')->where('id',$value->id)->delete();
            }
        }


        return view('front.order.order-success',['pageTitle'=>'Order Success']);
    }
    public function order_cancel(){
         return view('front.order.order-cancel');
    }




}
