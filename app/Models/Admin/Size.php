<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Size extends Model
{
	use SoftDeletes;
   protected $table = 'sizes';
   protected $fillable = ['id','product_size','status','created_at','updated_at','deleted_at'];
   protected $visible = ['id','product_size','status','created_at','updated_at','deleted_at'];
   protected $dates = ['deleted_at'];
   public $timestamps = true;
}
