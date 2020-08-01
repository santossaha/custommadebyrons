<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
class CategoryController extends Controller
{
    public function index()
    {
         if(request()->ajax()) {
            $data=Category::where('deleted_at',NULL)->orderBy('id','desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $url_delete = "'".route('admin::delete_category', ['id' => $data->id])."'";
                    $edit_url = route('admin::edit_category', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                    if($data->status=='Active'){
                        $edit.='<a href="javascript:category_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok-circle"></span> </a>';
                    } else{
                        $edit.='<a href="javascript:category_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-warning" ><span class="glyphicon glyphicon-ban-circle"></span> </a>';
                    }
                    $edit.='</span>';
                    $edit.=' <a data-toggle="modal" data-target="#confirmDelete" class="btn btn-sm btn btn-danger" onclick="getDeleteRoute('.$url_delete.')"><span class="glyphicon glyphicon-trash"></span></a>&emsp;';
                    return $edit;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        $pageTitle="Categories";
        return view('admin.category.index',compact('pageTitle'));
    }
    public function add(){
        $pageTitle = "Add Category";
        return view('admin.category.add',compact('pageTitle'));
    }
    public function save(Request $request)
    {
        
         $msg = [
            'category_name.required' => 'Enter Category Name.',
        ];
        $this->validate($request, [
            'category_name' => 'required',
        ], $msg);
        $category_name = $request->get('category_name');
        $category_alias = $request->get('category_alias');
        $chk_alias_data = Category::where('category_alias', $category_alias)->first();
        if(empty($chk_alias_data)){
            Category::create([
                'category_name' => $category_name,
                'category_alias' => $category_alias,
                'status' => 'Active',
                'created_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->back()->with('success','Category Added Successfully !!!');
        }else{
             return redirect()->back()->with('error','Category Alias already exist');
        }
    }
    public function edit($id){
        $info = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('info'));
    }
    public function update(Request $request,$id)
    {
        $msg = [
            'category_name.required' => 'Enter Category Name.',
        ];
        $this->validate($request, [
            'category_name' => 'required',
            //'image' => 'mimes:jpeg,jpg,png|required|false'
        ], $msg);
        //$chk_alias_data = Category::where('category_alias', $category_alias)->first();
        Category::where('id',$id)->update([
            'category_name' => $request->category_name,
            'category_alias' => $request->category_alias,
        ]);
        return redirect()->back()->with('success', 'Category Updated Successfully !!!');
    }
    public function status(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            Category::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="category_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            Category::where('id',$id)->update([
                'status' => 'Active',
            ]);
            $st='Active';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="category_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ok-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }

    }
    public function delete($id)
    {
       
        Category::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully !!!');
    }
  
    
    
}
