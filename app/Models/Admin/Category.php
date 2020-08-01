<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
	use SoftDeletes;
   protected $table = 'categories';
   protected $fillable = ['id','category_name','category_alias','created_at','updated_at','deleted_at'];
   protected $visible = ['id','category_name','category_alias','created_at','updated_at','deleted_at'];
   protected $dates = ['deleted_at'];
   public $timestamps = true;
}
