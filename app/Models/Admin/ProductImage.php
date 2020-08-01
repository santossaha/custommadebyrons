<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductImage extends Model
{
	use SoftDeletes;
   protected $table = 'product_images';
   protected $fillable = ['id','product_id','product_image','original_name','default_image','created_at','updated_at','deleted_at'];
   protected $visible = ['id','product_id','product_image','original_name','default_image','created_at','updated_at','deleted_at'];
   protected $dates = ['deleted_at'];
   public $timestamps = true;
}
