<?php

namespace App\Http\Controllers\Admin\Subcategory;

use App\Models\Admin\SubCategory;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
class SubCategoryController extends Controller
{
    public function index()
    {
         if(request()->ajax()) {
            $data=SubCategory::where('deleted_at',NULL)->orderBy('id','desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category_name', function ($data) {
                    $category_name = Category::where('id',$data->category_id)->where('deleted_at',NULL)->value('category_name');
                    return $category_name;
                })
                ->addColumn('action', function ($data) {
                    $url_delete = "'".route('admin::delete_subcategory', ['id' => $data->id])."'";
                    $edit_url = route('admin::edit_subcategory', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                    if($data->status=='Active'){
                        $edit.='<a href="javascript:subcategory_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok-circle"></span> </a>';
                    } else{
                        $edit.='<a href="javascript:subcategory_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-warning" ><span class="glyphicon glyphicon-ban-circle"></span> </a>';
                    }
                    $edit.='</span>';
                    $edit.=' <a data-toggle="modal" data-target="#confirmDelete" class="btn btn-sm btn btn-danger" onclick="getDeleteRoute('.$url_delete.')"><span class="glyphicon glyphicon-trash"></span></a>&emsp;';
                    return $edit;
                })
                ->rawColumns(['action','category_name'])
                ->toJson();
        }
        $pageTitle="Sub Categories";
        return view('admin.subcategory.index',compact('pageTitle'));
    }
    public function add(){
        $pageTitle = "Add Sub Category";
       $categories = Category::where(['deleted_at' => null])->where(['status'=>'Active'])->orderBy('category_name','ASC')->pluck('category_name', 'id');
        return view('admin.subcategory.add',compact('pageTitle','categories'));
    }
    public function save(Request $request)
    {
        
         $msg = [
            'category_id.required' => 'Please Select Category.',
            'sub_category_name.required' => 'Enter Sub Category Name.',
            'sub_category_alias.required' => 'Enter Sub Category Alias.',
        ];
        $this->validate($request, [
            'category_id' => 'required',
            'sub_category_name' => 'required',
            'sub_category_alias' => 'required',
        ], $msg);
        $category_id = $request->get('category_id');
        $sub_category_name = $request->get('sub_category_name');
        $sub_category_alias = $request->get('sub_category_alias');
        $chk_alias_data = SubCategory::where('sub_category_alias', $sub_category_alias)->first();
        if(empty($chk_alias_data)){
            SubCategory::create([
                'category_id' => $category_id,
                'sub_category_name' => $sub_category_name,
                'sub_category_alias' => $sub_category_alias,
                'status' => 'Active',
                'created_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->back()->with('success','Sub Category Added Successfully !!!');
        }else{
             return redirect()->back()->with('error','Sub Category Alias already exist');
        }
    }
    public function edit($id){
        $info = SubCategory::where('id', $id)->first();
        $categories = Category::where(['deleted_at' => null])->where(['status'=>'Active'])->get();
        //echo "<pre>";print_r($categories);die;
        return view('admin.subcategory.edit', compact('info','categories'));
    }
    public function update(Request $request,$id)
    {
        $msg = [
            'category_id.required' => 'Please Select Category.',
            'sub_category_name.required' => 'Enter Sub Category Name.',
            'sub_category_alias.required' => 'Enter Sub Category Alias.',
        ];
        $this->validate($request, [
            'category_id' => 'required',
            'sub_category_name' => 'required',
            'sub_category_alias' => 'required',
        ], $msg);
        //$chk_alias_data = Category::where('category_alias', $category_alias)->first();
        SubCategory::where('id',$id)->update([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'sub_category_alias' => $request->sub_category_alias,
        ]);
        return redirect()->back()->with('success', 'Sub Category Updated Successfully !!!');
    }
    public function status(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            SubCategory::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="subcategory_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            SubCategory::where('id',$id)->update([
                'status' => 'Active',
            ]);
            $st='Active';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="subcategory_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ok-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }

    }
    public function delete($id)
    {
       
        SubCategory::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Sub Category Deleted Successfully !!!');
    }
  
    
    
}
