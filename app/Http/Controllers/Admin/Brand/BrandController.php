<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
class BrandController extends Controller
{
    public function index()
    {
         if(request()->ajax()) {
            $data=Brand::where('deleted_at',NULL)->orderBy('id','desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $image = '<img src="' . url($data->brand_image) . '" width="200px" height="80px"/>';
                    return $image;
                })
                ->addColumn('action', function ($data) {
                    $url_delete = "'".route('admin::delete_brand', ['id' => $data->id])."'";
                    $edit_url = route('admin::edit_brand', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                    if($data->status=='Active'){
                        $edit.='<a href="javascript:brand_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok-circle"></span> </a>';
                    } else{
                        $edit.='<a href="javascript:brand_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-warning" ><span class="glyphicon glyphicon-ban-circle"></span> </a>';
                    }
                    $edit.='</span>';
                    $edit.=' <a data-toggle="modal" data-target="#confirmDelete" class="btn btn-sm btn btn-danger" onclick="getDeleteRoute('.$url_delete.')"><span class="glyphicon glyphicon-trash"></span></a>&emsp;';
                    return $edit;
                })
                ->rawColumns(['action','image'])
                ->toJson();
        }
        $pageTitle="Brands";
        return view('admin.brand.index',compact('pageTitle'));
    }
    public function add(){
        $pageTitle = "Add Banner";
        return view('admin.brand.add',compact('pageTitle'));
    }
    public function save(Request $request)
    {
         $msg = [
            'brand_name.required' => 'Enter Brand Name.',
            'brand_alias.required' => 'Enter Brand Alias.',
            'image.required' => 'Choose Brand image.',
        ];
        $this->validate($request, [
            'brand_name' => 'required',
            'brand_alias' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
        ], $msg);
        $brand_name = $request->get('brand_name');
        $brand_alias = $request->get('brand_alias');
        if($request->hasFile('image'))
        {
            $brand_image = $request->file('image');
            $extension = $brand_image->getClientOriginalExtension();
            $brandimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/brands');
            $brand_image->move($destinationPath, $brandimagename);
            $brand_img_name = '/uploads/brands/'.$brandimagename;
        }
        $chk_alias_data = Brand::where('brand_alias', $brand_alias)->first();
        if(empty($chk_alias_data)){
            Brand::create([
                'brand_name' => $brand_name,
                'brand_alias'=> $brand_alias,
                'brand_image' => $brand_img_name,
                'status' => 'Active',
                'created_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->back()->with('success','Brand Added Successfully !!!');
        }else{
            return redirect()->back()->with('error','Brand Alias already exist');
        }
    }
    public function edit($id){
        $info = Brand::where('id', $id)->first();
        return view('admin.brand.edit', compact('info'));
    }
    public function update(Request $request,$id)
    {
        $msg = [
            'brand_name.required' => 'Enter Brand Name',
        ];
        $this->validate($request, [
            'brand_name' => 'required',
        ], $msg);
        $filename = Brand::where('id',$id)->value('brand_image');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $destinationPath ='/uploads/brands/';
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
        Brand::where('id',$id)->update([
            'brand_name' => $request->brand_name,
            'brand_alias' => $request->brand_alias,
            'brand_image' => $filename
        ]);
        return redirect()->back()->with('success', 'Brand Updated Successfully !!!');
    }
    public function status(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            Brand::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="brand_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            Brand::where('id',$id)->update([
                'status' => 'Active',
            ]);
            $st='Active';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="brand_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ok-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }

    }
    public function delete($id)
    {
        $filename = Brand::where('id',$id)->value('brand_image');
        $destinationPath ='/uploads/brands/';
        $path = public_path().$filename;
        if($filename!=''){
                unlink($path);
            }
        Brand::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Brand Deleted Successfully !!!');
    }
  
    
    
}
