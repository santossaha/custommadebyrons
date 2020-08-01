<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Page extends Model
{
	use SoftDeletes;
   protected $table = 'pages';
   protected $fillable = ['id','page_name','page_alias','description','created_at','updated_at','deleted_at'];
   protected $visible = ['id','page_name','page_alias','description','created_at','updated_at','deleted_at'];
   protected $dates = ['deleted_at'];
   public $timestamps = true;
}
