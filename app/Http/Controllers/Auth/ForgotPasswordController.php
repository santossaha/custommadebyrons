<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Validator;
use App\Models\Front\Brand;
use DB;
use Auth;
use Hash;
use Mail;
use Redirect;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }
    public function PasswoprdEmailVerificationCheck(Request $request){
      $email = $request->forgot_email;
      $checkemail = DB::table('users')->where('email','=',$email)->where('role','=','User')->first();
      if(isset($checkemail) && !empty($checkemail)){
        echo 'true';
      }else{
        echo 'false';
      }
    }
     public function ForgetPasswordGenerateLink(Request $request){
        $data = $request->post();
        //echo "<pre>";print_r($data);die;
        $settings= DB::table('site_settings')->first();
        $site_name = $settings->title;
        $admin_email = $settings->email;
        $user_details = DB::table('users')->where('email', '=', $data['forgot_email'])->where('email_verification','=',1)->where('role','=','User')->where('deleted_at','=',NULL)->first();

        if($user_details){
           $token = str_random(60);
            $chk = DB::table('password_resets')->where('email','=',$user_details->email)->first();
            if($chk){
                DB::table('password_resets')->where('email','=',$user_details->email)->update(array('token' => $token,'updated_at'=>date('Y-m-d h:i:s')));
            }
            else{
                $exeQuery = DB::table('password_resets')->insertGetId(array(
                    'email' => $user_details->email, 'token' => $token,'created_at'=>date('Y-m-d h:i:s'))
                );  
            }
            $email = $user_details->email;
            $content = ['email' => $email, 'token' => $token,'title'=>$settings->title,'admin_email'=>$settings->email,'logo'=> url($settings->logo),'copyright'=>$settings->copyright];
            Mail::send('mail.forgot-password', ['content' => $content], function ($message)use($email,$site_name,$admin_email) {
                $message->from($admin_email, $name =$site_name);
                $message->to($email, $name = null);
                $message->subject("Forgot Password");
            });
            //return redirect()->back()->with('success', 'Mail has been send with the password reset link');
             $result['success'] = 'true';
        }
        else{
             $result['success'] = 'false';
        }
         echo json_encode($result);
    }
     public function ResetPass(Request $request){
        $token = $request['tn'];
        $email = $request['me'];
        $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
        $chk = DB::table('password_resets')->where('email','=',$email)->where('token','=',$token)->first();
        if($chk){
            //echo "string";die;
            return view('front.auth.update-password',['email'=>$email,'brands'=>$brands,'pageTitle'=>'Update Password']);
        }
        else{
            //echo "ok";die;
            return redirect()->route('my_account')->with('error', 'Session has been expired or invalid token.');
        }
        
    }
     public function CreateNewpassword(Request $request){
        $data = $request->post();
        $user = DB::table('users')->where('email', '=', $data['email'])->where('role','=','User')->first();
        if(($user) && ($data['password']==$data['cpassword'])) {
            $up_data['password'] = Hash::make($data['password']);
            $up_data['updated_at'] = date('Y-m-d h:i:s');
            $res = DB::table('users')->where('email', '=', $data['email'])->update($up_data);
            DB::table('password_resets')->where('email','=',$data['email'])->delete();
            return redirect()->route('my_account')->with('success', 'Password Successfully Reset');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
