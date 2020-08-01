<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
	use SoftDeletes;
   protected $table = 'products';
   protected $fillable = ['id','product_code','category_id','sub_cat_id','new_arrival','latest_collection','best_selling','product_name','product_alias','price','discount','description','warranty','status','created_at','updated_at','deleted_at'];
   protected $visible = ['id','product_code','category_id','sub_cat_id','new_arrival','latest_collection','best_selling','product_name','product_alias','price','discount','description','warranty','status','created_at','updated_at','deleted_at'];
   protected $dates = ['deleted_at'];
   public $timestamps = true;
}
