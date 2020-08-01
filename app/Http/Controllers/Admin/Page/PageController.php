<?php

namespace App\Http\Controllers\Admin\Page;

use App\Models\Admin\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
class PageController extends Controller
{
    public function index()
    {
         if(request()->ajax()) {
            $data=Page::where('deleted_at',NULL)->orderBy('id','desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $url_delete = "'".route('admin::delete_page', ['id' => $data->id])."'";
                    $edit_url = route('admin::edit_page', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                     $edit.='</span>';
                     $edit.='<a href="'.route('admin::view_page',$data->id).'" title="View" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>&emsp;';
                    $edit.=' <a data-toggle="modal" data-target="#confirmDelete" class="btn btn-sm btn btn-danger" onclick="getDeleteRoute('.$url_delete.')"><span class="glyphicon glyphicon-trash"></span></a>&emsp;';
                    return $edit;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        $pageTitle="Pages";
        return view('admin.page.index',compact('pageTitle'));
    }
    public function add(){
        $pageTitle = "Add Page";
        return view('admin.page.add',compact('pageTitle'));
    }
    public function save(Request $request)
    {
        
         $msg = [
            'page_name.required' => 'Enter Page Name.',
            'page_title.required' => 'Enter Page Title.',
            'page_alias.required' => 'Enter Page Alias.',
        ];
        $this->validate($request, [
            'page_name' => 'required',
            'page_title' => 'required',
            'page_alias' => 'required',
        ], $msg);
        $page_name = $request->get('page_name');
        $page_title = $request->get('page_title');
        $page_alias = $request->get('page_alias');
        $chk_alias_data = Page::where('page_alias', $page_alias)->first();
        if($request->hasFile('image'))
        {
            $page_image = $request->file('image');
            $extension = $page_image->getClientOriginalExtension();
            $pageimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/pages');
            $page_image->move($destinationPath, $pageimagename);
            $page_img_name = '/uploads/pages/'.$pageimagename;
        }
        if(empty($chk_alias_data)){
            Page::create([
                'page_name' => $page_name,
                'page_title' => $page_title,
                'page_alias' => $page_alias,
                'description' => $request->get('description'),
                'image' => $page_img_name,
                'created_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->back()->with('success','Page Added Successfully !!!');
        }else{
             return redirect()->back()->with('error','Page Alias already exist');
        }
    }
    public function edit($id){
        $info = Page::where('id', $id)->first();
        return view('admin.page.edit', compact('info'));
    }
    public function update(Request $request,$id)
    {
        $msg = [
            'page_name.required' => 'Enter Page Name.',
            'page_alias.required' => 'Enter Page Alias.',
        ];
        $this->validate($request, [
            'page_name' => 'required',
            'page_alias' => 'required',
            //'image' => 'mimes:jpeg,jpg,png|required|false'
        ], $msg);
        //$chk_alias_data = Category::where('category_alias', $category_alias)->first();
        $filename = Page::where('id',$id)->value('image');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $destinationPath ='/uploads/pages/';
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

        $filename1 = Page::where('id',$id)->value('background_image');
        if($request->hasFile('background_image')){
            $file1 = $request->file('background_image');
            $destinationPath ='/uploads/pages/';
            $path1 = public_path().$filename1;
            if(file_exists($path1) && $filename1!=''){
                unlink($path1);
            }
            $extension1 = $file1->getClientOriginalExtension();
            $filename1 = rand(11111, 99999) .time(). '.' . $extension1;
            $file1->move(public_path() . $destinationPath, $filename1);
            $file_path1 = public_path() . $destinationPath.$filename1;
            Image::make($file_path1)->save($file_path1,100);
            $filename1 = $destinationPath.$filename1;
        }

        Page::where('id',$id)->update([
            'page_name' => $request->page_name,
            'page_title' => $request->page_title,
            'page_alias' => $request->page_alias,
            'description' => $request->description,
            'image' => $filename,
            'background_image' => $filename1,
        ]);
        return redirect()->back()->with('success', 'Page Updated Successfully !!!');
    }
    public function view($id){
        $info = Page::where('id', $id)->first();
        return view('admin.page.view', compact('info'));
    }
 
    public function delete($id)
    {
       $filename = Page::where('id',$id)->value('image');
        $destinationPath ='/uploads/pages/';
        $path = public_path().$filename;
        if($filename!=''){
                unlink($path);
            }
        Page::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Page Deleted Successfully !!!');
    }
  
    
    
}
