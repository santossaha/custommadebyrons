<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubCategory extends Model
{
	use SoftDeletes;
   protected $table = 'sub_categories';
   protected $fillable = ['id','category_id','sub_category_name','sub_category_alias','created_at','updated_at','deleted_at'];
   protected $visible = ['id','category_id','sub_category_name','sub_category_alias','created_at','updated_at','deleted_at'];
   protected $dates = ['deleted_at'];
   public $timestamps = true;
}
