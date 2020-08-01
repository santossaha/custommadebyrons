<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Hash;
use Mail;
use Redirect;
class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login.login');
    }
    public function Check_login(Request $request)
    {
        $msg = [
            'username.required' => 'Enter Your Email',
            'password.required' => 'Enter Your Password',
        ];
        $this->validate($request, [
            'username' => 'bail|required|email',
            'password' => 'bail|required|alphaNum|min:3'

        ], $msg);
        $remember_me = $request->has('remember_me') ? true : false;
        $email = $request->get('username');
        $pass = $request->get('password');
        //echo $pass;die;
        if (Auth::attempt(array('email' => $email, 'password' => $pass,'role'=>'Admin'), $remember_me)) {
            $check_email = Auth::user()->email;
            $request->session()->put('email', $check_email);
            $role = Auth::user()->role;
            $type = Auth::user()->type;
            $request->session()->put('type', $type);
            if($role=='Admin') {
              
                return redirect(route('admin::dashboard'));
            }
        } else {
            
            return redirect()->back()->with('error', 'Login Failed !!! Please check Your Email and Password.');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/admin-login')->with('logout','Logout Successfully !!!');
    }
    public function sendResetLinkEmail(Request $request) {
        //echo "string";die;
        $msg = [
            'email.required' => 'Enter Your Email'
        ];
        $this->validate($request, [
            'email' => 'required|email'

        ], $msg);
        $user = DB::table('users')->select('*')->where('email',$request->post('email'))->first();
        if($user) {
            // Generate a new code and password
            $token = str_random(60);
            $password = str_random(10);
            $user->password = Hash::make($password);
            $check_data = DB::table('password_resets')->select('*')->where('email','=',$request->post('email'))->first();
            if($check_data){
               $exeQuery = DB::table('password_resets')->where('id', $check_data->id)->update(array('token' => $token,'updated_at'=>date('Y-m-d h:i:s')));
            }else{
                 $exeQuery = DB::table('password_resets')->insert(
                ['email' => $user->email, 'token' => $token,'created_at'=>date('Y-m-d h:i:s')]);
            }
             $url = url('admin-password/reset',$token);
             $content = ['email' => $user->email, 'token' => $token,'name'=>$user->name,'url'=>$url];
             Mail::to($user->email)->send(new ForgotPassMail($content));
            if($exeQuery) {
                return redirect()->back()->with('success', 'Please check your mail for recover password.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid email address.');
        }

        //}
    }
     public function showResetForm($token) {
        $exeQuery = DB::table('password_resets')->where('token', $token);
        if($exeQuery->count()==0) {
            return Redirect::route('admin_login')->with('error', 'Your reset password token is invalid.');
        }else{
            return view('admin.login.resetpassword',['token'=>$token]);
        }
    }
    public function postResetPassword(Request $request) {
        $token = $request->token;
        $password = $request->password;
        $confirm_password = $request->confirm_password;
        $msg = [
            'password.required' => 'Enter your new password',
            'password.min' => 'Enter minimum three characters',
            'confirm_password.required' => 'Enter confirm password',
            'confirm_password.same' => 'Password does not match.'
        ];
        $this->validate($request, [
            'password' => 'required|min:3',
            'confirm_password' => 'required|same:password'

        ], $msg);
             $exeQuery = DB::table('password_resets')->where('token', $token);
            if($exeQuery->count()) {
                $getUser = $exeQuery->first();
                $getEmail = $getUser->email;
                $user = DB::table('users')->where('email', $getEmail);
                if($user->count()) {
                    $exeQuery = DB::table('users')->where('email', $getEmail)->update(array('password' => Hash::make($password)));
                    //echo $exeQuery; die;
                    if($exeQuery) {
                        $exeQuery = DB::table('password_resets')->where('token', $token)->update(array('token' => '', 'updated_at'=> date('Y-m-d H:i:s')));
                        return redirect()->route('admin_login')->with('success', 'New password successfully set.');
                    }
                } else {
                    return Redirect::route('admin_login')->with('error', 'We could not reset your password please try again later.');
                }
            } else {
                return Redirect::route('admin_login')->with('error', 'We could not reset your password for invalid token.');
            }
        //}
    }
    
}
