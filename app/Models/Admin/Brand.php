<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Brand extends Model
{
	use SoftDeletes;
   protected $table = 'brands';
   protected $fillable = ['id','brand_name','brand_image','created_at','updated_at','deleted_at'];
   protected $visible = ['id','brand_name','brand_image','created_at','updated_at','deleted_at'];
   protected $dates = ['deleted_at'];
   public $timestamps = true;
}
