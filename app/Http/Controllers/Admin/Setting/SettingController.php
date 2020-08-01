<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
class SettingController extends Controller
{
    public function index()
    {
         if(request()->ajax()) {
            $data=Setting::where('deleted_at',NULL)->where('id',1)->get();
            //echo "<pre>";print_r($data);die;
            return DataTables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function ($data) {
                    $edit_url = route('admin::edit_setting', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                    
                    //$edit.='</span>';
                    
                    return $edit;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        $pageTitle="Setting";
        return view('admin.setting.index',compact('pageTitle'));
    }
   
    public function edit($id){
        $info = Setting::where('id', $id)->first();
        return view('admin.setting.edit', compact('info'));
    }
    public function update(Request $request,$id)
    {
        $msg = [
            'title.required' => 'Enter Site Name.',
            'email.required' =>'Enter Site Email.',
            'support_email.required' => 'Enter Support Email.',
            'phone.digits' => 'Enter Valid Phone Number',
            'phone.min' => 'Enter Valid Phone Number',
            'phone.max' => 'Enter Valid Phone Number',
            'mobile.digits' => 'Enter Valid Mobile Number',
            'mobile.min' => 'Enter Valid Mobile Number',
            'mobile.max' => 'Enter Valid Mobile Number',
        ];
        $this->validate($request, [
            'title' => 'required',
            'email' => 'required|email',
            'support_email' => 'required|email',
            'phone' => 'required|digits:10|min:10|max:11',
            'mobile' => 'required|digits:10|min:10|max:11',
            'image' => 'mimes:jpeg,jpg,png,gif'
        ], $msg);
        $filename = Setting::where('id',$id)->value('logo');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $destinationPath ='/uploads/logo/';
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
            Setting::where('id',$id)->update([
                'title' => $request->title,
                'email' => $request->email,
                'support_email' => $request->support_email,
                'mobile' => $request->mobile,
                'phone' => $request->phone,
                'copyright' => $request->copyright,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'google_plus' => $request->google_plus,
                'youtube' => $request->youtube,
                'address' => $request->address,
                'logo' => $filename

            ]);
            return redirect()->back()->with('success', 'Updated Successfully !!!');
    }
   
    
    
}
