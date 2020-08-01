<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\User;
use App\Models\Front\Brand;
use App\Models\Front\UserProfile;
use App\Models\Front\Country;
use App\Models\Front\State;
use DB;
use Validator;
use Auth;
use Hash;
use Mail;
use Redirect;


class UserController extends Controller{  
    //use AuthenticatesUsers;

  public function activation($hash_number=''){
    $activate = DB::table('users')->select(DB::raw('*'))->where('hash_number', '=', $hash_number)->first();
    if($activate && $activate->email_verification != 1){
      DB::table('users')->where('hash_number', $hash_number)->update(['hash_number' =>'','email_verification' =>1,'status'=>'Active','updated_at' => date('Y-m-d H:i:s')]);
      return redirect()->route('my_account')->with('success', 'Your account has been activated');
    }
    else if($activate && $activate->email_verification == 1) {
      return redirect()->route('my_account')->with('error', 'Your email already activated.');
    }
    else{
      return redirect()->route('my_account')->with('error', 'Session expired ! token is invalid.');
    }
  }
   public function ResendEmailVerificationCheck(Request $request){
      $email = $request->resend_email;
      $checkemail = DB::table('users')->where('email','=',$email)->where('role','=','User')->first();
      if(isset($checkemail) && !empty($checkemail)){
        echo 'true';
      }else{
        echo 'false';
      }
    }
   public function resendEmail(Request $request){
      $checkUser = DB::table('users')->where('email','=',$request->resend_email)->first();
      if(isset($checkUser) && !empty($checkUser)){
          $setting = DB::table('site_settings')->select('*')->get()->first();
          $from_email = $setting->email;//env('MAIL_FROM_ADDRESS');//
          $email_title = $setting->title; 
          $data = array('name' => $checkUser->name,
                         'email' => $request->resend_email,
                         'admin_email'=> $from_email, 
                         'logo' => url($setting->logo),
                         'title' => $setting->title,
                         'copyright' => $setting->copyright,
                         'password' => $checkUser->password,
                         'actual_link' => url('activation/'.$checkUser->hash_number)
                       );
          $usermail = $request->resend_email;
          Mail::send('mail.email_verification', ['data'=> $data], function($message) use ($usermail,$from_email,$email_title) {
          $message->to($usermail, $email_title)
           ->subject('User Verifacation Email');
          $message->from($from_email,$email_title);
          });           
          $hash_key = $checkUser->hash_number;
          $result['success'] = 'true';
          $result['hash_key'] = $hash_key;
      }else{
          $result['success'] = 'false';
          $result['hash_key'] = '';
      }
      echo json_encode($result);
    }
    public function MyProfile()
    {
      $pageTitle = "My Profile";
      $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
      $users = DB::table('users')->where('id',$user_id)->first();
      $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
      if($user_id!=''){
        return view('front.user.my-profile',['pageTitle'=>$pageTitle,'brands'=>$brands,'users'=>$users]);
      }else{
        return redirect()->route('my_account');
      }
    }
    public function ProfileUpdate(Request $request)
    {
      $msg = [
            'name.required' => 'Enter Your Name.',
            'gender.required' => 'Select gender.',
        ];
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
        ], $msg);
      $allData =$request->post();
      $user_id=Auth::guard('web')->user()->id;
      $filename = User::where('id',$user_id)->value('image');
      //echo "<pre>";print_r($filename);die;
        if($request->hasFile('img')){
            $file = $request->file('img');
            $destinationPath ='/uploads/users/';
            $path = public_path().$filename;
            if(file_exists($path) && $filename!=''){
                unlink($path);
            }
            $extension = $file->getClientOriginalExtension();
            $filename = rand(11111, 99999) .time(). '.' . $extension;
            $file->move(public_path() . $destinationPath, $filename);
            $file_path = public_path() . $destinationPath.$filename;
            Image::make($file_path)->save($file_path,100);
            $filename = $destinationPath.$filename;
        }
      $update= DB::table('users')->where('id','=',$user_id)
            ->update([
                'name' =>  $allData['name'],
                'phone' => $allData['phone'],
                'gender' => $allData['gender'],
                'pincode'=>$allData['pincode'],
                'image' => $filename,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
      if($update){
        return redirect()->route('my_profile')->with('success', 'Record successfully updated.');
      }else{
        return redirect()->back()->with('error', 'Record not updated.');
      } 
    }
    public function UserAddress()
    {
      $address_obj = new UserProfile;
      $pageTitle = "User Address";
      $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
      $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
      $user_address = $address_obj->GetUserAddress($user_id);
     // echo "<pre>";print_r($user_address);die;
      if($user_id!=''){
        return view('front.user.user-address',['pageTitle'=>$pageTitle,'brands'=>$brands,'user_address'=>$user_address]);
      }else{
        return redirect()->route('my_account');
      }
    }
    public function AddUserAddress()
    {
      $pageTitle = "Add Address";
      $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
     // echo $user_id;die;
      $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
      $countries = Country::get();
      $states = State::get();
      if($user_id!=''){
        return view('front.user.add-user-address',['pageTitle'=>$pageTitle,'brands'=>$brands,'countries'=>$countries,'states'=>$states]);
      }else{
        return redirect()->route('my_account');
      }
    }
    public function AddAddress(Request $request)
    {
      $address_obj = new UserProfile;
      $msg = [
            'first_name.required' => 'Enter first name.',
            'last_name.required' => 'Enter last name.',
            'email.required' => 'Enter email address.',
            'phone.required' => 'Enter phone number.',
            'address1.required' => 'Enter address.',
            'country.required' => 'Select country.',
            'city.required' => 'Enter city name or town name',
            'state.required' => 'Select state.',
            'pincode.required' => 'Enter pincode.',
          ];
          $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address1' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required|numeric',
          ], $msg);
      $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
      $allData = $request->all();
      
      //echo $user_default_address;die;
      $user_default_address = isset($allData['default_address'])?$allData['default_address']:'';
      //echo $user_default_address;die;
      $chek_address = $address_obj->getDetailsDefaultUseraddress($user_id);
       if($chek_address){
        //echo "string";die;
          $data = array('default_address' => 0);
          $res = $address_obj->UserDefaultAddressUpdate($data,$chek_address->id);
          if($user_default_address!=''){
            //echo "default ok";die;
            $default_address = '1';
          }else{
            //echo "not check";die;
            $default_address = '1';
          }
       }else{
          if($user_default_address!=''){
            //echo "default ok";die;
            $default_address = '1';
          }else{
            //echo "not check";die;
            $default_address = '1';
          }
       }
      $data = array(
            'user_id'       =>$user_id,
            'first_name'    =>$allData['first_name'],
            'last_name'     =>$allData['last_name'],
            'email'         =>$allData['email'],
            'phone'         =>$allData['phone'],
            'company_name'  =>$allData['company_name'],
            'address_one'      =>$allData['address1'],
            'address_two'     =>$allData['address2'],
            'country'       =>$allData['country'],
            'state'         =>$allData['state'],
            'city'          =>$allData['city'],
            'pincode'       =>$allData['pincode'],
            'default_address' => $default_address,
            'status'          =>'Active',
            'created_at'    => date('Y-m-d h:i:s')
        );
      
      $result = $address_obj->addAddress($data);
      if($result){
        return redirect()->route('user_address')->with('success', 'User address insert successfully.');
      }else{
        return redirect()->back()->with('error', 'Something went wrong.');
      }
      //echo "<pre>";print_r($allData);die;
    }
    public function ChangePassword()
    {
      $pageTitle = "Change Password";
      $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
      $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
      if($user_id!=''){
        return view('front.user.user-change-password',['pageTitle'=>$pageTitle,'brands'=>$brands]);
      }else{
        return redirect()->route('my_account');
      }
    }
    public function password_update(Request $request)
    {
      if(Auth::guard('web')->user()){
          $msg = [
            'old_password.required' => 'Enter your old password.',
            'password.required' => 'Enter your password.',
            'confirm_password.required' => 'Enter your confirm password.',
            'confirm_password.same' => 'password does not match.'
          ];
          $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
          ], $msg);
          $allData = $request->post();
          $user_id = Auth::guard('web')->user()->id;
          $user_detail = User::where('id',$user_id)->first();
          $old_password = Hash::make($allData['old_password']);
          $password = Hash::make($allData['password']);
           if(Hash::check($allData['old_password'], $user_detail->password)){
               $update= DB::table('users')->where('id','=',$user_id)
                        ->update(['password' =>  $password,'updated_at' => date('Y-m-d H:i:s')]);
                  if($update) {
                      return redirect()->back()->with('success', 'Password Changed successfully.');
                  }else{
                      return redirect()->back()->with('error', 'Password not updated.');
                  }
           }else{
              return redirect()->back()->with('error', 'Old password does not exists.');
           }
       }else{
          return redirect()->route('my_account');
       }
    }
    public function FetchState(Request $request)
    {
        $country_id = $request->country_id;
        $state_id = isset($request->select_state)?$request->select_state:'';
       // echo $state_id;die;
        $states = State::where('country_id',$country_id)->get();
        //echo "<pre>";print_r($states);die;
        
        
        $output = '<option value="">Select State</option>';
          foreach($states as $row)
          {
            if($state_id==$row->id){
              $selected = 'selected';
            }else{
              $selected = '';
            }
            $output .= '<option value="'.$row->id.'"'.$selected.'>'.$row->name.'</option>';
          }
        return $output;
    }
    public function user_address_delete(Request $request)
    {
      $address_obj = new UserProfile;
      $id = $request->id;
      $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
        if ($id) {
            $delete_id = $address_obj->DeleteUserAddressData($id);
            $last_data = DB::table('user_address')->where('user_id',$user_id)->latest('id')->first();
            //echo "<pre>";print_r($last_data);die;
            if(!empty($last_data)){
              $data = array('default_address' => 1);
              $res = $address_obj->UserDefaultAddressUpdate($data,$last_data->id);
            }
            if($delete_id)
            {
              $return = 1; 
            }
            else
            {
              $return=2;
            }
        }
    return $return;
    }
    public function EditUserAddress()
    {
      if(Auth::guard('web')->user()){
          $user_id = Auth::guard('web')->user()->id;
          $pageTitle = "User Edit Address";
          $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
          $data = UserProfile::where('user_id',$user_id)->where('default_address',1)->first();
          $countries = Country::get();
          $states = State::get();
          //echo "<pre>";print_r($data);die;
           return view('front.user.edit-user-address',['pageTitle'=>$pageTitle,'data'=>$data,'brands'=>$brands,'countries'=>$countries,'states'=>$states]);
       }else{
           return redirect()->route('my_account');
       }
    }
    public function UpdateUserAddress(Request $request)
    {
      //echo "string";die;
      $address_obj = new UserProfile;
      $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
      $data = UserProfile::where('user_id',$user_id)->where('default_address',1)->first();
      $id = $data['id'];
      $allData = $request->all();
      //echo "<pre>";print_r($allData);die;
      $user_default_address = isset($allData['default_address'])?$allData['default_address']:'';
      $chek_address = $address_obj->getDetailsDefaultUseraddress($user_id);
       if($chek_address){
          $data = array('default_address' => 0);
          $res = $address_obj->UserDefaultAddressUpdate($data,$chek_address->id);
          if($user_default_address!=''){
            $default_address = '1';
          }else{
            $default_address = '1';
          }
       }else{
          if($user_default_address!=''){
            $default_address = '1';
          }else{
            $default_address = '1';
          }
       }
      $data = array(
            'id'       => $id,
            'first_name'    =>$allData['first_name'],
            'last_name'     =>$allData['last_name'],
            'email'         =>$allData['email'],
            'phone'         =>$allData['phone'],
            'company_name'  =>$allData['company_name'],
            'address_one'      =>$allData['address1'],
            'address_two'     =>$allData['address2'],
            'country'       =>$allData['country'],
            'state'         =>$allData['state'],
            'city'          =>$allData['city'],
            'pincode'       =>$allData['pincode'],
            'default_address' => $default_address,
            'updated_at'    => date('Y-m-d h:i:s')
        );
      
      $result = $address_obj->UpdateUserAddressData($data);
      if($result){
        return redirect()->route('user_address')->with('success', 'User address update successfully.');
      }else{
        return redirect()->back()->with('error', 'Something went wrong.');
      }
      //echo "<pre>";print_r($allData);die;
    }
}
