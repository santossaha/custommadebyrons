<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\SubCategory;
use App\Models\Front\Category;
use App\Models\Front\Brand;
use App\Models\Front\Product;
use DB;
use Auth;
class ProductController extends Controller{
  public function __construct(){

  }

  public function cat_sub_cat_product($alias='',Request $request){

    $segment = request()->segment(1);
    $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
    $pageTitle = "Products";
    $sub_cat_id = SubCategory::where('sub_category_alias',$alias)->value('id');
    $category_id = Category::where('category_alias',$alias)->value('id');
    $brand_id = Brand::where('brand_alias',$alias)->value('id');
    $product_obj = new Product();
    if($segment=='products'){
      $datums = $product_obj->GetAllProduct();
    }else if($sub_cat_id!=''){
      $datums = $product_obj->GetSubCategoryProduct($sub_cat_id);
    }else if($category_id!=''){
      $datums = $product_obj->GetCategoryProduct($category_id);
    }else if($brand_id!=''){
     $datums = $product_obj->GetBrandProduct($brand_id);
    }
    $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
    //echo '<pre>';print_r($datums);die;
      return view('front.product.product',['brands'=>$brands,'datums'=>$datums,'pageTitle'=>$pageTitle,'user_id'=>$user_id]);


  }
  public function product_details($product_alias='',$product_code=''){
    //echo $product_alias.'<br>'.$product_code;die;
    $pageTitle = "Product Details";
    $product_obj = new Product();
    $data = $product_obj->GetProductDetails($product_alias,$product_code);
    $product_id = isset($data->id)?$data->id:'';
    $sub_cat_id = isset($data->sub_cat_id)?$data->sub_cat_id:'';
    $product_images = $product_obj->GetProductImageByID($product_id);
    $product_highlights = $product_obj->GetProductHighlightByID($product_id);
    $product_sizes = $product_obj->GetProductSizeByID($product_id);
    //echo "<pre>";print_r($product_sizes);die;
    $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
    $similar_products = $product_obj->GetSimilarProduct($product_id,$sub_cat_id);
  // echo "<pre>";print_r($similar_products);die;
    $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
    return view('front.product.product-details',['data'=>$data,'product_images'=>$product_images,'product_highlights'=>$product_highlights,'product_sizes'=>$product_sizes,'brands'=>$brands,'similar_products'=>$similar_products,'pageTitle'=>$pageTitle,'user_id'=>$user_id,'product_id'=>$product_id]);

  }
   public function product_subcategory_serach(Request $request)
   {
    if($request->ajax()){

       $product_obj = new Product();
       $data  = $request->all();
       if($data['sub_cat_id']!=''){
         $datums = $product_obj->GetProductBySubcategory($data['sub_cat_id']);
       }else{
          $datums = $product_obj->GetAllProduct();
       }

       $count = count($datums);
       $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
       return view('front.ajax.pagination-search-product', compact('datums','user_id'))->render();

     }
   }
  public function product_brand_serach(Request $request)
  {
      if($request->ajax()){
       $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
         $product_obj = new Product();
         $data  = $request->all();
         if($data['brand_id']!=''){
            $datums = $product_obj->GetProductByBrand($data['brand_id']);
          }else{
             $datums = $product_obj->GetAllProduct();
          }
         $count = count($datums);
          return view('front.ajax.pagination-search-product', compact('datums','user_id'))->render();

      }
  }
  public function product_discount_serach(Request $request)
  {
    $data  = $request->all();
    $discount = explode('-', $data['discount']);
    $min_discount = $discount[0];
    $max_discount = $discount[1];
    //echo "<pre>";print_r($max_discount);die;
      if($request->ajax()){
       $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
         $product_obj = new Product();
         if($min_discount!='' && $max_discount!=''){
            $datums = $product_obj->GetProductByDiscount($min_discount,$max_discount);
          }else{
             $datums = $product_obj->GetAllProduct();
          }
          //dd($datums);
         $count = count($datums);
          return view('front.ajax.pagination-search-product', compact('datums','user_id'))->render();

      }
  }
  public function product_price_serach(Request $request)
  {
    $data  = $request->all();
    //dd($data);die;
      if($request->ajax()){
       $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
         $product_obj = new Product();
         if($data['min_price']!='' && $data['max_price']!=''){
            $datums = $product_obj->GetProductByPrice($data['min_price'],$data['max_price']);
          }else{
             $datums = $product_obj->GetAllProduct();
          }
          //dd($datums);
         $count = count($datums);
          return view('front.ajax.pagination-search-product', compact('datums','user_id'))->render();

      }
  }
  public function DeliveryStatus(Request $request)
  {
    $allData = $request->all();
    echo "<pre>";print_r($allData);die;
  }

}
