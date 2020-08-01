<?php

namespace App\Http\Controllers\Admin\Size;

use App\Models\Admin\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
class SizeController extends Controller
{
    public function index()
    {
         if(request()->ajax()) {
            $data=Size::where('deleted_at',NULL)->orderBy('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $url_delete = "'".route('admin::delete_size', ['id' => $data->id])."'";
                    $edit_url = route('admin::edit_size', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                    if($data->status=='Active'){
                        $edit.='<a href="javascript:size_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok-circle"></span> </a>';
                    } else{
                        $edit.='<a href="javascript:size_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-warning" ><span class="glyphicon glyphicon-ban-circle"></span> </a>';
                    }
                     $edit.='</span>';
                    $edit.=' <a data-toggle="modal" data-target="#confirmDelete" class="btn btn-sm btn btn-danger" onclick="getDeleteRoute('.$url_delete.')"><span class="glyphicon glyphicon-trash"></span></a>&emsp;';
                    return $edit;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        $pageTitle="Sizes";
        return view('admin.size.index',compact('pageTitle'));
    }
    public function add(){
        $pageTitle = "Add Size";
        return view('admin.size.add',compact('pageTitle'));
    }
    public function save(Request $request)
    {
        
         $msg = [
            'product_size.required' => 'Enter Product Size.',
        ];
        $this->validate($request, [
            'product_size' => 'required',
        ], $msg);
        $product_size = $request->get('product_size');
            Size::create([
                'product_size' => $product_size,
                'created_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->back()->with('success','Size Added Successfully !!!');
        
    }
    public function edit($id){
        $info = Size::where('id', $id)->first();
        return view('admin.size.edit', compact('info'));
    }
    public function update(Request $request,$id)
    {
        $msg = [
            'product_size.required' => 'Enter Product Size.',
        ];
        $this->validate($request, [
            'product_size' => 'required',
            //'image' => 'mimes:jpeg,jpg,png|required|false'
        ], $msg);
        //$chk_alias_data = Category::where('category_alias', $category_alias)->first();
        Size::where('id',$id)->update([
            'product_size' => $request->product_size,
        ]);
        return redirect()->back()->with('success', 'Size Updated Successfully !!!');
    }
    public function status(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            Size::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="size_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            Size::where('id',$id)->update([
                'status' => 'Active',
            ]);
            $st='Active';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="size_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ok-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }

    }
    
    public function delete($id)
    {
       
        Size::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Size Deleted Successfully !!!');
    }
  
    
    
}
