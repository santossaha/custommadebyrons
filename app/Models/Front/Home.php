<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class Home extends Model
{
	
	public function NewArrivalProduct(){
		$query = \App\Models\Front\Product::with([
				'product_image' => function($q) {
				    $q->where('default_image', '=', 1)
				      ->where('deleted_at',NULL);
				},
				])
				->where('products.deleted_at',NULL)
				->where('products.new_arrival','=',1)
				->where('products.status','=','Active')
				->limit(10);
				$data = $query->orderBy('products.id','DESC')->get();
				return $data;
	}
	public function GetAllProduct(){
		$query = \App\Models\Front\Product::with([
				'product_image' => function($q) {
				    $q->where('default_image', '=', 1)
				      ->where('deleted_at',NULL);
				},
				])
				->where('products.deleted_at',NULL)
				->where('products.status','=','Active');
				$data = $query->orderBy('products.id','DESC')->get();
				return $data;
	}
	public function GetSubCategoryWithProduct(){
		$query = DB::table('products')
         ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_cat_id')
         ->select('products.sub_cat_id','products.new_arrival','sub_categories.id', 'sub_categories.sub_category_name', DB::raw('COUNT(*) AS total'))
         ->where('products.deleted_at',NULL)
         ->where('products.status','Active')
         //->limit(10)
         ->groupBy('sub_categories.id');
         $data = $query->orderBy('sub_categories.sub_category_name','ASC')->get();
         return $data;
	}
	public function LatestCollectionProduct(){
		$query = \App\Models\Front\Product::with([
				'product_image' => function($q) {
				    $q->where('default_image', '=', 1)
				      ->where('deleted_at',NULL);
				},
				])
				->where('products.deleted_at',NULL)
				->where('products.latest_collection','=',1)
				->where('products.status','=','Active')
				->limit(2);
				$data = $query->orderBy('products.id','DESC')->get();
				return $data;
	}
	public function NewArrivalMaxDiscount(){
		$query = DB::table('products')
              ->select('products.id','products.new_arrival','products.sub_cat_id','products.discount','product_images.product_image','sub_categories.sub_category_name')
              ->leftJoin('product_images', function ($join) {
                      $join->on('product_images.product_id','=','products.id')
                      ->where('product_images.default_image','=',1);
                    })
              ->leftJoin('sub_categories', function ($join) {
                      $join->on('sub_categories.id','=','products.sub_cat_id')
                      ->where('sub_categories.status','=','Active');
                    })
              ->where('discount', \DB::raw("(select max(`discount`) from products)"))
              ->where('products.new_arrival',1);
        $data = $query->orderBy('products.id','DESC')->limit(1)->first();
        return $data;
	}
	public function LatestMaxDiscount(){
		$query = DB::table('products')
              ->select('products.id','products.latest_collection','products.sub_cat_id','products.discount','product_images.product_image','sub_categories.sub_category_name')
              ->leftJoin('product_images', function ($join) {
                      $join->on('product_images.product_id','=','products.id')
                      ->where('product_images.default_image','=',1);
                    })
              ->leftJoin('sub_categories', function ($join) {
                      $join->on('sub_categories.id','=','products.sub_cat_id')
                      ->where('sub_categories.status','=','Active');
                    })
              ->where('discount', \DB::raw("(select max(`discount`) from products)"))
              ->where('products.latest_collection',1);
        $data = $query->orderBy('products.id','DESC')->limit(1)->first();
        return $data;
	}
	public function BestSellingMaxDiscount(){
		$query = DB::table('products')
              ->select('products.id','products.best_selling','products.sub_cat_id','products.discount','product_images.product_image','sub_categories.sub_category_name')
              ->leftJoin('product_images', function ($join) {
                      $join->on('product_images.product_id','=','products.id')
                      ->where('product_images.default_image','=',1);
                    })
              ->leftJoin('sub_categories', function ($join) {
                      $join->on('sub_categories.id','=','products.sub_cat_id')
                      ->where('sub_categories.status','=','Active');
                    })
              ->where('discount', \DB::raw("(select max(`discount`) from products)"))
              ->where('products.best_selling',1);
        $data = $query->orderBy('products.id','DESC')->limit(1)->first();
        return $data;
	}
	public function NewArrivalSearchProduct($sub_cat_id=''){
		$query = \App\Models\Front\Product::with([
				'product_image' => function($q) {
				    $q->where('default_image', '=', 1)
				      ->where('deleted_at',NULL);
				},
				])
				->where('products.deleted_at',NULL)
				->where('products.new_arrival','=',1)
				->where('products.sub_cat_id','=',$sub_cat_id)
				->where('products.status','=','Active')
				->limit(10);
				$data = $query->orderBy('products.id','DESC')->get();
				return $data;
	}
	
}
