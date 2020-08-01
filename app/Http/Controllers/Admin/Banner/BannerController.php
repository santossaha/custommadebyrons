<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Models\Admin\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
class BannerController extends Controller
{
    public function index()
    {
         if(request()->ajax()) {
            $data=Banner::where('deleted_at',NULL)->orderBy('id','desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $image = '<img src="' . url($data->image) . '" width="100px" height="100px"/>';
                    return $image;
                })
                ->addColumn('action', function ($data) {
                    $url_delete = "'".route('admin::delete_banner', ['id' => $data->id])."'";
                    $edit_url = route('admin::edit_banner', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                    if($data->status=='Active'){
                        $edit.='<a href="javascript:banner_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok-circle"></span> </a>';
                    } else{
                        $edit.='<a href="javascript:banner_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-warning" ><span class="glyphicon glyphicon-ban-circle"></span> </a>';
                    }
                    $edit.='</span>';
                    $edit.=' <a data-toggle="modal" data-target="#confirmDelete" class="btn btn-sm btn btn-danger" onclick="getDeleteRoute('.$url_delete.')"><span class="glyphicon glyphicon-trash"></span></a>&emsp;';
                    return $edit;
                })
                ->rawColumns(['action','image'])
                ->toJson();
        }
        $pageTitle="Banners";
        return view('admin.banner.index',compact('pageTitle'));
    }
    public function add(){
        $pageTitle = "Add Banner";
        return view('admin.banner.add',compact('pageTitle'));
    }
    public function save(Request $request)
    {
         $msg = [
            'title.required' => 'Enter Banner Title.',
            'image.required' => 'Choose Banner image.',
        ];
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
        ], $msg);
        $title = $request->get('title');
        if($request->hasFile('image'))
        {
            $banner_image = $request->file('image');
            $extension = $banner_image->getClientOriginalExtension();
            $bannerimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/banner');
            $banner_image->move($destinationPath, $bannerimagename);
            $banner_name = '/uploads/banner/'.$bannerimagename;
        }
 
            Banner::create([
                'title' => $title,
                'image' => $banner_name,
                'status' => 'Active',
                'created_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->back()->with('success','Banner Added Successfully !!!');
    }
    public function edit($id){
        $info = Banner::where('id', $id)->first();
        return view('admin.banner.edit', compact('info'));
    }
    public function update(Request $request,$id)
    {
        $msg = [
            'title.required' => 'Enter Banner Title',
        ];
        $this->validate($request, [
            'title' => 'required',
            //'image' => 'mimes:jpeg,jpg,png|required|false'
        ], $msg);
        $filename = Banner::where('id',$id)->value('image');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $destinationPath ='/uploads/banner/';
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
       // echo "string--".$filename;die;
        Banner::where('id',$id)->update([
            'title' => $request->title,
            'image' => $filename
        ]);
        return redirect()->back()->with('success', 'Banner Updated Successfully !!!');
    }
    public function status(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            Banner::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="banner_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            Banner::where('id',$id)->update([
                'status' => 'Active',
            ]);
            $st='Active';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="banner_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ok-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }

    }
    public function delete($id)
    {
        $filename = Banner::where('id',$id)->value('image');
        $destinationPath ='/uploads/banner/';
        $path = public_path().$filename;
        if($filename!=''){
                unlink($path);
            }
        Banner::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Banner Deleted Successfully !!!');
    }
  
    
    
}
