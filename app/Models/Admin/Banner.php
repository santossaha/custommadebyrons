<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Banner extends Model
{
	use SoftDeletes;
   protected $table = 'banners';
   protected $fillable = ['id','image','title','created_at','updated_at','deleted_at'];
   protected $visible = ['id','image','title','created_at','updated_at','deleted_at'];
   protected $dates = ['deleted_at'];
   public $timestamps = true;
}
