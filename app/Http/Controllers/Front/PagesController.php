<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\Brand;
use App\Models\Front\Page;
use App\Models\Front\Testimonial;

use DB;
use Mail;
use validator;
class PagesController extends Controller{
  public function __construct(){

  }
  public function about_us()
  {
    $pageTitle = "About Us";
    $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
    $pages = Page::where('deleted_at',NULL)->where('page_alias','about-us')->first();
    $testimonials = Testimonial::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
    return view('front.pages.about-us',['pages'=>$pages,'brands'=>$brands,'testimonials'=>$testimonials,'pageTitle'=>$pageTitle]);
  }
  public function privacy_policy()
  {
    $pageTitle = "Privacy Policy";
    $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
    $pages = Page::where('deleted_at',NULL)->where('page_alias','privacy-policy')->first();
    return view('front.pages.privacy-policy',['pages'=>$pages,'brands'=>$brands,'pageTitle'=>$pageTitle]);
  }
   public function our_store()
  {
    $pageTitle = "Our-Store";
    $brands = Brand::where('deleted_at',NULL)->where('status','Active')->orderBy('id','DESC')->get();
    $pages = Page::where('deleted_at',NULL)->where('page_alias','our-store')->first();
    return view('front.pages.our-store',['pages'=>$pages,'brands'=>$brands,'pageTitle'=>$pageTitle]);
  }
}
