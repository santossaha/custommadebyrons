<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Front\Brand;
use App\User;
use Auth;
use Redirect;
use DB;
use Hash;
use Mail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   protected function guard(){
       return Auth::guard('web');
    }
    public function account(){
      if(!Auth::guard('web')->user()){
        $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
       // echo "<pre>";print_r($brands);die;
         return view('front.auth.my-account',['pageTitle'=>'My Account','brands'=>$brands]);
      }
      else{
        return Redirect::to('/');
      }
    }
    public function login(Request $request)
    {

        $allData = $request->post();
        $email = $allData['login_email'];
        $pass  = $allData['login_password'];
        $users = DB::table('users')->select('status','email_verification','type','role')->where('email','=',$email)->first();
        //echo '<pre>';print_r($users);die;
        if(isset($users) && !empty($users)){
            if($users->status == 'Active' && $users->email_verification == '1' && $users->type == '2' && $users->role== 'User'){
                $data = [
                    'email'     => $email,
                    'password'  => $pass,
                    'status'  => 'Active',
                    'email_verification'=>1,
                    'deleted_at' => NULL,
                ];
                $login = Auth::guard('web')->attempt($data);
                if($login){
                   $role = Auth::guard('web')->user()->role;
                      if($role=='User'){
                        return redirect()->route('home')->with('success', 'Successfully logged in');
                      }
                      else
                      {
                        return redirect()->back()->with('error', 'Invalid users credentials');
                      }
                }else{
                   return redirect()->back()->with('error', 'Email or password is incorrect');
                }
            }else if($users->status != 'Active' && $users->email_verification == '1' && $users->type == '2'){
                return redirect()->back()->with('error', 'Your account is suspended');
            }else if($users->status == 'Active' && $users->email_verification != '1' && $users->type == '2'){
                return redirect()->back()->with('error_verified', 'Your email is not verified. if you want verify your email ');
            }else if($users->status == 'Active' && $users->email_verification == '1' && $users->type != '2'){
                return redirect()->back()->with('error', 'Invalid users credentials');
            }else{
                return redirect()->back()->with('error_verified', 'Your email is not verified. if you want verify your email plz check email');
            }
        }else{
            return redirect()->back()->with('error', 'Invalid users credentials');
        }
    }
    public function logout() {
        Auth::guard('web')->logout();
        return redirect()->route('my_account')->with('success', 'Successfully logged out.');
    }

}
