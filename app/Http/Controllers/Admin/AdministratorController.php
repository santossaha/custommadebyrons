<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
class AdministratorController extends Controller
{
    public function index()
    {
       if(request()->ajax()) {
            $data=User::where('role','Admin')->where('deleted_at',NULL)->orderBy('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $url_delete = "'".route('admin::delete_admin', ['id' => $data->id])."'";
                    $edit_url = route('admin::profile', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                    if($data->status=='Active'){
                        $edit.='<a href="javascript:admin_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok-circle"></span> </a>';
                    } else{
                        $edit.='<a href="javascript:admin_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-warning" ><span class="glyphicon glyphicon-ban-circle"></span> </a>';
                    }
                    $edit.='</span>';
                    $edit.=' <a data-toggle="modal" data-target="#confirmDelete" class="btn btn-sm btn btn-danger" onclick="getDeleteRoute('.$url_delete.')"><span class="glyphicon glyphicon-trash"></span></a>&emsp;';
                    return $edit;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        $pageTitle="Administrator";
        return view('admin.user.administratorindex',compact('pageTitle'));
    }

    public function add(){
        return view('admin.user.administratoradd');
    }
    public function save(Request $request)
    {
         $msg = [
            'name.required' => 'Enter Your Last Name',
            'email.required' => 'Enter Your Email',
            'email.unique' => 'Email Already Exist',
            'phone.required' => 'Enter Phone Number',
            'phone.digits' => 'Enter Valid Phone Number',
            'phone.min' => 'Enter Valid Phone Number',
            'phone.max' => 'Enter Valid Phone Number',
            'password' => 'Enter password',
            'cpassword' => 'Enter Confirm Password',
            'cpassword' => 'Password and Confirm Password not match',
        ];
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|digits:10|min:10|max:11',
            'password' => 'required',
            'cpassword' => 'required|same:password',
        ], $msg);
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $gender = $request->get('gender');
        $pass = $request->get('password');
        $password = bcrypt($pass);
        $hash = time();
        $hash_number = md5($hash);
        if($request->hasFile('image'))
        {
            $image_name = time().'.'.$request->file('image')->getClientOriginalExtension();
            $destinationPath = public_path('/admin/img/admin_profile/');
            $request->file('image')->move($destinationPath, $image_name);
        }
        $chk_data=User::where('email',$email)->first();
        if($chk_data){
            return redirect()->back()->with('error','Email Already Exist !!!');
        }else{
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt('123456'),
                'phone' => $phone,
                'gender' => $gender,
                'image' => $image_name,
                'role' =>'Admin',
                'type' => 1,
                'email_verification' => 1,
                'status' => 'Active',
                'hash_number' => $hash_number,
                'created_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->back()->with('success','User Added Successfully !!!');
        } 
    }
    public function status(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            User::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-warning" data-toggle="tooltip" data-original-title="Change Status" data-placement="top" onclick="admin_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            User::where('id',$id)->update([
                'status' => 'Active',
            ]);
            $st='Active';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Change Status" data-placement="top" onclick="admin_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ok-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }

    }
    public function delete($id)
    {
       User::where('id',$id)->update([
                'deleted_at' => date('Y-m-d h:i:s'),
            ]);
        return redirect()->back()->with('success', 'Deleted Successfully !!!');
    }
}
