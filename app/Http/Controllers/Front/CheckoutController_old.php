<?php
namespace App\Http\Controllers\Front;

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
    //echo "<pre>";print_r($sub_total);die;
      if(Auth::guard('web')->user()){
        return view('front.order.checkout',['pageTitle'=>$pageTitle,'brands'=>$brands,'countries'=>$countries,'states'=>$states,'user_address'=>$user_address,'datums'=>$datums,'sub_total'=>$sub_total]);
      }else{
        return redirect()->route('my_account');
      }

  }
  public function CheckoutProcess(Request $request)
  {
    $payment_mode = $request->payment_mode;
    $same_billing_shipping = $request->same_billing_shipping;
   // echo $payment_mode;die;
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
    if($order_total>499){
      $amount = number_format((float)$order_total, 2, '.', '');
    }else{
      $charges = '199.00';
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
          'order_status'=>4,
          'created_at' =>date('Y-m-d h:i:s')
        ]);
        DB::table('carts')->where('id',$value->id)->delete();
        DB::table('order_status')->insert([
            'user_id' => $user_id,
            'product_id' => $value->product_id,
            'order_id' => $ord_no,
            'message' => 'Order is Confirm',
            'order_status'=>4,
            'created_at' =>date('Y-m-d h:i:s')
            ]);
      }
      $order_data = DB::table('orders')->where('order_id',$ord_no)->get();
    }else if($payment_mode==2){
      $country_id = $request->billing_country;
      $state_id = $request->billing_state;
      $currency_data =  DB::table('countries')->select('currency_code','name')->where('id',$country_id)->first();
      $currency_code= isset($currency_data->currency_code)?$currency_data->currency_code:'USD';
      $state_data =  DB::table('states')->select('name')->where('id',$state_id)->first();
      $state_name =  isset($state_data->name)?$state_data->name:'';
      //echo $country_id;die;
      //echo config('services.stripe.secret');die;
      try {
            Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $customer = \Stripe\Customer::create([
              'name' => $buyer_name,
              'email' => $to_mail,
              'source' => $request->stripeToken,
              'address' => [
                'line1' => $request->billing_address_one,
                'postal_code' => $request->billing_zipcode,
                'city' => $request->billing_city,
                'state' => $state_name,
                'country' => $currency_data->name,
              ],
              ]);
            //echo "<pre>";print_r($customer);
                $charge = Stripe\Charge::create ([
                    'customer'=>$customer['id'],
                    "amount" => $amount*100,
                    "currency" => $currency_code,
                    "description" => "Simonrustic Design Payment",
                    'metadata' => [
                        'quantity' => 3,
                    ],
                ]);
                //echo "<pre>";print_r($charge);die;
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
                    'order_status'=>4,
                    'created_at' =>date('Y-m-d h:i:s')
                ]);
                DB::table('carts')->where('id',$value->id)->delete();
                DB::table('order_status')->insert([
                  'user_id' => $user_id,
                  'product_id' => $value->product_id,
                  'order_id' => $ord_no,
                  'message' => 'Order is Confirm',
                  'order_status'=>4,
                  'created_at' =>date('Y-m-d h:i:s')
                ]);
              }
              $order_data = DB::table('orders')->where('order_id',$ord_no)->get();
              $payment_id = $charge->id;
              $transaction_id = $charge->balance_transaction;
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Order failed');

        }

    }
     // echo "<pre>";print_r($order_data);die;
        if($res){

          // $data = array('name' => $user_details->name,
          //                'email' => $to_mail,
          //                'admin_email'=> $from_email,
          //                'view_manage_link' => url('orders'),
          //                'order_no' => $ord_no,
          //                'payment_mode' =>$payment_mode
          //              );
          // $order_address = array(
          //     'first_name' => $request->billing_fname,
          //     'last_name' => $request->billing_lname,
          //     'email' => $request->billing_email,
          //     'phone' => $request->billing_phone,
          //     'company_name' => $request->billing_company_name,
          //     'address_one' => $request->billing_address_one,
          //     'address_two' => $request->billing_adddress_two,
          //     'country_id' => $request->billing_country,
          //     'state_id' => $request->billing_state,
          //     'city' => $request->billing_city,
          //     'zipcode' => $request->billing_zipcode,
          //     );
          //echo "<pre>";print_r($data);die;
          // Mail::send('front.email.order-details', ['data'=> $data,'order_data'=>$order_data,'bill_details'=>$bill_details,'order_address'=>$order_address,'setting'=>$setting], function($message) use ($to_mail,$from_email,$email_title) {
          // $message->to($to_mail, $email_title)
          //   ->subject('Product Order Email');
          //   $message->from($from_email,$email_title);
          //  });
           // Session::set('variableName', $value);

             $ord_det = [
                'order_id' => $ord_no,
                'payment_id' => isset($payment_id)?$payment_id:'',
                'transaction_id' => isset($transaction_id)?$transaction_id:''
                ];
              return redirect()->route('order_success',$ord_det);

        }else{
             return redirect()->back()->with('error', 'Order failed');

        }

     }
     public function order_success(Request $request){
      $data = $request->all();
      return view('front.order.order-success',['pageTitle'=>'Order Success','data'=>$data]);
     }



}
