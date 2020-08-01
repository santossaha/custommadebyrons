<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Brand;
use App\Models\Admin\Size;
use App\Models\Admin\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
use DB;
use File;
class ProductController extends Controller
{
    public function index()
    {
         if(request()->ajax()) {
             $data = Product::where('products.deleted_at', NULL)->orderby('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $product_image = ProductImage::where('product_id',$data->id)->where('default_image',1)->value('product_image');
                    $image = '<img src="' . url($product_image) . '" width="100px" height="100px"/>';
                    return $image;
                })
                ->addColumn('brand_name', function ($data) {
                    $brand_name = Brand::where('id',$data->brand_id)->where('deleted_at',NULL)->value('brand_name');
                    return $brand_name;
                })
                ->addColumn('category_name', function ($data) {
                    $category_name = Category::where('id',$data->category_id)->where('deleted_at',NULL)->value('category_name');
                    return $category_name;
                })
                ->addColumn('sub_category_name', function ($data) {
                    $sub_category_name = SubCategory::where('id',$data->sub_cat_id)->where('deleted_at',NULL)->value('sub_category_name');
                    return $sub_category_name;
                })
                ->addColumn('action', function ($data) {
                    $url_delete = "'".route('admin::delete_product', ['id' => $data->id])."'";
                    $edit_url = route('admin::edit_product', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                    if($data->status=='Active'){
                        $edit.='<a href="javascript:product_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok-circle"></span> </a>';
                    } else{
                        $edit.='<a href="javascript:product_status('.$data->id.','.$data->status.');" class="btn btn-sm btn-warning" ><span class="glyphicon glyphicon-ban-circle"></span> </a>';
                    }
                    $edit.='</span>';
                    $edit.=' <a data-toggle="modal" data-target="#confirmDelete" class="btn btn-sm btn btn-danger" onclick="getDeleteRoute('.$url_delete.')"><span class="glyphicon glyphicon-trash"></span></a>&emsp;';
                    return $edit;
                })
                ->rawColumns(['action','image','brand_name','category_name','sub_category_name'])
                ->toJson();
        }
        $pageTitle="Products";
        return view('admin.product.index',compact('pageTitle'));
    }
    public function add(){
        $pageTitle = "Add Product";
        $categories = Category::where('status','Active')->where('deleted_at',NULL)->pluck('category_name', 'id');
        $brands = Brand::where('status','Active')->where('deleted_at',NULL)->pluck('brand_name', 'id');
        $sizes = Size::where('status','Active')->where('deleted_at',NULL)->pluck('product_size', 'id');
        return view('admin.product.add',compact('pageTitle','categories','brands','sizes'));
    }
    public function save(Request $request)
    {
         $msg = [
            'product_title.required' => 'Enter Product Title.',
            'product_alias.required' => 'Enter Product Alias.',
            'category_id.required' => 'Please Select Category.',
            'sub_cat_id.required' => 'Please Select Sub Category.',
            'brand_id.required' => 'Select Product Brand.',
            'price.required' => 'Enter Product Price.',
            'description.required' => 'Enter Product Description.',
        ];
        $this->validate($request, [
            'product_title' => 'required',
            'product_alias' => 'required',
            'category_id' => 'required',
            'sub_cat_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required|integer|not_in:0',
            'description' => 'required',
        ], $msg);

        $sizes = $request->get('size');
        $highlights =  $request->get('highlight');
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $product_code = $randomString;
        $product_title = $request->get('product_title');
        $product_alias = $request->get('product_alias');
        $category_id = $request->get('category_id');
        $sub_cat_id = $request->get('sub_cat_id');
        $brand_id = $request->get('brand_id');
        $price = $request->get('price');
        $discount = $request->get('discount');
        $description = $request->get('description');
        $warranty = $request->get('warranty');
        $new_arrival = $request->get('new_arrival');
        $best_selling = $request->get('best_selling');
        $latest_collection = $request->get('latest_collection');
        $chk_alias_data = Product::where('product_alias', $product_alias)->first();
        if(empty($chk_alias_data)){
            $save_data = Product::insertGetId([
                    'product_code' => $product_code,
                    'product_name' => $product_title,
                    'product_alias' => $product_alias,
                    'category_id' => $category_id,
                    'sub_cat_id' => $sub_cat_id,
                    'brand_id' => $brand_id,
                    'new_arrival' => $new_arrival,
                    'latest_collection' => $latest_collection,
                    'best_selling' => $best_selling,
                    'price' => $price,
                    'discount' => $discount,
                    'description' => $description,
                    'warranty' => $warranty,
                    'status' => 'Active',
                    'created_at' => date('Y-m-d h:i:s')
                ]);
                if($request->hasFile('image')){
                    $files = $request->file('image');
                    foreach($files as $file){
                        $destinationPath = public_path('/uploads/products');
                            $extension = $file->getClientOriginalExtension();
                            if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'JPG' || $extension == 'JPEG' || $extension == 'PNG'){
                            $name = rand(11111, 99999) .time(). '.' . $extension;
                            $file->move($destinationPath, $name);
                             $data_count = DB::table("product_images")->select('*')->where("product_id",$save_data )->where("default_image",1)->count();
                             if($data_count>0){
                              $defult_image = 0;
                            }else{
                              $defult_image = 1;
                            }
                          DB::table('product_images')
                              ->insertGetId(['product_id' => $save_data,'product_image' => 'uploads/products/'.$name,'original_name'=>$file->getClientoriginalName(),'default_image' =>$defult_image,'created_at' => date('Y-m-d H:i:s')]);
                        }else{
                            return redirect()->back()->with('error', 'Product image not valid.');
                        }
                    }
                }
//                if($sizes){
//                  foreach ($sizes as $size) {
//                    DB::table('product_size')->insertGetId(['product_id' => $save_data,'size_id' => $size,'created_at' => date('Y-m-d H:i:s')]);
//                  }
//                }
                if(isset($highlights) && !empty($highlights)){
                    foreach ($highlights as $key => $highlight) {
                        DB::table('product_highlights')->insert(['product_id'=>$save_data,'highlights'=>$highlight,'created_at'=>date('Y-m-d h:i:s')]);
                    }
                }
                return redirect()->back()->with('success','Product Added Successfully !!!');
            }else{
                return redirect()->back()->with('error','Product Alias already exist Please change alias');
            }
    }
    public function edit($id){
        $info = Product::where('id', $id)->first();
        $categories = Category::where('deleted_at',NULL)->where('status','Active')->orderBy('category_name','ASC')->get();
        $subcategory = SubCategory::where('deleted_at',NULL)->where('status','Active')->orderBy('sub_category_name','ASC')->get();
        $brands = Brand::where('deleted_at',NULL)->where('status','Active')->get();
        $allsizes = DB::table('sizes')->select('*')->where('deleted_at',NULL)->pluck('product_size', 'id');
        $query = DB::table("product_size")->select(DB::raw('group_concat(size_id) as sizes')) ->where('product_size.product_id','=',$id);
        $productsizes = $query->first();
        $productsizes = explode(',',$productsizes->sizes);
        $highlight = DB::table("product_highlights")->select('*')->where('product_id','=',$id)->get();
        $product_images = ProductImage::where('product_id',$id)->get();
        //echo "<pre>";print_r($product_images);die;
        return view('admin.product.edit', compact('info','categories','subcategory','brands','allsizes','productsizes','highlight','product_images'));
    }
    public function update(Request $request,$id)
    {
         $msg = [
            'product_title.required' => 'Enter Product Title.',
            'product_alias.required' => 'Enter Product Alias.',
            'category_id.required' => 'Please Select Category.',
            'sub_cat_id.required' => 'Please Select Sub Category.',
            'brand_id.required' => 'Select Product Brand.',
            'price.required' => 'Enter Product Price.',
            'description.required' => 'Enter Product Description.',
        ];
        $this->validate($request, [
            'product_title' => 'required',
            'product_alias' => 'required',
            'category_id' => 'required',
            'sub_cat_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required|integer|not_in:0',
            'description' => 'required',
        ], $msg);
         if($request->hasFile('image')){
                $files = $request->file('image');
                foreach($files as $file){
                    $destinationPath = public_path('/uploads/products');
                        $extension = $file->getClientOriginalExtension();
                        if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'JPG' || $extension == 'JPEG' || $extension == 'PNG'){
                        $name = rand(11111, 99999) .time(). '.' . $extension;
                        $file->move($destinationPath, $name);
                      DB::table('product_images')
                          ->insertGetId(['product_id' => $id,'product_image' => 'uploads/products/'.$name,'original_name'=>$file->getClientoriginalName(),'default_image' =>0,'created_at' => date('Y-m-d H:i:s')]);
                    }else{
                        return redirect()->back()->with('error', 'Product image not valid.');
                    }
                }
            }
         $sizes = $request->size;
         $highlights = $request->highlight;
         //echo "<pre>";print_r($highlights);die;
     /*   if($sizes){
            DB::table('product_size')->where('product_id', $id)->delete();
            foreach ($sizes as $size) {
                DB::table('product_size')->insertGetId(['product_id' => $id,'size_id' => $size,'created_at' => date('Y-m-d H:i:s')]);
            }
        }*/
        if(isset($highlights) && !empty($highlights)){
            DB::table('product_highlights')->where('product_id', $id)->delete();
            foreach ($highlights as $key => $highlight) {
                DB::table('product_highlights')->insert(['product_id'=>$id,'highlights'=>$highlight,'created_at'=>date('Y-m-d h:i:s')]);
            }
        }
         //echo "<pre>";print_r($sizes);die;
        Product::where('id',$id)->update([
            'product_name' => $request->product_title,
            'product_alias' => $request->product_alias,
            'category_id' => $request->category_id,
            'sub_cat_id' => $request->sub_cat_id,
            'brand_id' => $request->brand_id,
            'new_arrival' => $request->new_arrival,
            'latest_collection' => $request->latest_collection,
            'best_selling' => $request->best_selling,
            'price' => $request->price,
            'discount' => $request->discount,
            'description' => $request->description,
            'warranty' => $request->warranty,
            'updated_at'=>date('Y-m-d h:i:s')
        ]);
        return redirect()->back()->with('success', 'Banner Updated Successfully !!!');
    }
    public function status(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            Product::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="product_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            Product::where('id',$id)->update([
                'status' => 'Active',
            ]);
            $st='Active';
            $html='&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="product_status('.$id.','.$st.')"><span class="glyphicon glyphicon-ok-circle"></span></a>';
            return json_encode(array('id'=>$id,'html'=>$html));
        }

    }
    public function delete($id)
    {
        $filename = ProductImage::where('product_id',$id)->get();
        if($filename){
            $product_image = array();
            foreach ($filename as $key => $value) {
               $product_image[$key]['product_image'] = $value->product_image;
               $product_image[$key]['id'] = $value->id;
            }
            foreach($product_image as $pro_img){
                    File::delete(public_path($pro_img['product_image']));
                    DB::table('product_images')->where('id', '=', $pro_img['id'])->delete();
                }
        }
        DB::table('product_size')->where('product_id', '=', $id)->delete();
        DB::table('product_highlights')->where('product_id', '=', $id)->delete();
        DB::table('products')->where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully !!!');
    }
    public function fetch(Request $request)
    {
     $select = $request->get('select');
     $value = $request->get('value');
     //echo 'select---'.$select.'<br>'.'value---'.$value;die;
     $dependent = $request->get('dependent');
     $data = SubCategory::where($select, $value)->where('status','=','Active')->where('deleted_at','=',NULL)->get();
       //echo "<pre>";print_r($data);die;
     $output = '<option value="">Select Product Sub Category</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->sub_category_name.'</option>';
     }
     echo $output;
    }
    public function image_default(Request $request){
        $id = $request->input('id');
        $product_id = $request->input('product_id');
        DB::table('product_images')->where('product_id',$product_id)->update(['default_image'=> 0]);
        DB::table('product_images')->where('id',$id)->update(['default_image'=> 1]);
        $return = 1;
        return $return;

    }
    public function ProductImageDelete(Request $request){
        $id = $request->input('id');
        if ($id) {
          $filelist=DB::table('product_images')->where('id', $id)->first();
          if($filelist->default_image !=1){
                $image_path =$filelist->product_image;
                if(file_exists($image_path)){
                  unlink($image_path);
                }
                $delete_id=DB::table('product_images')->where('id', '=', $id)->delete();
                if($delete_id)
                {
                  $return = 1;
                }
                else
                {
                  $return=2;
                }
          }else{
            $return=3;
          }
        }
        return $return;
    }

}
