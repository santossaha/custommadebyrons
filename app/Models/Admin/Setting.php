<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Setting extends Model
{
	use SoftDeletes;
   protected $table = 'site_settings';
   protected $fillable = ['id','title','email','phone','copyright','facebbok','twitter','google_plus','youtube','logo','address','status','created_at','updated_at','deleted_at'];
   protected $visible = ['id','title','email','phone','copyright','facebbok','twitter','google_plus','youtube','logo','address','status','created_at','updated_at','deleted_at'];
   protected $dates = ['deleted_at'];
   public $timestamps = true;
}
