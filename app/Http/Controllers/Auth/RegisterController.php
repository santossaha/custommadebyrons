<?php

namespace App\Http\Controllers\Auth;
use App\Mail\Testing;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Auth;
use Redirect;

class RegisterController extends Controller
{


    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
   // protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */


     public function signUp(Request $request){
      $setting = DB::table('site_settings')->select('*')->where('id','=',1)->first();
      $from_email = $setting->email;
      //$from_email = 'developers@gowebbi.com';
      $email_title = $setting->title;
      $allData =$request->post();
     // echo "<pre>";print_r($allData);die;
      $user_data_email = DB::table('users')->select(DB::raw('*'))->WhereNotNull('deleted_at')->orWhere('email_verification','=',2)->where('email', '=', $allData['email'])->first();
         $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i < 32; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
        if(!empty($user_data_email)){
          $id= DB::table('users')->where('id','=',$user_data_email->id)
            ->update([
                'email' => $allData['email'],
                'role' => 'User',
                'type'=>2,
                'name' =>  $allData['name'],
                'password' => Hash::make($allData['password']),
                'phone' => $allData['phone'],
                'status' => 'Inactive',
                'email_verification'=>2,
                'hash_number'=>$randomString,
                //'pincode'=>$allData['pincode'],
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }else{
          $id= DB::table('users')
            ->insertGetId([
                'email' => $allData['email'],
                'role' => 'User',
                'type'=>2,
                'name' =>  $allData['name'],
                'password' => Hash::make($allData['password']),
                'phone' => $allData['phone'],
                'status' => 'Inactive',
                'email_verification'=>2,
                'hash_number'=>$randomString,
                //'pincode'=>$allData['pincode'],
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        if($id){
          $data = array('name' => $allData['name'],
                         'email' => $allData['email'],
                         'admin_email'=> $from_email,
                         'logo' => url($setting->logo),
                         'title' => $setting->title,
                         'copyright' => $setting->copyright,
                         'actual_link' => url('activation/'.$randomString)
                       );
          //echo "<pre>";print_r($data);die;
          $usermail = $allData['email'];
            //Mail::to("swadesh.santoshsaha@gmail.com")->send(new Testing());

          Mail::send('mail.email_verification', ['data'=> $data], function($message) use ($usermail,$from_email,$email_title) {
          $message->to($usermail, $email_title)
            ->subject('User Registration Email');
            $message->from($from_email,$email_title);
           });
           return redirect()->route('my_account')->with('success', 'Successfully registered. Check your email and activate your account.');
        }
        else{
          return redirect()->back()->with('error', 'Something went wrong');

        }


    }
    public function checkEmailSignup(Request $request){
        $email = $request->email;
        $checkemail = DB::table('users')->where('email','=',$email)->first();
        if(!empty($checkemail) && ($checkemail->email_verification == 1 && $checkemail->deleted_at == NULL)){
         echo 'false';
       }else if(!empty($checkemail) && ($checkemail->email_verification == 1 && $checkemail->deleted_at != NULL)){
         echo 'false';
       }else{
         echo 'true';
       }
  }


}
