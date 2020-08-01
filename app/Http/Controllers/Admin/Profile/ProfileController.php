<?php

namespace App\Http\Controllers\Admin\Profile;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index($id)
    {
        $userById=User::where('id',$id)->first();
        return view('admin.profile.index',compact('userById'));
    }
    public function profile_update(Request $request)
    {
        $msg = [
            'name.required' => 'Enter Your  First Name',
            'email.required' => 'Enter Your Email',
            'phone.digits' => 'Enter valid phone number',
            'phone.min' => 'Enter valid phone number',
            'phone.max' => 'Enter valid phone number',
        ];
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'digits:10|min:10|max:11',
        ], $msg);
        $id = $request->get('id');
        $image_name=User::where('id',$id)->value('image');
        if($request->hasFile('image'))
        {
            @unlink(public_path() . '/admin/img/admin_profile/'. $image_name);
            $image_name = time().'.'.$request->file('image')->getClientOriginalExtension();
            $destinationPath = public_path('/admin/img/admin_profile/');
            $request->file('image')->move($destinationPath, $image_name);
        }
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $gender = $request->get('gender');
        User:: where('id',$id)->update([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'gender' => $gender,
            'image' => $image_name,
        ]);

        return redirect()->back()->with('success', 'Profile Updated Successfully !!!');
    }
}
