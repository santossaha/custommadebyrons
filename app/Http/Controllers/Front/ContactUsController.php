<?php
namespace App\Http\Controllers\Front;
use App\Helpers\SiteSettingHelper;
use App\Mail\Testing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\Brand;
use Illuminate\Support\Facades\Mail;
use DB;
//use Mail;
use validator;
class ContactUsController extends Controller{
  public function __construct(){

  }
  public function contact_us()
  {
    $pageTitle = "Contact Us";
    $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
      $setting = SiteSettingHelper::SiteSetting();
      $prepAddr = str_replace(' ','+',strip_tags($setting->address));
      $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$prepAddr.'&key=AIzaSyDfwQIMbBbS_PPlvZlbhywFgHy2hL00DgU');
      $output= json_decode($geocode);
      $latitude = $output->results[0]->geometry->location->lat;
      $longitude = $output->results[0]->geometry->location->lng;
    return view('front.contact.contact',['brands'=>$brands,'pageTitle'=>$pageTitle,'latitude'=>$latitude,'longitude'=>$longitude]);
  }
  public function checkSubEmail(Request $request){
    $email = $request->sub_email;
    $checkemail = DB::table('subscribes')->where('email','=',$email)->first();
    if(isset($checkemail) && !empty($checkemail)){
      echo 'false';
    }else{
      echo 'true';
    }
  }


  public function newsletter(Request $request){
    $msg = [
            'sub_email.required' => 'Enter Your Email.',
        ];
        $this->validate($request, [
            'sub_email' => 'required|email|unique:subscribes',
        ], $msg);
    $email = $request->sub_email;
    DB::table('subscribes')->insert(['email' => $email, 'created_at' => date('Y-m-d h:i:s')]);
    $return = 1;
    return $return;
  }
  public function save_contact_us(Request $request)
  {

   /* $msg = [
        'con_name' => 'Enter Your Name.',
        'con_email.required' => 'Enter Your Email.',
        'con_phone.required' => 'Enter Your Phone Number.',
        'con_sub.required' => 'Enter Subject.',
        'con_msg.required' => 'Enter Message.'
        ];
        $this->validate($request, [
        'con_name' => 'required',
        'con_email' => 'required|email',
        'con_phone' => 'required',
        'con_sub' => 'required',
        'con_msg' => 'required',
        ], $msg);*/
    $email = $request->con_email;
    $name = $request->con_name;
    $phone = $request->con_phone;
    $subject = $request->con_sub;
    $message = $request->con_msg;
    $chk_data = DB::table('contcat_us')->select('*')->where('email',$email)->first();
    if($chk_data){
      $save_data = DB::table('contcat_us')->where('id',$chk_data->id)->update(['email' => $email,'name'=>$name,'phone'=>$phone,'subject'=>$subject,'message'=>$message, 'updated_at' => date('Y-m-d h:i:s')]);
    }else{
      $save_data = DB::table('contcat_us')->insert(['email' => $email,'name'=>$name,'phone'=>$phone,'subject'=>$subject,'message'=>$message, 'created_at' => date('Y-m-d h:i:s')]);
    }
    $site_setting = DB::table('site_settings')->select('*')->where('id','=',1)->first();

    $emails =array();
    if($save_data){
      $data = array(
              'name' => $name,
              'email' => $email,
              'phone' => $phone,
              'message' => $message,
              'site_title' => $site_setting->title,
              'site_logo' => $site_setting->logo,
              'site_email'=> $site_setting->email,
              'copyright'=> $site_setting->copyright
            );
            $admin = Db::table('users')->where('role', '=','Admin')->where('deleted_at',NULL)->where('type',1)->get()->all();
            //echo '<pre>';print_r($admin);die;
            if(isset($admin) && !empty($admin)){
                foreach ($admin as $key => $val) {
                 // echo $val->email;
                $emails[] = $val->email;
                }
            }
            //echo '<pre>';print_r($email);die;

               $adminemail = $emails;
                $from_mail = $site_setting->email;
                $title = $site_setting->title;
                $user_email = $email;

                Mail::send('mail.contact', ['data'=> $data], function($message) use ($adminemail,$from_mail,$title) {
                     $message->to($from_mail, 'Contact Us')
                    ->subject('Contact Us');
                    $message->from($from_mail,$title);
                });
                Mail::send('mail.contact-us', ['data'=> $data], function($message) use ($user_email,$from_mail,$title) {
                    $message->to($user_email, 'Contact Us')
                        ->subject('Contact Us');
                    $message->from($from_mail,$title);
                });


             $return = 1; 
          }else{
            $return = 2;
          }
   
    return $return;
  }
  
}