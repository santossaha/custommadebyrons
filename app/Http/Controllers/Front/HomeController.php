<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\Banner;
use App\Models\Front\Home;
use App\Models\Front\Brand;
use App\Models\Front\SubCategory;
use App\Models\Front\Product;
use DB;
use Auth;

class HomeController extends Controller{
  public function __construct(){

  }

  public function index(){
    $pageTitle = "Home";
    $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
  	$banners = Banner::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
  	$product_common_obj = new Home();
  	$new_arrival_products =  $product_common_obj->NewArrivalProduct();
  	$products = $product_common_obj->GetAllProduct();
  	$brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
  	$subcategories = $product_common_obj->GetSubCategoryWithProduct();
    $latests = $product_common_obj->LatestCollectionProduct();
   $new_arr_max_dis_data = $product_common_obj->NewArrivalMaxDiscount();
   $latest_max_dis_data = $product_common_obj->LatestMaxDiscount();
   $best_max_dis_data = $product_common_obj->BestSellingMaxDiscount();
   $discount_data = array($new_arr_max_dis_data,$best_max_dis_data,$latest_max_dis_data);
   //echo "<pre>";print_r($products);die;
    return view('front.home.index',['banners'=>$banners,'new_arrival_products'=>$new_arrival_products,'products'=>$products,'brands'=>$brands,'subcategories'=>$subcategories,'latests'=>$latests,'discount_data'=>$discount_data,'pageTitle'=>$pageTitle,'user_id'=>$user_id]);

  }
  public function new_arrival_product_search(Request $request){
     $product_common_obj = new Home();
     $user_id = isset(Auth::guard('web')->user()->id)?Auth::guard('web')->user()->id:'';
     $data  = $request->post();
     $sub_cat_id =$data['sub_cat_id'];
     $search_products =  $product_common_obj->NewArrivalSearchProduct($sub_cat_id);
     $html='';
     $count = count($search_products);
     if(count($search_products)>0){
       foreach ($search_products as $data) {
          $discount = isset($data->discount)?$data->discount:'';
          $org_price = isset($data->price)?$data->price:'';
          $dis_amt = ($org_price*$discount)/100;
          $dis_price = ($org_price-$dis_amt);
         $html .='<div class="grid-item">
                      <div class="gallery-item">
                          <figure class="ngo-gal">
                              <div class="image">';
                                if($data["product_image"][0]->product_image!=""){
                                  $html .='<img src="'.url($data["product_image"][0]->product_image).'" alt=""/>';
                                }else{
                                  $html .='<img src="admin/img/No-Image.png" alt=""/>';
                                }
                                  $html .='<div class="icons">
                                            <a href="javascript:void(0);"><i class="fas fa-shopping-cart add-cart" data-product-id="'.$data->id.'" data-uid="'.$user_id.'" data-product-quantity="1"></i></a>
                                            <a href="javascript:void(0);"> <i class="far fa-heart whish-list" data-product-id="'.$data->id.'" data-uid="'.$user_id.'" data-product-quantity="1"></i></a>
                                            <a href="'.url('product/'.$data->product_alias.'/'.$data->product_code).'"> <i class="far fa-eye"></i></a>
                                          </div>
                                          <a href="javascript:void(0);" class="add-to-cart add-cart" data-product-id="'.$data->id.'" data-uid="'.$user_id.'" data-product-quantity="1">Add to Cart</a>

                              </div>
                              <figcaption>
                                  <h2>'.$data->product_name.'</h2>
                                  <div class="price">
                                       <!-- <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                        </ul>
-->
                                        <p>
                                            $'.$dis_price.' <span class="line-through">$'.$org_price.'.00</span>
                                        </p>
                                    </div>
                                </figcaption>
                            </figure>
                      </div>
                  </div>';
       }
     }else{
       $html .='<div class="result"><span class="nrslt-txt">No result</span></div>';
     }
     echo $html;
  }

}
