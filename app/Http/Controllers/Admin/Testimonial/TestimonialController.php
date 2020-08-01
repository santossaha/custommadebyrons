<?php

namespace App\Http\Controllers\Admin\Testimonial;

use App\Mail\ForgotPassMail;
use App\Mail\Testing;
use App\Models\Admin\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
class TestimonialController extends Controller
{
    public function index()
    {
         if(request()->ajax()) {
            $data=Testimonial::where('deleted_at',NULL)->orderBy('id','desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $image = '<img src="' . url($data->image) . '" width="100px" height="80px"/>';
                    return $image;
                })
                ->addColumn('action', function ($data) {
                    $url_delete = "'".route('admin::delete_testimonial', ['id' => $data->id])."'";
                    $edit_url = route('admin::edit_testimonial', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                    if($data->status=='Active'){
                        $edit.='<a href="javascript:testimonial_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok-circle"></span> </a>';
                    } else{
                        $edit.='<a href="javascript:testimonial_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-warning" ><span class="glyphicon glyphicon-ban-circle"></span> </a>';
                    }
                    $edit.='</span>';
                    $edit.=' <a data-toggle="modal" data-target="#confirmDelete" class="btn btn-sm btn btn-danger" onclick="getDeleteRoute('.$url_delete.')"><span class="glyphicon glyphicon-trash"></span></a>&emsp;';
                    return $edit;
                })
                ->rawColumns(['action','image'])
                ->toJson();
        }
        $pageTitle="Testimonial";
        return view('admin.testimonial.index',compact('pageTitle'));
    }
    public function add(){
        $pageTitle = "Add Testimonial";
        return view('admin.testimonial.add',compact('pageTitle'));
    }
    public function save(Request $request)
    {
         $msg = [
            'name.required' => 'Enter Name.',
            'designation.required' => 'Enter Designation.',
            'image.required' => 'Choose image.',
        ];
        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
        ], $msg);
        $name = $request->get('name');
        $designation = $request->get('designation');
        $description = $request->get('description');
        if($request->hasFile('image'))
        {
            $testi_image = $request->file('image');
            $extension = $testi_image->getClientOriginalExtension();
            $testiimagename = rand(11111, 99999) .time(). '.' . $extension;
            $destinationPath = public_path('/uploads/testimonials');
            $testi_image->move($destinationPath, $testiimagename);
            $testi_img_name = '/uploads/testimonials/'.$testiimagename;
        }

            Testimonial::create([
                'name' => $name,
                'designation' => $designation,
                'image' => $testi_img_name,
                'description' => $description,
                'status' => 'Active',
                'created_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->back()->with('success','Testimonial Added Successfully !!!');
    }
    public function edit($id){
        $info = Testimonial::where('id', $id)->first();
        return view('admin.testimonial.edit', compact('info'));
    }
    public function update(Request $request,$id)
    {
        $msg = [
            'name.required' => 'Enter Name',
            'designation.required' => 'Enter Designation',
        ];
        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
        ], $msg);
        $filename = Testimonial::where('id',$id)->value('image');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $destinationPath ='/uploads/testimonials/';
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
        Testimonial::where('id',$id)->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,
            'image' => $filename
        ]);
        return redirect()->back()->with('success', 'Testimonial Updated Successfully !!!');
    }
    public function status(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            Testimonial::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="testimonial_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            Testimonial::where('id',$id)->update([
                'status' => 'Active',
            ]);
            $st='Active';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="testimonial_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ok-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }

    }
    public function delete($id)
    {
        $filename = Testimonial::where('id',$id)->value('image');
        $destinationPath ='/uploads/testimonials/';
        $path = public_path().$filename;
        if($filename!=''){
                unlink($path);
            }
        Testimonial::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Testimonial Deleted Successfully !!!');
    }




}
