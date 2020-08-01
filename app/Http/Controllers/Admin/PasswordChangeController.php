<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function changePassForm()
    {
        $email = User::where('id',Auth::user()->id)->value('email');
        return view('admin.password.changePassword',compact('email'));
    }

    public function ChangePass(Request $request)
    {
        $msg = [
            'old_pass.required' => 'Enter Your Old Password',
            'new_pass.required' => 'Enter Your New Password',
            'confirm_pass.required' => 'Enter Your Confirm Pasword',
        ];
        $this->validate($request, [
            'old_pass' => 'required',
            'new_pass' => 'required',
            'confirm_pass' => 'required|same:new_pass',
        ], $msg);
        $old_pass=$request->old_pass;
        $new_pass=$request->new_pass;
        $confirm_pass=$request->confirm_pass;
        $id=Auth::user()->id;
        $pass=User::where('id',$id)->value('password');
        if(Hash::check($old_pass,$pass)){
            if($new_pass==$confirm_pass){
                $password=Hash::make($new_pass);
                $changePass=User::where('id',$id)->update([
                    'password' => $password,
                ]);
                if($changePass==true){
                    return redirect()->back()->with('success',"Password Updated Sucessfully !!!" );
                }
            }
            else{
                return redirect()->back()->with('error',"New Password and Confirm Password are Not Matched !!!" );
            }
        }
        else{
            return redirect()->back()->with('error',"Old Password Not Matched !!!" );
        }

    }
}
